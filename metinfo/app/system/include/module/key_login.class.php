<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('array');

class key_login extends web {//一键登录功能

	function __construct(){
		parent::__construct();
	}
	
	public function dologin(){
		global $_M;
		$_M['form']['metmd5'] = ''//自动登录发起串，由服务器传入
		if(1){//用curl模块远程访问服务器http://account.metinfo.cn/keylogin/md5check
			//$_M['form']['loginpass']服务器返回用于登陆的用户后台的账号密码MD5，如md5(md5(admin123456))
			//验证账号，密码进行登陆
		}
	}
	
	public function dotestlogin(){
		global $_M;
		$_M['form']['metmd5'] = ''//自动登录发起串，由服务器传入
		if(1){//用curl模块远程访问服务器http://account.metinfo.cn/keylogin/md5check
			//$_M['form']['loginpass']服务器返回用于登陆的用户后台的账号密码MD5，如md5(md5(admin123456))
			//验证账号密码。正确返回绑定成功,成功输出1，失败输出0
		}
	}
	
}


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>