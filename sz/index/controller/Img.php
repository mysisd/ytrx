<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 11:01
 */

namespace app\index\Controller;
use app\login\controller\Base;
use think\Image;
class Img extends  Base{
    function mkdirs($dir)
    {
        if(!is_dir($dir))
        {
            if(!$this->mkdirs(dirname($dir))){
                return false;
            }
            if(!mkdir($dir,0777)){
                return false;
            }
        }
        chmod($dir, 777); //给目录操作权限
        return true;
    }
    public   function page_preview()
    {//出来ajaxupload的图片
        //如果有按钮图片先存放某个地方

//        $folder = "/Public/file/img/";
//        $this->mkDirs(ROOT_PATH . $folder);
//        $path = $folder.$_FILES['btn_pic']['name'];
//        $img_path = ROOT_PATH . $path;
        $file = request()->file('btn_pic');
        $info=$file->move(ROOT_PATH . '/public/Public/file/img/');
        $a = $info->getSaveName();
        $filep = str_replace("\\", "/", $a);
        $filepath = '/Public/file/img/' . $filep;
        $data['face'] = $filepath;
       $row= Db('user')->where('del',0)->where('account',session('phone'))->update($data);
        if($row)
        {

            $arr['file_infor']=1;
            $arr['file_url']=$filepath;
        }else
        {
            $arr['file_infor']=0;
        }
        return json($arr);
    }
}