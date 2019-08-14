<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_shop_base');

class cart extends web_shop_base{	
	
	public $cart;
	
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->cart = load::own_class('web/class/web_cart', 'new');
	}
	
	public function doindex() {
		global $_M;
		$cart = $this->cart->cart_list();
		$cartnum = count($cart);
		require_once $this->template('tem/shop_cart');
	}
	
	public function dotocart(){
        global $_M;
        $num = $_M['form']['num'];
        list($pid, $para_str) = explode('|', trim($_M['form']['pid'], ','));
        $para_str = str_replace('u002A', '*', $para_str);
        $info['pid'] = $pid;
        $info['para_str'] = $para_str;
        $info['amount'] = $num;
        $stock = load::own_class('web/class/web_goods', 'new')->stock_list($info);
        $data['buy_ok'] = $stock['buy_ok'];
        $data['stock'] = $stock['stock'];
         
        if($data['buy_ok'] == 0){
            okinfo(-1,$_M['word']['app_shop_lowstocks']);
        }
        $data = array();
        $data[$info['pid']]['pid'] = $info['pid'];
        $purchase = load::own_class('web/class/web_goods', 'new')->purchase_list($data);
 
        if($num > $purchase[$info['pid']]){
            okinfo(-1,$_M['word']['app_shop_lowpurchase']);
        }
         
        $goods = $this->cart->get_cart_by_pid($pid, $para_str);
        if($goods){
            $min_amount = min($stock['stock'], $purchase[$info['pid']]);
            if($min_amount - $goods['amount'] < $num){
                $num = $min_amount - $goods['amount'];
                $num = $num ? $num : 0;
            }else{
                $num = $num;
            }
        }
 
        $id = $this->cart->tocrat($pid, $para_str, $num);
         
        if($_M['form']['action'] == 'buynow'){
            header("Location: {$_M['url']['shop_pay']}&cidlist={$id}");
        }else{
            header("Location: {$_M['url']['shop_cart']}&a=domycart&id={$id}");
         
        }
         
    }

     public function domycart()
    {
        global $_M;
        $id = $_M['form']['id'];
        load::plugin('doshopv2_tocart_afert', 0, array('id'=>$id));//加载插件
        $tocrat = $this->cart->analysis($this->cart->get_cart_by_id($id));
        if(!$tocrat['id']){
            header("location:{$_M['url']['shop_cart']}");
        }
        require_once $this->template('tem/shop_tocart');
    }
	
	public function dojson_cart_list() {
		global $_M;
		$search .= " and uid = '".get_met_cookie('id')."' ";
		$data = $this->cart->json_cart_list($search, $order);
		$data = load::plugin('doshopv2_cart', 1, array('cart'=>$data));//加载插件
		echo jsonencode($data);
	}
	
	public function domodify() {
		global $_M;
		if($_M['form']['id']){
			$info['id'] = $_M['form']['id'];
			$info['amount'] = $_M['form']['amount']>0?$_M['form']['amount']:1;
			
			$cart = $this->cart->get_cart_by_id($info['id']);
			$goods = load::own_class('web/class/web_goods', 'new')->get_goods_by_pid($cart['pid'],0,0,1);
			$shopmax = $goods['purchase']?$goods['purchase']:$goods['stock'];
			
			$purchase = load::own_class('web/class/web_goods', 'new')->purchase_list($goods);
			if($purchase[$cart['pid']]){
				$shopmax = $purchase[$cart['pid']];
			}
			if($info['amount']>$shopmax){
				$info['amount'] = $shopmax;
			}
			$this->cart->save_cart($info);
		}
		$cart = $this->cart->cart_list();
		$cart = $this->cart->analysis_array($cart);

		$price = load::own_class('web/class/web_func', 'new')->price_plugin($cart);
		$return['message'] = 'ok';
		$return['price'] = $price;
		
		jsoncallback($return);
	}
	
	public function dodel() {
		global $_M;
		$this->cart->del_cart($_M['form']['id']);
		$this->ajax_success($_M['word']['app_shop_delok']);
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