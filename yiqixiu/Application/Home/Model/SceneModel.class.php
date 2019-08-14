<?php
namespace Home\Model;
use Think\Model;
class SceneModel extends Model {

    public function addscene() {
		checkAllow_nums();
		$m_scene=M('Scene');
		$m_scenepage=M('scenepage');
		$datas = $_POST;
		$datainfo['scenecode_varchar'] = 'U'.(date('y',time())-9).date('m',time()).randorderno(6,-1);
		$datainfo['scenename_varchar'] = $datas['name'];
		$datainfo['movietype_int'] = $datas['pageMode'];
		$datainfo['scenetype_int'] = intval($datas['type']);
		$datainfo['ip_varchar'] = get_client_ip();
		$datainfo['thumbnail_varchar'] = "default_thum.jpg";
		$datainfo['userid_int'] = session('userid');
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		$datainfo['is_public'] = 0;
		$result1 = $m_scene->add($datainfo);
		//var_dump($result1);exit;
		if($result1){
			$datainfo2['scenecode_varchar'] = $datainfo['scenecode_varchar'];
			$datainfo2['sceneid_bigint'] = $result1;
			$datainfo2['content_text'] = "[]";
			$datainfo2['properties_text'] = 'null';
			$datainfo2['userid_int'] = session('userid');
			$result2 = $m_scenepage->add($datainfo2);
			echo json_encode(array("success" => true,
									"code"=> 200,
									"msg" => "success",
									"obj"=> $result1,
									"map"=> null,
									"list"=> null
								   )
							);
		}else{
			exit;
		}
    }


    public function addscenebysys() {
		checkAllow_nums(); 
		
		$m_scene=M('Scene');
		$m_scenepage=M('scenepage');
		$datas = $_POST;
		

		//$wheresysscene['userid_int']  = 0;
		$wheresysscene['sceneid_bigint']  = I('post.id',0);  
		
		$_scene_sysinfo=$m_scene->where($wheresysscene)->select();
		if(C('IS_USER_ROLE_SCENE')){
			checkRole($_scene_sysinfo[0]['scenetype_int'] );
		}
		
		if($_scene_sysinfo[0]['price'] >0){
			deal_sceneprice($_scene_sysinfo[0]);	
		}

		$datainfo['scenecode_varchar'] = 'U'.(date('y',time())-9).date('m',time()).date('d',time()).randorderno(6,-1);
		$datainfo['scenename_varchar'] = $datas['name'];
		$datainfo['movietype_int'] = $_scene_sysinfo[0]['movietype_int'];
		$datainfo['scenetype_int'] = intval($datas['type']);
		$datainfo['ip_varchar'] = get_client_ip();
		$datainfo['thumbnail_varchar'] = $_scene_sysinfo[0]['thumbnail_varchar'];
		$datainfo['musicurl_varchar'] = $_scene_sysinfo[0]['musicurl_varchar'];
		$datainfo['musictype_int'] = $_scene_sysinfo[0]['musictype_int'];
		$datainfo['fromsceneid_bigint'] = $wheresysscene['sceneid_bigint'];
		$datainfo['userid_int'] = session('userid');
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		
		$datainfo['shenhe'] =0;
		
		$datainfo['is_public'] = 0;
		$result1 = $m_scene->add($datainfo);

		$m_scenedatasys=M('scenedatasys');
		$m_scenedata=M('scenedata');

		if($result1){
			$m_scene->where($wheresysscene)->setInc('usecount_int');
			
			//$wheresyspage['userid_int']  = 0;
			$wheresyspage['sceneid_bigint']  = I('post.id',0);
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
				
				$wheredata['userid_int'] = 0;
				$wheredata['sceneid_bigint'] = $vo['sceneid_bigint'];
				$wheredata['pageid_bigint'] = $vo['pageid_bigint'];
				$_scenedatasys_list = $m_scenedatasys->where($wheredata)->select();

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
			 echo json_encode(array("success" => true,
									"code"=> 200,
									"msg" => "success",
									"obj"=> $result1,
									"map"=> null,
									"list"=> null
								   )
							); 
							
		}else{
			exit;
		}
    }

    public function transfer() {
		$m_scene=M('Scene');
		$m_scenepage=M('scenepage');
		$m_scenedata=M('scenedata');
		$u_user=M('users');
		$where['email_varchar']=I('get.loginName');
		$usr=$u_user->where($where)->find();
		$wheresysscene['userid_int']  = session('userid');
		$wheresysscene['sceneid_bigint']  = I('get.id',0);
		$_scene_sysinfo=$m_scene->where($wheresysscene)->select();	 
		if($usr){
			if(session('userid')==$usr['userid_int']){
			 return 3;exit;}

		$datainfo['scenecode_varchar'] = 'U'.(date('y',time())-9).date('m',time()).date('d',time()).randorderno(10,-1);
		$datainfo['scenename_varchar'] = '转送-'.$_scene_sysinfo[0]['scenename_varchar'];
		$datainfo['movietype_int'] = $_scene_sysinfo[0]['movietype_int'];
		$datainfo['scenetype_int'] = $_scene_sysinfo[0]['scenetype_int'];
		$datainfo['ip_varchar'] = get_client_ip();
		$datainfo['thumbnail_varchar'] = $_scene_sysinfo[0]['thumbnail_varchar'];
		$datainfo['musicurl_varchar'] = $_scene_sysinfo[0]['musicurl_varchar'];
		$datainfo['musictype_int'] = $_scene_sysinfo[0]['musictype_int'];
		$datainfo['fromsceneid_bigint'] = $wheresysscene['sceneid_bigint'];
		$datainfo['userid_int'] = $usr['userid_int']; 
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		$result1 = $m_scene->add($datainfo);
		if($result1){
			$m_scene->where($wheresysscene)->setInc('usecount_int');
			$wheresyspage['userid_int']  = session('userid');
			$wheresyspage['sceneid_bigint']  = I('get.id',0);
			$_scene_syspageinfo=$m_scenepage->where($wheresyspage)->select();
			foreach($_scene_syspageinfo as $vo){
				$datainfo2['scenecode_varchar'] = $datainfo['scenecode_varchar'];
				$datainfo2['sceneid_bigint'] = $result1;
				$datainfo2['content_text'] = $vo['content_text'];
				$datainfo2['properties_text'] = 'null';
				$datainfo2['pagecurrentnum_int'] = $vo['pagecurrentnum_int'];
				$datainfo2['userid_int'] = $usr['userid_int'];
				$datainfo2['createtime_time'] = date('y-m-d H:i:s',time());
				$result2 = $m_scenepage->add($datainfo2);
				$wheredata['userid_int'] = session('userid');
				$wheredata['sceneid_bigint'] = $vo['sceneid_bigint'];
				$wheredata['pageid_bigint'] = $vo['pageid_bigint'];
				$_scenedatasys_list = $m_scenedata->where($wheredata)->select();
				foreach($_scenedatasys_list as $vo2){
					$dataList[] = array('sceneid_bigint'=>$result1,
						'pageid_bigint'=>$result2,
						'elementid_int'=>$vo2['elementid_int'],
						'elementtitle_varchar'=>$vo2['elementtitle_varchar'],
						'elementtype_int'=>$vo2['elementtype_int'],
						'userid_int'=>$usr['userid_int'] );
													}			
											}
				}
				return 0;
				if(count($dataList)>0){
					$m_scenedata->addAll($dataList);
				return 1;
				}
		
		}else{
			return 2;
		}
	}
    public function addscenebycopy() {
		checkAllow_nums();
		$m_scene=M('Scene');
		$m_scenepage=M('scenepage');
		$m_scenedata=M('scenedata');
		

		$wheresysscene['userid_int']  = session('userid');
		$wheresysscene['sceneid_bigint']  = I('get.id',0);
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
		$datainfo['userid_int'] = session('userid');
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		$datainfo['is_public'] = 0;
		$result1 = $m_scene->add($datainfo);
		if($result1){
			$m_scene->where($wheresysscene)->setInc('usecount_int');
			
			//$wheresyspage['userid_int']  = session('userid');
			$wheresyspage['sceneid_bigint']  = I('get.id',0);
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


				$wheredata['userid_int'] = session('userid');
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
			echo json_encode(array("success" => true,
									"code"=> 200,
									"msg" => "success",
									"obj"=> $result1,
									"map"=> null,
									"list"=> null
								   )
							);
		}else{
			exit;
		}
    }

    public function savepage() {
		$m_scene=M('scene');
		$m_scenepage=M('scenepage');
		$datas = json_decode(file_get_contents("php://input"),true);

		$where['pageid_bigint'] = $datas['id'];
		$where['sceneid_bigint'] = $datas['sceneId'];
		$datainfo['pagecurrentnum_int'] = intval($datas['num']);
		$datainfo['properties_text'] = json_encode($datas['properties']);
		$where['userid_int'] = session('userid');
		
		$wheredata['userid_int'] = session('userid');
		$wheredata['pageid_bigint'] = $where['pageid_bigint'];
		$wheredata['sceneid_bigint'] = $where['sceneid_bigint'];
		$m_scenedata=M('scenedata');
		$m_scenedata->where($wheredata)->delete();
		foreach ($datas['elements'] as $key => $val ) 
		{	
			$isinput=$val['type']==5 || $val['type']==501 || $val['type']==502 || $val['type']==503 || $val['isInput']==1;
			/*if(C('JS_VISION')=='3.4'){
				$isinput=$val['isInput'];
			}*/
			
			if( $isinput){  // 501姓名、502手机 、503邮箱、5 文本
				$dataList[] = array('sceneid_bigint'=>$where['sceneid_bigint'],
					'pageid_bigint'=>$where['pageid_bigint'],
					'elementid_int'=>$val['id'],
					'elementtitle_varchar'=>$val['title'],
					'elementtype_int'=>$val['type'],
					'userid_int'=>session('userid'),
					'other_info'=>isset($val['choices']) ? $val['choices']:''
					);
					
				//echo var_export($dataList,true);
				$datas['elements'][$key]['content']=strpos($val['content'],'eqs/link?id=')!==false ? str_replace('eqs/link?id=','?c=scene&a=link&id=',$val['content']):	$val['content'];			
		 
			}else{
				//if(C('IS_CTRL_LIUYUAN')){
					if($val['type']=="L"){
						$dataList[] = array('sceneid_bigint'=>$where['sceneid_bigint'],
							'pageid_bigint'=>$where['pageid_bigint'],
							'elementid_int'=>788,
							'elementtitle_varchar'=>'姓名',
							'elementtype_int'=>'501',
							'userid_int'=>session('userid')
							);
						$dataList[] = array('sceneid_bigint'=>$where['sceneid_bigint'],
							'pageid_bigint'=>$where['pageid_bigint'],
							'elementid_int'=>1111,
						'elementtitle_varchar'=>'出席人数', //手机
							'elementtype_int'=>'502',
							'userid_int'=>session('userid')
							);
						$dataList[] = array('sceneid_bigint'=>$where['sceneid_bigint'],
							'pageid_bigint'=>$where['pageid_bigint'],
							'elementid_int'=>140,
							'elementtitle_varchar'=>'留言内容',
							'elementtype_int'=>'5',
							'userid_int'=>session('userid')
							);
					}
				//}
			}
		}
		//\Think\Log::write("插入sceneData表 \n ".var_export($dataList,true)); 
		
		$datainfo['content_text'] = json_encode($datas['elements']);
		$m_scenepage->data($datainfo)->where($where)->save();

		if(count($dataList)>0){
			$aaaa = $m_scenedata->addAll($dataList);
 		}
		
		if(C('JS_VISION')=='3.4'){
			$str=str_replace('\\"','"',$datas['scene']['bgAudio']);	
			
			 
			$datas['scene']['bgAudio']=json_decode($str,true);
			
		 	
			//$bgdatainfo['musicurl_varchar'] = $datas['scene']['bgAudio']['url']? $datas['scene']['bgAudio']['url']:'';			 
			//$bgdatainfo['musictype_int'] = $datas['scene']['bgAudio']['type']? $datas['scene']['bgAudio']['type']:0;
			
		}else{

			//if($datas['scene']['image']['bgAudio']['url']!="")
			//{
				//$bgdatainfo['musicurl_varchar'] = $datas['scene']['image']['bgAudio']['url'];5.0后变化
				$bgdatainfo['musicurl_varchar'] = $datas['scene']['bgAudio']['url'];
				//$bgdatainfo['musictype_int'] = $datas['scene']['image']['bgAudio']['type'];
				$bgdatainfo['musictype_int'] = $datas['scene']['bgAudio']['type'];
			//}else{
			//	$bgdatainfo['musicurl_varchar'] = '';
			//}
		}
		$bgwhere['sceneid_bigint'] = $datas['sceneId'];
		$bgwhere['userid_int'] = session('userid');
		//$bgdatainfo['is_tpl'] = $datas['scene']['isTpl'];
		$bgdatainfo['is_tpl'] = 0;
		$bgdatainfo['updateTime'] = time();  
		
		$m_scene->data($bgdatainfo)->where($where)->save();
		 
		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => "success",
								"obj"=> $result1,
								"map"=> null,
								"list"=> null
							   )
						);
    }

    public function openscene($status) {
		$m_scene=M('Scene');
		$datas = json_decode(file_get_contents("php://input"),true);

		$where['sceneid_bigint'] = I('get.id',0);
		$datainfo['showstatus_int'] = $status;
		$where['userid_int'] = session('userid');
		$m_scene->data($datainfo)->where($where)->save();
		
		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => "success",
								"obj"=> $result1,
								"map"=> null,
								"list"=> null
							   )
						);
    }


    public function usepage() {
		$m_scene=M('scenepagesys');
		$where['pageid_bigint'] = I('get.id',0);
		$m_scene->where($where)->setInc('usecount_int');
		
    }

    public function addpv() {
		$m_scene=M('Scene');
		$where['sceneid_bigint'] = I('get.id',0);
		$m_scene->where($where)->setInc('hitcount_int');
		if(C('SYS_LINK')){
		$m_scene->where($where)->setInc('vi_current_times');
		
		}
    }

    public function savesetting() {
		$m_scene=M('Scene');
		$datas = json_decode(file_get_contents("php://input"),true);
		$hideEqAd=false;
		if(C('JS_VISION')>=3.4){ // "property": "{\"eqAdType\":0,\"hideEqAd\":true}"
			$datainfo['property'] = $datas['property'];
			
			if($datas['property']){
				$str=str_replace('\\"','"',$datas['property']);									
				$datas['property']=json_decode($str,true);				
				$hideEqAd=$datas['property']['hideEqAd']?true:false;
				
			}			 
			
		}else{	
			$hideEqAd=$datas['image']['hideEqAd']?true:false;
			 
		}
		$where['sceneid_bigint'] = $datas['id'];
		//$datainfo=$hideEqAd?deal_xd($datainfo,$datas) :$datainfo;	
		//if($hideEqAd){
		//	$is_payxd=$m_scene->where($where)->getField('is_payxd');	
			   
		//	$datainfo=$is_payxd?deal_xd($datainfo,$datas) :$datainfo;	
		//}		
		$datainfo['loadinglogo'] = $datas['loadingLogo'];

		$datainfo= deal_xd_new($datainfo,$datas);

		
		
		$datainfo['scenename_varchar'] = $datas['name'];
		$datainfo['scenetype_int'] = intval($datas['type']);
		$datainfo['movietype_int'] = intval($datas['pageMode']);
		$datainfo['thumbnail_varchar'] = C('JS_VISION') && C('JS_VISION')=='3.4' ?  $datas['cover']:  $datas['image']['imgSrc'];//$datas['cover']? $datas['cover']:  $datas['image']['imgSrc'];
		$datainfo['desc_varchar'] = $datas['description'];
		$datainfo['eqcode'] =$datas['eqcode'];
		 // $datainfo['property'] = $datas['property'];
		$datainfo['updateTime'] =time();		
		$datainfo['lastpageid'] = $datas['image']['lastPageId'];
		$datainfo['applyPromotion'] = $datas['applyPromotion'];
		$datainfo['accessCode'] = $datas['accessCode'];
		$datainfo['applyTemplate'] = $datas['applyTemplate'];
		$datainfo['price'] = $datas['price'];
		$datainfo['is_show'] = $datas['isShow'];
		$music = json_decode($datas['bgAudio'],true);
		
		
		
		$datainfo['musicurl_varchar'] = $music['url'];
		
		
		$datainfo['tagid_int'] = $datas['tagId'] ? intval($datas['tagId']) :0;
		
		$where['userid_int'] = session('userid');
		

		$m_scene->data($datainfo)->where($where)->save();
		
		echo json_encode(array("success" => true,
								"code"=> 200,
								"msg" => $m_scene."success".$datainfo['scenename_varchar'].'音乐:'.$music['url'],
								"obj"=> $result1,
								"map"=> null,
								"list"=> null
							   )
						);
    }
public function writelog($str)
{
$open=fopen("log.txt","a" );
fwrite($open,$str);
fclose($open);
} 

}



?>
