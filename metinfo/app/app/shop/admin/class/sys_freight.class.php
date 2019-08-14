<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_freight');

class sys_freight extends web_freight{
	
	public function get_freight_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_logistics']} WHERE id = '{$id}'";
		$data = DB::get_one($query);
		return $data;
	}
	
	public function get_freight_all(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_logistics']} WHERE lang='{$this->lang}' ORDER BY id DESC";
		$list = DB::get_all($query); 
		return $list;
	}
	
	public function json_freight_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang = '{$this->lang}' {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_logistics'], '*', $where, $order);
		return $data;
	}
	
	public function get_zone_all($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_logistics_zone']} WHERE lid = '{$id}'";
		$data = DB::get_all($query);
		return $data;
	}

	public function json_zone_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = " {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_logistics_zone'], '*', $where, $order);
		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	//后台专门
	public function save_freight($info){
		global $_M;
		$keys = $this->save_freight_key();
		$sql = '';
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				$query = "UPDATE  {$_M['table']['shopv2_logistics']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_logistics']} SET {$sql},lang='{$this->lang}'";
				DB::query($query);
		}
	}
	
	public function del_freight($id){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_logistics']} WHERE id='{$id}'";
		DB::query($query);
		$query = "DELETE FROM {$_M['table']['shopv2_logistics_zone']} WHERE lid='{$id}'";
		DB::query($query);
	}
	
	public function save_freight_key(){
		return array('id', 'name');
	}

	public function save_zone($info){
		global $_M;
		$keys = $this->save_zone_key();
		$sql = '';
		if(isset($info['zone']))$info['zone'] = trim($info['zone'], ',');
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		$query = "INSERT INTO {$_M['table']['shopv2_logistics_zone']} SET {$sql}";
		DB::query($query);
	}
	
	public function del_zone($lid){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_logistics_zone']} WHERE lid='{$lid}'";
		DB::query($query);
	}
	
	public function save_zone_key(){
		return array('id', 'lid', 'zone', 'first', 'freight', 'addp', 'renew');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>