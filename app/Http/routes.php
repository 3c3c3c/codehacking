<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']); //note name route as home.post and use the designated controller and method



//grouping of routes available to admin only
Route::group(['middleware'=>'admin'], function() {   //admin middle ware was created in middleware and registered in kernel
	Route::get('/admin', function(){
	return view('admin.index');
	});
	Route::resource('admin/users', 'AdminUsersController');
	Route::resource('admin/posts', 'AdminPostsController');
	Route::resource('admin/categories', 'AdminCategoriesController');
	Route::resource('admin/media', 'AdminMediasController');
	Route::resource('admin/comments', 'PostCommentsController');
	Route::resource('admin/comments/replies', 'CommentRepliesController');


	//if one wanted to have a route to an upload file 
	//Route::get('admin.media.upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediasController@store']);
});

//only give access to 'create comment reply' method in the CommentRepliesController  to users who are logged in
Route::group(['middleware'=>'auth'], function(){
	Route::post('comment/reply', 'CommentRepliesController@createReply');
});

Route::auth();

