<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14 0014
 * Time: 上午 8:46
 *
 * 内容管理的帮助中心
 */

namespace app\manager\controller;

use app\manager\controller\Base;

use app\manager\model\Help as CenterModel;

class Help extends Base{
//    帮助中心的数据遍历和软删除
    public function yt_help(){
        if(input('delete')!=''){
            $row = CenterModel::row();
            if($row){
                $this->success('删除成功！','yt_help');
            }else{
                $this->error('删除失败！请重新删除','yt_help');
            }
        }else{
            $help_1 =   CenterModel::help_1();

            $this->assign('help_1',$help_1);


            echo $this->fetch();
        }
    }


//    修改帮助中心的信息
    public function update_help(){
        if(input('id')!=''){
            $info = CenterModel::info();
            $this->assign('info',$info);
            echo $this->fetch();
        }else if(input('update')!=''){
            $id = input('update');

            $data['date']       =   time();
            $data['title']      =   input('title');
            $data['content']    =   input('content');
            $data['par_num']    =   input('par_num');
            $data['serial']     =    input('serial');

            $data['date']   =   date('Y-m-d H:i:s',time());
            $data['title']  =   input('title');
            $data['content']=   input('content');
            $data['par_num']=   input('par_num');
            $data['serial']=    input('serial');
            $data['top']=    input('top');





            $row=CenterModel::saves($data);
            if($row !== false){
                $this->success('修改成功！','yt_help');
            }else{
                $this->error('修改失败！请重新修改...',"/yt_help/id/$id");

            }
        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }


//    增加帮助中心的信息
    public function add_help(){
      $arr=input('post.');
        if(empty($arr)){
           echo $this->fetch();
        }else{
            $serial=CenterModel::serial();

            $data['title']      =   input('title');
            $data['par_num']      =   input('par_num');
            $data['content']    =   input('content');
            $data['top']    =   input('top');
            $data['serial']      =   $serial['serial']+1;
            $data['date']       =   date('Y-m-d H:i:s',time());
            $row                 =  CenterModel::add($data);
            if($row){
                $this->success('添加成功！','yt_help');
            }else{
                $this->error('添加失败！请重新添加...',"/add_help/id/$id");
            }
        }

    }
}