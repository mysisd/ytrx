<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 14:39
 */

namespace app\index\Controller;
use app\login\controller\Base;

class User extends Base{
    public function index(){
        Db('user')->
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
        echo $this->fetch();
    }
    public function messages(){
        echo $this->fetch();
    }
    public function my_account(){
        echo $this->fetch();
    }
    public function my_info(){
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

}