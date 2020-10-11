<?php

namespace App\admin\model;
use App\Bootstrap;


class UserModel{
    

    public static function select_user($_Bootstrap_Medoo){
        return $_Bootstrap_Medoo -> select('easyphp_user',[
            'user_name',
            'user_password'
        ]);
    }
 
}