var validlang = lang=='cn'?'zh_CN':'';
$(document).ready(function() {
	//选择器
	$("[data-plugin='labelauty']").labelauty();
	if(!$('.addr-body').length)ajax_total();
	
	$('.pay-form').formValidation({
		locale:validlang,
		framework: "bootstrap",
		icon: {
            valid: 'icon wb-check',
            invalid: 'icon wb-close',
            validating: 'icon wb-loop'
        }
	})
	.on('success.form.fv', function(e, data) {
		e.preventDefault();
		if($("#addressid").val()==''||$("#addressid").val()==0){
			alertify.error(lang_pleaseaddress);
			$('.pay-form').data('formValidation').resetForm();
			refresh_addr();
		}else{
			var $form    = $(e.target),
				formData = new FormData(),
				params   = $form.serializeArray();
			$.each(params, function(i, val) {
				formData.append(val.name, val.value);
			});
			$.ajax({
				url: $form.attr('action'),
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				dataType:'json',
				success: function(result) {
					if(result.error){
						alertify.error(result.error);
						$('.pay-form').data('formValidation').resetForm();
					}else if(result.success){
						window.location.href = result.success;
					}
				}
			});
		}
	});
	//是否开票
	$(document).on('change',"input[name='invoice_is']",function(){
		if($(this).val()==1){
			$('#invoice-body').collapse('show');
		}else{
			$('#invoice-body').collapse('hide');
			$(this).attr("data-fv-notempty",false);
			$(".disabled").removeAttr("disabled").removeClass("disabled");
		}
	})
	//选中收货地址
	$(document).on('click',".addr-list",function(){
		addressid($(this));
	})
});
//选中订单收货地址
function addressid(dom){
	if(!dom){
		dom = $('.addr-body .hover');
	}
	$("#addressid").val(dom.data('id'));
	$('.addr-body .addr-list').removeClass('hover');
	dom.addClass('hover');
	ajax_total();
}
/*计算总价格*/
function ajax_total(){
	var cidlist = $("input[name='cidlist']").val(),
		addressid = $("input[name='addressid']").val(),
		invoice_is = $("input[name='invoice_is']").val(),
		url = totalurl+'&cidlist='+cidlist+'&addressid='+addressid+'&invoice_is='+invoice_is;
	$.ajax({
		url: url,
		type: 'POST',
		dataType:'json',
		cache: false,
		success: function(data) {
			var freight = data.freight==0?lang_freefreight:data.freight_str;
			$("#pay-freight").html(freight);
			$("#pay-amount").html(data.amount);
			$("#pay-total").html(data.tprice_str);
		}
	});
}
/*收货地址*/
$(document).ready(function() {
	if($('.addr-body').length)refresh_addr();
	//编辑
	$(document).on('click',".addr-set-edit",function(){
		addr_modal('show',$(this).parents('a.addr-list'));
	})
	//添加地址按钮
	$(document).on('click',".addr-btn",function(){
		addr_modal('show');
	})
	//保存收货地址
	$('.addr-edit-form').formValidation({
		locale:validlang,
		framework: "bootstrap"
	})
	.on('success.form.fv', function(e, data) {
		e.preventDefault();
		var $form    = $(e.target),
			formData = new FormData(),
			params   = $form.serializeArray();
		$.each(params, function(i, val) {
			formData.append(val.name, val.value);
		});
		var id = $form.find('input[name="id"]').val();
		$.ajax({
			url: $form.attr('action'),
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType:'json',
			success: function(result) {
				if(result.error){
					alertify.error(result.error);
				}else if(result.success){
					alertify.success(result.success);
					addr_modal('hide');
					refresh_addr(id);
				}
			}
		});
	});
})

/*刷新收货地址*/
function refresh_addr(id){
	laod_addr_json(function(json){
		var html = '',deok,body = $(".addr-body");
		$.each(json, function(i, item){
			deok = item.de==1&&!id?'hover':'';
			if(id&&id==item.id)deok = 'hover';
			html += '<div class="col-md-3 col-sm-6 addr-list-box margin-top-15">'+
						'<a class="list-group-item addr-list '+deok+'" href="javascript:void(0)" '+
							'data-id="'+item.id+'" '+
							'data-name="'+item.name+'" '+
							'data-tel="'+item.tel+'" '+
							'data-zone_p="'+item.zone_p+'" '+
							'data-zone_c="'+item.zone_c+'" '+
							'data-zone_d="'+item.zone_d+'" '+
							'data-zone_a="'+item.zone_a+'" '+
							'>'+
							'<div class="addr-set btn-group btn-group-xs" >'+
								'<button type="button" class="btn btn-outline btn-default addr-set-edit"><i class="icon wb-edit" aria-hidden="true"></i></button>'+
							'</div>'+
							'<h4 class="list-group-item-heading">'+
								item.name+
							'</h4>'+
							'<p class="list-group-item-text margin-bottom-5 addr-info">'+
								item.tel+
							'</p>'+
							'<p class="list-group-item-text addr-info">'+
								item.zone_p+' '+item.zone_c+' '+item.zone_d+' '+item.zone_a+
							'</p>'+
						'</a>'+
					'</div>';
		})
		body.html('');
		if(html==''){
			addr_modal('show');
		}else{
			body.html(html);
			addressid();
		}
	});
}