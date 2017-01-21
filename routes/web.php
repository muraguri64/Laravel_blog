<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','PagesController@getIndex');
Route::get('blog',['uses'=>'BlogController@getIndex','as'=>'blog.index']);
Route::get('blog/{id}',['as'=>'blog.single','uses'=>'BlogController@getSingle']);
Route::get('contact','PagesController@getContact');
Route::post('contact','PagesController@postContact');
Route::get('about','PagesController@getAbout');

//resoures for posts and  categories and tags
Route::resource('posts','PostController');
Route::resource('categories','CategoryController',['except'=>['create']]);
Route::resource('tags','TagController',['except'=>['create']]);

//route for comments
Route::post('comments/{post_id}',['uses'=>'CommentController@store','as'=>'comments.store']);
Route::get('comments/{id}/edit',['uses'=>'CommentController@edit','as'=>'comments.edit']);
Route::put('comments/{id}',['uses'=>'CommentController@update','as'=>'comments.update']);
Route::delete('comments/{id}',['uses'=>'CommentController@destroy','as'=>'comments.destroy']);
Route::get('comment/{id}/delete',['uses'=>'CommentController@delete','as'=>'comments.delete']);

//set registration routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

//Login Routes...
Route::get('login',  'LoginController@showLoginForm')->middleware('guest');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

//get the route for email verification
Route::get('verify/{check}','VerifyController@check');

//route for errors
Route::get('error',['as'=>'error.single','uses'=>'VerifyController@checkerr']);
//route for successful verification
Route::get('success',['as'=>'apprvd.single','uses'=>'VerifyController@apprvd']);

// Password Reset Routes...
Route::get('password/reset/', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');