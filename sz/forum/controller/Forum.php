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

        $data=Db('forum_list')->where('del',0)->order('date','DESC')->paginate(10, false, [
            'query' => request()->param(),
        ]);

        $this->assign('data',$data);
        $top_data=Db('forum_list')->where('del',0)->order('top','DESC')->paginate(10, false, [
            'query' => request()->param(),
        ]);
        $this->assign('top_data',$top_data);
        $forumdata=Db('forum')->where('del',0)->order('last_post_time','DESC')->select();
        $this->assign('forumdata',$forumdata);
        $this->assign('data',$data);
        $data=Db('reply')->where('del',0)->order('date','DESC')->paginate(10, false, [
            'query' => request()->param(),
        ]);
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
          $value=input('value');

            if(!empty($value)){
                $data_a=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->order($value,'DESC')->paginate(20, false, [
                    'query' => request()->param(),
                ]);
                $this->assign('data',$data_a);
                $data=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->order($value,'DESC')->paginate(20, false, [
                    'query' => request()->param(),
                ]);
//                $content=Db('forum')->where('del',0)->where('id',input('pid'))->find();
//                $this->assign('content',$content);
                $this->assign('id',$id);
//                $this->assign('data',$data);
//                $page= $data->render();
//                $this->assign('page',$page);

            }


          $data=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->where('top',1)->order('top','DESC')->paginate(20, false, [
              'query' => request()->param(),
          ]);
          $this->assign('data',$data);
          $data=Db('forum_list')->where('del',0)->where('par_id',input('pid'))->where('top',0)->order('date','DESC')->paginate(20, false, [
              'query' => request()->param(),
          ]);
        $content=Db('forum')->where('del',0)->where('id',input('pid'))->find();
        $this->assign('content',$content);
          $this->assign('id',$id);
          $this->assign('data_null',$data);
          $page= $data->render();
          $this->assign('page',$page);
          $a= Db('forum_list')->where('del',0)->where('id',input('id'))->where('par_id',input('pid'))->find();
          $count=1+$a['count'];
          $data_a['count']=$count;
          Db('forum_list')->where('del',0)->where('id',input('id'))->where('par_id',input('pid'))->update($data_a);
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
        $data['user_face']=$user['face'];
       $data['date']=date('Y-m-d H:i:s',time());
       $row=Db('forum_list')->strict(false)->insert($data);
       if(empty(input('title'))||empty(input('content'))){
           $this->error('发表失败！内容不能含有空值');

       }
       if(empty($user['face'])){
           getAlert('头像未设置','/index/user/index');

       }
        if($row){
            $this->success('发表成功！');
        }else{
            $this->error('发表失败！');
        }
//       if($row){
//           $arr['res']='success';
//       }else{
//           $arr['res']='error';
//       }
//       return json($arr);

    }
    public function lists(){
        $data['status']=1;

        Db('reply')->where('del',0)->where('id',input('self_id'))->update($data);
        $type=input('type');
        $author=input('author');
        $pid=input('pid');
        $this->assign('pid',$pid);
        $this->assign('id',input('id'));

        if(!empty($author)){
            $list=Db('reply')->where('del',0)->where('par_id',$pid)->where('t_id',input('id'))->where('reply_author',$author)->order('date', $type)->paginate(20, false, [
                'query' => request()->param(),
            ]);

        }else{
            $list=Db('reply')->where('del',0)->where('par_id',$pid)->where('t_id',input('id'))->order('date', $type)->paginate(20, false, [
            'query' => request()->param(),
        ]);

        }

        $page=$list->render();

        $this->assign('page',$page);




        $data=Db('forum_list')->where('par_id',$pid)->where('id',input('id'))->find();
        $this->assign('data',$data);


    $this->assign('page',$page);
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
        if(empty(input('content'))){
            $this->error('发表失败！内容不能含有空值');
        }else{
            $pid=input('pid');
        $id=input('id');
        $this->assign('pid',$pid);
        $this->assign('id',$id);
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data['user_id']=$user['id'];
        $data['par_id']=$pid;
        $data['t_id']=$id;
        $data['reply_author']=$user['username'];
        $data['reply']=input('content');
        $data['reply_to_posts']=input('post');
        $data['date']=date('Y-m-d H:i:s',time());
        $data['user_face']=$user['face'];
          $data['status']=input('status');
          $data['post_author']=input('post_author');
          $data['post_reply']=input('post_reply');
            $row=Db('reply')->strict(false)->insert($data);

        $num=Db('reply')->where('del',0)->where('t_id',$id)->where('par_id',$pid)->count();
        $data=Db('reply')->where('del',0)->where('t_id',$id)->where('par_id',$pid)->order('date desc')->limit(1)->find();
        $data_a['last_author']=$data['reply_author'];
        $data_a['last_date']=$data['date'];
        $data_a['num']=$num;
        Db('forum_list')->where('del',0)->where('id',$data['t_id'])->where('par_id',$data['par_id'])->update($data_a);
        if(empty($user['face'])){
            getAlert('头像未设置','/index/user/index');

        }

        if($row){
            $this->success('发表成功！');
        }else{
            $this->error('发表失败！');
        }
        }
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
  public function editUpload(){
        if($this->request->isPost()){
            $res['code']=0;
            $res['msg']='上传成功';
            $file=$this->request->file('file');
            $info=$file->move('../public/Public/upload/img');
            if($info){
                $res['data']['title']=$info->getFilename();
                $filePath='upload/img'.$info->getSaveName();
                $res['data']['src']='/'.$filePath;
            }else{
                $res['code']=1;
                $res['msg']='上传失败'.$file->getError();
            }
            return $res;

        }
  }
    }