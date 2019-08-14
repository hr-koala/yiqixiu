<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_func('array');

class web_cart {

	public $lang;
	public $user;
	public $action;
	
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
		$this->user = get_met_cookie('id');
		
	}
	
	public function json_cart_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang = '{$this->lang}' {$where}";
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} WHERE {$where} {$order}";
		$data = DB::get_all($query);
		$data = $this->analysis_array($data);
		return $data;
	}
	
	public function cart_list(){
		global $_M;
		$where = "WHERE lang = '{$this->lang}' AND uid = '{$this->user}'";
		if(!$order)$order = "ORDER BY id ASC";
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} {$where} {$order}";
		return DB::get_all($query);
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function analysis_array($data){
		foreach($data as $key=>$val){
			$data[$key] = $this->analysis($val);
		}
		return $data;
	}
	
	public function analysis($data){
		global $_M;
		$goods = load::own_class('web/class/web_goods', 'new')->get_goods_by_pid($data['pid'], 1, 0, 1, 0);
		$data['purchase'] = $goods['purchase'] ? $goods['purchase'] : 0;
		$data['freight'] = $goods['freight'] ;
		$data['lnvoice'] = $goods['lnvoice'] ;
		$data['freight_mould'] = $goods['freight_mould'] ;
		$data['img'] = $_M['url']['site'].str_replace('../', '', $goods['imgurls']);
		$data['name'] = $goods['title'];
		//临时处理URL
		$data['url'] = load::own_class('web/class/web_goods', 'new')->get_show_product_url($data['pid'], $goods['class1']);
		
		if($data['para_str']){
			$plist = load::own_class('web/class/web_goods', 'new')->get_plist_by_para($data['pid'], $data['para_str']);
			$data['price'] = $plist['price'];
		}else{
			$data['price'] = $goods['price'];
		
		}
		$data['price_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['price']);

		$data['subtotal'] =load::own_class('web/class/web_func', 'new')->price_str($data['price'] * $data['amount']);
		$data['logistic'] = $goods['logistic'];

		$info['pid'] = $data['pid'];
		$info['para_str'] = $data['para_str'];
		$info['amount'] = $data['amount'];
		$stock = load::own_class('web/class/web_goods', 'new')->stock_list($info, $goods);
		$data['buy_ok'] = $stock['buy_ok'];
		$data['stock'] = $stock['stock'];
		$message = $goods['message'] ? jsondecode($goods['message']) : '';
		$data['message'] = $message;
		$data['message_html'] = '<div class="p-message form-horizontal">';
		foreach($message as $key=>$val){
			$val['required'] = $val['required']?'required':'';
			if($val['line']){
				$data['message_html'] .= "
					<div class=\"form-group\">
						<div class=\"col-sm-12 {$val['required']}\">
							<textarea class=\"form-control\" rows=\"3\" name=\"msg_{$data['id']}_{$goods['pid']}_{$key}\" placeholder=\"{$val[name]}\"></textarea>
						</div>
					</div>";
			}else{
				$data['message_html'] .= "
				<div class=\"form-group\">
					<div class=\"col-sm-12 {$val['required']}\">
						<input placeholder=\"{$val[name]}\" class=\"form-control\" name=\"msg_{$data['id']}_{$goods['pid']}_{$key}\">
					</div>
				</div>";
			}
		}
		$data['message_html'] .= '</div>';
		return $data;
	}
	
	public function save_cart($info){
		global $_M;
		$keys = $this->save_cart_key();
		$sql = '';
		
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				$query = "UPDATE  {$_M['table']['shopv2_cart']} SET {$sql} WHERE id='{$info['id']}' AND uid = '{$this->user}'";
				DB::query($query);
				return $info['id'];
		} else {
				if($info['amount'] && $info['pid']){
					$query = "INSERT INTO {$_M['table']['shopv2_cart']} SET {$sql},uid = '{$this->user}',lang = '{$this->lang}'";
					DB::query($query);
					return DB::insert_id();
				}
		}
	}

	public function save_cart_key(){
		return array('para_str', 'amount', 'pid');
	}
		
	public function del_cart($id){
		global $_M;
		$query = "DELETE  FROM {$_M['table']['shopv2_cart']} WHERE id = '{$id}'";
		return DB::query($query);
	}
	
	public function get_cart_by_pid($pid, $para_str){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} WHERE pid = '{$pid}' AND para_str = '{$para_str}' AND uid = '{$this->user}' AND lang = '{$this->lang}'";
		return DB::get_one($query);
	}
	
	public function get_cart_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} WHERE id = '{$id}' AND uid = '{$this->user}' AND lang = '{$this->lang}'";
		return DB::get_one($query);
	}
	
	public function tocrat($pid, $para_str, $amount){
		if($amount < 0){
			$amount = 1;
		}
		$goods = $this->get_cart_by_pid($pid, $para_str);
		if($goods){
			$info['id'] = $goods['id'];
			$info['amount'] = $amount + $goods['amount'];
			return $this->save_cart($info);
		}else{
			$info['pid'] = $pid;
			$info['para_str'] = $para_str;
			$info['amount'] = $amount;
			return $this->save_cart($info);
		}

	}
	
	public function clear_cart(){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_cart']} WHERE uid = '{$this->user}' AND lang = '{$this->lang}'";
		return DB::get_one($query);
	}
	/*
	public function get_g_by_user(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} WHERE uid = '{$this->user}'";
		return DB::get_all($query);
	}
	
	public function get_g_by_pid($pid, $para_str){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_cart']} WHERE pid = '{$pid}' AND para_str = '{$para_str}' AND uid = '{$this->user}' AND lang = '{$this->lang}'";
		return DB::get_one($query);
	}
	
	public function tocrat($pid, $para_str, $amount){
		global $_M;
		$c = $this->get_g_by_pid($pid);
		if($c){
			$this->set_g($c['id'], $c['amount'] + $amount);
		}else{
			$this->in_g($pid, $para_str, $amount);
		}
		return true;
	}
	
	public function in_g($pid, $para_str, $amount){
		global $_M;
		$query = "INSERT INTO {$_M['table']['shopv2_cart']} SET pid = '{$pid}',para_str = '{$para_str}',amount = '{$amount}',uid = '{$this->user}',lang = '{$this->lang}'";
		return DB::query($query);
	}
	
	public function set_g($id, $amount){
		global $_M;
		$query = "UPDATE {$_M['table']['shopv2_cart']} SET amount = '{$amount}' WHERE id = '{$id}'";
		return DB::query($query);
	}
	
	public function add_g($id, $amount){
		global $_M;
		$query = "UPDATE {$_M['table']['shopv2_cart']} amount = amount+{$amount} WHERE id = '{$id}'";
		return DB::query($query);
	}
	
	public function reduce_g($id, $amount){
		global $_M;
		$query = "UPDATE {$_M['table']['shopv2_cart']} amount = amount-{$amount} WHERE id = '{$id}'";
		return DB::query($query);
	}
	

	*/
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>