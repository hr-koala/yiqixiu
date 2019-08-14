<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');
load::own_class('web/class/pager');

class order extends web_shop_base{	

	public $order;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->order = load::own_class('web/class/web_order', 'new');
	}
	
	public function doindex() {
		global $_M;
		if($_M['form']['ajaxjson']){
			if($_M['form']['state']!=''){
				if($_M['form']['state']=='all'){
					$search .= " and state > 0 ";
				}else{
					if($_M['form']['state']==3){
						$search .= " and (state = '2' or state = '3') ";
					}else{
						$search .= " and state = '{$_M['form']['state']}' ";
					}
				}
			}
			if($_M['form']['keyword']!=''){
				$search .= " and (orderid = '{$_M['form']['keyword']}' or search like '%{$_M['form']['keyword']}%')";
			}
			$search .= " and uid = '".get_met_cookie('id')."' ";
			$order = 'rtime DESC ';
			$pagelength = 8;
			$_M['form']['page'] = $_M['form']['page'] ? $_M['form']['page'] : 1;
			$orders = $this->order->get_order_list($search, $order, ($_M['form']['page']-1)*$pagelength, $pagelength);
			if($orders === false||!count($orders)){
				$json['error'] = 1;
				echo jsonencode(json);
				die();
			}
			$orders = $this->order->analysis_array($orders);
			$_M['url']['order_page'] = "{$_M['url']['shop_order']}&page=[page]";
			$page = new pager($_M['url']['order_page'], $_M['form']['page'], $this->order->get_order_total($search), $pagelength);
			//$page_html = $page->get_html();
			foreach($orders as $key=>$val){
				$goods_list = $this->order->get_goods_list($val['id']);
				$orders[$key]['goods_list'] = $goods_list;
				$orders[$key]['docheck_url'] = "{$_M['url']['shop']}order.php?a=docheck&id={$val['id']}";
			}
			$json['success'] = 1;
			$json['page'] 	 = $_M['form']['page'];
			$json['endnum']  = $page->pages;
			$json['order']   = $orders;
			echo jsonencode($json);
			die();
		}
		if($_M['form']['state']){
			$stateto[$_M['form']['state']] = 'class="active"';
		}else{
			$stateto['all'] = 'class="active"';
		}
		$statesearch = " and uid = '".get_met_cookie('id')."' ";
		$state1 = $this->order->get_order_total("and state = 1 {$statesearch}");
		$state3 = $this->order->get_order_total("and (state = '2' or state = '3') {$statesearch}");
		require_once $this->template('tem/shop_order');
		die();
	}
	
	public function docheck(){
		global $_M;
		$order = $this->order->get_order_by_user_id($_M['form']['id']);
		
		$order = $this->order->analysis($order);
		if($order['uid'] != get_met_cookie('id')){
			okinfo($_M['url']['shop_order'], $_M['word']['app_shop_noaccess']);
			die();
		}
		$goods_list = $this->order->get_goods_list($order['id']);
		require_once $this->template('tem/shop_order_check');
	}

	//关闭订单
	public function doorder_close(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['state'] = 0;
		if($info['id'])$this->order->save_order($info);
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