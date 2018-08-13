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
    return view('auth.login');
});

Auth::routes();
Route::post('/users/getUsers','UserController@getUsers')->name('dataProcessing');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'PagesController@index')->name('dashboard');
Route::get('/deactivatedPage', function () {
    return view('pages.deactivated');
});
Route::post('/updatePassword','PasswordController@update');
Route::get('/changepassword','PasswordController@index');
Route::get('/chkpword{empno}','PasswordController@chkpword');
Route::resource('/links','LinkController');
Route::resource('/users','UserController');
Route::post('/users/activate','UserController@activate');
Route::get('create', 'DisplayDataController@create');
Route::get('index', 'DisplayDataController@index')->name('index');


if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
    }










