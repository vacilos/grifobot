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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'HomeController@test')->name('test');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin', 'auth']], function() {
    Route::resource('/maths', 'MathController');
    Route::get('/maths/{level}/show', 'MathController@level')->name('maths_level');
    Route::resource('/plans', 'PlanController');
    Route::resource('/categories', 'CategoryController');

});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/home', 'UserController@index')->name('user_home');
    Route::get('/games', 'UserController@games')->name('user_games');
    Route::get('/createprofile', 'UserController@createProfile')->name('user_create_profile');
    Route::post('/storeprofile', 'UserController@storeProfile')->name('user_store_profile');
    Route::get('/changeprofile', 'UserController@changeProfile')->name('user_change_profile');
    Route::patch('/updateprofile', 'UserController@updateProfile')->name('user_update_profile');
    Route::get('/{plan}/play/', 'PlanController@play')->name('play_plan');
    Route::get('/plan/{size}/{level}/start/', 'PlanController@startPlan')->name('start_plan');
    Route::post('/maths/question', 'MathController@question')->name('mathquestion');
    Route::post('/score/record', 'ScoreController@recordScore')->name('user_score');
    Route::post('/maths/question/preview', 'MathController@previewQuestion')->name('preview_question');
});
