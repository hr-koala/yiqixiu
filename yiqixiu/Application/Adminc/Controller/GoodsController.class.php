<?php  


namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class GoodsController extends BaseController {
	protected function _initialize(){
		
	}
    public function index(){
		if(!defined('VIRIFY')){
			aboutaa();
		}
 
		$m = M('goods');      
		$type=I('get.filetype','bgType');
		$where=array('type'=>$type); 
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('add_time desc')->limit($p->firstRow, $p->listRows)->select();
	 
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		 $this->assign('type', $type);  
		
		
		$ui['goods'] = 'active';
		$ui['goods_index'] = 'active';
		$this->assign('ui',$ui);

		$this->display();
    }
	public function del(){
		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
		$m = M('goods');      
		$m->where('id='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=goods&filetype='.I('get.type'));  // U ('user/index')
		
	}
	public function add(){
		$m = M('goods'); 
		
		if(IS_POST){
			$update_arr=I('post.user');
		 
			 
			$update_arr['add_time'] =time();
			
		 	
			$new_id= $m->add($update_arr);
			
		 	 
			$this->success ( '操作成功', '/adminc.php?c=goods&filetype='.$update_arr['type'] );  //U (  'goods/index' )

		}else{
			
			$ui['goods'] = 'active';
			$ui['goods_add'] = 'active';
			$this->assign('ui',$ui);
			
			$this->assign('filetype_int', I('get.type')); 
			 
			$this->assign('user', array()); 
		
			$this->display('e');	
		}
	}
	public function e(){
		$m = M('goods'); 
		
		if(IS_POST){
			$where['id']=I('post.id');
			$update_arr=I('post.user');
			  
		  
			$m->where($where)->save($update_arr);
			
			  
			 
			$this->success ( '操作成功', '/adminc.php?c=goods&a=e&id='.I('post.id') );  //U (  'goods/index' )

		}else{
			
			$ui['goods'] = 'active';
			$ui['goods_index'] = 'active';
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