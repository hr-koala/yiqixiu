<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class TagController extends BaseController {
	protected function _initialize(){
		$ui['cate_index'] = 'active';
		$ui['tag_index'] = 'active';
		$this->assign('ui',$ui);  
	}
    public function index(){
		if(!defined('VIRIFY')){
			aboutaa();
		}
 
		$m = M('tag');      
		$biztype=I('get.biztype');
		$where=array('biztype_int'=>$biztype); 
		
		$type=I('get.type','bgType');
		
		$where['type_int']=getTpyeNameToId($type);
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('create_time desc')->limit($p->firstRow, $p->listRows)->select(); 
		
		//echo D()->getlastsql();
		$bigTypeInfo=M('cate')->where(array('type'=>$type,'value'=>$biztype))->find();
	 
		$this->assign('bigTypeInfo', $bigTypeInfo); 
	   
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		 $this->assign('type', $type);  
		 $this->assign('biztype', $biztype);  
		
		$this->display();
    }
	public function del(){
		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
		$m = M('tag');     
			$type= I('get.type'); 
			$biztype_int=I('get.biztype_int'); 
		$m->where('tagid_int='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=tag&type='.$type.'&biztype='.$biztype_int );  //U (  'tag/index' )
	
	}
	public function add(){
		$m = M('tag'); 
		
		if(IS_POST){
			$update_arr=I('post.user');
		 
			 
			$update_arr['create_time'] =date('Y-m-d H:i' ,time());
			
			$type= I('post.filetype');
			$update_arr['type_int']=getTpyeNameToId($type);
			
			$new_id= $m->add($update_arr); 
			  
			$this->success ( '操作成功', '/adminc.php?c=tag&type='.$type.'&biztype='.$update_arr['biztype_int'] );  //U (  'tag/index' )

		}else{
			$type=trim(I('get.type'));
			$catelist=M('cate')->where("type='".$type."'")->select(); 
			for($i=1;$i<=4;$i++){
				$grouplist[$i-1]["title"] = $i;
				$grouplist[$i-1]["value"] = $i;
			}
			
			$this->assign('grouplist',$grouplist);
			$this->assign('catelist', $catelist);
			$this->assign('filetype_int', I('get.type')); 
			 $this->assign('biztype', I('get.biztype')); 
			
			$this->assign('user', array('biztype_int'=>I('get.biztype'))); 
		
			$this->display('e');	
		}
	}
	public function e(){
		$m = M('tag'); 
		
		if(IS_POST){
			$where['tagid_int']=I('post.id');
			
			
			$update_arr=I('post.user');
			 
			  
		 	 
			
			$m->where($where)->save($update_arr);
			
			 
			 
			$this->success ( '操作成功', '/adminc.php?c=tag&a=e&id='.I('post.id') );  //U (  'tag/index' )

		}else{
			$where['tagid_int']=I('get.id');
			$userinfo=	$m->where($where)->find();
			
			
			$type=getTpyeNameById($userinfo['type_int']);
			$catelist=M('cate')->where("type='".$type."'")->select();
			for($i=1;$i<=4;$i++){
				$grouplist[$i-1]["title"] = $i;
				$grouplist[$i-1]["value"] = $i;
			}
			
			$this->assign('grouplist',$grouplist); 
			$this->assign('catelist', $catelist); 
			$this->assign('filetypelist', upfilesClass($userinfo['filetype_int'])); 
		    
			$this->assign('user', $userinfo); 
			$this->assign('filetype_int', $userinfo['filetype_int']); 
			
		
		 $this->display();
		}
	}
}