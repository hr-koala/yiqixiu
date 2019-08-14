<!--<?php
$met_title = $_M['word']['app_shop_accountrecharge'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var shop_pay_payorder = '{$_M['url']['shop_pay_payorder']}',
		order_json_url	  = '{$_M['url']['shop_order']}&ajaxjson=1';
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
<!--
EOT;
$usernav[1] = 'active';
require_once $this->template('tem/shop_user_nav'); 
echo <<<EOT
-->
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-pay-recharge">
		<form method="POST" name="myform" class="pay-recharge" action="{$_M['url']['shop_recharge_pay']}">
			<div class="form-group">
				<label class="control-label" for="inputBasicEmail">{$_M['word']['app_shop_balance']}</label>
				<div class="margin-top-10">
					<span class="label label-lg label-success">{$_M['user']['balance_str']}</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="inputBasicEmail">{$_M['word']['app_shop_rechargemoney']}</label>
				<div class="margin-top-5">
					<input type="text" class="form-control width-200" name="price" autocomplete="off" data-fv-notempty="true" data-fv-numeric="true">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-squared">{$_M['word']['app_shop_topay']}</button>
            </div>
		</form>
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
<link rel="stylesheet" href="{$uipath}vendor/formvalidation/formValidation.min.css">
<script src="{$uipath}vendor/formvalidation/formValidation.min.js"></script>
<script src="{$uipath}vendor/formvalidation/js/language/zh_CN.js"></script>
<script src="{$uipath}vendor/formvalidation/framework/bootstrap.min.js"></script>
<!--pay_order-->
<script src="{$webpath}js/own.js"></script>  
<script type="text/javascript">
	$('.pay-recharge').formValidation({
		locale:'zh_CN',
		framework: "bootstrap"
	});
</script>
</body>
</html>
<!--
EOT;
?>-->