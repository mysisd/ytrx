<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/13 0013
 * Time: 下午 10:59
 *
 * 内容管理的关于我们
 */

namespace app\manager\controller;

use app\manager\controller\Base;

use app\manager\model\Rule as  RegardModel;

class Rule extends Base{

//    内容管理的关于我们的数据遍历和删除
    public function yt_rule(){
        if(input('delete')!=''){
            $row = RegardModel::row();
            if($row){
                $this->success('删除成功！','yt_rule');
            }else{
                $this->error('删除失败！请重新删除','yt_rule');
            }
        }else{
            $about_list = RegardModel::lists();
            $this->assign('about_list',$about_list);
            echo $this->fetch();
        }
    }


//    修改信息
    public function update_rule(){
        if(input('id')!=''){
            $info   =   RegardModel::info();
            $this->assign('info',$info);
            echo $this->fetch();
        }else if(input('update')!=''){
            $id     =   input('update');

            $map['id'] = $id;
            $data['serial'] =   input('serial');
            $data['content']=   input('content');
            $data['title']  =   input('title');
            $data['date']   =   date('Y-m-d H:i:s');
            $row            =   RegardModel::updateData($map,$data);
            if($row !== false){
                $this->success('修改成功！','yt_rule');
            }else{
                $this->error('修改失败！请重新修改...',"/yt_rule/id/".$id);

            }
        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }


//    增加数据
    public function add_rule(){
        $arr=input('post.');
        if(empty($arr)){
            echo $this->fetch();
        }else{
            $serial = RegardModel::serial();
            if(input('serial')!=''){
                $data['serial'] = input('serial');
            }else{
                $data['serial'] = $serial['serial']+1;
            }
            $data['title'] = input('title');
            $data['content'] = input('content');
            $data['date'] = date('Y-m-d H:i:s',time());
            $row=RegardModel::add($data);
            if($row){
                $this->success('添加成功！','yt_rule');
            }else{
                $this->error('添加失败！请重新添加...','add_rule');

            }
        }
    }
}