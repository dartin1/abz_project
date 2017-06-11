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

Route::get('employers/index', 'EmployerController@index')->name('employers.index');
Route::get('employers', ['uses'=>'EmployerController@employers']);
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('employers/view-{id}', 'EmployerController@view_employer')->name('EmployerShow');
Route::get('employers/new','EmployerController@new_employer');
Route::post('employers/new', 'EmployerController@store')->name('employerNew');
Route::get('employers/edit-{id}','EmployerController@edit_employer');
Route::post('employers/edit-{id}', 'EmployerController@edit')->name('employerStore');
Route::get('employers/delete-{id}', 'EmployerController@delete_employer');
Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@saving');
Route::get('/{id}','IndexController@index');



