<?php

namespace App\admin\Controller\user;
use App\Core;
use App\admin\model;

class User{


   public function index(){

      $data = UserModel::user_select($this->_medoo_config(),'proc','*');

   }



}