<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class AdminController extends Controller
{
  //
  public function index(Request $request)
  {
    if ($request->isMethod('POST')) {
      $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {
        if (Auth::user()->role === 1) {
          $request->session()->regenerate();
          $jwt_token = JWTAuth::attempt($credentials);
          session(['jwt_token' => $jwt_token]);
          return redirect()->route('admin.dashboard');
        }
      }

      return back()->withErrors(
        [
          'email' => 'The provided credentials do not match our records',
        ]
      );
    }

    return view('admin.login');

    // if (Auth::check()) {
    //   return redirect()->route('admin.dashboard');
    // } else {
    //   return view('admin.login');
    // }

  }

  public function logout()
  {
    if (Auth::check()) {
      Auth::logout();
    }
    return redirect()->route('admin.login');
  }

  public function dashboard()
  {
    $jwt_token = session('jwt_token');
    $userCount = DB::table('users')->count();
    $jobCount = DB::table('jobs')->count();
    $deptCount = DB::table('departments')->count();

    return view('admin.dashboard', compact('userCount', 'jobCount', 'deptCount', 'jwt_token'));
    // if (Auth::check()) {
    //   $userCount = DB::table('users')->count();
    //   $jobCount = DB::table('jobs')->count();
    //   $deptCount = DB::table('departments')->count();
    // return view('admin.dashboard', compact('userCount', 'jobCount', 'deptCount', 'jwt_token'));
    // } else {
    //   return redirect()->route('admin.login');
    // }
  }
}
