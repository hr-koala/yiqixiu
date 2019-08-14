<!--<?php
$met_title = $_M['word']['app_shop_cart'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var lang_ok = '{$_M['word']['app_shop_ok']}',
		lang_cancel = '{$_M['word']['app_shop_cancel']}',
		lang_deleteok = '{$_M['word']['app_shop_deleteok']}',
		lang_price = '{$_M['word']['app_shop_price']}',
		lang_number = '{$_M['word']['app_shop_number']}',
		lang_subtotal = '{$_M['word']['app_shop_subtotal']}',
		lang_operation = '{$_M['word']['app_shop_operation']}',
		lang_errorrefresh = '{$_M['word']['app_shop_errorrefresh']}',
		lang_oos = '{$_M['word']['app_shop_oos']}',
		price_prefix = '{$_M['config']['shopv2_price_str_prefix']}',
		price_suffix = '{$_M['config']['shopv2_price_str_suffix']}',
		lang_commodity = '{$_M['word']['app_shop_commodity']}';
</script>
<div class="page">
	<div class="container">
	<div class="page-content" data-selectable="selectable">
<!--
EOT;
if($cartnum){
echo <<<EOT
-->
		<div class="height-400 vertical-align text-center cart-loader">
			<div class="loader vertical-align-middle loader-default"></div>
		</div>
		<div class="panel">
			<div class="panel-body cart-list-body hide animation-fade">
			</div>
		</div>
		<div class="panel">
			<div class="panel-body cart-total-body hide animation-fade">
				<div class="row">
					<div class="col-md-2 col-sm-2 col-xs-3 cart-all">
						<div class="checkbox-custom checkbox-danger width-100 cartall">
							<input type="checkbox" class="selectable-all" id="cartall" checked>
							<label for="cartall">{$_M['word']['app_shop_checkall']}</label>
						</div>
					</div>
					<div class="col-md-7 col-sm-6 col-xs-9 text-right">
						<span class="hidden-xs">{$_M['word']['app_shop_intotal']} <span class="cart-goodnum">{$goodnum}</span> {$_M['word']['app_shop_piece']}{$_M['word']['app_shop_commodity']}， </span>
						{$_M['word']['app_shop_total']} : 
						<span class="total-val red-600"></span>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 text-right">
						<a href="javascript:void(0)" data-url="{$_M['url']['shop_pay']}" class="btn btn-lg btn-squared btn-danger padding-horizontal-30 cart-tocheck" disabled>{$_M['word']['app_shop_gosettlementabbr']}</a>
					</div>
				</div>
			</div>
		</div>
<!--
EOT;
}else{
echo <<<EOT
-->
		<div class="panel">
			<div class="panel-body cart-not">
				<div class="row">
					<div class="col-md-4 iconbox">
						<i class="icon wb-shopping-cart animation-slide-top" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 txt animation-fade">
						<h1>{$_M['word']['app_shop_emptycart']}</h1>
						<a href="{$_M['url'][site]}" class="btn btn-lg btn-squared btn-outline btn-danger">{$_M['word']['app_shop_goshopping']}</a>
					</div>
				</div>
			</div>
		</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
require_once $this->template('tem/shop_moregoods'); 
echo <<<EOT
-->
	</div>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<!--touchspin-->
<link rel="stylesheet" href="{$uipath}vendor/bootstrap-touchspin/bootstrap-touchspin.min.css">
<script src="{$uipath}vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<!--selectable-->
<script src="{$uipath}js/plugins/selectable.min.js"></script>
<!--appear-->
<script src="{$uipath}vendor/jquery-appear/jquery.appear.js"></script>
<script src="{$webpath}js/appear.js"></script>
<!--cart-->
<script src="{$webpath}js/cart.js"></script>
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->