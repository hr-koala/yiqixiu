<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_discount');

class sys_discount extends web_discount{
	
	public function json_discount_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang = '{$this->lang}' {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_discount'], '*', $where, $order);
		$data = $this->analysis_array($data);
		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	

	public function is_discount_goods($id, $idlist){
		if(is_strinclude(','.$idlist.',', ','.$id.',')){
			return true;
		}else{
			return false;
		}
	}
	
	public function del_discount($id){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_discount']} WHERE id = '{$id}'";
		$data = DB::query($query);
		$query = "DELETE FROM {$_M['table']['shopv2_discount_coupon']} WHERE did = '{$id}'";
		$data = DB::query($query);
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>