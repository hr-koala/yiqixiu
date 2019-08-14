<?php
namespace Home\Controller;
use Think\Controller;
class SceneController extends Controller{ 

    public function unlogin(){
		if(intval(session('userid')) == 0) 
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
    }
	

    public function _initialize(){
        header('Content-type: application/json;charset=UTF-8');
		if(intval(session('userid')) != 100)
		{
			//$wheresessionuser["userid_int"] = intval(session('userid'));
			
		}
		if(!defined('VIRIFY')){
			virifylocal();
		}
	}

    public function addpv(){
	 	 
		$posturl = 'http://'.$_SERVER ['HTTP_HOST'].'/?c=stat&a=statget&type=10&sceneid='.I('get.id',0);
		$fh = file_get_contents($posturl);
         $returnInfo = D("Scene")->addpv();
    }
	
    public function usepage(){
         $returnInfo = D("Scene")->usepage();
    }
	

    public function index(){
		$this->unlogin();
        if (IS_POST) {
			// 登录验证
            //$returnLoginInfo = D("Shoppingcart")->addcart();
            // 生成认证条件
			// 登录成功
			//echo json_encode($returnLoginInfo);
		}
		else
		{
			$_scene = M('scene');
			//$where['uid']  = $datainfo['uid'];
			$where['sceneid_bigint']  = I('get.id',0);
			if(intval(session('userid'))!=1)
			{
				$where['userid_int']  = intval(session('userid'));
			}
			$where['delete_int']  = 0;
			$_scene_list=$_scene->where($where)->order('sceneid_bigint desc')->select();     
			//$this->assign('webtitle','购物车');
            //$this->display();
			echo json_encode(array("success" => true,
									"code"=> 200,
									"msg" => "success",
									"obj"=> 1,
									"map"=> null,
									"list"=> null
								   )
							);
		}
    }
	
    public function create(){
		$this->unlogin();
        if (IS_POST) {
			// 登录验证
            $returnInfo = D("Scene")->addscene();
            // 生成认证条件
			// 登录成功
			//echo json_encode($returnLoginInfo);
		}
    }
	
	
    public function createBySys(){
		$this->unlogin();
        if (IS_POST) {
			// 登录验证
            $returnInfo = D("Scene")->addscenebysys();
            // 生成认证条件
			// 登录成功
			//echo json_encode($returnLoginInfo);
		}
    }
	
    public function createByCopy(){
		$this->unlogin();
        $returnInfo = D("Scene")->addscenebycopy();
    }
	
    public function on(){
		$this->unlogin();
        $returnInfo = D("Scene")->openscene(1);
    }
	
    public function off(){
		$this->unlogin();
        $returnInfo = D("Scene")->openscene(2);
    }
	
	public function publish(){
		$m_scene=M('Scene');	 

		$where['sceneid_bigint'] = I('get.id',0);
		$datainfo['publishTime'] = time();
		$where['userid_int'] = session('userid');
		if($m_scene->data($datainfo)->where($where)->save()){
			$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';	
			
		}else{
			$jsonstr='{"success":false,"code":101,"msg":"操作失败","obj":null,"map":null,"list":null}';	
			
			}
			
 		echo $jsonstr;
	}

    public function savepage(){
		$this->unlogin();
        if (IS_POST) {
			// 登录验证
			//if((session('level_int')=='4'&& session('type')=='1')){	
			$level_int=M('users')->where('userid_int='.session('userid'))->getField('level_int');
			if($level_int=='4'){      
                $returnInfo = D("Scenepagesys")->savepagesys();
			}else{
				$returnInfo = D("Scene")->savepage();
			}            
			//echo json_encode($returnLoginInfo);
		}
    }
	

    public function saveSettings(){
		$this->unlogin();
        if (IS_POST) {
			// 登录验证 
            $returnInfo = D("Scene")->savesetting();
            // 生成认证条件
			// 登录成功
			//echo json_encode($returnLoginInfo);
		}
    }
	



	
	public function pagelist(){
		$this->unlogin();
		   $sceneid = I('get.id',0);
		  
		if($sceneid=='1100'||$sceneid=='1101'||$sceneid=='1102'||$sceneid=='1103'){
			 
			$level_int=M('users')->where('userid_int='.session('userid'))->getField('level_int');
			if($level_int=='4'){	//&& session('type')=='1'
				$_scenepage = M('scenepagesys');
				//$where['uid']  = $datainfo['uid'];
				$where['biztype_int']  = $sceneid;
				$where['myTypl_id']=0;
				
				$_scene_list=$_scenepage->where($where)->order('pagecurrentnum_int asc')->select();
				// 
				$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
				$jsonstrtemp = '';
				foreach($_scene_list as $vo){
					$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["pageid_bigint"].',"sceneId":'.$vo["biztype_int"].',"num":'.$vo["pagecurrentnum_int"].',"name":"'.$vo["pagename_varchar"].'","properties":null,"elements":null,"scene":null},';
				}
				$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
				echo $jsonstr;   
			}else{
				 
				header('HTTP/1.1 403 Unauthorized');
				exit('{"success":false,"code":403,"msg":"未授权","obj":null,"map":null,"list":null}');
			}
			
		}else{
			$_scenepage = M('scenepage');
			//$where['uid']  = $datainfo['uid'];
			$where['sceneid_bigint']  = I('get.id',0);
			$where['myTypl_id']=0;
			if(intval(session('userid'))!=1)
			{
				$where['userid_int']  = intval(session('userid'));
			}
			$_scene_list=$_scenepage->where($where)->order('pagecurrentnum_int asc')->select();
			
			//var_dump($_scene_list);exit;     
			//$this->display();
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
			$jsonstrtemp = '';
			foreach($_scene_list as $vo){
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["pageid_bigint"].',"sceneId":'.$vo["sceneid_bigint"].',"num":'.$vo["pagecurrentnum_int"].',"name":"'.$vo["pagename_varchar"].'","properties":null,"elements":null,"scene":null},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
			echo $jsonstr;
		}
    }

	
    public function pvcount(){
		$this->unlogin();
		$_scene = M('scene');
		$where['userid_int']  = intval(session('userid'));
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->sum('hitcount_int');
		echo '{"success":true,"code":200,"msg":"success","obj":'.$_scene_list.',"map":null,"list":null}';
    }
	
    public function opencount(){
		$this->unlogin();
		$_scene = M('scene');
		$where['userid_int']  = intval(session('userid'));
		$where['delete_int']  = 0;
		$where['showstatus_int']  = 1;
		$_scene_list=$_scene->where($where)->count();
		echo '{"success":true,"code":200,"msg":"success","obj":'.$_scene_list.',"map":null,"list":null}';
    }
	
    public function view(){
		$_scene = M('scene');
		$isPreview = I('get.preview',0);
		//$where['uid']  = $datainfo['uid'];
		if(is_numeric(I('get.id',0))){
			$where2['sceneid_bigint']  = I('get.id',0);
		}
		else
		{
			$where2['scenecode_varchar']  = I('get.id',0);
		}
		$where2['delete_int']  = 0;
		$_scene_list2=$_scene->where($where2)->select();
		
		$password=I('get.password','');
		if($_scene_list2[0]['accesscode']&&$password){
			if($password!=$_scene_list2[0]['accesscode']){
				exit('{"success":false,"code":1004,"msg":"服务器异常","obj":null,"map":null,"list":null}');
			}
		}
		
		if(C('SYS_LINK')){
		  $_scene_list2[0]=get_scene_status($_scene_list2[0]);
		}
		
		/*if($_scene_list2[0]['showstatus_int']!=1)  //关闭
		{
			if($_scene_list2[0]['userid_int']!=intval(session('userid')))
			{
				$where3['sceneid_bigint']  = 267070;
				$_scene_list2=$_scene->where($where3)->select();
			}  
		}  */

		$advuserinfo['userid_int'] = $_scene_list2[0]['userid_int'];
		$advUser = M('users');
		$returnadvInfo=$advUser->where($advuserinfo)->select();
		
		$_scenepage = I('get.fromht',0)?  M('scenepagesys'): M('scenepage');
		$where['sceneid_bigint']  = $_scene_list2[0]['sceneid_bigint'];
		$where['userid_int']  = $_scene_list2[0]['userid_int'];
		$_scene_list=$_scenepage->where($where)->order('pagecurrentnum_int asc')->select();


		$_scene_list2[0]['lastpageid']=$_scene_list2[0]['lastpageid']>0? intval($_scene_list2[0]['lastpageid']):0;
		$accessCode=$_scene_list2[0]['accesscode']?'"accessCode": "'.$_scene_list2[0]['accesscode'].'",':'"accessCode": null,' ;
		
		//var_dump($_scene_list2);exit;     
		//$this->display();
		$jsonstr = '{"success": true,"code": 200,"msg": "操作成功","obj": {"id": '.$_scene_list2[0]['sceneid_bigint'].',"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',"createUser": "'.$_scene_list2[0]['userid_int'].'","type": '.$_scene_list2[0]['scenetype_int'].',"pageMode": '.$_scene_list2[0]['movietype_int'].',
		"image": {"imgSrc": "'.$_scene_list2[0]['thumbnail_varchar'].'",
		"lastPageId":'.$_scene_list2[0]['lastpageid'].',
		"hideEqAd":'.$_scene_list2[0]['hideeqad'];
		if($isPreview){
			//$this->unlogin();
			$jsonstr = $jsonstr.',"isAdvancedUser": true';
		}else{
			$jsonstr = $jsonstr.',"isAdvancedUser": '.$_scene_list2[0]['isadvanceduser'];
		}	
		$bgAudio_str='null';
		if($_scene_list2[0]["musicurl_varchar"]!='')
		{
			$bgAudio_str='{\"url\":\"'.$_scene_list2[0]['musicurl_varchar'].'\",\"type\":\"'.$_scene_list2[0]['musictype_int'].'\"}';
			$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list2[0]["musicurl_varchar"].'","type": "'.$_scene_list2[0]["musictype_int"].'"}';
		}else{
			$jsonstr =$jsonstr .',"bgAudio":null';
			}
		$property= str_replace('"','\"',$_scene_list2[0]['property']);
			$jsonstr_property='"property":"'.$property.'",';
		// if(C('JS_VISION')>=3.4&& $_scene_list2[0]['property']){
			// $property= str_replace('"','\"',$_scene_list2[0]['property']);
			// $jsonstr_property='"property":"'.$property.'",';
		// }else{
			// $jsonstr_property='"property" :"{\"isAdvancedUser\":'.$_scene_list2[0]['isadvanceduser'].',\"lastPageId\":'.$_scene_list2[0]['lastpageid'].',\"hideEqAd\":'.$_scene_list2[0]['hideeqad'].'}",';	
		// }
		 $timeout=$_scene_list2[0]['vi_timeout'] ? $_scene_list2[0]['vi_timeout'] :'""';
        $jsonStr_timeout=C('SYS_LINK')? '"timeout": '.$timeout.',"timeout_url":"'.$_scene_list2[0]['timeout_url'].'",' :'';
	   
		$_scene_list2[0]['hitcount_int']=$_scene_list2[0]['hitcount_int']?intval($_scene_list2[0]['hitcount_int']):0;
		$jsonstr = $jsonstr.'	
        },';
		$jsonstr = $jsonstr.'         
		'.$jsonstr_property.'
		'.$jsonStr_timeout.'
		'.$accessCode.'
		"cover":"'.$_scene_list2[0]['thumbnail_varchar'].'",
		"bgAudio" :"'.$bgAudio_str.'",     
        "isTpl": 0,
        "isPromotion": 0,
        "status": 1,
        "openLimit": 0,
        "startDate": null,
        "endDate": null,
        "updateTime": 1426045746000,
		"createTime": 1426572693000,
		"publishTime":1426572693000,
        "applyTemplate": 0,
        "applyPromotion": 0,
        "sourceId": null,
        "code": "'.$_scene_list2[0]['scenecode_varchar'].'",
        "description": "'.str_replace(array("\r","\n"),array("\\r","\\n"),$_scene_list2[0]['desc_varchar']).'",
        "sort": 0,
        "pageCount": 0,
        "dataCount": 0,
        "showCount": '.$_scene_list2[0]['hitcount_int'].',
		"eqcode" :"'.$_scene_list2[0]['eqcode'].'",
        "userLoginName": null,
        "userName": null
    },
    "map": null,
    "list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo)
        {
			//		$datas['elements'][$key]['content']=strpos($val['content'],'eqs/link?id=')!==false ? str_replace('eqs/link?id=','?c=scene&a=link&id='):	$val['content'];	
			if(strpos($vo["content_text"],'eqs\/link?id')!==false){
				$vo["content_text"]=str_replace('eqs\/link?id','?c=scene&a=link&id',$vo["content_text"]);
				
			}
			$vo["properties_text"]=$vo["properties_text"]?$vo["properties_text"]:'null';
		    
			$jsonstrtemp = $jsonstrtemp .'{"id": '.$vo["pageid_bigint"].',"sceneId": '.$vo["sceneid_bigint"].',"num": '.$vo["pagecurrentnum_int"].',
				"name": null,"properties":'.$vo["properties_text"].',"elements": '.$vo["content_text"].',"scene": null},';
		}
		// 
		if(C('IS_COUM_AD')){
			
			$jsonstrtemp=get_scene_ad($jsonstrtemp,$_scene_list2,$isPreview); 
		} 
		
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		echo $jsonstr;
    }

	
    public function design(){
		$this->unlogin();
		 $pageid = I('get.id',0);
	
		$level_int=M('users')->where('userid_int='.session('userid'))->getField('level_int');
		if($level_int=='4'){  	//&& session('type')=='1'
			$sceneid=M('scenepagesys')->where('pageid_bigint='.$pageid)->getField('biztype_int');
			 
			// echo $sceneid.'dddd';
		} 
        if($sceneid&&$sceneid<1104){
			 
			
            $_scenepage = M('scenepagesys');
            //$where['uid']  = $datainfo['uid'];
            $where['pageid_bigint']  = I('get.id',0);
            if(intval(session('userid'))!=1)
            {
                //$where['userid_int']  = intval(session('userid'));
            }
            $_scene_list=$_scenepage->where($where)->select();
			 
            $_scene = M('scene');
            //$where['uid']  = $datainfo['uid'];
            if(intval(session('userid'))!=1)
            {
                //$where2['userid_int']  = intval(session('userid'));
            }
            $where2['delete_int']  = 0;
            $where2['sceneid_bigint']  = $_scene_list[0]['biztype_int'];
            $_scene_list2=$_scene->where($where2)->select();  
			   
		 
            $replaceArray = json_decode($_scene_list[0]['content_text'],true);
            foreach($replaceArray as $key => $value){
                $replaceArray[$key]['sceneId'] = $_scene_list[0]['biztype_int'];
                $replaceArray[$key]['pageId'] = $where['pageid_bigint'];
            }
            $replaceArray = json_encode($replaceArray);
			$isTpl= $_scene_list2[0]['is_tpl'] ? intval($_scene_list2[0]['is_tpl'])  :0;
			
			$properties='{"thumbSrc":"'.$_scene_list[0]["thumbsrc_varchar"].'"}';
			// if($_scene_list[0]["properties_text"]){
				// $properties.=','.$_scene_list[0]["properties_text"];
			// }
//$_scene_list[0]["properties_text"]=$_scene_list[0]["properties_text"]?$_scene_list[0]["properties_text"]:'{"thumbSrc":"'.$_scene_list[0]["thumbsrc_varchar"].'"}';
			
            $jsonstr = '{"success": true,"code": 200,"msg": "success","obj": {"id": '.$_scene_list[0]['pageid_bigint'].',"sceneId": '.$_scene_list[0]['biztype_int'].',"num": '.$_scene_list[0]['pagecurrentnum_int'].',"name": null,"properties": '.$properties.',"elements": '.$replaceArray.
			',"scene": {"id": '.$_scene_list2[0]['sceneid_bigint'].',"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',"createUser": "'.$_scene_list2[0]['userid_int'].'","createTime": 1425998747000,"type": '.$_scene_list2[0]['scenetype_int'].',"pageMode": 0,"image": {"imgSrc": "'.$_scene_list2[0]['movietype_int'].'","isAdvancedUser": false';
			 
		
		    if($_scene_list2[0]['musicurl_varchar']!=''){
                $jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list2[0]["musicurl_varchar"].'","type": "'.$_scene_list2[0]["musictype_int"].'"}';
            }
			$jsonstr = $jsonstr.'},"isTpl": '.$isTpl.',"isPromotion": 0,"status": 1,"openLimit": 0,	"submitLimit": 0,	"startDate": null,	"endDate": null,	"accessCode": null,	"thirdCode": null,	"updateTime": 1426038857000,	"publishTime": 1426038857000,	"applyTemplate": 0,	"applyPromotion": 0,	"sourceId": null,	"code": "'.$_scene_list2[0]['scenecode_varchar'].'",	"description": "'.
				str_replace(array("\r","\n"),array("\\r","\\n"),$_scene_list2[0]['desc_varchar']).'",	"sort": 0,"pageCount": 0,	"dataCount": 0,	"showCount": 0,	"userLoginName": null,"userName": null}},	"map": null,"list": null}';
            echo $jsonstr;
        }else{
			$_scenepage = M('scenepage');
			//$where['uid']  = $datainfo['uid'];
			$where['pageid_bigint']  = I('get.id',0);
			if(intval(session('userid'))!=1)
			{
				$where['userid_int']  = intval(session('userid'));
			}
			$_scene_list=$_scenepage->where($where)->select();
			 
			$_scene = M('scene');
			//$where['uid']  = $datainfo['uid'];
			if(intval(session('userid'))!=1)
			{
				$where2['userid_int']  = intval(session('userid'));
			}
			$where2['delete_int']  = 0;
			$where2['sceneid_bigint']  = $_scene_list[0]['sceneid_bigint'];
			$_scene_list2=$_scene->where($where2)->select();     
	
			$isTpl= $_scene_list2[0]['is_tpl'] ? intval($_scene_list2[0]['is_tpl'])  :0;
			$isTplp= $_scene_list[0]['is_tpl'] ? intval($_scene_list[0]['is_tpl'])  :0;
			$replaceArray = json_decode($_scene_list[0]['content_text'],true);
			foreach($replaceArray as $key => $value){
				$replaceArray[$key]['sceneId'] = $_scene_list[0]['sceneid_bigint'];
				$replaceArray[$key]['pageId'] = $where['pageid_bigint'];
			}
			$replaceArray = json_encode($replaceArray);
	
			$jsonstr = '{"success": true,"code": 200,"msg": "success","obj": {"id": '.$_scene_list[0]['pageid_bigint'].',"sceneId": '.$_scene_list[0]['sceneid_bigint'].',"num": '.$_scene_list[0]['pagecurrentnum_int'].',"name": null,"isTpl": '.$isTplp.',"properties": '.$_scene_list[0]["properties_text"].',"elements": '.$replaceArray.','.
			'"scene": {"id": '.$_scene_list2[0]['sceneid_bigint'].',"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',"createUser": "'.$_scene_list2[0]['userid_int'].'","createTime": 1425998747000,"type": '.$_scene_list2[0]['scenetype_int'].',"pageMode": '.$_scene_list2[0]['movietype_int'].',"image": {"imgSrc": "'.$_scene_list2[0]['thumbnail_varchar'].'","isAdvancedUser": false';
			if($_scene_list2[0]['musicurl_varchar']!=''){
				$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list2[0]["musicurl_varchar"].'","type": "'.$_scene_list2[0]["musictype_int"].'"}';
			}
			$bgAudiotcc='';
			if($_scene_list2[0]['musicurl_varchar']!=''){
				$bgAudiotcc='"bgAudio" :"{\"url\":\"'.$_scene_list2[0]['musicurl_varchar'].'\",\"type\":\"'.$_scene_list2[0]['musictype_int'].'\"}",';
			}
			
			$jsonstr = $jsonstr.'},"isTpl": '.$isTpl.',"isPromotion": 0,"status": 1,"openLimit": 0,	"submitLimit": 0,	"startDate": null,	"endDate": null,	"accessCode": null,	"thirdCode": null,	"updateTime": 1426038857000,	"publishTime": 1426038857000,	"applyTemplate": 0,	"applyPromotion": 0,	"sourceId": null,	"code": "'.$_scene_list2[0]['scenecode_varchar'].'", 
			"cover": "'.$_scene_list2[0]['thumbnail_varchar'].'",
			"description": "'.
				str_replace(array("\r","\n"),array("\\r","\\n"),$_scene_list[0]['desc_varchar']).'",	"sort": 0,"pageCount": 0,	"dataCount": 0,	"showCount": '.$_scene_list2[0]['hitcount_int'].', '.$bgAudiotcc.'	"userLoginName": null,"userName": null,"promIds":null}},	"map": null,"list": null}';
			echo $jsonstr;
		}
    }
	
	


    public function detail(){
		$this->unlogin();
		$_scene = M('scene');
		if(intval(session('userid'))!=1)
		{
			$where['userid_int']  = intval(session('userid'));
		}
		$where['sceneid_bigint']  = I('get.id',0);
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->select();   
		 
		$_scene_list[0]['lastpageid']=$_scene_list[0]['lastpageid']>0? intval($_scene_list[0]['lastpageid']):0;
    

	  $updatetime=$_scene_list[0]['updatetime']  ? date('Y-m-d H:i',$_scene_list[0]['updatetime']): $_scene_list[0]['createtime_time'];		
		$publishTime=$_scene_list[0]['publishtime']>0 ? $_scene_list[0]['publishtime']:'null';
		$jsonstr_ka='';
		if(C('CURLPOST_BAOBAN_URL')){
			$userphone=session('phone');
			if(!$userphone){
				$userphone= M('users')->where('userid_int='.session('userid'))->getField('phone');
			}
			$cj_url='http://'.$_SERVER['HTTP_HOST'].'/index.php?c=view&id='.$_scene_list[0]['scenecode_varchar'];
			$jsonstr_ka='"userphone": "'.$userphone.'", "cj_url":"'.$cj_url.'",';	
			
		} 
		$jsonstr_property='';
		if($_scene_list[0]['property']){
			$property= str_replace('"','\"',$_scene_list[0]['property']);
			$jsonstr_property='"property":"'.$property.'",';
		}
		
	
		$_scene_list[0]['applytemplate']= $_scene_list[0]['applytemplate']? intval($_scene_list[0]['applytemplate']):0;
		$_scene_list[0]['applypromotion']= $_scene_list[0]['applypromotion']? intval($_scene_list[0]['applypromotion']):0;
		$accessCode=$_scene_list[0]['accesscode']?'"accessCode": "'.$_scene_list[0]['accesscode'].'",':'"accessCode": null,' ;
		$loadinglogo=$_scene_list[0]['loadinglogo']?'"loadingLogo": "'.$_scene_list[0]['loadinglogo'].'",':'"loadingLogo": null,' ;
		$createTime = strtotime($_scene_list[0]['createtime_time']).'000';
		//
		$jsonstr = '{
			"success": true,
			"code": 200,
			"msg": "success",
			"obj": {
				"id": '.$_scene_list[0]['sceneid_bigint'].',
				"name": '.json_encode($_scene_list[0]['scenename_varchar']).',
				"createUser": "'.$_scene_list[0]['userid_int'].'",
				"createTime": "'.$createTime.'",
				"type": '.$_scene_list[0]['scenetype_int'].',
				"pageMode": '.$_scene_list[0]['movietype_int'].',
				"eqcode": "'.$_scene_list[0]['eqcode'].'",
				"cover": "'.$_scene_list[0]['thumbnail_varchar'].'",
				'.$jsonstr_property.'
				'.$jsonstr_ka.'				
				"image": {
					"imgSrc": "'.$_scene_list[0]['thumbnail_varchar'].'",
					"isAdvancedUser": '.$_scene_list[0]['isadvanceduser'].',
                    "lastPageId":'.$_scene_list[0]['lastpageid'].',
                    "hideEqAd":'.$_scene_list[0]['hideeqad'];
				
				if($_scene_list[0]["musicurl_varchar"]!='')
				{
					$jsonstr = $jsonstr.',"bgAudio": {"url": "'.$_scene_list[0]["musicurl_varchar"].'","type": "'.$_scene_list[0]["musictype_int"].'"}';
				}
		$jsonstr = $jsonstr.'},
				"isTpl": 0,
				"isPromotion": '.intval($_scene_list[0]['applyPromotion']).',
				"isShow": '.intval($_scene_list[0]['is_show']).',
				"status": '.$_scene_list[0]['showstatus_int'].',
				"tagId"   : '.$_scene_list[0]['tagid_int'].',
				"openLimit": 0,
				"submitLimit": 0,
				"startDate": null,
				"endDate": null,
				'.$accessCode.' 
				'.$loadinglogo.'
				"thirdCode": null,
				"updateTime": "'.$updatetime.'",
				"publishTime": '.$publishTime.',
				"price": '.$_scene_list[0]['price'].',
				"applyTemplate": '.$_scene_list[0]['applytemplate'].',
				"applyPromotion": '.$_scene_list[0]['applypromotion'].',
				"sourceId": null,
				"code": "'.$_scene_list[0]['scenecode_varchar'].'",
				"description":"'.
				str_replace(array("\r","\n"),array("\\r","\\n"),$_scene_list[0]['desc_varchar']).'",
				"sort": 0,
				"bgAudio": {
					"url": "'.$_scene_list[0]["musicurl_varchar"].'",
					"type": "'.$_scene_list[0]["musictype_int"].'"
					},
				"pageCount": 0,
				"dataCount": '.$_scene_list[0]["datacount_int"].',
				"showCount": '.$_scene_list[0]['hitcount_int'].',
				"userLoginName": null,
				"userName": null
			},
			"map": null,
			"list": null
		}';
		echo $jsonstr;

    }


	public function createPage(){
		$this->unlogin();
		
		$level_int=M('users')->where('userid_int='.session('userid'))->getField('level_int');
		if($level_int=='44'){
		
			D("Scenepagesys")->addpagesys();				
		}else{

			$_scenepage = M('scenepage');
			$_scene = M('scene');
			$where['pageid_bigint']  = I('get.id',0);
			$iscopy  = I('get.copy',"false");
		   $getid = I('get.id',0);
			if((session('level_int')!='4')){	
				$where['userid_int']  = intval(session('userid'));
			}
			$_scene_list=$_scenepage->where($where)->select();
		 
			if(!$_scene_list)
			{
				header('HTTP/1.1 403 Unauthorized');
				echo json_encode(array("success" => false,"code"=> 403,"msg" => "false","obj"=> null,"map"=> null,"list"=> null));
				exit;
			}
			$pagenumY= $_scene_list[0]['pagecurrentnum_int'];
			$datainfo['scenecode_varchar'] = $_scene_list[0]['scenecode_varchar'];
			$datainfo['sceneid_bigint'] = $_scene_list[0]['sceneid_bigint'];
			$datainfo['pagecurrentnum_int'] = $pagenumY+1;
			$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
			
			if($iscopy=="true")
			{
				$datainfo['content_text'] = $_scene_list[0]['content_text'];
				 $datainfo['properties_text'] =  $_scene_list[0]['properties_text'];
				$datainfo['pagename_varchar'] = $_scene_list[0]['pagename_varchar']? '副本-'.$_scene_list[0]['pagename_varchar']: '副本-'.'第'.$pagenumY.'页';
			}
			else
			{
				
				$datainfo['content_text'] = "[]";
				$datainfo['properties_text'] = 'null';
				if(I('get.longPage',0)>0){
					$datainfo['properties_text'] = '{"longPage":'.I('get.longPage',0).'}';
				}
			}
			
			$datainfo['userid_int'] = session('userid');
			$result = $_scenepage->add($datainfo);
			if($result){
				$where_plist="sceneid_bigint='".$_scene_list[0]['sceneid_bigint']."' AND userid_int='".session('userid')."' AND pageid_bigint<>'$result' AND pagecurrentnum_int>".$pagenumY." " ;
				 
					//$sql="UPDATE cj_scenepage   SET  pagecurrentnum_int=pagecurrentnum_int+1 where $where_plist AND pagecurrentnum_int>".$_scene_list[0]['pagecurrentnum_int']." ORDER BY pagecurrentnum_int asc";
				//M()->query($sql);
					// echo D()->getlastsql();
					
	  	$photoList=M('scenepage')->field('pagecurrentnum_int,pageid_bigint')->where($where_plist)->order('pagecurrentnum_int asc')->select();
				foreach($photoList as $k=> $row){
					$sort=$row['pagecurrentnum_int']+1;
					M('scenepage')->where("pageid_bigint={$row[pageid_bigint]}")->save(array('pagecurrentnum_int'=>$sort)); 
					
					 
				}	 
				
					
			}
			
			$where2['sceneid_bigint']  = $_scene_list[0]['sceneid_bigint'];
			if(intval(session('userid'))!=1)
			{
				$where2['userid_int']  = intval(session('userid'));
			}
			$_scene_list2=$_scene->where($where2)->select();     

			$jsonstr = '{
					"success": true,
					"code": 200,
					"msg": "success",
					"obj": {
						"id": '.$result.',
						"sceneId": '.$_scene_list[0]['sceneid_bigint'].',
						"num": '.($_scene_list[0]['pagecurrentnum_int']+1).',
						"name": null,
						"properties": '.$_scene_list[0]['properties_text'].',
						"elements": null,
						"scene": {
							"id": '.$_scene_list2[0]['sceneid_bigint'].',
							"name": '.json_encode($_scene_list2[0]['scenename_varchar']).',
							"createUser": "'.$_scene_list2[0]['userid_int'].'",
							"createTime": 1425998747000,
							"type": '.$_scene_list2[0]['scenetype_int'].',
							"pageMode": '.$_scene_list2[0]['movietype_int'].',
							"image": {
								"imgSrc": "'.$_scene_list2[0]['thumbnail_varchar'].'",
								"isAdvancedUser": false
							},
							"isTpl": 0,
							"isPromotion": 0,
							"status": '.$_scene_list2[0]['showstatus_int'].',
							"openLimit": 0,
							"submitLimit": 0,
							"startDate": null,
							"endDate": null,
							"accessCode": null,
							"thirdCode": null,
							"updateTime": 1426039827000,
							"publishTime": 1426039827000,
							"applyTemplate": 0,
							"applyPromotion": 0,
							"sourceId": null,
							"code": "'.$_scene_list2[0]['scenecode_varchar'].'",
							"description": "",
							"sort": 0,
							"pageCount": 0,
							"dataCount": 0,
							"showCount": 0, 
							"userLoginName": null,
							"userName": null
						}
					},
					"map": null,
					"list": null,
					"iscopy":"'.$iscopy.'-----'.$getid.'"
				}';
			echo $jsonstr;


		}
	}

    public function delpage(){
		$this->unlogin();
		$map['pageid_bigint']= I('get.id',0);
		$level_int=M('users')->where('userid_int='.session('userid'))->getField('level_int');
		if(($level_int==4 ) && !I('get.ismy')){	
		 
			 
			$result=M("scenepagesys")->where($map)->delete();
			 
		}else{
		
			if(intval(session('userid'))!=1)
			{
				$map['userid_int']  = intval(session('userid'));
			}
			$workid=M("scenepage")->where($map)->getField('sceneid_bigint');
			$result=M("scenepage")->where($map)->delete();

			//updatapagesort($workid);
		}
        if($result){
			M('scenedata')->where($map)->delete();
			if(I('get.id',0)>0){
				M('scenedatadetail')->where("pageid_bigint=".I('get.id'))->delete();
			}
		}
		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => "success",
								"obj"=> null,
								"map"=> null,
								"list"=> null
							   )
						);


    }
	
	
    public function getcount(){
		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => "success",
								"obj"=> null,
								"map"=> null,
								"list"=> null
							   )
						);


    }


    public function delscene(){
		$this->unlogin();
		$map['sceneid_bigint']= I('get.id',0);
		if(intval(session('userid'))!=1)
		{
			$map['userid_int']  = intval(session('userid'));
		}
		$datainfo['delete_int'] = 1;
		M("scene")->data($datainfo)->where($map)->save();

		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => "success",
								"obj"=> null,
								"map"=> null,
								"list"=> null
							   )
						);


    }
	//我的场景列表 
    public function my(){
		$this->unlogin();
		$_scene = M('scene');
		$scenetype = intval(I('get.type',0));
		if($scenetype > 0)
		{
			$where['scenetype_int']  = $scenetype;
		}
		if($_POST['name'] != null)
		{
			$where['scenename_varchar']  = array('like','%'.$_POST['name'].'%');
		}
		if($_POST['groupId'] != null)
		{
			$where['groupid_int']  = $_POST['groupId'];
		}
		$where['userid_int']  = intval(session('userid'));
		//$_scene_list=$_scene->order('sceneid_bigint desc')->page(I('get.pageNo',1),I('get.pageSize',12))->select();
		 $where['delete_int']  = 0;
		$pageshowsize = I('get.pageSize',12);
		if($pageshowsize>30){
			$pageshowsize = 30;
		}
		$_scene_list=$_scene->where($where)->order('sceneid_bigint desc')->page(I('post.pageNo',1),$pageshowsize)->select();
 		$_scene_count = $_scene->where($where) ->count();
		
		//print_r($_scene_list);exit;     
		// $this->display();
		$pageNo = I('post.pageNo');
		if($pageNo == null){
			$pageNo = 1;
		}
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map": {"count": '.$_scene_count.',"pageNo": '.$pageNo.',"pageSize": '.$pageshowsize.'},"list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			$publishTime=$vo['publishtime']>0 ? $vo['publishtime']:'null';
			$updateTime=$vo['updateTime']>0 ? $vo['updateTime']:'null';
			//$vo['showstatus_int']=0;
			$jsonstrtemp = $jsonstrtemp .'{
            "id": '.$vo["sceneid_bigint"].',
            "name": '.json_encode($vo["scenename_varchar"]).',
            "createUser": "'.$vo['userid_int'].'",
            "createTime": 1423645519000,
            "type": '.$vo["scenetype_int"].',
            "pageMode": '.$vo["movietype_int"].',
				"cover": "'.$vo['thumbnail_varchar'].'",			
            "image": {
                "bgAudio": {
                    "url": "'.$vo["musicurl_varchar"].'",
                    "type": "'.$vo["musictype_int"].'"
                },
                "imgSrc": "'.$vo["thumbnail_varchar"].'",
                "hideEqAd": '.$vo["hideeqad"].',
                "isAdvancedUser": '.$vo["isadvanceduser"].'
            },
            "isTpl": '.$vo['is_tpl'].',
            "isPromotion": 0,
            "status": '.$vo['showstatus_int'].',
            "openLimit": 0,
            "submitLimit": 0,
            "startDate": null,
            "endDate": null,
            "accessCode": null,
            "thirdCode": null,
            "updateTime": '.$updateTime.',
            "publishTime": '.$publishTime.',
            "applyTemplate": 0,
            "applyPromotion": 0,
            "sourceId": 1225273,
            "code": "'.$vo["scenecode_varchar"].'",
            "description": "",
            "sort": 0,
            "pageCount": 0,
            "dataCount": '.$vo["datacount_int"].',
            "showCount": '.$vo["hitcount_int"].',
            "userLoginName": null,
            "userName": null
        },';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
    }

	//  系统模板列表 
    public function syslist(){
		$this->unlogin();
		$_scene = M('scene');
		$scenetype = intval(I('post.tagId',0));
		if($scenetype > 0)
		{
			$where['tagid_int']  = $scenetype;
		}
		if($_POST['name'] != null)
		{
			$where['scenename_varchar']  = array('like','%'.$_POST['name'].'%');
		}
		$where['is_tpl']  = 1;

		$where['delete_int']  = 0;
		
		if(I('post.noFree',0)==1){
			$where['price']=array('gt',0);	
		}
		if(I('post.free',0)==1){
			$where['price']=0;	
		}
		
		$pageshowsize = I('post.pageSize',12);
		if($pageshowsize>30){
			$pageshowsize = 30;
		}
		$order='rank desc, updateTime desc, sceneid_bigint desc';
		$orderby=I('post.orderBy','');
		if($orderby){
			$order=$orderby=='hot'? 'usecount_int DESC ':'sceneid_bigint desc';
		 }
		
		$_scene_list=$_scene->where($where)->order($order)->page(I('post.pageNo',1),$pageshowsize)->select();
	   // echo D()->getlastsql();
	 
		$_scene_count = $_scene->where($where) ->count();
 
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map": {"count": '.$_scene_count.',"pageNo": '.I('post.pageNo',0).',"pageSize": '.$pageshowsize.'},"list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			if(strstr($vo["scenename_varchar"],"302")){
				
			}else{
			$scene_role=2;
			if(C('IS_USER_ROLE_SCENE')){
				$scene_role=getSceneRole($vo['scenetype_int'] );
			}
			$vo['price']=$vo['price']?intval($vo['price']):0;
			
			$jsonstrtemp = $jsonstrtemp .'{
            "id": '.$vo["sceneid_bigint"].',
            "name": '.json_encode($vo["scenename_varchar"]).',
            "createUser": "'.$vo['userid_int'].'",
            "createTime": 1423645519000,
            "type": '.$vo["scenetype_int"].',
            "pageMode": '.$vo["movietype_int"].',
			"price":'.$vo['price'].',
			"cover": "'.$vo['thumbnail_varchar'].'",		
            "image": {
                "bgAudio": {
                    "url": "'.$vo["musicurl_varchar"].'",
                    "type": "'.$vo["musictype_int"].'"
                },
                "imgSrc": "'.$vo["thumbnail_varchar"].'",
                "hideEqAd": false,
                "isAdvancedUser": false
            },
            "isTpl": '.$vo["is_tpl"].',
            "isPromotion": 0,
            "status": '.$vo['showstatus_int'].',
            "openLimit": 0,
            "submitLimit": 0,
            "startDate": null,
            "endDate": null,
            "accessCode": null,
            "thirdCode": null,
            "updateTime": 1423645519000,
            "publishTime": 1423645519000,
            "applyTemplate": 0,
            "applyPromotion": 0,
            "sourceId": 1225273,
            "code": "'.$vo["scenecode_varchar"].'",
            "description": "'.str_replace(array("\r","\n"),array("\\r","\\n"),$vo['desc_varchar']).'",
            "sort": 0,
            "pageCount": 0,
            "dataCount": 0,
            "showCount": '.$vo["hitcount_int"].',
			 "scene_role": '.$scene_role.',
            "userLoginName": null,
            "userName": null
        },';
		}
		}
	
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
    }

	public function promotion(){
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$_scene = M('scene');
		$scenetype = intval(I('get.type',0));
		if($scenetype > 0)
		{
			$where['scenetype_int']  = $scenetype<10 ?'10'.$scenetype : $scenetype;
		}
		//$where['userid_int']  = array('gt',0);
		$where['is_tpl']  =0;

		$where['delete_int']  = 0;
		$where['applyPromotion']  = 2;  // applyPromotion=1  2015-7-24
		
		//$where['is_public']  = 1;
		$pageshowsize = I('get.pageSize',6);
		if($pageshowsize>30){
			$pageshowsize = 30;
		}
		if(strpos( $_SERVER['SERVER_NAME'],'gordonfz.net')!==false){
			$pageshowsize = 12;
		}
		if(C('HOME_PAGESIZE')){
			$pageshowsize=intval(C('HOME_PAGESIZE'));
		}
		
		$_scene_list=$_scene->where($where)->order('rank desc,sceneid_bigint desc')->page(I('get.pageNo',1),$pageshowsize)->select();
		 
		 
		 
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

	public function syspageinfo(){
		$this->unlogin();
		$_scene = M('scenepagesys');
		$_scene2 = M('scenepage');
		$scenetype = intval(I('get.id',0));
		$where['pageid_bigint']  = $scenetype;
		$_scene_list=$_scene->where($where)->select();
		if(empty($_scene_list)){
			$_scene_list=$_scene2->where($where)->select();
		}
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":{"id":'.$_scene_list[0]['pageid_bigint'].',"sceneId":1,"num":1,"name":"sys","properties":{"thumbSrc":"'.$_scene_list[0]['thumbsrc_varchar'].'"},"elements":'.$_scene_list[0]['content_text'].',"scene":null},"map":null,"list":null}';
		echo $jsonstr;
    }

    public function syspagetpl(){
		$this->unlogin();
		$_scene = M('scenepagesys');
		$_scene2 = M('scenepage');
		$scenetype = I('post.tagId',0);
		$name = I('post.name',0);
		$pageno = I('post.pageNo',1);
		$pagesize = I('post.pageSize',21);
		if($scenetype){
			$scenetype = explode(',', $scenetype);
			$c = count($scenetype);
		}		
		if($name != null){
			$where['pagename_varchar'] = array('like','%'.$name.'%');
			$where2['pagename_varchar'] = array('like','%'.$name.'%');
		}
		if($c == 1){
			$where['tagid_int'] = array('like','%'.$scenetype[0].'%');
			$where2['tagid_int'] = array('like','%'.$scenetype[0].'%');
		}else if($c == 2){
			$where['tagid_int'] = array('like',array('%'.$scenetype[0].'%','%'.$scenetype[1].'%'),'AND');
			$where2['tagid_int'] = array('like',array('%'.$scenetype[0].'%','%'.$scenetype[1].'%'),'AND');
		}else if($c == 3){
			$where['tagid_int'] = array('like',array('%'.$scenetype[0].'%','%'.$scenetype[1].'%','%'.$scenetype[2].'%'),'AND');
			$where2['tagid_int'] = array('like',array('%'.$scenetype[0].'%','%'.$scenetype[1].'%','%'.$scenetype[2].'%'),'AND');
		}
		$where2['is_tpl'] = 1;
		//$count = $_scene->where($where)->order('eqid_int desc')->count();
		$_scene_list1 = $_scene->where($where)->select();
		$_scene_list2 = $_scene2->where($where2)->select();
		//var_dump($_scene_list2);die;
		$_scene_list0 = array_merge($_scene_list1,$_scene_list2);
		foreach ($_scene_list0 as $key => $row) {
			$pageid_bigint[$key]  = $row['pageid_bigint'];
			$updatetime[$key] = $row['updatetime'];
		}
		array_multisort($updatetime, SORT_DESC, $pageid_bigint, SORT_DESC, $_scene_list0);
		//var_dump($_scene_list0);die;
		$count=count($_scene_list0);
		//echo $count;die;
		$p = ($pageno-1)*$pagesize;
		$_scene_list = array_slice($_scene_list0,$p,$pagesize);
		
		
		
		//$_scene_list=$_scene->where($where)->order('eqid_int desc')->page(I('post.pageNo',1),I('post.pageSize',21))->select();
		//
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$count.',"pageNo":'.I('post.pageNo',1).',"pageSize":'.I('post.pageSize',21).'},"list": [';
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["pageid_bigint"].',"sceneId":1,"num":1,"name":"'.$vo["pagename_varchar"].'","properties":{"thumbSrc":"'.$vo["thumbsrc_varchar"].'"},"elements":null,"scene":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
    }
	
	public function myTplSave(){
		
		$jsonStr='{"success":true,"code":200,"msg":"操作成功","obj":3138268,"map":null,"list":null}';
		echo $jsonstr;
	}
	
	public function link(){
		$url=$_GET['url'];
		if($url){
			//echo ''.$url."\n";			
			//echo htmlentities($url);			
			 	$mulu=C('APP2');
			$app2= $mulu? '/'.$mulu:'';
            $posturl = 'http://'.$_SERVER ['HTTP_HOST'].$app2.'/?c=stat&a=statget&type=1&sceneid='.I('get.id',0);
	
			//$fh = file_get_contents($posturl);
			header('Location: ' . $url);	
		}
	}
	public function dial(){
		$tel = I('post.num',0);
		$id = I('post.id',0);
		
		$mulu=C('APP2');
		$app2= $mulu? '/'.$mulu:'';
       $posturl = 'http://'.$_SERVER ['HTTP_HOST'].$app2.'/?c=stat&a=statget&type=2&sceneid='.I('get.id',0);
		
		$fh = file_get_contents($posturl); 
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
		echo $jsonstr; 
	}
	
	public function transfer(){
		$this->unlogin();
		$_user = M('users');
		$username = I('get.loginName','yy');
		$sceneid = I('get.id',0);
		$where['email_varchar'] = $username;
		$userinfo = $_user->where($where)->select();
		if($userinfo){
			$_scene = M('scene');
			 $where2['sceneid_bigint'] = $sceneid;
			$sceneinfo = $_scene->where($where2)->select();
			M('scene')->where($where2)->save(array('userid_int'=>$userinfo[0]['userid_int']));
			M('scenepage')->where($where2)->save(array('userid_int'=>$userinfo[0]['userid_int']));
			M('scenedata')->where($where2)->save(array('userid_int'=>$userinfo[0]['userid_int']));
			
			//copyAnlicc($sceneid, $userinfo[0]['userid_int']);
			
			//print_r($sceneinfo) ;
			$jsonStr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
		}else{
			$jsonStr='{"success":false,"code":1003,"msg":"账号不存在","obj":null,"map":null,"list":null}';	
		}
		echo $jsonStr;
	}
	
	public function getPageTpl(){
		$this->unlogin();
		$_PageTpl = M('upfilesys');
		$filetype=I('get.type',1301);
		if($filetype==1301){
			$where['filetype_int']  = 1301;// I('get.Type',1301);  // 1311  
			$where['is_lastpage_tpl']=1;
			$_PageTpllsit=$_PageTpl->where($where)->order('fileid_bigint asc')->select();
			
		}else{
			$where2['sceneid_bigint']  = 1311;			 
			$_PageTpllsit= M('scenepage')->where($where2)->order('pagecurrentnum_int asc')->select();
		}
		
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($_PageTpllsit as $vo)
		{
			$thumbSrc=$filetype==1301? $vo["filethumbsrc_varchar"] : $vo["thumbsrc_varchar"];
			$id=  $filetype==1301 ? $vo["fileid_bigint"] : $vo["pageid_bigint"];
			$jsonstrtemp = $jsonstrtemp //.'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
				.'{"id":'.$id.',"sceneId":'.$filetype.',"num":1,"name":null,"properties":{"thumbSrc":"'.$thumbSrc.'"},"elements":null,"scene":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
	}
	public function getlastpagebg(){
		$_PageBg = M('upfilesys');
		$id= I('get.id',0);
		
		if($id<100){
	
			
			$_scenepage = M('scenepage');
			//$where['uid']  = $datainfo['uid'];
			$where['pageid_bigint']  =I('get.id',0);	 
			$_scene_list=$_scenepage->where($where)->find(); 
			$elements=$_scene_list['content_text'];
			
			$yourweb=str_replace('http://','',C('lastpagelink'));
			$elements=str_replace(array('http:\/\/s1.eqxiu.com\/eqs\/link?','http%3A%2F%2Fwww.eqxiu.com','http%3A%2F%2Feqxiu.com','\u543e\u7231'),
				array('?c=scene&a=link&id=','http%3A%2F%2F'.$yourweb,'http%3A%2F%2F'.$yourweb,C('lastpagetext')),$elements); 
			
			$_PageBgList[0]["fileid_bigint"]=$where['pageid_bigint'];
		}else{
			$where['fileid_bigint']  = I('get.id',0);
			$_PageBgList=$_PageBg->where($where)->select();                              //width: 158px; height: 245px; margin-top: -43.5px; margin-left: 0px;
			//$webname=	C('site_name') ? C('lastpagetext'):'搜虎精品社区2';
			//$weblink=	C('site_url') ? C('lastpagelink'):'搜虎精品社区3';
			$webname=	C('lastpagetext');
			$weblink= C('lastpagelink');
			$elements='[{"id":183335727,"pageId":26143278,"sceneId":1301,"type":"3","css":{"zIndex":"1"},"properties":{"imgSrc":"'.$_PageBgList[0]["filesrc_varchar"].'"}},{"id":183335728,"pageId":26143278,"sceneId":1301,"type":"4","css":{"height":"16","zIndex":"2","width":"280","left":"21px","top":"122px"},"properties":{"height":"100px","imgStyle":{"width":280,"height":73,"marginTop":"-24px","marginLeft":"0px"},"width":"100px","src":"line.png"}},{"id":183335732,"pageId":26143278,"sceneId":1301,"type":"4","css":{"zIndex":"3","height":"257","width":"257","left":"84px","top":"170px"},"properties":{"height":"100px","imgStyle":{"width":158,"height":158,"marginTop":"-43.5px","marginLeft":"0px"},"width":"100px","src":"shadow.jpg"}},{"id":183335731,"pageId":26143278,"sceneId":1301,"type":"4","css":{"borderRadius":"0px","borderStyle":"solid","zIndex":"4","borderColor":"rgba(0,0,0,1)","paddingTop":"0px","height":"158","backgroundColor":"","color":"","boxShadow":"0px 0px 0px rgba(200,200,200,0.6)","borderWidth":"0px","width":"158","left":"84px","paddingBottom":"0px","top":"170px"},"properties":{"height":"100px","imgStyle":{"width":158,"height":245,"marginTop":"-43.5px","marginLeft":"0px"},"width":"100px","src":"lastbg.jpg"}},{"content":"<div style=\"text-align: center;\"><br></div>","css":{"top":"425px","left":"72px","zIndex":"5","backgroundColor":"rgba(0,0,0,0.5)","opacity":1,"color":"#676767","borderWidth":0,"borderStyle":"solid","borderColor":"rgba(0,0,0,1)","paddingBottom":0,"paddingTop":0,"lineHeight":1,"borderRadius":"22px","transform":"rotateZ(0deg)","borderRadiusPerc":100,"boxShadow":"0px 0px 0px rgba(0,0,0,0.5)","boxShadowDirection":0,"boxShadowSize":0,"width":177,"height":25,"borderBottomRightRadius":"22px","borderBottomLeftRadius":"22px","borderTopRightRadius":"22px","borderTopLeftRadius":"22px"},"id":26,"num":1,"pageId":26143278,"properties":{"width":177,"height":25,"anim":{"type":0,"direction":0,"duration":1,"delay":0,"countNum":1}},"sceneId":1301,"type":2},{"id":183335729,"pageId":26143278,"sceneId":1301,"type":"2","content":"<div style=\"text-align: center;\"><span style=\"font-size: small; line-height: 1; background-color: initial;\"><a href=\"'.$weblink.'\" target=\"_blank\"><font color=\"#ffffff\">创建一个场景→</font><font color=\"#fdea02\">'.$webname.'</font></a></span></div>","css":{"borderRadius":"0px","borderStyle":"solid","height":"42","paddingTop":"0px","borderColor":"rgba(222,220,227,1)","zIndex":"6","boxShadow":"0px 0px 0px rgba(200,200,200,0.6)","color":"","backgroundColor":"rgba(255,255,255,0)","borderWidth":"0px","width":"320","left":"0px","paddingBottom":"20px","top":"413px"},"properties":{"anim":{"type":0,"direction":3,"duration":1,"delay":0.6,"countNum":1}}}]';
		}
		 		
		 
		
		
		$jsonStr = '{"success":true,"code":200,"msg":"操作成功","obj":{"id":'.$_PageBgList[0]["fileid_bigint"].',"sceneId":1301,"num":4,"name":null,"properties":{"thumbSrc":"'.$_PageBgList[0]["filesrc_varchar"].'"},"elements":'.$elements.',"scene":null},"map":null,"list":null}';
		
		//$jsonStr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
		echo $jsonStr; 		
	}
	
	public function tagPageList(){		
        //$where['userid_int']  = 0;
        $m_upfile = M('tag');       
        $where['pageid_bigint'] = I('get.id',0);
        $tagname = M('scenepage')->where($where)->getField('pagename_varchar');
		$tagids_int_str = M('scenepage')->where($where)->getField('tagid_int');
		//if(is_array($tagname) && count($tagname)>0){}
		
		//echo $tagname."----".$tagids_int_str;die();
		if($tagname && $tagids_int_str){
			$where2['pagename_varchar'] = $tagname;
			//$tagid_list = M('scenepage')->where($where2)->getField('tagid_int',true); 
			//print_r($tagid_list);die();
			//$tempstr=join(',',$tagid_list);
			$tagids_int_str  = M('scenepage')->where($where)->getField('tagid_int');
			//echo D()->getlastsql();
			//$tempstr=join(',',$tagid_list);
			//$tempstr=$tempstr ? $tempstr.','.$tagids_int_str : $tagids_int_str;
			$tempstr=$tagids_int_str;
			//exit($tempstr);
       
			$m_upfilelist=$m_upfile->where('tagid_int in ('.$tempstr.")")->select();
			 //$m_upfilelist=$m_upfile->where("FIND_IN_SET(tagid_int,$tempstr)>0")->select();
			 
			//var_dump($m_upfilelist);
			//die();
			
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
			$jsonstrtemp = '';
			foreach($m_upfilelist as $vo)
			{
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
			$jsonstr = $jsonstr.']}';
			
			echo $jsonstr; 
		}elseif($tagids_int_str){
			
			$m_upfilelist=$m_upfile->where('tagid_int in ('.$tagids_int_str.")")->select();
			 //$m_upfilelist=$m_upfile->where("FIND_IN_SET(tagid_int,$tempstr)>0")->select();
			 
			//var_dump($m_upfilelist);
			//die();
			
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
			$jsonstrtemp = '';
			foreach($m_upfilelist as $vo)
			{
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
			}
			$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
			$jsonstr = $jsonstr.']}';
			
			echo $jsonstr; 
		}else{
			$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[]}';
			echo $jsonstr;
		}
	}
	
	public function getPageTag(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":1,"name":"图文","bizType":1101,"type":1},{"id":2,"name":"图集","bizType":1101,"type":1},{"id":4,"name":"文字","bizType":1101,"type":1},{"id":5,"name":"图表","bizType":1101,"type":1},{"id":6,"name":"报名表","bizType":1102,"type":1},{"id":8,"name":"留言","bizType":1102,"type":1},{"id":9,"name":"联系","bizType":1102,"type":1},{"id":11,"name":"清新","bizType":1103,"type":1},{"id":12,"name":"蓝色","bizType":1103,"type":1},{"id":13,"name":"中国风","bizType":1103,"type":1},{"id":14,"name":"简洁","bizType":1103,"type":1},{"id":15,"name":"黑白","bizType":1103,"type":1},{"id":16,"name":"红色","bizType":1103,"type":1},{"id":17,"name":"怀旧","bizType":1103,"type":1},{"id":18,"name":"现代","bizType":1103,"type":1},{"id":19,"name":"扁平化","bizType":1103,"type":1},{"id":120,"name":"黄色","bizType":1103,"type":1},{"id":121,"name":"绿色","bizType":1103,"type":1},{"id":122,"name":"紫色","bizType":1103,"type":1},{"id":123,"name":"黑色","bizType":1103,"type":1},{"id":124,"name":"白色","bizType":1103,"type":1},{"id":125,"name":"其他","bizType":1103,"type":1},{"id":260,"name":"English","bizType":1103,"type":1},{"id":262,"name":"Android","bizType":1103,"type":1}]}';
	}
	public function tagPageSet(){
        //$where['userid_int']  = 0;
        //$ids = I('get.ids',null);
        $where['pageid_bigint'] = I('get.pageId',null);
        $datainfo['tagid_int'] = I('get.ids',null);
        //echo $where['pageid_bigint'];die();
        M("scenepage")->data($datainfo)->where($where)->save();
		//echo D()->getLastSql();
		
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[]}';
		echo $jsonstr; 
    }

	 public	function countervalues(){
		 $scene_id=I('get.sceneId');
	   $fieldIds=I('get.fieldIds');
	   	$where['scene_id']=$scene_id;
		$where['field_id']=$fieldIds;
	   $count= M("counter")->where($where)->getField("count");
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"'.$fieldIds.'":"'.$count.'"},"list":null}';
	} 
	public	function counterset(){
	   $fieldIds=I('post.fieldId');
		$scene_id=I('post.sceneId');
		$where['scene_id']=$scene_id;
		$where['field_id']=$fieldIds;
		$info= M("counter")->where($where)->find(); 
		if($info){
			 M("counter")->where($where)->setInc("count");			 
		}else{
			$where["count"]=1;
			$where["ctime"]=time();
			 M("counter")->add( $where );			
		}
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"'.$fieldIds.'":"1"},"list":null}';
	} 
	
	public	function pv(){
		$scene_id=I('get.sceneId');
		$where['sceneid_bigint']=$scene_id;
		$info= M("Scene")->where($where)->getField("hitcount_int"); 
		echo $info;
	} 
	
	public function getMyGroup(){
		$tag = M('tag');
		$where['userid_int'] = I('get.param');
		$where['type_int'] = 3;
		$info= $tag->where($where)->order('tagid_int desc')->select();
		$jsonstr =  '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($info as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":"'.$vo["tagid_int"].'","groupName":"'.$vo["name_varchar"].'","userID":'.$vo["userid_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		echo $jsonstr;
	}
	
	public function createGroup(){
		$where['userid_int'] = session('userid');
		$where['name_varchar'] = I('post.name');
		$where['type_int'] = 3;
		$result = M("tag")->add( $where);	
		echo '{"success":true,"code":200,"msg":"操作成功","obj":'.$result.',"map":null,"list":null}';
	}
	
	public function updateGroup(){
		$tag = M('tag');
		$update['name_varchar'] = I('post.name');
		$where['tagid_int'] = I('post.id');
		$info= $tag->where($where)->save($update);
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
	
	public function setGroup(){
		$scene = M('scene');
		$update['groupid_int'] = I('post.id');
		$where['sceneid_bigint'] = I('post.sIds');
		$info= $scene->where($where)->save($update);
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
	
	public function deleteGroup(){
		$tag = M('tag');
		$scene = M('scene');
		$update['groupid_int'] = 0;
		$where['groupid_int'] = I('get.id');
		$where2['tagid_int'] = I('get.id');
		$info = $scene->where($where)->save($update);
		$tag->where($where)->delete();
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
	
	public function companyPromotion(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
	
	public function lable(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":{"guid":"20160120110430","comp":"20160120195624"},"map":null,"list":null}';
    }
	
}