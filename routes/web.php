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
Route::get('/school/delete/{school}','SchoolController@schoolDelete')->name('school.delete');
// CLASSES
Route::get('/school/class/create','SchoolClassController@createClass')->name('create.class');
Route::post('/school/class/{user}','SchoolClassController@addClass')->name('school.class');
Route::post('/update/class/{class}','SchoolClassController@updateClass')->name('update.class');
Route::post('/class/delete/{class}','SchoolClassController@deleteClass')->name('delete.class');
Route::get('/school/class/{user}','SchoolClassController@indexClass')->name('index.class');

// STUDENTS
// Route::resource('student', 'SchoolController');
Route::get('/student/create/{batch}','StudentController@create')->name('student.create');
Route::get('/student/{batch}','StudentController@index')->name('student.index');
Route::post('student/{batch}','StudentController@store')->name('add.student');
Route::post('/student/update/{student}','StudentController@update')->name('update.student');
Route::post('/student/delete/{student}','StudentController@destroy')->name('delete.student');
Route::post('/import/students/{batch}','StudentController@importExcel')->name('import.student');
Route::get('/student/view/{student}','StudentController@show')->name('student.show');

// SUBJECT
Route::get('/subject/{class}','SubjectController@index')->name('subject.index');
Route::get('/subject-create/{class}','SubjectController@create')->name('subject.create');
Route::post('subject/{class}','SubjectController@store')->name('subject.store');
Route::get('/subject-edit/{subject}','SubjectController@edit')->name('subject.edit');
Route::post('/subject/update/{subject}','SubjectController@update')->name('subject.update');
Route::delete('/subject/delete/{subject}','SubjectController@destroy')->name('subject.destroy');

// Batch
Route::get('/batch/{class}','BatchController@addBatch')->name('add.batch');
Route::post('/batch/store/{class}','BatchController@storeBatch')->name('store.batch');
Route::get('/batch/view/{class}','BatchController@viewBatch')->name('index.batch');
Route::post('/batch/update/{batch}','BatchController@updateBatch')->name('update.batch');
Route::post('/batch/delete/{batch}','BatchController@deleteBatch')->name('delete.batch');

// Student Result
Route::post('/import/result/{class}','ResultController@importResult')->name('import.result');
// Marksheet
Route::get('/marksheets','MarksheetController@create')->name('marksheets.create');


