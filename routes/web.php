<?php

use App\Http\Controllers\Dashboard\Categories\CollageController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\Categories\SpacializationController;
use App\Http\Controllers\Dashboard\Courses\CourseAnswerController;
use App\Http\Controllers\Dashboard\Courses\CourseController;
use App\Http\Controllers\Dashboard\Courses\CourseQuestionController;
use App\Http\Controllers\Dashboard\DashController;
use App\Http\Controllers\Dashboard\National\NationalAnswerController;
use App\Http\Controllers\Dashboard\National\NationalQuestionController;
use App\Http\Controllers\Dashboard\NotificationContentController;
use App\Http\Controllers\Dashboard\SliderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|->middleware(['auth','chekUser:admin'])
*/


Route::prefix('dash/')->group(function () {
    Route::get('/', [DashController::class, 'index'])->name("dash.index");
    Route::resource('category', CategoryController::class);
    Route::get('Softcategories', [CategoryController::class, 'showsoft'])->name('category.soft');
    Route::get('category/finldelete/{id}', [CategoryController::class, 'finaldelete'])->name('category.finaldelete');
    Route::get('category/restore/{id}', [CategoryController::class, 'restor'])->name('category.restore');

    Route::resource('collage', CollageController::class);
    Route::get('Softcollages', [CollageController::class, 'showsoft'])->name('collage.soft');
    Route::get('collage/finldelete/{id}', [CollageController::class, 'finaldelete'])->name('collage.finaldelete');
    Route::get('collage/restore/{id}', [CollageController::class, 'restor'])->name('collage.restore');

    Route::resource('specialization', SpacializationController::class);
    Route::get('Softspecializations', [SpacializationController::class, 'showsoft'])->name('specialization.soft');
    Route::get('specialization/finldelete/{id}', [SpacializationController::class, 'finaldelete'])->name('specialization.finaldelete');
    Route::get('specialization/restore/{id}', [SpacializationController::class, 'restor'])->name('specialization.restore');

    Route::resource('courseAnswers', CourseAnswerController::class);
    Route::get('SoftcourseAnswers', [CourseAnswerController::class, 'showsoft'])->name('courseAnswers.soft');
    Route::get('courseAnswers/finldelete/{id}', [CourseAnswerController::class, 'finaldelete'])->name('courseAnswers.finaldelete');
    Route::get('courseAnswers/restore/{id}', [CourseAnswerController::class, 'restor'])->name('courseAnswers.restore');

    Route::resource('courseQuestion', CourseQuestionController::class);
    Route::get('SoftcourseQuestions', [CourseQuestionController::class, 'showsoft'])->name('courseQuestion.soft');
    Route::get('courseQuestion/finldelete/{id}', [CourseQuestionController::class, 'finaldelete'])->name('courseQuestion.finaldelete');
    Route::get('courseQuestion/restore/{id}', [CourseQuestionController::class, 'restor'])->name('courseQuestion.restore');

    Route::resource('nationalQuestion', NationalQuestionController::class);
    Route::get('SoftnationalQuestions', [NationalQuestionController::class, 'showsoft'])->name('nationalQuestion.soft');
    Route::get('nationalQuestion/finldelete/{id}', [NationalQuestionController::class, 'finaldelete'])->name('nationalQuestion.finaldelete');
    Route::get('nationalQuestion/restore/{id}', [NationalQuestionController::class, 'restor'])->name('nationalQuestion.restore');

    Route::resource('nationalAnswer', NationalAnswerController::class);
    Route::get('SoftnationalAnswers', [NationalAnswerController::class, 'showsoft'])->name('nationalAnswer.soft');
    Route::get('nationalAnswer/finldelete/{id}', [NationalAnswerController::class, 'finaldelete'])->name('nationalAnswer.finaldelete');
    Route::get('nationalAnswer/restore/{id}', [NationalAnswerController::class, 'restor'])->name('nationalAnswer.restore');

    Route::resource('course', CourseController::class);
    Route::get('Softcourses', [CourseController::class, 'showsoft'])->name('course.soft');
    Route::get('course/finldelete/{id}', [CourseController::class, 'finaldelete'])->name('course.finaldelete');
    Route::get('course/restore/{id}', [CourseController::class, 'restor'])->name('course.restore');

    Route::resource('notification', NotificationContentController::class);
    Route::get('Softnotifications', [NotificationContentController::class, 'showsoft'])->name('notification.soft');
    Route::get('notification/finldelete/{id}', [NotificationContentController::class, 'finaldelete'])->name('notification.finaldelete');
    Route::get('notification/restore/{id}', [NotificationContentController::class, 'restor'])->name('notification.restore');

    Route::resource('slider', SliderController::class);
    Route::get('Softsliders', [SliderController::class, 'showsoft'])->name('slider.soft');
    Route::get('slider/finldelete/{id}', [SliderController::class, 'finaldelete'])->name('slider.finaldelete');
    Route::get('slider/restore/{id}', [SliderController::class, 'restor'])->name('slider.restore');
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
