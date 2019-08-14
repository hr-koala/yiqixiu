<!--<?php
echo <<<EOT
-->
<!--
EOT;
if(!$notopnav){ 
echo <<<EOT
-->
	<div class="dropdown visible-xs-block visible-sm-block margin-bottom-15">
		<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown"><i class="icon wb-menu pull-right" aria-hidden="true"></i>{$_M['word']['app_shop_ordercenter']}</button>
		<ul class="dropdown-menu bullet dropdown-menu-right" role="menu">
			<li class="{$usernav[1]}" role="presentation"><a href="{$_M['url']['shop_profile']}">{$_M['word']['app_shop_personal']}</a></li>
			<li class="{$usernav[2]}" role="presentation"><a href="{$_M['url']['shop_order']}">{$_M['word']['app_shop_myorder']}</a></li>
			<li class="{$usernav[3]}" role="presentation"><a href="{$_M['url']['shop_address']}">{$_M['word']['app_shop_address']}</a></li>
			<li class="{$usernav[4]}" role="presentation"><a href="{$_M['url']['shop_member_base']}&nojump=1" target="_blank">{$_M['word']['app_shop_settings']}</a></li>
		</ul>
	</div>
<!--
EOT;
} 
echo <<<EOT
-->
	<div class="row">
		<div class="col-md-3 visible-md-block visible-lg-block">
			<div class="panel margin-right-15">
				<div class="panel-body shopcenter-nav-body">
					<h5 class="font-size-18 font-weight-unset">{$_M['word']['app_shop_ordercenter']}</h5>
					<ul class="list-group">
						<li class="list-group-item {$usernav[1]}"><a href="{$_M['url']['shop_profile']}">{$_M['word']['app_shop_personal']}</a></li>
						<li class="list-group-item {$usernav[2]}"><a href="{$_M['url']['shop_order']}">{$_M['word']['app_shop_myorder']}</a></li>
						<li class="list-group-item {$usernav[3]}"><a href="{$_M['url']['shop_address']}">{$_M['word']['app_shop_address']}</a></li>
						<li class="list-group-item {$usernav[4]}"><a href="{$_M['url']['shop_member_base']}&nojump=1" target="_blank">{$_M['word']['app_shop_settings']}</a></li>
					</ul>
				</div>
			</div>
		</div>
<!--
EOT;
?>