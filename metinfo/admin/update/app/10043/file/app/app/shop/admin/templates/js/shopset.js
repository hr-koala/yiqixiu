$(document).ready(function() {
	
    var options = $.extend({}, $.components.getDefaults("asSpinner"), {
      min: 0,
	  max: 50000
    });
    $("input[name='shopv2_order_end']").asSpinner(options);
	$('[data-plugin="tokenfield"]').tokenfield({delimiter:'|'});
	
	$('#shopset_from').formValidation({
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
	
});

(function(document, window, $) {
  'use strict';
  var Site = window.Site;
  $(document).ready(function($) {
	Site.run();
  });
})(document, window, jQuery);

