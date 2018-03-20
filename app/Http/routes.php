<?php

use Illuminate\Http\Request;

Route::group(
        ['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
    Route::resource('sms-log', 'LogController');
    Route::get('/seenLogs', ['uses' => 'LogController@indexSeen', 'as' => 'sms-log.indexSeen']);
    Route::get('/export', ['uses' => 'LogController@export', 'as' => 'sms-log.export']);
    //Route::get('/sms-log', ['uses'=>'LogController@index', 'as'=>'sms-log']);
    Route::resource('home', 'HomeController');
    Route::resource('settings', 'SettingsController');
    //Route::get('/number/create', ['uses'=>'HomeController@create', 'as'=>'number.create']);
    Route::post(
            '/directory/search/', ['uses' => 'DirectoryController@search',
        'as' => 'directory.search']
    );
}
);
