define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');
	$(".ui-from").keypress(function(e) {
	  if (e.which == 13) {
		return false;
	  }
	});
	/*商品规格*/
	$('.dropdown-toggle').click(function(){
		if($(this).next('ul').is(':hidden')){
			$(this).parent('.dropdown').addClass('open');
			$(this).next().find("input").focus();
		}else{
			$(this).parent('.dropdown').removeClass('open');
		}
	});
	//增加规格
	function addstandard(value){
		if($(".standard .panel").length<3){
			var button=$('.standard .dropdown li button.btn-primary'),value = value?value:button.parent().find("input").val();
			if(value!=''){
				button.parents(".dropdown").before(
						'<div class="panel panel-default">'+
							'<div class="panel-heading" data-title="'+value+'">'+value+'<span class="close hide">×</span></div>'+
							'<div class="panel-body">'+
								'<div class="option-list"></div>'+
								'<a href="javascript:;" data-toggle="popover">+添加</a>'+
							'</div>'+
						'</div>');
				popovers();
				button.parent().find("input").val('');
				button.parents('.dropdown').removeClass('open');
			}else{
				button.parent().find("input").focus();
			}
		}
		if($(".standard .panel").length>=3){
			button.parents('.dropdown').removeClass('open').addClass('hide');
		}
	}
	$('.standard .dropdown li input').keyup(function(){
        if(event.keyCode == 13){
			addstandard();
        }
    });
	$(document).on('click','.standard .dropdown li button.btn-primary',function(){
		addstandard();
	});
	$(document).on('click','.standard .dropdown li button.btn-default',function(){
		$(this).parents('.dropdown').removeClass('open');
	});
	$(document).on('click','.existing a',function(){
		$(this).parents('.dropdown-menu').find('input').val($(this).html());
		addstandard();
	});
	//删除规格
	$(document).on('click','dd.standard .panel-heading span.close',function(){
		$(this).parents('.panel:eq(0)').remove();
		$(".standard .dropdown").removeClass('hide');
		tablesynchro();
	});
	/*规格值*/
	function popovers(){
		$('.standard a[data-toggle="popover"]').popover({
			content:function(){
		var paraku = $("textarea[name='paraku']").val(),title=$(this).parents('.panel:eq(0)').find('.panel-heading').data('title'),parakulist='';
		if(paraku!=''){
			var obj = jQuery.parseJSON(paraku);
			$.each(obj, function(i, item){
				if(i==title){
					for(var p=0;p<item.length;p++){
						if(item[p]!='')parakulist += '<li role="presentation"><a href="javascript:;">'+item[p]+'</a></li>';
					}
				}
			});
			if(parakulist!='')parakulist = '<div class="dropdown open"><ul class="dropdown-menu">'+parakulist+'</ul></div>';
		}
				return '<div class="form-inline">'+
					'<div class="form-group">'+
						'<input type="text" class="form-control">'+
					'</div>'+
					'<button type="button" class="btn btn-primary" style="margin-left:5px;">确定</button>'+
					'<button type="button" class="btn btn-default" style="margin-left:5px;">取消</button>'+
				'</div>'+parakulist;
			},
			html:true,
			placement:'bottom'
		});
	}
	popovers();
	$(document).on('click','.standard a[data-toggle="popover"]',function(){
		$(this).next().find("input").focus();
	});
	$(document).on('click','dd.standard .popover button.btn-default',function(){
		$('.standard a[data-toggle="popover"]').popover('hide');
	});
	//增加值
	function addparaoption(value,body){
		body.append('<span class="option" data-value="'+value+'">'+value+'<span class="close hide">×</span></span>');
		$('.standard a[data-toggle="popover"]').popover('hide');
		standard_option();
		tablesynchro();
		plist_ini();
	}
	$(document).on('click','dd.standard .popover button.btn-primary',function(){
		var value = $(this).parent().find("input").val(),body =$(this).parents(".panel-body:eq(0)").find(".option-list");
		if(value){
			addparaoption(value,body);
		}else{
			$(this).parent().find("input").focus();
		}
	});
	$(document).on('click','dd.standard .popover .dropdown-menu a',function(){
		var body = $(this).parents(".panel-body:eq(0)").find(".option-list");
		addparaoption($(this).html(),body);
	});
	$(document).on('keyup','dd.standard .popover-content input',function(){
        if(event.keyCode == 13){
			$(this).parent().next().click();
        }
    });
	//删除值
	$(document).on('click','dd.standard .option-list span.option span.close',function(){
		$(this).parent().remove();
		standard_option();
		tablesynchro();
		plist_ini();
	});
	
	/*商品库存*/
	function tdmore(s1,s2,s3,k){
		return '<td><input type="text" name="sku_price_'+s1+'_'+s2+'_'+s3+'" data-id="price" data-custom="valisnum($(this))" data-errortxt="请输入数字" class="form-control"></td>'+
		'<td><input type="text" name="stock_num_'+s1+'_'+s2+'_'+s3+'" data-id="stock" class="form-control" data-required="1" data-errortxt="库存不能为空"></td>'+
		'<td class="text-right"><span class="sales">'+k+'</span><input type="hidden" name="sales_'+s1+'_'+s2+'_'+s3+'" value="'+k+'" data-id="sales"></td></tr>';
	}
	function tablesynchro(){
		$('.stock dd').html(
			'<table class="table">'+
				  '<thead>'+
					'<tr>'+
					  '<th style="width:120px;">价格</th>'+
					  '<th style="width:100px;">库存</th>'+
					  '<th class="text-right">销量</th>'+
					'</tr>'+
				  '</thead>'+
				  '<tbody>'+
				  '</tbody>'+
				  '<tfoot>'+
				  '</tfoot>'+
			'</table>'
		);
		var list = $('dd.standard .panel'),
			table=$('.stock .table'),
			list1_value,list2_value,list3_value;
		if(list.length){
			$("input[name='price']").val('');
			$("input[name='stock']").val('').attr('readonly',true);
			$("dl.stock").removeClass('hide');
			list.each(function(i){
				var title = $(this).find(".panel-heading").data('title');
				if(i==0)list1_value = $(this).find('.option-list span.option');
				if(i==1)list2_value = $(this).find('.option-list span.option');
				if(i==2)list3_value = $(this).find('.option-list span.option');
				table.find("thead tr th:eq("+i+")").before('<th>'+title+'</th>');
			});
			var thlenth = table.find("thead tr th").length - 4,html='';
			//一级
			list1_value.each(function(s1){
				var vl_1 = $(this).data('value'),rowspan1,rowspan2;
				rowspan1 = list3_value&&list3_value.length?list3_value.length*list2_value.length:(list2_value&&list2_value.length?list2_value.length:1);
				rowspan2 = list3_value&&list3_value.length?list3_value.length:1;
				//二级
				if(list2_value&&list2_value.length){
					list2_value.each(function(s2){
						var vl_2 =  $(this).data('value'),qz2='';
						if(s2==0){
							qz2 = '<td rowspan="'+rowspan1+'">'+vl_1+'</td>';
						}
						//三级
						if(list3_value&&list3_value.length){
							list3_value.each(function(s3){
								var vl_3 =  $(this).data('value'),qz3='',input = '<input type="hidden" name="met_standard" value="'+vl_1+','+vl_2+','+vl_3+'">';
								if(s3==0){
									qz3 = qz2 + '<td rowspan="'+rowspan2+'">'+vl_2+'</td>';
								}
								html += '<tr>' + qz3 + '<td rowspan="1">'+vl_3+input+'</td>'+tdmore(s1,s2,s3,0);
							});
						}else{
							var input = '<input type="hidden" name="met_standard" value="'+vl_1+','+vl_2+'">';
							var qz3 = list.length>2?'<td rowspan="1"></td>':'';
							html += '<tr>' + qz2 + '<td rowspan="1">'+vl_2+input+'</td>'+qz3+tdmore(s1,s2,'',0);
						}
					});
				}else{
					var input = '<input type="hidden" name="met_standard" value="'+vl_1+'">';
					var qz2 = list.length>1?'<td rowspan="1"></td>':'';
					var qz3 = list.length>2?'<td rowspan="1"></td>':'';
					html += '<tr><td rowspan="1">'+vl_1+input+'</td>'+qz2+qz3+tdmore(s1,'','',0);
				}
			});
			var tfoot = '<tr>'+
					'<td colspan="6">'+
					'批量设置：'+
					'<a href="javascript:;" data-toggle="priceall">价格</a>'+
					'<a href="javascript:;" data-toggle="stockall" style="margin-left:5px;">库存</a>'+
					'</td>'+
					'</tr>';
			table.find("tbody").html(html);
			table.find("tfoot").html(tfoot);
			//批量设置
			$('.stock a[data-toggle="priceall"],.stock a[data-toggle="stockall"]').popover({
				content:function(){
					return '<div class="form-inline">'+
						'<div class="form-group">'+
							'<input type="text" class="form-control input-sm" style="width:80px;">'+
						'</div>'+
						'<button type="button" class="btn btn-primary btn-sm" data-type="'+$(this).data('toggle')+'" style="margin-left:5px;">确定</button>'+
						'<button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">取消</button>'+
					'</div>';
				},
				html:true,
				placement:'bottom'
			});
		}else{
			$("input[name='price']").removeAttr('readonly');
			$("input[name='stock']").removeAttr('readonly');
			$("dl.stock").addClass('hide');
		}
	}
	//价格
	function price_focusout(my,price){
		if(my.val()!=''||price){
			if(price || price=='0')
			{
				var price = price;
			}else{
				var price = parseFloat(my.val());
			}
		var input = $('input[data-id="price"]'),price;
			my.val(price.toFixed(2));
			input.each(function(){
				var v = parseFloat($(this).val());
				price = v<price?v:price;
			});
			price = price.toFixed(2);
			$('input[name="price"]').val(price);
		}	
	}
	$(document).on('focusout','input[data-id="price"]',function(){
		if($(this).val()!='')price_focusout($(this));
	});
	//库存
	function stock_focusout(val){
		var input = $('input[data-id="stock"]'),stock = 0;
		if(val||val=='0'){
			input.val(val);
			stock = input.length*val;
		}else{
			input.each(function(){
				if($(this).val()!='')stock = parseInt(stock + parseInt($(this).val()));
			});
		}
		$('input[name="stock"]').val(stock);
	}
	$(document).on('focusout','input[data-id="stock"]',function(){
		if($(this).val()!='')stock_focusout();
	});
	$(document).on('click','dl.stock tfoot button.btn-default',function(){
		$('dl.stock tfoot a[data-toggle]').popover('hide');
	});
	//批量设置
	$(document).on('click','dl.stock tfoot button.btn-primary',function(){
		var type = $(this).data('type'),val = $(this).parent().find("input").val();
		if(val!=''&&!isNaN(val)){
			if( type == 'priceall' )price_focusout($('input[data-id="price"]'),parseFloat(val));
			if( type == 'stockall' )stock_focusout(parseInt(val));
			$('dl.stock tfoot a[data-toggle]').popover('hide');
		}
	});
	/*价格*/
	function moneychange(my){
		if(my.val()!=''){
			var price = parseFloat(my.val());
				price = price.toFixed(2);
			my.val(price);
		}
	}
	$(document).on('focusout',"input[name='price'],input[name='original'],input[name='freight']",function(){
		moneychange($(this));
	});
	/*物流*/
	$(document).on('focus',"input[name='freight']",function(){
		$("input[name='freight_type'][value='2']").attr('checked',true);
	});
	$(document).on('change',"select[name='freight_mould']",function(){
		$("input[name='freight_type'][value='1']").attr('checked',true);
	});
	function refresh_freight_mould(my,type){
		my.addClass('met-laoding');
		$.ajax({
		   type: "POST",
		   url: my.attr('href'),
		   success: function(msg){
				$("select[name='freight_mould']").html(msg);
				my.removeClass('met-laoding');
				if(type)common.defaultoption(my.parent());
		   }
		});
	}
	$(document).on('click',".refresh_freight_mould",function(){
		refresh_freight_mould($(this));
		return false;
	});
	refresh_freight_mould($(".refresh_freight_mould"),1);
	/*留言*/
	var message_html = $("textarea[name='message_html']").val();
	$(".add_message").click(function(){
		$(this).before(message_html);
	});
	$(document).on('click','dd.message_list a.delete',function(){
		$(this).parents(".form-inline").remove();
	});
	function messagelist(){
		var messagelist = $("input[name='message_list']"),messagejson={};
		if(messagelist.length){
			messagelist.each(function(i){
				var name = $(this).val(),
					form=$(this).parents(".form-inline"),
					line=form.find("input[name='message_line']:checked").length?1:0,
					required=form.find("input[name='message_required']:checked").length?1:0;
				var	DateOption = { 'name':name, 'line':line, 'required':required};
				if(name!='')messagejson[i] = DateOption;
			});
			messagejson = JSON.stringify(messagejson, null, 2 );
			$("textarea[name='shop_message']").val(messagejson);
		}else{
			$("textarea[name='shop_message']").val('');
		}
	}
	/*规格*/
	function standard(){
		var paralist=$("dd.standard .panel");
		if(paralist.length){
			var parajson = {};
			paralist.each(function(i){
				var value = $(this).find('.panel-heading').data('title'),options=$(this).find(".option-list .option"),valuelist='';
				if(options.length){
					options.each(function(){
						valuelist += $(this).data('value')+',';
					});
					var	DateOption = { 'value':value, 'valuelist':valuelist};
					parajson[i] = DateOption;
				}
			});
			parajson = JSON.stringify(parajson, null, 2 );
			$("textarea[name='shop_paralist']").val(parajson);
		}else{
			$("textarea[name='shop_paralist']").val('');
		}
	}
	/*库存价格表*/
	function standard_option(){
		var lists = $("input[name='met_standard']"),json={};
		if(lists.length){
			lists.each(function(i){
				var stock = $(this).parents('tr').find('input[data-id="stock"]').val(),
					sales = $(this).parents('tr').find('input[data-id="sales"]').val(),
					price = $(this).parents('tr').find('input[data-id="price"]').val(),
					DateOption = {'valuelist':$(this).val(), 'price':price, 'stock':stock, 'sales':sales};
				json[i] = DateOption;
			});
			json = JSON.stringify(json, null, 2 );
			$("textarea[name='shop_plist']").val(json);
		}else{
			$("textarea[name='shop_plist']").val('');
		}
	}
	/*保存时处理*/
	$(document).on('submit','.ui-from',function(){
		standard();
		standard_option();
		/*留言*/
		messagelist();
	});
	
	/*规格初始化*/
	function paralist_ini(){
		var shop_paralist = $("textarea[name='shop_paralist']").val();
		if(shop_paralist!=''){
			var obj = jQuery.parseJSON(shop_paralist);
			$.each(obj, function(i, item){  
				addstandard(item.value);
				var valuelist = item.valuelist,body = $("dd.standard .panel-heading[data-title='"+item.value+"']").next().find(".option-list");
					valuelist = valuelist.split(',');
					for(var i=0;i<valuelist.length;i++){
						if(valuelist[i]!=''){
							body.append('<span class="option" data-value="'+valuelist[i]+'">'+valuelist[i]+'<span class="close hide">×</span></span>');
						}
					} 
			});
			tablesynchro();
		}
	}
	/*库存价格表初始化*/
	function plist_ini(){
		var shop_plist = $("textarea[name='shop_plist']").val();
		if(shop_plist!=''){
			var obj = jQuery.parseJSON(shop_plist);
			$.each(obj, function(i, item){
				var d = $("input[name='met_standard'][value='"+item.valuelist+"']");
				if(d.length){
					var price = d.parents('tr').find("input[data-id='price']"),
						sales = d.parents('tr').find("input[data-id='sales']"),
						salesspan = d.parents('tr').find("span.sales"),
						stock = d.parents('tr').find("input[data-id='stock']");
					var prices = parseFloat(item.price);
						prices = prices.toFixed(2);
						if(item.price!='')price.val(prices);
						sales.val(item.sales);
						salesspan.html(item.sales);
						stock.val(item.stock);
				}
			});
			if($("dl.stock .table input[data-id='price']").length){
				price_focusout($('input[data-id="price"]:eq(0)'));
				stock_focusout();
			}
		}
	}
	/*留言初始化*/
	function message_ini(){
		var shop_message = $("textarea[name='shop_message']").val();
		if(shop_message!=''){
			var obj = jQuery.parseJSON(shop_message);
			$.each(obj, function(i, item){
				if(item.name!=''){
					$(".add_message").before(message_html);
					var d = $(".add_message").prev(),
						message = d.find("input[name='message_list']"),
						message_line=d.find("input[name='message_line']"),
						message_required=d.find("input[name='message_required']");
						message.val(item.name);
						if(item.line==1)message_line.attr('checked',true);
						if(item.required==1)message_required.attr('checked',true);
				}
			});
		}
	}
	
	paralist_ini();
	plist_ini();
	message_ini();
	
});