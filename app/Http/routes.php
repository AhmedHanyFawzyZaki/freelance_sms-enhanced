<?php

use Illuminate\Http\Request;

Route::group(
        ['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
    //Route::get('/sms-marketing', ['uses' => 'HomeController@marketing', 'as' => 'home.marketing']);
    Route::resource('sms-log', 'LogController');
    Route::resource('sms-marketing', 'TargetNumberController');
    Route::get('/seenLogs', ['uses' => 'LogController@indexSeen', 'as' => 'sms-log.indexSeen']);
    Route::get('/export', ['uses' => 'LogController@export', 'as' => 'sms-log.export']);
    //Route::get('/sms-log', ['uses'=>'LogController@index', 'as'=>'sms-log']);
    Route::resource('home', 'HomeController');
    Route::resource('settings', 'SettingsController');
    
    Route::get('/send-sms', ['uses' => 'SmsController@getSendSms', 'as' => 'send-sms']);
    Route::post('/send-sms', ['uses' => 'SmsController@postSendSms', 'as' => 'send-sms-post']);
    
    Route::post(
            '/incomingSmsHandling', ['uses' => 'DirectoryController@incomingSmsHandling',
        'as' => 'incomingSmsHandling']
    );
}
);
