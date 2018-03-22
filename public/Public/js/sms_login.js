/**
 * Created by Administrator on 2018/3/22.
 */
$(function () {

    var cansendyzmdl = 0;
    var jumpUrl="/index/index/index";
    var codeUrl="/login/login/send_code";
    var yzmloginUrl="/login/login/sms_login";
    var checkPhoneUrl="/login/login/has_phone";
    //验证手机格式是否正确
    function pregPhone(phone){
        if(phone.length==0){
            $('.list-tip').eq(0).show().find('.error_tag').text('手机号不能为空');
            return false;
        }
        /*如果手机号为空*/
        var re = /^1\d{10}$/;
        if (!re.test(phone)) {
            $('.list-tip').eq(0).show().find('.error_tag').text('手机号格式错误');
            return false;
            /*如果手机号不为空，但是手机号不合法*/
        }else{
            $('.list-tip').eq(0).hide();
            return true;
        }
    };
    /*倒计时*/
    function setTime(nums){
        $(".send-yzm").html(nums);
        nums = nums-1;
        if(nums<0){
            $(".send-yzm").html("发送验证码");
            $(".send-yzm").attr("data",1);
        }else{
            setTimeout(function(){
                setTime(nums);
            },1000);
        }

    }
    /*验证登录操作*/
    $('#btn-login').on('click', function(){
        $('.list-tip').eq(2).hide();
        $(this).text('登录中...');
        var phone = $.trim( $('.phone').val() );/!*获取手机号,并且去掉首尾的空格*!/
        var yzm = $.trim( $('.yzm').val() );/!*获取验证码*!/

        /*如果手机号为空*/
        var re = /^1\d{10}$/;
        if (!re.test(phone)) {
            $('.list-tip').eq(0).show().find('.icon-error');
            $('#btn-login').text('登 录');
            return false;
            /*如果手机号不为空，但是手机号不合法*/
        }else{
            $('.list-tip').eq(0).hide();
        }

        if(yzm.length==0){
            $('.list-tip').eq(1).show().find('.icon-error');
            $('#btn-login').text('登 录');
            return false;
        }
        $('.list-tip').eq(1).hide();
        var postData={
            phone:phone,
            yzm:yzm,

        };
        $(this).attr("data","0");
        $.ajax({
            type: "POST",
            dataType: "json",
            data: postData,
            url: yzmloginUrl,
            success: function(json) {
                $('#btn-login').attr("data",1);
                if(json.status){
                    window.location.href=jumpUrl;
                }else{
                    $('.list-tip').eq(2).show().find('.error_tag').text(json.msg);
                    $('#btn-login').text('登 录');
                }
            }
        });


    });

    //加载页面时加载
    $(function(){
        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
                $("#btn-login").click();
            }
        }
    });

$('.send-yzm').on('click',function () {
    var userphone=$(".phone").val();
    var phone = pregPhone(userphone);

    var a=0;

    //判断手机号是否注册
    $.ajax({
        type:"POST",
        dataType:"json",
        data:{phone:phone},
        url:checkPhoneUrl,
        success: function (data) {
            if(data.flag==0){
                $('.list-tip').eq(0).show().find('.error_tag').text(data.msg);
                $('.send-yzm').attr("data",'0');
                a=0;
            }else if(data.flag==1){
                $('.list-tip').eq(0).hide();
                $('.send-yzm').attr("data",'1');
                a=1;
            }
        }
    })

    if(a==1){
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{phone:userphone},
            url: codeUrl,
            success: function(json) {
                if(json.status==0){
                    $(".send-yzm").attr("data","1");
                    $('.list-tip').eq(2).show().find('.error_tag').text(json.msg);
                }else{
                    $(".send-yzm").attr("data","0");
                    cansendyzmdl++;
                    if(cansendyzmdl==1){
                        var times=60;
                    }else if(cansendyzmdl==2){
                        var times=60;
                    }else{
                        var times=60;
                    }
                    $('.send-yzm').addClass("disabled");

                    $('.send-yzm').attr("disabled", true);
                    setTimeout(function(){
                        $(".send-yzm").attr("data",0);
                        $('.send-yzm').attr("disabled", false);
                        setTime(times);
                    },1000);
                }
            }
        });
    }

})
})