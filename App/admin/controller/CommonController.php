<?php

namespace App\admin\controller;
use App\Core;


class  CommonController{
    protected $templateEngine;
    protected $_medoo_mysql;

    public function __construct(){

        
        $loader = new \Twig\Loader\FilesystemLoader(APP_PATH.'admin/view');
        $this->templateEngine = new \Twig\Environment($loader,[
            'debug'=>true,
            'cache' => APP_PATH.'./admin/Cache',
            'auto_reload' => true,  //根据文件更新时间，自动更新缓存
        ]);
        $this->templateEngine->addFilter(new \Twig\TwigFilter('url', function ($path){
            return BASE_URL . $path;
        }));


    }

    public function render($fileName, $data = []) {
        return $this->templateEngine->render($fileName, $data);
    }


    public function _medoo_config() {
        return $this-> _medoo_mysql = Core::_Medoo();
    }


}