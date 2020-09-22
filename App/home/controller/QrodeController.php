<?php

namespace App\home\controller;
// https://github.com/endroid/qr-code
use Endroid\QrCode\QrCode;


class QrodeController{

    
  

        public function index(){

            $qrCode = new QrCode('法克鱿！你不缴费怎么阅读文章？');
            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();
         
        }
    }
