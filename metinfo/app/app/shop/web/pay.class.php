<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class pay extends web_shop_base{	

	public $pay;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		//$this->pay = load::own_class('web/class/web_pay', 'new');
	}
	
	public function doindex() {
		global $_M;
		
		$addr_de = 0;
		$pgoods = $this->get_pay($_M['form']['cidlist']);
		$logistic = 0;
		foreach($pgoods as $val){
			if($val['logistic'])$logistic = 1;
		}
		$freight_type_str = $logistic?"{$_M['word']['app_shop_express']}（<span id=\"pay-freight\"></span>）":$_M['word']['app_shop_nologistics'];
		$freight_type_str = "{$_M['word']['app_shop_express']}（<span id=\"pay-freight\"></span>）";
		$addr_display = $this->is_consignee_display($pgoods) ? "data-dis='1'":"style='display:none;' data-dis='0'";
		$submit_disable = $this->is_stock_display($pgoods) ? "":"disabled='disabled'";
		$invoice = $this->is_invoice($pgoods);
		if(count($invoice) == count($pgoods) || count($invoice) == 0){
			$invoice_div = 0;
		}else{
			$invoice_div = 1;
		}
		if(!$this->is_purchase($pgoods)){
			okinfo($_M['url']['shop_cart'], $_M['word']['app_shop_lowpurchase']);
		}
		if($submit_disable != ''){
			okinfo($_M['url']['shop_cart'], $_M['word']['app_shop_lowstocks']);
		}
		$total_price = $this->total_price($pgoods);
		
		$discount_class = load::own_class('web/class/web_discount', 'new');
		$discounts = $discount_class->get_discount_by_uid(get_met_cookie('id'));
		$discounts = $discount_class->analysis_array($discounts);
		$re = array();
		foreach($discounts as $key => $val){
			if($discount_class->is_ues_discount(get_met_cookie('id'), $val, $pgoods)){
				$re[] = $val;
			}
		}	
		$discounts = $re;
		$shopv2_html_base_pay_index_form = load::plugin('doshopv2_html_base_pay_index_form', 1, array($html=>''));//加载插件
		require_once $this->template('tem/shop_pay_index');
		die();
	}
	
	public function get_pay($pidlist) {
		$cart = load::own_class('web/class/web_cart', 'new')->cart_list();
		$cart = load::own_class('web/class/web_cart', 'new')->analysis_array($cart);
		$cidlist = '-'.$pidlist.'-';
		$pgoods = array();
		foreach($cart as $key=>$val){
			if(stripos($cidlist, '-'.$val['id'].'-') !== false)$pgoods[] = $val;
		}
		$price = load::own_class('web/class/web_func', 'new')->price_plugin($pgoods);
		$pgoods = load::own_class('web/class/web_func', 'new')->price_plugin_data($pgoods, $price);
		$pgoods = load::plugin('doshopv2_pay_goods', 1, array('pgoods'=>$pgoods));
		return $pgoods;
	}
	
	public function is_consignee_display($p) {
		foreach($p as $key=>$val){
			if($val['logistic'])return true;
		}
		return false;
	}
	
	public function is_stock_display($p) {
		foreach($p as $key=>$val){
			if($val['buy_ok'] == 0)return false;
		}
		return true;
	}
	
	public function is_invoice($p){
		$array = array();
		foreach($p as $key=>$val){
			if($val['lnvoice'] == 1)$array[] = $val;
		}
		return $array;
	
	}
	
	public function is_purchase($p){
		$purchase_list = load::own_class('web/class/web_goods', 'new')->purchase_list($p);
		foreach($p as $key=>$val){
			$cart_now[$val['pid']] += $val['amount'];
		}
		foreach($purchase_list as $key=>$val){
			if($cart_now[$key] > $val){
				return false;
			}
		}
		return true;
	}

	public function total_price($p) {
		$price = load::own_class('web/class/web_func', 'new')->price_plugin($p);
		$total_price = $price['goods']['total'];
		return $total_price;
	}
	
	public function total_freight(&$p, $place, $invoice = 0) {
		$price = 0;
		foreach($p as $key=>$val){
			if($val['freight_mould']){
				$val['freight'] = load::own_class('web/class/web_freight', 'new')->get_freight($val['freight_mould'], $val['amount'], $place);
			}
			$p[$key]['freight'] = $val['freight'] ? $val['freight'] : 0;
			$price += $val['freight'];
		}
		if($invoice == 1 && $price == 0){
			$price = load::own_class('web/class/web_freight', 'new')->get_invoice_freight($place);
		}
		return $price;
	}
	
	/*订单结算*/
	
	/*充值*/
	
	public function dorecharge(){
		global $_M;
		$pay_list = load::mod_class('pay/include/class/interface_pay', 'new')->get_pay_list();
		foreach($pay_list as $key=>$val){
			$pay_list[$key]['url'] = "{$_M['url']['shop_pay_payment']}&id={$order[id]}&type={$key}";
		}
		if($pay_list['weixin']['url']){
			$pay_list['weixin']['check_url'] = $pay_list['weixin']['check_url'].$order['orderid'];
		}
		if($pay_list['weixin_h5']['url']){
			$pay_list['weixin_h5']['check_url'] = $pay_list['weixin']['check_url'].$order['orderid'];
		}
		require_once $this->template('tem/shop_recharge_index');
	}
	
	public function dopayrecharge(){
		global $_M;
		if($_M['form']['price']){
			$price = array();
			$price['tprice'] = $_M['form']['price'];
			if(!$price['tprice'] && is_numeric($price['tprice'])){
				okinfo($_M['url']['shop_recharge_index'], $_M['word']['app_shop_precmoney']);
			}
			$order = load::own_class('web/class/web_order', 'new')->insert_order('2', $price);
			$order = load::own_class('web/class/web_order', 'new')->analysis($order);
		}else{
			$order = load::own_class('web/class/web_order', 'new')->get_order_by_user_id($_M['form']['id']);
			$order = load::own_class('web/class/web_order', 'new')->analysis($order);	
		}
		if($order['state'] != 1){
			okinfo($_M['url']['shop_order'], $_M['word']['app_shop_havepay']);
		}
		$pay_list = load::mod_class('pay/include/class/interface_pay', 'new')->get_pay_list();
		foreach($pay_list as $key=>$val){
			$pay_list[$key]['url'] = "{$_M['url']['shop_pay_payment']}&id={$order[id]}&type={$key}";
		}
		if($pay_list['weixin']['url']){
			$pay_list['weixin']['check_url'] = $pay_list['weixin']['check_url'].$order['orderid'];
		}
		if($pay_list['weixin_h5']['url']){
			$pay_list['weixin_h5']['check_url'] = $pay_list['weixin_h5']['check_url'].$order['orderid'];
		}
		require_once $this->template('tem/shop_recharge_pay');
	}
	
	public function dopayment(){
		global $_M;
		
		if($_M['form']['id']){
			$order = load::own_class('web/class/web_order', 'new')->get_order_by_user_id($_M['form']['id']);
		}else{
			
		}	
		if($order['state'] != 1){
			$this->ajax_error($_M['word']['app_shop_havepay']);
		}
		
		if(!load::own_class('web/class/web_order', 'new')->is_order_pay($order)){
			$this->ajax_error($_M['word']['app_shop_nosckpce']);
		}
		
		if($_M['form']['type'] != 'balance'){
			$goods_list =load::own_class('web/class/web_order', 'new')->get_goods_list($order['id']);
			if($order['type'] == 1){
				foreach($goods_list as $key=>$val){
					$goods_str.= "{$val['pname']}";
					$goods_str.= "*{$val['pamount']} ";
					
					$goods_id.= "{$val['id']},";
				}
				$goods_id = trim($goods_id, ',');
			}else{
				$goods_str = "{$_M['word']['app_shop_accountrecharge']}";
				$goods_id = 0;
			}
			if(str_length($_M['config']['met_webname']) > '60'){
				$bodytop = '';
			}else{
				$bodytop = $_M['config']['met_webname'];
			}
			$data['body'] = "{}{$_M['word']['app_shop_order']}-{$order['orderid']}";
			$data['subject'] = $goods_str;
			$data['out_trade_no'] = $order['orderid'];
			$data['product_id'] = $goods_id;
			$data['no'] = 10043;
			$data['total_fee'] = $order['tprice'];
			if($order['type'] == 1){
				$data['return_url'] = $_M['url']['shop_order_check'].'&id='.$order['id'];
			}else{
				$data['return_url'] = $_M['url']['shop_finance'];
			}
			$strcode = load::mod_class('pay/include/class/interface_pay', 'new')->data_encode($data);	
			$pay_list = load::mod_class('pay/include/class/interface_pay', 'new')->get_pay_list();
			foreach($pay_list as $key=>$val){	
				$pay_list[$key]['url'] = "{$val['url']}&strcode={$strcode}";
			}
			$this->ajax_success($pay_list[$_M['form']['type']]['url']);
		}else{
			if(md5($_M['form']['password']) == get_met_cookie('password')){
				if(load::own_class('web/class/web_order', 'new')->order_pay($order['orderid'], "balance")){
					//okinfo($_M['url']['shop_order_check']."&id={$order['id']}", $_M['word']['app_shop_payok']);
					$this->ajax_success($_M['url']['shop_order_check']."&id={$order['id']}");
				}else{
					$this->ajax_error($_M['word']['app_shop_payinsufficient']);
				}
			}else{
				$this->ajax_error($_M['word']['app_shop_passno']);
			}
			
		}
		
		$this->ajax_error($_M['word']['app_shop_errornopay']);
	}
	
	/*订单下单*/
	public function doplaceorder(){
		global $_M;
		load::plugin('doshopv2_placeorde_start');
		$pgoods = $this->get_pay($_M['form']['cidlist']);
		if(!$this->is_stock_display($pgoods)){
			$this->ajax_error($_M['word']['app_shop_lowstocks']);
		}
		if(!$this->is_purchase($pgoods)){
			$this->ajax_error($_M['word']['app_shop_lowpurchase']);
		}
		if($_M['form']['discount']){
			$discount_class = load::own_class('web/class/web_discount', 'new');
			$dis = $discount_class->get_coupon_by_id($_M['form']['discount']);
			if(!$discount_class->is_ues_discount(get_met_cookie('id'), $dis, $pgoods)){
				$this->ajax_error('此优惠劵无法使用！');
				$dis = array();
			}
		}else{
			$dis = array();
		}
		if($this->is_stock_display($pgoods) && $pgoods){
			//地址处理
			if($this->is_consignee_display($pgoods) || $_M['form']['invoice_is']){
				$add = load::own_class('web/class/web_address', 'new')->get_address_by_id($_M['form']['addressid']);
				$address['tel'] = $add['tel'] ? $add['tel'] : get_met_cookie('tel');
				$address['email'] = $add['email'] ? $add['email'] : get_met_cookie('email');
				$address['address'] = jsonencode(array($add['name'], "{$add['zone_p']} {$add['zone_c']} {$add['zone_d']} {$add['zone_a']}", $add['tel'], $add['fixed'], $add['email']));
			}else{
				$address['tel'] = get_met_cookie('tel');
				$address['email'] = get_met_cookie('email');
				$address['address'] = '';
			}

			//购买商品
			foreach($pgoods as $key=>$val){
				$pgoods[$key]['message_input']  = '';
				$lists = array();
				foreach($val['message'] as $keymessage=>$valmessage){
					$keyword = "msg_{$val['id']}_{$val['pid']}_{$keymessage}";
					$list = array();
					$list['title'] = $valmessage['name'];
					$list['info'] = $_M['form'][$keyword];
					$lists[] = $list;
				}
				$pgoods[$key]['message_input'] = jsonencode($lists);
			}

			//各种价格
			$price['price'] = $this->total_price($pgoods);
			$price['cprice'] = 0;
			if($dis['par']){
				$price['discount_id'] = $dis['id'];
				$price['discount'] = 0 - $dis['par'];
				$price['discount_info'] = $dis['name'].'使用优惠';
			}else{
				$price['discount_id'] = 0;
				$price['discount'] = 0;
				$price['discount_info'] = '';
			}
			$price['freight'] = $this->total_freight($pgoods, $add['zone_p'], $_M['form']['invoice_is']);
			$price['tprice'] = $price['price'] + $price['freight'] + $price['discount'];
			//付款方式
			$paytype = $_M['form']['paytype'];
			$message = $_M['form']['message'];
			//发票
			if($_M['form']['invoice_is']){
				$invoice[] = $_M['form']['invoice_type'];
				$invoice[] = $_M['form']['invoice_title'];
				$invoice[] = $_M['form']['invoice_con'];
			}else{
				$invoice = '';
			}
			$invoice = jsonencode($invoice);
			$order = load::own_class('web/class/web_order', 'new')->insert_order('1', $price, $pgoods, $paytype, $invoice, $message, $address);
			load::own_class('web/class/web_cart', 'new')->clear_cart($_M['form']['cidlist']);
			load::own_class('web/class/web_remind', 'new')->user_nopay($order);
			load::plugin('doshopv2_placeorde_end', 0, array('order'=>$order));
			if($paytype == 1){
				$this->ajax_success($_M['url']['shop_pay_payorder']."&id={$order['id']}");
			}else{
				$this->ajax_success($_M['url']['shop_order']);
			}
		}else{
			$this->ajax_error($_M['word']['app_shop_lowstocks']);
		}
	}
	public function dopayorder(){
		global $_M;
		$orderid = $_M['form']['id'];
		$order = load::own_class('web/class/web_order', 'new')->get_order_by_user_id($_M['form']['id']);
		$order = load::own_class('web/class/web_order', 'new')->analysis($order);
		if(!$order['id']){
			okinfo($_M['url']['shop_order'], $_M['word']['app_shop_noopaccess']);
		}	
		if($order['state'] != 1){
			okinfo($_M['url']['shop_order'], $_M['word']['app_shop_havepay']);
		}

		if(!load::own_class('web/class/web_order', 'new')->is_order_pay($order)){
			okinfo($_M['url']['shop_order'], $_M['word']['app_shop_nosckpce']);
		}
		$goods_list =load::own_class('web/class/web_order', 'new')->get_goods_list($order['id']);
		if($_M['user']['balance'] >= $order['price']){
			$user_have_balance = 1;
		}else{
			$user_have_balance = 0;
		}		
		foreach($goods_list as $key=>$val){
			$goods_str.= "{$val['pname']}";
			$goods_str.= "*{$val['pamount']} ";	
		}	
		
		$pay_list = load::mod_class('pay/include/class/interface_pay', 'new')->get_pay_list();
		foreach($pay_list as $key=>$val){
			$pay_list[$key]['url'] = "{$_M['url']['shop_pay_payment']}&id={$order[id]}&type={$key}";
		}
		if($pay_list['weixin']['url']){
			$pay_list['weixin']['check_url'] = $pay_list['weixin']['check_url'].$order['orderid'];
		}
		if($pay_list['weixin_h5']['url']){
			$pay_list['weixin_h5']['check_url'] = $pay_list['weixin_h5']['check_url'].$order['orderid'];
		}
		
		require_once $this->template('tem/shop_pay_order');
	}
	
	public function do_ajax_total(){
		global $_M;
		$pgoods = $this->get_pay($_M['form']['cidlist']);
		$amount = 0;
		foreach($pgoods as $val){
			$amount = $amount+$val['amount'];
		}
		$price['amount'] = $amount;
		$dis = load::own_class('web/class/web_discount', 'new')->get_coupon_by_id($_M['form']['discount']);
		$add = load::own_class('web/class/web_address', 'new')->get_address_by_id($_M['form']['addressid']);
		$func = load::own_class('web/class/web_func', 'new');
		
		$price['price'] = $this->total_price($pgoods);
		$price['cprice'] = 0;
		
		if($dis['par']){
			$price['discount_id'] = $dis['id'];
			$price['discount'] = 0 - $dis['par'];
			$price['discount_info'] = $dis['name'].'使用优惠';
		}else{
			$price['discount_id'] = 0;
			$price['discount'] = 0;
			$price['discount_info'] = '';
		}
		$price['freight'] = $this->total_freight($pgoods, $add['zone_p'], $_M['form']['invoice_is']);
		$price['tprice'] = $price['price'] + $price['freight'] + $price['discount'];
		
		$price['price_str'] = $func->price_str($price['price']);
		$price['freight_str'] = $func->price_str($price['freight']);
		$price['discount_str'] = $func->price_str($price['discount']);
		$price['tprice_str'] = $func->price_str($price['tprice']);
		$price = load::plugin('doshopv2_order_total', 1, array('price'=>$price));
		echo jsonencode($price);
		die();
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