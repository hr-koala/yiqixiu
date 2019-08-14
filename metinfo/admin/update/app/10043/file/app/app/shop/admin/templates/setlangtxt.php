<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['4'] = 'active';
$path['web-icons'] = 1;
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
$shopnav[1] = 'class="active"';
require $this->template('own/shopset_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-12">
					<div class="well well-sm">可以设置前台页面文字，切换到不同语言后台可以手动翻译成不同语言文字<br/><code>Ctrl+F</code> 可以搜索需要修改的文字</div>
					<form action="{$_M[url][own_form]}a=dolangtxtsave" id="langtxt_from" class="form-horizontal">
<!--
EOT;
foreach($langtxtarray as $val){
echo <<<EOT
-->
						<div class="form-group">
							<dl class="dl-horizontal margin-bottom-0">
								<dt><label class="control-label font-weight-300">{$val[name]}</label></dt>
								<dd>
									<input type="text" name="{$val[name]}" class="form-control" value="{$val[value]}">
								</dd>
							</dl>
						</div>
<!--
EOT;
}
echo <<<EOT
-->
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
<script src="{$_M[url][own]}admin/templates/js/setlangtxt.js"></script>
</body>
</html>
<!--
EOT;
?>-->