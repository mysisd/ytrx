<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/17
 * Time: 17:02
 */

namespace app\manager\controller;
use app\manager\controller\Base;
use app\manager\model\Active as CenterModel;
class Active1 extends Base
{

    public function active(){
        if(input('delete')!=''){
            $row = CenterModel::row();
            if($row){
                $this->success('删除成功！','active');
            }else{
                $this->error('删除失败！请重新删除','active');
            }
        }else{
            $help_1 =   CenterModel::active_1();
            $help_2 =   CenterModel::active_2();
            $help_3 =   CenterModel::active_3();
            $this->assign('help_1',$help_1);
            $this->assign('help_2',$help_2);
            $this->assign('help_3',$help_3);
            echo $this->fetch();
        }
    }



    public function update_active(){
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

            $data['date']   =   time();
            $data['title']  =   input('title');
            $data['content']=   input('content');
            $data['par_num']=   input('par_num');
            $data['serial']=    input('serial');

            $row=CenterModel::saves($data);
            if($row !== false){
                $this->success('修改成功！','active');
            }else{
                $this->error('修改失败！请重新修改...',"/active/id/$id");

            }
        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }

    public function add_active(){
        $arr=input('post.');
        if(empty($arr)){
            echo $this->fetch();
        }else{
            $serial=CenterModel::serial();
            $data['par_num']    =   input('par_num');
            $data['title']      =   input('title');
            $data['content']    =   input('content');
            $data['serial']      =   $serial['serial']+1;
            $data['date']       =   date('Y-m-d H:i:s',time());
            $row                 =  CenterModel::add($data);
            if($row){
                $this->success('添加成功！','active');
            }else{
                $this->error('添加失败！请重新添加...',"/add_active/id/$id");
            }
        }

    }
}