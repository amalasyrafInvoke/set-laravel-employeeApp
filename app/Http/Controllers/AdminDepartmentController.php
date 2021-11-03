<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class AdminDepartmentController extends Controller
{
    //
    public function index() {
      $departmentList = Department::get();
      $departmentList = Department::paginate(10);
      return view('admin.department', ['departmentList' => $departmentList]);
    }

    public function edit() {
      return view('admin.departmentEdit');
    }
}
