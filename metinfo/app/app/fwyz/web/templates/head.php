<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
$title  = $_YW['c']['column']['ctitle']?$_YW['c']['column']['ctitle']:$_M['config']['met_webname'];
echo <<<EOT
-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>{$title}</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta name="generator" content="MetInfo"  data-variable="{$_M[url][site]}|{$_M[lang]}|{$classnow}|{$id}|{$class_list[$classnow][module]}|{$_M[config][met_skin_user]}" />
<link rel="stylesheet" type="text/css" href="{$_M['url']['pub']}bootstrap/css/bootstrap.min.css" />
<script src="{$_M['url']['own']}js/jquery.min.js"></script>
{$_YW['head_script']}
</head>
<body>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>