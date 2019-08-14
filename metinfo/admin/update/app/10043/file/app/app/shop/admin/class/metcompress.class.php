<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
$_M['url']['static'] = $_M['url']['static']?$_M['url']['static']:$_M['url']['sta'];
class metcompress {
	public $config;
	public $cache;
	public $shopadminpath;
	public $relative_cache;
	public $prefix;
	public $ui_version;
	public $is_Ie9;
	public function __construct() {
		global $_M;
		$this->cache 	= true;
		$this->shopadminpath = "{$_M[url][site]}app/app/shop/admin/templates/";
		$this->relative_cache= "../app/app/shop/admin/templates/cache/";
		$ui_version_default = '?'.date('YmdHis');
		$this->ui_version = array(css=>$ui_version_default,js=>$ui_version_default);
		$this->is_Ie9   = strpos($_SERVER["HTTP_USER_AGENT"],'MSIE 9');
	}
	//组件调用
	public function getui($paths){
		if($this->cache){
			//开启缓存
			$cache_url= "{$this->shopadminpath}cache/";
			$filename=$this->prefix.$_GET[c].'_'.$_GET[a];
			if($this->is_Ie9){
				for ($i=1; $i <= 4; $i++) {
					$retun[css][]="{$cache_url}common_ie9_{$i}.css";
				}
			}else{
				$retun[css][]="{$cache_url}common.css";
			}
			if(file_exists("{$this->relative_cache}{$filename}.css")) $retun[css][]="{$cache_url}{$filename}.css";
			$retun[js][]="{$cache_url}common.js";
			if(file_exists("{$this->relative_cache}{$filename}.js")) $retun[js][]="{$cache_url}{$filename}.js";
		}else{
			// 合并资源输出路径
			if(!is_array($paths)) $paths = explode(',',$paths);
			foreach($paths as $val){
				$hz = pathinfo($val,PATHINFO_EXTENSION);
				if($hz=='css')$uimerge_css[] = $val;
				if($hz=='js')$uimerge_js[] = $val;
			}
			$retun[css]    = $this->uicss($uimerge_css);
			$retun[js]     = $this->uijs($uimerge_js);
		}
		//输出UI html
		foreach ($retun[css] as $key => $val) {
	    	$resui[css].="<link rel='stylesheet' href='{$val}{$this->ui_version[css]}'>";
	    	if($key<count($retun[css])-1) $resui[css].="\n";
	    }
		foreach ($retun[js] as $key => $val) {
	    	$resui[js].="<script src='{$val}{$this->ui_version[js]}'></script>";
	    	if($key<count($retun[js])-1) $resui[js].="\n";
	    }

		return $resui;
	}
	//UICSS
	public function uicss($paths,$merge_only){
		global $_M;
		$uide = array(
				"{$_M['url']['static']}css/bootstrap.min.css",
				"{$_M['url']['static']}css/bootstrap-extend.min.css",
				"{$_M['url']['static']}assets/css/site.min.css",
				"{$_M[url][own]}admin/templates/css/shop.css"
			);
		if($merge_only!='uimerge_css_only'){
			// IE9兼容，common样式文件打包成4份
			$ui_ie9=$uide;
			foreach ($ui_ie9 as $key => $value) {
				$order=$key+1;
				$uicss_ie9[]=$this->uimerge($value,'css','','','common_ie9_'.$order,$merge_only);
			}
			if($paths && $this->is_Ie9) $uicss_ie9[]=$this->uimerge($paths,'css');
		}
		if($this->is_Ie9){
			return $uicss_ie9;
		}else{
			$uicss[]=$this->uimerge($uide,'css','','','common');
			if($paths) $uicss[]=$this->uimerge($paths,'css');
			return $uicss;
		}
	}
	//UIJS
	public function uijs($paths,$merge_only){
		global $_M;
		$uide = array(
				"{$_M['url']['static']}vendor/jquery/jquery.min.js",
				"{$_M['url']['static']}vendor/bootstrap/bootstrap.min.js",
				"{$_M['url']['static']}vendor/breakpoints/breakpoints.min.js",//媒体查询
				"{$_M['url']['static']}js/core.min.js",
				"{$_M['url']['static']}assets/js/site.min.js",
				"{$_M['url']['static']}vendor/modernizr/modernizr.min.js",//监测浏览器支持
				"{$_M[url][own]}admin/templates/js/own.js"
			);
		$uijs[]=$this->uimerge($uide,'js','','','common');
		if($paths) $uijs[]=$this->uimerge($paths,'js');
		return $uijs;
	}
	//合并
	public function uimerge($paths,$suffix,$prependcode,$appendcode,$filename,$merge_only){
		global $_M;
		//文件
		if(!is_array($paths)) $paths = explode(',',$paths);
		foreach($paths as $val){
			$urls[]=$val=str_replace($_M['url']['site'],"../",$val);
			if(!file_exists($val)) echo "{$val}文件不存在\n";
		}
		// dump(count($paths));
		//路径
		if(!$filename){
			$filename = $_GET[c].'_'.$_GET[a];
			if($this->prefix)$filename = $this->prefix.$filename;
		}
		$file_uimerge = "{$this->relative_cache}{$filename}.{$suffix}";
		// dump($file_uimerge);
		//内容
		$code = $this->get_content($urls,$suffix,$prependcode,$appendcode);
		//生成
		$file = fopen($file_uimerge, "w");
		foreach($code as $val){
			if($val['code']){
				fwrite($file, "/*{$val['name']}*/\n{$val['code']}\n");
			}
		}
		fclose($file);
		if(!$merge_only) return $file_uimerge;
	}
	//抓取内容
	public function get_content($urls,$suffix,$prependcode,$appendcode){
		if($prependcode){//前置
			foreach($prependcode as $val){
				$code[] = $val;
			}
		}
		foreach($urls as $val){
			$codea['name'] = pathinfo($val,PATHINFO_BASENAME);
			$codea['code'] = $this->ps_content($val,$suffix);
			$code[] = $codea;
			if(strpos($val,'breakpoints')){
				$codea['name'] = 'Breakpoints';
				$codea['code'] = 'Breakpoints();';
				$code[] = $codea;
			}
		}
		if($appendcode){//追加
			foreach($appendcode as $val){
				$code[] = $val;
			}
		}
		return $code;
	}
	//内容处理
	public function ps_content($val,$suffix){
		$code = file_get_contents($val);
		if($suffix=='css'){
			$adurl = "../../../../../".dirname($val).'/';
			$code = preg_replace('/url\(["\']*([\.\/]*)([^:]*?)["\']*\)/', 'url('.$adurl.'\1'.'\2'.')', $code);
		}
		return $code;
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>