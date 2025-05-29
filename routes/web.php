<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\InstructorDashboardContoller;


/*
*-----------------------------------------------------------------
*   Frontend Routes
*-----------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('home');
/*
*-----------------------------------------------------------------
*   Student Routes
*-----------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified'], 'prefix' => 'student', 'as' => 'student.'], function() {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
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
