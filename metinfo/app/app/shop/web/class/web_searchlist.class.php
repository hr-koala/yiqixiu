<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_searchlist{
	public $lang;
	
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}	
	
	public function get_searchlist_by_id($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_searchlist']} WHERE id = '{$id}'";
		$data = DB::get_one($query);
		$data['tag'] = $this->get_searchlist_tag($data['id']);
		return $data;
	}
	
	public function get_searchlist_all(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_searchlist']} WHERE lang='{$this->lang}' order by no_order ASC";
		$list = DB::get_all($query); 
		foreach($list as $key=>$val){
			$list[$key]['tag'] = $this->get_searchlist_tag($val['id']);
		}
		return $list;
	}
	
	public function get_searchlist_tag($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_searchlist_tag']} WHERE sid='{$id}' order by no_order ASC";
		return DB::get_all($query);
	}
	
	public function get_searchlist_array($searchlist = '', $class1 = '', $class2 = '', $class3 = ''){
		global $_M;
		$data = $this->get_searchlist_all();
		
		foreach($data as $keydata=>$val){
			$tag = '';
			foreach($val['tag'] as $key=>$valtag){
				$tag .= "{$valtag['name']}|"; 
			}
			$data[$keydata]['value'] = trim($tag, '|');
		}
		

		//$query = "SELECT * FROM {$_M['table']['shopv2_searchlist']} WHERE lang='{$this->lang}' ORDER BY no_order ASC,id DESC";
		//$data = DB::get_all($query);
				
		$searchlisttmp = explode('_', $searchlist);
		
		foreach($data as $key=>$val){
			
			foreach($searchlisttmp as $skey=>$sval){
				$list = array();
				if(is_strinclude("|{$val['value']}|", "|{$sval}|")){
					$list[] = $val['id'];
					$list[] = $sval;
					$searchlists[] = $list;
				}
			}
			
		}

		foreach($data as $key=>$val){
			$list = array();
			$list['name'] = $val['name'];
			$para = $val['tag'];
			$deparalist['info'] = "全部"; 
			$all = $this->searchlist($searchlists, $val['id'], "");
			if($all){
				$deparalist['url'] = $_M['url']['shop_searchlist']."".$all;
			}else{
				$deparalist['url'] = $_M['url']['product'];
			}
			$list['para'][] = $deparalist;
			foreach($para as $keypara => $valpara){
				$paralist = array();
				
				$paralist['info'] = $valpara['name'];
				$paralist['url'] = $_M['url']['shop_searchlist']."".$this->searchlist($searchlists, $val['id'], $valpara['name']);
				$paralist['class'] = $this->classlist($searchlists, $val['id'], $valpara['name']);
				
				$paralist['title'] = $valpara['title'];
				$paralist['keywords'] = $valpara['keywords'];
				$paralist['description'] = $valpara['description'];
				$paralist['urlsearch'] = $valpara['url'];
				$list['para'][] = $paralist;
			}
			$redata[] = $list;
		}
		return $redata;
	}
	
	protected function searchlist($id_list, $self_id, $self_str){
		$str = '';
		foreach($id_list as $key=>$val){
			if($val[0] != $self_id && $val[0]){
				if($val[0])$str .= "{$val[1]}_";
			}
		}
		if($self_str)$str .= "{$self_str}_";
		$str = trim($str, '_');
		return $str;
	}
	
	protected function searchlist2($id_list, $self_id, $self_str){
		$str = '';
		foreach($id_list as $key=>$val){
			if($val[0] != $self_id && $val[0]){
				if($val[0])$str .= "{$val[0]}_{$val[1]}|";
			}
		}
		if($self_str)$str .= "{$self_id}_{$self_str}|";
		$str = trim($str, '|');
		return $str;
	}
	
	protected function classlist($id_list, $self_id, $self_str){
		foreach($id_list as $key=>$val){
			if($val[0] == $self_id && $val[1] == $self_str){
				return "pcurr";
			}
		}
		return "";
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>