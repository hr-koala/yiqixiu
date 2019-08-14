<!--<?php
$met_title = $_M['word']['app_shop_order'].$_M['word']['app_shop_payment'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var lang = '{$_M['lang']}',paidokurl = '{$_M['url']['shop_order_check']}&id={$order['id']}',lang_paidok = '{$_M['word']['app_shop_paidok']}';
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-oder-top">
				<div class="row">
					<div class="col-md-2 col-sm-2 text-center">
						<i class="icon wb-check-circle green-400" aria-hidden="true"></i>
					</div>
					<div class="col-md-7 col-sm-6">
						<h1>{$_M['word']['app_shop_ordersuccess']}</h1>
<!--
EOT;
if($order['countdown']){
echo <<<EOT
-->
						<p>{$_M['word']['app_shop_please']} <span class="red-600">{$order['countdown']}</span> {$_M['word']['app_shop_pleasepayment']}</p>
<!--
EOT;
}
echo <<<EOT
-->
						<p>{$_M['word']['app_shop_ordernumber']} : <span class="red-600">{$order[orderid]}</span></p>
						<p><a href="javascript:void(0)" class="grey-600 visible-xs-block" data-toggle="collapse" data-target="#order-info">{$_M['word']['app_shop_orderdetails']} <span class="caret"></span></a></p>
						<div class="collapse" id="order-info">
							<div class="well margin-bottom-0">
								<p class="margin-bottom-0">{$_M['word']['app_shop_receiving']} : {$order[address_str]}</p>
								<p class="margin-bottom-0 margin-top-10">{$_M['word']['app_shop_commodity']} : 
<!--
EOT;
foreach($goods_list as $val){
echo <<<EOT
-->
									{$val[pname]} {$val[para]}
<!--
EOT;
}
echo <<<EOT
-->
								</p>
<!--
EOT;
if($order['invoice_info']){
echo <<<EOT
-->								
								<p class="margin-bottom-0 margin-top-10">{$_M['word']['app_shop_invoice']} : {$order[invoice_info][0]} {$order[invoice_info][1]} {$order[invoice_info][2]}</p>
<!--
EOT;
}
echo <<<EOT
-->							
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 text-right pay-order-price">
						{$_M['word']['app_shop_paytotal']} : <span class="red-600 font-size-20">{$order[tprice_str]}</span>
						<p class="margin-top-10 hidden-xs"><a href="javascript:void(0)" class="grey-600 margin-left-20" data-toggle="collapse" data-target="#order-info">{$_M['word']['app_shop_orderdetails']} <span class="caret"></span></a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body pay-oder-mode">
				<h4 class="panel-title">{$_M['word']['app_shop_paymod']}</h4>
				<hr>
				<div class="pay-oder-mode-body">
<!--
EOT;
if($pay_list['alipay']){
echo <<<EOT
-->				
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-zhifubao" data-toggle="modal" data-target="#pay-oder-modal">
						<a class="pay-online pay-oder-modal"  href="javascript:;" data-url="{$pay_list['alipay']['url']}" target="_blank"><img src="{$webpath}img/payOnline_zfb.png" /></a>
					</div>
<!--
EOT;
}
if($pay_list['weixin']){
echo <<<EOT
-->						
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-weixin">
						<a class="pay-online payment-weixin" href="javascript:;" data-url="{$pay_list['weixin']['url']}" target="_blank" data-check_url="{$pay_list['weixin']['check_url']}"><img src="{$webpath}img/weixinpay.png" /></a>
					</div>	
<!-- Modal -->
<div class="modal fade modal-primary" id="payment-weixin-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{$_M['word']['app_shop_scanpayment']}</h4>
			</div>
			<div class="modal-body text-center">
				
			</div>
		</div>
	</div>
</div>
<!--
EOT;
}
if($pay_list['weixin_h5']){
echo <<<EOT
-->	
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-weixin">
						<a class="pay-online payment-weixin-h5" href="javascript:void(0)" data-url="{$pay_list['weixin_h5']['url']}" data-check_url="{$pay_list['weixin_h5']['check_url']}"><img src="{$webpath}img/weixinpay.png" /></a>
					</div>
<!-- End Modal -->
<!-- Modal -->
<div class="modal fade modal-primary" id="payment-weixin-h5-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="height-100 vertical-align text-center order-loader"><div class="loader vertical-align-middle loader-default"></div></div>
	</div>
</div>
<!-- End Modal -->
<!--
EOT;
}
if($pay_list['upay']){
echo <<<EOT
-->						
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-union" data-toggle="modal" data-target="#pay-oder-modal">
						<a class="pay-online pay-oder-modal" href="javascript:;" data-url="{$pay_list['upay']['url']}" target="_blank"><img src="{$webpath}img/unionpay.png" /></a>
					</div>
<!--
EOT;
}
$disabled = $user_have_balance?'':'disabled';
$hide = $user_have_balance?'hide':'';
echo <<<EOT
-->
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-balance" data-toggle="collapse" data-target="#balanceinput" {$disabled}>
						{$_M['word']['app_shop_paybalance']}
						<span class="red-600">{$_M['user']['balance_str']}</span>
						<span class="red-600 {$hide}">{$_M['word']['app_shop_payinsufficient']}</span>
					</div>
				</div>
				<div class="collapse" id="balanceinput">
					<div class="well margin-bottom-0"">
						<form method="post" action="{$_M['url']['shop_pay_payment']}" id="pay-balance">
							<input name="type" type="hidden" value="balance">
							<input name="id" type="hidden" value="{$order[id]}">
							<div class="form-group margin-bottom-0">
								<input type="password" name="password" class="form-control" data-fv-notempty="true" placeholder="{$_M['word']['app_shop_loginpassword']}">
							</div>
							<div class="form-group margin-bottom-0">
								<button type="submit" class="btn btn-primary">{$_M['word']['app_shop_ok']}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade modal-default" id="pay-oder-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{$_M['word']['app_shop_beingpaid']}</h4>
			</div>
			<div class="modal-body text-center padding-vertical-0 blue-grey-300">
				<i class="icon wb-payment" aria-hidden="true" style="font-size:200px;"></i>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-block btn-lg btn-success btn-squared margin-bottom-20" href="{$_M['url']['shop_order_check']}&id={$order['id']}">{$_M['word']['app_shop_paidok']}</a>
				<a class="btn btn-block btn-lg btn-danger btn-squared" data-dismiss="modal" aria-label="Close">{$_M['word']['app_shop_paiderror']}</a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->
<!--
EOT;
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<!--valid-->
<link rel="stylesheet" href="{$uipath}vendor/formvalidation/formValidation.min.css">
<script src="{$uipath}vendor/formvalidation/formValidation.min.js"></script>
<script src="{$uipath}vendor/formvalidation/js/language/zh_CN.js"></script>
<script src="{$uipath}vendor/formvalidation/framework/bootstrap.min.js"></script>
<!--pay_order-->
<script src="{$webpath}js/pay_order.js"></script>  
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->