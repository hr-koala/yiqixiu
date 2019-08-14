$(document).ready(function() {
	if($('#editor-email-deliver-goods').length>0){
		var v3 = UE.getEditor('editor-email-deliver-goods');
		var v2 = UE.getEditor('editor-email-pay');
		var v1 = UE.getEditor('editor-email-place-order');
		
		var v3 = UE.getEditor('editor-email-deliver-goods',{
			initialFrameWidth : '100%',
			initialFrameHeight : 200
		});
		
		var v2 = UE.getEditor('editor-email-pay',{
			initialFrameWidth : '100%',
			initialFrameHeight : 400
		});
		
		var v1 = UE.getEditor('editor-email-place-order',{
			initialFrameWidth : '100%',
			initialFrameHeight : 400
		});
	}
	if($('[data-plugin="tokenfield"]').length>0){
		$('[data-plugin="tokenfield"]').each(function(){
			$(this).tokenfield({delimiter:'|'});
		});
	}
	
				
	$('#shop_remind').formValidation({
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
		
		if($('#editor-email-deliver-goods').length>0){
			formData.append('shopv2_uemailcv1', v1.getContent());
			formData.append('shopv2_uemailcv2', v2.getContent());
			formData.append('shopv2_uemailcv3', v3.getContent());
		}
		
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
});

(function(document, window, $) {
  'use strict';
  var Site = window.Site;
  $(document).ready(function($) {
	Site.run();
  });
})(document, window, jQuery);
