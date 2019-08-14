<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['4'] = 'active';
$path['web-icons'] = 1;
$path['font-awesome'] = 1;
$path['switchery'] = 1;
$path['formvalidation'] = 1;
$path['alertify'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12 margin-bottom-20">
<!--
EOT;
$shopnav[2] = 'class="active"';
require $this->template('own/shopset_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-12 margin-top-20">
					<form action="{$_M[url][own_form]}a=doeditor&action=pay" id="shopsetpay_from" class="form-horizontal">
						<div class="form-group">
							<dl class="dl-horizontal margin-bottom-0">
								<dt><label class="control-label font-weight-unset">在线支付</label></dt>
								<dd>
									<input type="checkbox" data-plugin="switchery" name="shopv2_onlinepay" class="hide" {$onlinechecked} value="1">
									<p class="margin-top-10 margin-bottom-0">需要配置好支付接口，会员可以在线支付或账户余额支付</p>
									<p class="margin-top-10 margin-bottom-0"><a href="{$_M['url']['adminurl']}&n=pay&c=admin_pay&a=dopaylist" target="_blank">支付接口配置 <i class="icon fa-share-square-o" aria-hidden="true"></i></a></p>
								</dd>
							</dl>
						</div>
						<hr>
						<div class="form-group">
							<dl class="dl-horizontal margin-bottom-0">
								<dt><label class="control-label font-weight-unset">货到付款</label></dt>
								<dd>
									<input type="checkbox" data-plugin="switchery" name="shopv2_deliverypay" class="hide" {$deliverychecked} value="1">
									<p class="margin-top-10 margin-bottom-0">启用后会员可选择货到付款下单，需您自行与物流公司合作，完成配送和货款结算。</p>
								</dd>
							</dl>
						</div>
						<div class="form-group">
							<dl class="dl-horizontal margin-bottom-0">
								<dt></dt>
								<dd>
									<button type="submit" class="btn btn-primary">保存</button>
								</dd>
							</dl>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
<script src="{$_M[url][own]}admin/templates/js/setsetpay.js"></script>
</body>
</html>
<!--
EOT;
?>-->