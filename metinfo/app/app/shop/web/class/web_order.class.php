<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_func('str');
load::sys_func('array');
class web_order {

	public $lang;
	public $state;
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
		$this->auto_change_state();
	}
	
	public function get_order_list($where, $order, $limit_start, $limit_num){
		global $_M;
		$where = "lang = '{$this->lang}' AND type=1 {$where}";
		if($limit_start==''&&!$limit_num){
			return DB::get_all("SELECT * FROM {$_M['table']['shopv2_order']} WHERE {$where} ORDER BY {$order}");
		}else{
			return DB::get_data($_M['table']['shopv2_order'], $where, $order, $limit_start, $limit_num);
		}
	}
	
	public function get_order_total($where){
		global $_M;
		$where = "lang = '{$this->lang}' AND type=1 {$where}";
		return DB::counter($_M['table']['shopv2_order'], $where);
	}
	
	public function get_order_by_id($id){
		global $_M;	
		$query = "SELECT * FROM {$_M['table']['shopv2_order']} WHERE id='{$id}'";
		$list = DB::get_one($query);
		return $list;
	}
	
	public function get_order_by_user_id($id){
		$order = $this->get_order_by_id($id);
		if($order['uid'] == get_met_cookie('id')){
			return $order;
		}else{
			return false;
		}
	}
	
	public function get_order_by_rid($rid){
		global $_M;	
		$query = "SELECT * FROM {$_M['table']['shopv2_order']} WHERE orderid='{$rid}'";
		$list =  DB::get_one($query);
		return $list;
	}
	
	public function json_order_list($where, $order){
		global $_M;	
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang='{$_M['lang']}' AND type=1 {$where}";
		$data = $this->table->getdata($_M['table']['shopv2_order'], '*', $where, $order);
		$data = $this->analysis_array($data);	
		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function get_pay_type($paytype){
		switch($paytype){
			case 1:
				return "在线支付";
			break;
			case 2:
				return "货到付款";
			break;
			case 3:
				return "公司转账";
			break;
		}
		return "未知方式";
	}
	
	public function get_invoice_type($paytype){
		switch($paytype){
			case 1:
				return "普通发票";
			break;
			case 2:
				return "电子发票";
			break;
			case 3:
				return "增值税发票";
			break;
		}
	}
	
	public function analysis_array($data){
		foreach($data as $key=>$val){
			$data[$key] = $this->analysis($val);
		}
		return $data;
	}
	
	public function analysis($list){
		global $_M;
		$list['paytype_str'] = $this->get_pay_type($list['paytype']);
		switch($list['state']){
			case -2:
				$list['state_str'] = '<span class="label label-dark">缺货退款</span>';
				$list['state_txt'] = '缺货退款';
			break;
			case -1:
				$list['state_str'] = '<span class="label label-danger">退款中</span>';
				$list['state_txt'] = '退款中';
			break;
			case 0:
				$list['state_str'] = '<span class="label label-default">已关闭</span>';
				$list['state_txt'] = '已关闭';
			break;
			case 1:
				$list['state_str'] = '<span class="label label-warning">待付款</span>';
				$list['state_txt'] = '待付款';
			break;
			case 2:
				if($list['paytype'] == 1){
					$list['state_str'] = '<span class="label label-danger">待发货</span>';
					$list['state_txt'] = '待发货';
				}else if($list['paytype'] == 2){
					$list['state_str'] = '<span class="label label-danger">货到付款</span>';
					$list['state_txt'] = '货到付款';
					if(!defined('IN_ADMIN')){
						$list['state_str'] = '<span class="label label-danger">待发货</span>';
						$list['state_txt'] = '待发货';
					}
				}else if($list['paytype'] == 3){
					$list['state_str'] = '<span class="label label-danger">公司转账</span>';
					$list['state_txt'] = '公司转账';
				}
			break;
			case 3:
				$list['state_str'] = '<span class="label label-primary">已发货</span>';
				$list['state_txt'] = '已发货';
			break;
			case 4:
				$list['state_str'] = '<span class="label label-success">已完成</span>';
				$list['state_txt'] = '已完成';
			break;
		}
		$list['rtime_str'] = date("Y-m-d H:i:s", $list['rtime']);
		$list['ptime_str'] = $list['ptime'] ? date("Y-m-d H:i:s", $list['ptime']):"";
		$list['stime_str'] = $list['stime'] ? date("Y-m-d H:i:s", $list['stime']):"";
		/*
		$list['logistics_str'] = "{$list['cinfo']}{$list['oinfo']}<span class=\"dropdown\">
						  <button class=\"btn btn-default dropdown-toggle express\" type=\"button\" id=\"dropdownMenu1\"  aria-haspopup=\"false\" aria-expanded=\"true\" data-info=\"{$list['cinfo']}|{$list['oinfo']}\">
							查看详细
						  </button>
						  <ul class=\"dropdown-menu div_express\" aria-labelledby=\"dropdownMenu1s\" style=\"width:500px;margin:5px 0px 0px 4px\">
							加载中。。。。
						  </ul>
						</span>";					
		*/
		if($list['cinfo']){
			$list['logistics_str'] = "<span>{$list['cinfo']}：{$list['oinfo']}</span>";
		}else{
			$list['logistics_str'] = "";
		}
		if($list['paytype'] == 1){
			$list['paytype_str'] = '在线支付';
		}else{
			$list['paytype_str'] = '货到付款';
		}
		$list['tprice_str'] = load::own_class('web/class/web_func', 'new')->price_str($list['tprice']);
		$list['price_str'] = load::own_class('web/class/web_func', 'new')->price_str($list['price']);
		$list['cprice_str'] = load::own_class('web/class/web_func', 'new')->price_str($list['cprice']);
		$list['discount_str'] = load::own_class('web/class/web_func', 'new')->price_str($list['discount']);
		$list['freight_str'] = load::own_class('web/class/web_func', 'new')->price_str($list['freight']);
		
		$address = jsondecode($list['address']);
		if($address){
			$list['address'] = $address;
			$list['address_str'] = "{$list['address'][0]} {$list['address'][2]} {$list['address'][1]}";
		}else{
			$list['address_str'] = '无需配送';
		}
		if($list['invoice'] == '0'){
			$list['invoice_info'] = array();
			$list['invoice_str'] = "<span class=\"order-invoice\">不需要开发票</span>";
		}else{
			if($list['invoice_info']){
				$invoice_info = jsondecode($list['invoice_info']);
				$list['invoice_type'] = $invoice_info[0];
				$invoice_info[0] = $this->get_invoice_type($invoice_info[0]);
				$list['invoice_info'] = $invoice_info;
			}
		}
		if($_M['config']['shopv2_order_auto_close']){
			$list['countdown'] = $list['rtime']+($_M['config']['shopv2_order_auto_close_time']*60);
			$list['countdown'] = $this->gettime(time(),$list['countdown']);
		}
		return $list;
	}
	
	public function gettime($time_s,$time_n){
		$strtime = '';
		$time = $time_n-$time_s;
		if($time >= 86400){
			return $strtime = date('Y-m-d H:i:s',$time_n);
		}
		if($time >= 3600){
			$strtime .= intval($time/3600).'小时';
			$time = $time % 3600;
		}else{
			$strtime .= '';
		}
		if($time >= 60){
			$strtime .= intval($time/60).'分钟';
			$time = $time % 60;
		}else{
			$strtime .= '';
		}
		return $strtime;
	}
	
	public function save_order($info){
		global $_M;
		$keys = $this->save_order_key();
		$sql = '';
		
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				$query = "UPDATE  {$_M['table']['shopv2_order']} SET {$sql} WHERE id='{$info['id']}'";
				DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_order']} SET {$sql},lang = '{$this->lang}'";
				DB::query($query);
		}
	}
		
	public function save_goods($info){
		global $_M;
		$keys = $this->save_goods_key();
		$sql = '';
		
		foreach($keys as $key=>$val){
			if(isset($info[$val]) && $val!='id')$sql .= "{$val}='{$info[$val]}',";
		}
		$sql = trim($sql, ',');
		if($info['id']){
				//$query = "UPDATE  {$_M['table']['shopv2_order_goods']} SET {$sql} WHERE id='{$info['id']}'";
				//DB::query($query);
		} else {
				$query = "INSERT INTO {$_M['table']['shopv2_order_goods']} SET {$sql}";
				DB::query($query);
		}
	}
	public function save_order_key(){
		return array('id', 'orderid', 'type', 'uid', 'username', 'state', 'tel', 'email', 'message', 'address', 'price', 'cprice', 'tprice', 'discount','discount_info', 'freight', 'cinfo', 'oinfo', 'paytype', 'payinfo', 'invoice', 'invoice_info', 'remark', 'rtime', 'ptime', 'stime', 'ctime', 'search');
	}
	
	public function save_goods_key(){
		return array('pid', 'pname', 'pamount', 'puprice', 'rid', 'para', 'message', 'freight', 'price');
	}
	
	public function get_goods_list($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_order_goods']} WHERE rid = '{$id}'";
		$goods_list = DB::get_all($query);
		$product_class = load::own_class('web/class/web_goods', 'new');
		foreach($goods_list as $key=>$val){
			$query = "SELECT * FROM {$_M['table']['product']} WHERE id = '{$val['pid']}'";
			$product_list = DB::get_one($query);
			$goods_list[$key]['url'] = $product_class->get_show_product_url($val['pid'], $product_list['class1']);
			$goods_list[$key]['img'] = $product_list['imgurls'];
			
			$goods_list[$key]['puprice_str'] = load::own_class('web/class/web_func', 'new')->price_str($val['puprice']);
			$goods_list[$key]['freight_str'] = load::own_class('web/class/web_func', 'new')->price_str($val['freight']);
			$goods_list[$key]['price_str'] = load::own_class('web/class/web_func', 'new')->price_str($val['price']);
			
			if($val['message']){
				$meassge = @jsondecode($val['message']);
				$goods_list[$key]['message_array'] = $meassge;
				$html = '<ul class="goods-message-list">';
				foreach($meassge as $keymessage=>$valmessage){
						$html .= "<li>{$valmessage[title]}：{$valmessage[info]}</li>";
				}
				$html .= '</ul>';
				$goods_list[$key]['message'] = $html;
			}else{
				$goods_list[$key]['message'] = '<ul class="addr-list"></ul>';
			
			}
		}
		return $goods_list;
	}
	
	public function insert_order($type, $price, $goods, $paytype, $invoice, $message, $address){
		if($type == 1){
			$info['orderid'] = $this->get_rid();
			$info['type'] = 1;
			$info['uid'] = get_met_cookie('id');	
			$info['username'] = get_met_cookie('username');	
			$info['state'] = 1;		
			$info['price'] = $price['price'];
			$info['tprice'] = $price['tprice'];
			
			$info['discount'] = $price['discount'];		
			$info['discount_info'] = $price['discount_info'];		
			if($info['discount']){
				$info_dis['id'] = $price['discount_id'];
				$info_dis['usetime'] = time();
				load::own_class('web/class/web_discount', 'new')->save_coupon($info_dis);
			}		
			$info['freight'] = $price['freight'];	
			$info['message'] = $message;
			$info['paytype'] = $paytype;
			if($info['paytype'] != 1){
				$info['state'] = 2;
			}
			if(jsondecode($invoice)){
				$info['invoice'] = 1;
				$info['invoice_info'] = $invoice;
			}else{
				$info['invoice'] = 0;
				$info['invoice_info'] = '';
			}
			$info['tel'] = $address['tel'];
			$info['email'] = $address['email'];
			$info['address'] = $address['address'];
			$info['rtime'] = time();
			$this->save_order($info);
			$order = $this->get_order_by_rid($info['orderid']);
			$search = "";
			foreach($goods as $key=>$val){
				if($val['amount'] < 0){
					$val['amount'] = 1;
				}
				$ginfo['pid'] = $val['pid'];
				$ginfo['pname'] = $val['name'];
				$ginfo['pamount'] = $val['amount'];
				$ginfo['puprice'] = $val['price'];
				$ginfo['rid'] =$order['id'];
				$ginfo['para'] = $val['para_str'];
				$ginfo['message'] = $val['message_input'];
				$ginfo['freight'] = $val['freight'];
				$ginfo['price'] = $val['price'] * $val['amount'] + $val['freight'];
				$search .= $ginfo['pname'].'|';
				$this->save_goods($ginfo);
			}
			$search_array['id'] = $order['id'];
			$search_array['search'] = $search;
			$this->save_order($search_array);
			// 如果是货到付款 提醒管理员  提醒用户
			if($paytype == 2) {
				load::own_class('web/class/web_remind', 'new')->user_pay($order);
				load::own_class('web/class/web_remind', 'new')->admin();
			}
			return $this->get_order_by_rid($info['orderid']);
		}
		if($type == 2){
			$info['orderid'] = $this->get_rid();
			$info['paytype'] = 1;
			$info['type'] = 2;
			$info['uid'] = get_met_cookie('id');	
			$info['username'] = get_met_cookie('username');	
			$info['state'] = 1;		
			$info['tprice'] = $price['tprice'];
			$info['discount'] = 0;				
			$info['freight'] = 0;	
			$info['rtime'] = time();
			$this->save_order($info);
			return $this->get_order_by_rid($info['orderid']);
		}
	}

	public function get_rid(){
		$rid = date('YmdHis').random(5, 1);
		return $rid;
	}
	
	public function order_pay($rid, $payinfo, $price = 0){
		$order = $this->get_order_by_rid($rid);
		if($payinfo == 'balance'){
			$price = $order['tprice'];
		}else{
			if(bccomp($order['tprice'], $price) !== 0){
			
				return false;	
			}
		}
		if($order['type'] == 1 && $order['state'] == 1){
			$info['id'] =  $order['id'];
			$info['state'] = 2;
			$info['payinfo'] = $payinfo;
			$info['ptime'] = time();
			
			if($payinfo != 'balance'){
				load::own_class('web/class/web_finance', 'new')->addfinance(1, $order['username'], $price, "充值「{$payinfo}」 <span class=\"badge badge-default\">订单：{$rid}</span>");
			}
			if(!load::own_class('web/class/web_finance', 'new')->addfinance(2, $order['username'], $price, "<span class=\"badge badge-default\">订单：{$rid}</span>")){
				return false;
			}
			
			$this->save_order($info);
			
			$goods = $this->get_goods_list($order['id']);
			foreach($goods as $key=>$val){
				load::own_class('web/class/web_goods', 'new')->goods_stock($val['pid'], $val['para'], 0-$val['pamount']);
			}
					
			load::own_class('web/class/web_shop_user', 'new')->change_goods_list($order['uid'], $goods);


			load::own_class('web/class/web_remind', 'new')->user_pay($order);
			load::own_class('web/class/web_remind', 'new')->admin();
		}
		if($order['type'] == 2 && $order['state'] == 1){
			if($payinfo == 'balance'){
				return false;
			}
			$info['id'] =  $order['id'];
			$info['state'] = 4;
			$info['payinfo'] = $payinfo;
			$info['ptime'] = time();
			$info['stime'] = time();
			$this->save_order($info);
			load::own_class('web/class/web_finance', 'new')->addfinance(1, $order['username'], $price, "余额充值「{$payinfo}」 <span class=\"badge badge-default\">订单：{$rid}</span>");
		}
		return true;
	}
	
	public function is_order_pay($order){
		$goods_class = load::own_class('web/class/web_goods', 'new');
		$goods = $this->get_goods_list($order['id']);
		$goodslist = array();
		foreach($goods as $key=>$val){
			$goodslist[$val['pid']] = $val['pamount'];
			$goods_data[$val['pid']] = $goods_class->get_goods_by_pid($val['pid'], 0, 0, 1, 0);
			
			$info['pid'] = $val['pid'];
			$info['para_str'] = $val['para'];
			$info['amount'] = $val['pamount'];
			$stock_data[$val['pid']] = $info;
		}
		$purchase_list = $goods_class->purchase_list($goods_data, $order['uid']);
		foreach($purchase_list as $key=>$val){
			if($goodslist[$key] > $val){
				return false;
			}
		}
		$stock = $goods_class->stock_list_array($stock_data, $goods_data);
		foreach($stock as $key=>$val){
			if($val['buy_ok'] == 0)return false;
		}
		return true;
	}
	
	public function auto_change_state(){
		global $_M;
		if($_M['config']['shopv2_order_auto_close']){
			$rtime = time()-$_M['config']['shopv2_order_auto_close_time']*60;
			$now = time();
			$query = "UPDATE {$_M['table']['shopv2_order']} SET state='0',ctime='{$now}' WHERE state='1' and rtime<'{$rtime}' AND type=1";
			DB::query($query);
		}
		
		if($_M['config']['shopv2_order_auto_ok']){
			$stime = time()-$_M['config']['shopv2_order_auto_ok_time']*86400;
			$query = "UPDATE {$_M['table']['shopv2_order']} SET state='4' WHERE state='3' and stime<'{$stime}' AND type=1";
			DB::query($query);
		}
		
		if($_M['config']['shopv2_order_auto_del']){
			$ctime = time()-$_M['config']['shopv2_order_auto_del_time']*86400;
			$query = "SELECT * FROM {$_M['table']['shopv2_order']} WHERE state='0' and ctime<'{$ctime}' AND type=1";
			$orders = DB::get_all($query);
			foreach($orders as $key=>$val){
				$query = "DELETE FROM {$_M['table']['shopv2_order_goods']} WHERE rid='{$val[id]}'";
				DB::query($query);
			}
			$query = "DELETE FROM {$_M['table']['shopv2_order']} WHERE state='0' and ctime<'{$ctime}' AND type=1";
			DB::query($query);
		}
		
		$time = time()-86400;
		$query = "DELETE FROM {$_M['table']['shopv2_order']} WHERE state='1' and rtime<'{$time}' AND type=2";
		DB::query($query);
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>