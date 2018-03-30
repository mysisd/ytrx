/**
 * Created by Administrator on 2018/3/16 0016.
 */
$(function () {
    var encrypt = new JSEncrypt();
    var publickey = '-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBiYEk6LHMqqUm6WJCcSNfjlPZXPj/zHjmuVuU/QLE/yKqv2YEiPiGxaajZdBL4WUNRQxO4Dt4MDrjN43CsAzQj6OT/fDgroPERccBnwAZQr5FTR4GFfhxcoWxT/2nfmIVI7nHoJSeV7nHHwBBwagb4Z5EDrQDKr3vsumk9DY98wIDAQAB-----END PUBLIC KEY-----';
    encrypt.setPublicKey(publickey);
    var jumpUrl="/forum/forum/forum";
    jumpUrl = jumpUrl.replace(/amp;/g,'');
    var loginUrl="/login/login/logins";
    var cansend=0;
    //加载页面时加载
    $(function(){
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                $('#btn-login').click();
            }
        }
    });
    //鼠标离开事件
    $('.userphone').blur(function(){
        var string = $.trim( $('.userphone').val() );/*获取手机号/邮箱,并且去掉首尾的空格*/
        if(isNaN(string)==true){//验证是否非数字
            pregEmail(string);
        }else{
            pregPhone(string);
        }

    });

    //验证手机格式是否正确
    function pregPhone(phone){

        /*如果手机号为空*/
        var re = /^1\d{10}$/;
        if (!re.test(phone)) {
            $('.list-tip').eq(0).show().find('#tips').text('手机号格式错误');
            return false;
            /*如果手机号不为空，但是手机号不合法*/
        }else{
            $('.list-tip').eq(0).hide();
            return true;
        }
    };
    //验证邮箱是否正确
    function pregEmail(email) {
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        if (!reg.test(email)) {
            $('.list-tip').eq(0).show().find('#tips').text('邮箱格式有误');
            return false;
        }else{
            $('.list-tip').eq(0).hide();
            return true;
        }
    }

    function jumpSuccess(){
        if($('#btn-login').hasClass("disabled")){
            return false;
        }

        var string = $.trim( $('.userphone').val() );/*获取手机号/邮箱,并且去掉首尾的空格*/
        if(isNaN(string)==true){//验证是否非数字
            var res = pregEmail(string);
        }else{
            var res = pregPhone(string);
        }
        if(!res){
            return false;
        }

        $('.list-tip').eq(2).hide();
        var parent = $('#login-way');/*父级元素*/
        var password = $.trim( parent.find('.password').val() );/*获取密码,并且去掉首尾的空格*/
        if(password.length==0){
            parent.find('.list-tip').eq(1).show().find('.icon-error').text('密码不能为空');
            return false;
        }
        parent.find('.list-tip').eq(1).hide();
        string    = encrypt.encrypt(string);
        password = encrypt.encrypt(password);
        var postData={
            'phone':string,
            'password':password
        };
        $('#btn-login').attr("data","0").text('登录中...');
        $('#btn-login').addClass("disabled");

        $.ajax({
            type: "POST",
            dataType: "json",
            data: postData,
            url: loginUrl,
            success: function(json) {
                if(json.ret=='success'){
                    $('#btn-login').attr("data",1);
                    $('#btn-login').removeClass("disabled");
                    window.location.href=jumpUrl;
                }else if(json.ret=='error'){
                    parent.find('.list-tip').eq(3).show().find('.error-tag').text(json.msg);
                    $('#btn-login').text('登录');
                    $('#btn-login').removeClass("disabled");
                }else if(json.ret=='null'){
                    parent.find('.list-tip').eq(3).show().find('.error-tag').text(json.msg);
                    $('#btn-login').text('登录');
                    $('#btn-login').removeClass("disabled");
                }

            }
        });
    }
    /*普通登录：判断用户名、密码是否合法*/
    $('#btn-login').click(function(){

        jumpSuccess();
   });
    /**成功跳转*/



})