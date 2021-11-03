<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    //
    public function index() {
      $jobList = Job::get();
      $jobList = Job::paginate(10);
      return view('admin.job', ['jobList' => $jobList]);
    }

    public function edit() {
      return view('admin.jobEdit');
    }
}
