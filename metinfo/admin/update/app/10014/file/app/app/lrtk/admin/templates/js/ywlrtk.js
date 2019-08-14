$(function(){
                var tophtml="<div id=\"izl_rmenu\" class=\"yun-izl-rmenu\"><a href=\"http://t.qq.com/vipwangwei?preview\" class=\"ywbtn btn-tx\" target=\"_blank\"></a><a href=\"http://t.qq.com/vipwangwei?preview\" class=\"ywbtn btn-xl\" target=\"_blank\"></a><a href=\"tencent://Message/?Uin=415420792&websiteName=www.yunwang.wang=&Menu=yes\" class=\"ywbtn btn-qq\"></a><div class=\"ywbtn btn-wx\"><img class=\"pic\" src=\"http://localhost/bug/app/app/lrtk/admin/templates/img/thumb/yw.jpg\" onclick=\"return false;\"/></div><div class=\"ywbtn btn-phone\"><div class=\"phone\">15069846560</div></div><div class=\"ywbtn btn-top\"></div></div>";
                $("body").after(tophtml);
                $("#izl_rmenu").each(function(){
                    $(this).find(".btn-wx").mouseenter(function(){
                        $(this).find(".pic").fadeIn("fast");
                    });
                    $(this).find(".btn-wx").mouseleave(function(){
                        $(this).find(".pic").fadeOut("fast");
                    });
                    $(this).find(".btn-phone").mouseenter(function(){
                        $(this).find(".phone").fadeIn("fast");
                    });
                    $(this).find(".btn-phone").mouseleave(function(){
                        $(this).find(".phone").fadeOut("fast");
                    });
                    $(this).find(".btn-top").click(function(){
                        $("html, body").animate({
                            "scroll-top":0
                        },"fast");
                    });
                });
                var lastRmenuStatus=false;
                $(window).scroll(function(){//bug
                    var _top=$(window).scrollTop();
                    if(_top>200){
                        $("#izl_rmenu").data("expanded",true);
                    }else{
                        $("#izl_rmenu").data("expanded",false);
                    }
                    if($("#izl_rmenu").data("expanded")!=lastRmenuStatus){
                        lastRmenuStatus=$("#izl_rmenu").data("expanded");
                        if(lastRmenuStatus){
                            $("#izl_rmenu .btn-top").slideDown();
                        }else{
                            $("#izl_rmenu .btn-top").slideUp();
                        }
                    }
                });
            });
        