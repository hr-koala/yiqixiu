<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class SceneController extends BaseController {
	public function index() {
		$_scene = M('scene');
		$scenetype = $_REQUEST['tagId'] ? intval($_REQUEST['tagId']):0;  //intval(I('get.tagId', 0));
		if ($scenetype > 0) {
			$where['tagid_int'] = $scenetype;
		}
		$fnid = $_REQUEST['fnid'] ? intval($_REQUEST['fnid']):0; 
		if ($fnid > 0) {
			$where['biztype_int'] = $fnid;
		}
		$field=I('post.field','');
		$keyword=I('post.keyword','');
		if($field && $keyword){
			$where[$field]  = array('like','%'.$keyword.'%');
			$this->assign('field',$field);  
			$this->assign('keyword',$keyword);  
		}
		
		
		$user_id = intval(I('post.user_id')); 
		if($user_id){
			$where['userid_int']  = $user_id;
			
			$ui['scene_anli'] = 'active';	$ui['anli_index'] ='active';
		}else{
			if(I('get.flag')=='useranli'){				 
				 $where['is_tpl']  = 0;			
				
			}elseif(in_array(I("get.flag"),array("template","promotion"))){
				if(I("get.flag")=="template"){ $where['applyTemplate']=1;}
				else{ $where['applyPromotion']=array('in',array(-1,1,2));}
			}
			else{
				$where['is_tpl']  = 1;	
				$ui['scene_index'] = 'active';			 
			}
			if( in_array(I("get.flag"),array("template","promotion","useranli"))){
				$ui['anli_index'] ='active';
				$ui['scene_anli'] = 'active';
			}
			
		}
		$applyPromotion = $_REQUEST['applyPromotion'] ? intval($_REQUEST['applyPromotion']):0; 
		$applyTemplate = $_REQUEST['applyTemplate'] ? intval($_REQUEST['applyTemplate']):0; 
		
		if ($applyPromotion !=0) {
			$where['applyPromotion'] = $applyPromotion;
			$this->assign('applyPromotion',$applyPromotion);  
		}
		if ($applyTemplate !=0) {
			$where['applyTemplate'] = $applyTemplate;
			$this->assign('applyTemplate',$applyTemplate);  
		}
		
		
		
		$order='sceneid_bigint';
		if(I('post.order')){
			$order=I('post.order');
		}
		
		
		$count = $_scene -> where($where) -> count();
		$p = getpage($count, 10);
		$list = $_scene -> where($where) -> order('sceneid_bigint desc') -> limit($p -> firstRow, $p -> listRows) -> select();

		$this->assign('ui',$ui); 
	$this -> assign('fnid', $fnid);
	
		$this -> assign('select', $list);
		$this -> assign('page', $p -> show());
		$this -> assign('flag', I('get.flag', 'sys'));


		$list=M('cate')->where("type='scene_type'")->order('sort asc,id asc')->select();
		
		$biztypeId=$userinfo['scenetype_int']?intval($userinfo['scenetype_int']):$list[0]['value'];
		$slist=M('tag')->where("type_int=2 and biztype_int=".$biztypeId)->order('tagid_int asc')->select();
		
		$this->assign('scene_type_list', $list); 
		$this->assign('scene_type_list2', $slist); 


		$this -> display($display);
		
	}
	
	
	public function lists() {
		$_scene = M('scene');
		//$scenetype = intval(I('get.tagId', 0));
		$where['scenetype_int']  = intval(I('get.fnid'));
		if ($scenetype > 0) {
			$where['tagid_int'] = $scenetype;
		}
		if (I('get.flag') == 'useranli') {
			$where['userid_int'] = array('gt', 0);
		} else {
			$where['userid_int'] = 0;

		}
		$count = $_scene -> where($where) -> count();
		$p = getpage($count, 10);
		$list = $_scene -> where($where) -> order('sceneid_bigint  desc') -> limit($p -> firstRow, $p -> listRows) -> select();

		$ui['scene_index'] = 'active';
        $this->assign('ui',$ui);
		$this -> assign('select', $list);
		$this -> assign('page', $p -> show());
		$this->assign('fnid',I('get.fnid')); 
		$this -> assign('flag', I('get.flag', 'sys'));
		$this -> display('index');
	}
	
	
	
	
	
	
	

	public function usercpsystem() {
		if (IS_GET) {

			$returnInfo = D("Scene") -> usercpsystem();
			$this -> success('操作成功',U('scene/index'));
		}
	}

	public function e() {
		$m = M('scene');
		if (IS_POST) {
			$where['sceneid_bigint'] = I('post.id');
			$update_arr = I('post.user');
			if(isset($update_arr['vi_timeout']) && $update_arr['vi_timeout']){
				$update_arr['vi_timeout']=str_replace("\\/", "/", json_encode($update_arr['vi_timeout']));
			}
			$update_arr = array_filter($update_arr);
			//if($update_arr['scenetype_int']<0){unset $update_arr['scenetype_int'] }
	
			$m -> where($where) -> save($update_arr);
			if (I('get.flag') == 'useranli') {
			$this -> success('操作成功', U('/Scene/index/flag/useranli'));
		} else {
			$this -> success('操作成功',U('scene/index'));
			
		}
			
			//$this -> success('操作成功', U ('scene/index'));

		} else {
			
			$where['sceneid_bigint'] = I('get.id');
			$userinfo = $m -> where($where) -> find();
			if(isset($userinfo['vi_timeout']) && $userinfo['vi_timeout']){
				$arr=json_decode($userinfo['vi_timeout']);
				
				$userinfo['vi_timeout']=object_array($arr);
			}
			$this -> assign('user', $userinfo);
			
			$movietypelist=getMovietypeList();
			$this->assign('movietypelist', $movietypelist); 
			
			$list=M('cate')->where("type='scene_type'")->order('sort asc,id asc')->select();
			
			$biztypeId=$userinfo['scenetype_int']?intval($userinfo['scenetype_int']):$list[0]['value'];
			$slist=M('tag')->where("type_int=2 and biztype_int=".$biztypeId)->order('tagid_int asc')->select();
			
			$this->assign('scene_type_list', $list); 
			$this->assign('scene_type_list2', $slist); 
			if($userinfo['is_tpl']==1){
				$ui['scene_index'] = 'active';
			}else{
				$ui['scene_anli'] = 'active';
				}
            $this->assign('ui',$ui);
			$this -> display();
		}
	}

	function del() {
		if (session('adminRole') == 2) {
			$this -> error('您没有相关权限', U('scene/index'));
		}
		if(I('get.id')<1411){
			$this -> error('系统场景，禁止删除!', U('/Scene/index/flag/useranli'));
		}
		$m = M('scene');
		$m -> where('sceneid_bigint=' . $_REQUEST['id']) -> delete();
		if (I('get.flag') == 'useranli') {
			$this -> success('操作成功', U('/Scene/index/flag/useranli'));
		} else {
			$this -> success('操作成功',U('scene/index'));
		}
	}

public function user_anli(){
	if (IS_GET){
		$data=I('get.');
		$_anli = M('scene');
		$where['sceneid_bigint']=I('get.id');
		if(I('get.no')>0){
			$update_arr['showstatus_int']=1;
			$update_arr['showstatus_int']=0;
			$_anli -> where($where) -> save($update_arr);
		}elseif(I('get.no')<1){
		$update_arr['showstatus_int']=1;
		
			$_anli -> where($where) -> save($update_arr);	
		}
		 $this -> success('操作成功', U('/Scene/index/flag/useranli'));
	}
	
			}
 	public function is_showstatus(){
		$m = M('scene'); 
		$where['sceneid_bigint']=I('get.id');
		$update_arr['showstatus_int']= I('get.no')? 0: 1;
		//$update_arr['is_public']= I('get.no')? 0: 1;
		$m->where($where)->save($update_arr);
		
		
		$this->success ( '操作成功', '/adminc.php?c=scene&flag=useranli' ); 
	}
	public function is_public(){
		$m = M('scene'); 
		$where['sceneid_bigint']=I('get.id');
		//$update_arr['showstatus_int']= I('get.no')? 2: 1;
		$update_arr['is_public']= I('get.no')? 0: 1;
		$m->where($where)->save($update_arr);
		
		
		$this->success ( '操作成功', '/adminc.php?c=scene&flag=useranli' ); 
	}	
	public function shenhe(){
		$m = M('scene'); 
		$where['sceneid_bigint']=I('get.id');
		$update_arr['shenhe']= I('get.no')? 0: 1;
		
		$m->where($where)->save($update_arr);
		
		
		$this->success ( '操作成功', '/adminc.php?c=scene&flag=useranli' ); 
	}
	public function shenheOk(){
		$m = M('scene'); 
		$res=array('status'=>1,"info"=>'');
			$where['sceneid_bigint']=I('post.id');
			$update_arr['applyPromotion']= intval(I('post.applystatus'));
		$m->where($where)->save($update_arr);
		 
		 echo json_encode($res);	
	}
	
public function is_anli(){
	if (IS_GET){
		$data=I('get.');
		$_anli = M('scene');
		$where['sceneid_bigint']=I('get.id');
		if(I('get.no')>0){
			
			$update_arr['showstatus_int']=0;
			$_anli -> where($where) -> save($update_arr);
		}elseif(I('get.no')<1){
		 $update_arr['applyPromotion']=1;
		$update_arr['showstatus_int']=1;
			$_anli -> where($where) -> save($update_arr);	
		}
		 $this -> success('操作成功',U('/Scene/index/flag/useranli'));
	}
	
			}
			
 public function Type(){
				   $tag=M('tag'); 
				   $where['biztype_int']=I('get.biztype'); 
				   $where['type_int']=2; 
				   $where['userid_int']=0; 
				   $tagid=$tag->where($where)->select(); 
				   foreach ($tagid as $tagids) { 
				   echo '<option value="'.$tagids['tagid_int'].'">'.$tagids['name_varchar'].'</option>';
		} 
	}
	
	public function getSceneTag(){
		$res=array('status'=>0,"info"=>'');
		$biztypeId=intval(I('get.biztypeId'));
		$type_int=intval(I('get.type_int',2));
		$slist=M('tag')->where("type_int=$type_int and biztype_int=".$biztypeId)->order('tagid_int asc')->select();
		
		$option='';
		foreach($slist as $v){
			$option.='<option value="'.$v['tagid_int'].'">'.$v['name_varchar'].'</option>';
		}
		$res['status']=1;
		$res['info']=$option;
		
		echo json_encode($res);	
	}
	
		public function hideeqad(){
		$m = M('scene'); 
		$where['sceneid_bigint']=I('get.id');
		$update_arr['hideeqad']= I('get.no')? 1: 0;
		
		$property= $m->where($where)->getField("property");
		
		$update_arr['property']= str_replace('"hideEqAd":false','"hideEqAd":true',$property);
		$m->where($where)->save($update_arr);
		 
		
		 $this->success ( '操作成功', '/adminc.php?c=scene&flag=useranli' ); 
	}
}
