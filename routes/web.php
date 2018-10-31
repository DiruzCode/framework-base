<?php

setlocale(LC_ALL, "");
setlocale(LC_ALL, app()->getLocale());


Route::get('/', 'Admin\DashboardController@index')->name('admin.home');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin::'], function () {
  Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
  Route::post('/login', 'Auth\LoginController@login')->name('login');
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

  Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index')->name('admin.home');

    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::resource('/permissions', 'PermissionController', ['except' => ['show']]);
    Route::get('/roles/slug/{name}', 'RoleController@slug')->name('roles.slug');
    
  });

});
