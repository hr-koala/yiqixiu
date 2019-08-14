<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class profile extends web_shop_base{	

	//public $order;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		//$this->order = load::own_class('web/class/web_order', 'new');
	}
	
	public function doindex() {
		global $_M;
		$order = load::own_class('web/class/web_order', 'new');
		$statesearch = " and uid = '".get_met_cookie('id')."' ";
		$state1 = $order->get_order_total("and state = 1 {$statesearch}");
		$state3 = $order->get_order_total("and (state = '2' or state = '3') {$statesearch}");
		require_once $this->template('tem/shop_profile');
		die();
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>