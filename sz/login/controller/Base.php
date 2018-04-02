<?php
/*
 * 前台判断登录
 */
namespace app\login\controller;
use think\Controller;
use app\login\model\User as UserModel;
use think\Session;
class Base extends controller {

	public static function loginUser($url='') {
		if(session('phone')=='' && session('uniqid')=='') {
			if(!empty($url)) getAlert(null,$url);
			return false;
		}
		$map['account']  = session('phone');
		$map['uniqid'] = session('uniqid');
		
		$user = UserModel::getfind($map);
		if(empty($user)) {
			if(!empty($url)) getAlert(null,$url);
			return false;
		}
        $data=Db('reply')->where('del',0)->where('status',0)->where('user_id',$user['id'])->count();
        session('reply_num',$data);
		
		return $user;
	}
	

}