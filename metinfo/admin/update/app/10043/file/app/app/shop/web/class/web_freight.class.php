<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_freight {
	public $lang;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	public function get_freight($freight_mould, $amount, $place){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_logistics_zone']} WHERE zone like '%{$place}%' AND lid='{$freight_mould}'";
		$f = DB::get_one($query);
		$price = $f['freight'];
		$ceil = ceil(($amount -  $f['first'])/ $f['addp']);
		if($ceil >= 1){
			$price += $ceil * $f['renew'];
		}
		return $price;
	}
	public function get_invoice_freight($place){
		global $_M;
				return 0;
		if($_M['config']['invoice_freight_type'] == 1){
			return $_M['config']['invoice_freight'];
		}else{
			$query = "SELECT * FROM {$_M['table']['shopv2_logistics_zone']} WHERE zone like '%{$place}%' AND lid='{$_M['config']['invoice_freight_mould']}'";
			$f = DB::get_one($query);
				return $f['freight'];
		}

	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>