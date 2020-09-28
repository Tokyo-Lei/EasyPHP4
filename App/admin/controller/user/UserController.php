<?php

namespace App\admin\Controller\user;
use App\admin\controller\CommonController;
use App\Bootstrap;
use App\admin\model\UserModel;
use App\admin\controller\user\UserValidate;
use App\Lib\Auth;

class UserController extends CommonController{





   // 管理角色组页面
   public function user_group(){


      
      // $user = UserModel::select($this->_medoo_config(),'think_auth_group','*');

      $user = UserModel::select_auth_group($this->medoo_conf());
      
      echo $this->render('user/user_group.html',[
         'user' => $user,
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }


     // 新增管理角色组页面
   public function user_group_add(){

     $_auth = new Auth();
     print_r($_auth);


      echo $this->render('user/user_group_add.html',[
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }



    // 注入管理角色组页面
   public function user_group_insert(){



      // $post_data = $_POST;
      // $result['msg'] = '吃屎！';
      // echo json_encode($result,JSON_UNESCAPED_UNICODE);



     


      $post_data = $_POST;

      $UserValidate =new UserValidate();

      if (!$UserValidate->check($post_data)) {
         $result= $UserValidate->getError();
         echo $result;
         exit;
      }

     
      $user = UserModel::insert_auth_group($this->medoo_conf(),$_POST);
   
      echo $user->rowCount();
   
   }


}