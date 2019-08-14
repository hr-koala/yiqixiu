<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class freight_admin extends admin {
	public $freight;
	
	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		$this->freight = load::own_class('admin/class/sys_freight', 'new');
	}
	
	public function dojson_freight_list(){
		global $_M;
		$data = $this->freight->get_freight_all();
		echo jsonencode($data);
		die();
	}
	
	public function dojson_zone_list(){
		global $_M;
		$data = $this->freight->get_zone_all($_M['form']['id']);
		echo jsonencode($data);
		die();
	}
	

	public function doindex(){
		global $_M;
		require_once $this->template('own/freight_index');
	}
	
	public function docheck(){
		global $_M;
		$freight = $this->freight->get_freight_by_id($_M['form']['id']);
		require_once $this->template('own/freight_editor');
	}
	
	public function dosavefreight(){
		global $_M;
		$info = array();
		$info['id'] = $_M['form']['id'];
		$info['name'] = $_M['form']['name'];
		$this->freight->save_freight($info);
		if($info['id']){
			$lid = $info['id'];
			$this->freight->del_zone($lid);
		}else{
			$lid = DB::insert_id();
		}
		foreach($_M['form']['zone'] as $key=>$val){
			$info = array();
			$info['lid'] = $lid;
			$info['zone'] = $_M['form']['zone'][$key];
			$info['first'] = $_M['form']['first'][$key];
			$info['freight'] = $_M['form']['freight'][$key];
			$info['addp'] = $_M['form']['addp'][$key];
			$info['renew'] = $_M['form']['renew'][$key];
			$this->freight->save_zone($info);
		}
		$this->ajax_success('保存成功');
	}
	
	/*获取运费模板*/
	function dorefresh_discount_list(){
		global $_M;
		$list = $this->freight->get_freight_all();
		$re = "<option value=\"0\">请选择</option>";
		foreach($list as $val){
			$re.= "<option value=\"{$val[id]}\">{$val[name]}</option>";
		}
		echo $re;
	}
	
	//删除
	public function dodel(){
		global $_M;
		$this->freight->del_freight($_M['form']['id']);
		$this->ajax_success('已删除');
	}
	
	//错误
	public function ajax_error($error){
		global $_M;
		$retun = array();
		$retun['error'] = $error;
		echo jsonencode($retun);
		die();
	}
	//成功
	public function ajax_success($success){
		global $_M;
		$retun = array();
		$retun['success'] = $success;
		echo jsonencode($retun);
		die();
	}
}