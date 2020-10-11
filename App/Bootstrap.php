<?php
namespace App;
use Medoo\Medoo;
class Bootstrap{
  private static $app;

   public function __construct()
   {
        if (version_compare(phpversion(), '7.0', '<')) {
            die('<h1>No! :(</h1><p>为了兼容更好使用，必须在PHP7.0以上版本开发！</p>');
        }

        define('APP_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
        define('ROOT_PATH',str_replace('\\','/',realpath(dirname(__FILE__,2).'/'))."/");
        define('PUBLIC_PATH',ROOT_PATH.'Public');
         $whoops = new \Whoops\Run;
         $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
         $whoops->register();

        
        //config 对应加载目录
        define('PHP_CONFIG_AUTO_PATH',APP_PATH.'config/');
        define('PHP_CONFIG_PATH',APP_PATH.'config/');

        
 

       
   }

   public static function Auth_Config($key = null) {

    if (self::$app == null) {
        self::$app = require APP_PATH . 'config/Auth.php';
    }

    if (!is_null($key)) {
        return array_key_exists($key, self::$app) ? self::$app[$key] : null;
    }

    return self::$app;
    }

   public static function Web_Config($key = null) {

    if (self::$app == null) {
        self::$app = require APP_PATH . 'config/Webconfig.php';
    }

    if (!is_null($key)) {
        return array_key_exists($key, self::$app) ? self::$app[$key] : null;
    }

    return self::$app;
    }

    public static function Run(){
        $baseUrl='';
        $baseDir=str_replace(basename($_SERVER['SCRIPT_NAME']), '',$_SERVER['SCRIPT_NAME']);
        $baseUrl='http://' . $_SERVER['HTTP_HOST'] . $baseDir;
        define('BASE_URL', $baseUrl);
        define('PUBLIC_ADMIN', BASE_URL.'Admin');
        define('PUBLIC_HOME', BASE_URL.'Home');
        define('PUBLIC_ROOT', BASE_URL);
        
        //加载路由
        require  APP_PATH .'Router.php';
       
         
      
     }

     
     public static function _Medoo(){
        require  APP_PATH .'Config/Mysql.php'; 
        return $_DB = New medoo($Config['DB']);
     }


}








