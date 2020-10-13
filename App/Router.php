<?php

use \NoahBuscher\Macaw\Macaw as Route;

//后台地址-为了安全后期更改
$admin = 'admin';

Route::get('/', 'App\Home\Controller\HomeController@main');
Route::get('/login', 'App\Home\Member\Login@index');
Route::get('/code', 'App\Home\Controller\QrodeController@index');
Route::get('/captcha', 'App\Home\Member\Captcha@index');
Route::error(function() {
    echo '404 !';
});
Route::get('/'.$admin.'\/', 'App\admin\controller\index\IndexController@index');
Route::get('/'.$admin.'/login', 'App\admin\controller\user\UserController@login');
Route::get('/'.$admin.'/quit', 'App\admin\controller\user\UserController@login_quit');
Route::get('/'.$admin.'/captcha', 'App\admin\controller\user\UserController@captcha');
Route::post('/'.$admin.'/login_post', 'App\admin\controller\user\UserController@login_post');
Route::get('/'.$admin.'/article', 'App\admin\controller\index\ArticleController@index');
Route::post('/'.$admin.'/upload', 'App\admin\controller\index\ArticleController@upload');
Route::get('/'.$admin.'/config', 'App\admin\controller\conn\ConfigController@index');
Route::get('/'.$admin.'/sql', 'App\admin\controller\conn\ConfigController@sql');
Route::post('/'.$admin.'/config_update', 'App\admin\controller\conn\ConfigController@update');
Route::post('/'.$admin.'/config_sql', 'App\admin\controller\conn\ConfigController@update_sql');
Route::get('/'.$admin.'/cache', 'App\admin\controller\conn\ConfigController@cache');
Route::dispatch();



