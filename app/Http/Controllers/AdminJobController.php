<?php

namespace App\Http\Controllers;

use App\Models\EmployeeJob;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
  //
  public function index()
  {
    $jobList = EmployeeJob::get();
    $jobList = EmployeeJob::paginate(10);
    return view('admin.job', ['jobList' => $jobList]);
  }

  public function edit(Request $request)
  {
    $job = EmployeeJob::where("id", $request->id)->first();

    if ($request->isMethod('POST')) {
      $forms = $request->validate([
        'title' => ['required'],
        'description' => ['required'],
      ]);

      $job->title = $request->title;
      $job->description = $request->description;
      $job->save();
      $status = "Record $job->id updated";
      return redirect()->route('admin.job');
    }
    return view('admin.jobEdit', compact('job'));
  }

  public function delete(Request $request)
  {
    $job = EmployeeJob::where("id", $request->id)->first();
    $job->delete();
    return redirect()->route('admin.job');
  }
}
