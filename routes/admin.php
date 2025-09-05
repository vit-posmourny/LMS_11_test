<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseLevelController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseLanguageController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\CourseSubCategoryController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PayoutGatewayController;
use App\Http\Controllers\Admin\SettingController;

Route::group(["middleware" => "guest", "prefix" => "admin", "as" => "admin."], function ()
{
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


Route::group(["middleware" => "auth:admin", "prefix" => "admin", "as" => "admin."], function ()
{
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

    /** Course Module Routes */
    Route::get('courses', [CourseController::class, 'index'])
        ->name('courses.index');
    Route::put('courses/{course}/update-approval', [CourseController::class, 'updateApproval'])
        ->name('courses.update-approval');

    Route::get('courses/create', [CourseController::class, 'create'])
        ->name('courses.create');
    Route::post('courses/create', [CourseController::class, 'storeBasicInfo'])
        ->name('courses.store-basic-info');
    Route::get('courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('courses.edit');
    Route::post('courses/update', [CourseController::class, 'update'])
        ->name('courses.update');

    /** Chapter Routes */
    Route::get('courses/content/{courseId}/create-chapter', [CourseContentController::class, 'createChapterModal'])
        ->name('content.create-chapter');
    Route::post('courses/content/{courseId}/create-chapter', [CourseContentController::class, 'storeChapter'])
        ->name('content.store-chapter');
    Route::get('courses/content/{chapterId}/edit-chapter', [CourseContentController::class, 'editChapterModal'])
        ->name('content.edit-chapter');
    Route::post('courses/content/{chapterId}/update-chapter', [CourseContentController::class, 'updateChapterModal'])
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


    /** Sort Chapters */
    Route::get('courses/content/{courseId}/sort-chapter', [CourseContentController::class, 'sortChapter'])
        ->name('content.sort-chapter');
    Route::POST('courses/content/{courseId}/sort-chapter', [CourseContentController::class, 'updateSortChapter'])
        ->name('content.update-sort-chapter');

    /** Order Routes */
    Route::get('orders', [OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    /** Payment settings routes */
    Route::get('payment-setting', [PaymentSettingController::class, 'index'])
        ->name('payment-setting.index');
    Route::post('paypal-setting', [PaymentSettingController::class, 'paypalSetting'])
        ->name('paypal-setting.update');
    Route::post('stripe-setting', [PaymentSettingController::class, 'stripeSetting'])
        ->name('stripe-setting.update');
    Route::post('razorpay-setting', [PaymentSettingController::class, 'razorpaySetting'])
        ->name('razorpay-setting.update');

    /** Site Settings Route */
    Route::get('settings', [SettingController::class, 'index'])
        ->name('settings.main');
    Route::post('main-settings', [SettingController::class, 'updateMainSettings'])
        ->name('main-settings.update');
    Route::get('commission-settings', [SettingController::class, 'commissionSettingsIndex'])
        ->name('commission-settings.index');
    Route::post('commission-settings', [SettingController::class, 'commissionSettingsUpdate'])
        ->name('commission-settings.update');

    /** Payout Gateway Routes */
    Route::resource('payout-gateway', PayoutGatewayController::class);

    /** lfm routes */
    Route::group(['prefix' => '/admin/laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});


