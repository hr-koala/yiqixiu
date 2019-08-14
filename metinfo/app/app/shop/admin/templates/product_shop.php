<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$paraku = jsonencode($this->shop->get_para());
echo <<<EOT
-->
<div class="panel panel-default product_shop" data-url="{$_M['url']['app']}shop/admin/templates/js/product_shop.js">
    <div class="panel-heading" role="tab">
		<h4 class="panel-title">
			规格/价格/库存
		</h4>
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<textarea class="hide" name="shop_paralist">{$list['paralist']}</textarea>
<textarea class="hide" name="shop_plist">{$list['plist']}</textarea>
<textarea class="hide" name="shop_message">{$list['message']}</textarea>
<textarea class="hide" name="paraku">{$paraku}</textarea>
<script>
function valisnum(my){
	var t = false;
	if(!isNaN(my.val())&&my.val()!=''){
		t = true;
	}
	return t;
}	
</script>
    </div>
    <div class="" role="tabpanel">
		<div class="v52fmbx">
		<dl>
			<dt>商品规格</dt>
			<dd class="standard">
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" style="margin-top:10px;" type="button">
    <span>添加规格</span>
  </button>
  <ul class="dropdown-menu" role="menu">
	 <li role="presentation" class="divider"></li>
    <li role="presentation" >
		<div class="form-inline" style="margin:0px 10px;">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="输入规格名称">
			</div>
			<button type="button" class="btn btn-primary" style="margin-left:5px;">确定</button>
			<button type="button" class="btn btn-default" style="margin-left:5px;">取消</button>
		</div>
	</li>
	 <li role="presentation" class="divider"></li>
		<li role="presentation" class="existing" style="max-height:300px; overflow:auto;">
<!--
EOT;
foreach($this->shop->get_para() as $key=>$val){
echo <<<EOT
-->
			<a href="javascript:;">{$key}</a>
<!--
EOT;
}
echo <<<EOT
-->
		</li>
  </ul>
</div>
			</dd>
		</dl>
		<dl class="stock hide">
			<dt>商品库存</dt>
			<dd>
			</dd>
		</dl>
		<dl>
			<dt>价格</dt>
			<dd>
				<div class="fbox">
					<div class="form-inline">
						<div class="form-group">
							<div class="input-group">
							  <span class="input-group-addon">￥</span>
							  <input type="text" class="form-control" name="price" value="{$list[price]}" style="width:100px;" data-required="1" >
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="original" value="{$list[original]}" placeholder="原价" style="width:100px;" >
						</div>
					</div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>总库存</dt>
			<dd>
				<div class="form-inline">
					<div class="form-group">
						<input type="text" name="stock" class="form-control" value="{$list[stock]}" style="width:100px;" data-required="1" />
					</div>
					<div class="checkbox" style="margin-left:10px;">
						<label>
							<input type="checkbox" name="stock_show" value="1" data-checked="{$list[stock_show]}">
							页面显示商品库存
						</label>
					</div>
				</div>
			</dd>
		</dl>
		</div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading" role="tab">
		<h4 class="panel-title">
			物流/其它
		</h4>
    </div>
    <div id="logistics" class="">
		<div class="panel-body v52fmbx">
		<dl>
			<dt>运费设置</dt>
			<dd>
				<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="freight_type" value="2" data-checked="{$list[freight_type]}">
							统一运费
						</label>
					</div>
					<div class="form-group" style="margin-left:10px;">
						<div class="input-group">
						  <span class="input-group-addon">￥</span>
						  <input type="text" class="form-control input-sm" name="freight" value="{$list[freight]}" style="width:100px;" >
						</div>
					</div>
				</div>
				<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="freight_type" value="1" >
							运费模板
						</label>
					</div>
					<div class="form-group" style="margin-left:10px;">
						<select name="freight_mould" data-checked="{$list[freight_mould]}"></select>
						<a href="{$_M[url][adminurl]}anyid=44&n=shop&c=freight_admin&a=doindex" target="_blank" style="margin-left:10px;">新建</a>
						<a href="{$_M[url][adminurl]}anyid=44&n=shop&c=freight_admin&a=dorefresh_discount_list" class="refresh_freight_mould" style="margin-left:10px;">刷新</a>
					</div>
				</div>
				<div class="form-inline">
					<div class="radio">
						<label>
							<input type="radio" name="freight_type" value="0">
							无需物流
						</label>
					</div>
					<div class="form-group" style="margin-left:10px;">
						<span class="tips">客户不需要设置邮寄地址</span>
					</div>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>每人限购</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="purchase" value="{$list[purchase]}" style="width:100px;" />
				</div>
				<span class="tips">0为不限</span>
			</dd>
		</dl>
		<dl>
			<dt>要求留言</dt>
			<dd class="message_list">
				<p><a href="javascript:;" class="add_message">+添加字段</a></p>
				<textarea name="message_html" class="hide">
					<div class="form-inline" style="margin-bottom:10px;">
						<div class="form-group">
							<input type="text" name="message_list" placeholder="字段名称" class="form-control input-sm" value="" style="width:100px;" />
						</div>
						<div class="checkbox" style="margin-left:10px;">
							<label>
								<input type="checkbox" name="message_line" value="1">
								多行
							</label>
						</div>
						<div class="checkbox" style="margin-left:10px;">
							<label>
								<input type="checkbox" name="message_required" value="1">
								必填
							</label>
						</div>
						<div class="form-group" style="margin-left:10px;">
							<a href="javascript:;" class="delete">删除</a>
						</div>
					</div>
				</textarea>
			</dd>
		</dl>
		<dl class="hide">
			<dt>会员折扣</dt>
			<dd class="ftype_checkbox">
				<div class="fbox">
					<label><input name="user_discount" type="checkbox" value="1" data-checked="{$list['user_discount']}">不参加会员折扣</label>
				</div>
			</dd>
		</dl>
		<dl class="hide">
			<dt>发票</dt>
			<dd class="ftype_radio ftype_transverse">
				<div class="fbox">
					<label><input name="lnvoice" type="radio" value="0" data-checked="{$list['lnvoice']}">无</label>
					<label><input name="lnvoice" type="radio" value="1">有</label>
				</div>
			</dd>
		</dl>
		</div>
    </div>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>