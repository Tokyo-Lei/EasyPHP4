<?php

return [
 
            'code_charset'           =>  'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ123456789', //随机因子
            'code_len'          =>  4,    //验证码长度
            'code_width'        =>  150,  // 宽度
            'code_height'       =>  44,   // 高度
            'code_fontsize'         =>  22 ,    // 指定字体大小

            'database_type' => 'mysql',
            'database_name' => 'easyphp',
            'server' => 'localhost',
            'username' => 'root',
            'password' => 'root',


            'debug' => true,
            'cache' => './file/cache_admin',
            'auto_reload' => true,
            

];