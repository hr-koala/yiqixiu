var msgdsq;
//错误时：提示调用方法
function show_err_msg(msg){
	 $('.msg_bg').html('');
	 clearTimeout(msgdsq);
	 $('body').append('<div class="sub_err" style="position:absolute;top:60px;left:0;width:500px;z-index:999999;"></div>');
	 var errhtml='<div  class="bac" style="padding:38px 0px;border:1px solid #ff0000;width:100%;margin:0 auto; filter:alpha(opacity=70); -moz-opacity:0.7;  -khtml-opacity: 0.7;   opacity: 0.7;  background-color:#e4e4e4;color:#333;border:3px #43546a solid;text-align:center;font-size:30px;font-family:微软雅黑;"><img style="margin-right:10px; width:60px;padding-bottom: 30px;" src="./Public/media/image/error.png"><br>';
	 var errhtmlfoot='</div>';	 
	 $('.msg_bg').height($(document).height());
	 $('.sub_err').html(errhtml+msg+errhtmlfoot);
	 var left=($(document).width()-500)/2;
	 $('.sub_err').css({'left':left+'px'});
	 var scroll_height=$(document).scrollTop(); 
	 $('.sub_err').animate({'top': scroll_height+120},300);
	 msgdsq=setTimeout(function(){				     
		 $('.sub_err').animate({'top': scroll_height+80},300);
		 setTimeout(function(){
			 $('.msg_bg').remove();
			 $('.sub_err').remove();
		 },300);
	 }, "1000"); 
}

//正确时：提示调用方法
function show_msg(msg,url){	
     $('.msg_bg').html('');
	 clearTimeout(msgdsq);
	 $('body').append('<div class="sub_err" style="position:absolute;top:60px;left:0;width:500px;z-index:999999;"></div>');
	 var htmltop='<div class="bac" style="padding:38px 0px;border:1px solid #ff0000;width:100%;margin:0 auto; filter:alpha(opacity=70); -moz-opacity:0.7;  -khtml-opacity: 0.7;   opacity: 0.7;  background-color:#e4e4e4;color:#333;border:3px #43546a solid;text-align:center;font-size:30px;font-family:微软雅黑;"><img style="margin-right:10px; width:60px;padding-bottom: 30px src="./Public/media/image/loading.png">';
	 var htmlfoot='</div>';
	 $('.msg_bg').height($(document).height());
	 var left=($(document).width()-500)/2;
	 $('.sub_err').css({'left':left+'px'});
	 $('.sub_err').html(htmltop+msg+htmlfoot);
	 var scroll_height=$(document).scrollTop(); 
	 $('.sub_err').animate({'top': scroll_height+120},500);	 
	 msgdsq=setTimeout(function(){	    
		   $('.sub_err').animate({'top': scroll_height+80},500);
		   setTimeout(function(){
			   $('.msg_bg').remove();
			   $('.sub_err').remove();
			   if(url!='')
			   {	     
				  location.href=url;
			   }		   
		   },800);	 
		   
	 }, "1200");  
}

//显示加载动画
function show_loading()
{
	var str='<div class="msg_bg" style="background:#000;opacity:0.5;filter:alpha(opacity=50);z-index:99998;width:100%;position:absolute;left:0;top:0"></div>';
	str+='<div class="msg_bg" style="z-index:99999;width:100%;position:absolute;left:0;top:0;text-align:center;"><img src="./Public/media/image/ajax-loading.gif" alt="" class="loading"></div>'
	$('body').append(str);
	var scroll_height=$(document).scrollTop(); 
	$('.msg_bg').height($(document).height());
	$('.loading').css('margin-top',scroll_height+240);
}