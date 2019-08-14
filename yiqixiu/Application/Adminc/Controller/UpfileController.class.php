<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
header("Content-Type: text/html;charset=utf-8");
class UpfileController extends BaseController {
  
public function syslist(){
		if(intval(session("userid"))==0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
		$m_upfile = M('upfilesys');
		$where['filetype_int']  = I('get.fileType',0);
		if(I('get.tagId',0)>0){
			$where['tagid_int']  = I('get.tagId',0);
		}
		if(I('get.bizType',0)>0){
			$where['biztype_int']  = I('get.bizType',0);
		}
		$pageshowsize = I('get.pageSize',17);
		if($pageshowsize>40){
			$pageshowsize = 40;
		}
		$m_upfilelist=$m_upfile->where($where)->order('fileid_bigint desc')->page(I('get.pageNo',1),$pageshowsize)->select();
		$m_upfile_count = $m_upfile->where($where) ->count();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$m_upfile_count.',"pageNo":'.I('get.pageNo',1).',"pageSize":'.$pageshowsize.'},"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["fileid_bigint"].',"name":'.json_encode($vo["filename_varchar"]).',"extName":"'.$vo["ext_varchar"].'","fileType":'.$vo["filetype_int"].',"bizType":'.$vo["biztype_int"].',"path":"'.$vo["filesrc_varchar"].'","tmbPath":"'.$vo["filethumbsrc_varchar"].'","createTime":1426209633000,"createUser":"'.$vo["userid_int"].'","sort":0,"size":'.$vo["sizekb_int"].',"status":1},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}
public function lists(){
    $m_upfile = M('tag');
   		$where['biztype_int']  = I('get.bizType',0);
		$pageshowsize = 30;
		$m_upfilelist=$m_upfile->where($where)->order('tagid_int asc')->select();
        print_r($m_upfilelist);
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
}

	public function systag(){
	 
		if(I('get.type')=='bgType'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":13076,"name":"风格","value":"203","type":"bgType","sort":1,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"},{"id":13078,"name":"节日","value":"205","type":"bgType","sort":2,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"},{"id":13075,"name":"企业","value":"202","type":"bgType","sort":3,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"},{"id":13074,"name":"行业","value":"201","type":"bgType","sort":4,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"},{"id":13077,"name":"个人","value":"204","type":"bgType","sort":5,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"}]}';
		}
		elseif(I('get.type')=='tpType'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":13084,"name":"图标","value":"106","type":"tpType","sort":1,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAOVqkAAAX-MAtU0A633.png"},{"id":13085,"name":"动画","value":"107","type":"tpType","sort":2,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqANcAcAAATIr_b2OM515.png"},{"id":13083,"name":"节日","value":"105","type":"tpType","sort":3,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"},{"id":13081,"name":"风格","value":"103","type":"tpType","sort":4,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"},{"id":13080,"name":"企业","value":"102","type":"tpType","sort":5,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"},{"id":13079,"name":"行业","value":"101","type":"tpType","sort":6,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"},{"id":13082,"name":"个人","value":"104","type":"tpType","sort":7,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"},{"id":13082,"name":"背景","value":"1301","type":"tpType","sort":7,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"}]}';
		}
		elseif(I('get.type')=='sqType'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":13084,"name":"图形","value":"8201","type":"sqType","sort":1,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAOVqkAAAX-MAtU0A633.png"},{"id":13085,"name":"文字","value":"8203","type":"sqType","sort":2,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqANcAcAAATIr_b2OM515.png"},{"id":13083,"name":"图标","value":"8202","type":"sqType","sort":3,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"}]}';
		}
		else{
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


	public function systpltag(){
 
		//header('Content-type: text/json');
		$m_upfile = M('tag');
		$where['userid_int']  = 0;
		$where['type_int']  = 88;
		$where['biztype_int']  = I('get.bizType',0);
		$pageshowsize = 30;
		$m_upfilelist=$m_upfile->where($where)->order('tagid_int asc')->select();
		//var_dump($_scene_list);exit;     
		//$this->display();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}
	 
}