<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class sys_langtxt {
	
	public function get_langtxt_array(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['language']} WHERE app = '10043' and lang='{$_M[lang]}'";
		$data = DB::get_all($query);
		return $data;
	}
	
	public function save_langtxt($form){
		global $_M;
		$langtxt_array = $this->get_langtxt_array();
		foreach($langtxt_array as $val){
			$value = $form[$val['name']];
			if($value){
				if($val['name'] != $value){
					$query = "UPDATE {$_M['table']['language']} SET value='{$value}' WHERE id='{$val['id']}' and app = '10043' and lang='{$_M[lang]}'";
					DB::query($query);
				}
			}
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>