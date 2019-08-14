<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_shop_user {
	public $errorcode;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	
	public function modify_user_balance($type, $username, $price){
		global $_M;
		$shop_user = $this->get_user_by_username($username);
		if(!$shop_user){
			$this->errorcode = 'nouser';
			return false;
		}
		if($type == 1){
			$shop_user['balance'] = $shop_user['balance'] + $price;
		}else{
			if($shop_user['balance'] >= $price){
				$shop_user['balance'] = $shop_user['balance'] - $price;
			}else{
				$this->errorcode = 'nobalance';
				return false;
			}
		}
		$query = "UPDATE {$_M['table']['shopv2_user']} SET balance='{$shop_user['balance']}' WHERE username='{$username}'";
		DB::query($query);
		return $shop_user['balance'];
	}
	
	public function change_goods_list($uid, $goods){
		global $_M;
		$shop_user = $this->get_user_by_uid($uid);
		$cart_list = array();
		foreach($goods as $key=>$val){
			$cart_list[$val['pid']] += $val['pamount'];
		}
		$goods_list = jsondecode($shop_user['goods_list']);
		foreach($cart_list as $key=>$val){
			$goods_list[$key] = $goods_list[$key] + $val;
		}
		if($goods_list)$goods_string = jsonencode($goods_list);
		
		$query = "UPDATE {$_M['table']['shopv2_user']} SET goods_list='{$goods_string}' WHERE uid='{$uid}'";
		DB::query($query);
	}
	
	public function get_user_goods_list($uid){
		global $_M;
		$shop_user = $this->get_user_by_uid($uid);
		return jsondecode($shop_user['goods_list']);
	}
	
	public function get_user_by_username($username){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_user']} WHERE username='{$username}'";
		$shop_user = DB::get_one($query);
		if(!$shop_user){
			$user = load::sys_class('user', 'new')->get_user_by_username($username);
			if($user){
				$query = "INSERT INTO {$_M['table']['shopv2_user']} SET uid='{$user[id]}',username='{$username}',balance='0'";
				DB::query($query);
				$shop_user['uid'] = $user['id'];
				$shop_user['username'] = $username;
				$shop_user['goods_list'] = '';
				$shop_user['balance'] = 0;
			}else{
				$this->errorcode = 'nouser';
				return false;
			}
		}
		return $shop_user;
	}
	
	public function get_user_by_uid($uid){
		$query = "SELECT * FROM {$_M['table']['shopv2_user']} WHERE uid='{$uid}'";
		$shop_user = DB::get_one($query);
		if(!$shop_user){
			$user = load::sys_class('user', 'new')->get_user_by_id($uid);
			if($user){
				$query = "INSERT INTO {$_M['table']['shopv2_user']} SET uid='{$user[id]}',username='{$username}',balance='0'";
				DB::query($query);
				$shop_user['uid'] = $user['id'];
				$shop_user['username'] = $username;
				$shop_user['goods_list'] = '';
				$shop_user['balance'] = 0;
			}else{
				$this->errorcode = 'nouser';
				return false;
			}
		}
		return $shop_user;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>