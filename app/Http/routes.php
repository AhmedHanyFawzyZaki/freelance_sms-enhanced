<?php

use Illuminate\Http\Request;

Route::get('/cronTabSchedule', function(){
	$numbers = \App\TargetNumber::where('send_type', '!=', '0')->get();
	if ($numbers) {
		$list = PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . 'New Task Has been started on ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL;
		foreach ($numbers as $num) {
			$sendFlag = $num->proccessSchedule();
			$list .= $num->id . ' => ' . $sendFlag . PHP_EOL;
		}
		$list;
	} else {
		$list='There is no scheduled SMS.';
	}
	file_put_contents(storage_path('sms-log.txt'),$list);
});

Route::group(
        ['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);

    Route::resource('sms-log', 'LogController');
    Route::resource('sms-marketing', 'TargetNumberController');

    Route::resource('sms-schedule', 'ScheduleController');
    
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
