<?php

namespace App\home\member;
use App\home\model\User;
use App\Bootstrap;
use Auth;
class Login {
    public function index() {
        $_code = Bootstrap::_Medoo();
        $user = user::user_select($_code, 'user', '*');
        $auth = \huangsen\auth\Auth::getInstance();
        if ($auth->check('1', '1')) {
            echo ' 有权限';
        } else {
            //没有显示操作按钮的权限
            echo ' 你没有权限访问';
        }
    }
}

