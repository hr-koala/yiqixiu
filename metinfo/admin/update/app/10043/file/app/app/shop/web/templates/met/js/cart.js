$(document).ready(function() {
	var result = window.matchMedia("(min-width: 768px)");
	sizeChange(result);
	result.addListener(sizeChange);
	//result.removeListener(sizeChange);
	//勾选
	$(document).on('change',".selectable-item,.selectable-all",function(){
		ajax_total_cart('','','cache');
	})
	//输入数量
	$(document).on('focusout',"[data-plugin='touchSpin']",function(){
		touchchange($(this));
	})
	//数量调整
	$(document).on('touchspin.on.stopspin',"[data-plugin='touchSpin']",function(){
		touchchange($(this));
	})
	//删除
	$(document).on('click',".cart-remove",function(e){
		e.preventDefault();
		var dom = $(this);
		alertify.theme('bootstrap').okBtn(lang_ok).cancelBtn(lang_cancel).confirm(lang_deleteok, function (ev) {
			ev.preventDefault();
			$.ajax({
				url: dom.attr('href'),
				type: 'POST',
				dataType:'json',
				success: function(data) {
					if(data.error){
						alertify.error(data.error);
					}else if(data.success){
						alertify.success(data.success);
						var tr = dom.parents('.cart-list'),rel = false;
						if(result.matches){
							tr = dom.parents('tr');
							if(tr.parent().find('tr').length==1)rel = true;
						}else{
							if(tr.parent().find('.cart-list').length==1)rel = true;
						}
						tr.remove();
						if(rel){
							location.reload();
						}else{
							ajax_total_cart();
						}
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	})
	//去结算
	$(document).on('click',".cart-tocheck",function(e){
		if(!$(this).attr('disabled')){
			var data = '&cidlist=';
			$("input[name='cartitem']").each(function(){
				if(!$(this).attr('disabled')&&$(this).prop("checked")){
					data+= $(this).val()+'-';
				}
			});
			window.location = $(this).data('url')+data;
		}
	})
})
//不同设备处理
function sizeChange(result) {
	if (result.matches) {
		pclaodcart(result);
	}else{
		mobilelaodcart(result);
	}
}
//数量调整处理
function touchchange(dom){
	var item = dom.parents('tr').find('.selectable-item');
	if(!item.attr('disabled'))item.prop('checked',true);
	ajax_total_cart(dom.data('id'), dom.val());
}
//平板&电脑加载数据
function pclaodcart(result){
	laodcartjson(function(json){
		var html = '<div class="table-responsive">'+
						'<table class="table table-hover table-striped">'+
							'<thead>'+
								'<tr>'+
									'<th class="text-center width-100">'+
										'<div class="checkbox-custom checkbox-danger">'+
											'<input type="checkbox" class="selectable-all" checked>'+
											'<label></label>'+
										'</div>'+
									'</th>'+
									'<th class="width-300">'+lang_commodity+'</th>'+
									'<th class="text-center">'+lang_price+'</th>'+
									'<th class="text-center width-150">'+lang_number+'</th>'+
									'<th class="text-center">'+lang_subtotal+'</th>'+
									'<th class="text-center width-100">'+lang_operation+'</th>'+
								'</tr>'+
							'</thead><tbody>',list='',shopmax;
		$.each(json, function(i, item){
			item.shopmax = item.purchase>0?item.purchase:item.stock;
			list += '<tr>'+
						'<td>'+cart_check(item.id,item.buy_ok)+'</td>'+
						'<td>'+'<div class="media">'+
							'<div class="media-left">'+
								'<a class="avatar text-middle" target="_blank" href="'+item.url+'">'+
									'<img class="img-responsive" src="'+item.img+'" alt="">'+
								'</a>'+
							'</div>'+
							'<div class="media-body">'+
								'<h4 class="media-heading font-weight-unset">'+
									'<a target="_blank" href="'+item.url+'">'+
										item.name+
									'</a>'+
								'</h4>'+
								'<p>'+item.para_str+'</p>'+
							'</div>'+
						'</div>'+'</td>'+
						'<td class="text-center">'+item.price_str+'</td>'+
						'<td>'+'<div class="buynum">'+
							'<input type="text" class="form-control input-sm text-center buynum-input" data-min="1" data-max="'+item.shopmax+'" data-plugin="touchSpin" data-id="'+item.id+'" name="buynum" autocomplete="off" value="'+item.amount+'">'+
						'</div>'+'</td>'+
						'<td class="text-center"><span class="red-600 subtotal" data-id="'+item.id+'">'+item.subtotal+'</span></td>'+
						'<td class="text-center"><a href="'+delurl+'&id='+item.id+'" class="cart-remove"><i class="icon wb-trash" aria-hidden="true"></i></a></td>'+
					'</tr>';
		})
		html+=list+'</tbody></table>'+'</div>';
		cart_renderer(html,result);
	})
}
//价格计算
function ajax_total_cart(id, amount,cache){
	if(cache=='cache'){
		total_cart(cartdata);
	}else{
		$.ajax({
			url: totalurl,
			type: "GET",
			data: '&id='+id+'&amount='+amount,
			cache: false,
			dataType: "jsonp",
			success: function(data) {
				if(data.message == 'ok'){
					window.cartdata = data.price;
					total_cart(data.price);
				}else{
					alertify.error(lang_errorrefresh);
				}
			}
		});
	}
}
//刷新价格数据
function total_cart(data){
	var total = 0,i=0;
	$('.cart-tocheck').attr('disabled','disabled');
	$('.subtotal').each(function(){
		var id = $(this).data('id');
		$(this).html(data.goods[id].subtotal);
		var check = $("input[value='"+id+"']:checked");
		if(check.length){
			total+=parseFloat(data.goods[id].price*data.goods[id].amount);
			i=i*1+data.goods[id].amount*1;
		}
	});
	if(total>0){
		$('.cart-tocheck').removeAttr('disabled');
	}
	$('.cart-goodnum').html(i);
	$('.total-val').html(price_prefix+total.toFixed(2)+price_suffix);
	$('.cart-loader').remove();
	$('.cart-total-body,.cart-list-body').removeClass('hide');
}
//数据获取完成后渲染器
function cart_renderer(html,result){
	$(".cart-list-body").html('').html(html);
	ajax_total_cart();
	$('[data-plugin="touchSpin"]').TouchSpin();
	$('[data-plugin="selectable"], [data-selectable="selectable"]').asSelectable();
}
//公共字符处理
function cart_check(id,buy_ok){
	var check = buy_ok==0?'disabled':'checked',txt = buy_ok==0?lang_oos:'';
	return '<div class="checkbox-custom checkbox-danger">'+
				'<input type="checkbox" class="selectable-item" name="cartitem" value="'+id+'" '+check+'>'+
				'<label>'+txt+'</label>'+
			'</div>';
}
//手机加载数据
function mobilelaodcart(result){
	laodcartjson(function(json){
		var html = '',shopmax;
		$.each(json, function(i, item){
			item.shopmax = item.purchase>0?item.purchase:item.stock;
			html += '<div class="row cart-list">'+
						'<div class="col-xs-2">'+
							cart_check(item.id,item.buy_ok)+
						'</div>'+
						'<div class="col-xs-7">'+
							'<div class="media">'+
								'<div class="media-left">'+
									'<a class="avatar text-middle" target="_blank" href="'+item.url+'">'+
										'<img class="img-responsive" src="'+item.img+'" alt="">'+
									'</a>'+
								'</div>'+
								'<div class="media-body">'+
									'<h4 class="media-heading font-weight-unset">'+
										'<a target="_blank" href="'+item.url+'">'+
											item.name+
										'</a>'+
									'</h4>'+
									'<p>'+item.para_str+'</p>'+
									'<div class="buynum">'+
										'<input type="text" class="form-control input-sm text-center buynum-input" data-min="1" data-max="'+item.shopmax+'" data-plugin="touchSpin" data-id="'+item.id+'" name="buynum" autocomplete="off" value="'+item.amount+'">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="col-xs-3 text-right">'+
							'<p class="red-600 subtotal" data-id="'+item.id+'">'+item.subtotal+'</p>'+
							'<a href="'+delurl+'&id='+item.id+'" class="cart-remove"><i class="icon wb-trash" aria-hidden="true"></i></a>'+
						'</div>'+
					'</div>';
		})
		cart_renderer(html,result);
	})
}