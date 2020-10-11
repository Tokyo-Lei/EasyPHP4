<?php


namespace App\home\member;
use App\home\member\_Validate;
class LoginController {
    public function index() {
    }
    public function login() {
        $data = ['name' => 'thinkphp', 'email' => 'thinkphp', 'age' => 'thinkphp@qq.com222', ];
        $validateNew = new _Validate();
        if (!$validateNew->check($data)) {
            var_dump($validateNew->getError());
        }
    }
}

