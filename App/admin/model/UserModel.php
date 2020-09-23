<?php

namespace App\admin\model;

class UserModel{
    
    //查询用户
    public static function user_all($_dbs,$dbname,$arr){
        return $_dbs -> select($dbname,$arr);
    }

}