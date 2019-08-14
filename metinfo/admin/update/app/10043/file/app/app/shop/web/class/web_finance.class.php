<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_finance {

	public $lang;
	public $errorcode;
	
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	
	public function get_finance_list($where, $order, $limit_start, $limit_num){
		global $_M;
		$where = "lang = '{$this->lang}' {$where}";
		return DB::get_data($_M['table']['shopv2_finance'], $where, $order, $limit_start, $limit_num);
	}
	
	public function get_finance_total($where){
		global $_M;
		$where = "lang = '{$this->lang}' {$where}";
		return DB::counter($_M['table']['shopv2_finance'], $where);
	}
	
	public function json_finance_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang = '{$this->lang}' {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_finance'], '*', $where, $order);
		$data = $this->analysis_array($data);
		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function get_finance_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_finance']} WHERE pid = '{$pid}'";
		$data = DB::get_one($query);
		return $data;
	}
	
	public function analysis_array($data){
		foreach($data as $key=>$val){
			$data[$key] = $this->analysis($val);
		}
		return $data;
	}
	
	public function analysis($data){
		$para = $this->para('type');
		$data['type_str'] = $para[$data['type']];
		if($data['type'] == 1){
			$data['price_str'] = '+'.load::own_class('web/class/web_func', 'new')->price_str($data['price']);
		}else{
			$data['price_str'] = '-'.load::own_class('web/class/web_func', 'new')->price_str($data['price']);
		}
		$data['balance_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['balance']);
		/*
		if(str_length($data['reason'], 1) >100){
			$data['reason_html'] = strcut($data['reason'], 0, 100)."...<a class=\"detailed\" data-info=\"{$data['reason']}\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\" href=\"#\">详细</a>";
		}else{
			$data['reason_html'] = $data['reason'];
		}*/
		$data['reason_html'] = $data['reason'];
		$data['addtime_str'] = date("Y-m-d H:i:s" ,$data['addtime']);
		return $data;
	}
	
	public function para($para){
		if($para == 'type'){
			return array(1=>'入款', 2=>'扣款');
		}
	}
	
	public function addfinance($type, $username, $price, $reason){
		global $_M;
		$addtime = time();
		$adminuesr = $this->get_op_user();
		$user = load::sys_class('user', 'new')->get_user_by_username($username);
		$uid = $user['id'];
		/*
		if(defined('IN_ADMIN')){
			$adminuesr = get_met_cookie('metinfo_admin_name');
		}else{
			$adminuesr = 'system';
		}	
		*/
		$shop_user = load::own_class('web/class/web_shop_user', 'new');
		$balance = $shop_user->modify_user_balance($type, $username, $price);
		if($balance !== false){
			$query = "INSERT INTO {$_M['table']['shopv2_finance']} SET uid='{$uid}',username='{$username}',type='{$type}',reason='{$reason}',price='{$price}',balance='{$balance}',addtime='{$addtime}',adminname='{$adminuesr}',lang='{$this->lang}'";
			DB::query($query);
			return true;
		}else{
			$this->errorcode = $shop_user->errorcode;
			return false;
		}
	}
	
	public function get_op_user(){
		return 'system';
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>