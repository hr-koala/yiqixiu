<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class goods_admin extends admin {
	public $goods;
	public function __construct() {
		parent::__construct();
		global $_M;
		//load::own_class('admin/class/shop_nav', 'new');
		//nav::select_nav(2);
		$this->goods = load::own_class('admin/class/sys_goods', 'new');
	}
	
	public function dojson_goods_list(){
		global $_M;
		$search.= $class1?"and class1 = '{$class1}'":''; 
		$search.= $class2?"and class2 = '{$class2}'":'';
		$search.= $class3?"and class3 = '{$class3}'":'';
		$order = '';
		$data = $this->goods->json_product_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[pid]}\">";
			$list[] = $val['title'];
			$list[] = $val['price'];
			$list[] = $val['hits'];		
			$list[] = '库存';
			$list[] = '销量';
			$list[] = timeFormat(strtotime($val['addtime']));
			$list[] = "<a href=\"{$_M['url']['site_admin']}content/product/content.php?anyid=29&action=editor&class1={$val['class1']}&class2={$val['class2']}&class3={$val['class3']}&page=0&lang=cn&id=14&cengci=1\" target=\"_blank\">内容信息</a> 
			<a href=\"{$_M['url']['own_form']}a=doeditor_goods&id={$val[pid]}\">商品信息</a> 
			<a href=\"{$_M['url']['own_form']}a=dododel_goods&id={$val[pid]}\">删除</a> 复制";
			$rarray[] = $list;
		}
		$this->goods->json_return($rarray);	
	}

	public function doindex(){
		global $_M;
		require_once $this->template('own/goods_index');
	}	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>