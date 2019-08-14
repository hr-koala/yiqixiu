<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class AdController extends BaseController {
    public function index(){
		$m = M('ad');      
		$where=array(); 
		$where['type']=array('lt',10);
		if(I('get.filetype')){
			$where['type']=I('get.filetype');
		}
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('num ASC')->limit($p->firstRow, $p->listRows)->select();
		$this->assign('select', $list); 
		$this->assign('page', $p->show());
		  
		   $this->assign('type',I('get.filetype'));  
		
		if(I('get.filetype')>10){
			$ui['sys_homeset']='active';
			$ui['sys'] = 'active';
           $this->assign('ui',$ui);  
			$this->display('dhan');
		}else{
			$ui['Ad_index'] = 'active';
       
			$this->assign('ui',$ui);  
		 
			$this->display();
		}
    }
	public function dhan(){


	    $ui['sys_dhan'] = 'active';
         $this->assign('ui',$ui);  
		$this->display();
	}
    public function msglist(){
        $msg=M('news');
     
         $where=array(); 
		  $where['bizType']=array('lt',10);
		$count = $msg->where($where)->count();
		$p = getpage($count,16);
		$list = $msg->field(true)->where($where)->order('id ASC')->limit($p->firstRow, $p->listRows)->select();
        $this->assign('msglist', $list); 
		$this->assign('page', $p->show()); 
		$ui['Ad_msgList'] = 'active';
         $this->assign('ui',$ui);  
        $this->display();
    }
    public function msgedit(){
               $msg=M('news');
       
        if(IS_POST){
            $where['id'] = I('post.id');
            $data= I('post.msg');
            $data['sendTime']=time();
             $data['status']=1;
            $msg -> where($where) -> save($data);
            $this->success ( '操作成功','/adminc.php?c=ad&a=msglist' );
        }else{
            $where['id'] = I('get.id');
			 $list =$msg->where($where)->find();
            $this->assign('msglist', $list); 
			$ui['Ad_msgedit'] = 'active';
         $this->assign('ui',$ui); 
             $this->display();
        }
    }
    public function msgadd(){
         $msg=M('news');
       
        if(IS_POST){
            $where['id'] = I('post.id');
            $data= I('post.msg');
            $data['sendTime']=time();
             $data['status']=1;
            $msg->add($data); 
            $this->success ( '操作成功','/adminc.php?c=ad&a=msglist' );
        }else{
      $ui['Ad_msgadd'] = 'active';
         $this->assign('ui',$ui); 
             $this->display();
        }
       
    }
    
    	public function msgdel(){
		if(session('adminRole')==2 ){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=sys&a=admin' );
		}
		 
		 $msg = M('news'); 
		$msg->where('id='.$_REQUEST['id'])->delete();
		$this->success ( '操作成功', '/adminc.php?c=ad&a=msglist' );
		
	}
	public function add(){
		$add_ad = M('ad'); 
		
		if(session('adminRole')==2 && session('adminUserid') != $_REQUEST['id']){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=sys&a=admin' );
		} 
		if(IS_POST){
			
			$upload = new \Think\Upload();// 
			$upload->exts =  array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath  ='/ad/'; 
			$ad=I('POST.ad');
			$ad['date']=time();
			$ad['isopen']=1;
			$info   =   $upload->upload();  
			if(!$info) {        
				$this->error($upload->getError());    
			}else{          
				$ad['url'] = $info['photo2']['savepath'].$info['photo2']['savename'];    
			}
			$add_ad->add($ad);
			$this->success ( '操作成功','/adminc.php?c=ad' ); //U (  'sys/admin' )

		}else{
			$this->assign('isAdd', 1); 
			$this->assign('ad', array()); 
			$ui['Ad_d'] = 'active';
			$this->assign('ui',$ui); 
			$this->display('edit');
		}
	}
	public function edit(){
		$m = M('ad'); 
		if(session('adminRole')==2 && session('adminUserid') != $_REQUEST['id']){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=Ad' );
		} 
         

		if(IS_POST){
			$where['id']=I('post.id');
			$update_name=I('post.ad');
             $upload = new \Think\Upload();// 
            $upload->exts =  array('jpg', 'gif', 'png', 'jpeg');
            $upload->savePath  ='/ad/'; 
            $info   =   $upload->upload();  
 
             if(!$info) {        
            $this->error($upload->getError());    
            }else{          
            $update_nam['url'] = $info['photo2']['savepath'].$info['photo2']['savename'];    
            }
			$m->where($where)->save($update_nam);
			 
			$this->success ( '操作成功','/adminc.php?c=ad' );  

		}else{
			$where['id']=I('get.id');
			$userinfo=	$m->where($where)->find();
			$this->assign('ad', $userinfo);
			$ui['Ad_edit'] = 'active';
         $this->assign('ui',$ui); 
            $this->display();
		}
	}
	
	public function del(){
		if(session('adminRole')==2 ){
			$this->error ( '您没有编辑其它管理员的权限', '/adminc.php?c=sys&a=admin' );
		}
		 
		 $ad = M('ad'); 
		$ad->where('id='.$_REQUEST['id'])->delete();
		 
		$this->success ( '操作成功', '/adminc.php?c=ad' );
	
		
	}
	
	public function set(){
	 
		
		if(IS_POST){
			 
			$this->success ( '操作成功', U (  'sys/set' ) );

		}else{
			 
			$webset=	conf_read('websetConfig');
			
			$this->display();
		}
	}
	public function dh_add(){
		$m = M('ad'); 
		if(IS_POST){
			$update_arr=I('post.user');
			$update_arr['create_time'] =time();
			$update_arr['type']= I('post.filetype');
			$new_id= $m->add($update_arr);
			$m->where('id='.$new_id)->save(array('value'=>$new_id));
			$this->success ( '操作成功', '/adminc.php?c=ad&filetype='.$update_arr['type'] );  //U (  'cate/index' )
		}else{
			$this->assign('filetype_int', I('get.type')); 
			$this->assign('user', array());
			$ui['dh_add'] = 'active';
			$this->assign('ui',$ui);  
			$this->display('dhe');	
		}
	}
	
	
	public function dh_e(){
		$m = M('ad'); 
		if(IS_POST){
			$where['id']=I('post.id');
			$update_arr=I('post.user');
			$m->where($where)->save($update_arr);
			$this->success ( '操作成功', '/adminc.php?c=ad&filetype=13'); 
			
			//$this->success ( '操作成功', '/adminc.php?c=ad&a=dh_e&id='.I('post.id') );  //U (  'cate/index' )
		}else{
			$where['id']=I('get.id');
			$userinfo=	$m->where($where)->find();
			$this->assign('type', upfilesClass($userinfo['type'])); 
			$this->assign('user', $userinfo); 
			$this->assign('type', $userinfo['type']); 
			$ui['sys'] = 'active';
			$this->assign('ui',$ui); 
			$this->display('dhe');	
		}
	}
	public function friendlinks(){
		$m = M('ad');      
		$where=array(); 
		$where['type']  = 10;
		$count = $m->where($where)->count();
		$p = getpage($count,16);
		$list = $m->field(true)->where($where)->order('num ASC')->limit($p->firstRow, $p->listRows)->select();
		$this->assign('select', $list); 
		$this->assign('page', $p->show());  
		$ui['ad_friendlinks'] = 'active';
		$this->assign('ui',$ui);
		$this->display();
	}
	public function friendlinks_add(){
		
		$add_ad = M('ad'); 
		if(IS_POST){
			$upload = new \Think\Upload();// 
			$upload->exts =  array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath  ='/ad/'; 
			$ad=I('POST.ad');
			$ad['date']=time();
			$ad['isopen']=1;
			$ad['type']=10;
			$info   =   $upload->upload();  
			if(!$info) {        
				$this->error($upload->getError());    
			}else{          
			$ad['logo'] = $info['photo2']['savepath'].$info['photo2']['savename'];}
			$add_ad->add($ad);
			$this->success ( '操作成功',U ('Ad/friendlinks') ); //U (  '/Ad/friendlinks' )
		}else{
			
			$this->assign('isAdd', 1); 
			$this->assign('ad', array()); 
			$ui['ad_friendlinks'] = 'active';
			$this->assign('ui',$ui);
			$this->display('friendlinks_add');
		}
	}	
	
	public function friendlinks_edit(){
		$m = M('ad'); 
		if(IS_POST){
			$where['id']=I('post.id');
			$update_name=I('post.ad');
			$upload = new \Think\Upload();// 
			$upload->exts =  array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath  ='/ad/'; 
			$info   =   $upload->upload();  
			if(!$info) {        
				$this->error($upload->getError());    
			}else{          
				$update_nam['logo'] = $info['photo2']['savepath'].$info['photo2']['savename'];    
			}
			$m->where($where)->save($update_nam);
			$m->where($where)->save($update_name);
			$this->success ( '操作成功',U('Ad/friendlinks') );  
		}else{
			$where['id']=I('get.id');
			$userinfo=	$m->where($where)->find();
			$this->assign('ad', $userinfo); 
			$ui['ad_friendlinks'] = 'active';
			$this->assign('ui',$ui);
			$this->display('friendlinks_add');
		}
	}

}