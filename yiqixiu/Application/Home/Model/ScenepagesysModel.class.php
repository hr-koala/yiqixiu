<?php

namespace Home\Model;
use Think\Model;
class ScenepagesysModel extends Model {

    public function addpagesys() {
		$_scenepage = M('scenepagesys');
			$_scene = M('scene');
			$where['pageid_bigint']  = I('get.id',0);
			$iscopy  = I('get.copy',"false");
		   $getid = I('get.id',0);
		 
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
			$datainfo['tagid_int'] = $_scene_list[0]['tagid_int'] ;
			$datainfo['tagids_int'] = $_scene_list[0]['tagids_int'] ;
			$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
			$datainfo['biztype_int'] = $_scene_list[0]['biztype_int'];
			if($iscopy=="true")
			{
				$datainfo['content_text'] = $_scene_list[0]['content_text'];
				 $datainfo['properties_text'] =  $_scene_list[0]['properties_text'];
				$datainfo['pagename_varchar'] = $_scene_list[0]['pagename_varchar']? '副本-'.$_scene_list[0]['pagename_varchar']: '副本-'.'第'.$pagenumY.'页';
					$datainfo['thumbsrc_varchar'] =  $_scene_list[0]['thumbsrc_varchar'];
			}
			else
			{  $datainfo['pagename_varchar'] = '新增页面'.$datainfo['pagecurrentnum_int'];
				$datainfo['content_text'] = "[]";
				 $datainfo['properties_text'] = 'null';
			}
				$datainfo['properties_text'] = 'null';
			 $datainfo['userid_int'] = session('userid');
			$result = $_scenepage->add($datainfo);
			if($result){
				$where_plist="sceneid_bigint='".$_scene_list[0]['sceneid_bigint']."' AND pageid_bigint<>'$result' AND pagecurrentnum_int>".$pagenumY." " ;
				  
					
				$photoList=M('scenepage')->field('pagecurrentnum_int,pageid_bigint')->where($where_plist)->order('pagecurrentnum_int asc')->select();
				foreach($photoList as $k=> $row){
					$sort=$row['pagecurrentnum_int']+1;
					M('scenepage')->where("pageid_bigint={$row[pageid_bigint]}")->save(array('pagecurrentnum_int'=>$sort)); 					
					 
				}	 			
					
			}
			
			$where2['sceneid_bigint']  = $_scene_list[0]['sceneid_bigint'];
			// if(intval(session('userid'))!=1)
			// {
				// $where2['userid_int']  = intval(session('userid'));
			// }
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
						"properties": null,
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

		
		
		// $_scenepage = M('scenepagesys');
		// $_scene = M('scene');
		// $where['pageid_bigint']  = I('get.id',0);
		// $iscopy  = I('get.copy',"false");
		 
		// $crur_pageInfo=$_scenepage->where($where)->find();
		 
		// if(!$crur_pageInfo)
		// {
			// header('HTTP/1.1 403 Unauthorized');
			// echo json_encode(array("success" => false,"code"=> 403,"msg" => "false","obj"=> null,"map"=> null,"list"=> null));
			// exit;
		// }
		// $datainfo['scenecode_varchar'] = $crur_pageInfo['scenecode_varchar'];
		// $datainfo['sceneid_bigint'] = $crur_pageInfo['sceneid_bigint'];
		// $datainfo['pagecurrentnum_int'] = $crur_pageInfo['pagecurrentnum_int']+1;
		// $datainfo['tagid_int'] = $crur_pageInfo['tagid_int'] ;
		// $datainfo['tagids_int'] = $crur_pageInfo['tagids_int'] ;
		
		
		// $datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		// $datainfo['biztype_int'] = $crur_pageInfo['biztype_int'];
		// if($iscopy=="true")
		// {
			// $datainfo['content_text'] = $crur_pageInfo['content_text'];
			// $datainfo['pagename_varchar'] = $crur_pageInfo['pagename_varchar'].'-副本';
		// }
		// else
		// { 
			// $datainfo['pagename_varchar'] = '新增页面'.$datainfo['pagecurrentnum_int'];
			// $datainfo['content_text'] = "[]";
		// }
		// $datainfo['properties_text'] = 'null';
		// $datainfo['userid_int'] = session('userid');
		// $result = $_scenepage->add($datainfo);
		//echo  'add'. D()->getlastsql() ."<br>";
		// $where2['sceneid_bigint']  = $crur_pageInfo['sceneid_bigint'];
		// if(intval(session('userid'))!=1)
		// {
			// $where2['userid_int']  = intval(session('userid'));
		// }
		// $_scene_list2=$_scene->where($where2)->select();     
		//echo D()->getlastsql() ."<br>";
		// $jsonstr = '{
					// "success": true,
					// "code": 200,
					// "msg": "success",
					// "obj": {
						// "id": '.$result.',
						// "sceneId": '.$crur_pageInfo['sceneid_bigint'].',
						// "num": '.($crur_pageInfo['pagecurrentnum_int']+1).',
						// "name": null,
						// "properties": null,
						// "elements": null,
						// "scene": {
							// "id": '.$_scene_list2[0]['sceneid_bigint'].',
							// "name": '.json_encode($_scene_list2[0]['scenename_varchar']).',
							// "createUser": "'.$_scene_list2[0]['userid_int'].'",
							// "createTime": 1425998747000,
							// "type": '.$_scene_list2[0]['scenetype_int'].',
							// "pageMode": '.$_scene_list2[0]['movietype_int'].',
							// "image": {
								// "imgSrc": "'.$_scene_list2[0]['thumbnail_varchar'].'",
								// "isAdvancedUser": false
							// },
							// "isTpl": 0,
							// "isPromotion": 0,
							// "status": '.$_scene_list2[0]['showstatus_int'].',
							// "openLimit": 0,
							// "submitLimit": 0,
							// "startDate": null,
							// "endDate": null,
							// "accessCode": null,
							// "thirdCode": null,
							// "updateTime": 1426039827000,
							// "publishTime": 1426039827000,
							// "applyTemplate": 0,
							// "applyPromotion": 0,
							// "sourceId": null,
							// "code": "'.$_scene_list2[0]['scenecode_varchar'].'",
							// "description": '.json_encode($_scene_list2[0]['desc_varchar']).',
							// "sort": 0,
							// "pageCount": 0,
							// "dataCount": 0,
							// "showCount": 0,
							// "userLoginName": null,
							// "userName": null
						// }
					// },
					// "map": null,
					// "list": null
				// }';
		// echo $jsonstr;
    }
  
	public function savepagesyso(){
		$m_scene=M('scene');
		$m_scenepage=M('scenepagesys');
		$datas = json_decode(file_get_contents("php://input"),true);

		$where['pageid_bigint'] = $datas['id'];
		$where['biztype_int'] = $datas['sceneId'];
		$datainfo['pagecurrentnum_int'] = intval($datas['num']);
		 $datainfo['properties_text'] = json_encode($datas['properties']);
		//$where['userid_int'] = session('userid');
		
		//$wheredata['userid_int'] = session('userid');
		$wheredata['pageid_bigint'] = $where['pageid_bigint'];
		$wheredata['sceneid_bigint'] = $where['biztype_int'];
		$m_scenedata=M('scenedata');
		$m_scenedata->where($wheredata)->delete();
		foreach ($datas['elements'] as $key => $val ) 
		{	
			
			if($val['type']==5 || $val['type']==501 || $val['type']==502 || $val['type']==503 ){  // 501姓名、502手机 、503邮箱、5 文本
				$dataList[] = array('sceneid_bigint'=>$where['biztype_int'],
					'pageid_bigint'=>$where['pageid_bigint'],
					'elementid_int'=>$val['id'],
					'elementtitle_varchar'=>$val['title'],
					'elementtype_int'=>$val['type'],
					'userid_int'=>0
					);
				$datas['elements'][$key]['content']=strpos($val['content'],'eqs/link?id=')!==false ? str_replace('eqs/link?id=','?c=scene&a=link&id=',$val['content']):	$val['content'];			
				 
			}

		}
		$datainfo['content_text'] = json_encode($datas['elements']);
		$datainfo['thumbsrc_varchar'] = $datas['properties']['thumbSrc'];
		//print_r($datainfo);die();
		
		$m_scenepage->data($datainfo)->where($where)->save();
		 
		if(count($dataList)>0){
			$aaaa = $m_scenedata->addAll($dataList);
		}

		if($datas['scene']['image']['bgAudio']['url']!="")
		{
			$bgdatainfo['musicurl_varchar'] = $datas['scene']['image']['bgAudio']['url'];
			//var_dump($bgdatainfo['musicurl_varchar']);exit;
			$bgdatainfo['musictype_int'] = $datas['scene']['image']['bgAudio']['type'];
		}else{
			$bgdatainfo['musicurl_varchar'] = '';
		}
		$bgwhere['sceneid_bigint'] = $datas['sceneId'];
		//$bgwhere['userid_int'] = session('userid');
		
		
		
		$m_scene->data($bgdatainfo)->where($where)->save();
		//var_dump($m_scene);exit;
		echo json_encode(array("success" => true,
			"code"=> 200,
			"msg" => "success",
			"obj"=> $result1,
			"map"=> null,
			"list"=> null
			)
				);
	}
	public function savepagesys() {
		$m_scene=M('scene');
		$m_scenepage=M('scenepage');
		$datas = json_decode(file_get_contents("php://input"),true);
		//var_dump($datas);die;
		$where['pageid_bigint'] = $datas['id'];
		$where['sceneid_bigint'] = $datas['sceneId'];
		$datainfo['pagecurrentnum_int'] = intval($datas['num']);
		$datainfo['properties_text'] = json_encode($datas['properties']);
		$datainfo['is_tpl'] = $datas['isTpl'];
		$datainfo['thumbsrc_varchar'] = $datas['properties']['thumbSrc'];
		$datainfo['updatetime'] = date('y-m-d H:i:s',time());
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

    

}

?>
