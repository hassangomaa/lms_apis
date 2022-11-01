<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AdminsController;
use App\Http\Controllers\Api\BatchsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CerticationsController;
use App\Http\Controllers\Api\FeedbacksController;
use App\Http\Controllers\Api\LessonsController;
use App\Http\Controllers\Api\ModulesController;
use App\Http\Controllers\Api\StaffsController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\UsersController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/table.php';


/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your Api!
|
*/

//all routes / Api here must be Api authenticated
//Route::group(['middleware' => ['Api'], 'namespace' => 'Api'], function () {

//    Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){

        Route::post('login', [AuthController::class,'login']);

        Route::group(['prefix' => 'admin'],function (){

            Route::get('show', [AdminsController::class,'index']);
            Route::post('store', [AdminsController::class,'store']);
            Route::post('update', [AdminsController::class,'update']);
            Route::post('destroy', [AdminsController::class,'destroy']);

        });

        Route::group(['prefix' => 'course'],function (){

            Route::get('show', [CourseController::class,'getAllCourses']);
            Route::post('store', [CourseController::class,'store']);
            Route::post('update', [CourseController::class,'update']);
            Route::post('destroy', [CourseController::class,'destroy']);

        });

        Route::group(['prefix' => 'batch'],function (){
            Route::post('show', [BatchsController::class,'index']);
            Route::post('store', [BatchsController::class,'store']);
            Route::post('update', [BatchsController::class,'update']);
            Route::post('destroy', [BatchsController::class,'destroy']);
        });

        Route::group(['prefix' => 'category'],function (){
            Route::post('show', [CategoriesController::class,'index']);
            Route::post('store', [CategoriesController::class,'store']);
            Route::post('update', [CategoriesController::class,'update']);
            Route::post('destroy', [CategoriesController::class,'destroy']);
        });

        Route::group(['prefix' => 'certification'],function (){
            Route::post('show', [CerticationsController::class,'index']);
            Route::post('store', [CerticationsController::class,'store']);
            Route::post('update', [CerticationsController::class,'update']);
            Route::post('destroy', [CerticationsController::class,'destroy']);
        });

        Route::group(['prefix' => 'feedback'],function (){
            Route::post('show', [FeedbacksController::class,'index']);
            Route::post('store', [FeedbacksController::class,'store']);
            Route::post('update', [FeedbacksController::class,'update']);
            Route::post('destroy', [FeedbacksController::class,'destroy']);
        });

        Route::group(['prefix' => 'lesson'],function (){
            Route::post('show', [LessonsController::class,'index']);
            Route::post('store', [LessonsController::class,'store']);
            Route::post('update', [LessonsController::class,'update']);
            Route::post('destroy', [LessonsController::class,'destroy']);
        });

        Route::group(['prefix' => 'module'],function (){
            Route::post('show', [ModulesController::class,'index']);
            Route::post('store', [ModulesController::class,'store']);
            Route::post('update', [ModulesController::class,'update']);
            Route::post('destroy', [ModulesController::class,'destroy']);
        });

        Route::group(['prefix' => 'staff'],function (){
            Route::post('show', [StaffsController::class,'index']);
            Route::post('store', [StaffsController::class,'store']);
            Route::post('update', [StaffsController::class,'update']);
            Route::post('destroy', [StaffsController::class,'destroy']);
        });

        Route::group(['prefix' => 'student'],function (){
            Route::post('show', [StudentsController::class,'index']);
            Route::post('store', [StudentsController::class,'store']);
            Route::post('update', [StudentsController::class,'update']);
            Route::post('destroy', [StudentsController::class,'destroy']);
        });

        Route::group(['prefix' => 'user'],function (){
            Route::post('show', [UsersController::class,'index']);
            Route::post('store', [UsersController::class,'store']);
            Route::post('update', [UsersController::class,'update']);
            Route::post('destroy', [UsersController::class,'destroy']);
//        });
//    });

    Route::post('logout',[AuthController::class,'logout']) -> middleware(['auth.guard:admin-Api']);

    Route::group(['prefix' => 'user','namespace'=>'User'],function (){

        Route::post('login','App\Http\Controllers\Api\User\AuthController@login');

        Route::group(['prefix' => 'course'],function (){

            Route::post('show', [CourseController::class,'index']);

        });

        Route::group(['prefix' => 'batch'],function (){
            Route::post('show', [BatchsController::class,'index']);
        });

        Route::group(['prefix' => 'category'],function (){
            Route::post('show', [CategoriesController::class,'index']);
        });

        Route::group(['prefix' => 'certification'],function (){
            Route::post('show', [CerticationsController::class,'index']);
        });

        Route::group(['prefix' => 'feedback'],function (){
            Route::post('show', [FeedbacksController::class,'index']);
        });

        Route::group(['prefix' => 'lesson'],function (){
            Route::post('show', [LessonsController::class,'index']);
        });

        Route::group(['prefix' => 'module'],function (){
            Route::post('show', [ModulesController::class,'index']);
        });

        Route::group(['prefix' => 'staff'],function (){
            Route::post('show', [StaffsController::class,'index']);
        });

        Route::group(['prefix' => 'student'],function (){
            Route::post('show', [StudentsController::class,'index']);
        });

        Route::group(['prefix' => 'user'],function (){
            Route::post('show', [UsersController::class,'index']);
        });

        Route::post('logout','App\Http\Controllers\Api\User\AuthController@logout') -> middleware(['auth.guard:user-Api']);
    });
});



Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Api'], function () {
});


Route::group([
    'namespace' => 'Api'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('social-login', 'AuthController@socialLogin');
    Route::post('signup', 'AuthController@signup');
    Route::post('set-fcm-token', 'AuthController@setFcmToken');

    Route::get('get-lang', 'AuthController@getLang');


    //CourseApiController
    Route::get('/get-all-courses', 'CourseApiController@getAllCourses');
    Route::get('/get-all-classes', 'CourseApiController@getAllClasses');
    Route::get('/get-all-quizzes', 'CourseApiController@getAllQuizzes');
    Route::get('/get-popular-courses', 'CourseApiController@getPopularCourses');
    Route::get('/get-popular-classes', 'CourseApiController@getPopularClasses');
    Route::get('/get-course-details/{id}', 'CourseApiController@getCourseDetails');
    Route::get('/get-class-details/{id}', 'CourseApiController@getClassDetails');
    Route::get('/get-quiz-details/{id}', 'CourseApiController@getQuizDetails');
    Route::get('/get-lesson-quiz-details/{id}', 'CourseApiController@getLessonQuizDetails');
    Route::get('/top-categories', 'CourseApiController@topCategories');
    Route::get('/search-course', 'CourseApiController@searchCourse');
    Route::get('/filter-course', 'CourseApiController@filterCourse');
    Route::get('/payment-gateways', 'WebsiteApiController@paymentGateways');

    Route::get('categories', 'CourseApiController@categories');
    Route::get('sub-categories/{category_id}', 'CourseApiController@subCategories');
    Route::get('levels', 'CourseApiController@levels');
    Route::get('languages', 'CourseApiController@languages');


    Route::group([
        'middleware' => ['auth:api', 'verified']
    ], function () {
        //with login routes

        Route::post('set-lang', 'AuthController@setLang');

        Route::any('lesson-complete', 'WebsiteApiController@lessonComplete')->name('lesson.complete');


        Route::get('/get-bbb-start-url/{meeting_id}/{user_name}', 'WebsiteApiController@getBbbMeetingUrl');

        Route::get('/cart-list', 'WebsiteApiController@cartList');
        Route::get('/add-to-cart/{id}', 'WebsiteApiController@addToCart');
        Route::get('/remove-to-cart/{id}', 'WebsiteApiController@removeCart');
        Route::post('/apply-coupon', 'WebsiteApiController@applyCoupon');

        //AuthController
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('change-password', 'AuthController@changePassword');
        Route::post('/update-profile', 'WebsiteApiController@updateProfile');


        //WebsiteApiController

        Route::get('/countries', 'WebsiteApiController@countries');
        Route::get('/states/{country_id}', 'WebsiteApiController@states');
        Route::get('/cities/{state_id}', 'WebsiteApiController@cities');
        Route::get('/my-courses', 'WebsiteApiController@myCourses');
        Route::get('/my-quizzes', 'WebsiteApiController@myQuizzes');
        Route::get('/my-classes', 'WebsiteApiController@myClasses');
        Route::post('/submit-review', 'WebsiteApiController@submitReview');
        Route::post('/comment', 'WebsiteApiController@comment');
        Route::post('/comment-reply', 'WebsiteApiController@commentReply');
        Route::get('/payment-methods', 'WebsiteApiController@paymentMethods');

        Route::post('/make-order', 'WebsiteApiController@makeOrder');
        Route::post('/make-payment/{gateWayName}', 'WebsiteApiController@payWithGateWay');
        Route::get('/my-billing-address', 'WebsiteApiController@myBilling');
        ####################################################################################################################333
        Route::post('paytm-order-generate', 'WebsiteApiController@paytmOrderGenerate');
        Route::post('paytm-order-verify', 'WebsiteApiController@paytmOrderVerify');
        ##############################################################

        //quiz route
        Route::post('quiz-start/{course_id}/{quiz_id}', 'WebsiteApiController@quizStart');
        Route::post('quiz-single-submit', 'WebsiteApiController@singleQusSubmit');
        Route::post('quiz-final-submit', 'WebsiteApiController@finalQusSubmit');
        Route::post('quiz-result/{course_id}/{quiz_id}', 'WebsiteApiController@quizResult');
        Route::post('quiz-results', 'WebsiteApiController@quizResults');
        Route::post('quiz-result-preview/{quiz_id}', 'WebsiteApiController@quizResultPreview');
    });
});
