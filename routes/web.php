<?php

use App\Http\Controllers\Admin\CertificateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WithdrawController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\EnrolledCourseController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\InstructorDashboardContoller;

/*
*-----------------------------------------------------------------
*   Frontend Routes
*-----------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/courses',[CoursePageController::class, 'index'])
    ->name('courses.index');
Route::get('/courses/{slug}', [CoursePageController::class, 'show'])
    ->name('courses.show');
/* Cart Routes */
Route::get('cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post('add-to-cart/{courseId}', [CartController::class, 'addToCart'])
    ->name('add-to-cart');
Route::get('remove-from-cart/{itemId}', [CartController::class, 'removeFromCart'])
    ->name('remove-from-cart');
/** Payment Routes */
Route::get('checkout', CheckoutController::class)
    ->name('checkout.index');
Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])
    ->name('paypal.payment');
Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])
    ->name('paypal.success');
Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])
    ->name('paypal.cancel');

Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])
    ->name('stripe.payment');
Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])
    ->name('stripe.success');
Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])
    ->name('stripe.cancel');

Route::get('razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])
    ->name('razorpay.redirect');
Route::post('razorpay/payment', [PaymentController::class, 'payWithrazorpay'])
    ->name('razorpay.payment');

Route::get('order-success', [PaymentController::class, 'orderSuccess'])
    ->name('order-success');
Route::get('order-failed', [PaymentController::class, 'orderFailed'])
    ->name('order-failed');
/*
*-----------------------------------------------------------------
*   Student Routes
*-----------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function()
{
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

    /** Enrolled Courses Routes */
    Route::get('enrolled-courses', [EnrolledCourseController::class, 'index'])
        ->name('enrolled-courses.index');
    Route::get('enrolled-courses/player/{slug}', [EnrolledCourseController::class, 'playerIndex'])
        ->name('player.index');
    Route::get('get-lesson-content', [EnrolledCourseController::class, 'getLessonContent'])
        ->name('get-lesson-content');
    Route::post('update-watch-history', [EnrolledCourseController::class, 'updateWatchHistory'])
        ->name('update-watch-history');
    Route::post('update-lesson-completion', [EnrolledCourseController::class, 'updateLessonCompletion'])
        ->name('update-lesson-completion');
    Route::get('file-download/{id}', [EnrolledCourseController::class, 'fileDownload'])
        ->name('file-download');

    /** Certificate Routes */
    Route::get('certificate/{course}/download', [CertificateController::class, 'download'])
        ->name('certificate.download');
});
/*
*-----------------------------------------------------------------
*   Instructor Routes
*-----------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:web', 'verified', 'check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function()
{
    Route::get('dashboard', [InstructorDashboardContoller::class, 'index'])->name('dashboard');

    /* Profile Routes */
    Route::get('profile', [ProfileController::class, 'instructorIndex'])
        ->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])
        ->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])
        ->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])
        ->name('profile.update-social');
    Route::post('profile/update-gateway-info', [ProfileController::class, 'updateGatewayInfo'])
        ->name('profile.update-gateway-info');

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

    /** Sort Chapters */
    Route::get('courses/content/{courseId}/sort-chapter', [CourseContentController::class, 'sortChapter'])
        ->name('content.sort-chapter');
    Route::POST('courses/content/{courseId}/sort-chapter', [CourseContentController::class, 'updateSortChapter'])
        ->name('content.update-sort-chapter');

    /** Orders Routes */
    Route::get('orders', [OrderController::class, 'index'])
        ->name('orders.index');

    /** Withdrawal Routes */
    Route::get('withdrawals', [WithdrawController::class, 'index'])
        ->name('withdraw.index');
    Route::get('withdrawals/request-payout', [WithdrawController::class, 'requestPayoutIndex'])
        ->name('withdraw.request-payout.index');
    Route::post('withdrawals/request-payout', [WithdrawController::class, 'requestPayout'])
        ->name('withdraw.request-payout');
});


/** lfm routes */
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
