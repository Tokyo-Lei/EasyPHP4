<?php

namespace App\home\model;




class User{

    // protected $_DB;


    public function __construct(){
        // echo 2;
    }


    //查询用户
    public static function user_select($_dbs,$dbname,$arr){
        return $_dbs -> select($dbname,$arr);
    }
 
    
}