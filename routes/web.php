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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin/upload/{id}/{img_category}', "UploadController@index")->name('upload');

    Route::post('/admin/upload/store/actor/{id}', "UploadController@actor_image_store")->name('actor_image_store');
    Route::post('/admin/upload/store/movie/{id}', "UploadController@movie_image_store")->name('movie_image_store');

});

Route::group(['middleware' => 'multiauth'], function () {

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/categories', 'AdminController@categories')->name('create_category');
    Route::get('/admin/users', 'AdminController@users')->name('edit_users');
    Route::post('/admin/categories', 'AdminController@show')->name('edit_cat');
    Route::post('/admin/categories/{id}', 'AdminController@update_cat')->name('update_cat');
    Route::get('/admin/moviesMoviesSeeder', 'MoviesController@index')->name('MoviesSeeder');
    Route::post('/admin/moviesMoviesSeeder/update/{id}', 'MoviesController@movie_update')->name('movie_update');
    Route::post('/admin/moviesMoviesSeeder/save', 'MoviesController@movie_save')->name('movie_save');
    Route::get('/admin/movie/{id}', 'MoviesController@movie_edit')->name('movie_edit');
    Route::get('/admin/actors', "ActorsController@actors")->name('actors');
    Route::post('/admin/actors/save', "ActorsController@actor_save")->name('actor_save');
    Route::post('/admin/actors/update/{id}', "ActorsController@actor_update")->name('actor_update');
    Route::get('/admin/actors/edit/{id}', "ActorsController@actor_edit")->name('actor_edit');
    Route::get('/admin/actors/delete/{id}', "ActorsController@actor_delete")->name('actor_delete');
    Route::get('/admin/category/delete/{id}', "CategoryController@category_delete")->name('category_delete');
    Route::post('category', 'CategoryController@category_save')->name('category_save');
    Route::get('/admin/movie/delete/{id}', 'MoviesController@movie_delete')->name('movie_delete');
    Route::post('/admin/users/{id}', 'AdminController@admin_role')->name('admin_role');
    Route::get('/admin/users/delete/{id}', 'AdminController@user_delete')->name('user_delete');
    Route::get('/home', 'HomeController@home')->name('home');
});


Route::get('/actor/{id}', 'ActorsController@single_actor')->name('single_actor');



Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/movie/{id}/{name}', "HomeController@single_movie")->name('single_movie');
Route::get('/orderby', "HomeController@orderby")->name('orderby');
Route::middleware('guest')->group(function(){
    Route::get('/fb/login', "FacebookController@redirect")->name('facebook.redirect');
    Route::get('/fb/callback', "FacebookController@callback")->name('facebook.callback');
});


Route::get('/fb', 'FacebookController@view')->name('fb');
//Route::post('/test', 'HomeController@test')->name('test');

Route::get('autocomplete-search',array('as'=>'autocomplete.search','uses'=>'HomeCompleteController@test'));

Route::get('autocomplete-ajax',array('as'=>'autocomplete.ajax','uses'=>'HomeCompleteController@ajaxData'));

Auth::routes();








