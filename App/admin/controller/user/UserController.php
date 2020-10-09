<?php
namespace App\admin\Controller\user;
use App\admin\controller\CommonController;
use App\Bootstrap;
use App\admin\model\UserModel;
use App\admin\controller\user\UserValidate;
use App\library\Auth;
use ValidateCode;
use File;

class UserController extends CommonController {
	// 登录页面
	public function login() {
		echo $this->render('user/login.html',[
		         'PUBLIC_ADMIN' => PUBLIC_ADMIN
		      ]);
	}
	// 验证码
	public function captcha() {
		session_start();
		$_vc = new ValidateCode();
		$_vc->doimg();
		$_SESSION['session_code'] = $_vc->getCode();
	}
	//登录验证
	public function login_post() {
		session_start();
		header('Content-Type:application/json; charset=utf-8');
		//判断验证码是否正确
		if($_POST['captcha'] == $_SESSION['session_code']) {
         //判断提交数据是否和数据库相同
			if($_POST["username"] == 'admin' or $_POST["password"] == 'admin') {
				$result = [
				            'status' => 1,
				            'msg' => '登录成功!'
				         ];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
				$_SESSION['session_name'] = md5($_POST["username"]);
				exit;
			} else {
				$result = [
				            'status' => 2,
				            'msg' => '您输入的登录用户名和密码不正确！'
				         ];
				echo json_encode($result,JSON_UNESCAPED_UNICODE);
				session_unset();
				session_destroy();
				exit;
			}
		} else {
			$result = [
			         'status' => 3,
			         'msg' => '您输入的验证码不正确！'
			      ];
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
			session_unset();
			session_destroy();
			exit;
		}
	}
	// 管理角色组页面
	public function user_group() {
		// $user = UserModel::select($this->_medoo_config(),'think_auth_group','*');
		$user = UserModel::select_auth_group($this->medoo_conf());
		echo $this->render('user/user_group.html',[
		         'user' => $user,
		         'PUBLIC_ADMIN' => PUBLIC_ADMIN
		      ]);
	}
	// 新增管理角色组页面
	public function user_group_add() {
		echo $this->render('user/user_group_add.html',[
		         'PUBLIC_ADMIN' => PUBLIC_ADMIN
		      ]);
	}
	// 注入管理角色组页面
	public function user_group_insert() {
		// $post_data = $_POST;
		// $result['msg'] = '吃屎！';
		// echo json_encode($result,JSON_UNESCAPED_UNICODE);
		$post_data = $_POST;
		$UserValidate =new UserValidate();
		if (!$UserValidate->check($post_data)) {
			$result= $UserValidate->getError();
			echo $result;
			exit;
		}
		$user = UserModel::insert_auth_group($this->medoo_conf(),$_POST);
		echo $user->rowCount();
	}
	public function login_quit() {
		session_unset();
		session_destroy();
		$path_tmp = dirname($_SERVER['DOCUMENT_ROOT']).'/App/file/tmp';
		FILE::init($path_tmp)->removeFiles();
		header('Location:'.'/admin/login');
		exit;
	}
}