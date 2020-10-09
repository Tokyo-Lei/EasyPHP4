<?php

namespace App\home\member;

use App\home\member\_Validate;

class LoginController {




    public function index(){

        // session_start();
        // $_SESSION['username'] = "kyomini";

        // if($_SESSION['username'] != "kyomini"){
        //     echo  "没有权限登录";
        // }else{
        //     echo  "Hi";
        // }

    
    }


    public function login(){

        $data = [
            'name'  => 'thinkphp',
            'email' => 'thinkphp',
            'age' => 'thinkphp@qq.com222',
        ];
           
        //实例化验证器
        $validateNew = new _Validate();
     
        
        //验证数据
        if (!$validateNew->check($data)) {
            var_dump($validateNew->getError());
        }
    
    }







}