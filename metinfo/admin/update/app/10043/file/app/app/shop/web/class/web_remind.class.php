<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class web_remind {

	function email($title, $body, $touser){
		global $_M;
		if(!$touser){
			$touser = get_met_cookie('email');
		}
		if($title || $body){
			$jmail = load::sys_class('jmail', 'new');
			$jmail->send_email($touser, $title, $body);
		}
		return true;
	}
	
	function sms($message, $phone){
		if(!$phone){
			$phone = get_met_cookie('tel');
		}
		if($message){
			$sms = load::sys_class('sms', 'new');
			$sms->sendsms($phone, $message, 6);
		}
		return true;
	}
	
		
	function admin(){
		global $_M;
		
		$list = explode('|', $_M['config']['shopv2_admintel']);
		foreach($list as $key=>$val){
			if($val)$this->sms('有新的订单，请登录后台查看！', $val);
		}
		
		$list = explode('|', $_M['config']['shopv2_adminemail']);
		foreach($list as $key=>$val){
			if($val)$this->email('有新的订单，请登录后台查看！', "<a href=\"{$_M['site_admin']}index.php?lang={$_M['lang']}&n=shop&c=order_admin&a=doindex\">{$_M['site_admin']}index.php?lang={$_M['lang']}&n=shop&c=order_admin&a=doindex</a>", $val);
		}
	}
	
	function user_nopay($order){
		global $_M;
		$_M['config']['shopv2_uemailtv1'] = $this->info($order, $_M['config']['shopv2_uemailtv1']);
		$_M['config']['shopv2_uemailcv1'] = $this->info($order, $_M['config']['shopv2_uemailcv1']);
		$_M['config']['shopv2_usmsv1'] = $this->info($order, $_M['config']['shopv2_usmsv1']);
		if($_M['config']['shopv2_is_uemailv1']){
			$this->email($_M['config']['shopv2_uemailtv1'], $_M['config']['shopv2_uemailcv1'], $order[email]);
		}
		if($_M['config']['shopv2_is_usmsv1']){
			$this->sms($_M['config']['shopv2_usmsv1'], $order['tel']);
		}
	}
	
	function user_pay($order){
		global $_M;
		$_M['config']['shopv2_uemailtv2'] = $this->info($order, $_M['config']['shopv2_uemailtv2']);
		$_M['config']['shopv2_uemailcv2'] = $this->info($order, $_M['config']['shopv2_uemailcv2']);
		$_M['config']['shopv2_usmsv2'] = $this->info($order, $_M['config']['shopv2_usmsv2']);
		if($_M['config']['shopv2_is_uemailv2']){
			$this->email($_M['config']['shopv2_uemailtv2'], $_M['config']['shopv2_uemailcv2'],$order[email]);
		}
		if($_M['config']['shopv2_is_usmsv2']){
			$this->sms($_M['config']['shopv2_usmsv2'], $order['tel']);
		}
	}
	
	function user_send($order){
		global $_M;
		$_M['config']['shopv2_uemailtv3'] = $this->info($order, $_M['config']['shopv2_uemailtv3']);
		$_M['config']['shopv2_uemailcv3s'] = $this->info($order, $_M['config']['shopv2_uemailcv3']);
		$_M['config']['shopv2_usmsv3'] = $this->info($order, $_M['config']['shopv2_usmsv3']);
		if($_M['config']['shopv2_is_uemailv3']){
			$this->email($_M['config']['shopv2_uemailtv3'], $_M['config']['shopv2_uemailcv3'], $order[email]);
		}
		if($_M['config']['shopv2_is_usmsv3']){
			$this->sms($_M['config']['shopv2_usmsv3'], $order['tel']);
		}
	}
	
	function info($order, $info){
		$info = str_replace('{rid}', $order['orderid'], $info);
		$info = str_replace('{user}', $order['username'], $info);
		$info = str_replace('{logistics}', $order['cinfo'], $info);
		$info = str_replace('{odd}', $order['oinfo'], $info);
		return $info;
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>