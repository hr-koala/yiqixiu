<?php
namespace Adminc\Model;
use Think\Model;
class SceneModel extends Model {

    public function usercpsystem() {
		$m_scene=M('Scene');
		$m_scenepage=M('scenepage');
		$m_scenedata=M('scenedata');
		$wheresysscene['sceneid_bigint']  = I('get.id',0);
		$_scene_sysinfo=$m_scene->where($wheresysscene)->select();
//print_r($_scene_sysinfo);exit;
		$datainfo['scenecode_varchar'] = 's'.(date('y',time())-9).date('m',time()).date('d',time()).randorderno(10,-1);
		$datainfo['scenename_varchar'] = $_scene_sysinfo[0]['scenename_varchar'];
		$datainfo['movietype_int'] = $_scene_sysinfo[0]['movietype_int'];
		$datainfo['scenetype_int'] = $_scene_sysinfo[0]['scenetype_int'];
		$datainfo['ip_varchar'] = get_client_ip();
		$datainfo['thumbnail_varchar'] = $_scene_sysinfo[0]['thumbnail_varchar'];
		$datainfo['musicurl_varchar'] = $_scene_sysinfo[0]['musicurl_varchar'];
		$datainfo['musictype_int'] = $_scene_sysinfo[0]['musictype_int'];
		$datainfo['userid_int'] = 0;
		$datainfo['fromsceneid_bigint'] = $wheresysscene['sceneid_bigint'];
			$datainfo['is_tpl'] = 1;
		$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
		
		$result1 = $m_scene->add($datainfo);
		if($result1){
			$m_scene->where($wheresysscene)->setInc('usecount_int');
			$wheresyspage['sceneid_bigint']  = I('get.id',0);
			$_scene_syspageinfo=$m_scenepage->where($wheresyspage)->select();
			foreach($_scene_syspageinfo as $vo){
				$datainfo2['scenecode_varchar'] = $datainfo['scenecode_varchar'];
				$datainfo2['sceneid_bigint'] = $result1;
				$datainfo2['content_text'] = $vo['content_text'];
				$datainfo2['properties_text'] = 'null';
				$datainfo2['pagecurrentnum_int'] = $vo['pagecurrentnum_int'];
				$datainfo2['userid_int'] = 0;
				$datainfo2['createtime_time'] = date('y-m-d H:i:s',time());
				$result2 = $m_scenepage->add($datainfo2);


				$wheredata['userid_int'] = 0;
				$wheredata['sceneid_bigint'] = $vo['sceneid_bigint'];
				$wheredata['pageid_bigint'] = $vo['pageid_bigint'];
				$_scenedatasys_list = $m_scenedata->where($wheredata)->select();

				foreach($_scenedatasys_list as $vo2){
					$dataList[] = array('sceneid_bigint'=>$result1,
						'pageid_bigint'=>$result2,
						'elementid_int'=>$vo2['elementid_int'],
						'elementtitle_varchar'=>$vo2['elementtitle_varchar'],
						'elementtype_int'=>$vo2['elementtype_int'],
						'userid_int'=>0
					);
				}

			}
			if(count($dataList)>0){
				$m_scenedata->addAll($dataList);
			}
 
		}else{
				$this->error('出错啦','?c=scene');
		}
    }

 

}



?>
