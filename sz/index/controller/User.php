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

}