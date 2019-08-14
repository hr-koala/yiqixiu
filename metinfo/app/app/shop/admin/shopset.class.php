<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class shopset extends admin {

	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		nav::select_nav(5);
	}

	public function doindex(){
		global $_M;
		$openchecked = $_M['config']['shopv2_open']==1?'checked':'';
		$gichecked = $_M['config']['shopv2_gi']==1?'checked':'';
		
		$auto_close_checked = $_M['config']['shopv2_order_auto_close']==1?'checked':'';
		$auto_ok_checked = $_M['config']['shopv2_order_auto_ok']==1?'checked':'';
		$auto_del_checked = $_M['config']['shopv2_order_auto_del']==1?'checked':'';
		//$vatchecked = $_M['config']['shopv2_vat']==1?'checked':'';
		require_once $this->template('own/shopset');
	}	
	
	public function dosetpay(){
		global $_M;
		$onlinechecked = $_M['config']['shopv2_onlinepay']==1?'checked':'';
		$deliverychecked = $_M['config']['shopv2_deliverypay']==1?'checked':'';
		require_once $this->template('own/setsetpay');
	}
	
	public function dolangtxt(){
		global $_M;
		$langtxtarray = load::own_class('admin/class/sys_langtxt', 'new')->get_langtxt_array();
		require_once $this->template('own/setlangtxt');
	}
	
	public function dolangtxtsave(){
		global $_M;
		load::own_class('admin/class/sys_langtxt', 'new')->save_langtxt($_M['form']);
		$this->ajax_success('保存成功');
	}
	
	public function dosetremind_admin(){
		global $_M;
		nav::set_nav(6, '提醒设置', "{$_M['url']['own_form']}a=dosetremind");
		nav::select_nav(6);
		require_once $this->template('own/setremind_admin');
	}
	
	public function dosetremind_user(){
		global $_M;
		nav::set_nav(6, '提醒设置', "{$_M['url']['own_form']}a=dosetremind");
		nav::select_nav(6);
		$is_uemailv1 = $_M['config']['shopv2_is_uemailv1']==1?'checked':'';
		$is_uemailv2 = $_M['config']['shopv2_is_uemailv2']==1?'checked':'';
		$is_uemailv3 = $_M['config']['shopv2_is_uemailv3']==1?'checked':'';
		$is_usmsv1 = $_M['config']['shopv2_is_usmsv1']==1?'checked':'';
		$is_usmsv2 = $_M['config']['shopv2_is_usmsv2']==1?'checked':'';
		$is_usmsv3 = $_M['config']['shopv2_is_usmsv3']==1?'checked':'';
		require_once $this->template('own/setremind_user');
	}
	
	
	public function doeditor(){
		global $_M;
		$a = '';
		if($_M['form']['action'] == 'pay'){
			$configlist = array();
			$_M['form']['shopv2_onlinepay'] 	= $_M['form']['shopv2_onlinepay']?$_M['form']['shopv2_onlinepay']:0;
			$_M['form']['shopv2_deliverypay'] 	= $_M['form']['shopv2_deliverypay']?$_M['form']['shopv2_deliverypay']:0;
			$configlist[] = 'shopv2_onlinepay';
			$configlist[] = 'shopv2_deliverypay';
		}
		
		if($_M['form']['action'] == 'remind_admin'){
			$configlist = array();
			$configlist[] = 'shopv2_adminemail';
			$configlist[] = 'shopv2_admintel';
		}

		if($_M['form']['action'] == 'dosetremind_user'){
			$configlist = array();
			if($_M['form']['shopv2_is_uemailv1'] != 1)$_M['form']['shopv2_is_uemailv1'] = 0;
			if($_M['form']['shopv2_is_uemailv2'] != 1)$_M['form']['shopv2_is_uemailv2'] = 0;
			if($_M['form']['shopv2_is_uemailv3'] != 1)$_M['form']['shopv2_is_uemailv3'] = 0;
			if($_M['form']['shopv2_is_usmsv1'] != 1)$_M['form']['shopv2_is_usmsv1'] = 0;
			if($_M['form']['shopv2_is_usmsv2'] != 1)$_M['form']['shopv2_is_usmsv2'] = 0;
			if($_M['form']['shopv2_is_usmsv3'] != 1)$_M['form']['shopv2_is_usmsv3'] = 0;
			
			$configlist[] = 'shopv2_is_uemailv1';
			$configlist[] = 'shopv2_is_uemailv2';
			$configlist[] = 'shopv2_is_uemailv3';
			$configlist[] = 'shopv2_is_usmsv1';
			$configlist[] = 'shopv2_is_usmsv2';
			$configlist[] = 'shopv2_is_usmsv3';
			
			$configlist[] = 'shopv2_usmsv1';
			$configlist[] = 'shopv2_uemailtv1';
			$configlist[] = 'shopv2_uemailcv1';
			$configlist[] = 'shopv2_usmsv2';
			$configlist[] = 'shopv2_uemailtv2';
			$configlist[] = 'shopv2_uemailcv2';
			$configlist[] = 'shopv2_usmsv3';
			$configlist[] = 'shopv2_uemailtv3';
			$configlist[] = 'shopv2_uemailcv3';
		}
		
		if($_M['form']['action'] == 'set'){
			$configlist = array();
			$configlist[] = 'shopv2_open';
			$configlist[] = 'shopv2_order_end';
			if($_M['form']['shopv2_open'] == 1){
				$query = "UPDATE {$_M['table']['app_plugin']} SET effect=1 WHERE m_name = 'shop'";
				DB::query($query);
				$query = "SELECT * FROM {$_M['table']['product']} WHERE lang='{$_M['lang']}'";
				$result = DB::query($query);
				while($list = DB::fetch_array($result)){
					if(!load::own_class('admin/class/sys_goods', 'new')->get_product($list['id'])){
						load::own_class('admin/class/sys_goods', 'new')->insert_product_sql($list['id'],'',0,0,1,0,0,0,0,0,'',1,0);
					}
				}
			}else{
				$_M['form']['shopv2_open'] = 0;
				$query = "UPDATE {$_M['table']['app_plugin']} SET effect=1 WHERE m_name = 'shop'";
				DB::query($query);
			}
			
			
			$_M['form']['shopv2_gi'] 		= $_M['form']['shopv2_gi']?$_M['form']['shopv2_gi']:0;
			//$_M['form']['shopv2_vat'] 		= $_M['form']['shopv2_vat']?$_M['form']['shopv2_vat']:0;
			$_M['form']['shopv2_invoice'] 	= str_replace(" ","",$_M['form']['shopv2_invoice']);
			$configlist[] = 'shopv2_gi';
			$configlist[] = 'shopv2_vat';
			$configlist[] = 'shopv2_ei';
			$configlist[] = 'shopv2_invoice';
			/*
			$configlist[] = 'shopv2_invoice_freight_type';
			$_M['form']['shopv2_invoice_freight_type'] = $_M['form']['freight_type'];
			$configlist[] = 'shopv2_invoice_freight';
			$_M['form']['shopv2_invoice_freight'] = $_M['form']['freight'];
			$configlist[] = 'shopv2_invoice_freight_mould';
			$_M['form']['shopv2_invoice_freight_mould'] = $_M['form']['freight_mould'];
			*/
			$_M['form']['shopv2_order_auto_close'] 	= $_M['form']['shopv2_order_auto_close']?$_M['form']['shopv2_order_auto_close']:0;
			$_M['form']['shopv2_order_auto_ok'] 	= $_M['form']['shopv2_order_auto_ok']?$_M['form']['shopv2_order_auto_ok']:0;
			$_M['form']['shopv2_order_auto_del'] 	= $_M['form']['shopv2_order_auto_del']?$_M['form']['shopv2_order_auto_del']:0;

			$configlist[] = 'shopv2_order_auto_close';
			$configlist[] = 'shopv2_order_auto_close_time';
			$configlist[] = 'shopv2_order_auto_ok';
			$configlist[] = 'shopv2_order_auto_ok_time';
			$configlist[] = 'shopv2_order_auto_del';
			$configlist[] = 'shopv2_order_del_ok_time';
			$configlist[] = 'shopv2_price_str_prefix';
			$configlist[] = 'shopv2_price_str_suffix';
		}

		configsave($configlist);/*保存系统配置*/

		$this->ajax_success('保存成功');
	}
	//错误
	public function ajax_error($error){
		global $_M;
		$retun = array();
		$retun['error'] = $error;
		echo jsonencode($retun);
		die();
	}
	//成功
	public function ajax_success($success){
		global $_M;
		$retun = array();
		$retun['success'] = $success;
		echo jsonencode($retun);
		die();
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>