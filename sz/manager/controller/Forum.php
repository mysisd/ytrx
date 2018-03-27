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
            $row =Db('forum')->where('id',input('delete'))->setField('del',1);;
            if($row){
                $this->success('删除成功！','yt_forum');
            }else{
                $this->error('删除失败！请重新删除','yt_forum');
            }
        }
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
    public function add_forum(){
        $arr=input('post.');
        if(empty($arr)){
            echo $this->fetch();
        }else{

            $data['author'] = '楼主';
            $data['forum_description'] = input('title');
            $data['subject'] = input('content');
            $data['last_post_time'] = date('Y-m-d H:i:s',time());
            $row=DB('forum')->strict(false)->insert($data);
            if($row){
                $this->success('添加成功！','yt_forum');
            }else{
                $this->error('添加失败！请重新添加...','add_forum');

            }
        }
    }
    public function forum(){
        if(input('id')!=''){
            $info   =   Db('forum')->find(input('id'));
            $this->assign('info',$info);
            echo $this->fetch();
        }else if(input('update')!=''){
            $id     =   input('update');

            $map['id'] = $id;

            $data['subject']=   input('content');
            $data['forum_description']  =   input('title');
            $data['last_post_time']   =   date('Y-m-d H:i:s');
            $row            =   Db('forum')->where('del',0)->where('id',$id)->update($data);
            if($row !== false){
                $this->success('修改成功！','yt_forum');
            }else{
                $this->error('修改失败！请重新修改...',"/yt_forum/id/".$id);

            }
        }else{
            echo "<center><img src='/Public/img/404.gif'></center>";
        }
    }
}