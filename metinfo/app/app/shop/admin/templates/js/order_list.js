$(document).ready(function() {
	
/*面板初始化*/
	var defaults = $.components.getDefaults("slidePanel");
	var options = $.extend({}, defaults, {
		template: function(options) {
			return '<div class="' + options.classes.base + ' ' + options.classes.base + '-' + options.direction + '">' +
			'<div class="' + options.classes.base + '-scrollable"><div>' +
			'<div class="' + options.classes.content + '"></div>' +
			'</div></div>' +
			'<div class="' + options.classes.base + '-handler"></div>' +
			'</div>';
		},
		afterLoad: function() {//加载完成执行
			//滚轴
			this.$panel.find('.' + this.options.classes.base + '-scrollable').asScrollable({
				namespace: 'scrollable',
				contentSelector: '>',
				containerSelector: '>'
			});
			//订单编辑事件
			order_edit(options);
		}
	});

/*订单列表页*/
	//去除 tabindex
	$(document).on( 'init.dt', function (e, settings, json) {
		$("table.table tbody tr td").removeAttr('tabindex');
		var api = new $.fn.dataTable.Api( settings );
		api.on( 'draw.dt', function ( e, settings, json ) { 
			$("table.table tbody tr td").removeAttr('tabindex');
		} );
	});
	//表格列表点击展开面板
	$(document).on('click', 'table.table tbody tr', function(e) {
		if($(this).find(".slidepanel_box").length){
			var url = $(this).find(".slidepanel_box").data("url");
			$("table.table tbody tr").removeClass('activenow');
			$(this).addClass('activenow');
			loadPanel(options,url);
		}
	});
	//订单状态查询
	$(document).on('click', '#orderstateseach a', function(e) {
		$("input[name='state']").val($(this).data('state'));
		table.ajax.reload();
		$.slidePanel.hide();
	});
	//数据筛选
	$(document).on('change keyup',"input[data-table-search]",function(){
		table.ajax.reload();
		$.slidePanel.hide();
	})

/*订单详情页*/
	//备注
	$(document).on('click', '#edit_remark_btn', function(e) {
		e.stopPropagation();
		e.preventDefault();
		$('#edit_remark').editable('toggle');
	});
	//改价
	$(document).on('click', '#edit_price_btn', function(e) {
		e.stopPropagation();
		e.preventDefault();
		$('#edit_price').editable('toggle');
	});
	//关闭订单
	$(document).on('click', '#edit_close_btn', function(e) {
		var url = $(this).data('url');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要关闭订单?", function (ev) {
			ev.preventDefault();
			$.post(url, function(result){ 
				ajax_success(result,options);
			},'json');
		}, function(ev) {
			ev.preventDefault();
		});
	});
	//订单完成
	$(document).on('click', '#complete_btn', function(e) {
		var url = $(this).data('url');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要将该订单设置为已完成?", function (ev) {
			ev.preventDefault();
			$.post(url, function(result){ 
				ajax_success(result,options);
			},'json');
		}, function(ev) {
			ev.preventDefault();
		});
	});
	//是否需要物流
	$(document).on('change', 'input[name="is_wuliu"]', function(e) {
		wuliu($(this).val());
	});
	function order_edit(options){
		//备注
		var remark = $('#edit_remark');
		remark.editable({
			url: remark.data('url'),
			type: 'textarea',
			pk: 1,
			name: 'remark',
			emptytext:'',
			mode:'inline',
			ajaxOptions: {
				dataType: 'json' 
			}, 
			success: function(result, newValue) {
				alertify.success(result.success);
				//table.row().draw(false);
			}
		});
		//改价
		if($('#edit_price_btn').length){
			var price = $('#edit_price'),
				value = $('#edit_price').html();
				value_1 = value.replace("-","");
				value_1 = value_1.substr(0, 1);
				if(isNaN(value_1)){
					value = value.replace(/\s+/g,"");
					value = value.substr(1);
				}else{
					value = parseFloat(value);
				}
			price.editable({
				url: price.data('url'),
				type: 'text',
				pk: 1,
				name: 'cprice',
				title: '正数为涨价/负数为减免',
				emptytext:'',
				value:value,
				ajaxOptions: {
					dataType: 'json' 
				}, 
				success: function(result, newValue) {
					ajax_success(result,options);
				}
			});
		}
		//发货
		if($("#edit_send").length){
			$('[data-plugin="select2"]').select2({width: "style"});
			wuliu($('input[name="is_wuliu"]:checked').val());
			$('#edit_send').formValidation({
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
							$("#edit_send_submit").removeAttr("disabled").removeClass("disabled");
						}else if(result.success){
							ajax_success(result,options);
						}
					}
				});
			});
		}
	}
	//处理成功刷新表格和面板
	function ajax_success(result,options){
		alertify.success(result.success);
		loadPanel(options);
		table.row().draw(false);
	}
	//是否需要物流
	function wuliu(val){
		if(val==1){
			$('#send-info-body').collapse('show');
		}else{
			$('#send-info-body').collapse('hide');
			$('#edit_send_submit').removeAttr('disabled');
			$('#edit_send_submit').removeClass('disabled');
		}
	}
});
//加载面板
function loadPanel(options,url){
	var url = url?url:$(".metshop_oder_page_btn").data('gourl');
	$.slidePanel.show({
		url: url,
		settings: {
			cache: false
		}
	}, options);
}