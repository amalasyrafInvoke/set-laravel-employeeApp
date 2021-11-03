<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function index() {
      $userList = User::get();
      $userList = User::paginate(10);
      return view('admin.user', ['userList' => $userList]);
    }

    public function edit() {
      return view('admin.userEdit');
    }
}
