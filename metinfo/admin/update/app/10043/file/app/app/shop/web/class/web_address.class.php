<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_address {

	public $lang;
	
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
		$this->user = get_met_cookie('id');
	}
	
	public function save_address($info){
		global $_M;
		$keys = $this->save_address_key();
		$sql = '';
		foreach($keys as $key=>$val){
			if(isset($info[$val]))$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		$uid = get_met_cookie('id');
		if($info['id'] && is_numeric($info['id'])){
				$query = "UPDATE {$_M['table']['shopv2_address']} SET {$sql} WHERE id='{$info['id']}' AND uid='{$uid}'";
				DB::query($query);
				if($info['de'] == 1){
					$query = "UPDATE {$_M['table']['shopv2_address']} SET de=0 WHERE id!='{$info['id']}' AND uid='{$uid}'";
					DB::query($query);
				}
		} else {

				$query = "INSERT INTO {$_M['table']['shopv2_address']} SET {$sql},uid='{$uid}',lang = '{$this->lang}'";
				DB::query($query);
				$inid = DB::insert_id();
				if(DB::counter($_M['table']['shopv2_address'], "uid ='{$uid}' AND lang = '{$this->lang}'", "*") == 1){
					$query = "UPDATE {$_M['table']['shopv2_address']} SET de = 1 WHERE id='{$inid}' AND uid='{$uid}'";
					DB::query($query);
				}

		}

	}
	
	public function save_address_key(){
		return array('de','name','zone_p','zone_c','zone_d','zone_a','tel','fixed','email');
	}
	
	public function get_address_by_uid($uid){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_address']} WHERE uid = '{$uid}' AND lang='{$this->lang}' ORDER BY de DESC,id DESC";
		return DB::get_all($query);
	}
	public function get_address_by_id($id){
		global $_M;
		$uid = get_met_cookie('id');
		$query = "SELECT * FROM {$_M['table']['shopv2_address']} WHERE id='{$id}' AND uid = '{$uid}' AND lang='{$this->lang}' ORDER BY de DESC,id DESC";
		return DB::get_one($query);
	}
	
	public function del_address($id){
		global $_M;
		$uid = get_met_cookie('id');
		$del = $this->get_address_by_id($id);
		if($del && $del['de'] == 1){
			$attr = $this->get_address_by_uid($uid);
			if($attr[1]['id']){
				$attr[1]['de'] = 1; 
				$this->save_address($attr);
			}
		}
		$query = "DELETE FROM {$_M['table']['shopv2_address']} WHERE id='{$id}' AND uid='{$uid}'";
		DB::query($query);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>