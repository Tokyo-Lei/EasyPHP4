<?php

namespace App\admin\Controller\index;
use App\admin\controller\CommonController;
use App\Bootstrap;
use ValidateCode;

class ArticleController extends CommonController{


   public function index(){

      //判断是否为空
      if(!isset($_SESSION['session_name'])){
         header('Location:'.'/admin/login');
         exit;
      }


      echo $this->render('article/index.html',[
         'PUBLIC_ADMIN' => PUBLIC_ADMIN,
         'PUBLIC_ROOT' => PUBLIC_ROOT,
         'SESSION_WEB' => $_SESSION['session_code']
      ]);




   }



}