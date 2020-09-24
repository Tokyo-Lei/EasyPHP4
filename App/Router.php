<?php

use \NoahBuscher\Macaw\Macaw as Route;


Route::get('/', 'App\Home\Controller\HomeController@main');


Route::get('/login', 'App\Home\Member\Login@index');


Route::get('/phpinit', function() {
   phpinfo();
});


Route::get('/code', 'App\Home\Controller\QrodeController@index');


Route::get('/captcha', 'App\Home\Member\Captcha@index');

// Route::get('/login', 'App\Home\Member\LoginController@index');
// Route::get('/login2', 'App\Home\Member\LoginController@login');

Route::get('/about', function() {
    echo 'about!';
});
  

Route::error(function() {
    echo '404 !';
});










// admin
Route::get('/admin\/', 'App\admin\controller\index\IndexController@index');
Route::get('/admin/user_group', 'App\admin\controller\user\UserController@user_group');
Route::get('/admin/user_group_add', 'App\admin\controller\user\UserController@user_group_add');
Route::post('/admin/user_group_post', 'App\admin\controller\user\UserController@user_group_insert');




Route::dispatch();



