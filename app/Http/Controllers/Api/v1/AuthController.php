<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\HelpController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends HelpController
{
     /**
   * Create User
   *
   * @author Fokoui Marco Hunterbrightdesign@gmail.com
   * @param \Illuminate\Http\Request $request
   * @return User
   */
  public function register(Request $request) {
      $validateUser = Validator::make(
        $request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required',
          'confirm_password' => 'required|same:password',
        ]
      );

      if ($validateUser->fails()) {
        return $this->sendError('Vlidation error: '. $validateUser->errors(), 401);
      }
      $userInfo = $request->all();
      $userInfo['password'] = Hash::make($userInfo['password']);
      $user = User::create($userInfo);
      $success['token'] =  $user->createToken('MyApp')->plainTextToken;
      $success['name'] =  $user->name;
      $success['email'] =  $user->email;

      return $this->sendResponse($success, 'User register successfully.');

  }

  /**
   * Login The User
   *
   * @author Fokoui Marco Hunterbrightdesign@gmail.com
   * @param \Illuminate\Http\Request $request
   * @return User
   */
  public function login(Request $request) {
    $validateUser = Validator::make(
        $request->all(), [
          'email' => 'required',
          'password' => 'required',
        ]
      );
      if ($validateUser->fails()) {
        return $this->sendError('Vlidation error: '. $validateUser->errors(), 401);
      }

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;

        return $this->sendResponse($success, 'User login successfully.');
    }
    else{
        return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    }
  }

  /**
   * Logout user (Revoke the token)
   *
   * @author Fokoui Marco Hunterbrightdesign@gmail.com
   * @param \Illuminate\Http\Request $request
   * @return [string] message
   */
  public function logout(Request $request) {

    $request->user()->tokens()->delete();

    return $this->sendResponse('Successfully logged out');
  }
}
