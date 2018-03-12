<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/12 0012
 * Time: 上午 11:28
 */
namespace app\index\Controller;
use think\Controller;
class Index extends Controller{
    public function index(){
        echo $this->fetch();
    }
}