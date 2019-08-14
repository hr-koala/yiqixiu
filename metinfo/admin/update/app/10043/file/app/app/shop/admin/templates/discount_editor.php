<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$path['web-icons'] = 1;
$path['font-glyphicons'] = 1;
$path['asScrollable'] = 1;
$path['x_editable'] = 1;
$path['alertify'] = 1;
$path['select_2'] = 1;
$path['formvalidation'] = 1;
$path['datepicker'] = 1;
$path['datatables'] = 1;
$path['tableset'] = 1;
$path['discount'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<div class="page-content discount_editor" data-do_json_discount_goods-url="{$_M['url'][own_form]}">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">	
        <form method="POST" name="myform" class="form-horizontal fv-form fv-form-bootstrap discount_editor_table" action="{$_M[url][own_form]}a={$action}" target="_self">   
		  <input name="id" type="checkbox" value="{$discount['id']}" checked="checked" style="display:none;"/>
<!--基本信息-->		
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">优惠券名称</label>
			<div class="col-sm-6">
				<input id="" name="name" autocomplete="off" placeholder="" class="form-control" data-fv-notempty="true" type="text" value="{$discount['name']}">
			</div>
          </div>		  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">面值</label>
			<div class="col-sm-6">
				<input id="" name="par" autocomplete="off" data-fv-notempty="true" data-fv-numeric="true" data-fv-between-min="0" placeholder="" class="form-control" type="text" value="{$discount['par']}">
			</div>
          </div>

<!--使用规则-->			
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">使用条件</label>
			<div class="col-sm-6">
				<div class="input-group">
                    <span class="input-group-addon">订单满</span>
					<input id="" name="r_price" autocomplete="off"  data-fv-notempty="true" data-fv-numeric="true" placeholder="" class="form-control" type="text" value="{$discount['r_price']}">
					<span class="input-group-addon">可以使用</span>
				</div>
			</div>
          </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">用户等级限制</label>
			<div class="col-sm-6">
				<select class="form-control" name="ugid">
						<option value="0">任何会员后可以领取</option>
<!--
EOT;
foreach($group as $key=>$val){						
echo <<<EOT
-->
						<option value="{$val['access']}">{$val['name']}以上可以领取</option>
<!--
EOT;
}					
echo <<<EOT
-->
					</select>
			</div>
          </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">发放总量</label>
			<div class="col-sm-6">
				<div class="input-group">   
					<input id="" name="amount" autocomplete="off"  data-fv-notempty="true" data-fv-numeric="true" placeholder="" class="form-control" type="text" value="{$discount['amount']}">
					<span class="input-group-addon">张</span>
				</div>
			</div>
          </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">每人限领</label>
			<div class="col-sm-6">
				<div class="input-group">   
					<input id="" name="one_user_have" autocomplete="off"  data-fv-notempty="true" data-fv-numeric="true" placeholder="" class="form-control" type="text" value="{$discount['one_user_have']}">
					<span class="input-group-addon">张</span>
				</div>
			</div>
          </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">生效时间</label>
			<div class="col-sm-6">
				<div class="input-group">
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-start" data-plugin="datepicker"  data-fv-notempty="true" name="s_time_1" value="{$discount['s_time_1']}">
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
					<input type="text" class="form-control datepair-time datepair-start" data-plugin="clockpicker"  data-fv-notempty="true" name="s_time_2" value="{$discount['s_time_2']}"/>
                  </div>
			</div>
          </div>			  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">结束时间</label>
			<div class="col-sm-6">
				<div class="input-group">
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-date datepair-end" data-plugin="datepicker"  data-fv-notempty="true" name="e_time_1" value="{$discount['e_time_1']}"/>
                    <span class="input-group-addon">
                      <i class="icon wb-time" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control datepair-time datepair-end" data-plugin="clockpicker"  data-fv-notempty="true" name="e_time_2" value="{$discount['e_time_2']}"/>
                  </div>
			</div>
          </div>
		  
	  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">可使用商品</label>
			<div class="col-sm-6 radio-custom">
				<div class="radio-custom radio-primary">
				  <input name="all_goods" type="radio" value="1" {$check_all_goods[1]}>
                  <label>全部商品</label>
                </div>
				<div class="radio-custom radio-primary">
				  <input name="all_goods" type="radio" value="0" {$check_all_goods[0]}>
                  <label>指定商品</label>
                </div>
			</div>
          </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset"></label>
			<div class="col-sm-6">
				<a href="javascript:;" class="btn btn-success add-goods" data-toggle="modal" data-target=".bs-example-modal-lg">编辑商品</a>
				<input type="hidden" name="goods_list" value="{$discount['goods_list']}" />
			</div>
          </div>
		  
		  <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset">使用说明</label>
			<div class="col-sm-6">
				<textarea class="form-control" name="instructions" rows="5"  data-fv-notempty="true">{$discount['instructions']}</textarea>
			</div>
          </div>
		  
          <div class="form-group">
			<label class="col-sm-2 control-label font-weight-unset"></label>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-primary">保存</button>
				<a class="btn btn-sm btn-white" href="javascript:void(0)">返回</a>
			</div>
          </div>
        </form>
			</div>
		</div>
	</div>
</div>

<!--				
<div class="discount_editor">
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a={$action}" target="_self">
	<input name="id" type="checkbox" value="{$discount['id']}" checked="checked" style="display:none;"/>
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">优惠券基础信息</h3>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="name" data-required="1" value="{$discount['name']}"/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="par" data-required="1" value="{$discount['par']}" style="width:100px;"/>
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					订单满&nbsp<input type="text" name="r_price" data-required="1" value="{$discount['r_price']}" style="width:100px;"/>，可以使用。
				</div>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">基本规则</h3>
		<dl>
			<dt></dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="ugid" data-required="1" data-checked="{$discount['ugid']}">
						<option value="0">任何会员后可以领取</option>
<!--
EOT;
foreach($group as $key=>$val){						
echo <<<EOT
-->
						<option value="{$val['access']}">{$val['name']}以上可以领取</option>
<!--
EOT;
}					
echo <<<EOT
-->
					</select>
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="amount" data-required="1" value="{$discount['amount']}" style="width:100px;"/>&nbsp张
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					&nbsp<input type="text" name="one_user_have" data-required="1" value="{$discount['one_user_have']}" style="width:100px;"/>&nbsp张
				</div>
			</dd>
		</dl>		
		<dl>
			<dt></dt>
			<dd class="ftype_day">
				<div class="fbox">
					<input data-day-type="2" type="input" name="s_time" data-required="1" value="{$discount['s_time_str']}">
				</div>
				<span class="tips">请选择时间</span>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_day">
				<div class="fbox">
					<input data-day-type="2" type="input" name="e_time" data-required="1" value="{$discount['e_time_str']}">
				</div>
				<span class="tips">请选择时间</span>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="ftype_radio">
				<div class="fbox">

				</div>
			</dd>
		</dl>
		<div class="goods_radio none">
		<dl>
			<dt></dt>
			<dd class="ftype_input">
				<div class="fbox">
					<a href="javascript:;" class="btn btn-success add-goods" data-toggle="modal" data-target=".bs-example-modal-lg">添加商品</a>
					<input type="hidden" name="goods_list" value="{$discount['goods_list']}" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt></dt>
			<dd class="row">
				<div class="fbox" id="dl_goods_list"></div>
			</dd>
		</dl>
		</div>
		<dl>
		<dt></dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="instructions">{$discount['instructions']}</textarea>
				</div>
			</dd>
		</dl>		
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="保存" class="submit" />
			</dd>
		</dl>
	</div>
</form>
-->

<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doaddfinance" target="_self">

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">商品选择</h4>
      </div>
	  <div class="modal-body">

		<div class="col-sm-7 margin-top-20">
			<div class="form-group margin-bottom-10">
				<div class="input-search">
					<i class="input-search-icon wb-search" aria-hidden="true"></i>
					<input type="text" class="form-control" name="keyword" data-table-search="true" placeholder="商品名称">
				</div>
			</div>		
		</div>
		<table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" id="table_id"  data-table-ajaxurl="{$_M[url][own_form]}a=dojson_goods_list">
		<input type="hidden" name="select_goods" data-table-search="1" value="{$discount['goods_list']}" />
			<thead>
				<tr>
					<th>商品</th>
					<th data-table-columnclass="met-center" width="150">创建时间</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th colspan="2" class="formsubmit">
					</th>
				</tr>
			</tfoot>
		</table>
	</div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		<button type="button" class="btn btn-primary save-goods" data-dismiss="modal">保存</button>
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
<!--<script src="{$_M[url][own]}admin/templates/js/tableset.js"></script>
<script src="{$_M[url][own]}admin/templates/js/discount.js"></script>-->
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>