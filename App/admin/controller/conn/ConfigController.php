<?php

namespace App\admin\Controller\conn;
use App\admin\controller\CommonController;
use App\Bootstrap;
use ValidateCode;

class ConfigController extends CommonController{


   public function index(){

      //判断是否为空
    //   if(!isset($_SESSION['session_name'])){
    //      header('Location:'.'/admin/login');
    //      exit;
    //   }

    

      echo $this->render('conn/index.html',[
         'PUBLIC_ADMIN' => PUBLIC_ADMIN,
         'Web_Config' => Bootstrap::Web_Config()
      ]);

   }

   public function update(){

      $file_path = ROOT_PATH.'/App/config/Webconfig.php';
        
       //过滤空格
       $file_path_post = str_replace(" ",'',$_POST);

  


        // @param string $filename 文件路径
        //@param mixed $content 保存的内容
        function saveConfig($filename, $content)
        {
             file_put_contents($filename, "<?php\n\nreturn " . var_export($content, true) . ';');
        }


        saveConfig($file_path,$file_path_post);

   }


   

 
  


}