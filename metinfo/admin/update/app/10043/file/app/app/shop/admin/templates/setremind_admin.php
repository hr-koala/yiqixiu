<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['5'] = 'active';
$path['web-icons'] = 1;
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
require $this->template('own/setremind_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-6">
<div class="well well-sm">当用户付款后，提醒管理员发货</div>
					<form action="{$_M[url][own_form]}a=doeditor&action=remind_admin" id="shop_remind" class="form-horizontal">
						<div class="example-wrap margin-bottom-20">
							<div class="example">
								<div class="form-group">
									<label class="col-sm-3 control-label font-weight-unset">手机号码</label>
									<div class="col-sm-9">
										<input type="text" class="form-control tokenfield" data-plugin="tokenfield"  name="shopv2_admintel" placeholder="可设置多个" value="{$_M['config']['shopv2_admintel']}">
										<p class="margin-top-10 margin-bottom-0">输入手机号码，按回车键添加</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label font-weight-unset">邮箱地址</label>
									<div class="col-sm-9">
										<input type="text" class="form-control tokenfield" data-plugin="tokenfield" placeholder="可设置多个" name="shopv2_adminemail" value="{$_M['config']['shopv2_adminemail']}">
										<p class="margin-top-10 margin-bottom-0">输入邮箱地址，按回车键添加</p>
									</div>
								</div>								
							  </div>
						</div>
						<div class="form-group">
							<div class="col-sm-3"></div>
							<div class="col-sm-9"><button type="sumbit" class="btn btn-primary">保存</button></div>
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
<script src="{$_M[url][own]}admin/templates/js/setremind.js"></script>
</body>
</html>
<!--
EOT;
?>-->