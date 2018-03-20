<?php
/*
 * 权限判断模块
 * 判断是否登录以及有无浏览权限
 * add by liang 2017-08-10
 */
namespace app\manager\controller;
use think\Controller;
use think\Session;
use app\manager\model\Base as BaseModel;
class Base extends Controller {
	public $admin;
	
	public function _initialize() {
		if(session::get('admin')=='') {
			getAlert(null,'/manager/Login/login');
			exit;
		}
		$this->admin = session::get('admin');
		$request = \think\Request::instance();
		$action_name=$request->action();
		$res = BaseModel::power($action_name,$this->admin);
		if(!$res) {
			echo "<script>alert('无权限进入');</script>";
			echo "<center><img src='/Public/img/404.gif'></center>";
			exit;
		}
	}
}