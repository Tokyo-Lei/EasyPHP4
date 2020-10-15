<?php
namespace App\admin\Controller\index;
use App\admin\controller\CommonController;
use App\Bootstrap;
use ValidateCode;
class IndexController extends CommonController {
    public function index() {
        if (!isset($_SESSION['session_name'])) {
            header('Location:' . '/admin/login');
            exit;
        }
        echo $this->render('index/index.html', ['PUBLIC_ADMIN' => PUBLIC_ADMIN, 'SESSION_WEB' => $_SESSION['session_code']]);
    }
}

