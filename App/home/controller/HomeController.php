<?php

namespace App\home\controller;
use App\home\model\user;




class HomeController extends CommonController{

    
  

        public function main(){

          
            $data = user::user_select($this->_medoo_config(),'proc','*');
        
            echo $this->render('index.html',[
                 'data' => $data,
                 'PUBLIC_HOME' => PUBLIC_HOME
            ]);
        }
    }
