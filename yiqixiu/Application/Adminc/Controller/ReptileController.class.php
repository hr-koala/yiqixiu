<?php
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
class ReptileController extends BaseController {
	public function index(){
 
		$list=M('cate')->where("type='scene_type'")->order('sort asc,id asc')->select();				
		
		$biztypeId=$userinfo['scenetype_int']?intval($userinfo['scenetype_int']):$list[0]['value'];
			$slist=M('tag')->where("type_int=2 and biztype_int=".$biztypeId)->order('tagid_int asc')->select();
		
		$this->assign('scene_type_list', $list); 
		$this->assign('scene_type_list2', $slist); 
		
		$this->assign('fromweb', I('get.from','eqxiu')=='70'?'70度':'官网'); 
		$this->assign('from', I('get.from','eqxiu')); 

  $ui['Reptile'] = 'active';
  $this->assign('ui',$ui);	
  $this->display($display);
    }
	
 
}