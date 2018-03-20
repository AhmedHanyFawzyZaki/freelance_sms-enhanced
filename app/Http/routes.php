<?php

use Illuminate\Http\Request;

Route::group(
    ['middleware' => ['web']], function () {
        Route::auth();
        Route::get('/home', 'HomeController@index');
        Route::get('/', ['uses'=>'HomeController@index', 'as'=>'number.index']);
        Route::resource('home', 'HomeController');
        Route::resource('settings', 'SettingsController');
        //Route::get('/number/create', ['uses'=>'HomeController@create', 'as'=>'number.create']);
        Route::post(
            '/directory/search/',
            ['uses' => 'DirectoryController@search',
            'as' => 'directory.search']
        );
    }
);
