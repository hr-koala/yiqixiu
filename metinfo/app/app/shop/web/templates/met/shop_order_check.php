<!--<?php
$met_title = $_M['word']['app_shop_orderdetails'];
require_once $this->template('tem/shop_head');
$pearl[1] = 'current';
$pearl[2] = 'current';
$pearl[3] = 'current';
$pearl[4] = 'current';//disabled
if($order['state']==1){
	$pearl[4] = 'disabled';
	$pearl[3] = 'disabled';
	$pearl[2] = 'disabled';
}
if($order['state']==2){
	$pearl[4] = 'disabled';
	$pearl[3] = 'disabled';
}
if($order['state']==3){
	$pearl[4] = 'disabled';
}
echo <<<EOT
-->
<script>
	var lang_ok  = '{$_M['word']['app_shop_ok']}',
		lang_cancel  = '{$_M['word']['app_shop_cancel']}',
		lang_cancelorderok  = '{$_M['word']['app_shop_cancelorderok']}';
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
<!--
EOT;
$usernav[2] = 'active';
require_once $this->template('tem/shop_user_nav');
if($order['state']==0)$order['state_txt'] = "<i class=\"icon fa-ban blue-grey-400\" aria-hidden=\"true\" style=\"font-size:38px;\"></i><span>{$order['state_txt']}</span>";
if($order['state']==1)$order['state_txt'] = "<i class=\"icon wb-payment orange-600\" aria-hidden=\"true\" style=\"font-size:38px;\"></i><span>{$order['state_txt']}</span>";
if($order['state']==2)$order['state_txt'] = "<i class=\"fa fa-truck blue-600 margin-right-15\" aria-hidden=\"true\" style=\"font-size:38px;\"></i><span>{$order['state_txt']}</span>";
if($order['state']==3)$order['state_txt'] = "<i class=\"fa fa-gift blue-600 margin-right-15\" aria-hidden=\"true\" style=\"font-size:38px;\"></i><span>{$order['state_txt']}</span>";
if($order['state']==4)$order['state_txt'] = "<i class=\"icon wb-check-circle green-600\" aria-hidden=\"true\" style=\"font-size:38px;\"></i><span>{$order['state_txt']}</span>";
echo <<<EOT
-->
			<div class="col-md-9 shop-order shop-order-check">
				<div class="panel">
					<div class="panel-body">
					<div class="row order-state-{$order['state']}">
						<div class="col-md-8 shop-order-type">
							<h4 class="state_txt">{$order['state_txt']}</h4>
<!--
EOT;
if($order['countdown']&&$order['state']==1){
echo <<<EOT
-->
							{$_M['word']['app_shop_please']} <span class="red-600">{$order['countdown']}</span> {$_M['word']['app_shop_pleasepayment']}				
<!--
EOT;
}
echo <<<EOT
-->		
						</div>	
						<div class="col-md-4 text-right shop-order-type-btn">
<!--
EOT;
if($order['state']==1){
echo <<<EOT
-->
						<a href="{$_M['url']['shop_order_close']}&id={$order['id']}" target="_blank" class="btn btn-default btn-squared btn-outline shop-order-close">{$_M['word']['app_shop_cancelorder']}</a>
<!--
EOT;
	if($order['type']==1){
echo <<<EOT
-->						
						<a href="{$_M['url']['shop_pay_payorder']}&id={$order['id']}" target="_blank" class="btn btn-danger btn-squared">{$_M['word']['app_shop_topaynow']}</a>
<!--
EOT;
	}else{
echo <<<EOT
-->	
						<a href="{$_M['url']['shop_recharge_pay']}&id={$order['id']}" target="_blank" class="btn btn-danger btn-squared">{$_M['word']['app_shop_topaynow']}</a>
<!--
EOT;
	}
}
echo <<<EOT
-->	
						</div>	
					</div>
					</div>
				</div>
<!--
EOT;
if($order['state']>0){
echo <<<EOT
-->	
				<div class="panel hidden-xs">
					<div class="panel-body padding-bottom-20">
	<div class="pearls row">
		<div class="pearl {$pearl[1]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
			<span class="pearl-title">{$_M['word']['app_shop_placeorderabbr']}<p class="blue-grey-400 hidden-xs margin-bottom-0">{$order['rtime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[2]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-payment" aria-hidden="true"></i></div>
			<span class="pearl-title">{$_M['word']['app_shop_payment']}<p class="blue-grey-400 hidden-xs margin-bottom-0">{$order['ptime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[3]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-map" aria-hidden="true"></i></div>
			<span class="pearl-title">{$_M['word']['app_shop_deliver']}<p class="blue-grey-400 hidden-xs margin-bottom-0">{$order['stime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[4]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
			<span class="pearl-title">{$_M['word']['app_shop_complete']}</span>
		</div>
	</div>
					</div>
				</div>
<!--
EOT;
}
echo <<<EOT
-->
				<div class="panel">
					<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0">
                    <thead>
                      <tr>
                        <th width="300">{$_M['word']['app_shop_commodityname']}</th>
                        <th class="text-center">{$_M['word']['app_shop_price']}</th>
                        <th class="text-center">{$_M['word']['app_shop_number']}</th>
                        <th class="text-center">{$_M['word']['app_shop_freight']}</th>
                        <th class="text-center">{$_M['word']['app_shop_subtotal']}</th>
                      </tr>
                    </thead>
                    <tbody>
<!--
EOT;
foreach($goods_list as $key=>$val){
echo <<<EOT
-->						
						<tr>
							<td>
								<div class="media media-xs">
									<div class="media-left">
									  <a target="_blank" href="{$val['url']}" title="{$val['pname']}">
										<img src="{$val['img']}" class="media-object" />
									  </a>
									</div>
									<div class="media-body">
									  <h4 class="media-heading">
										<a target="_blank" href="{$val['url']}" class="blue-grey-600 font-size-14" title="{$val['pname']}">{$val['pname']}</a>
									  </h4>
									  <div>{$val['para']} {$val['message']}</div>
									</div>
								</div>
							</td>
							<td class="text-center">{$val['puprice']}</td>
							<td class="text-center">{$val['pamount']}</td>
							<td class="text-center">{$val['freight']}</td>
							<td class="text-center">{$val['price']}</td>
						</tr>

<!--
EOT;
}
echo <<<EOT
-->
                    </tbody>
                  </table>
				</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-body order-info">
<!--
EOT;
if($order['state']==3){
$wuliuinfo = $order['cinfo']?"{$order['cinfo']} {$order['oinfo']}":$_M['word']['app_shop_nologistics'];
echo <<<EOT
-->
				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_logisticsinfo']} : </div>
					<div class="pull-left">{$wuliuinfo}</div>
				</div>
				<hr />
<!--
EOT;
}
echo <<<EOT
-->
				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_ordernumber']} : </div>
					<div class="pull-left">{$order['orderid']}</div>
				</div>
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_paymentmod']} : </div>
					<div class="pull-left">{$order['paytype_str']}</div>
				</div>
				<hr />
				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_delivery']} : </div>
					<div class="pull-left">{$_M['word']['app_shop_express']}</div>
				</div>
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_receiving']} : </div>
					<div class="pull-left">{$order['address_str']}</div>
				</div>
<!--
EOT;
if($order['invoice']){
echo <<<EOT
-->
				<div class="row padding-top-10">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_invoice']} : </div>
					<div class="pull-left">{$order[invoice_info][0]} {$order['invoice_info'][1]} {$order['invoice_info'][2]}</div>
				</div>
<!--
EOT;
}
echo <<<EOT
-->
				<hr />
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">{$_M['word']['app_shop_messageabbr']} : </div>
					<div class="pull-left">{$order['message']}</div>
				</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0">
						<thead>
							<tr>
								<th class="text-center">{$_M['word']['app_shop_orderamount']}</th>
								<th class="text-center"></th>
								<th class="text-center">{$_M['word']['app_shop_freight']}</th>
								<th class="text-center"></th>
								<th class="text-center">{$_M['word']['app_shop_discount']}</th>
								<th class="text-center"></th>
								<th class="text-center">{$_M['word']['app_shop_modifyprice']}</th>
								<th class="text-center"></th>
								<th class="text-center">{$_M['word']['app_shop_paid']}</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><span class="label label-default">{$order['price_str']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default">{$order['freight_str']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default">{$order['discount_str']}{$order['discount_info']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default"><span id="edit_price" data-url="{$_M[url][own_form]}a=doeditorsave_price&id={$order['id']}">{$order['cprice_str']}</span></span></td>
								<td class="text-center">=</td>
								<td class="text-center"><span class="label label-default">{$order['tprice_str']}</span></td>
							</tr>
						</tbody>
					</table>
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
<script src="{$webpath}js/order_check.js"></script>  
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->