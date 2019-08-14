define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');
	
	//优惠券
	if($(".discount_editor").length)require.async('own/admin/templates/js/discount_editor');
	
	//财务管理
	if($(".finance_index").length)require.async('own/admin/templates/js/finance_index');
	
	//运费管理
	if($(".zone_index").length)require.async('own/admin/templates/js/zone_index');
	
	//订单管理
	if($(".order_ei").length)require.async('own/admin/templates/js/order_ei');
	
	//设置页面
	if($(".setinvoice").length)require.async('own/admin/templates/js/setinvoice');

});