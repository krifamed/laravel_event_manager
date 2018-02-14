<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Response;

class RegisterController extends Controller{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/api/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'birthday'=>'required|date'
        ]);
    }
    public function register(Request $request)
    {
        if($this->validator($request->all())->fails()){
           return response()->json(['errors'=>$this->validator($request->all())->errors()]);
        };

        $user = $this->create($request->all());

        //$this->guard()->login($user);
        return response()->json([$user->toArray(), 'User saved successfully']);
        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
        //
    }
    protected function create(array $request)
      {
        $user=User::create([
                 'name' => $request["fname"],
                 'email' => $request["email"],
                 'password' => bcrypt($request["password"]),
                 'type'=> 'Client'
               ]);
         $Client=Client::create([
           "fname"=>$request["fname"],
           "lname"=>$request["lname"],
           "birthday"=>$request["birthday"],
           "user_id"=>$user->id,
         ]);
  	     return $user ;
      }
}
