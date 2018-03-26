<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/16 0016
 * Time: 下午 5:36
 */
namespace  app\forum\Controller;
use app\login\controller\Base;
use app\forum\controller\Bad;
class Forum extends Base{
    public function forum(){
        parent::loginUser('/index/index/login');
        $data=Db('forum')->where('del',0)->order('top','DESC')->paginate(10, false, [
            'query' => request()->param(),
        ]);

        $this->assign('data',$data);
        $page= $data->render();
        $this->assign('page',$page);
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
        $data['author']=$user['username'];
        $data['account']=$user['account'];
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
          $data=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->order('top','DESC')->paginate(10, false, [
              'query' => request()->param(),
          ]);
        $content=Db('forum')->where('del',0)->where('id',input('pid'))->find();
        $this->assign('content',$content);
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
    function is_exist($str,$key){
        foreach($key as $v){
            if(strpos($str,$v)>-1){
                return true;
            }
        }
        return false;
    }
    public function bad(){

        $str=input('forum_name');
        $arr = Bad::bad();
        if($this->is_exist($str,$arr)){
            $arr1['res']='error';
           $arr1['msg']='含有敏感词汇';
        }
        else{
            $arr1['res']='success';;
        }
        return json($arr1);


    }
}