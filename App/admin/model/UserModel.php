<?php

namespace App\admin\model;
use App\Bootstrap;


class UserModel{
    

    protected $_Bootstrap_Medoo = Bootstrap::_Medoo();

   

    // public static function select($_dbs,$dbname,$arr){
    //     return $_dbs -> select($dbname,$arr);
    // }



    //查询
    public static function select($_Bootstrap_Medoo,$dbname,$arr){
        return $_Bootstrap_Medoo -> select('think_auth_group','*');
    }
    
    //注入
    public static function insert($_dbs,$dbname,$arr){
        return $_dbs -> insert($dbname,$arr);
    }
}