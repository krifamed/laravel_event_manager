<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/

Route::group(['namespace'=>'API', 'prefix'=>'api', 'middleware'=>['jwt.auth']],function(){
    Route::post('logout', 'AuthenticateController@logout');
    Route::resource('organisers', 'OrganiserAPIController', ['only' =>['index', 'show'] ]);
    Route::resource('organisers.events', 'EventAPIController', ['only' =>['index', 'show'] ]);
    // Route::resource('organisers.events.participations', 'ParticipationAPIController');
    Route::post('participate', 'ParticipationAPIController@store');
});

Route::group([ 'namespace' => 'API', 'prefix' => 'api'], function(){
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthenticateController@login');
});


// Route::resource('days', 'DayAPIController');

// Route::resource('sessions', 'SessionAPIController');


Route::resource('sessions', 'SessionAPIController');