<?php

namespace App\admin\Controller\index;
use App\admin\controller\CommonController;
use App\Bootstrap;


class IndexController extends CommonController{


   public function index(){

     
      echo $this->render('index/index.html',[
         'PUBLIC_ADMIN' => PUBLIC_ADMIN
      ]);
   }



}