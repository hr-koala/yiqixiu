$(document).ready(function() {
	
	$('#shopsetpay_from').formValidation({
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
				}
			}
		});
	});
	
	paytypeok();
	$(document).on('change',"input[name='shopv2_onlinepay'],input[name='shopv2_deliverypay']",function(){
		paytypeok();
	})
	
});

function paytypeok(){
	if(!$("input[name='shopv2_onlinepay']")[0].checked&&!$("input[name='shopv2_deliverypay']")[0].checked){
		alertify.error('支付方式请至少开启一项');
	}
}

(function(document, window, $) {
  'use strict';
  var Site = window.Site;
  $(document).ready(function($) {
	Site.run();
  });
})(document, window, jQuery);