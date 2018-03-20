<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/9
 * Time: 14:18
 */

namespace app\manager\model;
use think\Model;

class Rule extends Model{
    public static function row(){
        return  Db('rule')->where('id',input('delete'))->setField('del',1);
    }
    public static function lists(){
        return Db('rule')->where('del',0)->order('serial asc')->select();
    }
    public static function info(){
        return Db('rule')->find(input('id'));
    }
    public static function preserve($data){
        return Db('rule')->strict(false)->where('id',input('update'))->update($data);
    }
    public static function serial(){
        return Db('rule')->order('serial desc')->limit('1')->find();
    }
    public static function add($data){
        return Db('rule')->insert($data);
    }
    public static function updateData($map,$data){
        $where	= " del = 0 ";
        foreach($map as $key => $val) {
            $where	.= " AND `".$key."` = '".$val."'";
        }

        $set	= '';
        foreach($data as $key => $val) {
            $set	.= empty($set) ? "" : " , ";
            $set	.= "`$key` = '$val'";
        }

        $sql	= "UPDATE `yt_rule` SET $set WHERE $where";
        $ret	= \think\Db::execute($sql);
        if(!$ret) {
            return false;
        }
        return true;
    }
}