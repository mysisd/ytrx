/*!
 * jRaiser 2 Javascript Library
 * Yaolongfei - v1.0.0 (2015-07-28T17:30:00+0800)
 */

$(document).ready(function(){
 
});
/**
 * 用于众筹个人中心左侧竖型菜单的动态样式切换
 * @method listClick
 * @for 无
 * @param {int} value 标记所点击的菜单
 * @return {null} 无
 */
function listClick(value){
	if(value == 1){
		$("#listClick_1").css("border-bottom","1px solid #C40521");
		$("#listClick_1").css("color","#C40521");
		$("#listClick_3").css("border-bottom","1px solid #CCC");
		$("#listClick_3").css("color","#666");
		$("#listClick_4").css("border-bottom","1px solid #CCC");
		$("#listClick_4").css("color","#666");
		
		$("#crowdfunding_iframe").attr("src","/index/user/my_info");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","menu_list_on");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
        $("#listClick45").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 2){
		$("#crowdfunding_iframe").attr("src","/index/user/make_head");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","menu_list_on");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
        $("#listClick45").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 3){
		$("#listClick_1").css("border-bottom","1px solid #CCC");
		$("#listClick_1").css("color","#666");
		$("#listClick_3").css("border-bottom","1px solid #C40521");
		$("#listClick_3").css("color","#C40521");
		$("#listClick_4").css("border-bottom","1px solid #CCC");
		$("#listClick_4").css("color","#666");
		
		$("#crowdfunding_iframe").attr("src","/index/user/identity_prove");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","menu_list_on");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
        $("#listClick45").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 4){
		$("#listClick_1").css("border-bottom","1px solid #CCC");
		$("#listClick_1").css("color","#666");
		$("#listClick_3").css("border-bottom","1px solid #CCC");
		$("#listClick_3").css("color","#666");
		$("#listClick_4").css("border-bottom","1px solid #C40521");
		$("#listClick_4").css("color","#C40521");
		
		$("#crowdfunding_iframe").attr("src","/index/user/make_password");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","menu_list_on");
        $("#listClick45").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
        $("#listClick45").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
    if(value == 45){
        $("#listClick_1").css("border-bottom","1px solid #CCC");
        $("#listClick_1").css("color","#666");
        $("#listClick_3").css("border-bottom","1px solid #CCC");
        $("#listClick_3").css("color","#666");
        $("#listClick_4").css("border-bottom","1px solid #C40521");
        $("#listClick_4").css("color","#C40521");

        $("#crowdfunding_iframe").attr("src","/index/user/find_password");
        $("#crowdfunding_iframe").attr("height","1045");
        $("#vertical_navigation").css("height","1050px");

        $("#listClick1").attr("class","");
        $("#listClick2").attr("class","");
        $("#listClick3").attr("class","");
        $("#listClick4").attr("class","");
        $("#listClick45").attr("class","menu_list_on");
        $("#listClick5").attr("class","");
        $("#listClick6").attr("class","");
        $("#listClick7").attr("class","");
        $("#listClick8").attr("class","");
        $("#listClick9").attr("class","");
        $("#listClick10").attr("class","");
        $("#listClick11").attr("class","");
        $("#listClick12").attr("class","");
        $("#listClick13").attr("class","");
        $("#listClick14").attr("class","");
        $("#listClick15").attr("class","");
        $("#listClick16").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
    }
	if(value == 5){
		$("#crowdfunding_iframe").attr("src","/index/user/apply_lingtou");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","menu_list_on");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 6){
		$("#crowdfunding_iframe").attr("src","/index/user/project_manage");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","menu_list_on");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 7){
		$("#crowdfunding_iframe").attr("src","/index/user/touhou_manage");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","menu_list_on");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 8){
		$("#crowdfunding_iframe").attr("src","/index/user/my_account");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","menu_list_on");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 9){
		$("#crowdfunding_iframe").attr("src","/index/user/investment_inquiry");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","menu_list_on");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 10){
		$("#crowdfunding_iframe").attr("src","/index/user/apply_refund");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","menu_list_on");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 11){
		
		// $("#crowdfunding_iframe").attr("src","/index/user/grade_integration");
		$("#crowdfunding_iframe").attr("height","2000");
		$("#vertical_navigation").css("height","2005px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","menu_list_on");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 12){
		$("#listClick_11").css("border-bottom","1px solid #CCC");
		$("#listClick_11").css("color","#666");
		$("#listClick_12").css("border-bottom","1px solid #C40521");
		$("#listClick_12").css("color","#C40521");
		$("#listClick_13").css("border-bottom","1px solid #CCC");
		$("#listClick_13").css("color","#666");
		
		// $("#crowdfunding_iframe").attr("src","/index/user/integration_record");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","menu_list_on");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
		$("#listClick16").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 13){
		$("#listClick_11").css("border-bottom","1px solid #CCC");
		$("#listClick_11").css("color","#666");
		$("#listClick_12").css("border-bottom","1px solid #CCC");
		$("#listClick_12").css("color","#666");
		$("#listClick_13").css("border-bottom","1px solid #C40521");
		$("#listClick_13").css("color","#C40521");
		
		// $("#crowdfunding_iframe").attr("src","/index/user/integration_rule");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","menu_list_on");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 14){
		$("#crowdfunding_iframe").attr("src","/index/user/messages");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","menu_list_on");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 15){
		$("#crowdfunding_iframe").attr("src","/index/user/inbox");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","menu_list_on");
		$("#listClick16").attr("class","");
		$("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
	if(value == 16){
		$("#crowdfunding_iframe").attr("src","/index/user/outbox");
		$("#crowdfunding_iframe").attr("height","1045");
		$("#vertical_navigation").css("height","1050px");
		
		$("#listClick1").attr("class","");
		$("#listClick2").attr("class","");
		$("#listClick3").attr("class","");
		$("#listClick4").attr("class","");
		$("#listClick5").attr("class","");
		$("#listClick6").attr("class","");
		$("#listClick7").attr("class","");
		$("#listClick8").attr("class","");
		$("#listClick9").attr("class","");
		$("#listClick10").attr("class","");
		$("#listClick11").attr("class","");
		$("#listClick12").attr("class","");
		$("#listClick13").attr("class","");
		$("#listClick14").attr("class","");
		$("#listClick15").attr("class","");
		$("#listClick16").attr("class","menu_list_on");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
	}
    if(value == 20){
        $("#crowdfunding_iframe").attr("src","/index/user/forum_list");
        $("#crowdfunding_iframe").attr("height","1045");
        $("#vertical_navigation").css("height","1050px");

        $("#listClick1").attr("class","");
        $("#listClick2").attr("class","");
        $("#listClick3").attr("class","");
        $("#listClick4").attr("class","");
        $("#listClick5").attr("class","");
        $("#listClick6").attr("class","");
        $("#listClick7").attr("class","");
        $("#listClick8").attr("class","");
        $("#listClick9").attr("class","");
        $("#listClick10").attr("class","");
        $("#listClick11").attr("class","");
        $("#listClick12").attr("class","");
        $("#listClick13").attr("class","");
        $("#listClick14").attr("class","");
        $("#listClick15").attr("class","");
        $("#listClick16").attr("class","");
        $("#listClick20").attr("class","menu_list_on");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","");
    }
    if(value == 21){
        $("#crowdfunding_iframe").attr("src","/index/user/reply_list");
        $("#crowdfunding_iframe").attr("height","1045");
        $("#vertical_navigation").css("height","1050px");

        $("#listClick1").attr("class","");
        $("#listClick2").attr("class","");
        $("#listClick3").attr("class","");
        $("#listClick4").attr("class","");
        $("#listClick5").attr("class","");
        $("#listClick6").attr("class","");
        $("#listClick7").attr("class","");
        $("#listClick8").attr("class","");
        $("#listClick9").attr("class","");
        $("#listClick10").attr("class","");
        $("#listClick11").attr("class","");
        $("#listClick12").attr("class","");
        $("#listClick13").attr("class","");
        $("#listClick14").attr("class","");
        $("#listClick15").attr("class","");
        $("#listClick16").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","menu_list_on");
        $("#listClick22").attr("class","");
    }
    if(value == 22){
        $("#crowdfunding_iframe").attr("src","/index/user/forum_remind");
        $("#crowdfunding_iframe").attr("height","1045");
        $("#vertical_navigation").css("height","1050px");

        $("#listClick1").attr("class","");
        $("#listClick2").attr("class","");
        $("#listClick3").attr("class","");
        $("#listClick4").attr("class","");
        $("#listClick5").attr("class","");
        $("#listClick6").attr("class","");
        $("#listClick7").attr("class","");
        $("#listClick8").attr("class","");
        $("#listClick9").attr("class","");
        $("#listClick10").attr("class","");
        $("#listClick11").attr("class","");
        $("#listClick12").attr("class","");
        $("#listClick13").attr("class","");
        $("#listClick14").attr("class","");
        $("#listClick15").attr("class","");
        $("#listClick16").attr("class","");
        $("#listClick20").attr("class","");
        $("#listClick21").attr("class","");
        $("#listClick22").attr("class","menu_list_on");
    }
}