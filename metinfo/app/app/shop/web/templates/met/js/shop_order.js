$(document).ready(function() {
	order_list();
	$(document).on('click',"#shop-order-more",function(){
		order_list();
	})
	$(document).on('click',".shop-order-search a",function(){
		$('input[name="keyword"]').val('');
		order_list(1);
	})
	$(document).on('click','.shop-order-keyword button[type="submit"]',function(){
		order_list(1);
	})
});

function order_list(search){
	var btn = $('#shop-order-more');
	if(search){
		$('.shop-order-more-body').html('');
		window.page = null;
	}
	$('.shop-order-more-body').append('<div class="height-100 vertical-align text-center order-loader"><div class="loader vertical-align-middle loader-default"></div></div>');
	btn.attr('disabled','disabled');
	order_json(function(json){
		if(json.success==1){
			var html = window.page>1?'<hr>':'';
			$.each(json.order, function(i, item){
				html += '<div class="shop-order-list state-'+item.state+'">'+
							'<div class="row shop-order-top">'+
								'<div class="col-md-8 col-sm-8 ting">'+
									'<h4>'+item.state_txt+'</h4>'+
									'<span class="info">'+item.rtime_str+'</span>'+
									'<span class="info">'+lang_ordernumber+' : '+item.orderid+'</span>'+
									'<span class="info">'+item.paytype_str+'</span>'+
								'</div>'+
								'<div class="col-md-4 col-sm-4 ting text-right">'+
									lang_orderamount+' ：<span class="price grey-800">'+item.tprice_str+'</span>'+
								'</div>'+
							'</div>'+
							'<div class="row shop-order-bottom">'+
								'<div class="col-md-6 col-sm-6">';
								if(item.goods_list){
									$.each(item.goods_list, function(k, val){
										html += '<div class="media media-xs margin-top-5">'+
													'<div class="media-left">'+
														'<a href="'+val.url+'" target="_blank">'+
															'<img class="media-object" src="'+val.img+'" alt="'+val.pname+'">'+
														'</a>'+
													'</div>'+
													'<div class="media-body">'+
														'<h4 class="media-heading"><a href="'+val.url+'" target="_blank">'+val.pname+' '+val.para+'</a></h4>'+
														'<p>'+val.puprice_str+' x '+val.pamount+'</p>'+
													'</div>'+
												'</div>';
									})
								}
						html += '</div>'+
								'<div class="col-md-6 col-sm-6 text-right btn-box">';
						if(item.state==1){
									html += '<p><a href="'+shop_pay_payorder+'&id='+item.id+'" target="_blank" class="btn btn-danger btn-squared">'+lang_topaynow+'</a></p>';
						}
									html += '<p class="margin-bottom-0"><a href="'+item.docheck_url+'" class="btn btn-outline btn-default btn-squared">'+lang_orderdetails+'</a></p>'+
								'</div>'+
							'</div>'+
						'</div>';
			});
			$('.shop-order-more-body .order-loader').remove();
			$('.shop-order-more-body').append(html);
			btn.removeAttr('disabled');
			window.page = parseInt(json.page) + 1;
			if(json.endnum<=json.page){
				$('#shop-order-more').addClass('hide');
			}else{
				$('#shop-order-more').removeClass('hide');
			}
		}else{
			$('.shop-order-more-body .order-loader').remove();
			$('.shop-order-more-body').html('<div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18">'+lang_noorders+'</div></div>');
			$('#shop-order-more').addClass('hide');
		}
	});
}
function order_json(func){
	var search = '&state='+$('.shop-order-search li.active a').data('state');
	if($('input[name="keyword"]').val()!='')search+='&keyword='+$('input[name="keyword"]').val();
	if(window.page>1)search+='&page='+window.page;
	$.ajax({
		url: order_json_url,
		data: search,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}