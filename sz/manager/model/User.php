<?php
namespace app\manager\Model;
use think\Model;
class User extends Model{
	
	protected $table = 'yt_user';
	
	public static function del($id){
		return Db('user')->where('id',$id)->setField('del',1);
	}
	public static function count($map){
		return Db('user')->where($map)->where('del',0)->setField('del',1);
	}


}