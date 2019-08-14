<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$uipath = $_M['url']['static'];
require $this->template('own/config');
/*
<a class="list-group-item {$active['5']}" href="{$_M['url']['adminurl']}n=shop&c=discount_admin&a=doindex"><i class="icon wb-bookmark" aria-hidden="true"></i>优惠卷</a>
<a class="list-group-item {$active['7']}" href="{$_M['url']['adminurl']}n=shop&c=searchlist_admin&a=doindex"><i class="icon wb-search" aria-hidden="true"></i>商品筛选</a>
*/
$state3 = load::own_class('web/class/web_order', 'new')->get_order_total("and state = '2'");
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<title>{$_M[word][metinfo]}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<link href="{$_M[url][site]}favicon.ico" rel="shortcut icon" type="image/x-icon" />
{$resui[css]}
<!--<link rel="stylesheet" href="{$uipath}css/bootstrap.min.css">
<link rel="stylesheet" href="{$uipath}css/bootstrap-extend.min.css">
<link rel="stylesheet" href="{$uipath}assets/css/site.min.css">
<link rel="stylesheet" href="{$_M[url][own]}admin/templates/css/shop.css">-->
<!--
EOT;
// require $this->template('own/path');
echo <<<EOT
-->
<!--[if lt IE 9]>
<script src="{$uipath}vendor/html5shiv/html5shiv.min.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<script src="{$uipath}vendor/media-match/media.match.min.js"></script>
<script src="{$uipath}vendor/respond/respond.min.js"></script>
<![endif]-->
<!-- Scripts -->
<!--<script src="{$uipath}vendor/modernizr/modernizr.min.js"></script>
<script src="{$uipath}vendor/breakpoints/breakpoints.min.js"></script>
<script>
Breakpoints();
</script>-->
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">你正在使用一个<strong>过时</strong>的浏览器。请<a href="http://browsehappy.com/" target="_blank">升级您的浏览器</a>，以提高您的体验。</p>
<![endif]-->
<div class="page animsition">
<!--
EOT;
$navlist = 1;
if($navlist){
	$state3_html = $state3?"<span class=\"item-right badge badge-danger\">{$state3}</span>":'';
echo <<<EOT
-->
	<div class="page-aside">
		<section class="page-aside-section">
			<h5 class="page-aside-title">订单</h5>
			<div class="list-group">
				<a class="list-group-item {$active['1']}" href="{$_M['url']['adminurl']}n=shop&c=order_admin&a=doindex"><i class="icon wb-pie-chart" aria-hidden="true"></i>订单概况</a>
				<a class="list-group-item {$active['2']}" href="{$_M['url']['adminurl']}n=shop&c=order_admin&a=doorder_list">
					{$state3_html}
					<i class="icon wb-order" aria-hidden="true"></i>所有订单
				</a>
				<a class="list-group-item {$active['3']}" href="{$_M['url']['adminurl']}n=shop&c=finance_admin&a=doindex"><i class="icon wb-payment" aria-hidden="true"></i>财务明细</a>
				<a class="list-group-item {$active['4']}" href="{$_M['url']['adminurl']}n=shop&c=shopset&a=doindex"><i class="icon wb-settings" aria-hidden="true"></i>设置</a>
				<a class="list-group-item {$active['6']}" href="{$_M['url']['adminurl']}n=shop&c=shophelp&a=doindex"><i class="icon wb-help-circle" aria-hidden="true"></i>帮助</a>
			</div>
		</section>
		<section class="page-aside-section">
			<h5 class="page-aside-title">应用</h5>
			<div class="list-group">
				<a class="list-group-item {$active['5']}" href="{$_M['url']['adminurl']}n=shop&c=shopset&a=dosetremind_user"><i class="icon wb-bell" aria-hidden="true"></i>订单提醒</a>
				<a class="list-group-item disabled" href="#">更多功能即将推出</a>
			</div>
		</section>
	</div>
<!--
EOT;
}
echo <<<EOT
-->
	<div class="page-main">
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>