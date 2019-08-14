<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');
load::own_class('web/product_list');
load::own_class('web/product_show');

/**
 * 产品模块
 */

class product_index  extends web {	
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$cmodule='product_list';
		if(@$_GET['metid']){
			if(@$_GET['list'] == 1){
				$cmodule='product_list';
			}else{
				$cmodule='product_show';
			}
		}
		
		if(@$_GET['murlid'] && @$_GET['furlid']){
			$cmodule = $this->get_module(@$_GET['murlid'], @$_GET['furlid']);
		}
		
		if($cmodule == 'product_show' && !$_M['form']['id']){
			$_M['form']['id'] = $this->get_id(@$_GET['murlid'], @$_GET['furlid']);
		}
		
		$_M['config']['cmodule'] = $cmodule;
		$class = new $cmodule(0);
		$class->doindex();
	}	
	
	public function get_module($murlid, $furlid) {
		if(isset($murlid)){
			$murlids = explode('_', $murlid);
			$htmlurl_last = $murlids[count($murlids)-1];
			//是否是默认语言
			if($met_langok[$htmlurl_last]) {
				$lang = $htmlurl_last;
				unset($murlids[count($murlids)-1]);
				$htmlurl_last = $murlids[count($murlids)-1];
			}
			//列表页或内容页
			if(is_numeric($htmlurl_last) && count($murlids) != 1 && !strstr($htmlurl_last, '.')){
				$list = 1;
				return 'product_list';
			}else{
				$list = 0;
				return 'product_show';
			}
		}
			
	}
	
	public function get_id($murlid, $furlid) {
		global $_M;
		$mid = 0; 
		if(strstr('showproduct', $murlid) && $_M['config']['met_htmpagename'] == 0){
			$mid = str_replace('showproduct', '', $murlid);
		}
		
		if(is_numeric($murlid) && $_M['config']['met_htmpagename'] == 1){
			$mid = substr($murlid, 8);
		}
		
		if(strstr($furlid, $murlid) && $_M['config']['met_htmpagename'] == 2){
			$mid = str_replace('product', '', $murlid);
		}
		
		if(!$mid){
			$query = "select * from {$_M['table']['product']} where filename='{$murlid}'";
			$url_con = DB::get_one($query);
			$mid = $url_con['id'];
			//$mid = 
		}
		return $mid;
		
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>