$(document).ready(function() {

	$(document).on('show.bs.modal',"#finance_deposit,#finance_debit",function(){
		$('.finance_from')[0].reset();
	})
	//数据筛选
	$(document).on('change keyup',"[data-table-search]",function(){
		table.ajax.reload();
	})
	
	//日期选择器
	$('[data-plugin="datepicker"]').datepicker({
		format:'yyyy-mm-dd',
	});
	
	//入款扣款
	$('.finance_from').formValidation({
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
				}else if(result.success){
					alertify.success(result.success);
					table.ajax.reload();
					$("#finance_deposit,#finance_debit").modal('hide');
				}
			}
		});
	});
	
});

