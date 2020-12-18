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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('all-post','PostController@allPost')->name('allPost');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/user-listing', 'UserController@userListing')->name('user-listing');
    Route::post('/user-edit', 'UserController@editUser')->name('editUser');
    Route::get('/user-delete', 'UserController@deleteUser')->name('deleteUser');
    Route::view('testing','testing');
    Route::get('edit-profile','UserController@editProfile')->name('editProfiile');
    Route::post('save_profile','UserController@saveProfile')->name('saveProfile');
    Route::get('post','PostController@post')->name('post');
    Route::view('create-post','create_new_post');
    Route::post('create-post','PostController@createNewPost');

    Route::get('delete-post','PostController@deletePost')->name('deletePost');
    Route::post('edit-post','PostController@editPost')->name('editPost');
});
