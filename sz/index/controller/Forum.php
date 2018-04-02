<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 9:40
 */

namespace app\index\Controller;
use think\Controller;

class Forum extends Controller{
    public function discul(){
        echo $this->fetch();
    }
    public function forumdisplay(){
        echo $this->fetch();
    }
    public function forumdisplay_list(){
        echo $this->fetch();
    }
    public function viewthred(){
        echo $this->fetch();
    }
}