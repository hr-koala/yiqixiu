<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['5'] = 'active';
$path['web-icons'] = 1;
$path['formvalidation'] = 1;
$path['alertify'] = 1;
$path['tokenfield'] = 1;
$path['switchery'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<script type="text/javascript">
var siteurl='{$_M[url][site]}';
var basepath='{$_M[url][site_admin]}';
var lang = "cn";
</script>
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12 margin-bottom-20">
<!--
EOT;
$shopnav[2] = 'class="active"';
require $this->template('own/setremind_nav');
echo <<<EOT
-->
				</div>
				<div class="col-md-10">
					<div class="well well-sm">请先配置好「发件箱」和「短信」功能<br/>「发件箱」设置-基本信息-邮件发送设置<br/>「短信」我的应用-短信功能</div>
					<div class="well well-sm">可用参数，下列参数在提醒内容中会被转意为可变参数。<br/>{rid} 订单号<br/>{user} 会员名<br/>{logistics} 物流公司<br/>{odd} 快递单号</div>
					<form action="{$_M[url][own_form]}a=doeditor&action=dosetremind_user" id="shop_remind" class="form-horizontal">
						<div class="example-wrap margin-bottom-20">
							<h4 class="example-title">下单后</h4>
							
								<hr>
							<div class="example">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否短信提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_usmsv1" data-plugin="switchery" value="1" {$is_usmsv1}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">短信设置</label>
									<div class="col-sm-5">
										<textarea class="form-control" name="shopv2_usmsv1" rows="4">{$_M['config']['shopv2_usmsv1']}</textarea>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否邮件提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_uemailv1" data-plugin="switchery" value="1" {$is_uemailv1}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件设置</label>
									<div class="col-sm-5">
										<button type="button" class="btn btn-outline btn-primary btn-sm" data-toggle="collapse" data-target="#btn-email-place-order" aria-expanded="false" aria-controls="btn-email-place-order">设置</button>	
									</div>
								</div>
								<hr>
								<div class="collapse margin-bottom-0" id="btn-email-place-order">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件标题</label>
									<div class="col-sm-5">
									 <input type="text" class="form-control" placeholder="邮件标题" name="shopv2_uemailtv1" value="{$_M['config']['shopv2_uemailtv1']}" />
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件内容</label>
									<div class="col-sm-10">
									 <textarea class="" id="editor-email-place-order" name="shopv2_uemailcv1" rows="1">{$_M['config']['shopv2_uemailcv1']}</textarea>
									</div>
								</div>
								<hr>
								</div>
						</div>
						<div class="example-wrap margin-bottom-20">
							<h4 class="example-title">付款后</h4>
								<hr>
							<div class="example">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_usmsv2" data-plugin="switchery" value="1" {$is_usmsv2}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">短信设置</label>
									<div class="col-sm-5">
										<textarea class="form-control" name="shopv2_usmsv2" rows="4">{$_M['config']['shopv2_usmsv2']}</textarea>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否邮件提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_uemailv2" data-plugin="switchery" value="1" {$is_uemailv2}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件设置</label>
									<div class="col-sm-5">
										<button type="button" class="btn btn-outline btn-primary btn-sm" data-toggle="collapse" data-target="#btn-email-pay" aria-expanded="false" aria-controls="btn-email-pay">设置</button>
									</div>
								</div>
								<hr>
								<div class="collapse" id="btn-email-pay">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件标题</label>
									<div class="col-sm-5">
									 <input type="text" class="form-control" placeholder="邮件标题" name="shopv2_uemailtv2" value="{$_M['config']['shopv2_uemailtv2']}">
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件内容</label>
									<div class="col-sm-10">
									 <textarea class="" id="editor-email-pay" rows="1" name="shopv2_uemailcv2">{$_M['config']['shopv2_uemailcv2']}</textarea>
									</div>
								</div>
								<hr>
								</div>
							</div>	
						</div>
						<div class="example-wrap margin-bottom-20">
							<h4 class="example-title">发货后</h4>
								<hr>
							<div class="example">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_usmsv3" data-plugin="switchery" value="1" {$is_usmsv3}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">短信设置</label>
									<div class="col-sm-5">
										<textarea class="form-control" name="shopv2_usmsv3" rows="4">{$_M['config']['shopv2_usmsv3']}</textarea>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">是否邮件提醒</label>
									<div class="col-sm-5">
										<input type="checkbox" id="btn-place-order" name="shopv2_is_uemailv3" data-plugin="switchery" value="1" {$is_uemailv3}/>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件设置</label>
									<div class="col-sm-5">
										<button type="button" class="btn btn-outline btn-primary btn-sm"  data-toggle="collapse" data-target="#btn-email-deliver-goods" aria-expanded="false" aria-controls="btn-email-deliver-goods">设置</button>
									</div>
								</div>	
								<hr>
								<div class="collapse" id="btn-email-deliver-goods">
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件标题</label>
									<div class="col-sm-5">
									  <input type="text" class="form-control" placeholder="邮件标题" name="shopv2_uemailtv3" value="{$_M['config']['shopv2_uemailtv3']}">
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label font-weight-unset">邮件内容</label>
									<div class="col-sm-10">
									 <textarea class="" id="editor-email-deliver-goods" name="shopv2_uemailcv3" rows="1">{$_M['config']['shopv2_uemailcv3']}</textarea>
									</div>
								</div>	
								<hr>
								</div>								
							  </div>
						</div>
						<div class="form-group">
							<div class="col-sm-3"></div>
							<div class="col-sm-9"><button type="submit" class="btn btn-primary">保存</button></div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
<script type="text/javascript" src="{$_M[url][site]}app/system/include/public/js/examples/editor/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="{$_M[url][site]}app/system/include/public/js/examples/editor/ueditor/ueditor.all.min.js"></script>
<script src="{$_M[url][own]}admin/templates/js/setremind.js"></script>
</body>
</html>
<!--
EOT;
?>-->