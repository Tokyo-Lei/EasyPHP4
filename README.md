# EasyPHP4


<p align="center">
   <img src="https://raw.githubusercontent.com/Tokyo-Lei/EasyPHP4/master/Public/Home/img/logo.png">
</p>
<p align="center">
  这是设计师开发的框架，你相信么？
</p>

<p align="center">
<img src="https://img.shields.io/badge/version-4.0.0-green.svg">
<img src="https://img.shields.io/badge/php-7+-brightgreen.svg">
<img src="https://img.shields.io/badge/mysql-5+-orange.svg">
<img src="https://img.shields.io/badge/license-MIT-blue.svg">
</p>



## 简介


EasyPHP Framework 4 是为快速开发而生框架,基于composer开发的第四代PHP MVC框架！多层模型（M）、视图（V）、控制器（C）的设计模式。即将孵生针对各个应用场景，比如：用户中心、博客、文章CMS等。





## 安装环境


- PHP：7.0 以上
- Composer：2.0RC-1
- PSR标准：PSR-4
- 后台风格基于bootswatch litera


## 开源协议

MIT许可


## 更新日志

- 2020年9月15日 准备开发新框架
- 2020年9月21日 完成主体架构
- 2020年9月22日 新增whoops、qr-code
- 2020年9月23日 新增后台、删除ThinkPHP-auth、新增Auth库、修改核心
- 2020年9月24日 新增用户组管理、ajax提交、validate验证规则
- 2020年10月09日 修正验证码、后台简单的session验证、增加上传类、Tinymce5编辑器
- 2020年10月10日 新增后台数据配置、删除缓存、快速撰写
- 2020年10月11日 框架主体完成

## 协议说明

- 本代码开源遵循MIT协议。
- 部分代码来源第三方


## 目录结构
```php
App
   |- admin          //后台目录
        |-controller //控制器
             |-conn  //配置控制器文件夹
             |-index //后台首页控制器文件夹
             |-user  //用户控制器文件夹
         |- model    //模型
             |-UserModel.php //用户模型
         |- view     //视图
             |- article //文章视图文件夹
             |- conn    //配置视图文件夹
             |- include //页头、页脚、导航等视图文件夹
             |- index   //后台首页视图文件夹
             |- user    //用户登录等视图文件 夹
   |-	home              //前台目录
         |-controller     //前台控制器
             |-HomeController.php    //前台控制器
         |- model        //前台模型 
         |- templates    //前台模板
         |- member       //前台用户中心
   |- config  //配置文件夹
   |- file    //缓存文件夹 
   |- library //类库
   |-	Bootstrap.php  //主体核心文件
   |- Router.php     //路由
Public
   | - index.php     //PHP启动文件
vendor               //composer 第三方类库文件夹

```


## 使用安装


直接下载源码composer安装第三方库

```php
composer install
```

数据库配置

数据库表easyphp
用户名和密码分别是 `admin`

直接composer安装

```php
composer require tokyo-lei/easyphp4
```

## 引入组件

- Twig      模板引擎
- medoo     数据库框架
- macaw     路由
- validate  Thinkphp验证
- whoops    错误提示
- monolog   日志
- qr-code   生成二维码
- upload    上传
- Tinymce   编辑器


