<?php

return [
 
            'auth_on' => true, // 权限开关
            'auth_cache' => false, //是否开启缓存
            'auth_key' => '_auth_', // 数据缓存的key
            'auth_rule' => 'user_auth_rule', // 权限规则表
            'role' => 'user_auth_role', // 角色表
            'role_user' => 'user_role_user', // 用户角色对应表
            'users' => 'user', // 用户信息表
            'users_auth_fields' => '',//用户需要验证的规则表达式字段 空代表所有用户字段

            //不需要登录的
            'no_need_login_url' => [
                '/public/login'
            ],

            //登录用户不需要验证的
            'allow_visit' => [
                '/file/upload'
            ],
            //默认登陆页面
            'login_path' => 'login/login',
 
];