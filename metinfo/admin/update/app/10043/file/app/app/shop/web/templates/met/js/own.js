$(document).ready(function() {
	laodtopcart();
});
function laodtopcart(d){
	$("#topcart-body").html('<div class="height-100 vertical-align text-center cart-loader"><div class="loader vertical-align-middle loader-default"></div></div>');
	laodcartjson(function(json){
		var html = '',num=0;
		$.each(json, function(i, item){
			item.shopmax = item.purchase>0?item.purchase:item.stock;
			html += '<div class="list-group-item" role="menuitem">'+
						'<div class="media">'+
							'<div class="media-left padding-right-10">'+
								'<a class="avatar text-middle" target="_blank" href="'+item.url+'">'+
									'<img class="img-responsive" src="'+item.img+'" alt="">'+
								'</a>'+
							'</div>'+
							'<div class="media-body">'+
								'<div class="pull-right text-right">'+
									'<span>'+item.price_str+' x '+item.amount+'</span>'+
									'<p><a href="'+delurl+'&id='+item.id+'" class="topcartremove"><i class="icon wb-trash" aria-hidden="true"></i></a></p>'+
								'</div>'+
								'<h6 class="media-heading font-weight-unset">'+
									'<a target="_blank" href="'+item.url+'">'+
										item.name+
									'</a>'+
								'</h6>'+
								'<p>'+item.para_str+'</p>'+
							'</div>'+
						'</div>'+
					'</div>';
			num++;
		})
		if(html==''){
			html='<div class="height-100 text-center vertical-align"><div class="vertical-align-middle">'+lang_emptycart+'</div></div>';
			$('.dropdown-menu-footer').hide();
		}
		$("#topcart-body").parent('.scrollable-container').height('auto');
		$('.topcart-goodnum').html(num).removeClass('hide');
		$("#topcart-body").html(html);
		topcarttotal();
		$('.topcartremove').click(function(e){ e.preventDefault(); topcartremove($(this)); });
		$('.dropdown-menu-footer-btn a,#topcart-body .media-heading a,#topcart-body .media-left a').click(function(e){ window.location.href = $(this).attr('href'); });
	},d);
}
//购物车价格
function topcarttotal(){
	$.ajax({
	url: totalurl,
	type: "GET",
	cache: false,
	dataType: "jsonp",
	success: function(data) {
		if(data.message == 'ok'){
			$('.topcarttotal').html(data.price.goods.total_str);
		}
	}
});
}
//
function topcartremove(dom){
	$.ajax({
		url: dom.attr('href'),
		type: 'POST',
		dataType:'json',
		success: function(data) {
			if(data.error){
				alertify.error(data.error);
			}else if(data.success){
				alertify.success(data.success);
				laodtopcart('new');
			}
		}
	});
}
//购物车数据
function laodcartjson(func,d){
	if(typeof(cartjson) == "undefined"||d=='new'){//避免重复获取数据
		$.ajax({
			url: jsonurl,
			type: 'POST',
			dataType:'json',
			success: function(json) {
				window.cartjson = json;//赋值全局变量
				func(json);
			}
		});
	}else{
		func(cartjson);
	}
}
(function(document, window, $) {
	'use strict';
	var Site = window.Site;
	$(document).ready(function() {
		Site.run();
		/*视频插件异步加载*/
		if($(".metvideobox").length>0){
			$.extend({
	            includePath: '',
	            include: function(file) {
	                var files = typeof file == "string" ? [file] : file;
	                for (var i = 0; i < files.length; i++) {
	                    var name = files[i].replace(/^\s|\s$/g, "");
	                    var att = name.split('.');
	                    var ext = att[att.length - 1].toLowerCase();
	                    var isCSS = ext == "css";
	                    var tag = isCSS ? "link" : "script";
	                    var attr = isCSS ? " type='text/css' rel='stylesheet' " : " type='text/javascript' ";
	                    var link = (isCSS ? "href" : "src") + "='" + $.includePath + name + "'";
	                    if ($(tag + "[" + link + "]").length == 0) $("head").prepend("<" + tag + attr + link + "></" + tag + ">");
	                }
	            }
	        });
			$(".metvideobox").each(function(){
				var data = $(this).attr("data-metvideo");
					data = data.split("|");
				var width  = data[0],
					height = data[1],
					poster = data[2],
					autoplay = data[3],
					src = data[4];
				var vhtml = '<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="'+width+'" height="'+height+'" poster="'+poster+'" data-setup=\'{\"autoplay\": '+autoplay+'}\'>';
					vhtml+= '<source src="'+src+'" type="video/mp4" />';
					vhtml+= '</video></div>';
					$(this).after(vhtml).remove();
			});
			$.include('../public/ui/v1/js/effects/video-js/video-js.css');
			if($(window).width()>1000){
				$.getScript("../public/ui/v1/js/effects/video-js/video_hack.js",function(){
					setTimeout(function(){
						videoSizeRes('.metvideo');
					},0)
				});
			}else{
				videoSizeRes('.metvideo');
			}
		}
		if($('.met-editor iframe,.met-editor embed').length) videoSizeRes('.met-editor iframe,.met-editor embed');
	});
})(document, window, jQuery);
/*视频尺寸自适应*/
function videoSizeRes(obj) {
	$(obj).each(function() {
		var $this=$(this),
			scale=$(this).attr('height')/$(this).attr('width');
		if(!scale) scale=parseInt($(this).css('height'))/parseInt($(this).css('width'));
		if(scale){
			$(this).height($(this).width()*scale);
			$(window).resize(function() {
				$this.height($this.width()*scale);
			});
		}
	});
}