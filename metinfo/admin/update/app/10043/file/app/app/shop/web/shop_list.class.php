<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class shop_list extends web_shop_base{	
	
	public function __construct() {
		global $_M;
		$this->de_construct();
	}
	
	public function doindex() {
		global $_M;
		$searchpara = load::own_class('web/class/web_searchlist', 'new')->get_searchlist_array($_M['form']['searchlist']);
		if($_M['form']['searchlist']){
			foreach($searchpara as $key=>$val){
				foreach($val['para'] as $key=>$valpara){
					if($valpara['class']){
					//dump($valpara);
						$_M['plugin']['para']['met_title'] .= $valpara['title'].'_';
						$_M['plugin']['para']['met_keywords'] .= $valpara['keywords'].'|';
						$_M['plugin']['para']['met_description'] .= $valpara['description'].'|';
					}
				}	
			}
			$_M['plugin']['para']['met_title'] = trim($_M['plugin']['para']['met_title'], '_');
			$_M['plugin']['para']['met_keywords'] = trim($_M['plugin']['para']['met_keywords'], '|');
			$_M['plugin']['para']['met_description'] = trim($_M['plugin']['para']['met_description'], '|');
		}
		
		$orderpara[0]['info'] = "综合排序";
		$orderpara[0]['url'] = $_M['url']['shop_orderby_com'];
		$orderpara[0]['class'] = $_M['form']['no_order'] == '' ?  "curr": "";
		
		$orderpara[1]['info'] = "销量";
		$orderpara[1]['url'] = $_M['url']['shop_orderby_sales'];
		if($_M['form']['no_order'] == 'sales|asc'){
			$orderpara[1]['class'] = "curr asc";
		}else if($_M['form']['no_order'] == 'sales|desc'){
			$orderpara[1]['class'] = "curr desc";
		}
		
		$orderpara[2]['info'] = "价格";
		$orderpara[2]['url'] = $_M['url']['shop_orderby_price'];
		if($_M['form']['no_order'] == 'price|asc'){
			$orderpara[2]['class'] = "curr asc";
		}else if($_M['form']['no_order'] == 'price|desc'){
			$orderpara[2]['class'] = "curr desc";
		}
		require_once $this->template('tem/shop_product');
		die();
	}

	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>