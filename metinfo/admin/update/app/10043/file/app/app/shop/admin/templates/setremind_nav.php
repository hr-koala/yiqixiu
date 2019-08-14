<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<ul class="nav nav-tabs nav-tabs-line">
	<li {$shopnav[2]}><a href="{$_M['url']['own_name']}c=shopset&a=dosetremind_user">用户提醒</a></li>
	<li {$shopnav[1]}><a href="{$_M['url']['own_name']}c=shopset&a=dosetremind_admin">管理员提醒</a></li>
</ul>
<!--
EOT;
?>