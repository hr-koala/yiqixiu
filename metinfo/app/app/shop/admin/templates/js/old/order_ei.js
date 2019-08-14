define(function(require, exports, module) {
	//订单管理
	var $ = jQuery = require('jquery');
	var common = require('common');
	
	//订单操作弹窗
	$(document).on('click',".order-modal",function(){
		var url = $(this).attr('href');
		$('.modal-content').html('<div class="modal-body">加载中......</div>');
		$(".dynamic-modal").on("hidden.bs.modal", function() {
			$(this).removeData("bs.modal");
		});
		$('.dynamic-modal').modal({
			 remote: url
		});
		return false;
		
	});
	
	//物流操作
	$(document).on('change', "input[name='is_wuliu']",function(){
		if($(this).val() == 1){
			$("input[name='cinfo']").attr('data-required', 1);
			$("input[name='oinfo']").attr('data-required', 1);
			$('.send').show();
		}else{
			$("input[name='cinfo']").attr('data-required', '');
			$("input[name='oinfo']").attr('data-required', '');
			$('.send').hide();
		}
	});
	

	$(document).on('click', ".express",function(){
		var at = $(this);
		var str = at.attr('data-info')
		var html = '';
		$(".div_express").html("加载中......");
		if($(this).next('ul').is(':hidden')){
			if(str){
				at.parent('.dropdown').addClass('open');
				at.next().find("input").focus();
				datas = at.attr('data-info').split('|');
				url = apppath+'n=userver&c=express&a=docheck';
				$.ajax({
					url: url,
					type: "GET",
					cache: false,
					data: 'company=' + datas[0] + '&num=' +datas[1],
					dataType: "jsonp",
					success: function(data) {
						for(var i=0;i<data.length;i++){
							html = html + data[i]['context'] + data[i]['time']+"<br/>";
						}
						$(".div_express").html(html);
					}
				});	
			}else{
				alert('没有单号');
			}
		}else{
			$(this).parent('.dropdown').removeClass('open');
		}
	});
	
	function put_express_list(seach){
		$('.ui-expresslist').html('');
		var expresslist = $('.expresslist').val().split('|');
		var html = '';
		for(var i=0;i<=expresslist.length-1;i++){
			if(seach == '' || expresslist[i].indexOf(seach)>=0){
				html = html + '<li><a class="select-this-express" href="#">' +expresslist[i] + '</a></li>';
			}
		}	
		if(!html){
			html = "没有查询到结果！";
		}
		$('.ui-expresslist').html(html);
	}
	
	$(document).on('click', ".expressselect",function(){
		$('.input-expresslist').val('');
		put_express_list('');
		if($(this).next('ul').is(':hidden')){
			$(this).parent('.dropdown').addClass('open');
			$(this).next().find("input").focus();
		}else{
			$(this).parent('.dropdown').removeClass('open');
		}
	});
	
	$(document).on('click', ".select-this-express",function(){
		$('.expressselect_now').html($(this).html());
		$('.dropdown').removeClass('open');
		$("input[name='cinfo']").val($(this).html());
	});
	
	$(document).on('keyup', ".input-expresslist",function(){
		put_express_list($('.input-expresslist').val());
	});
});