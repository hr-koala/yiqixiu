<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
load::own_class('web/class/web_shop_base');
/**
 * 产品模块
 */

class shop_show extends web_shop_base{	
	
	public function __construct() {
		global $_M;
		$this->de_construct();
	}
	
	public function doindex() {
		global $_M;
		if(!$_M['form']['id']){
			$_M['form']['id'] = $this->get_id($_M['form']['metid'], $_M['form']['murlid'], $_M['form']['furlid']);
		}
		$goods_class = load::own_class('web/class/web_goods', 'new');
		$goods = $goods_class->get_goods_by_pid($_M['form']['id'], 0, 0, 1, 1);
		$goods = $goods_class->analysis($goods);
		$goods = load::plugin('doshopv2_show_goods', 1, array('goods'=>$goods));//加载插件
		$para_stock = $goods_class->get_plist_list($goods['pid']);
		foreach($para_stock as $key=>$val){
			$para_stock[$key]['price_str'] = load::own_class('web/class/web_func', 'new')->price_str($val['price']);
		}
		$stockjson = jsonencode($para_stock);
		require_once $this->template('tem/shop_showproduct');
		die();
	}
	
	public function get_id($metid, $murlid, $furlid) {
		global $_M;	
		$mid = 0; 
		if($metid){
			if(is_numeric($metid)){
				$mid = $metid;
			}else{
				$query = "select * from {$_M['table']['product']} where filename='{$metid}'";
				$url_con = DB::get_one($query);
				$mid = $url_con['id'];
			}
		}else{
			if(strstr('showproduct', $murlid) && $_M['config']['met_htmpagename'] == 0){
				$mid = str_replace('showproduct', '', $murlid);
			}
			
			if(is_numeric($murlid) && $_M['config']['met_htmpagename'] == 1){
				$mid = substr($murlid, 8);
			}
			
			if(strpos($murlid,$furlid)!==false && $_M['config']['met_htmpagename'] == 2){
				$mid = str_replace('product', '', $murlid);
			}

			if(!$mid){
				$query = "select * from {$_M['table']['product']} where filename='{$murlid}'";
				$url_con = DB::get_one($query);
				$mid = $url_con['id'];
				//$mid = 
			}
		}
		return $mid;
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>