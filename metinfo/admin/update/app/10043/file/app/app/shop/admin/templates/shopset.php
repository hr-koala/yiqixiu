<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['4'] = 'active';
$path['web-icons'] = 1;
$path['switchery'] = 1;
$path['asspinner'] = 1;
$path['formvalidation'] = 1;
$path['alertify'] = 1;
$path['tokenfield'] = 1;
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
$shopnav[1] = 'class="active"';
require $this->template('own/shopset_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-12 margin-top-20">
					<form action="{$_M[url][own_form]}a=doeditor&action=set" id="shopset_from" class="form-horizontal">
						<div class="form-group">
							<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">商城模块开关</label>
							<div class="pull-left margin-top-5">
								<input type="checkbox" data-plugin="switchery" name="shopv2_open" class="hide" {$openchecked} value="1">
								<p class="margin-top-10 margin-bottom-0">关闭后商城模块所有功能失效</p>
							</div>
						</div>
						<hr>
						<div class="form-group">
						<dl class="dl-horizontal margin-bottom-0">
							<dt><label class="pull-left width-150 margin-right-20 control-label font-weight-unset">货币符号</label></dt>
							<dd>
								<div class="input-group input-group-icon width-200">
									<input type="text" class="form-control" value="{$_M['config']['shopv2_price_str_prefix']}" name="shopv2_price_str_prefix" placeholder="前缀">
									<span class="input-group-addon" style="border-left:none;border-right:none;">
										99.99
									</span>
									<input type="text" class="form-control" value="{$_M['config']['shopv2_price_str_suffix']}" name="shopv2_price_str_suffix" placeholder="后缀">
								</div>
								<p class="margin-top-10 margin-bottom-0">可设置货币前后字符</p>
							</dd>
						</dl>
						</div>
						<hr>
						<div class="form-group">
							<dl class="dl-horizontal margin-bottom-0">
								<dt>多语言</dt>
								<dd>
									<a href="{$_M['url']['own_name']}c=shopset&a=dolangtxt">前台文字设置</a>
								</dd>
							</dl>
						</div>
						<hr>
						<div class="example-wrap margin-bottom-0">
							<h4 class="example-title">订单状态自动化</h4>
							<hr>
							<div class="example">
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">订单自动关闭</label>
									<div class="pull-left margin-top-5">
										<input type="checkbox" data-plugin="switchery" name="shopv2_order_auto_close" class="hide" {$auto_close_checked} value="1">
									</div>
								</div>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset"></label>
									<div class="pull-left">
										<input type="text" class="form-control" style="width:80px;" data-plugin="asSpinner" name="shopv2_order_auto_close_time" autocomplete="off" value="{$_M['config']['shopv2_order_auto_close_time']}">
										<p class="margin-top-10 margin-bottom-0">分钟，超过时间未付款自动关闭订单</p>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">订单自动完成</label>
									<div class="pull-left margin-top-5">
										<input type="checkbox" data-plugin="switchery" name="shopv2_order_auto_ok" class="hide" {$auto_ok_checked} value="1">
									</div>
								</div>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset"></label>
									<div class="pull-left">
										<input type="text" class="form-control" style="width:80px;" data-plugin="asSpinner" name="shopv2_order_auto_ok_time" autocomplete="off" value="{$_M['config']['shopv2_order_auto_ok_time']}">
										<p class="margin-top-10 margin-bottom-0">天数，已发货订单将自动分类成已完成，设置为 0 则发货即完成</p>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">订单自动删除</label>
									<div class="pull-left margin-top-5">
										<input type="checkbox" data-plugin="switchery" name="shopv2_order_auto_del" class="hide" {$auto_del_checked} value="1">
									</div>
								</div>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset"></label>
									<div class="pull-left">
										<input type="text" class="form-control" style="width:80px;" data-plugin="asSpinner" name="shopv2_order_auto_del_time" autocomplete="off" value="{$_M['config']['shopv2_order_auto_del_time']}">
										<p class="margin-top-10 margin-bottom-0">天数，仅删除已关闭的订单，已关闭订单达到指定天数自动删除</p>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="example-wrap margin-bottom-0">
							<h4 class="example-title">发票设置</h4>
							<hr>
							<div class="example">
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">普通发票</label>
									<div class="pull-left margin-top-5">
										<input type="checkbox" data-plugin="switchery" name="shopv2_gi" class="hide" {$gichecked} value="1">
										<p class="margin-top-10 margin-bottom-0">顾客可选是否开票</p>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="pull-left width-150 margin-right-20 control-label font-weight-unset">可选发票内容</label>
									<div class="pull-left">
										<input name="shopv2_invoice" class="form-control" data-plugin="tokenfield" value="{$_M['config']['shopv2_invoice']}">
										<p class="margin-top-10 margin-bottom-0">输入发票内容，按回车键添加</p>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group">
							<div class="pull-left width-150 margin-right-20 ">&nbsp;</div>
							<div class="pull-left"><button type="submit" class="btn btn-primary">保存</button></div>
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
<script src="{$_M[url][own]}admin/templates/js/shopset.js"></script>
</body>
</html>
<!--
EOT;
?>-->