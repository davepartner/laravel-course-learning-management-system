<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'CourseController@index')->name('home');

Route::get('/privacy', function () {
    return view('privacy_policy');
});
Route::get('/tos', function(){
    return view('terms_of_service');
});
Route::get('/refund', function () {
    return view('refunds');
});





Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('paymentCallback');

    Route::resource('payments', 'PaymentController');


//logged in
Route::middleware(['auth'])->group(function () {
    
    //publish/unpublish
Route::post('courses/publishCourse', 'CourseController@publishCourse' )->name('courses.publishCourse');
Route::post('courses/unpublishCourse', 'CourseController@unpublishCourse' )->name('courses.unpublishCourse');

Route::get('courses/contents/{course_id}', 'CourseController@contents')->name('courses.contents');
Route::get('courses/comments/{course_id}', 'CourseController@comments')->name('courses.comments');

    Route::resource('comments', 'CommentController');
    Route::resource('categories', 'CategoryController');

    Route::get('comments/create', 'CommentController@create')->name('comment.create');
    Route::resource('coupons', 'CouponController');
    Route::get('courses/items/{course_id}/{item_id}', 'CourseController@items')->name('courses.items');
    
    Route::resource('courseUsers', 'CourseUserController');
Route::resource('users', 'UserController');
});



//instructor
Route::middleware(['instructor'])->group(function () {
    //items
    Route::resource('items', 'ItemController');
    Route::get('items/create/{course_id?}', 'ItemController@create')->name('items.create');
    Route::post('items/import-youtube', 'ItemController@importYoutube')->name('items.import-youtube');

    //courses
    Route::get('courses/create', 'CourseController@create')->name('courses.create');
    Route::get('courses/subscribers/{course_id}', 'CourseController@subscribers')->name('courses.subscribers');
    Route::post('courses/disapprove', 'CourseController@disapprove')->name('courses.disapprove');
    Route::post('courses/approve', 'CourseController@approve')->name('courses.approve');
});

//admin 
Route::middleware(['moderator'])->group(function () {
    Route::resource('views', 'ViewController');
    Route::get('coupons/index', 'CouponController@index')->name('coupons.index');

    Route::resource('roles', 'RoleController');

    //users
    Route::get('users/create', 'UserController@create')->name('users.create');

    //comments
    Route::get('comments/index', 'CommentController@index')->name('comments.index');

    //payments
    Route::get('payments/{id}/delete', 'PaymentController@destroy')->name('payments.delete');

    //courseUser or Subscripions
    Route::get('courseUsers/create', 'CourseUserController@create')->name('courseUsers.create');
   Route::get('courseUsers/{id}/edit', 'CourseUserController@edit')->name('courseUsers.edit');


    //items
    Route::get('items/index', 'ItemController@index')->name('items.index');

    //category
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::get('categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::delete('categories/{id}/delete', 'CategoryController@delete')->name('categories.delete');
});

Route::get('courses/{id}', 'CourseController@show')->name('courses.show');

Route::resource('courses', 'CourseController');