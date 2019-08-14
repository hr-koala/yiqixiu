<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['1'] = 'active';
$path['web-icons'] = 1;
$path['font-awesome'] = 1;
$path['chartist']=1;
$path['ecommerce']=1;
$path['order_index']=1;
require $this->template('own/head');
echo <<<EOT
-->
<script>
	var dayslotjson = {$dayslotjson},
		price_prefix = '{$_M['config']['shopv2_price_str_prefix']}',
		price_suffix = '{$_M['config']['shopv2_price_str_suffix']}';
</script>
<!--<link rel="stylesheet" href="{$_M[url][own]}admin/templates/ui/vendor/chartist-js/chartist.min.css">
<link rel="stylesheet" href="{$_M[url][own]}admin/templates/ui/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css">
<link rel="stylesheet" href="{$_M[url][own]}admin/templates/css/ecommerce.css">-->
<div class="page-content container-fluid">
	<div class="row" data-plugin="matchHeight" data-by-row="true">
		<!-- First Row -->
		<div class="col-lg-4 col-sm-4 col-xs-12 info-panel">
		  <div class="widget widget-shadow">
			<div class="widget-content bg-white padding-20">
			  <button type="button" class="btn btn-floating btn-sm btn-danger">
				<i class="icon fa-dollar"></i>
			  </button>
			  <span class="margin-left-15 font-weight-400">收入</span>
			  <div class="content-text text-center margin-bottom-0">
				<i class="icon {$income_i} font-size-20"></i>
				<span class="font-size-40 font-weight-100">{$income_price}</span>
				<p class="blue-grey-400 font-weight-100 margin-0" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="上个月 {$last['sum']['income']}">{$income_per}% 比上个月</p>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-12 info-panel">
		  <div class="widget widget-shadow">
			<div class="widget-content bg-white padding-20">
			  <button type="button" class="btn btn-floating btn-sm btn-warning">
				<i class="icon wb-shopping-cart"></i>
			  </button>
			  <span class="margin-left-15 font-weight-400">订单数</span>
			  <div class="content-text text-center margin-bottom-0">
				<i class="icon {$order_i} font-size-20"></i>
				<span class="font-size-40 font-weight-100">{$first['sum']['order_number']}</span>
				<p class="blue-grey-400 font-weight-100 margin-0" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="上个月 {$last['sum']['order_number']}">{$order_per}% 比上个月</p>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-lg-4 col-sm-4 col-xs-12 info-panel">
		  <div class="widget widget-shadow">
			<div class="widget-content bg-white padding-20">
			  <button type="button" class="btn btn-floating btn-sm btn-primary">
				<i class="icon wb-user"></i>
			  </button>
			  <span class="margin-left-15 font-weight-400">下单人数</span>
			  <div class="content-text text-center margin-bottom-0">
				<i class="icon {$order_user_i} font-size-20"></i>
				<span class="font-size-40 font-weight-100">{$first['sum']['order_user']}</span>
				<p class="blue-grey-400 font-weight-100 margin-0" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="上个月 {$last['sum']['order_user']}">{$order_user_per}% 比上个月</p>
			  </div>
			</div>
		  </div>
		</div>
		<!-- End First Row -->
        <!-- second Row -->
        <div class="col-ms-12 col-xs-12 col-md-12" id="ecommerceChartView">
          <div class="widget widget-shadow">
            <div class="widget-header padding-20">
              <div class="radio-custom radio-primary radio-inline">
                  <input type="radio" id="checkincome" class="checkchartist" value="income" name="checkchartist" checked>
                  <label for="checkincome">收入</label>
              </div>
              <div class="radio-custom radio-primary radio-inline">
                  <input type="radio" id="checkorder" class="checkchartist" value="order" name="checkchartist">
                  <label for="checkorder">订单数</label>
              </div>
              <ul class="nav nav-pills nav-pills-rounded chart-action" data-plugin="nav-tabs">
                <li class="active"><a data-toggle="tab" href="#scoreLineToDay">今天</a></li>
                <li><a data-toggle="tab" href="#scoreLineToWeek">本周</a></li>
                <li><a data-toggle="tab" href="#scoreLineToMonth">本月</a></li>
              </ul>
            </div>
            <div class="widget-content tab-content bg-white padding-20">
              <div class="ct-chart tab-pane active height-300" id="scoreLineToDay"></div>
              <div class="ct-chart tab-pane height-300" id="scoreLineToWeek"></div>
              <div class="ct-chart tab-pane height-300" id="scoreLineToMonth"></div>
            </div>
          </div>
        </div>
        <!-- End Second Row -->
	</div>
</div>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
<!--<script src="{$_M[url][own]}admin/templates/ui/vendor/chartist-js/chartist.min.js"></script>
<script src="{$_M[url][own]}admin/templates/ui/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>
<script src="{$_M[url][own]}admin/templates/js/order_index.js"></script>-->
</body>
</html>
<!--
EOT;
?>-->