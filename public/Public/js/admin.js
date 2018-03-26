$(function(){
    //后台管理员登录
    $('#login_sub').click(function(){
        if($('#login_user').val()!='' && $('#login_pass').val()!=''){
            var user=$('#login_user').val();
            var pwd=$('#login_pass').val();
            var flag=0;
            $.ajax({
                type:'POST',
                url:conUrl+'/login',
                data:{'user':user,'password':pwd},
                success:function(data){
                    if(data.flag==1){
                        location.href="/manager/Admin/admin";
                    }else if(data.flag==0){
                        alert('用户名或密码错误！');
                    }
                },
                async:false
            });
            if(flag==0){
                return false;
            }
        }else{
            alert('账号密码不得为空！');
            return false;
        }
    })
    $('#login_pass').keydown(function(e){
        if(e.keyCode==13){
            $('#login_sub').click();
        }
    })

    //左侧选择
    $('#left h3').click(function(){
        var sumWidth =1;
        $(this).parent().find("li").each(function(){
            sumWidth += $(this).height()+1;
        });
        if($(this).parent().find('ul').height()!=0){
            $(this).parent().find('ul').stop().animate({'height':0});
            $(this).find('span').css({'transform':'rotateZ(180deg)'});
        }else{
            $('#left h3').parent().find('ul').stop().animate({'height':0});
            $('#left h3').find('span').css({'transform':'rotateZ(180deg)'});
            $(this).parent().find('ul').stop().animate({'height':sumWidth});
            $(this).find('span').css({'transform':'rotateZ(0deg)'});
        }
    })

    $('#left li a').click(function(){
        $('#left li a').removeClass('active');
        $(this).addClass('active');
    })

    $('.had_click').click();
    //阻止默认事件
    $('.stop_default').click(function(e){
        e.stopPropagation();
    })

    //首页图片删除
    $('.delete_bg').click(function(){
        if (confirm('确认要删除？')) {
            location.href=conUrl+'/banner/delete/'+$(this).attr('data');
        }
    })

    //上传文件删除
    $('.delete_file').click(function(){
        if (confirm('确认要删除？')) {
            location.href=conUrl+'/yz_files/delete/'+$(this).attr('data');
        }
    })

    //图片上传
    $("#imageupload").change(function() {
        var $file = $(this);
        var objUrl = $file[0].files[0];
        //获得一个http格式的url路径:mozilla(firefox)||webkit or chrome
        var windowURL = window.URL || window.webkitURL;
        //createObjectURL创建一个指向该参数对象(图片)的URL
        var dataURL;
        dataURL = windowURL.createObjectURL(objUrl);
        $("#imageview").attr("src",dataURL);
    });
    //图片清空
    $('#clearFile').click(function(){
        clearFile();
    })
    $('#clearFiles').click(function(){
        clearFiles();
    })
    function clearFile(){
        var file = $("#imageupload") ;
        $('#imageview').attr('src','');
        file.after(file.clone().val(""));
        file.remove();
    }
    function clearFiles(){
        var file = $("#imageuploads") ;
        $('#imageview').attr('src','');
        file.after(file.clone().val(""));
        file.remove();
    }

    //文件上传
    var check_num=0;
    $('#select_all').click(function(){
        if(check_num++%2==0){
            $('.sendee input').prop('checked',true);
        }else{
            $('.sendee input').prop('checked',false);
        }
    })
    //首页图片
    //增加、修改图片验证

    $('#add_bg .sub').click(function(){
        var postUrl=conUrl+"/is_num";
        if($('#add_bg .name').val()!='' && $('#imageupload').val()!=''){
            var num = parseInt($('#add_bg .num').val());
            var flag=0;
            if(num){
                $.ajax({
                    type:'POST',
                    url:postUrl,
                    data:{'num':num},
                    success:function(data){
                        if(data.flag==1){
                            flag=1
                        }else if(data.flag==0){
                            alert('该序号与其他序号重复，请修改（可返回列表查看已有序号）');
                        }
                    },
                    async:false
                });
                if(flag==1){
                    return true;
                }else{
                    return false;
                }
            }
            return true;
        }else{
            alert('名称、图片不得为空！（序号必须为数字）');
            return false;
        }
    });
    $('#update_bg .sub').click(function(){
        var hidden_num=$('#hidden_num').val();
        var postUrl=conUrl+"/is_num";
        if(parseInt($('#update_bg .num').val())!='' && $('#update_bg .name').val()!=''){
            var num = parseInt($('#update_bg .num').val());
            if(num != hidden_num){
                var flag=0;
                $.ajax({
                    type:'POST',
                    url:postUrl,
                    data:{'num':num},
                    success:function(data){
                        if(data.flag==1){
                            flag=1
                        }else if(data.flag==0){
                            alert('该序号与其他序号重复，请修改（可返回列表查看已有序号）');
                        }
                    },
                    async:false
                });
                if(flag==1){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }else{
            alert('序号、名称不得为空！（序号必须为数字）');
            return false;
        }
    })


    //新闻
    //新闻删除
    $('.delete_news').click(function(){
        if (confirm('确认要删除？')) {
            location.href=conUrl+'/yz_news/delete/'+$(this).attr('data');
        }
    })
    //新闻时间事件

    $('#news_time').focus(function(){
        $('#show_time').show();
        $('#show_time span').html($(this).val());
    })
    $('#news_time').keyup(function(){
        $('#show_time span').html($(this).val());
    })
    //时间格式判断
    $('#news_time').blur(function(){
        var news_time=$(this).val();
        if(news_time=='' || /^[12]{1}[901]{1}[\d]{2}-[01]{1}[\d]{1}-[0123]{1}[\d]{1}\s[012]{1}[\d]{1}:[01245]{1}[\d]{1}:[01245]{1}[\d]{1}$/.test(news_time)){
            if($('.news_sub').css('display')=='none'){
                $('.news_sub').css('display','block');
                $('.news_info').css('display','none');
            }
        }else{
            alert('输入的时间有误，请重新输入');
            if($('.news_sub').css('display')!='none'){
                $('.news_sub').css('display','none');
                $('.news_info').css('display','block');
            }
        }
        $('#show_time').hide();
    })
    $('#reload').on('click',function () {
   location.reload();
})
    //条件默认选中
    $('#select_condition option').each(function(){if($(this).val()==select_condition){$(this).attr('selected',true);}})
    // $('#select_type option').each(function(){if($(this).val()==select_type){$(this).attr('selected',true);}})
    // $('#select_kind option').each(function(){if($(this).val()==select_kind){$(this).attr('selected',true);}})
    $('.select_option').each(function () {
        var select_data=$(this).attr('data');

        $(this).find('option').each(function(){if($(this).val()==select_data){$(this).attr('selected',true);}});
    })
    $('#export_xgjuser').click(function(){
        showOverlay();
        $('#export_pop').show();
    })
    function showOverlay() {
        $("#overlay").height(pageHeight());
        $("#overlay").width(pageWidth());

        // fadeTo第一个参数为速度，第二个为透明度
        // 多重方式控制透明度，保证兼容性，但也带来修改麻烦的问题
        $("#overlay").fadeTo(200, 0.8);
    }
    function hideOverlay() {
        $("#overlay").fadeOut(200);
    }
    /* 当前页面高度 */
    function pageHeight() {
        return window.screen.Height;
    }
    /* 当前页面宽度 */
    function pageWidth() {
        return window.screen.Width;
    }
    $('#xgjuser_getcode').click(function(){
        var getCode=$(this);
        var time=59;
        getCode.css('cursor','default');
        getCode.css('color','#999');
        getCode.css('background','#eee');
        getCode.attr({ "disabled": "disabled" });
        $('#xgjuser_code').select();
        $.ajax({
            url: "/login/login/send_code",
            type: 'post',
//			data: {'phone':15260180650},
            data: {'phone':18350226135},
            success: function (data) {
                if(data.status==1){
                    getCode.html("<p>60秒后</p><p>可重新发送</p>");
                    var hander = setInterval(function () {
                        if (time <= 0) {
                            clearInterval(hander);
                            getCode.css('cursor','pointer');
                            getCode.css('color','#fff');
                            getCode.css('background','#01c0dd')
                            getCode.html("获取验证码");
                            getCode.removeAttr("disabled");
                        }
                        else if(data.status==0) {
                            getCode.css('cursor','default');
                            getCode.css('color','#999');
                            getCode.css('background','#eee');
                            getCode.attr({ "disabled": "disabled" });
                            getCode.html( "<p>"+ time + "秒后</p><p>可重新发送</p>");
                            time--;
                        }
                    }, 1000);
                }else{
                    alert('验证码发送失败，请联系客服');
                }
            }
        });
    })
    $('#export_sub').click(function(){
        var code=$('#xgjuser_code').val();
        if(code.length==0){
            alert('验证码不得为空');
            return false;
        }else{
            hideOverlay();
            $('#export_pop').hide();
        }
    })
    $('.pop_close').click(function(){
        $('.pop_system').hide();
        hideOverlay();
    })
})