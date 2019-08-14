<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_discount{
	public $lang;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	
	public function get_discount_by_uid($uid){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_discount_coupon']} WHERE uid = '{$uid}'";
		$data = DB::get_all($query);
		$re = array();
		foreach($data as $key=>$val){
			$d = $this->get_discount_by_id($val['did']);
			$re[] = array_merge($d, $val);
		}
		return $re;
	}
	
	public function get_discount_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_discount']} WHERE id = '{$id}'";
		$data = DB::get_one($query);
		return $data;
	}
	
	public function get_coupon_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_discount_coupon']} WHERE id = '{$id}'";
		$data = DB::get_one($query);
		$re = array();
		$d = $this->get_discount_by_id($data['did']);
		$re = array_merge($d, $data);
		return $re;
	}
	
	public function discount_uese($id){
		$info['id'] = $id;
		$info['usetime'] = time();
		$this->save_coupon($info);
		return true;
	}
	
	public function is_ues_discount($uid, $discount, $goods){
			if($discount['uid'] != $uid){
				return false;
			}
			if($discount['usetime']){
				return false;
			}
			if(time() < $discount['s_time'] || time() > $discount['e_time']){
				return false;
			}
			$t = 0;
			$ues_goods = 0;
			if($discount['all_goods'] == 0){
				$ues_goods = '';
			}else{
				$ues_goods = ','.$discount['goods_list'].',';
			}	
			foreach($goods as $keygoods=>$valgoods){
				if($ues_goods == '' || strpos($ues_goods, ','.$valgoods['id'].',')){
					if($valgoods['user_discount'] != 1)$t += $valgoods['amount'] * $valgoods['price'];
				}
			}
			if($t < $discount['par']){
				return false;
			}
			return true;
	}

	public function save_discount($info){
		global $_M;
		$keys = $this->save_discount_key();
		$sql = '';
		$info['type'] = 1;
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				$query = "UPDATE  {$_M['table']['shopv2_discount']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_discount']} SET {$sql},lang='{$this->lang}'";
				DB::query($query);
		}
	}
	
	public function save_discount_key(){
		return array('id', 'name', 'type', 'par', 'r_price', 's_time', 'e_time', 'amount', 'one_user_have', 'ugid', 'all_goods', 'goods_list', 'instructions');
	}
	
	public function analysis_array($data){
		foreach($data as $key=>$val){
			$data[$key] = $this->analysis($val);
		}
		return $data;
	}
	
	public function analysis($data){
		global $_M;
		$data['s_time_str'] = date('Y-m-d H:i', $data['s_time']);
		$data['e_time_str'] = date('Y-m-d H:i', $data['e_time']);
		
		$data['par_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['par']);
		$data['r_price_str'] = load::own_class('web/class/web_func', 'new')->price_str($data['r_price']);
		
		if(!defined('IN_ADMIN')){
			if($data['ugid'] == 0){
				$data['ugid_str'] = "所有会员";
			}else{
				$group = load::sys_class('group', 'new')->get_group_list();
				$data['ugid_str'] = "{$group[$data['ugid']]['name']}以上可以领取";
			}
			if($data['all_goods']){
				$data['plist_str'] = "所有可以享受会员折扣商品";
			}else{
				$p = explode(',', $data['goods_list']);
				$p_t = "<ul class=\"discount-plist dropdown-menu\" role=\"menu\" aria-labelledby=\"tutorial\">";
				$goods_class = load::own_class('web/class/web_goods', 'new');
				foreach($p as $key=>$val){
					if($val){
						$goods = load::own_class('web/class/web_goods', 'new')->get_goods_by_pid($val, 1, 0, 0, 0);
						$p_t .= '<li><a target="_blank" href="'.$goods_class->get_show_product_url($goods['id'], $goods['class1']).'">'.$goods['title'].'</a></li>';
					}
					
				}
				$p_t .= "</ul>";
				$data['plist_str'] = $p_t;
			}
		}
		return $data;
	}
	
	public function save_coupon($info){
		global $_M;
		$keys = $this->save_coupon_key();
		$sql = '';
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				$query = "UPDATE  {$_M['table']['shopv2_discount_coupon']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
			if($info['uid'] && $info['did']){
				$query = "INSERT INTO {$_M['table']['shopv2_discount_coupon']} SET {$sql}";
				echo $query;
				DB::query($query);
			}
		}
	}
	
	public function save_coupon_key(){
		return array('did', 'uid', 'usetime', 'receivetime');
	}
	
	public function is_receive($did, $uid){
		global $_M;
		$discount = $this->get_discount_by_id($did);
		if(!$uid){
			return false;
		}
		if($discount){
			if($discount['receive'] >= $discount['amount']){
				return false;
			}
			if(time() < $discount['s_time'] || time() > $discount['e_time']){
				return false;
			}
			if($discount['one_user_have'] != 0){ 
				$query = "SELECT * FROM {$_M['table']['shopv2_discount_coupon']} WHERE uid = '{$uid}' AND did = '{$did}'";
				$c = DB::get_all($query);
				if(count($c) >= $discount['one_user_have']){
					return false;
				}
			}
		}else{
			return false;
		}
		return true;
		
	}
	public function receive($did, $uid){
		global $_M;
		if($this->is_receive($did, $uid)){
			$query = "UPDATE {$_M['table']['shopv2_discount']} SET `receive` = `receive` + 1 WHERE id='{$did}' AND `amount` > `receive` + 1";
			DB::query($query);
			if(DB::affected_rows() > 0){
				$info['did'] = $did;
				$info['uid'] = $uid;
				$info['usetime'] = 0;
				$info['receivetime'] = time();
				$this->save_coupon($info);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>