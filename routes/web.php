<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','DashboardController@index')->name('dashboard');
// Route::post('/addclass','DashboardController@addClass')->name('addclass');
Route::resource('school', 'SchoolController');
// CLASSES
Route::post('/school/class/{id}','SchoolController@addClass')->name('school.class');
Route::post('/update/class/{id}','SchoolController@updateClass')->name('update.class');
Route::post('/class/delete/{id}','SchoolController@deleteClass')->name('delete.class');

