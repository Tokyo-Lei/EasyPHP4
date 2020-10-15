<?php

namespace App\admin\controller\user;
use bang\validate\Validate;


class UserValidate extends Validate{



    protected $rule =   [
        'title'  => 'require|max:10',
        'status'   => 'number',
    ];
        
    protected $message  =   [
        'title.require' => '名称必须',
        'title.max'     => '名称最多不能超过10个字符',
        'status.number'   => '年龄必须是数字',
    ];

    protected $scene = [
        'add'  =>  ['title','text'],
    ];



}