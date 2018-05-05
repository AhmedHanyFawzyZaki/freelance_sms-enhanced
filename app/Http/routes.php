<?php

use Illuminate\Http\Request;

Route::group(
        ['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

    Route::resource('sms-log', 'LogController');
    Route::resource('sms-marketing', 'TargetNumberController');

    Route::resource('sms-schedule', 'scheduleController');
    
    Route::get('/seenLogs', ['uses' => 'LogController@indexSeen', 'as' => 'sms-log.indexSeen']);
    Route::get('/export', ['uses' => 'LogController@export', 'as' => 'sms-log.export']);

    Route::resource('home', 'HomeController');
    Route::resource('settings', 'SettingsController');

    Route::get('/send-sms', ['uses' => 'SmsController@getSendSms', 'as' => 'send-sms']);
    Route::post('/send-sms', ['uses' => 'SmsController@postSendSms', 'as' => 'send-sms-post']);

    Route::get('/upload-excel', ['uses' => 'SmsController@getUploadExcel', 'as' => 'upload-excel']);
    Route::post('/upload-excel', ['uses' => 'SmsController@postUploadExcel', 'as' => 'upload-excel-post']);

    Route::post(
            '/directory/incomingSmsHandling', ['uses' => 'DirectoryController@incomingSmsHandling',
        'as' => 'incomingSmsHandling']
    );
    Route::post(
            '/directory/smsLog', ['uses' => 'DirectoryController@saveSmsLog',
        'as' => 'saveSmsLog']
    );
}
);
