<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['2'] = 'active';
$path['web-icons'] = 1;
$path['font-glyphicons'] = 1;
$path['datatables'] = 1;
$path['slidepanel'] = 1;
$path['asScrollable'] = 1;
$path['x_editable'] = 1;
$path['alertify'] = 1;
$path['select_2'] = 1;
$path['formvalidation'] = 1;
$path['style']=1;
$path['tableset']=1;
$path['style']=1;
$path['order_list']=1;
require $this->template('own/head');
echo <<<EOT
-->
<!--<link rel="stylesheet" href="{$_M[url][own]}admin/templates/css/style.css">-->
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<ul class="nav nav-tabs nav-tabs-line" id="orderstateseach">
						<li class="active"><a data-toggle="tab" href="javascript:void(0)" aria-expanded="true" data-state="">全部</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" aria-expanded="false" data-state="1">待付款（{$state1}）</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="2">待发货（{$state3}）</span></a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="3">已发货</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="4">已完成</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="0">已关闭</a></li>
					</ul>
				</div>
				<div class="col-sm-12 margin-top-20">
					<div class="form-group margin-bottom-10">
						<div class="input-search">
							<i class="input-search-icon wb-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="keyword" data-table-search="true" placeholder="订单编号、会员名">
						</div>
					</div>		
				</div>
				<div class="col-sm-12">
					<input type="hidden" name="state" data-table-search="true" />
					<table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" id="table_id" data-table-ajaxurl="{$_M['url']['own_form']}&a=dojson_order_list">
						<thead>
							<tr>
								<th width="400">商品</th>
								<th>会员名</th>
								<th>下单时间</th>
								<th>状态</th>
								<th>实付金额</th>
							</tr>
						</thead>
					</table>
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
<!--<script src="{$_M[url][own]}admin/templates/js/tableset.js"></script>
<script src="{$_M[url][own]}admin/templates/js/order_list.js"></script>-->
</body>
</html>
<!--
EOT;
?>-->