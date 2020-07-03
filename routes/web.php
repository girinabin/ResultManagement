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

// STUDENTS
// Route::resource('student', 'SchoolController');
Route::get('/student/{class}','StudentController@index')->name('student.index');
Route::post('student/{class}','StudentController@store')->name('add.student');
Route::post('/student/update/{student}','StudentController@update')->name('update.student');
Route::post('/student/delete/{student}','StudentController@destroy')->name('delete.student');
Route::post('/import/students/{class}','StudentController@importExcel')->name('import.student');
Route::get('/student/view/{student}','StudentController@show')->name('student.show');

// SUBJECT
Route::get('/subject/{class}','SubjectController@index')->name('subject.index');
Route::get('/subject-create/{class}','SubjectController@create')->name('subject.create');
Route::post('subject/{class}','SubjectController@store')->name('subject.store');
Route::get('/subject-edit/{subject}','SubjectController@edit')->name('subject.edit');
Route::post('/subject/update/{subject}','SubjectController@update')->name('subject.update');
Route::delete('/subject/delete/{id}','SubjectController@destroy')->name('subject.destroy');

// Student Result
Route::post('/import/result/{class}','ResultController@importResult')->name('import.result');
// Marksheet
Route::get('/marksheets','MarksheetController@create')->name('marksheets.create');


