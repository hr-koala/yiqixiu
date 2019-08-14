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
$path['datepicker'] = 1;
$path['tableset'] = 1;
$path['discount'] = 1;
$path['style'] = 1;
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
						<li><a data-toggle="tab" href="javascript:void(0)" aria-expanded="false" data-state="1">未开始</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="2">进行中</a></li>
						<li><a data-toggle="tab" href="javascript:void(0)" data-state="3">已完结</a></li>
					</ul>
				</div>
				<div class="col-sm-5 margin-top-20">
					<a href="{$_M[url][own_form]}a=doadd" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i>新增优惠券</a>
				</div>
				<div class="col-sm-7 margin-top-20">
					<div class="form-group margin-bottom-10">
						<div class="input-search">
							<i class="input-search-icon wb-search" aria-hidden="true"></i>
							<input type="text" class="form-control" name="keyword" data-table-search="true" placeholder="优惠劵名称">
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<input type="hidden" name="state" data-table-search="true" />
					<table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" data-selectable="selectable" data-row-selectable="true" id="table_id" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_discount_list" data-table-delurl="{$_M[url][own_form]}a=dodel">
						<thead>
							<tr>
								<th><span class="checkbox-custom checkbox-primary"><input name="id" type="checkbox" class="selectable-all" value=""><label></label></span></th>
								<th width="150">优惠券名称</th>
								<th>价值</th>
								<th>领取限制</th>
								<th>有效期</th>
								<th>已领取/总数</th>
								<th>已使用/总数</th>
								<th>操作</th>
							</tr>
						</thead>
						<tfoot>
						<tr>
							<th><span class="checkbox-custom checkbox-primary"><input name="id" type="checkbox" class="selectable-all" value=""><label></label></span></th>
							<th colspan="7" class="formsubmit">
								<input type="submit" id="del" value="{$_M['word']['delete']}" class="btn btn-primary submit"/>
							</th>
						</tr>
					</tfoot>
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
<script src="{$_M[url][own]}admin/templates/js/discount.js"></script>-->

  <script>

  </script>


</body>
</html>
<!--
EOT;

die();
defined('IN_MET') or exit('No permission');

require $this->template('own/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dodel" target="_self">
<div class="v52fmbx">
	<div class="v52fmbx-table-top">
		<div class="ui-float-right">
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="优惠券名称">
			</div>
		</div>
		<div class="ui-float-right">
			<div class="fbox">
				<select name="state" data-table-search="1">
					<option value="0">状态</option>
					<option value="1">未开始</option>
					<option value="2">进行中</option>
					<option value="3">已结束</option>
				</select>
			</div>
		</div>
		<div class="ui-float-left">
			<a href="{$_M[url][own_form]}a=doadd" class="ui-addlist"><i class="fa fa-plus-circle"></i>新增优惠券</a>
		</div>
	</div>
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_discount_list"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th width="200">优惠券名称</th>
				<th data-table-columnclass="met-center" width="100">价值</th>
				<th data-table-columnclass="met-center" width="100">领取限制</th>
				<th data-table-columnclass="met-center" width="200">有效期</th>
				<th data-table-columnclass="met-center" width="100">领取/人次</th>
				<th data-table-columnclass="met-center" width="100">已使用</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><span class="checkbox-custom checkbox-primary"><input name="id" type="checkbox" class="selectable-all" value=""><label></label></span></th>
				<th colspan="7" class="formsubmit">
					<input type="submit" name="del" value="{$_M['word']['delete']}111" class="submit" data-confirm='删除优惠劵后，用户已经领取的优惠券也会一并删除，请注意！！！' />
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</form>
<!--
EOT;


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>