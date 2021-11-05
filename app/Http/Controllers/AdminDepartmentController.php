<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class AdminDepartmentController extends Controller
{
  //
  public function index()
  {
    $departmentList = Department::get();
    $departmentList = Department::paginate(10);
    return view('admin.department', ['departmentList' => $departmentList]);
  }

  public function edit(Request $request)
  {
    $dept = Department::where("id", $request->id)->first();

    if ($request->isMethod('POST')) {
      $forms = $request->validate([
        'name' => ['required'],
      ]);

      $dept->name = $request->name;
      $dept->save();
      $status = "Record $dept->id updated";
      return redirect()->route('admin.department');
    }
    return view('admin.departmentEdit', compact('dept'));
  }

  public function delete(Request $request)
  {
    $dept = Department::where("id", $request->id)->first();
    $dept->delete();
    return redirect()->route('admin.department');
  }
}
