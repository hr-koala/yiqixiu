<?php

namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class OrderController extends BaseController {
	protected function _initialize(){
		
	}
    public function index(){
		if(!defined('VIRIFY')){
			aboutaa();
		}
 
		$m = M('order_info');      
		if($_REQUEST['pay_status']){
			$where=array('pay_status'=>intval($_REQUEST['pay_status'])); 
		} 
		 
		
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('add_time desc')->limit($p->firstRow, $p->listRows)->select();
	 
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		 $this->assign('type', $type);  
		
		
		$ui['order_info'] = 'active';
		$ui['order_info_index'] = 'active';
		$this->assign('ui',$ui);

		$this->display();
    }
	public function del(){
		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
		$m = M('order_info');      
		$m->where('id='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=order&filetype='.I('get.type'));  // U ('user/index')
		
	}
	public function add(){
		$m = M('order_info'); 
		
		if(IS_POST){
			$update_arr=I('post.user');
		 
			 
			$update_arr['create_time'] =time();
			
			$update_arr['type']= I('post.filetype');
			
			$new_id= $m->add($update_arr);
			
			$m->where('id='.$new_id)->save(array('value'=>$new_id));
			 
			$this->success ( '操作成功', '/adminc.php?c=order&filetype='.$update_arr['type'] );  //U (  'cate/index' )

		}else{
			
			$ui['order_info'] = 'active';
			$ui['order_info_index'] = 'active';
			$this->assign('ui',$ui);
			
			$this->assign('filetype_int', I('get.type')); 
			 
			$this->assign('user', array()); 
		
			$this->display('e');	
		}
	}
	public function e(){
		$m = M('order_info'); 
		
		if(IS_POST){
			$where['id']=I('post.id');
			$update_arr=I('post.user');
			  
		 	 
			
			$m->where($where)->save($update_arr);
			
			  
			 
			$this->success ( '操作成功', '/adminc.php?c=order&a=e&id='.I('post.id') );  //U (  'cate/index' )

		}else{
			
			$ui['order_info'] = 'active';
			$ui['order_info_index'] = 'active';
			$this->assign('ui',$ui);
			
			$where['id']=I('get.id');
			$userinfo=	$m->where($where)->find();
			
			
			$this->assign('filetypelist', upfilesClass($userinfo['filetype_int'])); 
		 
			$this->assign('user', $userinfo); 
			$this->assign('filetype_int', $userinfo['filetype_int']); 
			
		
		 $this->display();
		}
	}
}