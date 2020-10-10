<?php

namespace App\admin\Controller\index;
use App\admin\controller\CommonController;
use App\Bootstrap;
use ValidateCode;

class ArticleController extends CommonController{


   public function index(){



      //判断是否为空
      // if(!isset($_SESSION['session_name'])){
      //    header('Location:'.'/admin/login');
      //    exit;
      // }


      echo $this->render('article/index.html',[
         'PUBLIC_ADMIN' => PUBLIC_ADMIN,
         'PUBLIC_ROOT' => PUBLIC_ROOT,
         'SESSION_WEB' => $_SESSION['session_code']
      ]);


   }

   public function Upload(){
      // Allowed the origins to upload 
      $accepted_origins = array("http://127.0.0.1", "https://127.0.0.1");
      // Images upload dir path
      $uploadFolder = "Upload/";
      reset($_FILES);
      $tmp = current($_FILES);

  

      if(is_uploaded_file($tmp['tmp_name'])){
         if(isset($_SERVER['HTTP_ORIGIN'])){
            if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
               header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            }else{
               header("HTTP/1.1 403 Origin Denied");
               return;
            }
         }
         // check valid file name
         if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $tmp['name'])){
            header("HTTP/1.1 400 Invalid file name!");
            return;
         }

         // check and Verify extension
         if(!in_array(strtolower(pathinfo($tmp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "bmp"))){
            header("HTTP/1.1 400 Invalid file extension!");
            return;
         }

         // Accept upload if there was no origin, or if it is an accepted origin
         $filePath = $uploadFolder . $tmp['name'];

       
         move_uploaded_file($tmp['tmp_name'], $filePath);

         // return successful JSON.
         echo json_encode(array('file_path' => $filePath));



      } else {
         header("HTTP/1.1 500 Server Error!");
      }
   }

}