<?php  

namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class ArticleController extends BaseController {
	protected function _initialize(){
		
	}
    public function index(){
		if(!defined('VIRIFY')){
			aboutaa();
		}
 
		$m = M('article');      
		 
		//$where=array('type'=>$type); 
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('create_time desc')->limit($p->firstRow, $p->listRows)->select();
	 
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		 $this->assign('type', $type);  
		
		
		$ui['article'] = 'active';
		$ui['article_index'] = 'active';
		$this->assign('ui',$ui);

		$this->display();
    }
	public function del(){
		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
		$m = M('article');      
		$m->where('id='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=article&filetype='.I('get.type'));  // U ('user/index')
		
	}
	public function add(){
		$m = M('article'); 
		
		if(IS_POST){
			$update_arr=I('post.user');
		  
			if (get_magic_quotes_gpc()) {
				$update_arr['content'] = stripslashes($_POST['content']);
			} else {
				$update_arr['content'] = $_POST['content'];
			}
		 
			 
			$update_arr['create_time'] =time();
			
		 	
			$new_id= $m->add($update_arr);
			
		 	 
			$this->success ( '操作成功', '/adminc.php?c=article&filetype='.$update_arr['type'] );  //U (  'article/index' )

		}else{
			
			$ui['article'] = 'active';
			$ui['article_add'] = 'active';
			$this->assign('ui',$ui);
			
			$this->assign('filetype_int', I('get.type')); 
			 
			$this->assign('user', array()); 
		
			$this->display('e');	
		}
	}
	public function e(){
		$m = M('article'); 
		
		if(IS_POST){
			$where['id']=I('post.id');
			$update_arr=I('post.user');
			  
		   
			if (get_magic_quotes_gpc()) {
				$update_arr['content'] = stripslashes($_POST['content']);
			} else {
				$update_arr['content'] = $_POST['content'];
			}
		 
			$m->where($where)->save($update_arr);
			
			  
			 
			$this->success ( '操作成功', '/adminc.php?c=article&a=e&id='.I('post.id') );  //U (  'article/index' )

		}else{
			
			$ui['article'] = 'active';
			$ui['article_index'] = 'active';
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