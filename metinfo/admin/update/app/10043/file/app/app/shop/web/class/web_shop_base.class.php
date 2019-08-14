<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');
/**
 * 产品模块
 */

class web_shop_base extends web {	

	public function __construct() {
		global $_M;
		parent::__construct();
		$this->de_construct();
		$this->check();
	}
	
	public function de_construct() {
		global $_M;
		$_M['config']['metinfover'] = 'v1';
		$_M['config_shop']['class1'] = $_M['form']['class1'];
		//$_M['config']['met_webhtm'] = 0;
		if($_M['form']['no_order'] || $_M['form']['searchlist']){
			//$_M['config']['met_pseudo'] = 0;
		}
		$shopuser =  load::own_class('web/class/web_shop_user', 'new')->get_user_by_username($_M['user']['username']);		
		if($_M['user']['username']){
			$_M['user']['balance'] = $shopuser['balance'];
			$_M['user']['balance_str'] = load::own_class('web/class/web_func', 'new')->price_str($_M['user']['balance']);
		}
		$this->seo();
		$this->tem_dir();
		$this->load_config($_M['lang']);
	}
	
	public function seo() {
		global $_M;

		$php_self = explode('/', PHP_SELF);
		if($php_self[count($php_self)-2] == 'shop'){
			$_M['config']['met_title'] = $_M['config']['met_webname']."-在线订购";
		}
	}
	
	public function url() {
		load::own_class('web/class/web_shop_plugin', 'new')->url();
	}
	
	public function user_login_info() {
		return load::own_class('web/class/web_shop_plugin', 'new')->user_login_info();
	}	
	protected function template($path){
		global $_M;
		if($_M['custom_template']['sys_content']){
			$flag = 1;
		}else{
			$flag = 0;
		}
		if(count(explode('/',$path)) == 3){
			list($postion, $file1, $file2) = explode('/',$path);
			$file = $file1.'/'.$file2;
		}else{
			list($postion, $file) = explode('/',$path);
			
		}
		if ($postion == 'own') {
			$_M['custom_template']['sys_content'] = PATH_OWN_FILE."templates/{$file}.php";
		}
		if ($postion == 'ui') {
			if(file_exists(PATH_SYS."include/public/ui/web/{$file}.php")){
				return PATH_SYS."include/public/ui/web/{$file}.php";
			}else{
				if($_M['config']['metinfover']){
					return PATH_WEB."public/ui/{$_M['config']['metinfover']}/{$file}.php";
				}else{
					return PATH_WEB."public/ui/met/{$file}.html";
				}
			}
		}
		
		if($postion == 'tem'){
			if($file == 'shop_showproduct' || $file == 'shop_product'){
				if (file_exists(PATH_SHOP_TEM."{$file}.html")) {
					$_M['custom_template']['sys_content'] = PATH_SHOP_TEM."{$file}.html";
				}else if (file_exists(PATH_SHOP_TEM."{$file}.php")) {
					$_M['custom_template']['sys_content'] = PATH_SHOP_TEM."{$file}.php";
				}else if (file_exists(PATH_ALL_APP."shop/web/templates/met/{$file}.php")) {
					$_M['custom_template']['sys_content'] = PATH_ALL_APP."shop/web/templates/met/{$file}.php";
				}else{
					$_M['custom_template']['sys_content'] = 'compatible';
					if($file == 'shop_showproduct'){
						$this->get_engine();
						$_M['custom_template']['sys_content'] = $this->template("tem/showproduct");
					}
					if($file == 'shop_product'){
						$this->get_engine();
						$_M['custom_template']['sys_content'] = $this->template("tem/product");
					}
					
				}
			}else{
				if (file_exists(PATH_SHOP_TEM."{$file}.html")) {
					$_M['custom_template']['sys_content'] = PATH_SHOP_TEM."{$file}.html";
				}else if (file_exists(PATH_SHOP_TEM."{$file}.php")) {
					$_M['custom_template']['sys_content'] = PATH_SHOP_TEM."{$file}.php";
				}else if (file_exists(PATH_ALL_APP."shop/web/templates/met/{$file}.php")) {
					$_M['custom_template']['sys_content'] = PATH_ALL_APP."shop/web/templates/met/{$file}.php";
				}else{
					$_M['custom_template']['sys_content'] = $this->template("ui/{$file}");
				}		
			}
		}		
		if($flag == 1){
			return $_M['custom_template']['sys_content'];
		}else{
			return $this->template('ui/compatible');
		}
	}
	protected function get_engine(){
		global $_M;
		$str = file_get_contents(PATH_WEB."templates/".$_M['config']['met_skin_user'].'/metinfo.inc.php');
		if(stristr($str, 'metinfover') && stristr($str, 'v1')){
			$_M['config']['metinfover'] = 'v1';
		}else{
			$_M['config']['metinfover'] = '';
		}
	}
	
	protected function tem_dir(){
		global $_M;
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
		if(!($ua != '' && preg_match($uachar, $ua))){
			$_M['config']['met_skin_user'] = $_M['config']['met_skin_user'];
		}else{
			$_M['config']['met_skin_user'] = $_M['config']['wap_skin_user'];
		}
		//$_M['config']['met_skin_user'] = 'shopv2';
		define('PATH_SHOP_TEM', PATH_WEB."templates/".$_M['config']['met_skin_user'].'/');//模板根目录
	}
	
	protected function load_config($lang) {	
		global $_M;
		$query = "SELECT * FROM {$_M['config']['tablepre']}config WHERE lang='{$lang}'";
		$result = DB::query($query);
		while ($list_config = DB::fetch_array($result)) {
			//$list_config['value'] = str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
			$list_config['value'] = str_replace('&#34;', '"', str_replace("&#39;", "'",$list_config['value']));
			$_M['config'][$list_config['name']] = $list_config['value'];
		}
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>