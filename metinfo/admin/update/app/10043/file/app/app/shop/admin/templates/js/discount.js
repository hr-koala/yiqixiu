$(document).ready(function() {

	if($('.discount_editor').length>0){
		//编辑页面验证
	
		$('.discount_editor_table').formValidation({
			locale:'zh_CN',
			framework: "bootstrap"
		})
		.on('success.form.fv', function(e, data) {
			//$(".discount_editor_table").submit();
		});
	
		$('[data-plugin="clockpicker"]').each(function(){
			$(this).clockpicker({
				placement: 'bottom',
				align: 'left',
				autoclose: true,
				'default': 'now'
			});
		});

		$('[data-plugin="datepicker"]').each(function(){
			$(this).datepicker({
				'format': 'yyyy-mm-dd',
				'autoclose': true
			});
		});
		
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
			$('#'+select).html("<a class=\"noselect_p\" data-id=\""+id+"\" href=\"javascript:void(0)\">已选取</a>");
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
			var url = $('.discount_editor').attr('data-do_json_discount_goods-url') +'a=do_json_discount_goods&idlist='+$("input[name='goods_list']").val();
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
	}
	

	//数据筛选
	$(document).on('change keyup',"input[data-table-search]",function(){
		table.ajax.reload();
		//$.slidePanel.hide();
	})
	
	//优惠劵状态查询
	$(document).on('click', '#orderstateseach a', function(e) {
		$("input[data-table-search]").val('');
		$("input[name='state']").val($(this).data('state'));
		table.ajax.reload();
		//$.slidePanel.hide();
	});
	
	//表格选择
	$('[data-plugin="selectable"], [data-selectable="selectable"]').each(function() {
      var options = $.extend({}, {rowActiveClass: 'active1'}, $(this).data());
      $(this).asSelectable(options);
    });
	
	//删除
	//删除
	$(document).on('click',"#del",function(e){
		e.preventDefault();
		var dom = $(this).closest('table'),allid = '';
		$("input[name='id']", dom).each(function(){
			if($(this).val() && $(this).is(':checked')){
				allid += $(this).val() + ',';
			}
		});

		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要删除吗?", function (ev) {
			ev.preventDefault();
			$.ajax({
				url: dom.attr('data-table-delurl')+"&allid="+allid,
				type: 'GET',
				dataType:'json',
				success: function(data) {
					if(data.error){
						alertify.error(data.error);
					}else if(data.success){
						table.ajax.reload();
						alertify.success(data.success);
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	})
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
			//order_edit(options);
			$('[data-plugin="clockpicker"]').each(function(){
			//alert(123);
				$(this).clockpicker({
					placement: 'bottom',
					align: 'left',
					autoclose: true,
					'default': 'now'
				});
			});
		
			$('[data-plugin="datepicker"]').each(function(){
				$(this).datepicker({
					'format': 'yyyy-mm-dd',
					'autoclose': true
				});
			});
			


		},
		afterShow: function() {
          var self = this;
          $(document).on('click.slidePanelShow', function(e) {
            if ($(e.target).closest('.slidePanel').length === 0 && $(e.target).closest('body').length === 1) {
              self.hide();
            }
          });			
        }
	});
	
/*新增优惠劵面板*/	
	$(document).on('click', '.add-discount', function(e) {
		var url = $(this).attr("data-url");
		loadPanel(options,url);
		return false;
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
			loadPanel(options,url);
		}
	});



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
				value = value.replace(/\s+/g,"");
				value = value.substr(1);
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
			$("select[name='cinfo']").removeAttr('disabled');
			$("input[name='oinfo']").removeAttr('disabled');
		}else{
			$("select[name='cinfo']").attr('disabled','disabled');
			$("#danhao").attr('disabled','disabled');
			$("#edit_send_submit").removeAttr("disabled").removeClass("disabled");
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