<!--<?php
$met_title = $_M['word']['app_shop_personal'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<div class="page">
	<div class="container">
	<div class="page-content">
<!--
EOT;
$usernav[1] = 'active';
$notopnav = 1;
require_once $this->template('tem/shop_user_nav'); 
echo <<<EOT
-->
			<div class="col-md-9 shop-order shop-profile">
<div class="widget margin-bottom-0">
	<div class="widget-header bg-blue-600 text-center padding-30 padding-bottom-15">
		<a class="avatar avatar-100 img-bordered margin-bottom-10 bg-white" target="_blank" href="{$_M['url']['shop_member_base']}&nojump=1">
			<img src="{$_M['user'][head]}" alt="">
		</a>
		<div class="font-size-20 white">{$_M['user'][username]}</div>
		<div class="grey-300 font-size-14 margin-bottom-20">{$_M['user'][group_name]}</div>
	</div>
	<div class="widget-content">
		<div class="row no-space padding-vertical-20 padding-horizontal-30 text-center">
			<div class="col-md-4 col-xs-6">
				<div class="counter">
					<span class="counter-number cyan-600"><a href="{$_M['url']['shop_order']}&state=1">{$state1}</a></span>
					<div class="counter-label">{$_M['word']['app_shop_bepaid']}</div>
				</div>
			</div>
			<div class="col-md-4 col-xs-6">
				<div class="counter">
					<span class="counter-number cyan-600"><a href="{$_M['url']['shop_order']}&state=3">{$state3}</a></span>
					<div class="counter-label">{$_M['word']['app_shop_receipt']}</div>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 shop-profile-balance">
				<div class="counter">
					<span class="counter-number cyan-600"><a href="{$_M['url']['shop_finance']}">{$_M['user']['balance_str']}</a></span>
					<div class="counter-label">{$_M['word']['app_shop_balance']}</div>
				</div>
			</div>
		</div>
	</div>
	<div class="widget-content">
	<ul class="list-group list-group-bordered">
		<a href="{$_M['url']['shop_order']}" class="list-group-item padding-vertical-15">
			<i class="icon wb-order" aria-hidden="true"></i>{$_M['word']['app_shop_allorders']}<span class="site-menu-arrow"></span>
		</a>
		<a href="{$_M['url']['shop_address']}" class="list-group-item padding-vertical-15">
			<i class="icon wb-map" aria-hidden="true"></i>{$_M['word']['app_shop_address']}<span class="site-menu-arrow"></span>
		</a>
		<a href="{$_M['url']['shop_finance']}" class="list-group-item padding-vertical-15">
			<i class="icon wb-payment" aria-hidden="true"></i>{$_M['word']['app_shop_consumer']}<span class="site-menu-arrow"></span>
		</a>
		<a href="{$_M['url']['shop_member_base']}&nojump=1" target="_blank" class="list-group-item padding-vertical-15">
			<i class="icon wb-edit" aria-hidden="true"></i>{$_M['word']['app_shop_modifyinfo']}<span class="site-menu-arrow"></span>
		</a>
	</ul>
	</div>
</div>
			</div>
		</div>
	</div>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
--> 
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->