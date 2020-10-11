<?php

use \NoahBuscher\Macaw\Macaw as Route;

//后台地址-为了安全后期更改
$admin = 'admin';



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










// 后台首页
Route::get('/'.$admin.'\/', 'App\admin\controller\index\IndexController@index');
// 后台登录
Route::get('/'.$admin.'/login', 'App\admin\controller\user\UserController@login');
// 后台退出
Route::get('/'.$admin.'/quit', 'App\admin\controller\user\UserController@login_quit');
// 验证码
Route::get('/'.$admin.'/captcha', 'App\admin\controller\user\UserController@captcha');
// 登录POST验证
Route::post('/'.$admin.'/login_post', 'App\admin\controller\user\UserController@login_post');



//提交文章（快速撰写）
Route::get('/'.$admin.'/article', 'App\admin\controller\index\ArticleController@index');
//上传图片
Route::post('/'.$admin.'/upload', 'App\admin\controller\index\ArticleController@upload');




//站点配置
Route::get('/'.$admin.'/config', 'App\admin\controller\conn\ConfigController@index');
//修改站点配置
Route::post('/'.$admin.'/config_update', 'App\admin\controller\conn\ConfigController@update');
//删除缓存
Route::get('/'.$admin.'/cache', 'App\admin\controller\conn\ConfigController@cache');







Route::dispatch();



