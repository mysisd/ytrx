<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/14 0014
 * Time: 上午 8:46
 */

namespace app\manager\model;
use think\Model;

class Active extends Model{
    public static function row(){
        return Db('active')->where('id',input('delete'))->setField('del',1);
    }
    public static function active_1(){
        return Db('active')->where('par_num=1')->where('del',0)->order('serial asc')->select();
    }
    public static function active_2(){
        return Db('active')->where('par_num=2')->order('serial asc')->select();
    }
    public static function active_3(){
        return Db('active')->where('par_num=3')->order('serial asc')->select();
    }
    public static function info(){
        return Db('active')->find(input('id'));
    }
    public static function saves($data){
        return Db('active')->strict(false)->where('id',input('update'))->update($data);
    }
    public static function serial(){
        return Db('active')->where('par_num',input('par_num'))->order('serial desc')->limit(1)->find();
    }
    public static function add($data){
        return Db('active')->insert($data);
    }
}
