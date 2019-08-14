function window_iframe(url,title){
	if(!title) title='窗口';
	
	var box='<div id="box_window" class="box_window" style="display:none;"><div class="bw_t">&nbsp;</div><div class="bw_l">&nbsp;</div>'
			+'<div class="box_window_w"><h3>'+title+' <a href="javascript:;" onclick="$(\'#box_window\').remove()" class="bw_close">关闭</a></h3><div id="box_iframe" class="box_content"></div></div>'
			+'<div class="bw_r">&nbsp;</div><div class="bw_b">&nbsp;</div></div>';
	
	if($('#box_window').length<=0){
		$('body').append(box);
	}
	
	var ifr='<iframe src="'+url+'" style="width:100%;;height:100%;"></iframe>';

	$('#box_iframe').html(ifr);
    $('#box_window').show();
    
    
	init_window('box_window');
}

/*初始化窗口位置、可拖拽*/
function init_window(id){
	
	id='#'+id;
	
	
    
    var obj_w=$(id).width();
    var obj_h=$(id).height();

    var body_w=$(window).width();
    var body_h=$(window).height();
    
    var left_w=(body_w-obj_w)/2;
    var left_h=$(document).scrollTop()+((body_h-obj_h)/2);
    
    $(id).css({'left':left_w,'top':left_h});
    
	//拖拽
	var dragging = false;
    var iX, iY;
    $(id).mousedown(function(e) {
        dragging = true;
        iX = e.clientX - this.offsetLeft;
        iY = e.clientY - this.offsetTop;
        this.setCapture && this.setCapture();
        return false;
    });
    $(id).mouseup(function(e) {
        dragging = false;
        $(id)[0].releaseCapture();
        e.cancelBubble = true;
    })
    
    document.onmousemove = function(e) {
        if (dragging) {
	        var e = e || window.event;
	        var oX = e.clientX - iX;
	        var oY = e.clientY - iY;
	        $(id).css({"left":oX + "px", "top":oY + "px"});
	        return false;
        }
    };
}

function window_filtertag(){
	var box='<div id="box_window_self" class="box_window"><div class="bw_t">&nbsp;</div><div class="bw_l">&nbsp;</div>'
		+'<div class="box_window_w"><h3>窗口 <a href="javascript:;" onclick="$(\'#box_window_self\').remove()" class="bw_close">关闭</a></h3><div id="box_content" class="box_content"></div></div>'
		+'<div class="bw_r">&nbsp;</div><div class="bw_b">&nbsp;</div></div>';
	
	if($('#box_window_self').length<=0){
		$('body').append(box);
	}
	
	var html='<label>aaa</label>';
	
	

	init_window('box_window_self');
}