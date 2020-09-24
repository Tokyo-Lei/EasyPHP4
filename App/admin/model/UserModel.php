<?php

namespace App\admin\model;
use App\Bootstrap;


class UserModel{
    


    // public static function select($_dbs,$dbname,$arr){
    //     return $_dbs -> select($dbname,$arr);
    // }


    //查询
    public static function select_auth_group($_Bootstrap_Medoo){
        return $_Bootstrap_Medoo -> select('think_auth_group','*');
    }
    
    //注入
    public static function insert_auth_group($_Bootstrap_Medoo,$arr){
        return $_Bootstrap_Medoo -> insert('think_auth_group',$arr);
    }
}