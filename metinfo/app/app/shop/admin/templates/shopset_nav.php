<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<ul class="nav nav-tabs nav-tabs-line">
	<li {$shopnav[1]}><a href="{$_M['url']['own_name']}c=shopset&a=doindex">基本设置</a></li>
	<li {$shopnav[2]}><a href="{$_M['url']['own_name']}c=shopset&a=dosetpay">支付设置</a></li>
	<li {$shopnav[3]}><a href="{$_M['url']['own_name']}c=freight_admin&a=doindex">运费模板</a></li>
</ul>
<!--
EOT;
?>