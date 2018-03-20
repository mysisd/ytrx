<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/12 0012
 * Time: 下午 3:57
 */

namespace app\manager\controller;
use think\Controller;
use app\manager\controller\Base;
use app\manager\model\Admin as adminModel;
use think\Session;

class Admin extends Base
{
    public function admin(){
        echo $this->fetch();
    }
    public function login(){
        echo $this->fetch();
    }


    /*
     * 主页左部
     * 根据权限显示左边列表
     */
    public function head() {
        $this->assign('admin',$this->admin);
        echo $this->fetch();
    }
    public function left() {
        $left = adminModel::left($this->admin);

        $this->assign('title',$left['title']);
        $this->assign('list',$left['list']);
        echo $this->fetch();
    }
    public function right() {
        echo $this->fetch();
    }

}