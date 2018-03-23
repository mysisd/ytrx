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
use think\PHPExcel;
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
	public function export(){
        if(input('code')) {
            if(input('code') != session('code')){
                $this->error('导出失败，验证码不正确','yt_xgjuser');
            }
            else if(session('code')!='' && input('code') == session('code')){
                $list = XgjuserModel::select();
                $csv_title=array('id','account','name','QQ','wechat','bank_card','invite_num','reg_time');
                $this->createtable($list,'盈透锐新-用户信息表',$csv_title,$csv_title);

            }

        }



    }
    /**
     * 创建(导出)Excel数据表格
     * @param  array   $list 要导出的数组格式的数据
     * @param  string  $filename 导出的Excel表格数据表的文件名
     * @param  array   $header Excel表格的表头
     * @param  array   $index $list数组中与Excel表格表头$header中每个项目对应的字段的名字(key值)
     * 比如: $header = array('编号','姓名','性别','年龄');
     *       $index = array('id','username','sex','age');
     *       $list = array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24));
     * @return [array] [数组]
     */
    protected function createtable($list,$filename,$header=array(),$index = array()){
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:filename=".$filename.".xls");
        $teble_header = implode("\t",$header);
        $strexport = $teble_header."\r";
        foreach ($list as $row){
            foreach($index as $val){
                $strexport.=$row[$val]."\t";
            }
            $strexport.="\r";

        }
        $strexport=  iconv('UTF-8', 'UTF-8',$strexport);

        exit($strexport);
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