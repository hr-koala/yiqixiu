define(function(require, exports, module) {

	//财务管理
	var $ = jQuery = require('jquery');
	var common = require('common');
	
	//详细弹窗
	$(document).on('click',".detailed",function(){
		$('#detailed_div').html($(this).attr('data-info'));
	});
	
});