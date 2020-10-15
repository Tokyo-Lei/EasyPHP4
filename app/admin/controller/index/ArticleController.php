<?php
namespace App\admin\Controller\index;
use App\admin\controller\CommonController;
use App\Bootstrap;
use ValidateCode;
class ArticleController extends CommonController {
    public function index() {
        if (!isset($_SESSION['session_name'])) {
            header('Location:' . '/admin/login');
            exit;
        }
        echo $this->render('article/index.html', ['PUBLIC_ADMIN' => PUBLIC_ADMIN, 'PUBLIC_ROOT' => PUBLIC_ROOT, 'SESSION_WEB' => $_SESSION['session_code']]);
    }
    public function Upload() {
        $accepted_origins = array(
            "http://127.0.0.1",
            "https://127.0.0.1"
        );
        $uploadFolder = "Upload/";
        reset($_FILES);
        $tmp = current($_FILES);
        if (is_uploaded_file($tmp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }
            if (!in_array(strtolower(pathinfo($tmp['name'], PATHINFO_EXTENSION)) , array(
                "gif",
                "jpg",
                "png",
                "bmp"
            ))) {
                header("HTTP/1.1 400 Invalid file extension!");
                return;
            }
            $filePath = $uploadFolder . time() . '-' . md5($tmp['name']);
            move_uploaded_file($tmp['tmp_name'], $filePath);
            echo json_encode(array(
                'file_path' => $filePath
            ));
        } else {
            header("HTTP/1.1 500 Server Error!");
        }
    }
}

