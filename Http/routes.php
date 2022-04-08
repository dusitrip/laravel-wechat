<?php
Route::any('/', 'WeChatController@index')->middleware('swechat.check');

Route::any('/config', function () {
    dd(config()->all());
    return config()->all();
});

Route::any('/hello', function () {
    return view('swechat::welcome');
});

Route::any('/wechat-check', function () {

    return 'a09';
})->middleware('swechat.check');