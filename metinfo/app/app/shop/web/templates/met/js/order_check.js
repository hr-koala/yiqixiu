$(document).ready(function() {
	$(document).on('click',".shop-order-close",function(e){
		e.preventDefault();
		var dom = $(this);
		alertify.theme('bootstrap').okBtn(lang_ok).cancelBtn(lang_cancel).confirm(lang_cancelorderok, function (ev) {
			ev.preventDefault();
			$.ajax({
				url: dom.attr('href'),
				type: 'POST',
				dataType:'json',
				success: function(data) {
					if(data.error){
						alertify.error(data.error);
					}else if(data.success){
						alertify.success(data.success);
						location.reload();
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	})
});