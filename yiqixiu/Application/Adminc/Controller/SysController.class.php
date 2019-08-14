<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class SysController extends BaseController {
    public function admin(){
		$m = M('admin');      
		$where=array(); 
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('USERID ASC')->limit($p->firstRow, $p->listRows)->select();
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		 $ui['sys_admin'] = 'active';
         $this->assign('ui',$ui);
		// var_export($list);
		//echo C('TEST_ADMIN_ID');
		$this->display();
    }
	
	
	
	public function edit(){
		$m = M('admin'); 
		if(session('adminRole')==2 && session('adminUserid') != $_REQUEST['id']){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=sys&a=admin' );
		} 
		if(IS_POST){
			$where['USERID']=I('post.id');
			$update_arr=I('post.user');
			 
			if(I('post.userpassword')){
				$update_arr['USERPASSWORD']=md5(I('post.userpassword'));
			}
			
			$m->where($where)->save($update_arr);
 
			$this->success ( '操作成功',U('sys/admin')); //
		}else{
			$where['USERID']=I('get.id',session('adminUserid'));
			$userinfo=	$m->where($where)->find();
		 
		$ui['sys_edit'] = 'active';
         $this->assign('ui',$ui);    
		$this->assign('user', $userinfo); 
		 $this->display();
		}
	}
	public function add(){
		$m = M('admin'); 
		if(session('adminRole')==2 && session('adminUserid') != $_REQUEST['id']){
			$this->error ( '您没有编辑其它管理员的权限', ('sys/admin') );
		} 
		if(IS_POST){
			$update_arr=I('post.user');
			if(I('post.userpassword')){
				$update_arr['USERPASSWORD']=md5(I('post.userpassword'));
			}
			$update_arr['REGTIME']=time();
			$update_arr['USERIS']=1;
			
			$m->add($update_arr);
			 
			$this->success ( '操作成功','/adminc.php?c=sys&a=admin' ); //U (  'sys/admin' )
		}else{
			$this->assign('isAdd', 1); 
			$this->assign('user', array()); 
			
			$ui['sys_add'] = 'active';
         $this->assign('ui',$ui);
			$this->display('edit');
		}
	}
	public function del(){
		if(session('adminRole')==2 ){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=sys&a=admin' );
		}
			$m = M('admin'); 
		$m->where('userid='.$_REQUEST['id'])->delete();
		 
		$this->success ( '操作成功', '/adminc.php?c=sys&a=admin' );
	}
	
	public function set(){
		if(IS_POST){
		//$file=$this->_post('files');
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
			$_POST['countCode']=base64_encode($_POST['countCode']);
 		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
 
		}else{
			$countCode=base64_decode(C("countCode")); 
			$this->assign('countCode',$countCode);
		 $ui['sys_set'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}
	public function otherlogin(){
		if(IS_POST){
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
			//print_r($_POST); exit;
			$_POST['THINK_SDK_QQ']['CALLBACK']='http://' . $_SERVER['HTTP_HOST'].'/password.html';
		 if($this->update_config($_POST,CONF_PATH.'otherlogin.php')){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
 
		}else{
			echo CONF_PATH.'otherlogin.php';
			$ui['sys'] = 'active';
			$ui['otherlogin'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}
	public function scenelink(){
		if(IS_POST){
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
			//print_r($_POST); exit;
		 if($this->update_config($_POST,CONF_PATH.'scenelink.php')){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
 
		}else{
			$ui['sys'] = 'active';
			$ui['sys_scenelink'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}
    public function pay(){
		if(IS_POST){
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
 		if($this->update_config($_POST,CONF_PATH.'pay.php')){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
 
		}else{
		$ui['sys_pay'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}
    
	public function wxapi(){
		if(IS_POST){
		//$file=$this->_post('files');
		unset($_POST['files']);
 		if($this->update_config($_POST,CONF_PATH.'wxapi.php')){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
 
		}else{
		 $ui['sys_wxapi'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}
	public function setmail(){
		if(IS_POST){
		//$file=$this->_post('files');
		unset($_POST['files']);
 
		$_POST['countsz']=base64_encode($_POST['countsz']);
 		if($this->update_config($_POST,CONF_PATH.'setmail.php')){
			$this->success('操作成功');
		}else{
			$this->success('操作失败');
		}
		}else{
		 $ui['sys_setmail'] = 'active';
         $this->assign('ui',$ui);
			$this->display();
		}
	}	
	public function homeset(){
		if(IS_POST){
			//$file=$this->_post('files');
			unset($_POST['files']);
			if($this->update_config($_POST,CONF_PATH.'home70.php')){
				$this->success('操作成功');
			}else{
				$this->success('操作失败');
			}
			
		}else{
			$ui['sys'] = 'active';
			$ui['sys_homeset'] = 'active';
			$this->assign('ui',$ui);
			$this->display();
		}
	}
	
	public function clearcache()
	{
		//缓存路径
		$Webpath = './Application/Runtime/';
		 
	 
		if(is_dir($Webpath))
		{
			$this->update_config(array('jsver'=>time()),CONF_PATH.'jsvion.php');
			\Think\File::del_dir($Webpath);
		}
		 $this->success('操作成功');
	}

	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'websetConfig.php';
		if (is_writable($config_file)) {

			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}	
	
}