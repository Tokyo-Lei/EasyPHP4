<?php

namespace App\home\controller;
use Endroid\QrCode\QrCode;
class QrodeController{
        public function index(){
            $qrCode = new QrCode('恭喜你扫码成功！');
            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();
         
        }
    }
