<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class discount extends web_shop_base{	
	
	public $discount;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->discount = load::own_class('web/class/web_discount', 'new');
	}
	
	public function doindex() {
		global $_M;
		$discount = $this->discount->get_discount_by_id($_M['form']['id']);
		$discount = $this->discount->analysis($discount);
		$discount['is_receive'] = $this->discount->is_receive($_M['form']['id'] ,get_met_cookie('id') ) ? 1:0;
		require_once $this->template('tem/shop_discount');
	}
	
	public function doreceive(){
		global $_M;
		$discount = $this->discount->get_discount_by_id($_M['form']['id']);
		if($this->discount->receive($discount['id'], get_met_cookie('id'))){
			okinfo(-1, '领取成功');
		}else{
			okinfo(-1, '领取失败');
		}
				
	}
	
	public function domydiscount() {
		global $_M;
		$discounts = $this->discount->get_discount_by_uid(get_met_cookie('id'));
		$discounts = $this->discount->analysis_array($discounts);
		foreach($discounts as $key=>$val){
			if($val['usetime'])$discounts[$key]['usetime_str'] = date('Y-m-d H:i:s', $val['usetime']);
		
		}
		require_once $this->template('tem/shop_discount_my');
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>