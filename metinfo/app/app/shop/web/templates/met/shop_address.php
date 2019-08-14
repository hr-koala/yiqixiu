<!--<?php
$met_title = $_M['word']['app_shop_address'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var addrlisturl  = '{$_M['url']['shop_addr_index']}',
		addrdelurl = '{$_M['url']['shop_addr_del']}',
		lang_ok  = '{$_M['word']['app_shop_ok']}',
		lang_cancel  = '{$_M['word']['app_shop_cancel']}',
		lang_deleteok  = '{$_M['word']['app_shop_deleteok']}',
		uipath = '{$uipath}';
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
<!--
EOT;
$usernav[3] = 'active';
require_once $this->template('tem/shop_user_nav'); 
echo <<<EOT
-->
			<div class="col-md-9 shop-order shop-address">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<button type="button" class="btn btn-success addr-btn btn-squared">{$_M['word']['app_shop_addto']}{$_M['word']['app_shop_address']}</button>
						<div class="row addr-body shop-address-body">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/shop_address_modal'); 
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<!--valid-->
<link rel="stylesheet" href="{$uipath}vendor/formvalidation/formValidation.min.css">
<script src="{$uipath}vendor/formvalidation/formValidation.min.js"></script>
<script src="{$uipath}vendor/formvalidation/js/language/zh_CN.js"></script>
<script src="{$uipath}vendor/formvalidation/framework/bootstrap.min.js"></script>
<!--linkage-->
<script src="{$uipath}vendor/select-linkage/jquery.cityselect.js"></script>
<!--address-->
<script src="{$webpath}js/address.js"></script>
<script src="{$webpath}js/address_set.js"></script>
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->