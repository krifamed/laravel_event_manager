<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Employee;
use App\Models\Organiser;
use App\Role;
use Auth;
use Eloquent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
// use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\http\Request;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function showRegistrationForm()
    {
      $roleCount = Role::count();
		if($roleCount != 0) {
			$userCount = User::count();
			if($userCount != 0) {
				return view('auth.register');
        // return redirect('login');
			}
		} else {
			return view('errors.error', [
				'title' => 'Migration not completed',
				'message' => 'Please run command <code>php artisan db:seed</code> to generate required table data.',
			]);
		  }
    }

    public function showLoginForm()
    {
		$roleCount = Role::count();
		if($roleCount != 0) {
			$userCount = User::count();
			if($userCount == 0) {
				return redirect('register');
			} else {
				return view('auth.login');
			}
		} else {
			return view('errors.error', [
				'title' => 'Migration not completed',
				'message' => 'Please run command <code>php artisan db:seed</code> to generate required table data.',
			]);
		}
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6|confirmed',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }


    public function register(Request $request){
    $validator = $this->validator($request->all());
    if($validator->fails())
      dd("failed");
    // event(new Registered($user = $this->create($request->all())));

    // $this->guard()->login($user);
    $user = $this->create($request->all());
    // Auth::guard($this->getGuard())->login($this->create($request->all()));

    return redirect($this->redirectPath());
}

    protected function login(Request $request){
    $cond=[];
    $cond=$this->getCredentials($request);
    $cond['approved']="yes";
    // dd($cond);
    // return $this->guard()->attempt(
    //     $cond, $request->filled('remember')
    // );
    if(Auth::attempt($cond, $request->has('remember')))
      return redirect()->intended($this->redirectPath());
    return redirect('login')
      ->withInput($request->only('email', 'password'))
      ->withErrors([
        'email' => $this->getFailedLoginMessage(),
      ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */



    protected function create(array $data)
    {
        // TODO: This is Not Standard. Need to find alternative
        Eloquent::unguard();

        $employee = Employee::create([
            'name' => $data['name'],
            'designation' => "Organiser",
            'mobile' => "8888888888",
            'mobile2' => "",
            'email' => $data['email'],
            'gender' => 'Male',
            'dept' => "1",
            'city' => "Pune",
            'address' => "Karve nagar, Pune 411030",
            'about' => "About user / biography",
            'date_birth' => date("Y-m-d"),
            'date_hire' => date("Y-m-d"),
            'date_left' => date("Y-m-d"),
            'salary_cur' => 0,
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'context_id' => $employee->id,
            'type' => "Organiser",
            'approved' => 'no'
        ]);
        $role = Role::where('name', 'Organiser')->first();
        $user->attachRole($role);
        $organiser = Organiser::create([
          'name' => $data['name'],
          // 'description' => $data['description'],
          'user_id' => $user->id,

        ]);

        return $user;
    }
}
