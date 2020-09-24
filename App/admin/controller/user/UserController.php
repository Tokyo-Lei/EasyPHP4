<?php

namespace App\admin\Controller\user;
use App\admin\controller\CommonController;
use App\Bootstrap;
use App\admin\model\UserModel;

class UserController extends CommonController{







   // 管理角色组页面
   public function user_group(){


      new UserModel();

      $user = UserModel::select($this->_medoo_config(),'think_auth_group','*');
      

      echo $this->render('user/user_group.html',[
         'user' => $user,
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }
     // 新增管理角色组页面
   public function user_group_add(){

      $user = UserModel::select($this->_medoo_config(),'think_auth_group','*');
      
      echo $this->render('user/user_group_add.html',[
         'user' => $user,
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }

    // 注入管理角色组页面
   public function user_group_insert(){


      print_r($_POST);

      exit;

      $user = UserModel::insert($this->_medoo_config(),'think_auth_group',[

         
      ]);
      
   
   }


}