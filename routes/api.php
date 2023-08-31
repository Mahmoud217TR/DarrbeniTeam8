<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\CodeController;
use App\Http\Controllers\Api\Auth\FavoriteController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\BankQuestionController;
use App\Http\Controllers\Api\Categories\CategoryController;
use App\Http\Controllers\Api\Categories\CollageController;
use App\Http\Controllers\Api\Categories\SpacializationController;
use App\Http\Controllers\Api\ComplaintsController;
use App\Http\Controllers\Api\Courses\CourseAnswerController;
use App\Http\Controllers\Api\Courses\CourseAnswerQuestionController;
use App\Http\Controllers\Api\Courses\CourseController;
use App\Http\Controllers\Api\Courses\CourseQuestionController;
use App\Http\Controllers\Api\National\NationalAnswerController;
use App\Http\Controllers\Api\National\NationalQuestionController;
use App\Http\Controllers\Api\NotificationContentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\Api\Roles\RoleController;
use App\Http\Controllers\Api\Roles\RoleUserController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\SliderController;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});


Route::group([

], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    
    Route::get('slider', [SliderController::class,'index']);
    Route::get('slider/show/{id}', [SliderController::class,'show']);

    Route::get('aboutus',[AboutUsController::class,'index']);
    Route::get('aboutus/show/{id}',[AboutUsController::class,'show']);

    Route::get('category',[CategoryController::class, 'index']);
    Route::get('/category/show/{id}', [CategoryController::class, 'show']);
    Route::get('/category/all', [CategoryController::class, 'getAll']);
    
    Route::get('collage', [CollageController::class, 'index']);







    ////////////////////   Have Auth    ////////////////////////

    Route::middleware('auth:sanctum')->group(function () {
            Route::get('/logout',[AuthController::class, 'logout']);

            Route::get('profile',[ProfileController::class, 'show']);
            Route::put('profile/edit',[ProfileController::class, 'update']);

            Route::post('complaints/create',[ComplaintsController::class,'store']);
            Route::get('complaints/mycomplaint',[ComplaintsController::class,'MyComplaint']);


            Route::get('collage/show/{id}', [CollageController::class, 'show']);

            Route::get('spacialization', [SpacializationController::class, 'index']);
            Route::get('spacialization/show/{id}', [SpacializationController::class, 'show']);

            Route::get('course',[CourseController::class, 'index']);
            Route::get('course/show/{id}',[CourseController::class, 'show']);
            
            Route::get('favorite',[FavoriteController::class,'index']);
            Route::post('favorite/create',[FavoriteController::class,'store']);
            Route::get('favorite/show/{id}',[FavoriteController::class,'show']);
            Route::get('favorite/delete/{id}',[FavoriteController::class,'destroy']);

            Route::get('/notifications', [NotificationContentController::class, 'getUserNotifications']);

            Route::get('NationalQuestion/date/{id}',[NationalQuestionController::class,'date']);
            Route::post('/NationalQuestion/date/{id}', [NationalQuestionController::class, 'showAllDate']);

            Route::get('/NationalQuestion', [NationalQuestionController::class, 'indexAll']);
            Route::get('/NationalQuestion/{id}', [NationalQuestionController::class, 'showAll']);
            Route::get('/NationalQuestionCourse/{id}', [NationalQuestionController::class, 'showAllCourse']);
        
            Route::get('/courseQuestion', [CourseAnswerQuestionController::class, 'index']);
            Route::get('/courseQuestion/show/all/{id}', [CourseAnswerQuestionController::class, 'showAll']);
            Route::get('/courseQuestion/show/{id}', [CourseAnswerQuestionController::class, 'show']);
        
            Route::get('Bank/{id}',[BankQuestionController::class,'show']);
            Route::post('score',[ScoreController::class,'show']);
            Route::get('reference/show/{id}',[ReferenceController::class, 'show']);

         

    });    
    


});









// *******************************************************
// *****************Dashboard****************************
// *********************************************************
Route::group([
    'middleware' => ['auth:sanctum', 'chekUser:admin'],

    'prefix' => 'admin'
], function () {
    ////////////////////////      complaints /  ///////////////////////////////////////// 
    Route::post('complaints/edit/{id}',[ComplaintsController::class,'update']);
    Route::get('complaints/delete/{id}',[ComplaintsController::class,'destroy']);

    Route::get('spacialization/trush', [ComplaintsController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [ComplaintsController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [ComplaintsController::class, 'foreceDelete']); 

///////////////////////////////   Role   ////////////////////////////////////////////////
    Route::resource('/roles', RoleController::class);
    Route::resource('/rolesUser', RoleUserController::class);

    ///////////////////////////////////      slider         ///////////////////////
    Route::post('slider/create', [SliderController::class,'store']);
    Route::post('slider/edit/{id}', [SliderController::class,'update']);
    Route::get('slider/delete/{id}', [SliderController::class,'destroy']);


    ////////////////////////////  course   /////////////////////////////////
    Route::post('/course/create',[ CourseController::class, 'store']);
    Route::post('/course/edit/{id}',[ CourseController::class, 'update']);
    Route::get('/course/delete/{id}',[ CourseController::class, 'destroy']);

    Route::get('spacialization/trush', [CourseController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [CourseController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [CourseController::class, 'foreceDelete']); 

    ///////////////////////////////////////
    Route::resource('/courseanswer', CourseAnswerController::class);
    Route::get('/courseanswer/show/{id}', [CourseAnswerController::class,'show']);
    Route::get('/courseanswer/delete/{id}', [CourseAnswerController::class,'destroy']);
    Route::post('/courseanswer/edit/{id}', [CourseAnswerController::class,'update']);
    Route::post('/courseanswer/create', [CourseAnswerController::class,'store']);


    Route::resource('/coursequestion', CourseQuestionController::class);
    Route::get('/coursequestion/show/{id}', [CourseQuestionController::class,'show']);
    Route::get('/coursequestion/delete/{id}', [CourseQuestionController::class,'destroy']);
    Route::post('/coursequestion/edit/{id}', [CourseQuestionController::class,'update']);
    Route::post('/coursequestion/create', [CourseQuestionController::class,'store']);

    Route::get('spacialization/trush', [CourseQuestionController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [CourseQuestionController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [CourseQuestionController::class, 'foreceDelete']); 



    //////////////// profile  //////////////////////
    Route::get('profile',[ProfileController::class, 'index']);
    Route::get('profile/show/{id}',[ProfileController::class, 'showAdmin']);
    Route::get('profile/delete/{id}',[ProfileController::class, 'destroy']);
    
    ///////////////   category /////////////////
    Route::post('category/create', [CategoryController::class, 'store']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('spacialization/trush', [CategoryController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [CategoryController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [CategoryController::class, 'foreceDelete']); 

    //////////////  Collage //////////////////
    Route::get('collage/delete/{id}', [CollageController::class, 'destroy']);
    Route::post('collage/create', [CollageController::class, 'store']);
    Route::post('collage/update/{id}', [CollageController::class, 'update']);

    Route::get('spacialization/trush', [CollageController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [CollageController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [CollageController::class, 'foreceDelete']); 

    //////////////  Spacialization //////////////////
    Route::post('spacialization/create', [SpacializationController::class, 'store']);
    Route::put('spacialization/edit/{id}', [SpacializationController::class, 'update']);
    Route::get('spacialization/delete/{id}', [SpacializationController::class, 'destroy']);

    Route::get('spacialization/trush', [SpacializationController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [SpacializationController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [SpacializationController::class, 'foreceDelete']); 
   

 //////////////////////////// About   Us  ///////////////////////////////////////
    Route::post('aboutus/create',[AboutUsController::class,'store']);
    Route::put('aboutus/edit/{id}',[AboutUsController::class,'update']);
    Route::get('aboutus/delete/{id}',[AboutUsController::class,'destroy']);


    Route::post('/notification', [NotificationContentController::class, 'sendNotification']);

    Route::get('/courseAnswer',[ CourseAnswerController::class, 'index']);

    Route::get('reference',[ReferenceController::class, 'index']);

    Route::get('complaints',[ComplaintsController::class,'index']);
    Route::get('complaints/show/{id}',[ComplaintsController::class,'show']);



    Route::post('NationalQuestion/create',[NationalQuestionController::class,'store']);
    Route::post('NationalQuestion/edit/{id}',[NationalQuestionController::class,'update']);

    Route::get('spacialization/trush', [NationalQuestionController::class, 'showTrash']);
    Route::get('spacialization/restore/{id}', [NationalQuestionController::class, 'restore']); 
    Route::get('spacialization/forcedelete/{id}', [NationalQuestionController::class, 'foreceDelete']); 

    
});


