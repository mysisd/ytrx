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

        if(input('update')!=''){

            $data['top']=input('top');
            $row= Db('forum')->where('id',input('update'))->update($data);
            if($row){
                $this->success('置顶成功！','yt_forum');
            }else{
                $this->error('置顶失败！','yt_forum');
            }
        }
        else{
        $data=Db('forum')->where('del',0)->order('last_post_time','DESC')->select();
        $this->assign('data',$data);
        echo $this->fetch();
        }
    }
    public function update_forum(){
        echo $this->fetch();
    }
}