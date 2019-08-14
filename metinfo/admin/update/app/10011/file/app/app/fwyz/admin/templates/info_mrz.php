<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
.submit{display: inline-block;}
</style>
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_YW['t']['yw128']}<span class="tips">{$_YW['t']['yw129']}<a href="{$_M['url']['own_name']}c=table_on&a=doparameter" style="color:#F00; font-size:14px;">{$_YW['t']['yw130']}</a></span></h3>
		{$tablee}
		<dl class="noborder">
			<dt> </dt>
			<dd>
				<input name="submit" value="{$_YW['t']['yw006']}" class="submit" type="submit">
			</dd>
		</dl>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
?>