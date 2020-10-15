<?php

namespace App\home\model;
class User {
    public function __construct() {
    }
    public static function user_select($_dbs, $dbname, $arr) {
        return $_dbs->select($dbname, $arr);
    }
}

