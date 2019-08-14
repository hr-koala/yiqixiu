<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
	</div>
</div>
<footer class="site-footer">
<div class="site-footer-legal">© 2016 <a href="http://www.metinfo.cn/" target="_blank">MetInfo</a></div>
<div class="site-footer-right">
	Powered by <a href="http://www.metinfo.cn/" target="_blank">MetInfo</a> 5.3.4
</div>
</footer>
<!-- Modal -->
<div class="modal fade modal-success" id="shop-support-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">技术支持说明</h4>
			</div>
			<div class="modal-body text-center blue-grey-300">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">我知道了</button>
            </div>
		</div>
	</div>
</div>
<!-- End Modal -->
<!--
EOT;
if($_M['form']['error']){
echo <<<EOT
-->
<div class="error hide">{$_M['form']['error']}</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($_M['form']['success']){
echo <<<EOT
-->
<div class="success hide">{$_M['form']['success']}</div>
<!--
EOT;
}
echo <<<EOT
-->
{$resui[js]}
<!--<script src="{$uipath}vendor/jquery/jquery.min.js"></script>
<script src="{$uipath}vendor/bootstrap/bootstrap.min.js"></script>
<script src="{$uipath}js/core.min.js"></script>
<script src="{$uipath}assets/js/site.min.js"></script>
<script src="{$_M[url][own]}admin/templates/js/own.js"></script>-->
<!--
EOT;
// $foot=1;
// require $this->template('own/path');
echo <<<EOT
-->
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>