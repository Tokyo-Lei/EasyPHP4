<?php

use \NoahBuscher\Macaw\Macaw as Route;

//后台地址-为了安全后期更改
$admin = 'admin';

Route::get('/', 'app\home\controller\homeController@main');
Route::get('/login', 'app\home\member\Login@index');
Route::get('/code', 'app\home\controller\QrodeController@index');
Route::get('/captcha', 'app\home\member\Captcha@index');
Route::error(function() {
    echo '404 !';
});
Route::get('/'.$admin.'\/', 'app\admin\controller\index\IndexController@index');
Route::get('/'.$admin.'/login', 'app\admin\controller\user\UserController@login');
Route::get('/'.$admin.'/quit', 'app\admin\controller\user\UserController@login_quit');
Route::get('/'.$admin.'/captcha', 'app\admin\controller\user\UserController@captcha');
Route::post('/'.$admin.'/login_post', 'app\admin\controller\user\UserController@login_post');
Route::get('/'.$admin.'/article', 'app\admin\controller\index\ArticleController@index');
Route::post('/'.$admin.'/upload', 'app\admin\controller\index\ArticleController@upload');
Route::get('/'.$admin.'/config', 'app\admin\controller\conn\ConfigController@index');
Route::get('/'.$admin.'/sql', 'app\admin\controller\conn\ConfigController@sql');
Route::post('/'.$admin.'/config_update', 'app\admin\controller\conn\ConfigController@update');
Route::post('/'.$admin.'/config_sql', 'app\admin\controller\conn\ConfigController@update_sql');
Route::get('/'.$admin.'/cache', 'app\admin\controller\conn\ConfigController@cache');
Route::dispatch();



