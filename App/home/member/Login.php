<?php


namespace App\home\member;

use App\home\model\User;
use App\Bootstrap;


class Login {

    public function index(){

        

        $_code = Bootstrap::_Medoo();
     
        $_auth_config =Bootstrap::_Auth();


        $user = user::user_select($_code,'user','*');






        // 获取auth实例
         $auth = \huangsen\auth\Auth::getInstance();

        // 检测权限
        // 第一个参数是规则名称(也可以是规则id参数必须为数字),第二个参数是用户UID,第三个参数为判断条件
        if($auth->check('1','1')){
            //有显示操作按钮的权限
            echo ' 有权限';
        }else{
            //没有显示操作按钮的权限
            echo ' 你没有权限访问';
        }



    }

}

