var notice = null; 
 function getCurrentCity(info){
	/*var qq = ['2853126133,2853126134,2853126135|四川','2853126137,2853126138,2853126139|北京','2853126141,2853126142|广东','2853126147,2853126148|上海','2853126150,2853126151|河南','2853126154|湖南','2853126155|山东','690948941,2853126157,2853126158,2853126159,2853126160,2853126161,2853126162|江苏'];
	var local = ['690948941,2853126157,2853126158,2853126159,2853126160,2853126161,2853126162'];
	var tq = local[parseInt((local.length - 1)*Math.random())];
	for(var i = 0; i < qq.length; i++){
		var tmp = qq[i].split('|');
		
		if(info.province == tmp[1]){
			var qs = tmp[0].split(',');
			tq = qs[parseInt((qs.length - 1)*Math.random())];
		}
	}
	$('.shortcut .contact .cpzx a').attr('href','http://wpa.qq.com/msgrd?v=3&uin=' + tq + '&site=qq&menu=yes');*/
} 

function initShortcut(){
	var html = [];
	html.push('<ul class="shortcut">');
		/*html.push('<li class="dl">');
			html.push('<a href="http://www.waiqin365.com/p-download-142.html" class="shortcut-text" target="_blank" hidefocus="true" title="下载产品">下载产品</a>');*/
		/*html.push('</li>');
		html.push('<li class="focus">');
			html.push('<span class="shortcut-text" title="关注我们">关注我们</span>');
			html.push('<div class="shortcut-inner">');
				html.push('<div class="shortcut-box">');
					html.push('<div class="shortcut-arrow"></div>');
					html.push('<div class="shortcut-item weixin">');
						html.push('<h4 class="shortcut-item-title">外勤365微信</h4>');
						html.push('<div class="shortcut-item-pic"></div>');
						html.push('<p>扫一扫</p>');
					html.push('</div>');
					html.push('<div class="shortcut-item weibo">');
						html.push('<a href="http://www.weibo.com/waiqin365" target="_blank" rel="nofollow" hidefocus="true">');
							html.push('<h4 class="shortcut-item-title">外勤365微博</h4>');
							html.push('<div class="shortcut-item-pic"></div>');
							html.push('<p>关注一下</p>');
						html.push('</a>');
					html.push('</div>');
				html.push('</div>');
			html.push('</div>');
		html.push('</li>');*/
		if(notice && notice.message){	
			html.push('<li class="notice active">');
				html.push('<span class="shortcut-text" title="通知公告">通知公告</span>');
				html.push('<div class="shortcut-inner">');
					html.push('<div class="shortcut-box">');
						html.push('<div class="shortcut-arrow"></div>');
						html.push('<div class="notice-icon"><div class="notice-icon-shadow"></div><div class="notice-icon-round"></div><div class="notice-icon-i"></div></div>');
						html.push('<div class="notice-text">');
							html.push('<p>' + notice.message + '</p>');
						html.push('</div>');
					html.push('</div>');
				html.push('</div>');
			html.push('</li>');
				
			$('.shortcut .notice').on('mouseover',function(){
				$(this).removeClass('active');
			});
		}
		
		html.push('<li class="contact">');
			html.push('<span class="shortcut-text" title="联系我们">联系我们</span>');
			html.push('<div class="shortcut-inner">');
				html.push('<div class="shortcut-box">');
					html.push('<div class="shortcut-arrow"></div>');
					html.push('<div class="shortcut-item cpzx">');
						html.push('<a href="http://wpa.qq.com/msgrd?v=3&uin='+zixun_qq+'&site=qq&menu=yes" target="_blank">');
							html.push('<h4 class="shortcut-item-title">产品咨询</h4>');
							html.push('<div class="shortcut-item-pic"></div>');
						html.push('</a>');
					html.push('</div>');
					html.push('<div class="shortcut-item jszc">');
						html.push('<a href="http://wpa.qq.com/msgrd?v=3&uin='+jishu_qq+'&site=qq&menu=yes" target="_blank">');
							html.push('<h4 class="shortcut-item-title">技术支持</h4>');
							html.push('<div class="shortcut-item-pic"></div>');
						html.push('</a>');
					html.push('</div>');
					html.push('<div class="clearfix"></div>');
					html.push('<h2 class="shortcut-tel">产品咨询：'+zixun_tel+'</h2>');
                                        html.push('<h2 class="shortcut-tel">技术支持：'+jishu_tel+'</h2>');
				html.push('</div>');
			html.push('</div>');
		html.push('</li>');
		html.push('<li class="gotop" style="display:none;">');
			html.push('<span class="shortcut-text" title="回到顶部">回到顶部</span>');
		html.push('</li>');
	html.push('</ul>');
	
	$(html.join('')).appendTo('body');
	
/*	var jq = ['2853126123','2853126124','2853126125','2853126126'];
	
	$('.shortcut .contact .jszc a').attr('href','http://wpa.qq.com/msgrd?v=3&uin=' + jq[parseInt((jq.length - 1)*Math.random())] + '&site=qq&menu=yes');*/
	
//	$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js',function(){
//	    getCurrentCity(remote_ip_info);
//	});
	
	$('.shortcut .gotop').on('click',function(){
		$('html,body').animate({'scroll-top':0},'fast');
	});
}

function popWeiXin(){
	var html = [];
	html.push('<div id="weixin-pop">');
		html.push('<div class="pop-wrap">');
			html.push('<div class="pop-layout"></div>');
			html.push('<div class="pop-frame">');
				html.push('<div class="pop-con">');
					html.push('<div class="pop-title">');
						html.push('<span class="pop-close" onclick="javascript:$(\'#weixin-pop\').hide()">×</span>');
						html.push('<strong>外勤365官方微信二维码</strong>');
					html.push('</div>');
					html.push('<div class="pop-main" style="height:480px;">');
						html.push('<p>打开微信，点击右上角的“魔法棒”，选择“扫一扫”功能，对准下方二维码即可。</p>');
						html.push('<h2 class=" mt20" style="text-align:center"><img src="/p/images/index/weixin.jpg"></h2>');
					html.push('</div>');
				html.push('</div>');
			html.push('</div>');
		html.push('</div>');
	html.push('</div>');
	
	if($('#weixin-pop').size() > 0){
		$('#weixin-pop').show();
	}else{
		$('body').append(html.join(''));
	}
}

 
 

function initSms(){
	$('.sms .sms-text').val('');
	
	$('.sms .sms-text').focus(function(){
		$(this).prev('.sms-placeholder').css('visibility','hidden');
	}).blur(function(){
		if($.trim($(this).val()) == ''){
			$(this).prev('.sms-placeholder').css('visibility','visible');
		}
	});
}

var count = 60;
var timer;
function countSms(){
    if (count <= 0) {
        $('.sms .send-btn').text('发送');
        clearInterval(timer);
    }
    else {
       $('.sms .send-btn').text('等待' + count + '秒');
        count --;
    }
}

function sendSms(){
	if($('.sms .send-btn').text() != '发送'){
		return ;
	}
	var tel = $('.sms .sms-text').val();
	if($.trim(tel) == ''){
		$('.sms .sms-info').text('请输入手机号码！');
		return ;
	}
	var reg = /^1[0-9]{10}$/;
	if(!reg.test(tel)){
		$('.sms .sms-info').text('手机号码不合法！');
		return ;
	}
	$('.sms .sms-info').text('');
	$.ajax({  
       	type: 'get', 
       	dataType: 'jsonp',
		jsonp:'callback',
       	url: 'http://cloud.waiqin365.com/sendSms.action',	
		data:{'moblie':tel,'ref':c},
       	success: function(data){  
       		$('.sms .sms-info').text(data.error);
       	}  
   	});
	count = 60;
	timer = setInterval('countSms()',1000);	
}

function request(param){
	var oRegex = new RegExp('[\?&]' + param + '=([^&]+)','i') ;
	var oMatch = oRegex.exec(window.location.search) ;
	if(oMatch && oMatch.length > 1)
		return oMatch[1];
	else
		return '';
}

function getCodePath(channel){
	if(channel == 'baidu_ss'){
		return 1;
	}else if(channel == 'baidu_wm'){
		return 2;
	}else if(channel == '360_ss'){
		return 3;
	}else if(channel == '360_wm'){
		return 4;
	}else if(channel == 'sogou_ss'){
		return 5;
	}else if(channel == 'sogou_wm'){
		return 6;
	}else if(channel == 'dsp'){
		return 7;
	}else if(channel == 'zh'){
		return 8;
	}else if(channel == 'gdt'){
		return 9;
	}else if(channel == 'xrj'){
		return 10;
	}else if(channel == 'sm_ss'){
		return 12;
	}else if(channel == 'jrtt'){
		return 13;
	}else if(channel == 'baidu_qpx'){
		return 14;
	}else if(channel == 'xlfy'){
		return 15;
	}else{
		return null;
	}
}


function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr;   console.log('MM_swapImgRestore a',a);  for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

 function MM_swapImgRestoremy(o){
	 var id=$(o).parents('li').attr('id')
	    var myid=$(o).parents('li').attr('myid'); //console.log('myid',myid);
		var src=$('#tb1img'+myid).attr('src');   //console.log('src',src);
	$('img[name="'+id+'"]').attr('src',src);
 }
function MM_swapImage() { 
  var i,j=0,x,a=MM_swapImage.arguments;
   document.MM_sr=new Array;
    var imgid=$(a[0]).parents('li').attr('id'); //alert(imgid);
	var code =$(a[0]).parents('li').attr('mycode');
	a[2]+= encodeURIComponent(PREFIX_URL+'v/'+code ) ;
	$('img[name="'+imgid+'"]').attr('src',a[2]);
	//alert($('img[name="'+imgid+'"]').attr('src'));
	//console.log('a0',a[0]);
    
}
 
function addCookie(name,value,expiresday){
    jQuery("#float").slideUp("slow");
    var cookieString=name+"="+escape(value);
    //判断是否设置过期时间
    if(expiresday > 0) {
        var date = new Date();
        date.setDate(date.getDate() + expiresday);
        cookieString=cookieString+"; expires="+date.toGMTString();
    }
    document.cookie=cookieString;

}
function getCookie(name){
    var strCookie=document.cookie;
    var arrCookie = strCookie.split("; ");
    for(var i=0;i<arrCookie.length;i++)
    {
        var arr=arrCookie[i].split("=");
        if(arr[0]==name)return arr[1];
    }
    return "";
}
$(function () {
   // var stop = setInterval(function () { $("#scenecount").html(parseInt($("#scenecount").html()) + 150); }, 10);
    //setTimeout(function () { window.clearInterval(stop); $("#scenecount").html(70474); }, 5000);
})
 