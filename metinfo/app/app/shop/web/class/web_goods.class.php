<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_func('str');

class web_goods {

	public function get_goods_by_pid($pid, $p_table = 0, $p_para = 0, $g_table = 0, $g_para = 0){
		global $_M;
		
		if($p_table == 1){
			$query = "SELECT * FROM {$_M['table']['product']} WHERE id = '{$pid}'";
			$p_data = DB::get_one($query);
		}
		$p_data['id'] = $pid;
		if($g_table == 1){
			$query = "SELECT * FROM {$_M['table']['shopv2_product']} WHERE pid = '{$pid}'";
			$s_data = DB::get_one($query);
		}
		$s_data['id'] = $pid;
		$redata = array_merge($p_data, $s_data);
		if($p_para == 1){
			$redata['p_para'] = '暂未开放查询功能';
		}
		
		if($g_para == 1){
			
		}
		return $redata;
	}
	public function get_plist_by_para($pid, $valuelist){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_plist']} WHERE pid='{$pid}' AND valuelist='{$valuelist}'";
		return DB::get_one($query);
	}
	public function analysis_array($data){
		foreach($data as $key=>$val){
			$data[$key] = $this->analysis($val);
		}
		return $data;
	}
	
	public function analysis($data){
		$data['price_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['price']);
		$data['original_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['original']);

		$paralists = jsondecode($data['paralist']);
		//dump($paralists);
		foreach($paralists as $key=>$val){
			$list = array();
			$list['name'] = $val['value'];
			$list['value'] =  explode(',' , trim($val['valuelist'], ','));
			$data['selectpara'][] = $list;
		}
		$data['purchase'] = $data['purchase'] ? $data['purchase'] : 0;
		$data['prar_select'] = load::own_class('web/class/web_func', 'new')->price_str($data['price']);

		return $data;
	}
	
	public function goods_stock($pid, $para_str, $amount){
		global $_M;
		$query = "UPDATE {$_M['table']['shopv2_product']} SET stock=stock+'{$amount}',sales=sales-'{$amount}' WHERE pid='{$pid}'";
		DB::query($query);
		if($para_str){
			$query = "UPDATE {$_M['table']['shopv2_plist']} SET stock=stock+'{$amount}',sales=sales-'{$amount}' WHERE pid='{$pid}' AND valuelist='{$para_str}'";
			DB::query($query);
		}
		return true;
	}
	
	public function get_sql_table(){
		global $_M;
		$p = $_M['table']['product'];
		$s = $_M['table']['shopv2_product'];
		return $p.' Left JOIN '.$s." ON ({$p}.id = {$s}.pid)";
	}
	
	public function get_sql_search($shopsearch, $type = 1){
		global $_M;
		if($type == 1){
			$sql .= " and searchlist like '%{$shopsearch}%'";
		}else{			
			$shopsearchs = explode('_', $shopsearch);
			$sql = '';
			foreach($shopsearchs as $key=>$val){
				$sql .= " and searchlist like '%{$val}%'";
			}
		}
		return $sql;
	}
	
	public function get_sql_price($pricef,$pricet){
			if($pricef && !$pricet){
				$sql .= " and price <= '{$pricef}'";
			}else if($pricef && $pricet){
				$sql .= " and price >= '{$pricef}' and price <= '{$pricet}'";
			}else if(!$pricef && $pricet){
				$sql .= " and price >= '{$pricet}'";
			}
	}
	
	public function get_sql_order($order){	
		global $_M;
		if(!$order)$order = "sales_desc";
		$orders = explode('_', $order);

		$s = $_M['table']['shopv2_product'];
		if($orders[0] == 'price'){
			if($orders[1] == 'asc'){
				return "top_ok desc,no_order desc,{$s}.price asc,addtime desc,id desc";
			}
			if($orders[1] == 'desc'){
				return "top_ok desc,no_order desc,{$s}.price desc,addtime desc,id desc";
			}
		}
		if($orders[0] == 'sales'){
			if($orders[1] == 'asc'){
				return "top_ok desc,no_order desc,{$s}.sales asc,addtime desc,.id desc";
			}
			if($orders[1] == 'desc'){
				return "top_ok desc,no_order desc,{$s}.sales desc,addtime desc,id desc";
			}
		}
		if($orders[0] == 'time'){
			if($orders[1] == 'asc'){
				return "updatetime asc,id desc";
			}
			if($orders[1] == 'desc'){
				return "updatetime desc,id desc";
			}
		}
		return '';
	}
	
	//产生用户限购商品列表 可传入参数 pid（商品ID） purchase（限购）
	public function purchase_list($data, $uid){
		$uid = $uid ? $uid : get_met_cookie('id');
		$purchase_list = array();
		$self = load::own_class('web/class/web_shop_user', 'new')->get_user_goods_list($uid);
		foreach($data as $key=>$val){
			if(!isset($dlist[$val['pid']])){
				$list = array(); 
				if(!isset($val['purchase'])){
					$goods = $this->get_goods_by_pid($val['pid'], 0, 0, 1, 0);
					$list['purchase'] = $goods['purchase'] ? $goods['purchase'] : 0;
				}else{
					$list['purchase'] = $val['purchase'];
				}
				$list['pid'] = $val['pid'];
				$dlist[$val['pid']] = $list;
			}
		}
		foreach($dlist as $key=>$val){		
			if($val['purchase'] == 0){
				$purchase_list[$val['pid']] = '999999999';
			}else{
				$val['purchase'] = $val['purchase'] - $self[$val['pid']];
				$purchase_list[$val['pid']] = $val['purchase'];
			}

		}
		return $purchase_list;
	}
	//产生商品是否可以购买数组 data(pid para_str amount)goods web_goods->get_goods_by_pid数据
	public function stock_list_array($data, $goods){
		$list = array();
		foreach($data as $key=>$val){
			$list[$key] = $this->stock_list($val, $goods[$key]);
		}
		return $list;
	}
	
	public function stock_list($data, $goods){

		$list = array(); 
		if(!$goods){
			$goods = $this->get_goods_by_pid($data['pid'], 0, 0, 1, 0);
			$list['stock'] = $goods['stock'] ? $goods['stock'] : 0;
		}else{
			$list['stock'] = $goods['stock'];
		}
		if($data['para_str'] || ($goods['paralist'] && $goods['paralist']!='{}')){
			$para = load::own_class('web/class/web_goods', 'new')->get_plist_by_para($data['pid'], $data['para_str']);
			$list['stock'] = $para['stock'] ? $para['stock'] : 0;
		}else{
			$list['stock']= $goods['stock'];
		}
		$list['stock'] = $list['stock'] ? $list['stock'] : 0;
		if($data['amount'] - $list['stock'] > 0 || $list['stock'] <= 0){
			$list['buy_ok'] = 0;
		}else{
			$list['buy_ok'] = 1;
		}
		$list['pid'] = $data['pid'];

		return $list;
	}
	
	public function get_show_product_url($pid, $class1){
		global $_M;
		if(!$this->clounm){
			$query = "SELECT * FROM {$_M['table']['column']} WHERE module = 3";
			$clounm = DB::get_all($query);
			foreach($clounm as $key=>$val){
				$this->clounm[$val['id']] = $val['foldername'];
			}
		}
		return "{$_M['url']['site']}{$this->clounm[$class1]}/showproduct.php?lang={$_M['lang']}&id={$pid}";
	}
	
	public function get_plist_list($pid){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_plist']} WHERE pid='{$pid}'";
		return DB::get_all($query);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>