<?php
/*
 * 权限判断模块
 * 判断是否登录以及有无浏览权限
 * add by liang 2017-08-10
 */
namespace app\login\controller;
use think\Controller;
use think\Session;
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
class Base_s extends Controller {

    public static function sendMsg($mobile){
  //     require_once 'C:/AppServ/www/sz/public/Api/api_sdk/vendor/autoload.php';
       require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102265018');
        session_start();
        $code=rand(100000,999999);
        session('code',$code);
        session('code_phone',$mobile);
        // 可选，设置模板参数
        $templateParam=[
            'code'=>$code,
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);

        return $result;
    }
    public static function sendMsg_open_success($mobile,$account,$password){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102240045');

        // 可选，设置模板参数
        $templateParam=[
            'account'=>$account,
            'password'=>$password
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        return $result;
    }
    public static function sendMsg_open_error($mobile,$text){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102310054');

        // 可选，设置模板参数
        $templateParam=[
            'phone'=>$mobile,
            'text'=>$text
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        return $result;
    }
    public static function sendMsg_deposit_success($mobile,$account,$money){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102220052');
        // 可选，设置模板参数
        $templateParam=[
            'account'=>$account,
            'money'=>$money
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        dump($result);
        dump(json_encode($templateParam));
        return $result;
    }
    public static function sendMsg_deposit_error($mobile,$account,$money){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102995027');
        // 可选，设置模板参数
        $templateParam=[
            'account'=>$account,
            'money'=>$money
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        dump($result);
        dump(json_encode($templateParam));
        return $result;
    }
    public static function sendMsg_withdraw_success($mobile,$account,$money){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102220060');
        // 可选，设置模板参数
        $templateParam=[
            'account'=>$account,
            'money'=>$money
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        dump($result);
        dump(json_encode($templateParam));
        return $result;
    }
    public static function sendMsg_withdraw_error($mobile,$account,$money){

        require_once '/data/web/xmyttz/public/Api/api_sdk/vendor/autoload.php';
        Config::load();             //加载区域结点配置

        $accessKeyId = "LTAIkuUo7oS5Cto2";//自己替换自己的accessKeyId
        $accessKeySecret = "q60OGOeI2X42brIOscsckI6BzqmNrc";//自己替换自己的accessKeySecret
        //短信API产品名（短信产品名固定，无需修改�?
        $product = "Dysmsapi";
        //短信API产品域名（接口地址固定，无需修改�?
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改�?
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        // 初始化AcsClient用于发起请求
        $acsClient= new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名�?
        $request->setSignName('YT锐新');

        // 必填，设置模板CODE
        $request->setTemplateCode('SMS_102950032');
        // 可选，设置模板参数
        $templateParam=[
            'account'=>$account,
            'money'=>$money
        ];
        $request->setTemplateParam(json_encode($templateParam));


        //发起访问请求

        $acsResponse = $acsClient->getAcsResponse($request);

        //返回请求结果
        $result = json_decode(json_encode($acsResponse),true);
        dump($result);
        dump(json_encode($templateParam));
        return $result;
    }
}