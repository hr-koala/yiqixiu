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
	/*	$where['fileid_bigint']=I('get.id');
		$where['filetype_int']=I('get.filetype');
		$_scene = M('upfilesys');
		$bj=$_scene->where($where)->find();
		//print_r($bj);
		$this->assign('user',$bj); 
		$this->assign('fnid',I('get.filetype'));*/
			$m = M('upfilesys'); 	
		if(IS_POST){
			$where['fileid_bigint']=I('post.id');
			$update_arr=I('post.user');
			  
			$update_arr=$this->file_uploadsys($update_arr); 
			
			$m->where($where)->save($update_arr);
			
			  
			 
			$this->success ( '操作成功', '/adminc.php?c=file&a=e&id='.I('post.id')."&filetype=".I("post.fileType") );  //U (  'upfilesys/index' )

		}else{
		
			$where['fileid_bigint']=I('get.id');
			$userinfo=	$m->where($where)->find();
			
			$list=upfilesClass($userinfo['filetype_int']);
			
			$biztypeId=$userinfo['scenetype_int']?intval($userinfo['scenetype_int']):$list[0]['value'];
			
			$slist=M('tag')->where("type_int=".$userinfo['filetype_int']." and biztype_int=".$biztypeId)->order('tagid_int asc')->select();
		   // echo D("")->getLastsql();
			//print_r($slist);
			$this->assign('filetypelist', $list); 
			$this->assign('scene_type_list2', $slist); 
			
			$this->assign('user', $userinfo); 
			$this->assign('filetype_int', $userinfo['filetype_int']); 
			$this->assign('fnid',I('get.filetype'));
			 
			$ui['File_index'] = 'active';
			$this->assign('ui',$ui);
			$this->display();
		}
	}
	
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
			
			$ui['File_index'] = 'active';
        $this->assign('ui',$ui);
			$this->assign('user', $userinfo); 
			$this->display();
	}
	
	
	//用户素材管理
	
		public function userancs() {
		$_scene = M('upfile');
		//$filetype_int = intval(I('get.tagId', 0));
		$where['filetype_int']  = intval(I('get.filetype'));
		if ($scenetype > 0) {
			$where['tagid_int'] = $scenetype;
		}
		
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
			$this -> success('操作成功', '/adminc.php?c=File&a=userancs&filetype='+$_GET['filetype']);
		} else {
			$this -> success('操作成功', '/adminc.php?c=File&a=userancs&filetype='+$_GET['filetype']);
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
		function file_uploadsys($update_arr=array()){
		
		if($_FILES['file']['error']!=0){
			return  $update_arr;	
		}
	 
		$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize = 3145728 ;// 设置附件上传大小
			if($_REQUEST['fileType']==2)
			{
				$upload->exts = array('mp3');// 设置附件上传类型
			$upload->savePath = 'syspic/mp3/'; // 设置附件上传（子）目录
			}
			else
			{
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			   $upload->savePath = 'syspic/pic/'; // 设置附件上传（子）目录
			}
			 
		$upload->rootPath = './Uploads/'; // 设置附件上传根目录
			$upload->subName  = array('date','Ym');
			// 采用时间戳命名
			$upload->saveName = 'uniqid';
			// 采用GUID序列命名
			//$upload->saveName = 'guid'; 
			// 上传文件
			$info = $upload->upload();
			if(!$info) {// 上传错误提示错误信息
			 
				echo $this->error($upload->getError());
				exit;
				//$this->error($upload->getError());
			}else{// 上传成功 获取上传文件信息
			 
				foreach($info as $file){
					$thubimagenew = $file['savepath'].$file['savename'];
				if($_REQUEST['fileType']!=2)
					{
						$image = new \Think\Image(); 
						$thubimage = $file['savepath'].$file['savename'];
						$image->open($upload->rootPath.$thubimage);
						$thubimagenew = str_replace(".".$file['ext'],"_thumb.".$file['ext'],$file['savename']);
						$thubimagenewftp =$thubimagenew;
						$thubimagenew =  $file['savepath'].$thubimagenew;
						//echo $thubimagenew; exit;
						// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
						if(I('get.fileType',0)==0)
						{
							$image->thumb(80, 126)->save($upload->rootPath.$thubimagenew);
						}
						else
						{
							$image->thumb(80, 80)->save($upload->rootPath.$thubimagenew);
						}
					}
					$sizeint = intval($file['size']/1024);
					 
					
				 
					// 取得成功上传的文件信息
					// 保存当前数据对象

					$update_arr['ext_varchar'] = strtoupper($file['ext']);
				 	$update_arr['filename_varchar'] = $update_arr['filename_varchar']?$update_arr['filename_varchar']:$file['name'];
				//	$data['filetype_int'] = I('post.fileType',0);
				//	$update_arr['biztype_int'] = I('post.bizType',0);
					$update_arr['userid_int'] = 0;
					$update_arr['filesrc_varchar'] = $file['savepath'].$file['savename'];
					$update_arr['sizekb_int'] = $sizeint;
					 if($_REQUEST['fileType']!=2){
						$update_arr['filethumbsrc_varchar'] = $thubimagenew;
					}
					 
				}
			}
		return $update_arr;
			
	}
 
}