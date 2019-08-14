<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class FileController extends BaseController {
	public function index() {
		$_scene = M('upfilesys');
		//$filetype_int = intval(I('get.tagId', 0));
		$where['filetype_int']  = intval(I('get.filetype'));
		if ($scenetype > 0) {
			$where['tagid_int'] = $scenetype;
		}
		if (I('get.flag') == 'useranli') {
			$where['userid_int'] = array('gt', 0);
		} else {
			$where['userid_int'] = 0;

		}
		$count = $_scene -> where($where) -> count();
		$p = getpage($count, 36);
		$list = $_scene -> where($where) -> order('fileid_bigint desc') -> limit($p -> firstRow, $p -> listRows) -> select();
$ui['File_index'] = 'active';
$this->assign('ui',$ui);

		$this -> assign('select', $list);
		$this->assign('filetype',I('get.filetype')); 
		$this -> assign('page', $p -> show());
		$this -> assign('flag', I('get.flag', 'sys'));
		$this -> display($display);
	}
	
		public function lists() {
		$_scene = M('upfilesys');
		//$scenetype = intval(I('get.tagId', 0));
		$where['filetype_int']  = intval(I('get.filetype'));
		$where['biztype_int']  = intval(I('get.fnid'));
		if ($scenetype > 0) {
			$where['tagid_int'] = $biztype;
		}
		if (I('get.flag') == 'useranli') {
			$where['userid_int'] = array('gt', 0);
		} else {
			$where['userid_int'] = 0;

		}
		$count = $_scene -> where($where) -> count();
		$p = getpage($count, 36);
		$list = $_scene -> where($where) -> order('fileid_bigint  desc') -> limit($p -> firstRow, $p -> listRows) -> select();

		$ui['File_index'] = 'active';
        $this->assign('ui',$ui);
		$this -> assign('select', $list);
		$this -> assign('page', $p -> show());
		$this->assign('filetype',I('get.filetype')); 
		$this->assign('fnid',I('get.fnid')); 
		$this -> assign('flag', I('get.flag', 'sys'));
		$this -> display('index');
	}
	



	public function e(){
		$file = M('upfilesys'); 
		if(IS_POST){
		    $upload = new \Think\Upload();//
		    $upload->allowExts =  array('jpg', 'gif', 'png', 'jpeg','mp3');
		    $upload->savePath ='/syspic/';
		    $info   =   $upload->upload();  
			if(I('get.filetype')==2){$data['biztype_int']=1;}  
   			$data['filethumbsrc_varchar']=$info['photo2']['savepath'].$info['photo2']['savename'];
			$data['filename_varchar']=$info['photo2']['name']; //
			$data['ext_varchar']=$info['photo2']['ext']; 
			$data['filetype_int']=I('get.filetype');
            $data['biztype_int']=I('POST.dtagid');
            $data['tagid_int']=I('POST.tagid');
			$data['filesrc_varchar']=$info['photo2']['savepath'].$info['photo2']['savename'];
			$data['create_time']=date('Y-m-d H:i:s',time());
			if(!$info) {// 上传错误提示错误信息        
			$this->error($upload->getError());  
			    }else{// 上传成功     
			$file->add($data);  
			$this->success('上传成功',U('File/index',array('filetype'=>$_GET['filetype'])));
			exit();
			//$this->success('上传成功！');    
			}
			}else{
			  $where['fileid_bigint']=I('get.id');
			 $where['filetype_int']=I('get.filetype');
			 $userinfo=$file->where($where)->select();
				}
			$filetypelist=array('背景','图标','音乐');
			$this->assign('fnid',I('get.filetype')); 
			// $this->assign('filetypelist',$filetypelist);
			$this->assign('user', $userinfo); 
			$this->display('e');
	}	
	
/*
	public function e(){
		$where['fileid_bigint']=I('get.id');
		$where['filetype_int']=I('get.filetype');
		$_scene = M('upfilesys');
		$bj=$_scene->where($where)->find();
		//print_r($bj);
		$this->assign('user',$bj); 
		$this->assign('fnid',I('get.filetype')); 
		$ui['File_index'] = 'active';
        $this->assign('ui',$ui);
		$this->display();
	}
	*/
	 public function del(){
	 		if (session('adminRole') == 2) {
			$this -> error('您没有相关权限', U('File/index',array('filetype'=>$filetype)));
		}
			$_scene = M('upfilesys');
		 $_scene -> where('fileid_bigint=' . $_REQUEST['id']) -> delete();
		if (I('get.flag') == 'useranli') {
			$this->success('操作成功',U('File/index',array('filetype'=>$_GET['filetype'])));
			//$this -> success('操作成功', '/adminc.php?c=File&File=useranli');
		} else {
			$this->success('操作成功',U('File/index',array('filetype'=>$_GET['filetype'])));
		}
       
	}
	
	/*
		public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$fidwhere['fid']=intval($where['id']);
			D(MODULE_NAME)->where($fidwhere)->delete();
			$this->success('操作成功',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index',array('fid'=>$_GET['fid'])));
		}
	}
	*/
	
	
	
	
	public function add(){
		$file = M('upfilesys'); 
		if(IS_POST){
		    $upload = new \Think\Upload();//
		    $upload->allowExts =  array('jpg', 'gif', 'png', 'jpeg','mp3');
		    $upload->savePath ='/syspic/';
		    $info   =   $upload->upload();  
			if(I('get.filetype')==2){$data['biztype_int']=1;}  
   			$data['filethumbsrc_varchar']=$info['photo2']['savepath'].$info['photo2']['savename'];
			$data['filename_varchar']=$info['photo2']['name']; //
			$data['ext_varchar']=$info['photo2']['ext']; 
			$data['filetype_int']=I('get.filetype');
            $data['biztype_int']=I('POST.dtagid');
            $data['tagid_int']=I('POST.tagid');
			$data['filesrc_varchar']=$info['photo2']['savepath'].$info['photo2']['savename'];
			$data['create_time']=date('Y-m-d H:i:s',time());
			if(!$info) {// 上传错误提示错误信息        
			$this->error($upload->getError());  
			    }else{// 上传成功     
			$file->add($data);  
			$this->success('上传成功',U('File/index',array('filetype'=>$_GET['filetype'])));
			exit();
			//$this->success('上传成功！');    
			}
			}else{
			  $where['sceneid_bigint']=I('get.id');
			 $where['filetype_int']=I('get.filetype');
			 $userinfo=$file->where($where)->select();
				}
			$filetypelist=array('背景','图标','音乐');
			$this->assign('fnid',I('get.filetype')); 
			// $this->assign('filetypelist',$filetypelist);
			$this->assign('user', $userinfo); 
			$this->display();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//用户素材管理
	
		public function userancs() {
		$_scene = M('upfile');
		//$filetype_int = intval(I('get.tagId', 0));
		$where['filetype_int']  = intval(I('get.filetype'));
		/*if ($scenetype > 0) {
			$where['tagid_int'] = $scenetype;
		}*/
		
		$count = $_scene -> where($where) -> count();
		$p = getpage($count, 36);
		$list = $_scene -> where($where) -> order('fileid_bigint desc') -> limit($p -> firstRow, $p -> listRows) -> select();
        $ui['userancs'] = 'active';
        $this->assign('ui',$ui);
		$this -> assign('select', $list);
		$this -> assign('userid_int', $userid_int);
		$this->assign('filetype',I('get.filetype')); 
		$this -> assign('page', $p -> show());
		$this -> assign('flag', I('get.flag', 'sys'));
		$this -> display('index');
	}
	
	
		public function userancs_e(){
		$where['fileid_bigint']=I('get.id');
		$where['filetype_int']=I('get.filetype');
		$_scene = M('upfile');
		$bj=$_scene->where($where)->find();
		//print_r($bj);
		$this->assign('user',$bj); 
		$this->assign('fnid',I('get.filetype')); 
		$ui['userancs'] = 'active';
        $this->assign('ui',$ui);
		$this->display('e');
	}
	

	
	
		 public function userancs_del(){
	 		if (session('adminRole') == 2) {
			$this -> error('您没有相关权限', '/adminc.php?c=File');
		}
			$_scene = M('upfile');
		 $_scene -> where('fileid_bigint=' . $_REQUEST['id']) -> delete();
		if (I('get.flag') == 'useranli') {
			$this -> success('操作失败', '/adminc.php?c=File&File=useranli');
		} else {
			$this->success('操作成功',U('/File/userancs/filetype/$_GET.filetype'));
		}
       
	}
	
	
	
	

	 public function Type(){
				   $tag=M('tag'); 
				   $where['biztype_int']=I('get.biztype'); 
				   //$where['type_int']=2; 
				   $where['userid_int']=0; 
				   $tagid=$tag->where($where)->select(); 
				   foreach ($tagid as $tagids) { 
				   echo '<option value="'.$tagids['tagid_int'].'">'.$tagids['name_varchar'].'</option>';
		} 
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		public function systag(){
		if(I('get.type')=='bgType'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{
				"id":13076,"name":"风格","value":"203","type":"bgType","sort":1,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"
				},{
				"id":13078,"name":"节日","value":"205","type":"bgType","sort":2,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"
				},{
				"id":13075,"name":"企业","value":"202","type":"bgType","sort":3,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"
				},{
				"id":13074,"name":"行业","value":"201","type":"bgType","sort":4,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"
				},{
				"id":13077,"name":"个人","value":"204","type":"bgType","sort":5,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"
				}]}';
		}
		elseif(I('get.type')=='tpType'){
			$jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{
				"id":13084,"name":"图标","value":"106","type":"tpType","sort":1,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAOVqkAAAX-MAtU0A633.png"
				},{
				"id":13085,"name":"动画","value":"107","type":"tpType","sort":2,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqANcAcAAATIr_b2OM515.png"
				},{
				"id":13083,"name":"节日","value":"105","type":"tpType","sort":3,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"
				},{
				"id":13081,"name":"风格","value":"103","type":"tpType","sort":4,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"
				},{
				"id":13080,"name":"企业","value":"102","type":"tpType","sort":5,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"
				},{
				"id":13079,"name":"行业","value":"101","type":"tpType","sort":6,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"
				},{
				"id":13082,"name":"个人","value":"104","type":"tpType","sort":7,"status":1,"remark":"group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"
				}]}';
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
	
 
}