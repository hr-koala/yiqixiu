<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class GroupController extends BaseController {
    public function index(){
        		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
        $group = M('user_group');
        $group_list = $group->select();
        $this->assign('group', $group_list); 
		$ui['user_group'] = 'active';
         $this->assign('ui',$ui);
        $this->display('Group');  
    }

	public function del(){
		if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
		$m = M('user_group');      
		$m->where('id='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=group');  // U ('user/index')
		
	}
    public function add(){
         if(session('adminRole')==2  ){
			$this->error ( '您没有相关权限', U (  'user/index' ) );
		}
        if(IS_POST){
        $group = M('user_group');
        $data=I('POST.group');
        $group->add($data);
        $this->success('操作成功','/adminc.php?c=group' ); 
        }else{
		$ui['user_group'] = 'active';
         $this->assign('ui',$ui);
         $this->display();  
         }
    } 
 
	public function e(){
        $group = M('user_group');
		if(IS_POST){
            $where['id']=I('get.id');
            $update_arr=I('post.group');
             $group->where($where)->save($update_arr); 
            $this->success ( '操作成功','/adminc.php?c=group' ); 
		}else{
			$where['id']=I('get.id');
			$group=	$group->where($where)->find();
		    $this->assign('group', $group);
			$ui['user_group'] = 'active';
         $this->assign('ui',$ui);
            $this->display();   
		}
	}
}