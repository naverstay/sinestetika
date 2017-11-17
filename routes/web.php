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

Route::get('/', ['as'=>'home', 'uses'=>'MainController@index']);

Route::get('/testjson', ['as'=>'testmethod', 'uses'=>'HomeController@test']);

Route::get('/service/{name}', ['as'=>'service', 'uses'=>'MainController@service']);

Route::get('/projects/{tags?}', ['as'=>'projects', 'uses'=>'MainController@projects'])->where('tags', '[a-z0-9\-_\/]*');;
Route::get('/project/{name}', ['as'=>'project', 'uses'=>'MainController@project']);

Route::get('/contacts', ['as'=>'contacts', 'uses'=>'MainController@contacts']);