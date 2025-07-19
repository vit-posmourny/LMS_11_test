<?php

use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\InstructorDashboardContoller;
use App\Http\Controllers\Frontend\ProfileController;

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
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function() {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])
        ->name('become-instructor');
    Route::post('/become-instructor/{user}', [StudentDashboardController::class, 'becomeInstructorUpdate'])
        ->name('become-instructor.update');

    /* Profile Routes */
    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])
        ->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])
        ->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])
        ->name('profile.update-social');
});
/*
*-----------------------------------------------------------------
*   Instructor Routes
*-----------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function() {
    Route::get('/dashboard', [InstructorDashboardContoller::class, 'index'])->name('dashboard');

    /* Profile Routes */
    Route::get('profile', [ProfileController::class, 'instructorIndex'])
        ->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])
        ->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])
        ->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])
        ->name('profile.update-social');

    /** Course Routes */
    Route::get('courses', [CourseController::class, 'index'])
        ->name('courses.index');
    Route::get('courses/create', [CourseController::class, 'create'])
        ->name('courses.create');
    Route::post('courses/create', [CourseController::class, 'storeBasicInfo'])
        ->name('courses.store-basic-info');
    Route::get('courses/{id}/edit', [CourseController::class, 'edit'])
        ->name('courses.edit');
    Route::post('courses/update', [CourseController::class, 'update'])
        ->name('courses.update');
    /** Chapter Routes */
    Route::get('courses/content/{courseId}/create-chapter', [CourseContentController::class, 'createChapterModal'])
        ->name('content.create-chapter');
    Route::post('courses/content/{course}/create-chapter', [CourseContentController::class, 'storeChapter'])
        ->name('content.store-chapter');
    Route::get('courses/content/{chapterId}/edit-chapter', [CourseContentController::class, 'editChapterModal'])
        ->name('content.edit-chapter');
    Route::put('courses/content/{chapterId}/update-chapter', [CourseContentController::class, 'updateChapterModal'])
        ->name('content.update-chapter');
    Route::delete('courses/content/{chapterId}/delete-chapter', [CourseContentController::class, 'destroyChapterModal'])
        ->name('content.delete-chapter');
    /** Lesson Routes */
    Route::get('courses/content/create-lesson', [CourseContentController::class, 'createLesson'])
        ->name('content.create-lesson');
    Route::post('courses/content/store-lesson', [CourseContentController::class, 'storeLesson'])
        ->name('content.store-lesson');
    Route::get('courses/content/edit-lesson', [CourseContentController::class, 'editLesson'])
        ->name('content.edit-lesson');
    Route::post('courses/content/{id}/update-lesson', [CourseContentController::class, 'updateLesson'])
        ->name('content.update-lesson');
    Route::delete('courses/content/{id}/lesson', [CourseContentController::class, 'destroyLesson'])
        ->name('content.destroy-lesson');
    /** Sorting Lessons */
    Route::post('courses/chapter/{chapterId}/sort-lesson', [CourseContentController::class, 'sortLesson'])
        ->name('chapter.sort-lesson');
});

    /** lfm routes */
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
