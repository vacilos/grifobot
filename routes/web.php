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
Route::get('site/shutdown', function(){
    return Artisan::call('down');
});
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@welcome')->name('welcome');

Route::get('/test', 'HomeController@test')->name('test');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/version', function () {
    return view('version');
})->name('version');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/logo', function () {
    return view('logo');
})->name('logo');

Route::get('/students', function () {
    return view('students');
})->name('students');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin', 'auth']], function() {
    Route::resource('/maths', 'MathController');
    Route::get('/maths/{level}/show', 'MathController@level')->name('maths_level');
    Route::resource('/plans', 'PlanController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/badges', 'BadgeController');

});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/home', 'UserController@index')->name('user_home');
    Route::get('/games', 'UserController@games')->name('user_games');
    Route::get('/badges', 'UserController@badges')->name('user_badges');
    Route::get('/stats', 'UserController@stats')->name('user_stats');
    Route::get('/statsalltime', 'UserController@statsAllTime')->name('user_stats_all_time');
    Route::get('/createprofile', 'UserController@createProfile')->name('user_create_profile');
    Route::post('/storeprofile', 'UserController@storeProfile')->name('user_store_profile');
    Route::get('/changeprofile', 'UserController@changeProfile')->name('user_change_profile');
    Route::patch('/updateprofile', 'UserController@updateProfile')->name('user_update_profile');
    Route::get('/{plan}/play/', 'PlanController@play')->name('play_plan');
    Route::get('/{plan}/play/kinder', 'PlanController@playKinder')->name('play_plan_kinder');
    Route::get('/plan/{size}/{level}/start/', 'PlanController@startPlan')->name('start_plan');
    Route::get('/plan/{size}/{level}/{diff}/start/kinder', 'PlanController@startPlanKinder')->name('start_plan_kinder');
    Route::post('/maths/question', 'MathController@question')->name('mathquestion');
    Route::post('/score/record', 'ScoreController@recordScore')->name('user_score');
    Route::post('/maths/question/preview', 'MathController@previewQuestion')->name('preview_question');
});
