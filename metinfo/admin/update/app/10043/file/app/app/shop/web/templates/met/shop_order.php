<!--<?php
$met_title = $_M['word']['app_shop_myorder'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var shop_pay_payorder = '{$_M['url']['shop_pay_payorder']}',
		order_json_url	  = '{$_M['url']['shop_order']}&ajaxjson=1',
		lang_topaynow  = '{$_M['word']['app_shop_topaynow']}',
		lang_orderamount  = '{$_M['word']['app_shop_orderamount']}',
		lang_orderdetails  = '{$_M['word']['app_shop_orderdetails']}',
		lang_noorders  = '{$_M['word']['app_shop_noorders']}',
		lang_ordernumber  = '{$_M['word']['app_shop_ordernumber']}';
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
<!--
EOT;
$usernav[2] = 'active';
require_once $this->template('tem/shop_user_nav'); 
echo <<<EOT
-->
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<ul class="nav nav-tabs nav-tabs-line shop-order-search">
							<li {$stateto['all']}><a data-toggle="tab" href="javascript:void(0)" data-state="all">{$_M['word']['app_shop_allvalidorders']}</a></li>
							<li {$stateto[1]}><a data-toggle="tab" href="javascript:void(0)" data-state="1">{$_M['word']['app_shop_bepaid']}（{$state1}）</a></li>
							<li {$stateto[3]}><a data-toggle="tab" href="javascript:void(0)" data-state="3">{$_M['word']['app_shop_receipt']}（{$state3}）</a></li>
							<li {$stateto[0]}><a data-toggle="tab" href="javascript:void(0)" data-state="0">{$_M['word']['app_shop_closed']}</a></li>
						</ul>
						<div class="shop-order-keyword">
							<div class="form-group">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
									<input type="text" class="form-control" name="keyword" data-table-search="true" placeholder="{$_M['word']['app_shop_ordernumber']}、{$_M['word']['app_shop_commodityname']}">
								</div>
							</div>		
						</div>
						<div class="shop-order-more-body">
						</div>
						<div class="shop-order-more-btn">
							<button type="button" class="btn btn-primary btn-block btn-squared hide" id="shop-order-more"><i class="icon wb-chevron-down margin-right-5" aria-hidden="true"></i>{$_M['word']['app_shop_moreorder']}</button>
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
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<script src="{$webpath}js/shop_order.js"></script>  
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->