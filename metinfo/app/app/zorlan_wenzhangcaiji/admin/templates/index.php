<?php
defined('IN_MET') or exit('No permission'); require_once $this -> template('own/head'); echo <<<EOF
-->
<style type="text/css">
</style>
<script type="text/javascript">
function caiji(){
	$('#html_wrap').html('正在采集...');
	$("html,body").animate({scrollTop:$("#result_msg").offset().top},1000);
	$.ajax({
		type: 'post',
		url: '{$_M['url']['own_form']}a=docaiji&isajax=1',
		data: $('#cjform').serialize(),
		success: function(re){
			if(re.success){
				$('#html_wrap').html('<b style="color:red">标题：</b><br> &nbsp; &nbsp; &nbsp; &nbsp;'+re.title
					+'<br><b style="color:red">内容：</b><br> &nbsp; &nbsp; &nbsp; &nbsp;'+re.content);
			}else{
				$('#html_wrap').html(re.error);
			}
		},
		dataType: 'json',
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		
  		}
	});
}

function fabu(){
	$('#html_wrap').html('正在发布...');
	$("html,body").animate({scrollTop:$("#result_msg").offset().top},1000);
	$.ajax({
		type: 'get',
		url: '{$_M['url']['own_form']}a=dofabu&isajax=1',
		data: $('#cjform').serialize(),
		success: function(re){
			if(re.success){
				$('#html_wrap').html(re.html);
			}else{
				$('#html_wrap').html(re.error);
			}
		} ,
		dataType: 'json'
	});
}


/*添加替换*/
function add_cont_replace(str1,str2){
	if(!str1)str1='';
	if(!str2)str2='';

	$('#div_cont_replace').append('<div><input name="cont_replace1[]" type="text" class="text nonull" value="'+
		str1+'" /> &nbsp;替换成 &nbsp;<input name="cont_replace2[]" type="text" class="text nonull"  value="'+
		str2+'" /> &nbsp;<a href="javascript:;" onclick="$(this).parent().remove()">删除</a></div>');
}
</script>
<form action="{$_M['url']['own_form']}" id="cjform" method="post" >
<div class="v52fmbx">
		<h3 class="v52fmbx_hr">采集文章</h3>
		<dl>
			<dt>文章网址</dt>
			<dd>
				<input name="articleurl" type="text" class="text nonull" style="width:80%">
			</dd>
		</dl>
		<dl>
			<dt>网页编码</dt>
			<dd>
				<select name="charset" class="noselect" onchange="">		
					<option value="">自动检测</option>
					<option value="utf-8">utf-8</option>
					<option value="gbk">gbk</option>
					<option value="gb2312">gb2312</option>
				</select>	
			</dd>
		</dl>
		<dl>
			<dt>发布到</dt>
			<dd>
<!--
EOF;
$column_list=get_article_column(); $this -> template_column_list($column_list,null); $default_filtertags='a,script,style,iframe,object,form'; echo <<<EOF
-->
			
				<span class="tips" style="margin-left:15px;"><a href="{$_M[url][site_admin]}column/index.php?anyid=25&lang={$_M[lang]}" >{$_M['word']['configuration_section']}</a></span>
			</dd>
		</dl>
						
		<dl>
			<dt>过滤html标签</dt>
			<dd>
				<input name="filtertag" id="filtertag" type="text" class="text nonull" style="width:400px" value="{$default_filtertags}"> 用空格或逗号分隔  &nbsp; <a href="{$_M[url][site]}app/app/zorlan_wenzhangcaiji/admin/templates/static/filtertag.html?inputid=filtertag" onclick="window_iframe(this.href);return false;">常用</a>
			</dd>
		</dl>
		
						
		<dl>
			<dt>可选操作</dt>
			<dd style="color:#333;">
				<label><input name="operate[]" type="checkbox" checked="true" class="checkbox" value="download_image" />下载图片</label>
			</dd>
		</dl>			
		<dl>
			<dt>内容替换<br />（支持正则）</dt>
			<dd>
				<a href="javascript:;" onclick="add_cont_replace()">+添加替换规则</a>
				<div id="div_cont_replace">
					{$cont_replace_html}
				</div>
			</dd>
		</dl>
						
		<dl>
			<dt> </dt>
			<dd>
				<input type="button" value="采集" class="submit" onclick="caiji()">&nbsp;&nbsp;
				<input type="button" value="发布" class="submit" onclick="fabu()">
			</dd>
		</dl>
</div>
</form>

<div class="v52fmbx">
	<h3 class="v52fmbx_hr" id="result_msg" style="color:red;">执行结果</h3>
	
	<div id="html_wrap" style="padding:10px;width:90%;overflow:hidden;"></div>
</div>
							
<div style="line-height:30px;font-weight:bold;">&nbsp; <a href="{$_M[url][adminurl]}n=appstore&c=appstore&a=doappdetail&type=app&no=10026" target="_blank">升级版“自动采集插件”功能更强大！</a></div>
<!--
EOF;
require_once $this -> template('own/foot'); ?>