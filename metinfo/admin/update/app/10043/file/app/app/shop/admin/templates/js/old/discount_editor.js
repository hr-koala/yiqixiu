define(function(require, exports, module) {
	//优惠券
	var $ = jQuery = require('jquery');
	var common = require('common');	
	//添加商品
	$(document).on('click',".add-goods",function(){
		$("input[name='select_goods']").val($("input[name='goods_list']").val());
		$("input[name='select_goods']").keyup();
	});
	
	//保存商品
	$(document).on('click',".save-goods",function(){
		$("input[name='goods_list']").val($("input[name='select_goods']").val());
		do_json_discount_goods();
	});
	
	//删除商品
	$(document).on('click',".del-goods",function(){
		var id = $(this).attr('data-id');
		var selected = $("input[name='goods_list']").val();
		$("input[name='goods_list']").val(selected.replace(id+',', ''));
		$('#goods-div-'+id).remove();	
	});
	
	//选中商品
	$(document).on('click',".select_p",function(){
		var id = $(this).attr('data-id');
		var select = "select-"+id;
		$('#'+select).html("<a class=\"noselect_p\" data-id=\""+id+"\" href=\"javascript:void(0)\">已选中</a>");
		var selected = $("input[name='select_goods']").val();
		$("input[name='select_goods']").val(selected+id+',');
	});
	
	//取消商品
	$(document).on('click',".noselect_p",function(){
		var id = $(this).attr('data-id');
		var select = "select-"+id;
		$('#'+select).html("<a class=\"select_p\" data-id=\""+id+"\" href=\"javascript:void(0)\">选中</a>");
		var selected = $("input[name='select_goods']").val();
		$("input[name='select_goods']").val(selected.replace(id+',', ''));

		
	});
	
	//获取商品列表商品
	function do_json_discount_goods(){
		var url = own_form+'a=do_json_discount_goods&idlist='+$("input[name='goods_list']").val();
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			success: function(data) {
				$('#dl_goods_list').html(data);
			}
		});
	}
	
	do_json_discount_goods();
});