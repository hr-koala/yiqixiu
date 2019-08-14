<?php
namespace Home\Controller;
use Think\Controller;
 
class AdController extends Controller {
    public function logo(){
        $logo=M('ad');
        $where['type']=1;
        $url=$logo->where($where)->find();
        echo  '/Uploads'.$url[url];
    }
     public function banner(){
          $logo=M('ad');
          $where['type']=2;
        $url=$logo->where($where)->order('date')->limit(5)->select();
        foreach ($url as $k=>$pic)
        {
            $url[$k]='/Uploads'.$pic[url];
            $res = implode(",", $url);
        }
        
        //echo $res;
		echo 'assets/images/slide_03.png,assets/images/slide2_03.png,assets/images/slide3_03.png';
    }
	
	public function banners(){
		if(I('get.pageCode')=='indexAd'){
			echo'{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":4203,"path":"/assets/images/ad/yq0KX1aUmXeATJxyAAAOM7hI94E770.svg","title":"去赚钱","url":"#","target":"0","pageCode":"indexAd","sort":"5","status":1,"content":null},{"id":4201,"path":"/assets/images/ad/yq0KXlaUma6AHoccAAAiVQS8OeQ220.svg","title":"去下载APP","url":"#","target":"0","pageCode":"indexAd","sort":"4","status":1,"content":null},{"id":4202,"path":"/assets/images/ad/yq0KXlZqmXGACweCAAAi7Lk4eoQ465.svg","title":"海外产品","url":"#","target":"_blank","pageCode":"indexAd","sort":"2","status":1,"content":null},{"id":4204,"path":"/assets/images/ad/yq0KXFaUmoeAGWCyAAATqcMTZ0A224.svg","title":"包年1999，畅享增值服务","url":"/#/privilege","target":"0","pageCode":"indexAd","sort":"1","status":1,"content":null}]}';
		}else if(I('get.pageCode')=='ad_001'){
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":602,"path":"/Uploads/ad/2015-08-11/yq0KXlXli-CAFkDEAAAy2NZGwU0132.png","title":"免费升级企业账号，尊享更多专属权限","url":"/#/usercenter/privilege","target":"_blank","pageCode":"ad_001","sort":"4","status":1},{"id":1202,"path":"/Uploads/ad/2015-08-11/yq0KZVXli72AN9YOAAAuF_hxNCs656.png","title":"用秀点去易企秀尾页，点此购买","url":"/#/usercenter/xd","target":"_blank","pageCode":"ad_001","sort":"3","status":1}]}';
		}else if(I('get.pageCode')=='home'){
			echo'{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":5801,"path":"/assets/images/ad/yq0KZVah4FmAOjfCAACdZcvGtw8788.svg","title":"春节主题场景设计大赛","url":"#","target":"0","pageCode":"home","sort":"14","status":1,"content":null},{"id":5101,"path":"/assets/images/ad/yq0KXlajIGGAebLlAABSS10P5fg714.svg","title":"易企秀合作伙伴招募","url":"#","target":"0","pageCode":"home","sort":"12","status":1,"content":null},{"id":4301,"path":"/assets/images/ad/yq0KXlaMa3KAAR3OAAA___XBAb8717.svg","title":"移动场景自营销管家","url":"#","target":"0","pageCode":"home","sort":"10","status":1,"content":null},{"id":4502,"path":"/assets/images/ad/yq0KXlaUtU2AXQk7AAAtYzoSr9o902.svg","title":"万名秀客扶持计划","url":"#","target":"0","pageCode":"home","sort":"2","status":1,"content":null}]}';
		}else{
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":3501,"path":"/assets/images/show/1.jpg","title":"H5，让公益更有力量","url":"/","target":"_blank","pageCode":"index","sort":"23","status":1}]}';
		}
	}
	    
      public function preview(){
                $logo=M('ad');
        $where['type']=3;
        $url=$logo->where($where)->find();
		echo rtrim(C("site_url"),"/").'/Uploads'.$url[url];
  
    }
    public function friendlinks(){
		header("Content-type: text/html; charset=utf-8");
      	$friend=M('ad');
		$where['type']=10;
		$links=$friend->where($where)->select();
        $jsonstr ='{"success":true,"code":200,"msg":"操作成功","list":[';
        foreach ($links as $var)
        {
          $jsonstrtemp = $jsonstrtemp.'{"name":"'.$var['name'].'","url":"'.$var['url'].'","logo":"/Uploads'.$var['logo'].'"},';  
        }
      //  echo '{"success":true,"code":200,"msg":"操作成功","list":[{"name":"腾讯","url":"http://eqxiu.com/s/DRrVwR4r","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KAdFjbAAASblUbW10076.png"},{"name":"阿里巴巴","url":"http://eqxiu.com/s/kqKZ00","logo":"http://res.eqxiu.com/group1/M00/7A/1E/yq0KA1UmX_KAHrbYAAAT8y97Ldk570.png"},{"name":"汉庭","url":"http://eqxiu.com/s/fFF0NP","logo":"http://res.eqxiu.com/group1/M00/7A/1E/yq0KA1UmX_KAXJiDAAAS9RAywx8380.png"},{"name":"智联招聘","url":"http://eqxiu.com/s/6LaROx","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_OAHgWaAAAdrgswaPE755.png"},{"name":"携程","url":"http://eqxiu.com/s/5opIzb","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_OAZppjAAAT1aeMT-E250.png"},{"name":"红星美凯龙","url":"http://eqxiu.com/s/zkbsc6","logo":"http://res.eqxiu.com/group1/M00/7A/2A/yq0KA1UmYL6AV6b1AAAV6E9y6y4819.png"},{"name":"壹基金","url":"http://eqxiu.com/s/IrUv4x","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_OACDX3AAAZ99M4pLc791.png"},{"name":"光明网","url":"http://eqxiu.com/s/xLCe6c","logo":"http://res.eqxiu.com/group1/M00/7A/1E/yq0KA1UmX_KAdCWCAAAWBKk0n0Q923.png"},{"name":"中国平安","url":"http://eqxiu.com/s/R9ykb6","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_OAMiJwAAAUJ2KE59c428.png"},{"name":"顺丰","url":"http://eqxiu.com/s/ZfE6erwq","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KAah9EAAAZw2j_TDA008.png"},{"name":"华为","url":"http://eqxiu.com/s/Gx9GVn","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KADPwQAAAPg667Oto017.png"},{"name":"网易","url":"http://eqxiu.com/s/s9W386","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KAYKmtAAAV2AqvrTw033.png"},{"name":"爱奇艺","url":"http://eqxiu.com/s/lFSa2dFU","logo":"http://res.eqxiu.com/group1/M00/7A/2A/yq0KA1UmYL6ANG4KAAAWLvl2ZHo209.png"},{"name":"京东","url":"http://eqxiu.com/s/Z6iBtm","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KAATvoAAAQ0FVZjjI032.png"},{"name":"三联生活周刊","url":"http://eqxiu.com/s/lWNKJP","logo":"http://res.eqxiu.com/group1/M00/7A/1F/yq0KA1UmX_KAVFFbAAAYhJuVBJw731.png"}]}';
        $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';
      
        echo $jsonstr;
    }       

    public function msgList(){
        $msg=M('news');
        $where['status']=1;
		 $where['bizType']=array('lg',10);
         $count = $msg->where($where) -> count();
   
       $msglist = $msg->where($where)->order('id desc')->select();
        $jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$count.',"pageNo":1,"pageSize":'.$count.'},"list":[';
        foreach ($msglist as $var)
        {
          $jsonstrtemp = $jsonstrtemp.'{"id":'.$var['id'].',"type":'.$var['type'].',"bizType":'.$var['biztype'].',"toUser":'.json_encode($var['toUser']).',"toEmail":'.json_encode($var['toEmail']).',"fromUser":'.json_encode($var['fromUser']).',"sendTime":'.$var['sendtime'].'000,"title":'.json_encode($var['title']).',"content":'.json_encode($var['content']).',"status":2,"ext":null,"roleIdList":null},';  
        }
        $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';
        
       echo $jsonstr;
        
    }

    public function getBanner70(){		
		$res=array('status'=>0,'banner_bg'=>'');
		$friend=M('ad');
		$where['type']=2;
		$links=$friend->where($where)->select();
		
       /* $jsonstr ='{"success":true,"code":200,"msg":"操作成功","list":[';
        foreach ($links as $var)
        {
          $jsonstrtemp = $jsonstrtemp.'{"name":"'.$var['name'].'","url":"/Uploads'.$var['url'].'","logo":"/Uploads'.$var['logo'].'"},';  
        }
	    $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';      */
		$jsonstr=$slide_switchcc=$banner_body='';
		$banner_body_arr=C('banner_body');
		foreach ($links as $k=> $var) {
			$display=$k==0 ? 'list-item':'none';
			$jsonstr.='<li  style="display:  '.$display.'; background: url(/Uploads'.$var['url'].') 50% 0 no-repeat;"></li>';
			$slide_switchcc.='<li class="">'.$var['name'].'</li>';
			$banner_body.=$banner_body_arr[$k];
		}
		//$jsonstr='<li  style="display:  list-item; background: url(/index/images/slider-1.jpg) 50% 0 no-repeat;"></li><li class="slide2" style="display: none;"></li><li class="slide3" style="display: none;"></li><li class="slide4" style="display: none;"></li><li class="slide5" style="display: none;"></li><li class="slide6" style="display: none;"></li>';
       
	 //echo $jsonstr;
		$res['banner_bg']=$jsonstr;
		$res['slide_switchcc']=$slide_switchcc;// '<li class="">产品篇</li><li class="">功能篇</li><li class="">梦想篇</li><li class="">征集篇</li><li class="">吐槽篇</li><li class="">服务篇</li>';
		$res['banner_body']=$banner_body; //'<li style="position: absolute; display: none;"><div class="a1-1" style="left: 700px; opacity: 1; display: block; top: 140px;"></div><div class="a1-2" style="left: 120px; opacity: 1; display: block; top: 180px;"><strong style="font-weight:bold">"+your_webname+"</strong>，产品营销推广专家</div><div class="a1-3" style="left: 120px; opacity: 1; display: block; top: 240px;">                    国内唯一一家专注产品营销推广<br />                    免费自主创作高品质HTML5移动页面的专业平台<br />                    结合社会化媒体快速裂变，开启全网联动互动营销时代。<br /><div style="line-height:10px; height:10px; display:block"></div><span style="border:none;border-bottom:1px solid #b294a3; border-top:1px solid #b294a3; line-height:50px; display:block; width:400px; "><b id="scenecount">1</b><span>个产品正在使用"+your_webname+"！</span></span></div><div class="a1-4"  ng-click="openRegister()" style="left: 120px; opacity: 1; display: block; top: 420px;"></div></li><li style="position: absolute; display: none;"><div class="a3-1">适用&nbsp;&nbsp;&nbsp;实用&nbsp;&nbsp;&nbsp;简便</div><div class="a3-2">为各行各业提供百亿级产品服务</div><div class="a3-3">                    产品推广、品牌展示、活动宣传、会议举办</br>                    产品说明书、在线购买、售后服务、生产追溯、渠道跟踪</br></div><div class="a3-4"><img src="http://i1.tietuku.com/88cb8d6b62dbf041.png" /></div></li><li style="position: absolute; display: list-item;"><div class="a2-1">让每一个<strong>产品</strong>都有自己的<strong>故事</strong></div><div class="a2-2"><div style="font-size:36px; line-height:40px; color:#4aa318">我们的故事已经开启，你们的呢？</div></div><div class="a2-6"><div style="line-height:30px; font-size:16px; margin-top:20px;">                        我们怀揣梦想/我们追求极致/我们传递信仰<br>                        我们梦想助力所有企业更快融入移动互联网，于是，"+your_webname+"来了！<br /></div></div><div class="a2-7" onClick="document.location=\'#/home/register\';" style="top: 400px; opacity: 1; display: block; left: 450px;"></div></li><li style="position: absolute; display: none;"><div class="a4-1">超级产品秀</div><div class="a4-2"><img src="http://i1.tietuku.com/0c27f8485afb152a.png" /></div><div class="a4-3"></div><a class="a4-4" target="_blank" href="/"</a><a class="a4-5" target="_blank" href="/" ></a></li><li style="position: absolute; display: none;"><div class="a5-1">放肆吐槽&nbsp;&nbsp;人人都是产品经理</div><div class="a5-2">"+your_webname+"，你来作主！有奖，快来！</div><a class="a5-3" target="_blank" href="/"></a></li><li style="position: absolute; display: none;"><div class="a6-1">您的每一次咨询&nbsp;&nbsp;我们都倍感珍贵</div><div class="a6-3">                    "+your_webname+"拥有完善的客服团队，官方客服电话、官方QQ群、交流论坛</br>                    您的声音在哪里，我们就在哪里</br></div><div class="a6-4"><img src="/index/images/slider-61.png" /></div></li>';
		$res['scenecount']= C('home_products_num')?intval(C('home_products_num')) : 8643;
		echo json_encode($res);
	 
	}
	
	   public function getMenu70(){		
		$friend=M('ad');
		$where['type']=13;
		$links=$friend->where($where)->select();
        $jsonstr ='{"success":true,"code":200,"msg":"操作成功","list":[';
        foreach ($links as $var)
        {
			$var['url']=str_replace('&amp;','&',$var['url']);
          $jsonstrtemp = $jsonstrtemp.'{"name":"'.$var['name'].'","url":"'.$var['url'].'","logo":"/Uploads'.$var['logo'].'"},';  
        }
	    $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';      
        echo $jsonstr;
	}
	
	public function subList(){		
		 echo'{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":0,"pageNo":1,"pageSize":100},"list":[]}';
	}
}

