<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
  //
  public function index()
  {
    $userList = User::get();
    $userList = User::paginate(10);
    return view('admin.user', ['userList' => $userList]);
  }

  public function edit(Request $request)
  {
    $user = User::where("id", $request->id)->first();

    if ($request->isMethod('POST')) {
      $forms = $request->validate([
        'name' => ['required'],
      ]);

      $user->name = $request->name;
      $user->save();
      $status = "Record $user->id updated";
      return redirect()->route('admin.user');
    }
    return view('admin.userEdit', compact('user'));
  }

  public function delete(Request $request) {
    $user = User::where("id", $request->id)->first();
    $user->delete();
    return redirect()->route('admin.user');
  }
}
