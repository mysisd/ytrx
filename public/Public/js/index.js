/**
 * Created by Administrator on 2018/3/13 0013.
 */
$(function () {
    var banner_index = 1;
    var prev = 0;
    $('.banner_bg img').eq(0).css('opacity',1);
    $('.banner_bg li').eq(0).css('background','#57b1df').css('opacity','1');
    var banner_timer = setInterval(auto,5000);
    $('.banner_bg li').hover(function(){
        clearInterval(banner_timer);
        banner_index = $(this).index();
        change(this);
        $('.banner_change').attr('data',banner_index);
    },function(){
        prev = $(this).index();
        banner_index = prev + 1;
        banner_timer = setInterval(auto,5000);
    })
    $('#banner_prev').click(function(){
        clearInterval(banner_timer);
        prev = parseInt($(this).attr('data'));
        banner_index = prev-1;
        if (banner_index < 0) banner_index = $('.banner_bg ul li').size()-1;
        $('.banner_change').attr('data',banner_index);
        change($('.banner_bg li').eq(banner_index));
        prev = banner_index
        banner_index = banner_index + 1;
        banner_timer = setInterval(auto,5000);
    })
    $('#banner_next').click(function(){
        clearInterval(banner_timer);
        prev = parseInt($(this).attr('data'));
        banner_index = prev+1;
        if (banner_index >= $('.banner_bg ul li').size()) banner_index = 0;
        $('.banner_change').attr('data',banner_index);
        change($('.banner_bg li').eq(banner_index));
        prev = banner_index
        banner_index = banner_index + 1;
        banner_timer = setInterval(auto,5000);
    })

    function change(obj){
        $('.banner_bg li').css('background','#999').css('opacity','0.7');
        $(obj).css('background','#57b1df').css('opacity','1');
        $('.banner_bg img').eq(prev).stop().animate({opacity:'0'},500).css('zIndex', '1');
        $('.banner_bg img').eq(banner_index).css('zIndex', '2').stop().animate({opacity : 1},500)
    }
    function auto(){
        if (banner_index >= $('.banner_bg ul li').size()) banner_index = 0;
        change($('.banner_bg li').eq(banner_index).first());
        prev = banner_index
        banner_index++;
        $('.banner_change').attr('data',prev);
    };
})