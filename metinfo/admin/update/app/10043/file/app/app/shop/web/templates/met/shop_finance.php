<!--<?php
$met_title = $_M['word']['app_shop_consumer'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var lang = '{$_M['lang']}';
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
				<div class="panel shop-finance-panel">
					<div class="panel-body shop-finance-body">
					<div class="bars pull-left">
						<div class="btn-group" role="group">
							<a href="{$_M['url']['shop_recharge_index']}" class="btn btn-outline btn-success addr-btn btn-squared pull-right">{$_M['word']['app_shop_accountrecharge']}</a>
						</div>
					</div>
						<table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" id="table_id" data-table-ajaxurl="{$_M['url']['shop']}finance.php?a=dojson_finance_list">
							<thead>
								<tr>
									<th>{$_M['word']['app_shop_time']}</th>
									<th>{$_M['word']['app_shop_money']}</th>
									<th>{$_M['word']['app_shop_balance']}</th>
									<th>{$_M['word']['app_shop_reason']}</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
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
<link rel="stylesheet" href="{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{$uipath}vendor/datatables-responsive/dataTables.responsive.min.css">
<script src="{$uipath}vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.js"></script>
<script src="{$uipath}vendor/datatables-responsive/dataTables.responsive.js"></script>

<script src="{$webpath}js/shop_finance.js"></script>  
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->