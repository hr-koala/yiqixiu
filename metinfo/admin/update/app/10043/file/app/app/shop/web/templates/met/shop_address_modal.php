<!--<?php
echo <<<EOT
-->
<!-- Modal -->
<div class="modal fade modal-primary" id="addr-edit-modal" aria-hidden="true" aria-labelledby="addr-edit-modal" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content">
			<form action="{$_M['url']['shop_addr_editor']}" class="addr-edit-form">
				<input name="id" type="hidden">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">{$_M['word']['app_shop_address']}</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="name" data-fv-notempty="true" placeholder="{$_M['word']['app_shop_consigneename']}">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="tel" data-fv-notempty="true" placeholder="{$_M['word']['app_shop_consigneetel']}">
					</div>
					<div class="form-group select-linkage">
						<select class="form-control prov" name="zone_p" data-fv-notempty="true"></select>
						<select class="form-control city margin-top-10" name="zone_c"></select>
						<select class="form-control dist margin-top-10" name="zone_d"></select>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" name="zone_a" data-fv-notempty="true" placeholder="{$_M['word']['app_shop_consigneeaddress']}"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">{$_M['word']['app_shop_save']}</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['app_shop_cancel']}</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->
<!--
EOT;
?>