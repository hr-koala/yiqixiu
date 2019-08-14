<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_func {

	function price_str($price){
		global $_M;
		$price = $price ? number_format($price, 2, '.', ''): '0.00';
		$price = $_M['config']['shopv2_price_str_prefix'].$price.$_M['config']['shopv2_price_str_suffix'];
		return $price;
	}
	
	public function price_plugin($cart) {
		foreach($cart as $key=>$val){
			$list = array();
			$list['amount'] = $val['amount'];
			$list['price'] = $val['price'];
			$list['price_str'] = $val['price_str'];
			$list['subtotal'] = $val['subtotal'];
			$price['goods'][$val['id']] = $list;
			$price['goods']['total'] += $val['price']*$val['amount'];
		}
		$price['goods']['total_str'] = load::own_class('web/class/web_func', 'new')->price_str($price['goods']['total']);
		$price = load::plugin('doshopv2_modify_cart', 1, array('price'=>$price, 'cart'=>$cart));//加载插件
		return $price;
	}
	
	public function price_plugin_data($data, $price) {
		foreach($data as $key=>$val){
			$data[$key]['amount'] = $price['goods'][$val['id']]['amount'];
			$data[$key]['price'] = $price['goods'][$val['id']]['price'];
			$data[$key]['price_str'] = $price['goods'][$val['id']]['price_str'];
			$data[$key]['subtotal'] = $price['goods'][$val['id']]['subtotal'];
		}
		return $data;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>