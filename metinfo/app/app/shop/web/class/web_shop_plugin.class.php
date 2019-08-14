<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');


/**
 * 插件
 */

class web_shop_plugin {	
		public function url() {
		global $_M;
		if(!strstr(PHP_SELF, '/member/')){
			$_M['url']['tem'] = $_M['url']['site'].'templates/shopv2/';
		}
		$_M['url']['shop'] =  $_M['url']['site'].'shop/';
		$_M['url']['shop_ui'] =  $_M['url']['site'].'app/app/shop/web/templates/met/';
		$_M['url']['product'] =  $_M['url']['site'].'product/';
		
		$_M['url']['shop_pay'] = $_M['url']['shop']."pay.php?lang=".$_M['lang'];
		$_M['url']['shop_pay_payali'] = $_M['url']['site']."shop/ali_payto.php?lang=".$_M['lang'];
		$_M['url']['shop_pay_weixin'] = $_M['url']['site']."shop/wx_pay.php?lang=".$_M['lang'];
		$_M['url']['shop_pay_payment'] = $_M['url']['shop']."pay.php?a=dopayment&lang=".$_M['lang'];
		$_M['url']['shop_pay_payorder'] = $_M['url']['shop']."pay.php?a=dopayorder&lang=".$_M['lang'];
		$_M['url']['shop_pay_placeorder'] = $_M['url']['shop']."pay.php?a=doplaceorder&lang=".$_M['lang'];
		$_M['url']['shop_recharge_index'] = $_M['url']['shop']."pay.php?a=dorecharge&lang=".$_M['lang'];
		$_M['url']['shop_recharge_pay'] = $_M['url']['shop']."pay.php?a=dopayrecharge&lang=".$_M['lang'];
		
		$_M['url']['shop_ajax_total'] = $_M['url']['shop']."pay.php?a=do_ajax_total&lang=".$_M['lang'];
		
		$_M['url']['shop_finance'] = $_M['url']['shop']."finance.php?lang=".$_M['lang'];
		
		$_M['url']['shop_order'] = $_M['url']['shop']."order.php?lang=".$_M['lang'];
		$_M['url']['shop_order_check'] = $_M['url']['shop']."order.php?a=docheck&lang=".$_M['lang'];
		$_M['url']['shop_order_close'] = $_M['url']['shop']."order.php?a=doorder_close&lang=".$_M['lang'];
				
		$_M['url']['shop_cart'] = $_M['url']['shop']."cart.php?lang=".$_M['lang'];
		$_M['url']['shop_cart_jsonlist'] = $_M['url']['shop']."cart.php?a=dojson_cart_list&lang=".$_M['lang'];
		$_M['url']['shop_cart_modify'] = $_M['url']['shop']."cart.php?a=domodify&lang=".$_M['lang'];
		$_M['url']['shop_cart_del'] = $_M['url']['shop']."cart.php?a=dodel&lang=".$_M['lang'];
		
		$_M['url']['shop_tocart'] = $_M['url']['shop_cart']."&a=dotocart";
		$_M['url']['shop_tocart_now'] = $_M['url']['shop_cart']."&a=dotocart&action=buynow";
		
		$_M['url']['shop_profile'] = $_M['url']['shop']."profile.php?lang=".$_M['lang'];
		
		$_M['url']['shop_address'] = $_M['url']['shop']."address.php?lang=".$_M['lang'];
		$_M['url']['shop_addr_index'] = $_M['url']['shop']."address.php?a=do_address_zone&lang=".$_M['lang'];
		$_M['url']['shop_addr_editor'] = $_M['url']['shop']."address.php?a=do_address_editor&lang=".$_M['lang'];
		$_M['url']['shop_addr_del'] = $_M['url']['shop']."address.php?a=do_address_del&lang=".$_M['lang'];
		$_M['url']['shop_addr_de'] = $_M['url']['shop']."address.php?a=do_address_de&lang=".$_M['lang'];
		
	
		//$_M['url']['member_base'] = $_M['url']['site'].'member/base.php?lang='.$_M['lang'];
		//$_M['url']['member_login'] = $_M['url']['site'].'member/login.php?lang='.$_M['lang'];
		//$_M['url']['member_reg'] = $_M['url']['site'].'member/register_include.php?lang='.$_M['lang'];
		//$_M['url']['member_login_out'] = $_M['url']['site'].'member/register_include.php?lang='.$_M['lang'];
		
		//会员模块URL
		$lang = "?lang={$_M['lang']}";
		$_M['url']['shop_member_login'] = $_M['url']['site']."member/login.php{$lang}";
		$_M['url']['shop_member_reg'] = $_M['url']['site']."member/register_include.php{$lang}";
		$_M['url']['shop_member_getpassword'] = $_M['url']['site']."member/getpassword.php";
		$_M['url']['shop_member_login_out'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologout";	
		$_M['url']['shop_member_base'] = $_M['url']['site']."member/basic.php{$lang}"; 
		
		
		$_M['url']['shop_discount_receive'] = $_M['url']['shop']."discount.php?a=doreceive&lang=".$_M['lang'];
		$_M['url']['shop_discount_my'] = $_M['url']['shop']."discount.php?a=domydiscount&lang=".$_M['lang'];
		
		//$_M['url']['shop_searchlist'] = "index.php?lang={$_M['lang']}&class1={$_M['config_shop']['class1']}&no_order={$_M['form']['no_order']}";
		//if($_M['form']['no_order'] == '')$_M['form']['no_order'] = 'sales_desc';
		if(!$_M['config']['met_pseudo']){
			$_M['url']['shop_searchlist'] = "index.php?lang={$_M['lang']}&searchlist=";
			$_M['url']['shop_searchs'] = "index.php?lang={$_M['lang']}&searchs=";

			$_M['url']['shop_no_order'] = "index.php?lang={$_M['lang']}&no_order={$_M['form']['no_order']}";
			
			$_M['url']['shop_no_order_by_sales'] = $_M['url']['shop_order'].'sales_desc';"index.php?lang={$_M['lang']}&no_order=sales_desc";
			
			$_M['url']['shop_no_order_by_time'] = $_M['url']['shop_order'].'time_desc';"index.php?lang={$_M['lang']}&no_order=time_desc";
		}else{
			if(0){
				$_M['url']['shop_searchlist'] = "tag-{$_M['lang']}-";
				$_M['url']['shop_searchs'] = "searchs-{$_M['lang']}-";

				$_M['url']['shop_no_order'] = "no_order-{$_M['lang']}-{$_M['form']['no_order']}";
				
				$_M['url']['shop_no_order_by_sales'] = "no_order-{$_M['lang']}-sales_desc";
				$_M['url']['shop_no_order_by_time'] = "no_order-{$_M['lang']}-time_desc";
			}else{
				$_M['url']['shop_searchlist'] = $_M['url']['product']."tag/";
				$_M['url']['shop_searchs'] = $_M['url']['product']."searchs/";

				$_M['url']['shop_no_order'] = $_M['url']['product']."no_order/";
				
				$_M['url']['shop_no_order_by_sales'] = $_M['url']['product']."no_order/sales_desc";
				$_M['url']['shop_no_order_by_time'] = $_M['url']['product']."no_order/time_desc";
			
			
			}
		}

		/*
		if($_M['form']['no_order']){
			$no_order = explode('|' ,$_M['form']['no_order']);
			if($no_order[0] == 'sales'){
				if($no_order[1] == 'asc'){
					$order['sales'] = 'sales|desc';
				}else{
					$order['sales'] = 'sales|asc';
				}
				$order['price'] = 'price|asc';
			}else if($no_order[0] == 'price'){
				if($no_order[1] == 'asc'){
					$order['price'] = 'price|desc';
				}else{
					$order['price'] = 'price|asc';
				}
				$order['sales'] = 'sales|asc';
			}else {
				$order['price'] = 'price|asc';
				$order['sales'] = 'sales|desc';
			}
		}else{
			$order['price'] = 'price|asc';
			$order['sales'] = 'sales|desc';
		}
		*/
		/*
		$_M['url']['shop_orderby_sales'] = "index.php?lang={$_M['lang']}&class1={$_M['config_shop']['class1']}&searchlist={$_M['form']['searchlist']}&no_order={$order['sales']}";
		$_M['url']['shop_orderby_price'] = "index.php?lang={$_M['lang']}&class1={$_M['config_shop']['class1']}&searchlist={$_M['form']['searchlist']}&no_order={$order['price']}";
		$_M['url']['shop_orderby_com'] = "index.php?lang={$_M['lang']}&class1={$_M['config_shop']['class1']}&searchlist={$_M['form']['searchlist']}&no_order=";
		*/
	}
	
	public function user_login_info() {
		global $_M;
		$username = get_met_cookie('username');
		if(!$username)$username = get_met_cookie('metinfo_member_name');
		if($username){
			$userinfo[0]['info'] = $username;
			$userinfo[0]['url'] = $_M['url']['member_base'];
		}else{
			$userinfo[0]['info'] = $_M['word']['login'];
			$userinfo[0]['url'] = $_M['url']['member_login'];
			$userinfo[1]['info'] = $_M['word']['memberRegister'];
			$userinfo[1]['url'] = $_M['url']['member_reg'];
		}
		return $userinfo;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>