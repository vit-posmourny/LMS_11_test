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



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';