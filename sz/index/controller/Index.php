<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/12 0012
 * Time: 上午 11:28
 */
namespace app\index\Controller;
use think\Controller;
use app\index\model\Bg as BgModel;
use app\login\controller\Base_s;
use think\Rsa;
use app\index\model\User as UserModel;
use think\Session;
use app\login\controller\Base;
class Index extends Base{
    public function index(){
        $bg=BgModel::bg();
       $this->assign('bg',$bg);
        echo $this->fetch();
    }
    public function rule(){
        $data=Db('rule')->where('del',0)->find();
        $this->assign('data',$data);
        echo $this->fetch();
    }
    public function about(){

        $about  =   Db('about');
        if(input('id')!=''){
            $about_act  =   $about->where('del',0)->where('id',input('id'))->find();
            $this->assign('title',$about_act['title']);
            $this->assign('content',html_entity_decode($about_act['content']));
            $this->assign('active1',$about_act['id']);
        }else{
            $about_act  =   $about->where('del',0)->order('serial','ASC')->limit(1)->find();
            $this->assign('title',$about_act['title']);
            $this->assign('content',html_entity_decode($about_act['content']));
            $this->assign('active1',$about_act['id']);
        }
        $about_list =   $about->where('del',0)->order('serial','ASC')->select();
        $this->assign('about_list',$about_list);

        echo $this->fetch();
    }
    public function down(){
        $download=Db('download')->where('del',0)->where('type',0)->select();
        $this->assign('download',$download);
        $download1=Db('download')->where('del',0)->where('type',1)->select();
        $this->assign('download1',$download1);
        echo $this->fetch();
    }
    public function help(){

        $help=Db('help');
        if(input('id')!=''){
            $help_act=$help->where('id',input('id'))->find();
            $this->assign('title',$help_act['title']);
            $this->assign('content',html_entity_decode($help_act['content']));
            $this->assign('id',$help_act['id']);
            $this->assign('par',$help_act['par_num']);

        }else{
            $help_act=$help->where('del',0)->where('par_num=1')->order('top','DESC')->limit(1)->find();
            $this->assign('title',$help_act['title']);
            $this->assign('content',html_entity_decode($help_act['content']));
            $this->assign('id',$help_act['id']);
            $this->assign('par',$help_act['par_num']);

        }
        $help_c1=$help->where('del',0)->where('par_num=1')->order('top','DESC')->select();

        $help_c3=$help->where('del',0)->where('par_num=2')->order('top','DESC')->select();
        $this->assign('help_c1',$help_c1);
        $this->assign('help_c3',$help_c3);


        echo $this->fetch();
    }

    public function register(){

        echo $this->fetch();
    }

    public function agency_register(){
        echo $this->fetch();
    }
        public function login(){


           echo $this->fetch();

    }
    public function active(){
            $data=Db('active')->where('del',0)->find();
            $this->assign('data',$data);
            echo $this->fetch();
    }


}