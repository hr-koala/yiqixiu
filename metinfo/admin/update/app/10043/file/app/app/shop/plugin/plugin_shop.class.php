<?php

defined('IN_MET') or exit('No permission');

function get_goods_sprice_str($price){
	global $_M;
	$price = $price ? $_M['config']['shopv2_price_str_prefix'].number_format($price, 2, '.', '').$_M['config']['shopv2_price_str_suffix'] : $_M['config']['shopv2_price_str_prefix'].'0.00'.$_M['config']['shopv2_price_str_suffix'];
	return $price;
}
function get_goods($pid){
	global $_M,$db;
	$query = "SELECT * FROM {$_M['table']['shopv2_product']} WHERE pid = '{$pid}'";
	if($db){
		$data = $db->get_one($query);
	}else{
		$data = DB::get_one($query);
	}
	$data['price_str'] = get_goods_sprice_str($data['price']);
	$data['original_str'] = get_goods_sprice_str($data['original']);
	return $data;
}
class plugin_shop{

	public function doadmin(){
		global $_M;
		if(strpos($_SERVER['PHP_SELF'], 'content/product/index.php')){
			echo("<script type='text/javascript'>location.href='{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=content&c=product_admin&a=doindex&class1={$_M['form']['class1']}'</script>");
			exit;
		}
	}
	
	public function doweb(){
		
		global $_M,$userinfo;
		$dir = "app/app/shop/web/class/web_shop_plugin.class.php";
		if(file_exists('./'.$dir)){
			$is_have = 1;
			require_once './'.$dir;
		}
		if(file_exists('../'.$dir)){
			$is_have = 1;
			require_once '../'.$dir;
		}
		if(file_exists('../../'.$dir)){
			$is_have = 1;
			require_once '../../'.$dir;
		}
		if(file_exists('../../../'.$dir)){
			$is_have = 1;
			require_once '../../../'.$dir;
		}
		if($is_have == 1 && $_M['config']['shopv2_open'] == 1){
			$p = new web_shop_plugin();
			$p->url();
			$userinfo = $p->user_login_info();
		}
		$php_self  = explode('/', PHP_SELF);
		if($userinfo && $php_self[count($php_self) - 2] == 'member'){
			if($php_self[count($php_self) - 1] == 'index.php'){
				header('Location: ../shop/order.php?lang='.$_M['lang']);
				die();
			}
			
			/*
			if($php_self[count($php_self) - 1] == 'basic.php' && !$_M['form']['nojump']){
				header('Location: ../shop/order.php?lang='.$_M['lang']);
				die();
			}
			*/
		}
	}
	
	public function doproduct_list(){
		global $_M;
		load::own_class('web/shop_list', 'new')->doindex();
		die();
	}
	
	public function doproduct_show(){
		global $_M;
		load::own_class('web/shop_show', 'new')->doindex();
		die();
	}
	
	public function doproduct_plugin_class(){
			return load::app_class('shop/admin/class/sys_goods', 'new');
		
	}
	
	public function doseourl($para){
		$seourl = load::app_class('shop/admin/class/shop_seo_url', 'new');
		return $para['str'].$seourl->get($para['type']);
	}
	
	public function dopay($para){
		if($para['pay']['no'] == 10043){
			switch ($para['pay']['pay_type']) {
				case 1://微信扫码支付
					$para['pay']['pay_type'] = '微信扫码支付';
					break;
				case 2://财付通支付tenpay
					$para['pay']['pay_type'] = '财付通支付';
					break;
				case 3://支付宝支付
					$para['pay']['pay_type'] = '支付宝支付';
					break;
				case 4://网银支付
					$para['pay']['pay_type'] = '网银支付';
					break;
				case 5://PayPal支付
					$para['pay']['pay_type'] = 'PayPal支付';
					break;
				case 6://微信H5-JsApiPay支付
					$para['pay']['pay_type'] = '微信内支付';
				default:
					break;
			}
			load::app_class('shop/web/class/web_order', 'new')->order_pay($para['pay']['out_trade_no'], $para['pay']['pay_type'], $para['pay']['total_fee']);
		}
	}
	
	public function temporary_plugin_product_list($datainfo){
		global $searchlist,$searchs,$pricef,$pricet,$no_order,$gotonew;
		if($gotonew == 1){
			$goods = load::app_class('shop/web/class/web_goods', 'new');
			$data['dbname'] = $goods->get_sql_table();
			$sql = '';
			if($searchs){
				$sql .= $goods->get_sql_search($searchs, 1);
			}
			if($searchlist){
				$sql .= $goods->get_sql_search($searchlist, 2);
			}
			if($pricef || $pricet){
				$sql .= $goods->get_sql_price($pricef,$pricet);
			}
			
			$data['serch_sql'] = $datainfo['serch_sql']." {$sql} ";

			$data['order_sql'] = "ORDER BY ". $goods->get_sql_order($no_order);
			return $data;
		}
	}
	
	public function temporary_plugin_product_analysis($alist){
		global $gotonew;
		if($gotonew == 1){
			$alist = load::app_class('shop/web/class/web_goods', 'new')->analysis_array($alist);
			foreach($alist as $key=>$val){
				$alist[$key]['price_str'] = $val['price'] ? '￥'.number_format($val['price'], 2) : '￥0.00';
			}
		}
		return $alist;
		
	}
	
	public function temporary_plugin_product_page(){
		global $searchlist,$searchs,$pricef,$pricet,$no_order;
		global $_M;
		$url = '';		
		if($searchlist || $no_order || $searchs){
			if($searchlist){
				$url = $_M['url']['shop_searchlist'].$searchlist.'/';	
				return $url;
			}
			if($searchs){
				$url = $_M['url']['shop_searchs'].$searchs.'/';;	
				return $url;
			}
			if($no_order){
				$url = 	$_M['url']['shop_no_order'].$no_order.'/';
				return $url;
			}
			/*
			if($pricef){
				$str .= "&pricef={$pricef}";
			}
			if($pricet){
				$str .= "&pricet={$pricet}";
			}
			*/
		}
		return $url;
	}
}
?>