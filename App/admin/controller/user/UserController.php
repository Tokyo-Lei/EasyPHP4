<?php

namespace App\admin\Controller\user;
use App\admin\controller\CommonController;
use App\Bootstrap;
use App\admin\model\UserModel;
use App\admin\controller\user\UserValidate;
use App\Lib\Auth;
use ValidateCode;

class UserController extends CommonController{




   public function login(){

   session_start();

   session_destroy();

   echo $this->render('user/login.html',[
      'PUBLIC_ADMIN' => PUBLIC_ADMIN
   ]);

  }


  //验证码
  public function captcha(){

   session_start();

   $_vc = new ValidateCode(); 
   $_vc->doimg();  

   $_SESSION['session_code'] = $_vc->getCode();

  

  }


  //登录验证
  public function login_post(){

   session_start();

   if($_POST["captcha"] == $_SESSION['session_code']){
        
       if($_POST["username"] == 'admin' or $_POST["password"] == 'admin'){
         
         $result = [
            'status' => 1,
            'msg' => '登录成功!'
         ];
         echo json_encode($result,JSON_UNESCAPED_UNICODE);
         exit;
       }else{

         $result = [
            'status' => 2,
            'msg' => '您输入的登录用户名和密码不正确！'
         ];
         session_unset();
         exit;
       }
        
   }else{

      $result = [
         'status' => 3,
         'msg' => '您输入的验证码不正确！'
      ];
      session_unset();
      exit;
   }

   
  }



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