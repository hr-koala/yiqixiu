<!--<?php
$met_title = $_M['word']['app_shop_placeorder'];
require_once $this->template('tem/shop_head');
echo <<<EOT
-->
<script>
	var addrlisturl  = '{$_M['url']['shop_addr_index']}',
		addrdelurl = '{$_M['url']['shop_addr_del']}',
		totalurl = '{$_M['url']['shop_ajax_total']}',
		lang_pleaseaddress = '{$_M['word']['app_shop_pleaseaddress']}',
		lang_freefreight = '{$_M['word']['app_shop_freefreight']}',
		lang = '{$_M['lang']}',
		uipath = '{$uipath}';
</script>
<div class="page animsition">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-body">
				<form action="{$_M['url']['shop_pay_placeorder']}" class="pay-form">
					<input name="cidlist" type="hidden" value="{$_M['form']['cidlist']}">
<!--
EOT;
if($logistic||$_M['config']['shopv2_gi']){
echo <<<EOT
-->
					<div class="example-wrap margin-bottom-30">
						<input name="addressid" id="addressid" type="hidden" value="{$addr_de}">
						<div class="example margin-bottom-0">
							<div class="form-group clearfix margin-bottom-0">
								<label class="pull-left example-title control-label width-150 margin-bottom-15">{$_M['word']['app_shop_address']}</label>
								<div class="pull-left pay-set-body">
									<button type="button" class="btn btn-outline btn-success btn-squared addr-btn">{$_M['word']['app_shop_addto']}{$_M['word']['app_shop_address']}</button>
								</div>
							</div>
							<div class="row addr-body list-group margin-bottom-0">
								<div class="loader vertical-align-middle loader-default margin-left-30"></div>
							</div>
						</div>
					</div>
					<hr>
<!--
EOT;
}
echo <<<EOT
-->
					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">{$_M['word']['app_shop_paymentmod']}</label>
								<div class="pull-left pay-set-body">
<!--
EOT;
$checked = '';
if($_M['config']['shopv2_onlinepay']){
	$checked = 'checked';
echo <<<EOT
-->
									<div class="pull-left">
										<input type="radio" name="paytype" value="1" data-plugin="labelauty" data-labelauty="{$_M['word']['app_shop_paymentonline']}" {$checked}/>
									</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($_M['config']['shopv2_deliverypay']){
$checked = $checked==''?'checked':'';
echo <<<EOT
-->
									<div class="height-20 visible-xs-block"></div>
									<div class="pull-left">
										<input type="radio" name="paytype" value="2" data-plugin="labelauty" data-labelauty="{$_M['word']['app_shop_paymentcod']}" {$checked}/>
									</div>
<!--
EOT;
}
echo <<<EOT
-->
								</div>
							</div>
						</div>
					</div>
					<hr>
<!--
EOT;
if($logistic||$_M['config']['shopv2_gi']){
echo <<<EOT
-->
					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">{$_M['word']['app_shop_delivery']}</label>
								<div class="pull-left pay-set-body red-600">
									{$freight_type_str}
								</div>
							</div>
						</div>
					</div>
					<hr>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($_M['config']['shopv2_gi']){
echo <<<EOT
-->
					<input name="invoice_type" type="hidden" value="1">
					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">{$_M['word']['app_shop_invoice']}</label>
								<div class="pull-left pay-set-body">
									<div class="clearfix">
										<div class="pull-left">
											<input type="radio" name="invoice_is" value="0" data-plugin="labelauty" data-labelauty="{$_M['word']['app_shop_unwanted']}" checked/>
										</div>
										<div class="height-20 visible-xs-block"></div>
										<div class="pull-left">
											<input type="radio" name="invoice_is" value="1" data-plugin="labelauty" data-labelauty="{$_M['word']['app_shop_need']}" />
										</div>
									</div>
									<div class="margin-top-20 collapse width-400" id="invoice-body">
										<div class="well margin-bottom-0">
											<div class="form-group">
												<input type="text" class="form-control" name="invoice_title" data-fv-notempty="true" placeholder="{$_M['word']['app_shop_invoicehead']}">
											</div>
											<div class="form-group clearfix margin-top-20 margin-bottom-0">
												<label class="pull-left control-label padding-right-10">{$_M['word']['app_shop_invoicecontent']} : </label>
												<div class="pull-left">
<!--
EOT;
$invoice_c = explode('|', $_M['config']['shopv2_invoice']);
if(count($invoice_c)>1){
	$invoice_html = '<select class="form-control" name="invoice_con">';
	foreach($invoice_c as $key=>$val){
		if($val)$invoice_html.= "<option value=\"{$val}\">{$val}</option>";
	}
	$invoice_html.= '</select>';
}else{
	$invoice_html = $invoice_c[0];
}
echo <<<EOT
-->
													{$invoice_html}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
<!--
EOT;
}
echo <<<EOT
-->
					<div class="example-wrap margin-vertical-40">
						<h3 class="example-title"><a href="{$_M['url']['shop_cart']}" class="pull-right padding-right-30 grey-400 font-size-16">{$_M['word']['app_shop_return']}{$_M['word']['app_shop_cart']}<span class="site-menu-arrow"></span></a>{$_M['word']['app_shop_commodity']}</h3>
						<div class="example bg-blue-grey-100">
<!--
EOT;
foreach($pgoods as $val){	
$val[para_str] = str_replace(","," ",$val[para_str]);
echo <<<EOT
-->
	<div class="pay-goods-body">
		<div class="row">
			<div class="col-sm-6 col-xs-8">
				<div class="media media-xs">
					<div class="media-left">
						<a href="{$val[url]}" target="_blank">
							<img class="media-object" src="{$val[img]}" alt="{$val[name]}">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading"><a href="{$val[url]}" target="_blank">{$val[name]}</a></h4>
						{$val[para_str]}
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-4 text-nowrap text-right">
				{$val[price_str]} <span class="p-num">x {$val[amount]}</span>
			</div>
			<div class="col-sm-3 red-600 text-right hidden-xs">
				{$val[subtotal]}
			</div>
		</div>
<!--
EOT;
foreach($val['message'] as $key=>$msg){
$msg['required'] = $msg['required']?'data-fv-notempty="true"':'';
if($msg['line']){
echo <<<EOT
-->
		<div class="form-group margin-top-15 margin-bottom-0 p-message">
			<textarea class="form-control" rows="3" {$msg['required']} name="msg_{$val['id']}_{$val['pid']}_{$key}" placeholder="{$msg[name]}"></textarea>
		</div>
<!--
EOT;
}else{
echo <<<EOT
-->	
		<div class="form-group margin-top-15 margin-bottom-0 p-message">
			<input placeholder="{$msg[name]}" {$msg['required']} class="form-control" name="msg_{$val['id']}_{$val['pid']}_{$key}">
		</div>
<!--
EOT;
}}
echo <<<EOT
-->	
	</div>
<!--
EOT;
}
echo <<<EOT
-->	
						</div>
					</div>
					<hr>
					<div class="message form-group">
						<textarea class="form-control" rows="3" name="message" placeholder="{$_M['word']['app_shop_message']}"></textarea>
					</div>
					<hr>
					<div class="pay-submit">
						<div class="row">
							<div class="col-md-9 col-sm-7 text-right">
								{$_M['word']['app_shop_intotal']} <span id="pay-amount" class="red-600"></span> {$_M['word']['app_shop_piece']}{$_M['word']['app_shop_commodity']}，{$_M['word']['app_shop_total']} : <span id="pay-total" class="red-600"></span>
							</div>
							<div class="col-md-3 col-sm-5 text-right">
								<button type="submit" class="btn btn-lg btn-squared btn-danger padding-horizontal-30">{$_M['word']['app_shop_placeorder']}</button>
							</div>
						</div>
					</div>
				</form>
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
<!--labelauty-->
<link rel="stylesheet" href="{$uipath}vendor/jquery-labelauty/jquery-labelauty.min.css">
<script src="{$uipath}vendor/jquery-labelauty/jquery-labelauty.js"></script>
<!--valid-->
<link rel="stylesheet" href="{$uipath}vendor/formvalidation/formValidation.min.css">
<script src="{$uipath}vendor/formvalidation/formValidation.min.js"></script>
<script src="{$uipath}vendor/formvalidation/js/language/zh_CN.js"></script>
<script src="{$uipath}vendor/formvalidation/framework/bootstrap.min.js"></script>
<!--linkage-->
<script src="{$uipath}vendor/select-linkage/jquery.cityselect.js"></script>
<!--animsition-->
<script src="{$uipath}vendor/animsition/animsition.min.js"></script>
<script src="{$uipath}js/components/animsition.min.js"></script>
<!--pay-->
<script src="{$webpath}js/pay.js"></script>
<script src="{$webpath}js/address.js"></script>
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->