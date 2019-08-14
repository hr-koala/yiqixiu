<?php
namespace Home\Controller;
use Think\Controller;
  header('Content-type: text/json;charset=utf-8');

class EqsController extends Controller {
    public function logo(){
		$web_logo =CONF_PATH.'websetConfig.php';
		 $web_logo = include($web_logo);
		$logo = $web_logo['web_logo'];
		echo $logo;
    }
	
	   public function preview(){
        $web_preview =CONF_PATH.'websetConfig.php';
        $web_preview = include($web_preview);
        $preview = $web_preview['web_preview'];
        echo $preview;
  
    }
	
   public function expose()
    {
        $m_scenedata = M('expose');
        $datainput['sceneid_bigint'] = I("get.id", 0);
        $datainput['ip_varchar'] = get_client_ip();
        $datainput['createtime_time'] = date('y-m-d H:i:s', time());
        $datainput['userid'] = intval(session('userid')); 
        // echo json_encode($_POST);exit;
        $datainput['content_varchar'] = json_encode($_POST);
        $result = $m_scenedata -> data($datainput) -> add();

        $jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":0,"pageNo":1,"pageSize":10},"list":[]}';
        echo $jsonstr;
    }
	
		public function addpv() {
		$returnInfo = D("Scene") -> addpv();
	}
	
	public function link() {
		$url = $_GET['url'];
		if ($url) {
			echo '' . $url . "\n";
			echo htmlentities($url);
			header('Location: ' . $url);
		}
	}	
	
	public function PageTpl(){
		$_PageBg = M('upfilesys');
		$where['fileid_bigint']  = I('get.id',0);
		$_PageBgList=$_PageBg->where($where)->select();                              //width: 158px; height: 245px; margin-top: -43.5px; margin-left: 0px;
		$jsonStr = '{"success":true,"code":200,"msg":"操作成功","obj":{
			"id":'.$_PageBgList[0]["fileid_bigint"].',
			"sceneId":1311,
			"num":7,
			"name":null,
			"properties":{"thumbSrc":"'.$_PageBgList[0]["filesrc_varchar"].'"},
			"elements":[{"content":"<div style=\"text-align: center;\"><br></div>",
"css":{"top":"461px","left":"0px","zIndex":"1","backgroundColor":"'.$_PageBgList[0]["eqsrc_varchar"].'",
"opacity":1,"color":"#676767","borderWidth":0,"borderStyle":"solid","borderColor":"rgba(0,0,0,1)","paddingBottom":0,"paddingTop":0,"lineHeight":1,"borderRadius":"0px","transform":"rotateZ(0deg)","borderRadiusPerc":0,"boxShadow":"0px 0px 0px rgba(0,0,0,0.5)","boxShadowDirection":0,"boxShadowSize":0,"width":320,"height":25,"borderBottomRightRadius":"0px","borderBottomLeftRadius":"0px","borderTopRightRadius":"0px","borderTopLeftRadius":"0px"},"id":13,"num":1,"pageId":38164479,"properties":{"anim":{"type":1,"direction":3,"duration":1,"delay":0.6,"countNum":1},"width":320,"height":25},"sceneId":1311,"type":2},{"content":"<div style=\"text-align: center;\"><span style=\"color: inherit; line-height: inherit; background-color: initial;\"><font size=\"2\">|</font></span></div>","css":{"top":447,"left":0,"zIndex":"2","width":320,"height":39,"backgroundColor":"","opacity":1,"color":"rgba(255,255,255,1)","borderWidth":0,"borderStyle":"solid","borderColor":"rgba(0,0,0,1)","paddingBottom":0,"paddingTop":0,"lineHeight":1,"borderRadius":"0px","transform":"rotateZ(0deg)","borderRadiusPerc":0,"borderBottomRightRadius":"0px","borderBottomLeftRadius":"0px","borderTopRightRadius":"0px","borderTopLeftRadius":"0px","boxShadow":"0px 0px 0px rgba(0,0,0,0.5)","boxShadowDirection":0,"boxShadowSize":0},"id":77,"num":1,"pageId":38164479,"properties":{"width":320,"height":39,"anim":{"type":0,"direction":0,"duration":1,"delay":1.6,"countNum":1}},"sceneId":1311,"type":2},{"content":"<div style=\"text-align: left;\"><span style=\"font-size: small; color: inherit; line-height: inherit; background-color: initial;\"><a href=\"http://eqx.weiqib.cn/?c=scene&a=link&id=1311&amp;url=http%3A%2F%2Feqx.weiqib.cn\" target=\"_blank\">一起秀技术支持</a></span></div>","css":{"top":448,"left":156,"zIndex":"3","width":164,"height":38,"backgroundColor":"","opacity":1,"color":"rgba(255,255,255,1)","borderWidth":0,"borderStyle":"solid","borderColor":"rgba(0,0,0,1)","paddingBottom":0,"paddingTop":0,"lineHeight":1,"borderRadius":"0px","transform":"rotateZ(0deg)","borderRadiusPerc":0,"boxShadow":"0px 0px 0px rgba(0,0,0,0.5)","boxShadowDirection":0,"boxShadowSize":0,"borderBottomRightRadius":"0px","borderBottomLeftRadius":"0px","borderTopRightRadius":"0px","borderTopLeftRadius":"0px"},"id":33,"num":1,"pageId":38164479,"properties":{"width":164,"height":38,"anim":{"type":1,"direction":2,"duration":1,"delay":1.4,"countNum":1}},"sceneId":1311,"type":2},{"content":"<div style=\"text-align: right;\"><font size=\"2\" style=\"color: inherit; background-color: initial;\">AEYS.NET科技公司</font></div>","css":{"top":448,"left":1,"zIndex":"4","width":164,"height":38,"backgroundColor":"","opacity":1,"color":"rgba(255,255,255,1)","borderWidth":0,"borderStyle":"solid","borderColor":"rgba(0,0,0,1)","paddingBottom":0,"paddingTop":0,"lineHeight":1,"borderRadius":"0px","transform":"rotateZ(0deg)","borderRadiusPerc":0,"boxShadow":"0px 0px 0px rgba(0,0,0,0.5)","boxShadowDirection":0,"boxShadowSize":0,"borderBottomRightRadius":"0px","borderBottomLeftRadius":"0px","borderTopRightRadius":"0px","borderTopLeftRadius":"0px"},"id":12,"num":0,"pageId":38164479,"properties":{"width":164,"height":38,"anim":{"type":1,"direction":0,"duration":1,"delay":1.4,"countNum":1}},"sceneId":1311,"type":2}],"scene":null},"map":null,"list":null}';
		echo $jsonStr; 		
	}	
	
	
	
	public function friendlinks(){
		 
			echo '{"success":true,"code":200,"msg":"操作成功","list":[{
				"name":"腾讯"
				,"url":"http://eqxiu.com/s/DRrVwR4r","logo":"/Uploads/friendLinks/yq0KA1UmX_KAdFjbAAASblUbW10076.png","pageCode":"home"},
				{"name":"阿里巴巴","url":"http://eqxiu.com/s/kqKZ00","logo":"/Uploads/friendLinks/yq0KA1UmX_KAHrbYAAAT8y97Ldk570.png","pageCode":"home"},
				{"name":"汉庭","url":"http://eqxiu.com/s/fFF0NP","logo":"/Uploads/friendLinks/yq0KA1UmX_KAXJiDAAAS9RAywx8380.png","pageCode":"home"},
				{"name":"智联招聘","url":"http://eqxiu.com/s/6LaROx","logo":"/Uploads/friendLinks/yq0KA1UmX_OAHgWaAAAdrgswaPE755.png","pageCode":"home"},
				{"name":"携程","url":"http://eqxiu.com/s/5opIzb","logo":"/Uploads/friendLinks/yq0KA1UmX_OAZppjAAAT1aeMT-E250.png","pageCode":"home"},
				{"name":"红星美凯龙","url":"http://eqxiu.com/s/zkbsc6","logo":"/Uploads/friendLinks/yq0KA1UmYL6AV6b1AAAV6E9y6y4819.png","pageCode":"home"}
				,{"name":"壹基金","url":"http://eqxiu.com/s/IrUv4x","logo":"/Uploads/friendLinks/yq0KA1UmX_OACDX3AAAZ99M4pLc791.png","pageCode":"home"},
				{"name":"光明网","url":"http://eqxiu.com/s/xLCe6c","logo":"/Uploads/friendLinks/yq0KA1UmX_KAdCWCAAAWBKk0n0Q923.png","pageCode":"home"},
				{"name":"中国平安","url":"http://eqxiu.com/s/R9ykb6","logo":"/Uploads/friendLinks/yq0KA1UmX_OAMiJwAAAUJ2KE59c428.png","pageCode":"home"},
				{"name":"顺丰","url":"http://eqxiu.com/s/ZfE6erwq","logo":"/Uploads/friendLinks/yq0KA1UmX_KAah9EAAAZw2j_TDA008.png","pageCode":"home"},
				{"name":"华为","url":"http://eqxiu.com/s/Gx9GVn","logo":"/Uploads/friendLinks/yq0KA1UmX_KADPwQAAAPg667Oto017.png","pageCode":"home"},
				{"name":"网易","url":"http://eqxiu.com/s/s9W386","logo":"/Uploads/friendLinks/yq0KA1UmX_KAYKmtAAAV2AqvrTw033.png","pageCode":"home"},
				{"name":"爱奇艺","url":"http://eqxiu.com/s/lFSa2dFU","logo":"/Uploads/friendLinks/yq0KA1UmYL6ANG4KAAAWLvl2ZHo209.png","pageCode":"home"},
				{"name":"京东","url":"http://eqxiu.com/s/Z6iBtm","logo":"/Uploads/friendLinks/yq0KA1UmX_KAATvoAAAQ0FVZjjI032.png","pageCode":"home"},
				{"name":"三联生活周刊","url":"http://eqxiu.com/s/lWNKJP","logo":"/Uploads/friendLinks/yq0KA1UmX_KAVFFbAAAYhJuVBJw731.png","pageCode":"home"}]}';
    }	
	
 

  public function msgList(){
        $msg=M('news');
        $where['status']=1;
        $count = $msg->where($where) -> count();

    $msglist = $msg->where($where)->order('id desc')->select();
        $jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$count.',"pageNo":1,"pageSize":'.$count.'},"list":[';
        foreach ($msglist as $var)
        {
          $jsonstrtemp = $jsonstrtemp.'{"id":'.$var['id'].',"type":'.$var['biztype'].',"bizType":'.$var['biztype'].',"toUser":'.json_encode($var['toUser']).',"toEmail":'.json_encode($var['toEmail']).',"fromUser":'.json_encode($var['fromUser']).',"sendtime":'.$var['sendTime'].'000,"title":'.json_encode($var['title']).',"content":'.json_encode($var['content']).',"status":2,"ext":null,"roleIdList":null},';  
        }
        $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';
       echo $jsonstr;
    }
	
	public function expose_types(){
		 
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":180,"name":"内容涉及违规","value":"1","type":"expose_types","sort":1,"status":1,"remark":null},{"id":181,"name":"诱导浏览者分享","value":"2","type":"expose_types","sort":2,"status":1,"remark":null},{"id":182,"name":"场景内容侵权","value":"3","type":"expose_types","sort":3,"status":1,"remark":null},{"id":183,"name":"内容夸大宣传","value":"4","type":"expose_types","sort":4,"status":1,"remark":null},{"id":184,"name":"违背一起秀用户协议","value":"5","type":"expose_types","sort":5,"status":1,"remark":null},{"id":185,"name":"其它原因","value":"6","type":"expose_types","sort":6,"status":1,"remark":null}]}';
    }
	
	
	
		public function scene_template_prices(){
		 
			echo '{"success":true,"code":200,"msg":"操作成功","list":[{"id":14863,"name":"免费","value":"0","type":"scene_template_prices","sort":1,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14857,"name":"10","value":"10","type":"scene_template_prices","sort":2,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14858,"name":"20","value":"20","type":"scene_template_prices","sort":3,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14859,"name":"30","value":"30","type":"scene_template_prices","sort":4,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14860,"name":"40","value":"40","type":"scene_template_prices","sort":5,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14861,"name":"50","value":"50","type":"scene_template_prices","sort":6,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14862,"name":"60","value":"60","type":"scene_template_prices","sort":7,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"}]}';
    }
	
	

			public function banners(){
				if(I('get.pageCode')=='ad_001'){
					echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":602,"path":"/Uploads/ad/2015-08-11/yq0KXlXli-CAFkDEAAAy2NZGwU0132.png","title":"免费升级企业账号，尊享更多专属权限","url":"/#/usercenter/privilege","target":"_blank","pageCode":"ad_001","sort":"4","status":1},{"id":1202,"path":"/Uploads/ad/2015-08-11/yq0KZVXli72AN9YOAAAuF_hxNCs656.png","title":"用秀点去易企秀尾页，点此购买","url":"/#/usercenter/xd","target":"_blank","pageCode":"ad_001","sort":"3","status":1}]}';
					exit();
					}
			//if(I('get.pageCode')=='index'){		
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":3501,"path":"/assets/images/show/1.jpg","title":"H5，让公益更有力量","url":"/","target":"_blank","pageCode":"index","sort":"23","status":1}]}';
    //}	
		//if(I('get.pageCode')=='sceneType'){		
	//		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":206,"path":"/assets/images/show/VM085.jpg","title":"通用1","url":"http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=11131","target":"_blank","pageCode":"sceneType","sort":"3","status":1},{"id":7,"path":"/assets/images/show/AdM0237.jpg","title":"秀点火热发售中","url":"http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=297","target":"_blank","pageCode":"sceneType","sort":"2","status":1},{"id":202,"path":"/assets/images/show/Ovdb94511.jpg","title":"免费申请自定义域名","url":"http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=8604","target":"_blank","pageCode":"sceneType","sort":"1","status":1}]}';
   // }
//	if(I('get.pageCode')=='active'){		
	//		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":709,"path":"/assets/images/show/FC4720.jpg","title":"职场类H5场景设计大赛","url":"http://eqxiu.com/#/show/active/48284","target":"_blank","pageCode":"active","sort":"5","status":1},{"id":402,"path":"/assets/images/show/HBg500.jpg","title":"七夕秀场活动页大","url":"http://eqxiu.com/#/show/active/47440","target":"_blank","pageCode":"active","sort":"4","status":1},{"id":2,"path":"/assets/images/show/Y557.jpg","title":"活动首页banner大－乐视","url":"http://eqxiu.com/#/show/active/47432","target":"_blank","pageCode":"active","sort":"3","status":1}]}';
 //   }
//		if(I('get.pageCode')=='ac_48284'){		
//			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":709,"path":"/assets/images/show/FC4720.jpg","title":"职场类H5场景设计大赛","url":"http://eqxiu.com/#/show/active/48284","target":"_blank","pageCode":"ac_48284","sort":"5","status":1}]}';
 //   }
			}
	
	
	
		public function activity_info(){
			echo '{"success":true,"code":200,"msg":"操作成功","map":{"count":0,"pageNo":1,"pageSize":3},"list":[]}';
		
    }
	
	
	
	
	
	




	public function activity(){
		if(I('get.recommend')=='1'){
		echo '{"success":true,"code":200,"msg":"操作成功","map":{"count":2,"pageNo":1,"pageSize":3},"list":[{"id":47432,"title":"乐视网《蒙面歌王》携手易企秀H5页面场景设计大赛","startDate":1437667200000,"endDate":1440950400000,"introduction":"<div class="jieshao mt baoming">\r\n<h2>介绍<span>INTRODUCTION</span></h2>\r\n<div class="introduction-con">\r\n<p>活动主题：针对乐视网《蒙面歌王》，制作H5页面场景</p>\r\n<p>活动时间：7.24-8.31</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>大赛项目：</p>\r\n<p>概念篇——强调节目精髓看脸时代不看脸 听声音 拼实力</p>\r\n<p>优胜奖：1名；优秀奖：3名</p>\r\n<p>冠军篇——根据每期节目中冠军歌手，创作可以展现歌手心路历程的场景：</p>\r\n<p>优胜奖：1名；优秀奖：3名</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>活动流程：</p>\r\n<p>注册易企秀账号 > 制作参赛场景作品并发布 > 点击右上角场景设置 > 在场景共享里勾选［申请为样例模版］，并勾选参加此活动</p>\r\n<img src="http://res.eqxiu.com/group3/M00/8A/FB/yq0KZFWwrwqAenSKAACs3ZvB2Ys801.png" />\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>奖品奖励：</p>\r\n<p>优胜奖2名，价值1499元乐视超级手机 1部＋1000元秀点奖励</p>\r\n<p>优秀奖6名，价值480元乐视网会员年卡1张＋500元秀点奖励</p>\r\n<p>入围奖30名，每人将获得节目周边礼品一份</p>\r\n<p>凡是有效的参与作品，都将获得乐视网会员月卡一张，限量100份，先参与先得</p>\r\n<p>获得明星猜评团或参与选手的转发机会，及亲自莅临《蒙面歌王》录制现场的机会</p>\r\n<p>获得大奖的8位选手，将得到易企秀［秀客平台］首页展示机会一周</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>参赛须知：</p>\r\n<p>本赛事所选出作品，将由《蒙面歌王》官方播出平台乐视网&乐视视频官方微博、微信、易企秀官方微博微信、第三方权威大号、乐视视频APP等渠道推广传播</p>\r\n<p>场景尾页底标展示创作者名称</p>\r\n<p>每个作品页数不得少于3页（包括3页），少于3页的作品不计入有效作品中</p>\r\n<p>页面中需加入乐视视频APP下载按钮，或链接到节目播出页面</p>\r\n<p>需在页面中体现乐视视频Logo </p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p class="enter-btn"><a href="http://pan.baidu.com/s/1i3vSm7z" target="_blank">素材下载（每周更新）</a></p>\r\n<p>结果公示：9.1</p>\r\n<p>奖品发放：9.15</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<p class="enter-btn"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=4ac1f8d102d0a2bcfae6c61f749ebefdbf2ccacce9b471d35865cf861a226b0a">参赛加群</a></p><br/>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">去官网制作</a></p>\r\n</div>","image":"group3/M00/C5/7C/yq0KZVW1nyyAK563AAAH2hy5ses338.jpg","recommend":1,"pageCode":"home","sceneId":"10478422"},{"id":47440,"title":"七夕主题场景设计大赛","startDate":1438358400000,"endDate":1439913600000,"introduction":"<div class="jieshao mt baoming">\r\n<h2>介绍<span>INTRODUCTION</span></h2>\r\n<div class="introduction-con">\r\n<p>活动主题：与七夕有关的主题场景作品，均可参赛</p>\r\n<p>活动时间：8.1-8.19</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>参赛说明：</p>\r\n<p>作品不少于4页，要求必须原创，允许品牌植入</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>奖品奖项（以下数据统计截至时间均为8.20下午18点）：</p>\r\n<p>最高传播奖：阅读量最高的场景获得，1000秀点奖励（严禁刷票，后台监测）</p>\r\n<p>最佳样例奖：下载量最高的样例获得，1000秀点奖励（仅限七夕主题样例）</p>\r\n<p>最佳创意奖：官方评选最佳创意设计，1000秀点奖励</p>\r\n<p>优秀样例奖：优秀作品升级样例，每个作品100秀点奖励</p>\r\n<p>优秀传播奖：阅读量前10作品，每个作品100秀点奖励</p>\r\n<p>注：非原创作品不具备获奖资格</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>活动流程：</p>\r\n<p>注册易企秀账号 > 制作参赛场景作品并发布 > 点击右上角场景设置 > 在场景共享里勾选［申请为样例模版］，并勾选参加此活动</p>\r\n<img src="http://res.eqxiu.com/group3/M00/46/96/yq0KZFW-1-aAbXQqAAElWJK5znw360.png" />\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>结果公示：8.21</p>\r\n<p>奖品发放：8.21</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<p class="enter-btn"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=4ac1f8d102d0a2bcfae6c61f749ebefdbf2ccacce9b471d35865cf861a226b0a">参赛加群</a></p><br/>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">去官网制作</a></p>\r\n</div>","image":"group3/M00/45/CE/yq0KZVW-0BWAH-yDAAAH9zSoG4M350.jpg","recommend":1,"pageCode":"home","sceneId":"11032284"}]}';
		}
		
if(I('get.all')=='1'){
		echo '{"success":true,"code":200,"msg":"操作成功","map":{"count":2,"pageNo":1,"pageSize":10},"list":[{"id":47432,"title":"乐视网《蒙面歌王》携手易企秀H5页面场景设计大赛","startDate":1437667200000,"endDate":1440950400000,"introduction":"<div class="jieshao mt baoming">\r\n<h2>介绍<span>INTRODUCTION</span></h2>\r\n<div class="introduction-con">\r\n<p>活动主题：针对乐视网《蒙面歌王》，制作H5页面场景</p>\r\n<p>活动时间：7.24-8.31</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>大赛项目：</p>\r\n<p>概念篇——强调节目精髓看脸时代不看脸 听声音 拼实力</p>\r\n<p>优胜奖：1名；优秀奖：3名</p>\r\n<p>冠军篇——根据每期节目中冠军歌手，创作可以展现歌手心路历程的场景：</p>\r\n<p>优胜奖：1名；优秀奖：3名</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>活动流程：</p>\r\n<p>注册易企秀账号 > 制作参赛场景作品并发布 > 点击右上角场景设置 > 在场景共享里勾选［申请为样例模版］，并勾选参加此活动</p>\r\n<img src="http://res.eqxiu.com/group3/M00/8A/FB/yq0KZFWwrwqAenSKAACs3ZvB2Ys801.png" />\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>奖品奖励：</p>\r\n<p>优胜奖2名，价值1499元乐视超级手机 1部＋1000元秀点奖励</p>\r\n<p>优秀奖6名，价值480元乐视网会员年卡1张＋500元秀点奖励</p>\r\n<p>入围奖30名，每人将获得节目周边礼品一份</p>\r\n<p>凡是有效的参与作品，都将获得乐视网会员月卡一张，限量100份，先参与先得</p>\r\n<p>获得明星猜评团或参与选手的转发机会，及亲自莅临《蒙面歌王》录制现场的机会</p>\r\n<p>获得大奖的8位选手，将得到易企秀［秀客平台］首页展示机会一周</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>参赛须知：</p>\r\n<p>本赛事所选出作品，将由《蒙面歌王》官方播出平台乐视网&乐视视频官方微博、微信、易企秀官方微博微信、第三方权威大号、乐视视频APP等渠道推广传播</p>\r\n<p>场景尾页底标展示创作者名称</p>\r\n<p>每个作品页数不得少于3页（包括3页），少于3页的作品不计入有效作品中</p>\r\n<p>页面中需加入乐视视频APP下载按钮，或链接到节目播出页面</p>\r\n<p>需在页面中体现乐视视频Logo </p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p class="enter-btn"><a href="http://pan.baidu.com/s/1i3vSm7z" target="_blank">素材下载（每周更新）</a></p>\r\n<p>结果公示：9.1</p>\r\n<p>奖品发放：9.15</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<p class="enter-btn"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=4ac1f8d102d0a2bcfae6c61f749ebefdbf2ccacce9b471d35865cf861a226b0a">参赛加群</a></p><br/>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">去官网制作</a></p>\r\n</div>","image":"group3/M00/C5/7C/yq0KZVW1nyyAK563AAAH2hy5ses338.jpg","recommend":1,"pageCode":"home","sceneId":"10478422"},{"id":47440,"title":"七夕主题场景设计大赛","startDate":1438358400000,"endDate":1439913600000,"introduction":"<div class="jieshao mt baoming">\r\n<h2>介绍<span>INTRODUCTION</span></h2>\r\n<div class="introduction-con">\r\n<p>活动主题：与七夕有关的主题场景作品，均可参赛</p>\r\n<p>活动时间：8.1-8.19</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>参赛说明：</p>\r\n<p>作品不少于4页，要求必须原创，允许品牌植入</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>奖品奖项（以下数据统计截至时间均为8.20下午18点）：</p>\r\n<p>最高传播奖：阅读量最高的场景获得，1000秀点奖励（严禁刷票，后台监测）</p>\r\n<p>最佳样例奖：下载量最高的样例获得，1000秀点奖励（仅限七夕主题样例）</p>\r\n<p>最佳创意奖：官方评选最佳创意设计，1000秀点奖励</p>\r\n<p>优秀样例奖：优秀作品升级样例，每个作品100秀点奖励</p>\r\n<p>优秀传播奖：阅读量前10作品，每个作品100秀点奖励</p>\r\n<p>注：非原创作品不具备获奖资格</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>活动流程：</p>\r\n<p>注册易企秀账号 > 制作参赛场景作品并发布 > 点击右上角场景设置 > 在场景共享里勾选［申请为样例模版］，并勾选参加此活动</p>\r\n<img src="http://res.eqxiu.com/group3/M00/46/96/yq0KZFW-1-aAbXQqAAElWJK5znw360.png" />\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n<p>结果公示：8.21</p>\r\n<p>奖品发放：8.21</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<p class="enter-btn"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=4ac1f8d102d0a2bcfae6c61f749ebefdbf2ccacce9b471d35865cf861a226b0a">参赛加群</a></p><br/>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">去官网制作</a></p>\r\n</div>","image":"group3/M00/45/CE/yq0KZVW-0BWAH-yDAAAH9zSoG4M350.jpg","recommend":1,"pageCode":"home","sceneId":"11032284"}]}';
		}
		if(I('get.joinNum')=='1'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","map":{"count":2,"pageNo":1,"pageSize":10},"list":[{"id":47433,"title":"2015暑期档，大片归来，场景征集","startDate":1436889600000,"endDate":1439568000000,"link":"http://eqxiu.com/#/show/active/47433","introduction":"<div class="jieshao mt">\r\n <h2>介绍<span>INTRODUCTION</span></h2>\r\n <div class="introduction-con">\r\n <p>活动主题：针对近期热门的电影电视，制作H5页面场景</p>\r\n <p>活动时间：7.15-8.15</p>\r\n <p>参赛说明：《花千骨》《道士下山》《大圣归来》《捉妖记》《栀子花开》《煎饼侠》《小时代4》《盗墓笔记》等等热播剧均可</p>\r\n <p>奖品奖项：1/100秀点奖励；2/作品升级样例；3/升级高级账号；</p>\r\n <p>活动流程：注册易企秀账号 > 制作自己喜欢的电影场景 > 点击右上角设置 > 在场景共享里勾选［申请为样例模版］，并参加此活动 </p>\r\n <img src="http://res.eqxiu.com/group3/M00/83/98/yq0KZFWwfo6AfT4jAACaGpcvToA740.png" ></img>\r\n <p>结果公示：8.20</p>\r\n <p>奖品发放：8.20</p>\r\n </div>\r\n</div>\r\n\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<div class="introduction-con">\r\n参赛加群：413736511（QQ群）\r\n\r\n\r\n</div>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">我要参加</a></p>\r\n</div>","image":"group3/M00/84/09/yq0KZVWwgtmAZVE7AAAIxeetulI350.jpg","recommend":0,"pageCode":"home","sceneId":"10110398","joinNum":15},{"id":47432,"title":"乐视网《蒙面歌王》携手易企秀H5页面场景设计大赛","startDate":1437667200000,"endDate":1440950400000,"link":"http://eqxiu.com/#/show/active/47432","introduction":"<div class="jieshao mt baoming">\r\n <h2>介绍<span>INTRODUCTION</span></h2>\r\n <div class="introduction-con">\r\n <p>活动主题：针对乐视网《蒙面歌王》，制作H5页面场景</p>\r\n <p>活动时间：7.24-8.31</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n <p>大赛项目：</p>\r\n <p>概念篇——强调节目精髓看脸时代不看脸 听声音 拼实力</p>\r\n <p>优胜奖：1名；优秀奖：3名</p>\r\n <p>冠军篇——根据每期节目中冠军歌手，创作可以展现歌手心路历程的场景：</p>\r\n <p>优胜奖：1名；优秀奖：3名</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n <p>活动流程：</p>\r\n <p>注册易企秀账号 > 制作参赛场景作品并发布 > 点击右上角场景设置 > 在场景共享里勾选［申请为样例模版］，并勾选参加此活动 </p>\r\n <img src="http://res.eqxiu.com/group3/M00/8A/FB/yq0KZFWwrwqAenSKAACs3ZvB2Ys801.png" ></img>\r\n&nbsp\r\n&nbsp\r\n&nbsp \r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n <p>奖品奖励：</p>\r\n <p>优胜奖2名，价值1499元乐视超级手机 1部＋1000元秀点奖励</p>\r\n <p>优秀奖6名，价值480元乐视网会员年卡1张＋500元秀点奖励</p>\r\n <p>入围奖30名，每人将获得节目周边礼品一份</p>\r\n <p>凡是有效的参与作品，都将获得乐视网会员月卡一张，限量100份，先参与先得</p>\r\n <p>获得明星猜评团或参与选手的转发机会，及亲自莅临《蒙面歌王》录制现场的机会</p>\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n\r\n\r\n <p>参赛须知：</p>\r\n <p>•\t本赛事所选出作品，将由《蒙面歌王》官方播出平台乐视网&乐视视频官方微博、微信、易企秀官方微博微信、第三方权威大号、乐视视频APP等渠道推广传播</p>\r\n <p>•\t场景尾页底标展示创作者名称</p>\r\n <p>•\t每个作品页数不得少于3页（包括3页），少于3页的作品不计入有效作品中</p>\r\n <p>•\t页面中需加入乐视视频APP下载按钮，或链接到节目播出页面</p>\r\n <p>•\t需在页面中体现乐视视频Logo </p>\r\n \r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n&nbsp\r\n\r\n <p class="enter-btn"><a href="http://pan.baidu.com/s/1i3vSm7z" target="_blank">素材下载（每周更新）</a></p>\r\n <p>结果公示：9.1</p>\r\n <p>奖品发放：9.15</p>\r\n </div>\r\n</div>\r\n\r\n</div>\r\n</div>\r\n<div class="jieshao mt baoming">\r\n<h2>报名<span>ENTER</span></h2>\r\n<div class="introduction-con">\r\n参赛加群：413736511（QQ群）\r\n\r\n\r\n</div>\r\n<p class="enter-btn"><a href="/#main/" target="_blank">我要参加</a></p>\r\n</div>","image":"group3/M00/9E/2B/yq0KZFWx8u2Ae1gtAAAP6tQVutU571.png","recommend":0,"pageCode":"home","sceneId":"10478422","joinNum":2}]}';
		}else{
		$m_upfile = M('tag');
		$where['userid_int']  = 0;
		if(I('get.type',0)==1){
			$where['type_int']=88;
		}
		if(I('get.type',0)==2){
			$where['type_int']=2;
		}
		if(I('get.type',0)==11){
			$where['type_int']=array('NEQ',88);;
			$where['type_int']=array('NEQ',2);;
		}
		$where['biztype_int']  = I('get.bizType',0);
		$pageshowsize = 30;
		$m_upfilelist=$m_upfile->where($where)->order('tagid_int asc')->select();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
						
		}
		echo $jsonstr; 
		
	}
	
	public function xd_url(){
		if(I('get.goodsId')=='1'){
			echo '{"success":true,"code":200,"msg":"操作成功","obj":"weixin://wxpay/bizpayurl?pr=rum6NkK","map":null,"list":null}';}
		if(I('get.goodsId')=='2'){
			echo '{"success":true,"code":200,"msg":"操作成功","obj":"weixin://wxpay/bizpayurl?pr=pu7UQLH","map":null,"list":null}';}
				if(I('get.goodsId')=='10'){
			echo '{"success":true,"code":200,"msg":"操作成功","obj":"weixin://wxpay/bizpayurl?pr=pu7UQLH","map":null,"list":null}';}
			
			
		}
		
	public function promotion(){
		
		$_scene = M('scene');
		$scenetype = intval(I('get.type',0));
		if($scenetype > 0)
		{
			$where['scenetype_int']  = $scenetype<10 ?'10'.$scenetype : $scenetype;
		}
		$where['delete_int']  = 0;
		if(I('get.recommend',0)==1){
			$where['is_tpl']  =0;
			$where['applyPromotion']  = 2; 
		}else{
			$where['tagid_int']  = I('get.tagId',0); 
		}
		
		
		$pageshowsize = I('get.pageSize',6);
		if($pageshowsize>30){
			$pageshowsize = 30;
		}

		if(C('HOME_PAGESIZE')){
			$pageshowsize=intval(C('HOME_PAGESIZE'));
		}
		$count = $_scene->where($where)->count();
		$_scene_list=$_scene->where($where)->order('rank desc,sceneid_bigint desc')->page(I('get.pageNo',1),$pageshowsize)->select();
		 
		 
		 $jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"total":'.$count.',"pageNo":'.I('get.pageNo',1).',"pageSize":'.$pageshowsize.'},"list":[';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			$jsonstrtemp = $jsonstrtemp .'{
            "id": '.$vo["sceneid_bigint"].',
            "name": '.json_encode($vo["scenename_varchar"]).',
            "createUser": "'.$vo['userid_int'].'",
            "createTime": 1423645519000,
            "type": '.$vo["scenetype_int"].',
            "pageMode": '.$vo["movietype_int"].',
			"cover":"'.$vo['thumbnail_varchar'].'",
            "image": {
                "bgAudio": {
                    "url": "'.$vo["musicurl_varchar"].'",
                    "type": "'.$vo["musictype_int"].'"
                },
                "imgSrc": "'.$vo["thumbnail_varchar"].'",
                "hideEqAd": false,
                "isAdvancedUser": false
            },
            "isTpl": 0,
            "isPromotion": 0,
            "status": '.$vo['showstatus_int'].',
            "createTime": "'.$vo['createtime_time'].'",                  
            "code": "'.$vo["scenecode_varchar"].'",           
            "sort": 0,
            "pageCount": 0,
            "dataCount": 0,
            "showCount": '.$vo["hitcount_int"].',
            "userLoginName": null,
            "userName": null
        },';
		}
		
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}
	
	public function search(){
		
		$_scene = M('scene');
		$where['delete_int']  = 0;
		$scene_name = I('post.name',0);
		$where['scenename_varchar'] = array('like','%'.$scene_name.'%'); ;
		
		$pageshowsize = I('post.pageSize',16);
		
		$_scene_list=$_scene->where($where)->order('rank desc,sceneid_bigint desc')->page(I('post.pageNo',1),$pageshowsize)->select();
		$count = $_scene->where($where)->count();
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","map":{"total":'.$count.',"pageNo":'.I('post.pageNo',1).',"pageSize":'.I('post.pageSize',16).'},"obj":null,"list":[';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			$jsonstrtemp = $jsonstrtemp .'{
            "id": '.$vo["sceneid_bigint"].',
            "name": '.json_encode($vo["scenename_varchar"]).',
            "createUser": "'.$vo['userid_int'].'",
            "createTime": 1423645519000,
            "type": '.$vo["scenetype_int"].',
            "pageMode": '.$vo["movietype_int"].',
			"cover":"'.$vo['thumbnail_varchar'].'",
            "image": {
                "bgAudio": {
                    "url": "'.$vo["musicurl_varchar"].'",
                    "type": "'.$vo["musictype_int"].'"
                },
                "imgSrc": "'.$vo["thumbnail_varchar"].'",
                "hideEqAd": false,
                "isAdvancedUser": false
            },
            "isTpl": 0,
            "isPromotion": 0,
            "status": '.$vo['showstatus_int'].',
            "createTime": "'.$vo['createtime_time'].'",                  
            "code": "'.$vo["scenecode_varchar"].'",           
            "sort": 0,
            "pageCount": 0,
            "dataCount": 0,
            "showCount": '.$vo["hitcount_int"].',
            "userLoginName": null,
            "userName": null
        },';
		}
		
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}

}

