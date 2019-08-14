<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class sys_product {
	public $lang;
	public $table;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	
	public function get_product_list($where = '', $order = '', $start = '', $length = '') {
		
	}
	
	public function get_product_list_by_info($userid = '', $state = '') {
		
	}
	
	public function json_product_list($keyword, $class1 = '', $class2 = '', $class3 = '', $display, $top_ok, $com_ok){
		global $_M;
		$search.= $class1?"and class1 = '{$class1}'":''; 
		$search.= $class2?"and class2 = '{$class2}'":'';
		$search.= $class3?"and class3 = '{$class3}'":'';
		$search.= $display?"and display = '{$display}'":'';
		$search.= $top_ok?"and top_ok = '{$top_ok}'":'';
		$search.= $com_ok?"and com_ok = '{$com_ok}'":'';	
		$search.= $keyword?"and (title like '%{$keyword}%')":'';
		$where = "lang='{$this->lang}' and (recycle='0' or recycle='-1') {$search}";
		$order = "";	
		return $this->table_product($where, $order);
	}

	public function table_product($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');

		$data = $this->table->getdata($_M['table']['product'], '*', $where, $order);

		$data = $this->analysis($data);	
		return $data;
	}
	
	public function json_product_list_html($data){

	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function analysis($list){
		return $list;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>