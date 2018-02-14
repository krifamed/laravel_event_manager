<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use JWTAuth;
class AuthenticateController extends Controller{

    public function __construct(){
      $this->middleware('jwt.refresh')->only('logout');
    }

    public function login(Request $request){
      // grab all credentials from the request
      $credentials = $request->only('email', 'password');
      $credentials["type"] = 'Client';
      try {
          // attempt to verify the credentials and create a token for the user
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      // all good so return the token
      return response()->json(compact('token'));
    }

    public function logout(){
      auth()->logout();
      return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(){
        if (! $user = JWTAuth::parseToken()->authenticate()) {
          return response()->json(['user_not_found'], 404);
        }
        return response()->json(compact('user'));
    }

    public function refresh(){
      return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token){
      return response()->json([
          'access_token' => $token,
          'token_type' => 'bearer',
      ]);
    }

    public function guard(){
      return Auth::guard();
    }

}
