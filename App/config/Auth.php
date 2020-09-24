<?php

return [
 
            'auth_on'           =>  true, // 认证开关
            'auth_type'         =>  1,    // 认证方式，1为实时认证；2为登录认证。
            'auth_group'        =>  'think_auth_group',        // 用户组数据表名
            'auth_group_access' =>  'think_auth_group_access', // 用户-用户组关系表
            'auth_rule'         =>  'think_auth_rule',         // 权限规则表
            'auth_user'         =>  'think_user',            // 用户信息表
            'auth_user_id_field'=>  'id', // 用户表ID字段名
            'administrator'     =>  [],   // 超级管理员列表

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