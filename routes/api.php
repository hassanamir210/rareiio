<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// -----------------------  Routes Without Token ---------------------------- //

// Login
Route::post('/login', 'Api\AuthController@login');

// User SignUp
Route::post('/applicant-signup', 'Api\AuthController@applicantSignup');



// -----------------------  Routes With Token ---------------------------- //

Route::group(['middleware' => 'jwt.auth'], function () 
{
	// Logout
	Route::get('/logout', 'Api\AuthController@logout');


	// List Users
	Route::get('/list-applicants', 'Api\AdminController@listApplicants');
		
});