<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14 0014
 * Time: 上午 10:16
 *
 * 内容管理的软件下载
 */

namespace app\manager\controller;

use app\manager\controller\Base;

use app\manager\model\Download as LoadModel;

class Link extends Base{
//    软件下载数据遍历和删除
    public function yt_link(){
        if(input('delete')!=''){
            $row=Db('link')->where('id', input('delete'))->setField('del', 1);

            if($row!=false){
                $this->success('删除成功！','yt_link');
            }else{
                $this->error('删除失败！请重新删除！','yt_link');
            }
        }else{
            $download=Db('link')->where('del',0)->select();
            $this->assign('download',$download);
            echo $this->fetch();
        }
    }


    public function update_link(){
        if(input('id')!=''){
            $info=Db('link')->where('del',0)->where('id',input('id'))->find();
            $this->assign('info',$info);
            echo $this->fetch();
        }
        elseif(input('update')!=''){
            $data=$_POST;

            $id=input('update');
            $file = request()->file('file');
            if (isset($file)) {
                $info = $file->move(ROOT_PATH . '/public/Public/link/img/');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $a = $info->getSaveName();
                    $filep = str_replace("\\", "/", $a);
                    $filepath = '/Public/link/img/' . $filep;
                    $d['f_file'] = $filepath;
                    $data['path'] = $d['f_file'];
                } else {
                    echo $file->getError();
                }

            }
            $row=Db('link')->where('id',input('update'))->update($data);
            if ($row !== false) {
                $this->success('修改成功！', 'yt_link');
            } else {
                $this->error('修改失败！请重新修改...！',"update_link/id/.$id");
            }

        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }


//
    public function add_link(){
        if(input('url')!=''&&input('name')!='' && !empty($_FILES)){
            $data=$_POST;
            $file = request()->file('file');
            if (isset($file)) {
                $info = $file->move(ROOT_PATH . '/public/Public/link/img/');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $a = $info->getSaveName();
                    $filep = str_replace("\\", "/", $a);
                    $filepath = '/Public/link/img/' . $filep;
                    $d['f_file'] = $filepath;
                    $data['path'] = $d['f_file'];
                } else {
                    echo $file->getError();
                }
            }

            $row=Db('link')->insert($data);
            if ($row !== false) {
                $this->success('添加成功！', 'yt_link');
            } else {
                $this->error('添加失败！请重新添加...！',"add_link");
            }
        }
        else{

            echo $this -> fetch();
        }
    }
}