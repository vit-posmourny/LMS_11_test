<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\InstructorDashboardContoller;

Route::get('/', function () {
    return view('welcome');
});

/*
*-----------------------------------------------------------------
*   Student Routes
*-----------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function() {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});


/*
*-----------------------------------------------------------------
*   Student Routes
*-----------------------------------------------------------------
*/

Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function() {
    Route::get('/dashboard', [InstructorDashboardContoller::class, 'index'])->name('dashboard');
});


// must be middleware(['auth:admin',...]) here, for an admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';