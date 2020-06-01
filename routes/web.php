<?php

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

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

#programs endpoint
Route::get('/programs','ProgramsController@index')->name('programs.index');
Route::get('/programs/bin/{program}','ProgramsController@bin')->name('programs.bin');
Route::get('/programs/{program}','ProgramsController@show')->name('programs.show');
Route::get('/programs/{program}/delete','ProgramsController@destroy')->name('programs.destroy');
Route::put('/programs/{program}','ProgramsController@update')->name('programs.update');
Route::post('/programs','ProgramsController@store')->name('programs.store');
Route::delete('/programs/destroyallbin','ProgramsController@destroyAll')->name('programs.destroy.all');

#students endpoint
Route::get('/students/exports','StudentsController@export')->name('students.export');
Route::get('/students','StudentsController@index')->name('students.index');
Route::get('/students/bin/{student}','StudentsController@bin')->name('students.bin');
Route::post('/students','StudentsController@store')->name('students.store');
Route::put('/students/{student}','StudentsController@update')->name('students.update');
Route::get('/students/{student}/delete','StudentsController@destroy')->name('students.destroy');
Route::get('/students/{student}','StudentsController@show')->name('students.show');
Route::delete('/students/destroyallbin','StudentsController@destroyAll')->name('students.destroy.all');

#grades endpoints
Route::post('/students/{student}/grades/','GradesController@store')->name('grades.store');
Route::post('/grades/','GradesController@import')->name('grades.import');
Route::get('/grades','GradesController@index')->name('grades.index');
Route::get('/grades/bin/{grade}','GradesController@bin')->name('grades.bin');
Route::get('/grades/{grade}/delete','GradesController@destroy')->name('grades.destroy');
Route::delete('/grades/destroyallbin','GradesController@destroyAll')->name('grades.destroy.all');

#archives endpoint
Route::get('/archives','ArchivesController@index')->name('archives.index');
Route::get('/{var}/archives/{date}','ArchivesController@show')->name('archives.show');

#bin endpoints
Route::get('/bin','BinsController@index')->name('bin.index');

#setting endpoints
Route::get('/settings','SettingsController@index')->name('settings.index');
Route::put('/settings/{user}','SettingsController@update')->name('settings.update');

#search endpoints
Route::get('/searchs','SearchsController@index')->name('searchs.index');