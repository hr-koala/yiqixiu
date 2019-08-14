var result = window.matchMedia("(min-width: 768px)");
function adryset(){
	by = ay;
	if (!result.matches) {
		var bx = $(".ad-image-wrapper").width();
		by = (ay*bx)/ax;
	}
	//图片切换
	$('.ad-gallery').adGallery({
		effect:'fade',
		height:by,
		loader_image:''
	}); 
}
$(document).ready(function() {
	adryset();
	$(window).resize(function () {
		adryset();
	})
	
	//图片画廊
	
	$('#lightgallery').lightGallery({download: false});
	$(document).on('click',"#gallery .ad-image img",function(event){
		var i = $("#lightgallery a.ad-active").parent().index();
		$('#lightgallery').data('lightGallery').build(i);    
		$('#lightgallery').data('lightGallery').slide(i,false,false);    
	});
	
	if($(".met_editor img").length){
		$(".met_editor").wrapInner("<div class='editorlightgallery'></div>");
		$(".met_editor img").each(function(){
			if($(this).parent("a").length==0){
				$(this).wrap("<div class='lg-item-box' data-src='"+$(this).attr("src")+"'></div>");
			}
		});
		$('.editorlightgallery').lightGallery({download: false,selector:'.lg-item-box'});
	}
	
	//数量
	$('[data-plugin="touchSpin"]').TouchSpin();
	
	//固定顶部
	var anvtop = $(".affix-nav").offset().top;
	$(window).scroll(function (){
		var st = $(this).scrollTop();
		if(st>anvtop){
			$(".affix-fixed").removeClass('hide');
		}else{
			$(".affix-fixed").addClass('hide');
		}
	});
	$(document).on('click', '.affix-fixed .nav li a', function(e) {
		$('html,body').animate({'scrollTop':anvtop},300);
		var dom = $('.affix-nav a[href="'+$(this).attr('href')+'"]');
		$('.affix-nav a').parent().removeClass('active');
		dom.parent().addClass('active');
	});
	$(document).on('click', '.affix-nav li a', function(e) {
		var dom = $('.affix-fixed .nav li a[href="'+$(this).attr('href')+'"]');
		$('.affix-fixed .nav li a').parent().removeClass('active');
		dom.parent().addClass('active');
	});
	
	//加入购物车&立即购买
	$(document).on('click', 'a.product-tocart,a.product-buynow', function(e) {
		e.preventDefault();
		var f = true;
		$(".selectpara-body").each(function(){
			if($(this).find(".selectpara.btn-danger").length==0)f = false;
		});
		if(f){
			var paravalStr = encodeURIComponent(paraval()).replace('*','u002A');
			var url = $(this).attr('href')+'|'+paravalStr+'&num='+$("#buynum").val();
			window.location.href = url;
		}else{
			alertify.error('请选择选项');
		}
	});
	//选择选项
	$(document).on('click', '.selectpara', function(e) {
		var ps = $(this).parent().find('.selectpara');
		ps.removeClass('btn-danger');
		$(this).addClass('btn-danger');
		stock_price();
	});
	stock_price();
})
//获取选项
function paraval(){
	var str = '';
	$('.selectpara.btn-danger').each(function(){
		str+=$(this).data('val')+','; 
	});
	str = str.substring(0,str.length-1);
	
	return str;
}
//计算价格
function stock_price(){
	
	var str = paraval();
	$.each(stockjson, function(i, item){
		if(item.valuelist==str){
			$("#price").html(item.price_str);
			$('[data-plugin="touchSpin"]').trigger("touchspin.updatesettings", {max: item.stock});
			if(item.stock==0){
				$('[data-plugin="touchSpin"]').val(0);
			}
		}
	});
	
	stock_vild();
	
}
function stock_vild(){
	
	$('.selectpara').removeClass('disabled');
	$.each(stockjson, function(i, item){
		if(item.stock==0){
			var val = item.valuelist;
			val = val.split(',');
			if(val.length==1){
				$('.selectpara[data-val="'+val[0]+'"]').removeClass('btn-danger').addClass('disabled');
			}
			if(val.length==2){
				if($('.selectpara[data-val="'+val[0]+'"]').hasClass('btn-danger')){
					$('.selectpara[data-val="'+val[1]+'"]').removeClass('btn-danger').addClass('disabled');
				}else{
					if($('.selectpara[data-val="'+val[1]+'"]').hasClass('btn-danger')){
						$('.selectpara[data-val="'+val[0]+'"]').removeClass('btn-danger').addClass('disabled');
					}
				}
			}
			if(val.length==3){
			}
		}
	});
}
//