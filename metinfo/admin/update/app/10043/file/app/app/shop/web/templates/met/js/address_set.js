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
		locale:'zh_CN',
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

	$(document).on('mouseover mouseout',".addr-list",function(){
		$(this).toggleClass('hover');
	})
	$(document).on('click',".addr-set-del",function(){
		var dom = $(this);
		alertify.theme('bootstrap').okBtn(lang_ok).cancelBtn(lang_cancel).confirm(lang_deleteok, function (ev) {
			ev.preventDefault();
			$.ajax({
				url: dom.data('url'),
				type: 'POST',
				dataType:'json',
				success: function(data) {
					if(data.error){
						alertify.error(data.error);
					}else if(data.success){
						alertify.success(data.success);
						refresh_addr();
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	})
})
/*刷新收货地址*/
function refresh_addr(){
	laod_addr_json(function(json){
		var html = '',deok,body = $(".addr-body");
		$.each(json, function(i, item){
			html += '<div class="col-md-4 col-sm-6 addr-list-box margin-top-15">'+
						'<a class="list-group-item addr-list" href="javascript:void(0)" '+
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
								'<button type="button" class="btn btn-outline btn-default addr-set-del" data-url="'+addrdelurl+'&id='+item.id+'"><i class="icon wb-trash" aria-hidden="true"></i></button>'+
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
		}
	});
}