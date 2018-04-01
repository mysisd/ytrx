<?php
namespace app\login\controller;
use think\Controller;
use app\login\model\User as UserModel;
use think\Session;
use think\Rsa;
use app\login\controller\Base_s;
use app\login\controller\Base;
class Login extends Base {

    public function logins(){


        $_POST['phone']    = Rsa::privDecrypt(input('phone'));
        $_POST['password'] = Rsa::privDecrypt(input('password'));

        $map['account'] = $_POST['phone'];
        $phone_user   = UserModel::getfind($map);

        if(!empty($phone_user)){
            if($phone_user['password'] == sha1($_POST['password'])){

                $data['login_time'] = date('Y-m-d H:i:s',time());
                UserModel::saves($phone_user['id'],$data);


                session('username'      , $phone_user['username']);
                session('uniqid'     , $phone_user['uniqid']);
                session('phone'      , $phone_user['account']);

                $arr['ret'] = 'success';
            }else{
                $arr['msg'] = '账号/密码错误';
                $arr['ret'] = 'error';
            }
        }else{
            $arr['ret']     = 'null';
            $arr['msg'] = '该手机还未注册';
        }
        return json($arr);

    }
    public function sms_login(){


        $_POST['phone']    = Rsa::privDecrypt(input('phone'));


        $map['account'] = $_POST['phone'];
        $phone_user   = UserModel::getfind($map);

        if(!empty($phone_user)){
            if(input('yzm')==session('code')&&$_POST['phone']==session('code_phone')){

                $data['login_time'] = date('Y-m-d H:i:s',time());
                UserModel::saves($phone_user['id'],$data);

                session('uniqid'     , $phone_user['uniqid']);
                session('phone'      , $phone_user['account']);

                $arr['ret'] = 'success';
            }else{
                $arr['msg'] = '验证码错误';
                $arr['ret'] = 'error';
            }
        }else{
            $arr['ret']     = 'null';
            $arr['msg'] = '该手机还未注册';
        }
        return json($arr);

    }

    public function logout(){
        $data['logout_time']=date('Y-m-d H:i:s',time());
        Db('user')->where('del',0)->where('account',session('phone'))->update($data);
        session(null);
        getAlert(null,'/');

    }

    //密码找回
    public function findpwd(){
        if(!empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['code']) ){
            session_start();
            $arr = array();
            if($_POST['code']==$_SESSION['code'] && $_POST['phone']==$_SESSION['code_phone']){
                $_SESSION = array();
                session(null);

                $map['phone']     = $_POST['phone'];
                $data['password'] = sha1($_POST['password']);

                $row = UserModel::getsave($map,$data);
                if($row!==false){
                    $arr['ret'] = 'success';
                }
            }else{
                $arr['ret'] = 'error';
            }
            return json($arr);
        }else{
            echo $this->fetch();
        }
    }

    //验证是否已注册
    public function has_phone(){


        $map['account'] = input('phone');


        $phone = Db('user')->where('del',0)->where($map)->find();


        if(!empty($phone)){
            $arr['flag']=1;

        }else{
            $arr['flag'] =0;
            $arr['msg']='账号未注册';
        }
        return json($arr);
    }

    public function is_invite_code(){
        $invitelist = Db('user');

        $arr['flag']        = 0;

        $map['invite_num'] = $_POST['invite_code'];

        $invite = $invitelist->where('del',0)->where($map)->count();
        if($invite!=0){
            $arr['flag'] = 1;
        }
        return json($arr);
    }
    public function send_code(){
        $arr=Base_s::sendMsg(input('phone'));
        if($arr['Code']=='isv.MOBILE_NUMBER_ILLEGAL'){
            $res['status']=0;
            $res['msg']='手机号码格式错误';
        }else{
            $res['status']=1;
        }
        return json($res);
    }
    public function registers(){
        session_start();
        $arr = array();
        $privDecrypt['phone']    = Rsa::privDecrypt(input('userphone'));
        $privDecrypt['password'] = Rsa::privDecrypt(input('userpwd'));

        $_POST['phone']    = $privDecrypt['phone'];
        $_POST['password'] = $privDecrypt['password'];

        $map['account'] = $_POST['phone'];
        $phone = UserModel::getfind($map);
        if(!empty($phone)){
            $arr['returntype'] = 1;
            $arr['msg'] = '手机号重复';
        }elseif(input('yzm')==session('code') && $_POST['phone']==session('code_phone')){
            $_SESSION = array();
            session(null);
            $data['belong']   = 'xmytrx';
            $data['uniqid']   = sha1(uniqid());
            $data['QQ']   = input('QQ');
            $data['wechat']   = input('wechat');
            $data['username']   = 'ytrx_'.substr($_POST['phone'],-4);
            $data['account']    = $_POST['phone'];
            $data['invite']   = input('invite');
            $data['invite_num']   = substr(uniqid(),-6);
            $data['preference']   = input('preference');
            $data['name']   = input('name');
            $data['bank_card']   = input('bank_card');
            $data['email']   = input('email');
            $data['password'] = sha1($_POST['password']);
            $data['reg_time'] = date('Y-m-d H:i:s',time());


            $row = UserModel::insert($data);
            if($row){
                session('face'    , null);
                session('uniqid'  , $data['uniqid']);
                session('phone'   , $data['account']);

                $arr['status'] = 'success';
                $user=Db('user')->where('account',session('phone'))->where('del',0)->find();
                 $user=Db('xgjaccount')->where('id',$user['id'])->find();
                $data_xgj['xgjaccount']=$user['account'];
                $data_xgj['xgjpass']=$user['password'];
                Db('user')->where('account',session('phone'))->where('del',0)->update($data_xgj);
                Base_s::sendMsg_open_success($_POST['phone'],$user['account'],$user['password'],$user['invite_num']);
            }
        }else{
            $arr['returntype'] = 2;
            $arr['msg'] = '注册不成功';
//
        }
//
        return json($arr);

    }


}