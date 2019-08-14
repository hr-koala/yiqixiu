<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_searchlist');

class sys_searchlist extends web_searchlist{
	public $lang;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	
	public function order_searchlist($ids){
		global $_M;
		$order = 1;
		foreach($ids as $key=>$val){
			$info['id'] = $val;
			$info['no_order'] = $order;
			$this->save_searchlist($info);

			
			$order++;
		}
	}
	
	public function order_searchlist_tag($sid, $ids){
		global $_M;
		$order = 1;
		foreach($ids as $key=>$val){
			$info['id'] = $val;
			$info['no_order'] = $order;
			$info['sid'] = $sid;
			$this->save_searchlist_tag($info);
			$order++;
		}
	}
		
	public function json_searchlist_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang = '{$this->lang}' {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_searchlist'], '*', $where, $order);
		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function get_searchlist_order(){
		global $_M;
		$query = "SELECT max(no_order) FROM {$_M['table']['shopv2_searchlist']}";
		$max = DB::get_one($query);
		if($max['max(no_order)']){
			return $max['max(no_order)'];
		}else{
			return 0;
		}
	}
	
	public function save_searchlist($info){
		global $_M;
		$keys = $this->save_searchlist_key();
		$sql = '';
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if(array_key_exists('id', $info)){
				$query = "UPDATE  {$_M['table']['shopv2_searchlist']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_searchlist']} SET {$sql},lang='{$this->lang}'";
				DB::query($query);
				return DB::insert_id();
		}
	}
	
	public function del_searchlist($id){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_searchlist']} WHERE id='{$id}'";
		DB::query($query);
		$query = "DELETE FROM {$_M['table']['shopv2_searchlist_tag']} WHERE sid='{$id}'";
		DB::query($query);
	}
	
	public function save_searchlist_key(){
		return array('id', 'no_order', 'name');
	}
	
	public function get_searchlist_onetag($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_searchlist_tag']} WHERE id='{$id}' order by no_order ASC";
		return DB::get_one($query);
	}
	
	public function get_searchlist_tag_order($sid){
		global $_M;
		$query = "SELECT max(no_order) FROM {$_M['table']['shopv2_searchlist_tag']} WHERE sid='{$sid}'";
		$max = DB::get_one($query);
		if($max['max(no_order)']){
			return $max['max(no_order)'];
		}else{
			return 0;
		}
	}
	
	public function save_searchlist_tag($info){
		global $_M;
		$keys = $this->save_searchlist_key_tag();
		$sql = '';
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if(array_key_exists('id', $info)){
				$query = "UPDATE  {$_M['table']['shopv2_searchlist_tag']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_searchlist_tag']} SET {$sql}";
				DB::query($query);
				return DB::insert_id();
		}
	}
	
	public function del_searchlist_tag($id){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_searchlist_tag']} WHERE id='{$id}'";
		DB::query($query);
	}
	
	public function save_searchlist_key_tag(){
		return array('id', 'no_order', 'name', 'sid', 'title', 'keywords', 'description', 'url');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>