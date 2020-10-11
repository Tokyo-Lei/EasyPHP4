<?php

namespace App\admin\controller;
use App\Bootstrap;


class  CommonController{ 
    protected $templateEngine;
    protected $_medoo_mysql;


    public function __construct(){
        
        ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/App/file/tmp'));
        ini_set('session.auto_start',0); 
        ini_set('session.gc_probability', 1);
        ini_set('session.gc_maxlifetime',1500); 
        
        session_start();

        $loader = new \Twig\Loader\FilesystemLoader(APP_PATH.'admin/view');
        $this->templateEngine = new \Twig\Environment($loader,[
            'debug'=>true,
            'cache' => APP_PATH.'./file/cache_admin',
            'auto_reload' => true,  //根据文件更新时间，自动更新缓存
        ]);
        $this->templateEngine->addFilter(new \Twig\TwigFilter('url', function ($path){
            return BASE_URL . $path;
        }));

    }

    public function render($fileName, $data = []) {
        return $this->templateEngine->render($fileName, $data);
    }

    public function medoo_conf() {
        return $this-> medoo_conf = Bootstrap::_Medoo();
    }


}