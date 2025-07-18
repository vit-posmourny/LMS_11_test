<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseLevelController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseLanguageController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\CourseSubCategoryController;

Route::group(["middleware" => "guest", "prefix" => "admin", "as" => "admin."], function () {

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


Route::group(["middleware" => "auth:admin", "prefix" => "admin", "as" => "admin."], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /** Instructor Request Routes **/
    Route::get('instructor-doc-download/{user}', [InstructorRequestController::class, 'download'])
        ->name('instructor-doc-download');

    Route::resource('instructor-request', InstructorRequestController::class);

    /* Course Language Routes */
    Route::resource('course-languages', CourseLanguageController::class);

    /* Course Level Routes */
    Route::resource('course-levels', CourseLevelController::class);

    /* Course Categories Routes */
    Route::resource('course-categories', CourseCategoryController::class);

    Route::get('{course_category}/sub-categories', [CourseSubCategoryController::class, 'index'])
        ->name('sub-categories.index');

    Route::get('{course_category}/sub-categories/create', [CourseSubCategoryController::class, 'create'])
        ->name('sub-categories.create');

    Route::post('{course_category}/sub-categories', [CourseSubCategoryController::class, 'store'])
        ->name('sub-categories.store');

    Route::get('{course_category}/sub-categories/{course_sub_category}/edit', [CourseSubCategoryController::class, 'edit'])
        ->name('sub-categories.edit');

    Route::put('{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'update'])
        ->name('sub-categories.update');

    Route::delete('{course_category}/sub-categories/{course_sub_category}', [CourseSubCategoryController::class, 'destroy'])
        ->name('sub-categories.delete');
});
