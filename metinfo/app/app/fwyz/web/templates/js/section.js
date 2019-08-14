$(function () {
    var inputLength = $('#input input').length, input   = $("#input"), inwidth = input.width(), bodywidth = $("body").width();
    //宽度
    $('#input input').css({width:inwidth/inputLength-8 +'px'});
    $('#input input:last').css({'margin-right':'0px'});
    
    input.delegate('input', 'keyup', function () {
        var _this = $(this), valLength = _this.val().length, index = _this.index(), maxlength = _this.attr('maxlength');
        if (valLength == maxlength) {
            if ((index + 1) > inputLength) return false;//输入完成时进行操作
            _this.attr('data-in', 'true').next().focus();
        } else if (valLength == 0 && _this.attr('data-in') == 'true') {
            if (index == 0) return false;//删除所有时进行操作
            _this.attr('data-in', 'false').prev().focus();
        }
    });

    $(".ui-from").submit(function () {
        var my = $("input[name='code']"), code = '', space = my.data('space'), y = 0;
        $("#input input").each(function (i) {
            if (i + 1 == inputLength) space = '';
            code += $(this).val() + space;
        })
        my.val(code);
    });

    //等高
    function metHeight(group) {
        tallest = 0;
        group.each(function () {
            thisHeight = $(this).height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    
    if(bodywidth > 970){
        metHeight($(".yun_fwyz div.yun_section"));
    }
    

});
