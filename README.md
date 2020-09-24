# EasyPHP4



![Image text](https://raw.githubusercontent.com/Tokyo-Lei/EasyPHP4/master/Public/Home/img/logo.png)


EasyPHP Framework 4 是基于composer开发的第四代PHP MVC框架！多层模型（M）、视图（V）、控制器（C）的设计模式。今后浮生孵生对各个应用场景，比如：用户中心、博客、文章CMS等。

[![](https://img.shields.io/badge/version-4.0.0-green.svg)](https://img.shields.io/badge/version-4.0.0-green.svg)
[![](https://img.shields.io/badge/php-7+-brightgreen.svg)](https://img.shields.io/badge/php-7+-brightgreen.svg)
[![](https://img.shields.io/badge/mysql-5+-orange.svg)](https://img.shields.io/badge/mysql-5+-orange.svg)
[![](https://img.shields.io/badge/license-Apache%202-blue.svg)](https://img.shields.io/badge/license-Apache%202-blue.svg)



## 运行环境


- PHP：7.0 以上
- Composer：2.0RC-1
- PSR标准：PSR-4
- 后台风格基于bootswatch litera



## 更新日志

- 2020年9月15日 准备开发新框架
- 2020年9月21日 完成主体架构
- 2020年9月22日 新增whoops、qr-code
- 2020年9月23日 新增后台、删除ThinkPHP-auth、新增Auth库、修改核心

## 协议说明

- 本代码开源遵循MIT协议。
- 部分代码来源第三方


## 目录结构
```php
App		
   |-	home                         //前台目录
         |-controller
             |-HomeController.php
         |- model
         |- templates
         |- member 
   |- config
   |-	Bootstrap.php 
   |- Router.php
Public
   | - index.php 
vendor
   | -
```

## 第三方类库

- Twig      模板引擎
- medoo     数据库框架
- macaw     路由
- validate  Thinkphp验证
- whoops    错误提示
- monolog   日志

正在开发中...
