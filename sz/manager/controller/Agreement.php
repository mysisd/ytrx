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

class Agreement extends Base{

//    内容管理的关于我们的数据遍历和删除
    public function yt_agreement(){
        if(input('delete')!=''){
            $row = Db('agreement')->where('id',input('delete'))->setField('del',1);;
            if($row){
                $this->success('删除成功！','yt_agreement');
            }else{
                $this->error('删除失败！请重新删除','yt_agreement');
            }
        }else{
            $about_list = Db('agreement')->where('del',0)->order('date desc')->select();
            $this->assign('about_list',$about_list);
            echo $this->fetch();
        }
    }


//    修改信息
    public function update_agreement(){
        if(input('id')!=''){
            $info   =  Db('agreement')->find(input('id'));
            $this->assign('info',$info);
            echo $this->fetch();
        }else if(input('update')!=''){
            $id     =   input('update');

            $map['id'] = $id;

            $data['content']=   input('content');
            $data['title']  =   input('title');
            $data['date']   =   date('Y-m-d H:i:s');
            $row            =   Db('agreement')->where('del',0)->where('id',$map)->update($data);
            if($row !== false){
                $this->success('修改成功！','yt_agreement');
            }else{
                $this->error('修改失败！请重新修改...',"/yt_agreement/id/".$id);

            }
        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }


//    增加数据
    public function add_agreement(){
        $arr=input('post.');
        if(empty($arr)){
            echo $this->fetch();
        }else{

            $data['title'] = input('title');
            $data['content'] = input('content');
            $data['date'] = date('Y-m-d H:i:s',time());
            $row=Db('agreement')->insert($data);
            if($row){
                $this->success('添加成功！','yt_agreement');
            }else{
                $this->error('添加失败！请重新添加...','add_agreement');

            }
        }
    }
}