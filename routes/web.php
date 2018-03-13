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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // seznam projektu
    Route::get('/', 'ProjectsController@getList')->name('project.list');
    Route::get('/project/list', 'ProjectsController@getList')->name('project.list');

    // novy projekt
    Route::get('/project/new', 'ProjectsController@getNew')->name('project.new.show');
    Route::post('/project/new', 'ProjectsController@postNew')->name('project.new.post');

    // smazani projektu
    Route::get('/project/delete/{id}', 'ProjectsController@delete')->name('project.delete.id');

    // editace projektu
    Route::get('/project/edit/{id}', 'ProjectsController@getEdit')->name('project.edit.show.id');
    Route::post('/project/edit/{id}', 'ProjectsController@postEdit')->name('project.edit.post.id');
});
