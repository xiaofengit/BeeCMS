<?php

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| 后台管理路由
| 通过 RouteServiceProvider 加载，并且包含在 "backend" 路由组
| prefix = 'backend'
| namespace 'App\Http\Controllers\Backend'
|
*/
Route::get('/', 'IndexController@index')->name('index');

/*// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password', function() {
    return view('backend.auth.password');
})->middleware('auth:backend')->name('password');
Route::post('password', 'Auth\ResetPasswordController@reset')->name('password.reset');*/
