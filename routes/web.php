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
Route::get('/novel', function () {
    return view('welcomehome');
})->name('novel');

Route::get('/help', function () {
    return view('help');
})->name('help');
Route::get('/credits', function () {
    return view('credits');
})->name('credits');

Route::get('/quiz', function () {
    return view('quiz');
})->name('quiz');

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

Route::group(['prefix' => '1821'], function() {
    Route::get('/main', function () { return view('revolution.main'); })->name('1821');
    Route::get('/quiz/start', function () {    return view('quiz.start');})->name('quiz_play_start_revolution');
    Route::get('/quiz/play/name', 'QuizController@playNameRevolution')->name('quiz_play_name_revolution');
    Route::post('/quiz/play', 'QuizController@playRevolution')->name('quiz_play_revolution');
    Route::post('/quiz/question', 'QuizController@questionRevolution')->name('quiz_question_revolution');
    Route::post('/quiz/recordScore', 'QuizScoreController@recordRevolution')->name('quiz_score_record_revolution');
    Route::get('/quiz/public', 'QuizController@publicQuizRevolution')->name('quiz_public_revolution');
    Route::get('/quiz/{pin}/results', 'QuizController@resultsRevolution')->name('quiz_results_revolution');
}); // routes for revolution version adding quizzes

Route::get('/quiz/start', function () {    return view('quiz.start');})->name('quiz_play_start');
Route::post('/quiz/play/name', 'QuizController@playName')->name('quiz_play_name');
Route::post('/quiz/play', 'QuizController@play')->name('quiz_play');
Route::post('/quiz/question', 'QuizController@question')->name('quiz_question');
Route::post('/quiz/recordScore', 'QuizScoreController@record')->name('quiz_score_record');
Route::get('/quiz/public', 'QuizController@publicQuiz')->name('quiz_public');
Route::get('/quiz/{pin}/results', 'QuizController@results')->name('quiz_results');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'revolution', 'middleware' => ['role:admin', 'auth']], function() {
    Route::get('/revolution/quiz/my', 'QuizController@myQuizzesRevolution')->name('revolution_quiz_my');
    Route::get('revolution/quiz/create/start', 'QuizController@createRevolution')->name('revolution_quiz_start');
    Route::post('revolution/quiz/create/store', 'QuizController@storeRevolution')->name('revolution_quiz_store');
    Route::get('revolution/quiz/{quiz}/add/{question}/question', 'QuizController@addQuestionRevolution')->name('revolution_quiz_add_question');
    Route::post('revolution/quiz/{quiz}/store/{question}/question', 'QuizController@storeQuestionRevolution')->name('revolution_quiz_store_question');
}); // routes for revolution version adding quizzes

Route::group(['prefix' => 'teacher', 'middleware' => ['role:teacher|admin', 'auth']], function() {
    Route::get('/quiz/my', 'QuizController@myQuizzes')->name('quiz_my');
    Route::get('quiz/create/start', 'QuizController@create')->name('quiz_start');
    Route::post('quiz/create/store', 'QuizController@store')->name('quiz_store');
    Route::get('quiz/{quiz}/add/{question}/question', 'QuizController@addQuestion')->name('quiz_add_question');
    Route::post('quiz/{quiz}/store/{question}/question', 'QuizController@storeQuestion')->name('quiz_store_question');
    Route::get('quiz/{quiz}/finished', 'QuizController@finished')->name('quiz_finished');
    Route::get('quiz/{quiz}/show', 'QuizController@show')->name('quiz_show');
    Route::get('quiz/{quiz}/results', 'QuizController@resultsTeacher')->name('quiz_teacher_results');
    Route::get('quiz/{quiz}/edit', 'QuizController@edit')->name('quiz_edit');
    Route::patch('quiz/{quiz}/update', 'QuizController@update')->name('quiz_update');
    Route::get('quiz/{quiz}/question/{math}/edit', 'QuizController@editQuestion')->name('quiz_edit_math');
    Route::patch('quiz/{quiz}/question/{math}/update', 'QuizController@updateQuestion')->name('quiz_update_math');
    Route::get('quiz/{quiz}/questions', 'QuizController@questions')->name('quiz_questions');
});


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin', 'auth']], function() {
    Route::resource('/maths', 'MathController');
    Route::get('/maths/{level}/show', 'MathController@level')->name('maths_level');
    Route::resource('/plans', 'PlanController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/badges', 'BadgeController');
    Route::resource('/tournaments', 'TournamentController');
    Route::get('/customplans/designstart', 'PlanController@designStart')->name('design_start');
    Route::post('/customplans/design', 'PlanController@design')->name('design');
    Route::post('/customplans/designstore', 'PlanController@design')->name('design_store');
    Route::get('ajax/math/fetch', 'MathController@mathsSelect')->name('maths_select');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('/home', 'UserController@index')->name('user_home');
    Route::get('/games', 'UserController@games')->name('user_games');
    Route::get('/badges', 'UserController@badges')->name('user_badges');
    Route::get('/stats', 'UserController@stats')->name('user_stats');
    Route::get('/challenges', 'UserController@challenges')->name('user_challenges');
    Route::get('/statsalltime', 'UserController@statsAllTime')->name('user_stats_all_time');
    Route::get('/createprofile', 'UserController@createProfile')->name('user_create_profile');
    Route::post('/storeprofile', 'UserController@storeProfile')->name('user_store_profile');
    Route::get('/changeprofile', 'UserController@changeProfile')->name('user_change_profile');
    Route::patch('/updateprofile', 'UserController@updateProfile')->name('user_update_profile');
    Route::get('/newsletter', function () {
        return view('user.newsletter');
    })->name('user_newsletter');
    Route::get('/newsletter/{answer}/answer', 'UserController@newsletter')->name('user_newsletter_answer');
    Route::get('/{plan}/play/', 'PlanController@play')->name('play_plan');
    Route::get('/{plan}/play/kinder', 'PlanController@playKinder')->name('play_plan_kinder');
    Route::get('/tournament/{tournament}/start', 'TournamentController@startTournament')->name('start_tournament');
    Route::get('/tournament/list', 'TournamentController@listTournament')->name('list_tournament');
    Route::get('/tournament/{tournament}/begin', 'TournamentController@beginTournament')->name('begin_tournament');
    Route::get('/tournament/{tournament}/play/{game}/game', 'TournamentController@playTournament')->name('play_tournament');
    Route::get('/tournament/{tournament}/finish', 'TournamentController@finishTournament')->name('finish_tournament');
    Route::get('/tournament/{tournament}/results', 'TournamentController@resultsTournament')->name('results_tournament');
    Route::get('/plan/{size}/{level}/start/', 'PlanController@startPlan')->name('start_plan');
    Route::get('/plan/{size}/{level}/start/ex', 'PlanController@startExPlan')->name('start_plan_ex');
    Route::get('/plan/{size}/{level}/{diff}/start/kinder', 'PlanController@startPlanKinder')->name('start_plan_kinder');
    Route::post('/maths/question', 'MathController@question')->name('mathquestion');
    Route::post('/score/record', 'ScoreController@recordScore')->name('user_score');
    Route::post('/tournament/score/record', 'TournamentScoreController@recordScore')->name('user_score_tournament');
    Route::post('/maths/question/preview', 'MathController@previewQuestion')->name('preview_question');
    Route::get('/plan/{plan}/details', 'PlanController@planDetails')->name('plan_details');
    Route::post('/challenge/friend', 'ChallengeController@challengeFriend')->name('challenge_friend');
});

