//收货地址模态框
function addr_modal(carry,dom){
	var modal = $('#addr-edit-modal');
	$('.addr-edit-form')[0].reset();
	$(".addr-edit-form input[name='id']").val('');
	$(".addr-edit-form select[name='zone_p']").attr('data-checked','');
	$(".addr-edit-form select[name='zone_c']").attr('data-checked','');
	$(".addr-edit-form select[name='zone_d']").attr('data-checked','');
	if(dom){
		$(".addr-edit-form input[name='id']").val(dom.data('id'));
		$(".addr-edit-form input[name='name']").val(dom.data('name'));
		$(".addr-edit-form input[name='tel']").val(dom.data('tel'));
		$(".addr-edit-form textarea[name='zone_a']").val(dom.data('zone_a'));
		$(".addr-edit-form select[name='zone_p']").attr('data-checked',dom.data('zone_p'));
		$(".addr-edit-form select[name='zone_c']").attr('data-checked',dom.data('zone_c'));
		$(".addr-edit-form select[name='zone_d']").attr('data-checked',dom.data('zone_d'));
	}
	selectlinkage(modal.find('.select-linkage'));
	modal.modal(carry);
}
/*城市选择器*/
function selectlinkage(dm){
	var p = dm.find(".prov").attr("data-checked"),
		c = dm.find(".city").attr("data-checked"),
		s = dm.find(".dist").attr("data-checked");
		p = p?p:'';
		c = c?c:undefined;
		s = s?s:undefined;
	dm.citySelect({url:uipath+'vendor/select-linkage/city.min.php',prov:p, city:c, dist:s, nodata:"none"});
}
//地址数据
function laod_addr_json(func){
	$.ajax({
		url: addrlisturl,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}