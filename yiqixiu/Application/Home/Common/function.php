<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 14-3-7
 * Time: 上午10:15
 */
/**
 * 获取默认图片
 * @param $str
 * @return bool|mixed
 */
function get_default_img($str){
    if(!$str)return false;
    $str_arr=explode(',',$str);
    $map['id']=$str_arr[0];
    return M('images')->where($map)->getField('savepath');
}
function utf2gb($strInput) {
	//if(strpos( $_SERVER['SERVER_NAME'],'naurai.net')!==false){
		//return $strInput;
	//}else{
		return iconv('utf-8','gb2312',$strInput); 
	//}
}

  function curl_post($url,$data = null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);   //设置访问的url地址 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		/* if($data){
			 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			
		 }*/
		$data &&  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $tmpInfo;
	}
function get_scene_status($info){  
	if(isset($_GET['preview'])&& I('get.preview')=='preview'){
	  return $info;		
	}
	//print_r($info); echo $id.'id'.'<br>';exit;
	 $sysinfo=M('sys')->order('id asc')->find();	
	 $SYS_LINK=$sysinfo['other_info'];	
	 $arr=json_decode($sysinfo['sys_link_arr']); 
	 $sys_link_arr=object_array($arr);
	 $is_up_info=false;
	 
	 $where['scenecode_varchar']  = $info['scenecode_varchar'];		
	 $where['vi_beyond_time']=array('lt', mktime(0,0,1,intval(date('m',time()))));
	 M('scene')->where($where)->save(array('vi_beyond_time'=>time(),'vi_current_times'=>0));
	 if(empty($info)){
		 $info=M('scene')->where("vi_scenecode='".I('get.id')."'")->find();
		 if($info){
			$id=getscenecode($sys_link_arr['visit_invalid']);
			 
			$is_up_info=true;	 
		 }
	}else{
		if($info['vi_hittimes_set']&& $info['vi_hittimes_set']<=$info['vi_current_times']){
		$id=getscenecode($sys_link_arr['beyond']);
			$is_up_info=true;	
			 
		}
	} 
	
	if(!$is_up_info){
		if( $info['showstatus_int']!=1) {
		 
		//if($info['userid_int']!=intval(session('userid'))){
					$id=getscenecode($sys_link_arr['close']);
					$is_up_info=true;
				//}  
		}elseif($sysinfo['is_user_anli_shenghe'] && !isset($_GET['preview'])&&$info["shenhe"]!=1){
			 
				$id=getscenecode($sys_link_arr['noshenhe']);
				$is_up_info=true;	
						
		}elseif($info['vi_timeout']){
			// $arr=json_decode($info['vi_timeout']);				 
			// $timeout_arr=object_array($arr);
			//$id=getscenecode($sys_link_arr['timeout']);
			$info['timeout_url']=urlencode($sys_link_arr['timeout']) ; 		
		}
	}
	if(	$is_up_info){
		if(in_array($id,array($info['sceneid_bigint'],$info['scenecode_varchar']))){
			return $info;
		}
		
			if(is_numeric($id)){
					$where2['sceneid_bigint']  = $id;
				}
				else
				{
					$where2['scenecode_varchar']  = $id;
				}
				$info=M('scene')->where($where2)->find();
				 
				$info['hideeqad']=1;
				$info['isadvanceduser']=0;
				$info['property']=str_replace('"hideEqAd":false','"hideEqAd":true',$info['property']);
	}
   // 
  // print_r($info); echo $id.'id'.'<br>';exit;
	return $info;
}	
function getscenecode($str){
	$arr=strpos($str,'v-')!==false?explode('v-',$str) : explode('id=',$str); 
	return $arr[1]; 
}	
	
function deal_xd($datainfo,$other_arr=array()){
	$qi_ad_xd=M('sys')->order('id asc')->getField('qi_ad_xds');			
	$qi_ad_xd=$qi_ad_xd?intval($qi_ad_xd):90;
	
	$xd=M('users')->where("userid_int=".session('userid'))->getField('xd');	
	
	if($xd<$qi_ad_xd){
		$datainfo['hideeqad'] = 0;
		//echo '{"success":false,"code":1010,"msg":"秀点不足","obj":null,"map":null,"list":null}';
		//die;	
	}else{
		
		$update['xd'] =$xd-$qi_ad_xd;
		
		
		$re= M('users')->where("userid_int=".session('userid'))->save($update);
		if($re){
			$where['sceneid_bigint'] = $datas['id'];
			M('Scene')->where($where)->save(array('is_payxd'=>1));	
		}
		$adddata=array('userid_int'=>session('userid'),
			   'sceneid'=>$other_arr['id'],
			  'remark'=>$other_arr['name']. '去除尾页版权',
			'opttime'=>time(),
			'xd'=>$qi_ad_xd,
			'biztype'=>3,
			'biztitle'=>'去尾页'
			);
		
		M('xdlog')->add($adddata);
		
		$datainfo['hideeqad'] = 1;
	}
	return $datainfo;	
}

function get_scene_ad($jsonstrtemp,$_scene_list2,$isPreview=false){
	
	if($_scene_list2[0]['hideeqad']!=1 && !$isPreview){
		 
		if($_scene_list2[0]['ad_wzi']){
			$ad_wzi_arr= explode(',',$_scene_list2[0]['ad_wzi']);
			
			foreach($ad_wzi_arr as $ad_wz){
				$or=$ad_wz==1 ? 'asc':'desc';
				$adPageinfo=M('scenepagesys')->where("sceneid_bigint=1100")->order('pagecurrentnum_int '.$or)->find();
				
				if($adPageinfo){ 
					$search=array('\u573a\u666f\u540d\u79f0','shadow.png');
					$replace=array($_scene_list2[0]['scenename_varchar'],$_scene_list2[0]['thumbnail_varchar']);	
					
					//if($_scene_list2[0]['lastpageid']){
					
					//}
					$adPageinfo["properties_text"]=$adPageinfo["properties_text"]?$adPageinfo["properties_text"]:'null';
					
					$adPageinfo["content_text"]=str_replace($search,$replace,$adPageinfo["content_text"]);
					
					$jsonstrtemp_ad='{"id": '.$adPageinfo["pageid_bigint"].',"sceneId": '.$adPageinfo["sceneid_bigint"].',"num": '.$adPageinfo["pagecurrentnum_int"].',
				"name": null,"properties":'.$adPageinfo["properties_text"].',"elements": '.$adPageinfo["content_text"].',"scene": null},';
					
					$jsonstrtemp =$ad_wz==1 ?  $jsonstrtemp_ad.$jsonstrtemp :$jsonstrtemp.$jsonstrtemp_ad;
					
					//$jsonstrtemp = $jsonstrtemp .'{"id": '.$adPageinfo["pageid_bigint"].',"sceneId": '.$adPageinfo["sceneid_bigint"].',"num": '.$adPageinfo["pagecurrentnum_int"].',
					//	"name": null,"properties":'.$adPageinfo["properties_text"].',"elements": '.$adPageinfo["content_text"].',"scene": null},';
					
				}
			}
		}
	}
	return $jsonstrtemp;	
}

function getUsreJsonStr($userinfo){
	$property='null';
			$mytplid=M('mytpl')->where('userid_int='.session('userid'))->getField('id');
 			if($mytplid){
				$property='{\"myTplId\":'.$mytplid.'}';
 			}
	$field=C('REG_FIELD')? C('REG_FIELD'):'email_varchar';	
	$role_str=$userinfo['role'] ? ',"role":'.$userinfo['role'] :',"role":0';
	if($userinfo['headimg']){
				$img = json_encode($userinfo["headimg"]);
				
			}else{
				$img = "null";
			}
	$userinfo["xd"]=$userinfo["xd"] ? intval($userinfo["xd"]):0;
	$userinfo["sex"]=$userinfo["sex"] ? intval($userinfo["sex"]):0;
	$userinfo["type"]=$userinfo["type"]? intval($userinfo["type"]):1;
	$userInfoStr='"id":'.session('userid').',"loginName":"'.$userinfo[$field].'","xd":'.$userinfo["xd"].$role_str.',"sex":'
		.$userinfo["sex"].',"phone":'.json_encode($userinfo["phone"]).',"tel":'
		.json_encode($userinfo["tel"]).',"qq":'.json_encode($userinfo["qq"]).',"headImg":'
		.$img.',"idNum":null,"idPhoto":null,"regTime":1425093623000,"extType":0,"property":"'
		.$property.'","companyId":null,"deptName":null,"deptId":0,"checkEmail":"'.$userinfo["checkemail"].'","name":'.json_encode($userinfo["uname"]).',"email":"'.$userinfo["email_varchar"].'","type":'.$userinfo["type"].',"status":'.$userinfo["status_int"].',"relType":null,"companyTplId":null,"roleIdList":['.$userinfo["level_int"].']';
	return $userInfoStr;
}
function copyAnlicc($sceneid_bigint,$userid_int){
	$m_scene=M('Scene');
	$m_scenepage=M('scenepage');
	$m_scenedata=M('scenedata');
	
	$wheresysscene['sceneid_bigint']  = $sceneid_bigint;
		$_scene_sysinfo=$m_scene->where($wheresysscene)->select();


		$datainfo['scenecode_varchar'] = 'U'.(date('y',time())-9).date('m',time()).date('d',time()).randorderno(10,-1);
		$datainfo['scenename_varchar'] = '副本-'.$_scene_sysinfo[0]['scenename_varchar'];
		$datainfo['movietype_int'] = $_scene_sysinfo[0]['movietype_int'];
		$datainfo['scenetype_int'] = $_scene_sysinfo[0]['scenetype_int'];
		$datainfo['ip_varchar'] = get_client_ip();
		$datainfo['thumbnail_varchar'] = $_scene_sysinfo[0]['thumbnail_varchar'];
		$datainfo['musicurl_varchar'] = $_scene_sysinfo[0]['musicurl_varchar'];
		$datainfo['musictype_int'] = $_scene_sysinfo[0]['musictype_int'];
		$datainfo['fromsceneid_bigint'] = $wheresysscene['sceneid_bigint'];
	$datainfo['userid_int'] =$userid_int;
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		
		$result1 = $m_scene->add($datainfo);
	if($result1){
		$wheresyspage['sceneid_bigint']  = $sceneid_bigint;
		$_scene_syspageinfo=$m_scenepage->where($wheresyspage)->select();
		foreach($_scene_syspageinfo as $vo){
			$datainfo2['scenecode_varchar'] = $datainfo['scenecode_varchar'];
			$datainfo2['sceneid_bigint'] = $result1;
			$datainfo2['content_text'] = $vo['content_text'];
			$datainfo2['properties_text'] = 'null';
			$datainfo2['pagecurrentnum_int'] = $vo['pagecurrentnum_int'];
			$datainfo2['userid_int'] = session('userid');
			$datainfo2['createtime_time'] = date('y-m-d H:i:s',time());
			$result2 = $m_scenepage->add($datainfo2);


			$wheredata['userid_int'] = $userid_int;
			$wheredata['sceneid_bigint'] = $vo['sceneid_bigint'];
			$wheredata['pageid_bigint'] = $vo['pageid_bigint'];
			$_scenedatasys_list = $m_scenedata->where($wheredata)->select();

			foreach($_scenedatasys_list as $vo2){
				$dataList[] = array('sceneid_bigint'=>$result1,
					'pageid_bigint'=>$result2,
					'elementid_int'=>$vo2['elementid_int'],
					'elementtitle_varchar'=>$vo2['elementtitle_varchar'],
					'elementtype_int'=>$vo2['elementtype_int'],
					'userid_int'=>session('userid')
					);
			}

		}
		if(count($dataList)>0){
			$m_scenedata->addAll($dataList);
		}
	}
}
/**
 * 获取图片集
 * @param $str
 * @return bool|mixed
 */
function get_img_array($str){
    if(!$str)return false;
    $str_arr=@explode(',',$str);
    $map['id']=array('in',$str_arr);
    return M('images')->where($map)->field('savepath')->select();
}

/**
 * 分类面包屑导航
 * @param $cid
 * @param bool $flag
 * @return string
 */
function conist_nav($cid,$flag=false){
    $cat = new \Org\Util\Category('Category', array('cid', 'pid', 'name', 'fullname'));
    $arr=$cat->getPath($cid);
    $str='<a href='.__APP__.'>'.L('T_HOME').'</a>>';
    if(is_array($arr))
    foreach($arr as $v){
        $str.=$v['name'].'>';
    }
    if($flag)$str=substr($str,0,-1);
    return $str;
}


 

