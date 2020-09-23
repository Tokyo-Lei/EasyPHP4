<?php

namespace App\admin\Controller\user;
use App\admin\controller\CommonController;
use App\Core;
use App\admin\model\UserModel;

class UserController extends CommonController{


   public function index(){

      $user = UserModel::select($this->_medoo_config(),'think_user','*');
      

      echo $this->render('user/index.html',[
         'user' => $user,
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }



}