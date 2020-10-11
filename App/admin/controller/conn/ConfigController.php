<?php
namespace App\admin\Controller\conn;
use App\admin\controller\CommonController;
use App\Bootstrap;
use File;
class ConfigController extends CommonController {
    public function index() {
        if (!isset($_SESSION['session_name'])) {
            header('Location:' . '/admin/login');
            exit;
        }
        echo $this->render('conn/index.html', ['PUBLIC_ADMIN' => PUBLIC_ADMIN, 'Web_Config' => Bootstrap::Web_Config() ]);
    }
    public function update() {
        $file_path = ROOT_PATH . '/App/config/Webconfig.php';
        $file_path_post = str_replace(" ", '', $_POST);
        function saveConfig($filename, $content) {
            file_put_contents($filename, "<?php\n\nreturn " . var_export($content, true) . ';');
        }
        saveConfig($file_path, $file_path_post);
        header('Location:' . '/admin/config');
        exit;
    }
    public function cache() {
        $admin_cache_path = ROOT_PATH . '/App/file/cache_admin/';
        $home_cache_path = ROOT_PATH . '/App/file/cache_home/';
        File::init($admin_cache_path)->removeAll();
        File::init($home_cache_path)->removeAll();
        header('Location:' . '/admin/');
        exit;
    }
}

