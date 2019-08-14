<!--<?php
global $userinfo;
if(!$shop_sp)$met_title.= " —— {$_M['config']['met_webname']}";
$uipath = $_M['url']['static'];
$webpath = "{$_M[url][own]}web/templates/met/";
echo <<<EOT
--><!DOCTYPE HTML>
<html>
<head>
<title>{$met_title}</title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo {$_M[config][metcms_v]}"  data-variable="{$_M[config][met_weburl]}|{$_M[lang]}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}" />
<meta name="description" content="{$show['description']}" />
<meta name="keywords" content="{$show['keywords']}" />
<link href="{$_M[url][site]}favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="{$uipath}css/bootstrap.min.css">
<link rel="stylesheet" href="{$uipath}css/bootstrap-extend.min.css">
<link rel="stylesheet" href="{$uipath}assets/css/site.min.css">
<link rel="stylesheet" href="{$uipath}fonts/web-icons/web-icons.min.css">
<link rel="stylesheet" href="{$uipath}fonts/font-awesome/font-awesome.min.css">
<link rel="stylesheet" href="{$uipath}vendor/animsition/animsition.min.css">
<link rel="stylesheet" href="{$uipath}vendor/asscrollable/asScrollable.min.css">
<link rel="stylesheet" href="{$uipath}assets/examples/css/structure/navbars.min.css">
<link rel="stylesheet" href="{$webpath}css/shop.css">
<!--[if lt IE 9]>
<script src="{$uipath}vendor/html5shiv/html5shiv.min.js"></script>
<![endif]-->
<!--[if lt IE 10]>
<script src="{$uipath}vendor/media-match/media.match.min.js"></script>
<script src="{$uipath}vendor/respond/respond.min.js"></script>
<script src="{$uipath}js/classList.min.js"></script> 
<![endif]-->
<script src="{$uipath}vendor/modernizr/modernizr.min.js"></script>
<script src="{$uipath}vendor/breakpoints/breakpoints.min.js"></script>
<script>
Breakpoints();
</script>
<script>
	var jsonurl  = '{$_M['url']['shop_cart_jsonlist']}',
		totalurl = '{$_M['url']['shop_cart_modify']}',
		delurl 	 = '{$_M['url']['shop_cart_del']}',
		lang_emptycart = '{$_M['word']['app_shop_emptycart']}';
</script>
{$_M['html_plugin']['head_script']}{$appscriptcss}{$_M[config][met_headstat]}
<!--
EOT;
require_once $this->template('tem/shop_head_custom'); 
echo <<<EOT
-->
<!--
EOT;
?>