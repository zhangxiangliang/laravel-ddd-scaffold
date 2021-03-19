<?php

// 微信相关路由
Route::group(['prefix' => 'miniapp'], function () {
    Route::post('/login', "MiniappController@login");
});

// 微信相关路由
Route::group(['prefix' => 'miniapp', 'middleware' => 'auth:api'], function () {
    Route::put('/', "MiniappController@update");
});
