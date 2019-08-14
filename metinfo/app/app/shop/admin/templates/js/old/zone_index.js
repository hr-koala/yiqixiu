define(function(require, exports, module) {
	//优惠券
	var $ = jQuery = require('jquery');
	var common = require('common');	

	function select_div(){
		var no_select_zone,select_zone;
		no_select_zone = $("input[name='no_select_zone']").val().split(',');
		select_zone = $("input[name='select_zone']").val().split(',');
		$('.no_select_div .zone_div').each(function(){
			var flag = 0;
			for(var i=0; i< no_select_zone.length; i++){
				if($(this).html() == no_select_zone[i]){
					flag = 1;
				}
			}
			if(flag == 1){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
		
		$('.select_div .zone_div').each(function(){
			var flag = 0;
			for(var i=0; i< select_zone.length; i++){
				if($(this).html() == select_zone[i]){
					flag = 1;
				}
			}
			if(flag == 1){
				$(this).parent('div').attr('data-info', 1);
				$(this).parent('div').show();
			}else{
				$(this).parent('div').attr('data-info', 0);
				$(this).parent('div').hide();
			}
		});
	
	}
	
	function re_select_input(){
		var s = '';
		$('.select_div .zone_div').each(function(){
			if($(this).parent('div').attr('data-info') == 1 && $(this).html()){
				s = s + $(this).html()+',';
			}
		});
		$("input[name='select_zone']").val(s);
	}
	
	//添加规则
	$(document).on('click',".add-zone",function(){
		if($("#all_no_select_zone").val() != ''){
			$("input[name='no_select_zone']").val($('#all_no_select_zone').val()+',');
			$("input[name='select_zone']").val('');	
			$(".zone").attr('action', own_form+'a=doaddzonesave');
			$("input[name='zid']").val('');
			select_div();	
			$('.bs-example-modal-lg').modal();
		}else{
			alert('区域已全部被选中，无法添加新规则！！！');
		}
	});
	
	//编辑规则
	$(document).on('click',".editor-zone",function(){
		$("input[name='no_select_zone']").val($('#all_no_select_zone').val()+',');
		$("input[name='select_zone']").val($(this).attr('data-info')+',');
		$(".zone").attr('action', own_form+'a=doeditorzonesave');
		$("input[name='zid']").val($(this).attr('data-zid'));
		select_div();
	});
	
	//区域选中
	$(document).on('click',".no_select_div .zone_div",function(){
		var data = $(this).attr('data-info');
		if(data == '1'){
			$(this).css('background', '#fff');
			$(this).attr('data-info', '0');
		}else{
			$(this).css('background', '#ccc');
			$(this).attr('data-info', '1');
		}
	});
	
	//添加区域
	$(document).on('click',".js-zone-add",function(){
		$('.no_select_div .zone_div').each(function(){
			if($(this).attr('data-info') == 1){
				$(this).attr('data-info', '0');
				var no_select_zone = $("input[name='no_select_zone']");
				no_select_zone.val(no_select_zone.val().replace($(this).html()+',' , ''));
				var select_zone = $("input[name='select_zone']");
				select_zone.val(select_zone.val()+$(this).html()+',');
			}
		});
		select_div();
		re_select_input();
	});
	
	//删除区域
	$(document).on('click',".js-zone-del",function(){
		var zone = $(this).parent('div').find('.zone_div').html();
		var no_select_zone = $("input[name='no_select_zone']");
		no_select_zone.val(no_select_zone.val()+zone+',');
		var select_zone = $("input[name='select_zone']");
		select_zone.val(select_zone.val().replace(zone+',', ''));	
		select_div();
		re_select_input();
	});
});