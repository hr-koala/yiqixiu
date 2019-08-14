<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="AppCtrl">
<head>
<base href="/">
<meta property="qc:admins" content="<?php echo (C("THINK_SDK_QQ.qqqqqq52")); ?>" />
<meta charset="utf-8" />
<meta name="description" content="<?php echo (C("site_name")); ?>::<?php echo (C("content")); ?>"/>
<meta name="keywords" content="<?php echo (C("site_name")); ?>,<?php echo (C("keyword")); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="renderer" content="webkit" />
<meta property="qc:admins" content="<?php echo (C("THINK_SDK_QQ.qqqqqq52")); ?>" />
<meta property="wb:webmaster" content="354b970d8cd61602" />
<title><?php echo (C("site_title")); ?></title>
<script src="http://tajs.qq.com/stats?sId=45828183" charset="UTF-8"></script>

<script>
var JSON_URL = "http://"+window.location.host+"/index.php";
  var PREFIX_URL = "http://"+window.location.host+"/";
  var PREFIX_S1_URL = "http://"+window.location.host+"/";
  var PREFIX_S2_URL = "http://"+window.location.host+"/";
  var PREFIX_S3_URL = "http://"+window.location.host+"/";
  var PREFIX_HOST = "http://"+window.location.host;
  var PREFIX_HOST1 = "http://"+window.location.host;
  var VIP_HOST = "http://"+window.location.host+"/";
  var PREFIX_FILE_HOST = "http://"+window.location.host+'/Uploads/'; 
  var PREFIX_HOST_ARRAY = [
    "http://"+window.location.host,
	"http://"+window.location.host,
	"http://"+window.location.host,
	"http://"+window.location.host
  ];
  var PREFIX_SERVICE_HOST = "http://"+window.location.host;
  var PREFIX_COMPANY_HOST_ARRAY = ["http://"+window.location.host,"http://"+window.location.host];
  var PREFIX_SHOW_HOST = "http://"+window.location.host;
  var PREFIX_MOBILE_HOST = "http://"+window.location.host;
  var CLIENT_CDN = "http://"+window.location.host+"/";
  var PRINT_HOST_SERVER = "http://"+window.location.host+"/";
  var PRINT_HOST_RESOURCE = "resource/";
  var version = "2.1.5.3";
  var STATISTICS_HOST = "http://"+window.location.host+"/";
  var LOGIN_AUTH_HOST = "http://"+window.location.host;
  var OLD_FILE_HOST = 'file_host';
  
  var IS_OPEN_REG='<?php echo (C("is_open_reg")); ?>' ;
  var QI_AD_XDS='<?php if(C("qi_ad_xds"))echo C("qi_ad_xds");else echo 100; ?>';
  QI_AD_XDS = parseInt(QI_AD_XDS);
  var loadingLogo_qi_xd='<?php if(C("loadingLogo_qi_xd"))echo C("loadingLogo_qi_xd");else echo 100; ?>';
  loadingLogo_qi_xd = parseInt(loadingLogo_qi_xd);
  var guding_qi_xd='<?php if(C("guding_qi_xd"))echo C("guding_qi_xd");else echo 15; ?>';
  var custome_qi_xd='<?php if(C("custome_qi_xd"))echo C("custome_qi_xd");else echo 30; ?>';
  var  GET_XD_LINK='<?php echo ($sys["get_xd_link"]); ?>';
  var  zixun_qq='<?php echo C("zixun_qq") ?>';
  var  zixun_tel='<?php echo C("zixun_tel") ?>';
  var  zixun_mail='<?php echo C("zixun_mail") ?>';
  var  jishu_qq='<?php echo C("jishu_qq") ?>';
  var  jishu_tel='<?php echo C("jishu_tel") ?>';
  var  address='<?php echo C("address") ?>';
  var  your_demain='<?php echo C("site_url") ?>';
  var  your_webname='<?php echo C("site_name") ?>';
  var your_demain_beian='<?php echo C("ipc") ?>';
  var lastpagetext='<?php echo C("lastpagetext") ?>'
  var your_weixinhao_pic_url='<?php echo C("your_weixinhao_pic_url") ?>';
  var your_anli_pic_url='<?php echo C("your_anli_pic_url") ?>';
  var tuijian_pic_url='<?php echo C("tuijian_pic_url") ?>';
  var tuijian_url='<?php echo C("tuijian_url") ?>';
  var client_id='<?php echo (C("THINK_SDK_QQ.APP_KEY")); ?>';
  var redirect_uri='<?php echo urlencode(rtrim(C("site_url"),"/")."/index.php?c=otherlogin&type=qq") ?>';
  var lastpagelink = '<?php echo C("lastpagelink") ?>';
  
  
  var mobilecheck = function() {
      var check = false;
      (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
      return check;
  };
  if(mobilecheck()) {
    var appendUrl = "";

    if(location.href.indexOf('/error/500') < 0 && location.href.indexOf('/about') < 0){
      window.location.href = PREFIX_HOST + '/m/index.html';

    }
  }
// 当geetest库加载好后回调initCaptcha
    // 注意initCaptcha必须在全局作用域下定义
    var initCaptcha = function () {

        var captchaObj = new Geetest(config,true);

        captchaObj.appendTo("#captcha-box");

        captchaObj.onSuccess(function () {
            var backObj = captchaObj.getValidate();
            challenge = backObj.geetest_challenge;
            validate = backObj.geetest_validate;
            seccode = backObj.geetest_seccode;          
            // 成功回调
        });

        //captchaObj.getValidate(); // 获取成功后的验证信息，失败是返回false
    };
	
	    var web_muban_status = '<?php echo C("web_muban_status") ?>';
 if(web_muban_status==1){
	var web_muban ='<div id=home login-loading><header style=background-color:#fff;width:100%;height:60px><div class="we_nav content_center"><div class=link_list><ul class=clearfix><li><a class=background-color-width-change target=_blank href=/#/show>秀场</a></li><li><a class=background-color-width-change href=/#/privilege>会员特权</a></li><li class=login ng-hide=isAuthenticated()><a class=background-color-width-change ng-click="openAuth(\'login\')">登录</a></li><li ng-hide=isAuthenticated() class=register><a class=background-color-width-change ng-click="openAuth(\'register\')" id=registerFormBtn>注册</a></li><li ng-show=isAuthenticated()><a class=background-color-width-change href=/main>进入</a></li></ul></div><div id=logo><img class=eqf-logo ng-src={{logoSrc}}></div></div></header><div id=example_con><div id=example><div slides id=slides><div class=slides_container></div><a href=# class="prev eqf-left"></a> <a href=# class="next eqf-right"></a></div></div></div><div class=active-banner><ul class=clearfix><li ng-repeat="ad in homeAd"><a class=all-change ng-href={{ad.url}} target=_blank data-banner=9201 data-bid={{ad.id}}><img src="{{ad.path}}"><div class=bg></div></a></li></ul></div></div><div ng-include="\'footer.tpl.html\'"></div>';

	}else if(web_muban_status==2){
		var web_muban ='<div class="topButton" align="center">\n<table class="toptable" cellspacing="0"><tr> \n<td><img style="cursor:pointer;" height="45" src="{{logoSrc}}" onclick="openFirstPage()" alt="HTML5在线制作" title="微场景免费在线制作"></td>\n<td id="loginc" align="right">     </td>\n       <td  class="tbutton"><a  href="#/show"><font color="white">用户案例</font></a></td>  \n <td  class="tbutton" ng-hide="isAuthenticated()"><a  ng-click = "openAuth(\'login\')"><font color="white">登录</font></a></td>\n       <td  class="tbutton" ng-hide="isAuthenticated()"><a  ng-click = "openAuth(\'register\')"><font color="white">注册</font></a></td>\n<td ng-show="isAuthenticated()" class="tbutton"><a href="#/main"><font color="white">进入</font></a></td>\n</tr></table>\n </div>\n<div id="body" class="body" align="center">\n<div class="contant">\n<table class="pages" cellspacing="0">\n<tr><td valign="top">\n	<img style="margin-left:70px;margin-top:80px;" src="static/img/index/advantage.png" alt="HTML5在线制作" title="微场景免费在线制作">\n	</td></tr>\n<tr><td valign="top">\n<img style="margin-left:167px;" src="static/img/index/4.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:20px;" src="static/img/index/5.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:20px;" src="static/img/index/2.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:20px;" src="static/img/index/1.png" alt="HTML5在线制作" title="微场景免费在线制作">	  			 \n<img style="margin-left:20px;" src="static/img/index/3.png" alt="HTML5在线制作" title="微场景免费在线制作"> 			 \n</td></tr>\n<tr><td valign="top" align="center">\n<img style="margin-top:30px;" src="static/img/index/btn-bg.png" alt="HTML5在线制作" title="微场景免费在线制作">\n</td></tr>\n<tr><td valign="top" align="right">\n<table cellspacing="0" style="width:100%;"><tr>\n<td valign="top" align="left" width="450">\n<img width="300" src="static/img/index/slide_02.png" alt="HTML5在线制作" title="微场景免费在线制作">\n</td>\n<td valign="bottom">\n<div style="color:white;">\n<h3>让您SHOW得如此精彩</h3>\n<p>海量素材，多样模板，拖拽组件，一键推广</p>\n<p>多种互动效果，满足极致交互体验</p> \n<p>图文动画，音频视频，多媒体视听感受</p> 					 \n<br>\n</div> 				 \n</td> \n<td valign="top" align="right">\n<div style="color:white;" align="left">\n<h3>SHOW,让移动推广变得如此简单</h3>\n<p>精美画面，社交展示，数据收集，持续营销</p>\n<p>移动时代专业级的场景制作平台</p>\n</div>\n</td>\n</tr>\n</table>\n</td></tr>\n<tr><td valign="top">\n<div style="margin-top:190px;">\n<img style="margin-left:110px;" src="static/img/index/pro_10.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:30px;" src="static/img/index/pro_13.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:30px;" src="static/img/index/pro_15.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<br><br><br><br>\n<img style="margin-left:80px;" src="static/img/index/pro_17.png" alt="HTML5在线制作" title="微场景免费在线制作"> \n<img style="margin-left:30px;" src="static/img/index/pro_26.png" alt="HTML5在线制作" title="微场景免费在线制作">\n<img style="margin-left:30px;" src="static/img/index/pro_27.png" alt="HTML5在线制作" title="微场景免费在线制作">\n</div>\n</td></tr>\n<tr><td valign="top">\n<div id="temptest" style="width:800px;" align="right">\n<br/><br/><br/><br/><br/><br/><br/><br/>\n<p style="color:white;">业务QQ：'+zixun_qq+'</p>\n<p style="color:white;">业务电话：'+zixun_tel+'</p>\n<p style="color:white;">邮箱：'+zixun_mail+'</p>\n<p style="color:white;">联系地址：'+address+'</p>\n</div> \n</td></tr>\n<tr><td valign="top">\n</td></tr>\n</table>		\n</div>\n</div>\n<div class="foot" align="right">\n<table><tr><td style="color:white;font-family:微软雅黑;font-size:12px;" align="right">{{web_ipc}}  &nbsp;&nbsp; 2015 '+lastpagetext+'版权所有&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>\n</div>\n<div class="gotoBottom" onclick="godown()">联系</div>\n <div class="gotoTop" onclick="goup()">UP</div>';

	}else{
		var web_muban ="<link href=\"/index/css/index_v.css\" rel=\"stylesheet\" type=\"text/css\" />  <link href=\"/index/css/y_add.css\" rel=\"stylesheet\" type=\"text/css\">"+"\n"+
		"<div class=\"header-fixed\"><div class=\"header\"><div class=\"header-line\"></div><div class=\"logo\"><a href=\"/\"><img src=\"{{logoSrc}}\"></a></div><div class=\"wrap\"><div class=\"header-nav\"><ul class=\"nav\"><li class=\"current\"><a href=\"/\" hidefocus=\"true\">首页</a></li><li class=\" \"><a href=\"#/show\" hidefocus=\"true\">案例展示</a></li></ul></div></div>			<div class=\"login\"><a ng-hide=\"isAuthenticated()\" ng-click=\"openAuth(\'login\')\" class=\"l\">登录</a><a ng-hide=\"isAuthenticated()\" ng-click=\"openAuth(\'register\')\"class=\"r\">注册</a><a ng-show=\"isAuthenticated()\" href=\"#/main\" class=\"l\">进入</a><a ng-show=\"isAuthenticated()\" href=\"index.php?c=user&a=logout\" class=\"r\">退出</a></div></div></div><div class=\"header-shadow\" style=\"display:block;\"></div><div class=\"header\"><div class=\"header-line\"></div><div class=\"logo\"><a href=\"/\"><img src=\"{{logoSrc}}\"></a></div><div class=\"wrap\"><div class=\"header-nav\"><ul class=\"nav\"><li class=\"current\"><a href=\"/\" hidefocus=\"true\">首页</a></li> <li class=\" \"><a href=\"#/show\" hidefocus=\"true\">案例展示</a></li><li ng-repeat='menu in menus' class=\"\"><a href=\"{{menu.url}}\" hidefocus=\"true\">{{menu.name}}</a></li></ul></div></div><div class=\"login\">			<a ng-hide=\"isAuthenticated()\" ng-click=\"openAuth(\'login\')\" class=\"l\">登录</a><a ng-hide=\"isAuthenticated()\" ng-click=\"openAuth(\'register\')\"class=\"r\">注册</a>		<a ng-show=\"isAuthenticated()\" href=\"#/main\" class=\"l\">进入</a><a ng-show=\"isAuthenticated()\" href=\"index.php?c=user&a=logout\" class=\"r\">退出</a></div></div><div id=\"float\"><div id=\"float_txt01\"><div align=\"center\">推荐场景<a href=\"javascript:\" class=\"float_close\" onclick='addCookie(\"app\",\"1\",1)'>关闭</a></div></div><div id=\"float_pic\"><img src=\""+tuijian_pic_url+"\"  width=\" 130\" height=\"130\"></div><div id=\"float_button\"><a target=\"_blank\" href=\""+tuijian_url+"\">立即预览</a></div>		</div><div class=\"slide\"><ul class=\"slides-bg\" id='slides_bgcc'>"+
		"{{slides_bgcc}}"+
		"</ul><ul class=\"slides-container\" style=\"position: relative;\" id=\"banner_body\"></ul><div class=\"slide-shortcut\"><ul class=\"slide-switch\" id=\"slide_switchcc\">"+
		""+	
		"</ul><a class=\"slide-shortcut-prev\" href=\"javascript:;\" style=\"display: none;\"></a><a class=\"slide-shortcut-next\" href=\"javascript:;\" style=\"display: none;\"></a></div></div><div class=\"feature\"><div class=\"feature-item item1\"><div class=\"feature-inner wrap\"><h3><div class=\"t_0\">NO PROGRAMMING</div><div class=\"t_1\">不编程也能做移动广告&nbsp;&nbsp;一分钟轻松搞定</div><div class=\"t_2\">无需编程即可制作含各种特效和交互的移动手机页面</div><div class=\"t_2\">"+your_webname+"让人人都能轻松做出电影特效一般的炫酷特效</div></h3><div class=\"a1\" style=\"opacity: 1;\"></div><div class=\"a2\"  style=\"top: 100px; opacity: 1;\"></div><div class=\"a3\" style=\"top: -50px; opacity: 1;\"></div></div></div><div class=\"feature-item item2\"><div class=\"feature-inner wrap\"><h3><div class=\"t_0\">THE APPLICATIONTS</div><div class=\"t_1\">用途广泛&nbsp;&nbsp;&nbsp;行业全覆盖</div></h3><div class=\"a1\" style=\"top: 80px; opacity: 1;\"><ul><li class=\"li1\"><span>活动促销</span></li><li class=\"li2\"><span>企业宣传</span></li><li class=\"li3\"><span>产品介绍</span></li><li class=\"li4\"><span>预约报名</span></li></ul></div><div class=\"a2\" style=\"top: 140px; opacity: 1;\"><ul><li class=\"li1\"><span>粉丝互动</span></li><li class=\"li2\"><span>活动组织</span></li><li class=\"li3\"><span>数据收集</span></li><li class=\"li4\"><span>品牌效应</span></li></ul></div></div></div></div><div class=\"index_case\"><div class=\"index_box\"><div class=\"case_box\"><ul>"+
		"<li ng-repeat=\"home in homes\" id=\"Image{{home.id}}\" myid=\"{{home.id}}\" mycode=\"{{home.code}}\"><div class=\"pic\"><a target=\"_blank\"  href=\"v/{{home.code}}\"  onMouseOut=\"MM_swapImgRestoremy(this)\" onmouseover=\"MM_swapImage(this,'','http://qr.liantu.com/api.php?text=',1)\"><img src=\"{{PREFIX_FILE_HOST + home.image.imgSrc}}\" name=\"Image{{home.id}}\" width=\"282\" height=\"290\" border=\"0\"></a></div><div class=\"p01\"><div class=\"tb1\"><img src=\"{{PREFIX_FILE_HOST + home.image.imgSrc}}\" width=\"24\" height=\"24\" border=\"0\" id=\"tb1img{{home.id}}\"></div><div class=\"tit\">{{home.name}}</div></div><div class=\"p02\"><div class=\"t3\">活动促销</div><div class=\"t4\"><div class=\"pic\"><a href=\"v/{{home.code}}\" target=\"_blank\"><img src=\"/index/images/c_yl.png\" /></a></div><div class=\"txt\"><a href=\"v/{{home.code}}\" target=\"_blank\" style=\" color:#999999\">预览</a></div></div><div class=\"t4\"><div class=\"pic\" onMouseOut=\"MM_swapImgRestoremy(this)\" onMouseOver=\"MM_swapImage(this,'','http://qr.liantu.com/api.php?text=',1)\"><img src=\"/index/images/c_qr.png\" /></div><div class=\"txt\" onMouseOut=\"MM_swapImgRestoremy(this)\" onMouseOver=\"MM_swapImage(this,'','http://qr.liantu.com/api.php?text=',1)\">扫描</div></div></div></li>"+
		"</ul></div><div class=\"clear\"></div></div></div><div id=\"footer\">"+
		"<div class=\"inner\"><div class=\"friendlinks\"><h3 class=\"title\">友情链接</h3><p><a ng-repeat='link in friendLinks' ng-href=\"{{link.url}}\" target=\"_blank\" class=\"link\">{{link.name}}</a></p></div></div>"+
		"<div class=\"footer_box\"><div class=\"footer_nav\"><div class=\"tit\"><div align=\"center\">关于我们</div></div><div class=\"txt\"><div align=\"center\"><a href=\"#\">公司简介</a></div></div><div class=\"txt\"><div align=\"center\"><a href=\"#\">官方产品</a></div></div><div class=\"txt\"><div align=\"center\"><a href=\"#\">联系我们</a></div></div></div><div class=\"footer_nav\"><div class=\"tit\"><div align=\"center\">友情链接</div>				</div><div class=\"txt\"><div align=\"center\"><a href=\"#\">官方网站</a></div></div><div class=\"txt\"><div align=\"center\"><a href=\"#\">微信平台</a></div></div>				</div><div class=\"footer_nav\" style=\"display:none;\"><div class=\"tit\">帮助中心</div><div class=\"txt\"><a href=\"#\">操作指南</a></div></div><div class=\"footer_con\"><div class=\"txt01\">				<div align=\"center\">产品咨询</div><div align=\"center\">"+zixun_tel+"</div></div><div class=\"txt02\"><div align=\"center\">周一至周日 9:00-22:00</div>				</div></div><div class=\"footer_QR\"><div class=\"pic\"><img src=\""+your_weixinhao_pic_url+"\" width=\"120\"></div><div class=\"txt\">微信公众号</div></div><div class=\"footer_QR\"><div class=\"pic\"><img src=\""+your_anli_pic_url+"\" width=\"120\"></div><div class=\"txt\">优秀案例</div></div><div class=\"di\">			<p>CopyRight © 2014-2015 "+your_demain+",All Rights Reserved.&nbsp;&nbsp;版权所有&nbsp;&nbsp;</p><p><a target=\"_blank\" rel=\"nofollow\" href=\"http://www.miibeian.gov.cn/\">"+your_demain_beian+"</a></p></div><div class=\"clear\"></div>"
	}
</script>
<!-- <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=8D1kIOGsmbbeG9k4U3klKl77"></script> -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css"/> -->
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/jqueryui/1.10.4/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-jcrop/0.9.12/css/jquery.Jcrop.min.css"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/angular-ui-select/0.13.1/select.min.css"/>
    <link href="//cdn.bootcss.com/hint.css/1.3.3/hint.min.css" rel="stylesheet">
    <!-- compiled CSS -->
    
    <link rel="stylesheet" href="/assets/eqShow-common-2.1.5.3.css"/>
    <link rel="stylesheet" href="/vendor/eqx-module/css/eqx-ng-module.min.css"/>
    <link rel="stylesheet" href="/assets/eqShow-2.1.5.3.css"/>
    <script src="http://map.qq.com/api/js?v=2.exp"></script>
    <script src="//assets.kf5.com/supportbox/main.js" id="kf5-provide-supportBox" kf5-domain="eqxiu.kf5.com"></script>
    
	<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.2.23/angular.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.2.23/angular-route.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.2.23/angular-animate.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.2.23/angular-sanitize.min.js"></script>
    <script src="//cdn.bootcss.com/angular-ui-bootstrap/0.11.0/ui-bootstrap-tpls.min.js"></script>
    <script src="//cdn.bootcss.com/angular-ui-select/0.13.1/select.min.js"></script>
    <script src="//cdn.bootcss.com/angular-ui-sortable/0.13.0/sortable.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/hammer.js/2.0.4/hammer.min.js"></script>
    <script src="//cdn.bootcss.com/plupload/2.1.8/plupload.full.min.js"></script>
    <script src="//cdn.bootcss.com/ng-dialog/0.6.1/js/ngDialog.min.js"></script>
    <script src="//cdn.bootcss.com/slidesjs/3.0/jquery.slides.min.js"></script>
	
    <script src="/vendor/html2canvas/0.5.0-alpha2/html2canvas.min.js"></script>
    <script src="/vendor/others/bootstrap-wysiwyg.min.js"></script>
    <script src="/vendor/others/jquery.hotkeys.min.js"></script>
    <script src="/vendor/others/angular-file-upload.min.js"></script>
    <script src="/vendor/others/angular-file-upload-directives.min.js"></script>
    <script src="/vendor/others/angular-locale_zh-cn.min.js"></script>
    <script src="/vendor/others/ZeroClipboard.js"></script>
    <script src="/vendor/others/iscroll.min.js"></script>
    <script src="/vendor/others/Chart.min.js"></script>
    <script src="/vendor/jquery-ui-panch/jquery.ui.touch-punch.min.js"></script>
    <script src="/vendor/qiniu/src/qiniu.js"></script>
    <script src="/vendor/eqx-module/js/eqx-ng-module.min.js"></script>
	<!--jquery.slider.js 70-->
    <script type="text/javascript" src="/index/js/jquery.slider.js"></script>
    <!--70c-->
    <link rel="stylesheet" href="/index/css/shortcut.css"/>
    <link rel="stylesheet" href="/assets/lycc_map.css"/>
    <script src="/assets/eqShow-site-2.1.5.3.js"></script>
<style>
.myGrid {
	width: 998px;
	height: 550px;
}
.myGrid1 {
  width: 650px;
  height: 550px;
}
.choose_template .main .content .mask ul li .roll :hover .cc{
  display: block;
}
</style>

</head>

<body right-click><!-- right-click -->

  <div id="loading">
      <div class="loading-con">
          <img ng-src="{{CLIENT_CDN}}assets/images/puff.svg">
          <p>加载中，请稍后</p>
      </div>
      <div class="loading-bg"></div>
  </div>
  <input type="text" style="display:none" id="userId" ng-model="user.id" />
  <div class="position:relative">
    <div style="z-index:2000;" id="notify" ng-include="'notifications.tpl.html'" ng-if="notifications.getCurrent().length"></div>
  </div>
  <div id="eq_main" ng-view></div>
  <div class="feedback" ng-show="feedBackUrl">
      <div class="feedback-bg"></div>
  </div>

<script>
  var redirect_uri = encodeURIComponent('<?php echo (C("THINK_SDK_QQ.CALLBACK")); ?>');
  var challenge, validate, seccode,selectorA;
  var config = {
    gt:'1ebc844c9e3a8c23e2ea4b567a8afd2d',
    challenge: '19e9d723472a0dfb08f34398af28ada8',
    product:'popup',
    popupbtnid:'submit-button',
    lang:'zh-cn'
  };
</script>
<script>
  // Tracker
  var d = document,
        g = d.createElement('script'),
        s = d.getElementsByTagName('script')[0];
      g.type = 'text/javascript';
      g.async = true;
      g.defer = true;
      g.src = 'http://da.eqxiu.com/d.js?pid=1&v=1';
      s.parentNode.insertBefore(g, s);
</script>
	<script type="text/javascript" src="/index/js/jpages.min.js"></script>
	<script type="text/javascript" src="/index/js/jquery.lazyload.js"></script><script type="text/javascript" src="/index/js/jwplayer.js"></script>
	<script type="text/javascript" src="/index/js/common_v.js"></script> <script type="text/javascript" src="/index/js/scrop.js"></script>  
<!-- <script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script> -->
	</body>
</html>