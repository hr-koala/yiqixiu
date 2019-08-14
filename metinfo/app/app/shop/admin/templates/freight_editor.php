<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="page">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body container-fluid">
				<form action="{$_M[url][own_form]}a=dosavefreight" id="zone_from">
				<input type="hidden" name="id" value="{$_M['form']['id']}">
				<div class="form-group">
					<input type="text" class="form-control" name="name" value="{$freight[name]}" data-fv-notempty="true" placeholder="运费模板名称">
				</div>
				<div class="form-group margin-bottom-10">
					<div class="table-responsive">
						<table class="table margin-bottom-0" id="editor_region">
							<thead>
								<tr>
									<th width="230">可配送区域</th>
									<th>首件（个）</th>
									<th>运费</th>
									<th>续件（个）</th>
									<th>续费</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<th colspan="5">
									<button type="button" id="newquyuselect" data-target="#quyuselect" data-toggle="modal" class="btn btn-outline btn-success btn-sm font-weight-unset">
										新增可配送区域和运费
									</button>
								</th>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary margin-right-10 editor_btn">保存</button>
					<button type="submit" class="btn btn-default slidePanel-close editor_btn">取消</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>