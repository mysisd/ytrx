<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16 0016
 * Time: 下午 5:36
 */
namespace  app\forum\Controller;
use app\login\controller\Base;
class Forum extends Base
{
    public function forum(){
        parent::loginUser('/index/index/login');
        $data=Db('forum')->where('del',0)->order('last_post_time','DESC')->select();
       $this->assign('data',$data);
        echo $this->fetch();
    }
    public function add_forum(){
        parent::loginUser('/index/index/login');
        echo $this->fetch();
    }
    public function adds_forum(){
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data['user_id']=$user['id'];
        $data['forum_name']=input('forum_name');
        $data['forum_description']=input('forum_description');
        $data['subject']=input('subject');
        $data['last_post_time']=date('Y-m-d H:i:s',time());
        $row=Db('forum')->strict(false)->insert($data);
        if($row){
            $arr['res']='success';
        }
        else{
            $arr['res']='error';
        }
        return json($arr);
      }
      public function forum_list(){
        $id=input('pid');
          $data=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->paginate(10, false, [
              'query' => request()->param(),
          ]);

          $this->assign('id',$id);
          $this->assign('data',$data);
          $page= $data->render();
          $this->assign('page',$page);
          echo $this->fetch();
      }
      public function add_list(){
          $this->assign('pid',input('pid'));
          echo $this->fetch();
      }
    public function add_lists(){
       $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
       $data['user_id']=$user['id'];
       $data['author']=$user['username'];
       $data['title']=input('title');
       $data['content']=input('content');
       $data['par_id']=input('pid');
       $data['date']=date('Y-m-d H:i:s',time());
       $row=Db('forum_list')->strict(false)->insert($data);
       if($row){
           $arr['res']='success';
       }else{
           $arr['res']='error';
       }
       return json($arr);

    }
    public function lists(){
        $pid=input('pid');
        $this->assign('pid',$pid);
        $data=Db('forum_list')->where('par_id',$pid)->where('id',input('id'))->find();
        $this->assign('data',$data);
        $list=Db('reply')->where('del',0)->where('par_id',$pid)->where('t_id',input('id'))->paginate(10);
       $this->assign('list',$list);
        echo $this->fetch();
    }
    public function reply(){
        $pid=input('pid');
        $id=input('id');
        $this->assign('pid',$pid);
        $this->assign('id',$id);
        echo $this->fetch();
    }
    public function add_reply(){
        $pid=input('pid');

        $id=input('id');
        $this->assign('pid',$pid);
        $this->assign('id',$id);
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data['user_id']=$user['id'];
        $data['par_id']=$pid;
        $data['t_id']=$id;
        $data['reply_author']=$user['username'];
        $data['reply']=input('reply');
        $data['date']=date('Y-m-d H:i:s',time());

        $row=Db('reply')->strict(false)->insert($data);
        if($row){
            $arr['res']='success';
        }else{
            $arr['res']='error';
        }
        return json($arr);
    }
}