<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21
 * Time: 17:38
 */

namespace app\manager\controller;
use app\manager\controller\Base;

class Forum extends Base{
    public function yt_forum(){
        if(input('delete')!=''){
            $row= Db('forum')->where('id',input('delete'))->setField('del',1);
            if($row){
                $this->success('删除成功！','yt_forum');
            }else{
                $this->error('删除失败！请重新删除','yt_forum');
            }
        }else{
        $data=Db('forum')->where('del',0)->order('last_post_time','DESC')->select();
        $this->assign('data',$data);
        echo $this->fetch();
        }
    }
    public function update_forum(){
        echo $this->fetch();
    }
}