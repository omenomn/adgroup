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
    return redirect()->route('notes.index');
});

Route::get('/notes', 'NotesController@index')->name('notes.index');
Route::post('/notes', 'NotesController@store')->name('notes.store');
Route::patch('/notes/{id}', 'NotesController@update')
	->name('notes.update')->where('id', '[0-9]+');;

Route::delete('/notes/{id}', 'NotesController@destroy')
	->name('notes.destroy')->where('id', '[0-9]+');;
