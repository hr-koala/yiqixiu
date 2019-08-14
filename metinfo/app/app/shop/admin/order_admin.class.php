<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class order_admin extends admin {
	public $order;
	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		nav::select_nav(1);
		$this->order = 	load::own_class('admin/class/sys_order', 'new');
		//$this->order->auto_change_state($list);
	}
	//获取订单列表
	public function dojson_order_list(){
		global $_M;
		$search = $_M['form']['state']!=''?"and state = '{$_M['form']['state']}'":'';  
		$search.= $_M['form']['keyword']?"and (orderid like '%{$_M['form']['keyword']}%' || username like '%{$_M['form']['keyword']}%')":'';
		$order = " rtime DESC ";	
		$data = $this->order->json_order_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$goods = $this->order->get_goods_list($val['id']);
			$content = '';
			$count = count($goods);
			$counttxt = $count>1?"共计 {$count} 个商品":'';
			foreach($goods as $val_goods){
				$val_goods['puprice'] = load::own_class('web/class/web_func', 'new')->price_str($val_goods['puprice']);
				$content = "
					<div class=\"media\">
						<div class=\"media-left\">
							<img src=\"{$val_goods['img']}\" class=\"media-object\" />
						</div>
						<div class=\"media-body\">
						  <h4 class=\"media-heading\">
							{$val_goods['pname']}
							<div>{$val_goods['puprice']}<p>( {$val_goods['pamount']} 件 )</p></div>
						  </h4>
						  <div>{$val_goods['para']} {$val_goods['message']}</div>
						</div>
					</div>
					<div class=\"margin-top-5\">{$counttxt}</div>
				";
				break;
			}
			$val['invoice_info_html'] = $val['invoice']?"<span class=\"label label-primary\">发票</span>":'';
			$list[] = "
				<div class=\"slidepanel_box\" data-url=\"{$_M['url']['own_form']}&a=docheck&id={$val[id]}\">
					<span class=\"label label-outline label-default\">订单编号 : {$val['orderid']}</span>
					{$val['invoice_info_html']}
					{$content}
				</div>
			";
			$list[] = $val['username'];
			$list[] = $val['rtime_str'];
			$list[] = $val['state_str'];
			$list[] = $val['tprice_str'];
			$rarray[] = $list;
		}
		$this->order->json_return($rarray);
	}
	
	//订单概况
	public function doindex(){
		global $_M;
		$this->order_stat = load::own_class('admin/class/sys_order_stat', 'new');
		$this->order->auto_statistics();
		
		$last  = $this->order_stat->last;
		$first = $this->order_stat->first;
		/*订单数*/
		$order_per = floor(($first['sum']['order_number']-$last['sum']['order_number'])/$last['sum']['order_number']*100);
		if($order_per==0){
			$order_i   = 'hide';
		}else{
			$order_i   = $order_per>0?'text-danger wb-triangle-up':'text-success wb-triangle-down';
			if($order_per>0)$order_per = '+'.$order_per;
		}
		/*收入*/
		$income_per = floor(($first['sum']['income']-$last['sum']['income'])/$last['sum']['income']*100);
		if($income_per==0){
			$income_i = 'hide';
		}else{
			$income_i = $income_per>0?'text-danger wb-triangle-up':'text-success wb-triangle-down';
			if($income_per>0)$income_per = '+'.$income_per;
		}
		$income_price = load::own_class('web/class/web_func', 'new')->price_str($first['sum']['income']);
		/*下单人数*/
		$order_user_per = floor(($first['sum']['order_user']-$last['sum']['order_user'])/$last['sum']['order_user']*100);
		if($order_user_per==0){
			$order_user_i = 'hide';
		}else{
			$order_user_i = $order_user_per>0?'text-danger wb-triangle-up':'text-success wb-triangle-down';
			if($order_user_per>0)$order_user_per = '+'.$order_user_per;
		}
		/**/
		$dayslotjson['order'] = $this->order_stat->dayslotorder();
		$dayslotjson['income'] = $this->order_stat->dayslotincome();
		$dayslotjson['weekorder'] = $this->order_stat->weekslotorder();
		$dayslotjson['weekincome'] = $this->order_stat->weekslotincome();
		$dayslotjson['monthorder'] = $this->order_stat->monthslotorder();
		$dayslotjson['monthincome'] = $this->order_stat->monthslotincome();
		$monthdays = array();
		for($i=0;$i<date('t',time());$i++){
			$monthdays[]=$i+1;
		}
		$dayslotjson['monthdays'] = $monthdays;
		$dayslotjson = jsonencode($dayslotjson);
		require_once $this->template('own/order_index');
	}
	//订单列表页
	public function doorder_list(){
		global $_M;
		$state1 = $this->order->get_order_total("and state = '1'");
		$state3 = $this->order->get_order_total("and state = '2'");
		require_once $this->template('own/order_list');
	}
	//订单编辑页
	public function docheck(){
		global $_M;
		$order = $this->order->get_order_by_id($_M['form']['id']);
		$order = $this->order->analysis($order);
		$goods = $this->order->get_goods_list($order['id']);
		if($order['state']==2){
			if($order['stime']){
				if($order['cinfo']){
					$is_wuliu = 1;
				}else{
					$is_wuliu = 0;
				}
			}else{
				$is_wuliu = 1;
			}
			if($order['cinfo']){
				$order['cinfo_str'] = $order['cinfo'];
			}else{
				$order['cinfo_str'] = '请选择物流公司';
			}
			$d_user_c[$is_wuliu] = "checked";
		}
		if(!is_array($order['address']))$d_user_c[0] = "checked";
		require_once $this->template('own/order_editor');
	}
	//修改价格
	public function doeditorsave_price(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['cprice'] = $_M['form']['cprice'];
		if($_M['form']['pk']==1){
			$info['cprice'] = floatval($_M['form']['value']);
		}
		$order = $this->order->get_order_by_id($_M['form']['id']);
		$info['tprice'] = $order['price'] + $order['discount'] + $order['freight'] + $info['cprice'];
		if($info['id'])$this->order->save_order($info);
		$this->ajax_success('价格修改成功');
	}
	//关闭订单
	public function doeditor_close(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['state'] = 0;
		$info['ctime'] = time();
		if($info['id'])$this->order->save_order($info);
		$this->ajax_success('订单已关闭');
	}
	//订单完成
	public function docomplete_order(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['state'] = 4;
		if($info['id'])$this->order->save_order($info);
		$this->ajax_success('操作成功');
	}
	//备注
	public function doeditorsave_remark(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['remark'] = $_M['form']['remark'];
		if($_M['form']['pk']==1){
			$info['remark'] = $_M['form']['value'];
		}
		if($info['id'])$this->order->save_order($info);
		$this->ajax_success('备注修改成功');
	}
	//发货
	public function doeditorsave_send(){
		global $_M;
		$info['id'] = $_M['form']['id'];
		$info['stime'] = time();
		$info['state'] = 3;
		if($_M['form']['is_wuliu'] == 1){
			$info['oinfo'] = $_M['form']['oinfo'];
			$info['cinfo'] = $_M['form']['cinfo'];
		}else{
			$info['oinfo'] = "";
			$info['cinfo'] = "";
		}
		$order_class = load::own_class('admin/class/sys_order', 'new');
		$goods_class = load::own_class('web/class/web_goods', 'new');
		$order = $order_class->get_order_by_id($info['id']);
		if($order['paytype'] !=1){
			if(!$order_class->is_order_pay($order)){
				$this->ajax_error('订单商品缺少库存或超过限购数');
			}
			$goods = $order_class->get_goods_list($info['id']);
			foreach($goods as $key=>$val){
				$goods_class->goods_stock($val['pid'], $val['para'], 0-$val['pamount']);
			}
			load::own_class('web/class/web_shop_user', 'new')->change_goods_list($order['uid'], $goods);
		}	
		if($info['id'])$this->order->save_order($info);
		load::own_class('web/class/web_remind', 'new')->user_send($order);
		$this->ajax_success('发货成功');
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