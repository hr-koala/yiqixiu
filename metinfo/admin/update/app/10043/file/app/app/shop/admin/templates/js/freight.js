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
			//编辑事件
			freight_edit(options);
		}
	});
	
	//新增运费模板
	$(document).on('click', '#freight_id', function(e) {
		loadPanel(options,own_form + 'a=docheck');
	});
	
	//编辑
	$(document).on('click', 'a.freight-edit', function(e) {
		e.preventDefault();
		loadPanel(options,own_form + 'a=docheck&id='+$(this).data('id'));
	});
	
	//删除
	$(document).on('click', 'a.freight-del', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要删除运费模板?", function (ev) {
			ev.preventDefault();
			$.ajax({
				url: own_form + 'a=dodel&id='+id,
				type: 'POST',
				dataType:'json',
				success: function(result) {
					if(result.error){
						alertify.error(result.error);
					}else if(result.success){
						alertify.success(result.success);
						show_freight_list();
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	});
	
	//展开列表
	$(document).on('show.bs.collapse', '.freight_list .collapse', function(e) {
		var collapse = $(e.target),id = collapse.data('id');
		if(!collapse.data('zone')){
			collapse.find("tbody").html('<div class="loader loader-default"></div>');
			load_zone_list(id,function(json){
				var html = '';
				$.each(json, function(i, item){ 
					html += regionhtml(item.zone,item.first,item.freight,item.addp,item.renew);
				}); 
				collapse.find("tbody").html('').append(html);
				collapse.attr("data-zone","true");
			});
		}
	});
	
	show_freight_list();
	
});

/*配送区域增删改查*/
$(document).ready(function() {
	//新增
	$(document).on('click', '#newquyuselect', function(e) {
		addselectoption();
	});
	//全选
	$(document).on('click', '#selectall', function(e) {
		$('#multiselect_zone').multiSelect('select_all');
	});
	//清除
	$(document).on('click', '#deselectall', function(e) {
		$('#multiselect_zone').multiSelect('deselect_all');
	});
	//保存
	$('#quyuselect-form').formValidation({
		locale:'zh_CN',
		framework: "bootstrap"
	}).on('success.form.fv', function(e, data) {
		e.preventDefault();
		var zone = $('#multiselect_zone').val();
		if(zone!=''&&zone!=null){
			if($('input[name="zoneid"]').val()!=''){
				var put = $("#editor_region tbody td input[data-id='"+$('input[name="zoneid"]').val()+"']");
					put.val(zone);
					put.prev('span').html(''+zone+'');
			}else{
				addregion(zone,1,0,1,0);
			}
			$("#quyuselect").modal('hide');
		}
	});
	//选择器
	$('[data-plugin="multiSelect"]').multiSelect({
		selectableHeader:'<p>可选择</p>',
		selectionHeader:'<p>已选择</p>',
		selectableFooter:'<a href="javascript:void(0)" class="btn btn-squared btn-block btn-primary" id="selectall">全选</a>',
		selectionFooter:'<a href="javascript:void(0)" class="btn btn-squared btn-block btn-primary" id="deselectall">清除</a>'
	});
	//编辑
	$(document).on('click', '#editor_region .region-edit', function(e) {
		var put= $(this).parents('td').find('input.zoneinput'),
			id = put.data('id'),
			op = put.val();
		$("#quyuselect").modal('show');
		addselectoption(id,op);
	});
	//删除
	$(document).on('click', '#editor_region .region-del', function(e) {
		var tr = $(this).parents('tr');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要删除?", function (ev) {
			ev.preventDefault();
			tr.remove();
		}, function(ev) {
			ev.preventDefault();
		});
	});
});
//新增区域
function addregion(zone,first,freight,addp,renew){
	if(typeof(regionnum) == "undefined")window.regionnum = 0;
	var zone = edit_zone(zone),
		first = edit_first(first),
		freight = edit_freight(freight),
		addp = edit_addp(addp),
		renew = edit_renew(renew);
		$("#editor_region tbody").append(regionhtml(zone,first,freight,addp,renew));
		regionnum ++ ;
}
//可编辑的
function edit_zone(zone){
	return '<div class="pull-right"><a href="javascript:void(0)" class="icon wb-edit region-edit margin-left-10"></a>'+'<a href="javascript:void(0)" class="icon wb-close region-del margin-left-10"></a></div>'+'<span>'+zone+'</span><input type="hidden" name="zone[]" data-id="'+regionnum+'" class="form-control zoneinput" value="'+zone+'">';
}
function edit_first(first){
	return '<input type="text" name="first[]" class="form-control" value="'+first+'">';
}
function edit_freight(freight){
	return '<input type="text" name="freight[]" class="form-control" value="'+freight+'">';
}
function edit_addp(addp){
	return '<input type="text" name="addp[]" class="form-control" value="'+addp+'">';
}
function edit_renew(renew){
	return '<input type="text" name="renew[]" class="form-control" value="'+renew+'">';
}
//获取区域选项
function addselectoption(id,op){
	var st = $('#multiselect_zone');
	st.find('option').remove();
	var zone = {"中国":["北京","天津","河北","山西","内蒙古","辽宁","吉林","黑龙江","上海","江苏","浙江","安徽","福建","江西","山东","河南","湖北","湖南","广东","广西","海南","重庆","四川","贵州","云南","西藏","陕西","甘肃","青海","宁夏","新疆","台湾省","香港","澳门"]};
	var nozone = '';
		$("#editor_region tbody input.zoneinput").each(function(){
			if($(this).data('id')!=id)nozone+=nozone==''?$(this).val():','+$(this).val();
		});
		if(nozone!='')nozone = nozone.split(',');
	var html = '';
	$.each(zone, function(i, item){
		html+='<optgroup label="'+i+'">';
		$.each(item, function(p, m){
			var mok = true;
			if(nozone.length>0){
				for (var l = 0; l < nozone.length; l++) {
					if (nozone[l]==m) {
						mok = false;
					}
				}
			}
			if(mok)html+='<option value="'+m+'">'+m+'</option>';
		})
        html+='</optgroup>';
	});
	st.html(html);
	if(html.indexOf('option')==-1){
		alertify.error('已无可选区域');
		$("#quyuselect").modal('hide');
	}else{
		st.multiSelect('refresh');
		$("#quyuselect-form input[name='zoneid']").val('');
		if(op){
			$("#quyuselect-form input[name='zoneid']").val(id);
			op = op.split(',');
			st.multiSelect('select', op);
		}
	}
}
//区域html
function regionhtml(zone,first,freight,addp,renew){
	return '<tr>'+
	'<td>'+zone+'</td>'+
	'<td>'+first+'</td>'+
	'<td>'+freight+'</td>'+
	'<td>'+addp+'</td>'+
	'<td>'+renew+'</td>'+'</tr>';
}



/*编辑页*/
function freight_edit(options){
	//载入区域列表
	var id = $("#zone_from input[name='id']").val();
	if(id!=''){
		$("#editor_region tbody").html('<div class="loader loader-default"></div>');
		load_zone_list(id,function(json){
			$("#editor_region tbody").html('');
			$.each(json, function(i, item){ 
				addregion(item.zone,item.first,item.freight,item.addp,item.renew);
			}); 
		});
	}
	//保存运费模板
	$('#zone_from').formValidation({
		locale:'zh_CN',
		framework: "bootstrap"
	}).on('success.form.fv', function(e, data) {
		e.preventDefault();
		if($("input[name='zone[]']").length){
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
					}else if(result.success){
						alertify.success(result.success);
						show_freight_list();
						$.slidePanel.hide();
					}
				}
			});
		}else{
			alertify.error('请设置配送区域');
			$(".editor_btn").removeAttr("disabled").removeClass("disabled");
		}
	});
}

/*共用方法*/
//加载面板
function loadPanel(options,url){
	var url = url;
	$.slidePanel.show({
		url: url,
		settings: {
			cache: false
		}
	}, options);
}

//刷新运费列表
function show_freight_list(){
	$(".freight_list").html('<div class="loader loader-default"></div>');
	load_freight_list(function(json){
			var html = '';
			$.each(json, function(i, item){ 
				html += '<li class="list-group-item">'+
							'<div class="freight-action">'+
								'<a class="icon wb-edit freight-edit" data-id="'+item.id+'"></a>'+
								'<a class="icon wb-close freight-del" data-id="'+item.id+'"></a>'+
							'</div>'+
							'<h3 class="list-title bg-blue-grey-100" data-toggle="collapse" onselectstart="return false;" style="-moz-user-select:none;" data-target="#freight_'+item.id+'">'+
							item.name+
							'</h3>'+
							'<div class="collapse" id="freight_'+item.id+'" data-id="'+item.id+'">'+
								'<div class="well">'+
									'<div class="table-responsive">'+
										'<table class="table">'+
											'<thead><tr>'+
											'<th>可配送区域</th><th>首件（个）</th><th>运费</th><th>续件（个）</th><th>续费</th>'+
											'</tr></thead>'+
											'<tbody></tbody>'+
										'</table>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</li>';
			}); 
			$(".freight_list").html(html);
	});
}

//运费数据
function load_freight_list(func){
	$.ajax({
		url: own_form + 'a=dojson_freight_list',
		cache: false,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}

//规则数据
function load_zone_list(id,func){
	$.ajax({
		url: own_form + 'a=dojson_zone_list&id='+id,
		cache: false,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}