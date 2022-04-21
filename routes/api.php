<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('dogentry', 'DogsController@createEntry');

Route::get('breeds', 'BreedsController@index');
Route::get('dogs', 'DogsController@index');
Route::get('dogs/{id}', 'DogsController@show');
Route::get('locations', 'LocationController@index');
Route::get('pages', 'PageController@index');
Route::get('studentages', 'StudentageController@index');
Route::get('studentnums', 'StudentnumsController@index');
Route::get('textblocks', 'TextblockController@index');
Route::get('volunteers/{id}', 'VolunteersController@show');
Route::get('volunteers/user/{user_id}', 'VolunteersController@showUserVolunteers');

// ReaderEntry.js
Route::post('readerlog', 'LogsController@createReaderLogEntry');

// VolunteerEntry.js
Route::get('certifications', 'CertificationController@index');
Route::post('volunteerlog', 'LogsController@createVolunteerLogEntry');

// VolunteerInfo.js
Route::post('volunteerinfo', 'VolunteersController@createOrUpdateVolunteerFromForm');

// DogEntry.js
Route::post('dogs', 'DogsController@createEntry');

//
Route::get('logs/{log_type}/{user_id}/', 'LogsController@getLogsByTypeAndUserId');

Route::resource('media', 'MediaController');
Route::get('verify', 'UserController@verifyToken');

Route::get('milestones/{current_hours}', 'MilestoneController@getUserNextMilestone');
