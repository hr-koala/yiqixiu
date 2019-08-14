<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
//修改判断
$disabled   = $id?'disabled':'';
echo <<<EOT
-->
<form method="POST" class="ui-from yun yuncode" name="myform" action="{$this->action}" target="_self">
	<div class="v52fmbx">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw019']}</h3>
		<dl>
			<dt>{$_YW['t']['yw020']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="title" value="{$nrxx['title']}" type="text" data-required="1">
				</div>
				<span class="tips">{$_YW['t']['yw020']}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_YW['t']['yw015']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="num" value="{$nrxx['num']}" type="text" data-required="1" data-size="10-15" data-ajaxcheck-url="{$ajaxn}">
				</div>
				<span class="tips">{$_YW['t']['yw021']}</span>
			</dd>
		</dl>
		<dl class="code">
			<dt>{$_YW['t']['yw014']}</dt>
<!--
EOT;
if($id){
echo <<<EOT
-->
                        <dd class="ftype_input" style="display: inline-block; min-width: 500px; width: 94%; ">
                            <div class="fbox codeinfodd">
<!--
EOT;
$codelength    = 0;
foreach ($code as $val) {
if($codelength == 20) {
    $endcode = '<div>.....</div>';
}
$codelength++;
echo <<<EOT
-->
                        {$endcode}<div>{$val['code']}</div>
<!--
EOT;
if($codelength > 20) break;
}
echo <<<EOT
-->
                            </div>
                            <span class="tips">{$_YW['t']['yw131']}</span>
                        </dd>
<!--
EOT;
}
echo <<<EOT
-->
                    <dd class="ftype_input" style="display: inline-block; min-width:500px; width: 95%; ">
                            <div class="fbox codeinfo">
<!--
EOT;
foreach ($nrxx['code'] as $val) {
echo <<<EOT
-->
                            <div class="divcode">{$val}<i class="fa fa-times"></i></div>
<!--
EOT;
}
echo <<<EOT
-->
                            </div>
                    </dd>
                </dl>
                <dl class="codenum">
                    <dt></dt>
                    <dd class="ftype_input">
                        <div class="fbox">
                            <input name="codenum" value="{$_YW['c']['fwmakenum']}" type="text"   style="width:100px;">
                            <input name="code" value="" type="hidden" >
                            <button type="button" class="btn btn-primary btn-sm">{$_YW['t']['yw288']}</button>
                        </div>
                        <span class="tips"><a href="{$_M['url']['own_name']}c=config&a=docode" target="_blank" style="color:#2064e2;">{$_YW['t']['yw289']}</a></span>
                    </dd>
                </dl>
		
                
                
		<dl>
			<dt>{$_YW['t']['yw024']}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="info" placeholder="{$_YW['t']['yw025']}" data-size="100-max">{$nrxx['info']}</textarea>
				</div>
				<span class="tips">{$_YW['t']['yw026']}</span>
			</dd>
		</dl>
		
		<h3 class="v52fmbx_hr">{$_YW['t']['yw027']} </h3>
                {$typez}
		<dl>
			<dd><a href="{$_M['url']['own_name']}c=table_on&a=doparameter" target="_blank">{$_YW['t']['yw028']}&nbsp;<i class="fa fa-external-link"></i></a></dd>
		</dl>

		<h3 class="v52fmbx_hr">{$_YW['t']['yw029']}</h3>
		<dl>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="content" data-ckeditor-y="300">{$nrxx['content']}</textarea>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_YW['t']['yw030']}<span class="tips">{$_YW['t']['yw031']}</span></h3>
		<dl>
			<dt>{$_YW['t']['yw032']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="issue" value="{$nrxx['issue']}" type="text" onclick="alert(this.value);" disabled>
				</div>
				<span class="tips">{$_YW['t']['yw033']}</span>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_YW['t']['yw034']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="addtime" value="{$nrxx['addtime']}" type="text" onclick="alert(this.value);" disabled>
				</div>
				<span class="tips">{$_YW['t']['yw035']}</span>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_YW['t']['yw036']}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input name="amendtime" value="{$nrxx['amendtime']}" type="text" onclick="alert(this.value);" disabled>
				</div>
				<span class="tips">{$_YW['t']['yw037']}</span>
			</dd>
		</dl>
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