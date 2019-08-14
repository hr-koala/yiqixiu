
define(function (require, exports, module) {
    
    var common = require('common'); //加载公共函数文件（语言文字获取等）
    $.ajax({
        type: "POST",
        url: own_name + 'c=ajax&a=doajaxcl',
        dataType: "json",
        async: false,
        success: function (data) {
            cl = data;
        },
        error: function (jqXHR, textStatus, errorMsg) {
            alert(jqXHR+textStatus+errorMsg);
        }
    });
    
    ownfunc = require('own/admin/templates/js/func'); //公用函数
    if($('.mapinputselect').length){
        ownfunc.city($(".mapinputselect .fbox"),'info');
    }
    //单页添加
    if($('#allmap2').length) require.async('own/admin/templates/js/infomap');
    //配置
    if($('#allmap3').length){
        require.async('own/admin/templates/js/configmap');
        //经销区域
        ownfunc.city($(".configftype_select .fbox"));
        //公司城市
        ownfunc.city($(".configcity .fbox"));
        //提交时的检测
        $(".ui-from").submit(function(){
            if($("input[name='state']").val() == 2){
                var animate = false;
                //公司名称
                if(ownfunc.nullval($("input[name='corporatename']").val()) == false){
                    ownfunc.error($("input[name='corporatename']").parent(),cl.t.yw054);
                    animate = true;
                }
                //公司位置
                if(ownfunc.nullval($('.configcity').find(".city option:selected").val()) == false){
                    ownfunc.error($(".configcity .fbox"),cl.t.yw035);
                    animate = true;
                }
                //公司经纬度
                if(ownfunc.nullval($("input[name='lnglat']").val()) == false){
                    ownfunc.error($("input[name='lnglat']").parent(),cl.t.yw054);
                    animate = true;
                }

                if(animate){
                    var speed=200;//滑动的速度
                    $('body,html').animate({ scrollTop: 0 }, speed);
                    return false;
                }
            }
        });
        
    }
});
