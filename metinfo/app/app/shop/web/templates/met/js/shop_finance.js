var json = '';
if(lang=='cn'){
	json = {
		"sProcessing":   "处理中...",
		"sLengthMenu":   "显示 _MENU_ 项结果",
		"sZeroRecords":  "没有匹配结果",
		"sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
		"sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
		"sInfoFiltered": "(由 _MAX_ 项结果过滤)",
		"sInfoPostFix":  "",
		"sSearch":       "搜索：",
		"sUrl":          "",
		"sEmptyTable":     "没有任何数据...",
		"sLoadingRecords": "载入中...",
		"sInfoThousands":  ",",
		"oPaginate": {
			"sFirst":    "首页",
			"sPrevious": "上页",
			"sNext":     "下页",
			"sLast":     "末页"
		},
		"oAria": {
			"sSortAscending":  ": 以升序排列此列",
			"sSortDescending": ": 以降序排列此列"
		}
	}
}
$(document).ready(function() {

	var url = $('#table_id').attr('data-table-ajaxurl');
	table = $('#table_id').DataTable({
		responsive: true, 
		"ordering": false, //是否支持排序
		"searching": false, //搜索
		"searchable": false, //让搜索支持ajax异步查询
		"lengthChange": false,//让用户可以下拉无刷新设置显示条数
		"pageLength":20,//默认每一页的显示数量
		"serverSide": true, //ajax服务开启
		"language": json,
		"ajax": {
			'url': url,
			"data": function ( v ) {
				var l = $("input[data-table-search],select[data-table-search]"),vlist='{ ',i=0;
				if(l.length>0){
					l.each(function(){
						i++;
						var n  = '"'+$(this).attr("name")+'"',val = '"'+$(this).val()+'"';
						if(val!='')vlist+=i==l.length?n+':'+val:n+':'+val+',';
					});
				}
				vlist+=' }';
				vlist=$.parseJSON(vlist);
				return $.extend( {}, v, vlist );
			}
		}
	});
	
});