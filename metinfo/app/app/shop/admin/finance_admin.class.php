<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class finance_admin extends admin {
	public $finance;
	
	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		nav::select_nav(3);
		$this->finance = load::own_class('admin/class/sys_finance', 'new');
	}
		
	public function doindex(){
		global $_M;
		$type = $this->finance->para('type');
		require_once $this->template('own/finance_index');
	}	
	
	public function dojson_finance_list(){
		global $_M;
		$fromtime = $_M['form']['fromtime'];
		$totime   = $_M['form']['totime'];
		if($fromtime&&$totime){
			$fromtime = $fromtime.' 00:00:00';
			$fromtime = strtotime($fromtime);
			$totime = $totime.' 23:59:59';
			$totime = strtotime($totime);
			$search.= "and (addtime >= '{$fromtime}' && addtime<= '{$totime}') ";
		}
		$search.= $_M['form']['type']?"and type = '{$_M['form']['type']}' ":""; 
		$search.= $_M['form']['username']?"and username = '{$_M['form']['username']}' ":""; 
		$order = 'addtime DESC,id DESC';
		$data = $this->finance->json_finance_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$list[] = timeFormat($val['addtime']);
			if($val['type'] == 1){
				$list[] = "<span class=\"badge badge-danger\">+{$val['price']}</span>";
				$list[] = '-';
			}else{
				$list[] = '-';
				$list[] = "<span class=\"badge badge-success\">-{$val['price']}</span>";
			}
			$list[] = load::own_class('web/class/web_func', 'new')->price_str($val['balance']);
			$list[] = $val['username'];
			if(str_length($val['reason'], 1) >100){
				$list[] = strcut($val['reason'], 0, 100)."...<a class=\"detailed\" data-info=\"{$val['reason']}\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" href=\"#\">详细</a>";
			}else{
				$list[] = $val['reason'];
			}
			$list[] = $val['adminname'];
			$rarray[] = $list;
		}
		$this->finance->json_return($rarray);	
	}
	
	public function doaddfinance(){
		global $_M;
		if($this->finance->addfinance($_M['form']['type'], $_M['form']['username'], $_M['form']['price'], $_M['form']['reason'])){
			$this->ajax_success("入款成功");
		}else{
			if($this->finance->errorcode == 'nobalance'){
				$this->ajax_error("用户余额不足");
			}else if($this->finance->errorcode == 'nouser'){
				$this->ajax_error("用户不存在");
			}else{
				$this->ajax_error($this->finance->errorcode);
			}
		}
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