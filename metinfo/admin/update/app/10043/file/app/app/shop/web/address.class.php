<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class address extends web_shop_base{	

	public $address;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->address = load::own_class('web/class/web_address', 'new');
	}
	
	public function doindex() {
		global $_M;
		require_once $this->template('tem/shop_address');
		die();
	}
	
	//地址操作
	public function do_address_zone(){
		global $_M;
		echo $this->address_zone($_M['form']['selectid'], $_M['form']['type']);
	}
	
	public function address_zone($selectid = '', $type = 'one'){
		global $_M;
		$uid = get_met_cookie('id');
		$add = $this->address->get_address_by_uid($uid);
		$s = array();
		if($add){
			foreach($add as $key=>$val){
				if($key == 0)$this->addr_de = $val['id'];
			}
			$s = $add;
		}
		return jsonencode($s);
	}
	
	public function do_address_editor(){
		global $_M;		
		$addr['id'] = $_M['form']['id'];
		$addr['name'] = $_M['form']['name'];
		$addr['zone_p'] = $_M['form']['zone_p'];
		$addr['zone_c'] = $_M['form']['zone_c'];
		$addr['zone_d'] = $_M['form']['zone_d'];
		$addr['zone_a'] = $_M['form']['zone_a'];
		$addr['tel'] = $_M['form']['tel'];
		$addr['fixed'] = $_M['form']['fixed'];
		$addr['email'] = $_M['form']['email'];
		if(!$addr['name'] || !$addr['zone_p']|| !$addr['tel']){
			$this->ajax_error($_M['word']['app_shop_error']);
		}
		$this->address->save_address($addr);
		$this->ajax_success($_M['word']['app_shop_saveok']);
	}
	
	public function do_address_del(){
		global $_M;
		$this->address->del_address($_M['form']['id']);
		$this->ajax_success($_M['word']['app_shop_delok']);
	}
	
	public function do_address_de(){
		global $_M;
		$addr['id'] = $_M['form']['id'];
		$addr['de'] = $_M['form']['de'];
		$this->address->save_address($addr);
		$this->ajax_success($_M['word']['app_shop_success']);
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

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>