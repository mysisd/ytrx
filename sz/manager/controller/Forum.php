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
            $data=Db('forum')->where('del',0)->order('top','DESC')->paginate(10, false, [
                'query' => request()->param(),
            ]);
        $this->assign('data',$data);
            $page= $data->render();
            $this->assign('page',$page);
        echo $this->fetch();
        }
    }
    public function update_forum(){
        if(input('update')!=''){

            $data['top']=input('top');
            $row= Db('forum_list')->where('id',input('update'))->update($data);
            if($row){

                $this->success('置顶成功！','/manager/forum/update_forum/id/'.input('pid'));
            }else{
                $this->error('置顶失败！','/manager/forum/update_forum/id/'.input('pid'));
            }
        }else{
            $con=Db('forum')->where('del',0)->where('id',input('id'))->find();
            $data=Db('forum_list')->where('del',0)->where('par_id',input('id'))->paginate(10, false, [
                'query' => request()->param(),
            ]);
            $this->assign('con',$con);
            $this->assign('data',$data);
            $page= $data->render();
            $this->assign('page',$page);
            echo $this->fetch();
        }
    }
    public function yt_reply(){
        $tid=input('tid');
        $pid=input('pid');

        $data=Db('reply')->where('del',0)->where('t_id',$tid)->where('par_id',$pid)->paginate(10, false, [
            'query' => request()->param(),
        ]);
        $this->assign('data',$data);
        $page=$data->render();
        $this->assign('page',$page);
        echo $this->fetch();
    }
}