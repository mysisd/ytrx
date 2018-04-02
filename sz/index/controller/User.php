<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 14:39
 */

namespace app\index\Controller;
use app\login\controller\Base;
use think\Session;
use think\Rsa;
class User extends Base{
    public function index(){
        $user=Db('user')->where('account',session('phone'))->where('del',0)->find();
        $this->assign('user',$user);
        echo $this->fetch();
    }
    public function apply_lingtou(){
        echo $this->fetch();
    }
    public function apply_refund(){
        echo $this->fetch();
    }
    public function grade_integration(){
        echo $this->fetch();
    }
    public function identity_prove(){
        echo $this->fetch();
    }
    public function inbox(){
        echo $this->fetch();
    }
    public function integration_record(){
        echo $this->fetch();
    }
    public function integration_rule(){
        echo $this->fetch();
    }
    public function investment_inquiry(){
        echo $this->fetch();
    }
    public function make_head(){
        echo $this->fetch();
    }
    public function make_password(){
        $old_pass=input('old_pass');
        $new_pass=input('new_pass');
        $con_pass=input('old_pass');
        $yzm=input('yzm');
        if(empty($old_pass)||empty($new_pass)||empty($con_pass)||empty($yzm)){
            $user=Db('user')->where('account',session('phone'))->where('del',0)->find();
            $this->assign('user',$user);
            echo $this->fetch();
        }else{
           $user= Db('user')->where('del',0)->where('account',session('phone'))->find();
            $old_pass  = Rsa::privDecrypt($old_pass);
            $old_pass1  = Rsa::privDecrypt($user['password']);
            if($old_pass!=$old_pass1){
                $arr['msg']='原密码输入错误';
                $arr['res']='error';
            }else if($yzm==session('code')){
                $data['password']=sha1($new_pass);
                $row=Db('user')->where('del',0)->where('account',session('phone'))->update($data);
                if($row){
                    $arr['res'] = 'success';
                    $data['logout_time']=date('Y-m-d H:i:s',time());
                    Db('user')->where('del',0)->where('account',session('phone'))->update($data);
                    session(null);
                    getAlert(null,'/');
                }
                return json($arr);
            }




        }




    }
    public function messages(){
        echo $this->fetch();
    }
    public function my_account(){
        echo $this->fetch();
    }
    public function my_info(){
        $user=Db('user')->where('account',session('phone'))->where('del',0)->find();
        $this->assign('user',$user);
        echo $this->fetch();
    }
    public function outbox(){
        echo $this->fetch();
    }
    public function project_manage(){
        echo $this->fetch();
    }
    public function touhou_manage(){
        echo $this->fetch();
    }
    public function update_user(){
        $data=input('post.');
       $row=Db('user')->where('del',0)->where('account',session('phone'))->update($data);
        if($row){
            $arr['res']=1;
        }
        return json($arr);
    }
    public function find_password(){
        $account=input('account');
        $yzm=input('yzm');
        $account  = Rsa::privDecrypt($account);
        $user= Db('user')->where('del',0)->where('account',$account)->find();
        if(empty($account)||empty($yzm)){
            echo $this->fetch();

        }else{
            if(empty($user)){
                $arr['res']='error';
                $arr['msg']='账号不存在';
            }
            else if($yzm==session('code')&&!empty($user)){
                $arr['res']='success';
                $arr['password']=$user['password'];

            }
            return json($arr);
        }

    }
    public function forum_list(){
        if(input('delete')!=''){
            $row =Db('forum_list')->where('id',input('delete'))->setField('del',1);;
            if($row){
                $this->success('删除成功！','forum_list');
            }else{
                $this->error('删除失败！请重新删除','forum_list');
            }
        }
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data=Db('forum_list')->where('del',0)->where('user_id',$user['id'])->paginate(20, false, [
            'query' => request()->param(),
        ]);
        $this->assign('data',$data);
        $page=$data->render();
        $this->assign('page',$page);
        echo $this->fetch();
    }
    public function update_forum(){
        if(input('update')!=''){
            $data['title']=input('title');
            $data['content']=input('content');
            $data['date']=date('Y-m-d H:i:s',time());
            $row= Db('forum_list')->where('id',input('update'))->update($data);
            if($row){
                $this->success('修改成功！','forum_list');
            }else{
                $this->error('修改失败！','forum_list');
            }
        }
        $id=input('id');
        $data=Db('forum_list')->where('del',0)->where('id',$id)->find();
        $this->assign('data',$data);
        echo $this->fetch();
    }
    public function reply_list(){
        if(input('delete')!=''){
            $row =Db('reply')->where('id',input('delete'))->setField('del',1);;
            if($row){
                $this->success('删除成功！','reply_list');
            }else{
                $this->error('删除失败！请重新删除','reply_list');
            }
        }
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data=Db('reply')->where('del',0)->where('user_id',$user['id'])->paginate(20, false, [
            'query' => request()->param(),
        ]);
        $this->assign('data',$data);
        $page=$data->render();
        $this->assign('page',$page);
        echo $this->fetch();
    }
    public function update_reply(){
        if(input('update')!=''){

            $data['reply']=input('content');
            $data['date']=date('Y-m-d H:i:s',time());
            $row= Db('reply')->where('id',input('update'))->update($data);
            if($row){
                $this->success('修改成功！','reply_list');
            }else{
                $this->error('修改失败！','reply_list');
            }
        }
        $id=input('id');
        $data=Db('reply')->where('del',0)->where('id',$id)->find();
        $this->assign('data',$data);
        echo $this->fetch();
    }
    public function forum_remind(){
        $user=Db('user')->where('del',0)->where('account',session('phone'))->find();
        $data=Db('reply')->where('del',0)->where('status',0)->where('user_id',$user['id'])->select();
        session('reply_num',count($data));

        $this->assign('data',$data);
        echo $this->fetch();
    }

}