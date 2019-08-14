<?php
namespace Home\Controller;
use Think\Controller;
class ViewController extends Controller {
	public function index(){ 
		if(!defined('VIRIFY')){
			virifylocal();
		}
		$_scene = M('scene');
		//$where['scenecode_varchar']  = I('get.id',0);
		if(is_numeric(I('get.id',0))){
			$where['sceneid_bigint']  = I('get.id',0);
		}
		else
		{
			$where['scenecode_varchar']  = I('get.id',0);
		}
		
		
		
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->select(); 
		$sys_link_arr=C('sys_link_arr');
		//var_dump($sys_link_arr) ;die;
		
		if(empty($_scene_list)){
			if(!empty($sys_link_arr['visit_invalid'])){
				header('Location: ' .$sys_link_arr['visit_invalid']); exit;
			}else{
				 $this->error('抱歉，您访问的场景不存在','/#/main');
				}
		}
		if($_scene_list[0]["showstatus_int"]!=1){
			if(!empty($sys_link_arr['close'])){
				header('Location: ' .$sys_link_arr['close']); exit;
			}else{
				 $this->error('抱歉，您访问的场景处于关闭状态','/#/main');
				}
		}
//		if(C('SYS_LINK')){
//			//echo date('Y-m-d H:i',mktime(0,0,1,intval(date('m',time()))));
//			$where['vi_beyond_time']=array('lt', mktime(0,0,1,intval(date('m',time()))));
//			M('scene')->where($where)->save(array('vi_beyond_time'=>time(),'vi_beyond'=>0));  //
//			 //echo D()->getlastsql();
//			$SYS_LINK=$sysinfo['other_info'];	
//			$arr=json_decode($sysinfo['sys_link_arr']); 
//			$sys_link_arr=object_array($arr);
//		} 
		if(I('get.preview') !='preview'){D('Stat')->tongji();}     
			
		if(C('is_user_anli_shenghe')&& !isset($_GET['preview'])){
			if($_scene_list[0]["shenhe"]!=1){
				if(!empty($sys_link_arr['noshenhe'])){
					header('Location: ' .$sys_link_arr['noshenhe']); exit;
				}else{
				 $this->error('抱歉，您访问的场景还没通过管理员审核','/#/main');
				}
					
			}			
		}
		if(C('CURLPOST_BAOBAN_URL')){ // ka
			
		}
		
		
	
		$argu2 = array();
		$argu2['workid'] =$_scene_list[0]["sceneid_bigint"];
		$argu2['title'] = $_scene_list[0]["scenename_varchar"];
		$argu2['url'] = C('IS_OPEN_STATIC')?  'v/'.$_scene_list[0]["scenecode_varchar"] : 'index.php?c=view&id='.$_scene_list[0]["scenecode_varchar"];
		$argu2['desc'] = $_scene_list[0]["desc_varchar"];
		$argu2['imgsrc'] = $_scene_list[0]["thumbnail_varchar"];
		$this->assign("confinfo2",$argu2);
		if($_scene_list[0]['property']==''){
			$_scene_list[0]['property']='null';
		}else{
			$_scene_list[0]['property']="'".$_scene_list[0]['property']."'";
		}
		 	$this->assign("sceneinfo",$_scene_list[0]);
		 $site_appId=C('site_appId')? C('site_appId'):C('WX_APPID') ;
		 $site_appSecret=C('site_appSecret')? C('site_appSecret'):C('WX_AppSecret') ;
		 
		//if($mydd!=='127.0.0.1'){
		 if(strpos( $_SERVER['SERVER_NAME'],'104')===false){
		 
		 $confinfo = $this->get_js_sdk($site_appId,$site_appSecret);  //)'wx40e4c82c3d9df03e','47065ff14dbea4f06521f6d45740e285'
		  } 
		//取出logo URL
		$ad = M('ad');
		$where['type']  = 1;
		$ad_logo=$ad->where($where)->select(); 
		$logo_url='http://'.$_SERVER['HTTP_HOST'].'/Uploads'.$ad_logo[0][url];
		$this->assign("logo_url",$logo_url);
		//取出logo URL结束
		//var_dump($logo_url);
		//print_r($confinfo); exit;
		$this->assign("confinfo",$confinfo);
		
		$this->display('index');
    }
	public function indexz(){
		echo "cc";die;
		//$id = I('get.id',0);
		//重定向浏览器 
		//header("Location:http://".$_SERVER['HTTP_HOST']."/v-".$id); 
		//确保重定向后，后续代码不会被执行 
		//exit;
	}

	// index.php?c=view&a=test
    public function test(){
		$confinfo = $this->get_js_sdk(C('WX_APPID'),C('WX_AppSecret'));
		//	$confinfo = $this->get_js_sdk("wx533f257e7939a0a3","cc0c5be7608796de016d6c08ccb1a09c");
		
		print_r($confinfo);
		$this->assign("confinfo",$confinfo);
		exit;
		$this->display();
    }
	
	public function imagePreview(){
		echo '/view/images/previewbg_spring.jpg';
    }

	public function indext(){ 
		if(!defined('VIRIFY')){
			virifylocal();
		}
		$_scene = M('scene');
		$where['scenecode_varchar']  = I('get.id',0);
		
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->select();   
		// print_r($_scene_list); exit('dddd');
		
		$sysinfo=M('sys')->order('id asc')->find();	
		
		define('test_log',true); 
		
		$argu2 = array();
		$argu2['title'] = $_scene_list[0]["scenename_varchar"];
		$argu2['url'] =  'index.php?c=view&id='.$_scene_list[0]["scenecode_varchar"];
		$argu2['desc'] = $_scene_list[0]["desc_varchar"];
		$argu2['imgsrc'] = $_scene_list[0]["thumbnail_varchar"];
		$this->assign("confinfo2",$argu2);
		
		$mydd= get_client_ip();
		
		$jssdk = new \Think\Wxsdk(C('WX_APPID'),C('WX_AppSecret'));
		$confinfo = $jssdk->getSignPackage();
		//$confinfo = $this->get_js_sdk(C('WX_APPID'),C('WX_AppSecret'));
		 print_r($confinfo);
		$this->assign("confinfo",$confinfo);
		$this->display('index2_9_vi'); 
	}
		 /**
		 * php curl 请求链接
		 * 当$post_data为空时使用GET方式发送
		 * @param unknown $url
		 * @param string $post_data
		 * @return mixed
		 */
		function curlSend($url,$post_data=""){	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			if($post_data != ""){
				curl_setopt($ch,CURLOPT_POST,1);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			}
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}


		/**
		 * 调用接口获取 $ACCESS_TOKEN
		 * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
		 * @param unknown $APP_ID
		 * @param unknown $APP_SECRET
		 * @return Ambigous <mixed, Thinkmixed, object>
		 */
		function get_accesstoken($APP_ID,$APP_SECRET){
			$ACCESS_TOKEN = S($APP_ID);
			if($ACCESS_TOKEN == false){
				$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APP_ID."&secret=".$APP_SECRET;
				$json = $this->curlSend($url);
				
				$data=json_decode($json,true);
					
				S($APP_ID,$data[access_token],7000);
				$ACCESS_TOKEN = S($APP_ID);
			}
		
			return $ACCESS_TOKEN;
		}

		/**
		 * 微信网页JSSDK  调用接口获取 $jsapi_ticket
		 * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
		 * @param unknown $ACCESS_TOKEN
		 * @return Ambigous <mixed, Thinkmixed, object>
		 */
		function get_jsapi_ticket($ACCESS_TOKEN){
			$jsapi_ticket = S($ACCESS_TOKEN);
			//var_dump(S($ACCESS_TOKEN));exit;
			if($jsapi_ticket == false){
				$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$ACCESS_TOKEN."&type=jsapi";
				$json = $this->curlSend($url);
				$data = json_decode($json,true);
				
				$aaa = S($ACCESS_TOKEN,$data[ticket],7000);
				$jsapi_ticket = S($ACCESS_TOKEN);
			}
		
			return $jsapi_ticket;
		}

		/**
		 * 微信网页JSSDK 获取签名字符串
		 * 所有参数名均为小写字符
		 * @param unknown $nonceStr 随机字符串
		 * @param unknown $timestamp 时间戳
		 * @param unknown $jsapi_ticket
		 * @param unknown $url 调用JS接口页面的完整URL，不包含#及其后面部分
		 */
		function get_js_sdk($APP_ID,$APP_SECRET){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== off || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			$argu = array();
			$argu['appId'] = $APP_ID;
			$argu['url'] = $url;
			$argu['nonceStr'] =createNonceStr();
			$argu['timestamp'] = time();
			
			$ACCESS_TOKEN = $this->get_accesstoken($APP_ID, $APP_SECRET);
			$argu['jsapi_ticket'] = $this->get_jsapi_ticket($ACCESS_TOKEN);
		
			$string = "jsapi_ticket=".$argu[jsapi_ticket]."&noncestr=".$argu[nonceStr]."&timestamp=".$argu[timestamp]."&url=".$argu[url];
			$argu['signature'] = sha1(trim($string));
			return $argu;
		}

		
		
		
}