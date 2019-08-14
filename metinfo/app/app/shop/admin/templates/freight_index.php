<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['4'] = 'active';
$path['web-icons'] = 1;
$path['slidepanel'] = 1;
$path['asScrollable'] = 1;
$path['alertify'] = 1;
$path['formvalidation'] = 1;
$path['multi-select'] = 1;
$path['freight'] = 1;
require $this->template('own/head');
//{$_M[url][own_form]}a=doaddfreight
echo <<<EOT
-->
<script>var own_form = '{$_M[url][own_form]}';</script>
<!--<link rel="stylesheet" href="{$_M[url][own]}admin/templates/css/freight.css">-->
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12 margin-bottom-20">
<!--
EOT;
$shopnav[3] = 'class="active"';
require $this->template('own/shopset_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-12">
					<div class="bars">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-outline btn-success font-weight-unset" id="freight_id">
								新增运费模板
							</button>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<ul class="list-group list-group-gap freight_list">
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-success" id="quyuselect" aria-hidden="true" aria-labelledby="quyuselect" role="dialog">
	<div class="modal-dialog modal-center">
		<div class="modal-content">
				<form id="quyuselect-form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">请选择可配送区域</h4>
			</div>
			<div class="modal-body">
				<div class="form-group margin-bottom-0">
					<input type="hidden" name="zoneid">
					<select name="multiselect_zone" id="multiselect_zone" class="form-control" multiple="multiple" data-plugin="multiSelect" data-fv-notempty="true" data-fv-message="请选择可配送区域">
						<option value="北京市">北京市</option>
						<option value="天津市">天津市</option>
						<option value="河北省">河北省</option>
						<option value="山西省">山西省</option>
						<option value="内蒙古自治区">内蒙古自治区</option>
						<option value="辽宁省">辽宁省</option>
						<option value="吉林省">吉林省</option>
						<option value="黑龙江省">黑龙江省</option>
						<option value="上海市">上海市</option>
						<option value="江苏省">江苏省</option>
						<option value="浙江省">浙江省</option>
						<option value="安徽省">安徽省</option>
						<option value="福建省">福建省</option>
						<option value="江西省">江西省</option>
						<option value="山东省">山东省</option>
						<option value="河南省">河南省</option>
						<option value="湖北省">湖北省</option>
						<option value="湖南省">湖南省</option>
						<option value="广东省">广东省</option>
						<option value="广西壮族自治区">广西壮族自治区</option>
						<option value="海南省">海南省</option>
						<option value="重庆市">重庆市</option>
						<option value="四川省">四川省</option>
						<option value="贵州省">贵州省</option>
						<option value="云南省">云南省</option>
						<option value="西藏自治区">西藏自治区</option>
						<option value="陕西省">陕西省</option>
						<option value="甘肃省">甘肃省</option>
						<option value="青海省">青海省</option>
						<option value="宁夏回族自治区">宁夏回族自治区</option>
						<option value="新疆维吾尔自治区">新疆维吾尔自治区</option>
						<option value="台湾省">台湾省</option>
						<option value="香港特别行政区">香港特别行政区</option>
						<option value="澳门特别行政区">澳门特别行政区</option>
					</select>
				</div>
			</div>
			<div class="modal-footer text-left">
				<button type="sbumit" class="btn btn-success">确定</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
				</form>
		</div>
	</div>
</div>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
<!--<script src="{$_M[url][own]}admin/templates/js/freight.js"></script>-->
</body>
</html>
<!--
EOT;
?>-->