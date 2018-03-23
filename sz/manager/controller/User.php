<?php
/*
 * 信管家用户管理模块
 * 增、改、查、删
 * add by liang 2017-08-10
 */
namespace app\manager\controller;
use app\manager\controller\Base;
use app\manager\model\User as XgjuserModel;
use think\Csv;
class User extends Base {
	public function yt_xgjuser() {
		if(input('delete')!='') {
			$row = XgjuserModel::del(input('delete'));
			if($row) {
				$this->success('删除成功','yt_xgjuser');
			}else{
				$this->error('删除失败！请重新删除','yt_xgjuser');
			}
		}else{
			$map = array();
			if(input('condition')!='' && input('value')!='') {
				$map[input('condition')] = array('like',input('value').'%');
			}

			$userlist = XgjuserModel::where($map)->where('del',0)->order('account')->paginate(30,false,['query' => input('param.')]);
			$page = $userlist->render();
			$this->assign('userlist',$userlist);
			$this->assign('page',$page);
			return $this->fetch();
		}
	}
	public function export() {


				$list = XgjuserModel::select();
				$csv_title=array('id','手机号','姓名','QQ','微信','银行卡','喜好品种','邀请码','注册时间');
               			Csv::put_csv($list,$csv_title);


	}
   public function  export_csv($data)
    {
        $string="";
        foreach ($data as $key => $value)
        {
            foreach ($value as $k => $val)
            {
                $value[$k]=iconv('utf-8','gb2312',$value[$k]);
            }

            $string .= implode(",",$value)."\n"; //用英文逗号分开
        }
        $filename = date('Ymd').'.csv'; //设置文件名
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $string;
    }
	public function detail_xgjuser()
    {
        if (input('id')!='') {
            $userinfo = Db('user')->where('id', input('id'))->find();

            $this->assign('userinfo', $userinfo);
            $mo = Db('user')->where('account', $userinfo['account'])->find();

            $this->assign('mo', $mo);
            return $this->fetch();

        }
    }
	public function add_xgjuser(){
		if($_POST['account']!=''){
			$xgj_row = XgjuserModel::get(['account' => $_POST['account']]);
			if(!$xgj_row){
				if($_POST['cardprovince']='请选择'){
					$_POST['cardprovince']=null;
					$_POST['cardcity']=null;
				}
				$add_row = XgjuserModel::create($_POST);
				if($add_row){
					$this->success('添加成功','yt_xgjuser');
				}else{
					echo "<script>alert('添加失败,请重新添加);history.back(-1);</script>";
				}
			}else{
				echo "<script>alert('添加失败！改账号已存在');history.back(-1);</script>";
			}
		}else{
			return $this->fetch();
		}
	}
}