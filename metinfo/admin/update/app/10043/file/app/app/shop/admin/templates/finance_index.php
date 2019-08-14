<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['3'] = 'active';
$path['web-icons'] = 1;
$path['datatables'] = 1;
$path['alertify'] = 1;
$path['formvalidation'] = 1;
$path['datepicker'] = 1;
$path['tableset'] = 1;
$path['finance_index'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="bars pull-left">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-outline btn-default font-weight-unset" data-target="#finance_deposit" data-toggle="modal">
								<i class="icon wb-plus margin-right-5" aria-hidden="true"></i>入款
							</button>
							<button type="button" class="btn btn-outline btn-default font-weight-unset" data-target="#finance_debit" data-toggle="modal">
								<i class="icon wb-minus margin-right-5" aria-hidden="true"></i>扣款
							</button>
							<button type="button" class="btn btn-default btn-outline" data-toggle="collapse" data-target="#moreseach" aria-expanded="false" aria-controls="moreseach">
								<i class="wb-search margin-right-5" aria-hidden="true"></i>筛选
							</button>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="collapse" id="moreseach" aria-expanded="true">
					  <div class="well" style="margin-top:10px;">
							<div class="row">
								<div class="form-group form-inline col-sm-12">
									<div class="input-group">
										<span class="input-group-addon">
										  <i class="icon wb-calendar" aria-hidden="true"></i>
										</span>
										<input type="text" name="fromtime" class="form-control" data-table-search="true" data-plugin="datepicker">
									</div>
									<div class="input-group padding-left-5 padding-right-5">
										至 
									</div>
									<div class="input-group">
										<span class="input-group-addon">
										  <i class="icon wb-calendar" aria-hidden="true"></i>
										</span>
										<input type="text" name="totime" class="form-control" data-table-search="true" data-plugin="datepicker">
									</div>
								</div>
								<div class="form-group col-sm-12">
									<div class="width-100">
										<select name="type" data-table-search="true" class="form-control">
											<option value="">类型</option>
<!--
EOT;
foreach($type as $key => $val){
echo <<<EOT
-->
											<option value="{$key}">{$val}</option>
<!--
EOT;
}
echo <<<EOT
-->
										</select>
									</div>
								</div>
								<div class="form-group col-sm-12 margin-bottom-0">
									<div class="width-300">
										<input type="text" class="form-control" name="username" data-table-search="true" placeholder="会员名">
									</div>
								</div>
							</div>
					  </div>
					</div>
				</div>
				<div class="col-sm-12">
					<table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" id="table_id" data-table-ajaxurl="{$_M['url']['own_form']}&a=dojson_finance_list">
						<thead>
							<tr>
								<th width="150">时间</th>
								<th>入款</th>
								<th>扣款</th>
								<th>余额</th>
								<th>会员名</th>
								<th>事由</th>
								<th>操作人</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-danger" id="finance_deposit" aria-hidden="true" aria-labelledby="finance_deposit" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<form action="{$_M[url][own_form]}a=doaddfinance" class="finance_from">
		<input type="hidden" name="type" value="1">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">入款</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="price" data-fv-notempty="true" data-fv-numeric="true" placeholder="金额">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" data-fv-notempty="true" placeholder="会员名">
					</div>
					<div class="form-group">
						<textarea name="reason" class="form-control" placeholder="事由" data-fv-notempty="true" rows="3"></textarea>
					</div>
				</div>
				<div class="modal-footer text-left">
					<button type="sbumit" class="btn btn-danger">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade modal-success" id="finance_debit" aria-hidden="true" aria-labelledby="finance_debit" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<form action="{$_M[url][own_form]}a=doaddfinance" class="finance_from">
		<input type="hidden" name="type" value="2">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">扣款</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="price" data-fv-notempty="true" data-fv-numeric="true" placeholder="金额">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" data-fv-notempty="true" placeholder="会员名">
					</div>
					<div class="form-group">
						<textarea name="reason" class="form-control" placeholder="事由" data-fv-notempty="true" rows="3"></textarea>
					</div>
				</div>
				<div class="modal-footer text-left">
					<button type="sbumit" class="btn btn-success">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
<!--<script src="{$_M[url][own]}admin/templates/js/tableset.js"></script>
<script src="{$_M[url][own]}admin/templates/js/finance_index.js"></script>-->
</body>
</html>
<!--
EOT;
?>-->