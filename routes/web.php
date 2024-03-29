<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDepartmentController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminUserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});
Route::prefix('admin')->group(function () {
  Route::any('login', [AdminController::class, 'index'])->name('admin.login');

  Route::group(['middleware' => 'auth'], function () {
    Route::any('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::any('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::any('userList', [AdminUserController::class, 'index'])->name('admin.user');
    Route::any('userList/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.userEdit');
    Route::any('userList/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.userDelete');
    Route::any('jobList', [AdminJobController::class, 'index'])->name('admin.job');
    Route::any('jobList/edit/{id}', [AdminJobController::class, 'edit'])->name('admin.jobEdit');
    Route::any('jobList/delete/{id}', [AdminJobController::class, 'delete'])->name('admin.jobDelete');
    Route::any('departmentList', [AdminDepartmentController::class, 'index'])->name('admin.department');
    Route::any('departmentList/edit/{id}', [AdminDepartmentController::class, 'edit'])->name('admin.departmentEdit');
    Route::any('departmentList/delete/{id}', [AdminDepartmentController::class, 'delete'])->name('admin.departmentDelete');
  });
});

Route::get('queue-email', function () {

  $email_list['email'] = 'capri.mal11@gmail.com';
  $user = User::whereId(2)->first();
  $email_list['user'] = $user;

  dispatch(new \App\Jobs\QueueJob($email_list));

  dd('Send Email Successfully');
});

Route::post('create-user', function () {
  $user = new User();
  $user->name = 'Amaluddin';
  $user->email = 'capri.mal11@gmail.com';
  $user->password = bcrypt('password');
  $user->save();

  return response()->json('user created');
});
