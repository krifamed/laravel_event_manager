<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Repositories\SessionRepository;

use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Session;

class SessionsController extends Controller
{
	public $show_action = true;
	public $view_col = 'title';
	public $listing_cols = ['id', 'title', 'start_date', 'end_date', 'payed', 'description', 'speaker', 'day_id'];

	public function __construct(SessionRepository $sessionRepo) {
		$this->sessionRepository = $sessionRepo;
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Sessions', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Sessions', $this->listing_cols);
		}
	}


	/*
		* create session for specific day of event
		* @params $eventId , $dayId
	*/

	public function getSessions($eventId, $dayId){
		$sessions = Session::where('day_id', $dayId)->get();
		// dd($sessions);
		// dd(compact('eventId', 'dayId'));
		return view('sessions.index')
			->with('sessions', $sessions)
			->with(compact('eventId', 'dayId'));
	}

	public function createSession($eventId, $dayId){
			return view('sessions.create')
				->with(compact('eventId', 'dayId'));
	}

	/*

		* store session for specific day of event

		* @params $eventId , $dayId

	*/

	public function storeSession(CreateSessionRequest $request ,$eventId, $dayId){
			$input = $request->all();
			if(Module::hasAccess("Sessions", "create")) {
        //
				$rules = Module::validateRules("Sessions", $request);
				$validator = Validator::make($request->all(), $rules);
				if ($validator->fails()) {
					return redirect()->back()->withErrors($validator)->withInput();
				}
				$session = $this->sessionRepository->create($input);
				// $insert_id = Module::insert("Sessions", $request);
				// dd($insert_id);

				return redirect()->route('sessions', [$eventId, $dayId]);

			} else {
				return redirect(config('laraadmin.adminRoute')."/");
			}
	}

	/*
		* edit session for specific day of event
	*/

	public function editSession($eventId, $dayId, $session_id)
	{
			$session = $this->sessionRepository->findWithoutFail($session_id);

			if (empty($session)) {
					Flash::error('Session not found');

					return redirect(route('sessions' ,[$eventId, $dayId]));
			}

			return view('sessions.edit')
				->with('session', $session)
				->with(compact('eventId', 'dayId'));
	}

	/*
		* update session for specific day of event
	*/

	public function updateSession(UpdateSessionRequest $request, $eventId, $dayId, $session_id){

				$session = $this->sessionRepository->findWithoutFail($session_id);

				if (empty($session)) {
						Flash::error('Session not found');

						return redirect(route('sessions', [$eventId, $dayId]));
				}

				$session = $this->sessionRepository->update($request->all(), $session_id);

				// Flash::success('Session updated successfully.');

				return redirect(route('sessions', [$eventId, $dayId]));
	}

	public function showSession($eventId, $dayId, $session_id){

			$session = $this->sessionRepository->findWithoutFail($session_id);
			if (empty($session)) {
					Flash::error('Session not found');

					return redirect(route('sessions', [$eventId, $dayId]));
			}

			return view('sessions.show')
				->with('session', $session)
				->with(compact('eventId', 'dayId'));
	}


	public function destroySession($eventId, $dayId, $session_id){

		if(Module::hasAccess("Sessions", "delete")) {
			// Session::find($id)->delete();
				DB::table('sessions')->delete($session_id);

			// Redirecting to index() method
			return redirect()->route('sessions', [$eventId, $dayId]);
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

}
