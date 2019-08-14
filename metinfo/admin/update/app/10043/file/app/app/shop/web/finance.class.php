<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');
load::own_class('web/class/pager');

class finance extends web_shop_base{	

	public $finance;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->finance = load::own_class('web/class/web_finance', 'new');
	}
	
	public function doindex() {
		global $_M;
		$search .= " and uid = '".get_met_cookie('id')."' ";
		$order = 'addtime DESC';
		$_M['form']['page'] = $_M['form']['page'] ? $_M['form']['page'] : 1;
		$pagelength = 20;
		$finances = $this->finance->get_finance_list($search, $order, ($_M['form']['page']-1)*$pagelength, $pagelength);
		if($finances === false){
			okinfo('../404.html');
		}
		$finances = $this->finance->analysis_array($finances);
		$_M['url']['finance_page'] = "{$_M['url']['shop_finance']}&page=[page]";
		$page = new pager($_M['url']['finance_page'], $_M['form']['page'], $this->finance->get_finance_total($search), $pagelength);
		$page_html = $page->get_html();
		foreach($finances as $key=>$val){
			$list = array();
			$list['type_str'] = $val['type_str'];
			if($val['type'] == 1){
				$list['str_price'] = '+'.$val['price'];
			}else{
				$list['str_price'] = '-'.$val['price'];
			}
			$list[] = $val['balance'];
			if(str_length($val['reason'], 1) >100){
				$list[] = strcut($val['reason'], 0, 100)."...<a class=\"detailed\" data-info=\"{$val['reason']}\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" href=\"#\">详细</a>";
			}else{
				$list[] = $val['reason'];
			}
			$list[] = date("Y-m-d H:i:s" ,$val['addtime']);
			$rarray[] = $list;
		}
		require_once $this->template('tem/shop_finance');

	}
	
	public function dojson_finance_list() {
		global $_M;
		$search .= " and uid = '".get_met_cookie('id')."' ";
		$order = 'addtime DESC,id DESC';
		$data = $this->finance->json_finance_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$list[] = date("Y-m-d H:i:s" ,$val['addtime']);
			if($val['type'] == 1){
				$list[] = "<span class='badge badge-danger'>{$val['price_str']}</span>";
			}else{
				$list[] = "<span class='badge badge-success'>{$val['price_str']}</span>";
			}
			$list[] = $val['balance_str'];
			$list[] = $val['reason_html'];
			$rarray[] = $list;
		}
		$this->finance->json_return($rarray);	
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>