/**
 * Created by Administrator on 2018/3/16 0016.
 */

$(function(){
    var cansend=0;
    var encrypt = new JSEncrypt();
    var publickey = '-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBiYEk6LHMqqUm6WJCcSNfjlPZXPj/zHjmuVuU/QLE/yKqv2YEiPiGxaajZdBL4WUNRQxO4Dt4MDrjN43CsAzQj6OT/fDgroPERccBnwAZQr5FTR4GFfhxcoWxT/2nfmIVI7nHoJSeV7nHHwBBwagb4Z5EDrQDKr3vsumk9DY98wIDAQAB-----END PUBLIC KEY-----';
    encrypt.setPublicKey(publickey);
    var sendUrl="/login/login/send_code";
    var registerUrl="/login/login/registers";
    var register_success_count = 2;
    var jumpUrl='/index/index/index';
    var phone_url='/login/login/has_phone';
    function registerSuccess(){
        $(".register-success-container").show();
        startCountDown();
    }
    function startCountDown(){
        $("#count-num").text(register_success_count);
        var t = setInterval(function(){
            register_success_count--;
            $("#count-num").text(register_success_count);
            if(register_success_count == 0){
                clearInterval(t);
                location.href = jumpUrl;
            }
        }, 1000);
    }

    /*让输入框获得焦点*/
    $('#register-way .phone-number-input').focus();

    //只有同意协议，才能点击“注册按钮”
    $('.checkbox-xieyi').on('click', function(){
        var ischecked = $(this).prop('checked');
        $('#btn')[ischecked?'removeClass':'addClass']('disabled');
        if(ischecked){
            $('#btn').removeAttr("disabled");
        }else{
            $('#btn').attr('disabled','disabled');
        }
    });

    $("#btn").on('click',function(){
        $('.error-tag').eq(4).hide();
       if(!$('.checkbox-xieyi').attr("checked")){
           alert('请阅读并接受《权大师用户协议》');
           return false;
       }
       else if( $('.checkbox-xieyi').attr("checked") ){
            var parent = $(this).closest('#register-way');/*父级元素*/
            var userphone =$("input[name=userphone]").val();
            var userpwd=$("input[name=userpwd]").val();
            var reuserpwd=$("input[name=reuserpwd]").val();
            var code=$("input[name=code]").val();
            var yzm=$("input[name=yzm]").val();
            var QQ=$("input[name=QQ]").val();
           var wechat=$("input[name=wechat]").val();
           var invite=$("input[name=invite_num]").val();
           var preference=$("input[name=preference]").val();
           var name=$("input[name=name]").val();
           var bank_card=$("input[name=bank_card]").val();
            var re = /^1\d{10}$/;
           var re_name = /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,20}$/;
           var re_QQ=/^[1-9]d{4,9}$/;
           var re_bank= /^\d{16}|\d{19}$/;

           if (!re.test(userphone)) {
                parent.find('.list-tip').eq(0).show().find('.icon-error');
                return false;
                /*如果手机号不为空，但是手机号不合法*/
            }
            parent.find('.list-tip').eq(0).hide();

            //验证密码
            if(userpwd.length<6){
                parent.find('.list-tip').eq(1).show().find('.icon-error');
                return false;
            }
            parent.find('.list-tip').eq(1).hide();
            if(userpwd!=reuserpwd){
                parent.find('.list-tip').eq(2).show().find('.icon-error');
                return false;
            }
            parent.find('.list-tip').eq(2).hide();
            if(yzm.length==0){
                parent.find('.list-tip').eq(7).show().find('.error-tag').html('短信验证失败');
                return false;
            }
            parent.find('.list-tip').eq(4).hide();
           if (!re_name.test(name)||name=='') {
               parent.find('.list-tip').eq(3).show().find('.icon-error');
               return false;

           }
           if (re_QQ.exec(QQ)||QQ=='') {
               QQ = parseInt(QQ,10);
               if(QQ>10000&&QQ<2300000000){
                   return true;
               }
               parent.find('.list-tip').eq(4).show().find('.icon-error');
               return false;
           }


           if (wechat=='') {
               parent.find('.list-tip').eq(5).show().find('.icon-error');
               return false;
           }
            if(re_bank.test(bank_card)||bank_card=='') {
               return true;
           } else{
                parent.find('.list-tip').eq(6).show().find('.icon-error');
               return false;
           }
           userphone    = encrypt.encrypt(userphone);
           userpwd = encrypt.encrypt(userpwd);
            var postData={
                userphone:userphone,
                userpwd:userpwd,
                // reuserpwd:reuserpwd,
                yzm:yzm,
                invite:invite,
                QQ:QQ,
                wechat:wechat,
                preference:preference,
                name:name,
                bank_card:bank_card
                // geeTest_challenge: $("#challenge").val(),
                // geeTest_validate: $("#validate").val(),
                // geeTest_seccode: $("#seccode").val(),
            };
           if(invite.length!=0){
               	$.ajax({
               		url:'/login/login/is_invite_code',
               		type:'post',
               		data:{'invite_code':invite},
               		async:false,
               		success:function(data){
               			if(data.flag==0){
               				alert('邀请码错误！');
                            invite=false;
               			}
               		}
               	})
               }else{

                   $.ajax({
                       type: "POST",
                       dataType: "json",
                       data: postData,
                       url: registerUrl,
                       success: function(json) {
                           if(json.status=='success'){
                               //alert("注册成功");
                               registerSuccess();
//                          window.location.href=jumpUrl;
                           }else{
                               if(json.returntype){
                                   if(json.returntype==1){
                                       parent.find('.list-tip').eq(0).show().find('.icon-error').html(json.msg);//手机号
                                   }else if(json.returntype==2){
                                       parent.find('.list-tip').eq(4).show().find('.error-tag').html(json.msg);//错误信息
                                   }
                               }

                           }
                       }
                   });
               }



        }
    });
    function setTime(nums){
        $(".send-yzm-btn").html(nums);
        nums = nums-1;
        if(nums<0){
            $(".send-yzm-btn").removeClass("disabled").html("发送验证码");
            $(".send-yzm-btn").attr("data",1);
        }else{
            setTimeout(function(){
                setTime(nums);
            },1000);
        }

    }
    function sendCode(){

        var parent = $('#register-way');/!*鐖剁骇鍏冪礌*!/
        parent.find('.list-tip').eq(4).hide();

        var userphone =$("input[name=userphone]").val();
        var re = /^1\d{10}$/;
        if (!re.test(userphone)) {
            parent.find('.list-tip').eq(0).show().find('.icon-error');
            return false;
            /!*濡傛灉鎵嬫満鍙蜂笉涓虹┖锛屼絾鏄墜鏈哄彿涓嶅悎娉?!/
        }else{
            parent.find('.list-tip').eq(0).hide();
        }

        var postdata={
            userphone:userphone,
            register:1,
            geeTest_challenge: $("#challenge").val(),
            geeTest_validate: $("#validate").val(),
            geeTest_seccode: $("#seccode").val(),
        };

        $(".send-yzm-btn").attr("data",0);
        var flag=0;
        $.ajax({
            type:'POST',
            url:phone_url,
            data: {'phone':userphone},
            success:function(data){
                if(data.flag==1){
                    flag=1;
                }else if(data.flag==0){
                    flag=0;
                    alert('手机用户已存在');


                }
            },
            async:false
        });
        if(flag==1){
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {'phone':userphone},
                url: sendUrl,
                success: function(json) {

                    if(json.status==1){

                        cansend++;
                        if(cansend==1){
                            var times=60;
                        }else if(cansend==2){
                            var times=60;
                        }else{
                            var times=60;
                        }
                        $('.send-yzm-btn').addClass("disabled");

                        $('.send-yzm-btn').attr("disabled", true);

                        setTimeout(function(){
                            $(".send-yzm-btn").attr("data",0);
                            $('.send-yzm-btn').attr("disabled", false);
                            setTime(times);
                        },1000);
                    }else if(json.status==0){
                        parent.find('.list-tip').eq(0).show().html('<i class="icon-error">脳</i>'+json.msg);
                        $(".send-yzm-btn").attr("data",1);
                    }
                }
            });
        }

    }

    $('.send-yzm-btn').on('click',function () {
        sendCode();
    })

});



