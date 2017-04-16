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

Route::get('test', function(){
	
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('community', 'CommunityLinksController@index');
Route::post('community', 'CommunityLinksController@store');
Route::get('community/{channel}', 'CommunityLinksController@index');

Route::post('vote/{link}', 'VotesController@store');