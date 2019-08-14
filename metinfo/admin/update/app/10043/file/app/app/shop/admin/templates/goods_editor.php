<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M['url']['own_tem']}/css/goods.css" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doeditorsave" target="_self">
	<input type="hidden" name="id" value="{$_M['form']['id']}" />
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">基本信息</h3>
		<dl>
			<dt>商品名称</dt>
			<dd class="ftype_input">
				<div class="fbox">
					商品示例
				</div>
			</dd>
		</dl>
		<dl>
			<dt>基本信息修改</dt>
			<dd class="ftype_input">
				<div class="fbox">
					基本信息修改请到系统原生产品管理页面修改，修改请点击保存后关闭页面！（点击打开）
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">规格</h3>
		<dl id="para_div">
			<dt><a href="javascript:;" id="para_add">添加+</a></dt>
			<dd class="ftype_input">
				<div class="fbox">
					<div>

					</div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd>
				<div class="row">
					  <div class="col-lg-2">
						<div class="input-group">
						  <input type="text" class="form-control" aria-label="...">
						  <div class="input-group-btn">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
							<ul class="dropdown-menu dropdown-menu-right" role="menu">
							  <li><a href="javascript:;">颜色</a></li>
							  <li><a href="javascript:;">大小</a></li>
							  <li><a href="javascript:;">尺寸</a></li>
							  <li><a href="javascript:;">高度</a></li>
							</ul>
						  </div><!-- /btn-group -->
						</div><!-- /input-group -->
					  </div><!-- /.col-lg-5 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12">
						<div class="tags_ul">
						<ul>
							<li class="tags_list">
								<span>红</span><a></a>
							</li>

							<li class="tags_list">
								<span>黄</span><a></a>
							</li>

							<li class="tags_list">
								<span>蓝</span><a></a>
							</li>

							<li class="tags_tj"><span></span>
								<input type="text" style="width: 30px; display: none;" class="">
							</li>
						</ul>
						<div>
					</div>
				</div><!-- /.row -->


			</dd>
		</dl>
<dl>
	<dt>标签增加器</dt>
	<dd class="ftype_tags">
		<div class="fbox">
			<input name="tags" type="hidden" data-label="|" value="metinfo@metinfo.cn">
		</div>
		<span class="tips">描述文字，用于说明该设置的作用。</span>
	</dd>
</dl>
		<h3 class="v52fmbx_hr">库存/价格</h3>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
				<table class="display dataTable ui-table1 new_effects">
					<thead>
						<tr>
							<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
							<th>颜色</th>
							<th data-table-columnclass="met-center" width="80">大小</th>
							<th data-table-columnclass="met-center" width="80">价格</th>
							<th data-table-columnclass="met-center" width="80">库存</th>
							<th data-table-columnclass="met-center" width="80">商家编码</th>
							<th data-table-columnclass="met-center" width="150">销量</th>
							<th width="200">操作</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">物流/其它</h3>
		<dl>
			<dt>运费设置</dt>
			<dd class="ftype_radio">
				<div class="fbox">
					<label><input name="radio1" type="radio" value="1">统一运费</label>
					<label><input name="radio1" type="radio" value="2">使用模板</label>
				</div>
				<span class="tips">描述文字，用于说明该设置的作用。</span>
			</dd>
		</dl>
		<dl>
			<dt>运费模板</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="valid" data-checked="">
						<option value="1">省内模板</option>
						<option value="1">省外模板</option>
						<option value="1">其他模板</option>
					</select>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>每人限购</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="" value=""/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>要求留言</dt>
			<dd class="ftype_input">
				<div class="fbox">
					+添加
				</div>
			</dd>
		</dl>
		<dl>
			<dt>开售时间</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="" value=""/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>会员折扣</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="" value=""/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>发票</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="" value=""/>
				</div>
			</dd>
		</dl>

		<dl>
			<dt>是否激活</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="valid" data-checked="{$user['valid']}">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</div>
			</dd>
		</dl>
<!--
EOT;

echo <<<EOT
-->
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="保存" class="submit" />
			</dd>
		</dl>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>