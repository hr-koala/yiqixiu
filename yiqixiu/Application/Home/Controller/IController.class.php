<?php
namespace Home\Controller;
use Think\Controller;
class IController extends Controller {
	
		public function _initialize() {
			if (intval(session('userid')) == 0) {
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
		 
		}
	    $logo_url= M('ad')->where("type=1")->order("id desc")->limit(1)->getField("url");		
			
		$this->assign('logo_url',"/Uploads".$logo_url);	
	//	$adlist2=M('ad')->where("type=2")->order('sort desc')->select();
		$adlist3=M('ad')->where("type=13")->order('sort desc')->select();
		$adlist4=M('ad')->where("type=14")->order('sort desc')->select();
		//$this -> assign('page', $p -> show());
		$this -> assign('flag', I('get.flag', 'sys'));
		//$this->assign('adlist2',$adlist2);
		$this->assign('adlist3',$adlist3);
		$this->assign('adlist4',$adlist4);

		
	}
	
	
	
	
	
	
    public function index(){
		$_scene = M('scene');
		$scenetype = intval(I('get.type', 0));
		if ($scenetype > 0) {
			$where['scenetype_int'] =$scenetype;
		}
		$where['userid_int'] = array('gt', 0);
        //$where['hitcount_int'] = array('gt', 0);
        $where['applyPromotion'] = 2;
		$pageshowsize = I('get.pageSize', 10);
		if ($pageshowsize > 30) {
			$pageshowsize = 30;
		} 
		$list = $_scene -> where($where) -> order('rank desc,sceneid_bigint desc') -> page(I('get.pageNo', 1), $pageshowsize) -> select();
		$this -> assign('select', $list);
		
        $this->display('default');
    }
	
	public function contact(){
		$articleInfo=M("article")->where("type=2")->order("create_time desc")->limit(1)->find();
		
		$this -> assign('articleInfo', $articleInfo);
		
		$this->display();
	}
	public function culture(){
		$articleInfo=M("article")->where("type=5")->order("create_time desc")->limit(1)->find();
		
		$this -> assign('articleInfo', $articleInfo);
		
		$this->display();
	}
	
	 public function about(){
		$articleInfo=M("article")->where("type=1")->order("create_time desc")->limit(1)->find();
		 
		$this -> assign('articleInfo', $articleInfo);
		
        $this->display('about');
    }
	
	 public function origin(){
			 $articleInfo=M("article")->where("type=4")->order("create_time desc")->limit(1)->find();
		 
		$this -> assign('articleInfo', $articleInfo);
        $this->display('origin');
    }
		 public function team(){
			 $articleInfo=M("article")->where("type=6")->order("create_time desc")->limit(1)->find();
		 
		$this -> assign('articleInfo', $articleInfo);
        $this->display('team');
    }
	 public function job(){
		// $articleInfo=M("article")->where("type=7")->order("create_time desc")->limit(1)->find();
		 
		//$this -> assign('articleInfo', $articleInfo);
		$pageshowsize = I('get.pageSize', 10);
		if ($pageshowsize > 30) {
			$pageshowsize = 30;
		} 
		$list =M("article")->where("type=7")-> order('create_time desc') -> page(I('get.pageNo', 1), $pageshowsize) -> select();
		$this -> assign('select', $list);
		
        $this->display();
    }
	
	
    

}