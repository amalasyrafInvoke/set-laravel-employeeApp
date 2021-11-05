<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\JsonTrait;
use App\Models\User;

class ApiController extends Controller
{
  use JsonTrait;
  //
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    // $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  /**
   * Login API
   * @bodyParam email string required The email of the user. Example: superadmin@invoke.com
   * @bodyParam password string required The password of the user. Example: password
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
      // return response()->json($validator->errors(), 422);
      return $this->jsonResponse(
        $validator->errors(),
        'Invalid Input Parameter',
        422
      );
    }

    if (!$token = Auth::attempt($validator->validated())) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->createNewToken($token);
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    Auth::logout();

    return response()->json(['message' => 'User successfully signed out']);
  }

  /**
   * Refresh a token.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function refresh()
  {
    return $this->createNewToken(Auth::refresh());
  }

  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function userProfile()
  {
    return response()->json(auth()->user());
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function createNewToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => Auth::factory()->getTTL() * 60,
      'user' => auth()->user()
    ]);
  }

  /**
   * Dashboard
   * 
   * The API endpoint for dashboard
   * Route: /dashboard
   * 
   * @authenticated
   * @header Authorization Bearer {{token}}
   * @response 401 scenario = "invalid token"
   * 
   * @return \Illuminate\Http\JsonResponse
   */
  public function dashboard()
  {
    $userCount = DB::table('users')->count();
    $jobCount = DB::table('jobs')->count();
    $deptCount = DB::table('departments')->count();
    $message = 'Successfully retrieve the information';
    $code = 0;
    $data = compact('userCount', 'jobCount', 'deptCount');

    // return response()->json(['userCount' => $userCount,'jobCount' => $jobCount, 'deptCount' => $deptCount, 'message' => 'Successful fetch']);
    // return response()->json(compact('data', 'message', 'code'));

    return $this->jsonSuccessResponse(compact('data', 'message', 'code'), '', 200);
  }

  /**
   * User API
   * 
   * The API endpoint for users by pagination
   * Route: /dashboard
   * 
   * @authenticated
   * @header Authorization Bearer {{token}}
   * @response 401 scenario = "invalid token"
   * 
   * @bodyParam page int Page number for pagination. Example: 1
   * 
   * @return \Illuminate\Http\JsonResponse
   */
  public function users()
  {
    // $users = User::get();
    // $users = User::paginate(10);
    // return response()->json(
    //   compact('users')
    // );

    $users = User::where('id', 2)->first();
    return $this->jsonSuccessResponse(new UserResource($users), 'Successfully retrieve the users');
  }
}
