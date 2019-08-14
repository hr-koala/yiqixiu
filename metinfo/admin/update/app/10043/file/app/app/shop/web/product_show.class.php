<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');

/**
 * 产品模块
 */

class product_show extends web {	
	
	public function __construct($is_construct = 1) {
		global $_M;
		if($is_construct == 1)parent::__construct();
		$tmpincfile=PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
		include $tmpincfile;
		if($metadmin[productother]){
			$_M['config']['met_productTabok'] = $metadmin[productother] + 1;
			$_M['config']['met_productTabname'] = $_M['word'][pro_name01];
			$_M['config']['met_productTabname_1'] = $_M['word'][pro_name02];
			$_M['config']['met_productTabname_2'] = $_M['word'][pro_name03];
			$_M['config']['met_productTabname_3'] = $_M['word'][pro_name04];
			$_M['config']['met_productTabname_4'] = $_M['word'][pro_name05];
		}
		load::plugin('doproduct_show');//加载插件
	}
	
	public function doindex() {
		global $_M;
		require_once $this->template('tem/showproduct');
	}
	
	protected function template($path){
		global $_M;
		if($_M['custom_template']['sys_content']){
			$flag = 1;
		}else{
			$flag = 0;
		}
		list($postion, $file) = explode('/',$path);
		
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
			if (file_exists(PATH_TEM."{$file}.html")) {
				$_M['custom_template']['sys_content'] = PATH_TEM."{$file}.html";
			}else if (file_exists(PATH_TEM."{$file}.php")) {
				$_M['custom_template']['sys_content'] = PATH_TEM."{$file}.php";
			}else if (file_exists(PATH_SYS."web/user/templates/met/{$file}.php")) {
				$_M['custom_template']['sys_content'] = PATH_SYS."web/templates/met/{$file}.php";
			}else{
				$_M['custom_template']['sys_content'] = $this->template("ui/{$file}");
			}		
		}				
		if($flag == 1){
			return $_M['custom_template']['sys_content'];
		}else{
			return $this->template('ui/compatible');
		}
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>