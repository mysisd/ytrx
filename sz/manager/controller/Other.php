<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/26
 * Time: 14:14
 */

namespace app\manager\controller;
use think\Request;
use app\manager\controller\Base;
use think\File;
class Other extends Base{
    public function yt_other(){
        if(input('delete')!=''){
            $row=Db('other')->where('id', input('delete'))->setField('del', 1);

            if($row!=false){
                $this->success('删除成功！','yt_other');
            }else{
                $this->error('删除失败！请重新删除！','yt_other');
            }
        }else{
            $other=Db('other')->where('del',0)->select();
            $this->assign('other',$other);
            echo $this->fetch();
        }
    }
    public function add_other(){
        if(input('name')!='' && !empty($_FILES)){
            $data=$_POST;
            $file = request()->file('file');
            if (isset($file)) {
                $info = $file->move(ROOT_PATH . '/public/Public/other/file/');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $a = $info->getSaveName();
                    $a = iconv("UTF-8","UTF-8",  $info->getInfo()['name']);

                    $filep = str_replace("\\", "/", $a);
                    $filepath = '/Public/other/file/' . $filep;
                    $d['f_file'] = $filepath;
                    $data['path'] = $d['f_file'];
                } else {
                    echo $file->getError();
                }
            }

            $row=Db('other')->insert($data);
            if ($row !== false) {
                $this->success('添加成功！', 'yt_other');
            } else {
                $this->error('添加失败！请重新添加...！',"add_other");
            }
        }
        else{

            echo $this -> fetch();
        }
    }
    public function update_other(){
        if(input('id')!=''){
            $info=Db('other')->where('del',0)->where('id',input('id'))->find();
            $this->assign('info',$info);
            echo $this->fetch();
        }
        elseif(input('update')!=''){
            $data=$_POST;

            $id=input('update');

            $file = request()->file('file');


            if (isset($file)) {
                $info = $file->move(ROOT_PATH . '/public/Public/other/file/');
                if ($info) {
                    // 成功上传后 获取上传信息

                    $a = $info->getSaveName();
                    $a = iconv("UTF-8","UTF-8",  $info->getInfo()['name']);
                    $filep = str_replace("\\", "/", $a);
                    $filepath = '/Public/other/file/' . $filep;
                    $d['f_file'] = $filepath;
                    $data['path'] = $d['f_file'];


                } else {
                    echo $file->getError();
                }

            }
            $row=Db('other')->where('id',input('update'))->update($data);
            if ($row !== false) {
                $this->success('修改成功！', 'yt_other');
            } else {
                $this->error('修改失败！请重新修改...！',"update_other/id/.$id");
            }

        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }

}