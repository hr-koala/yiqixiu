define(function (require, exports, module) {
    
    var common = require('common'); //加载公共函数文件（语言文字获取等）
    var langtxt = common.langtxt(); //获取语言文字

    //城市选择
    exports.city = function(d,info){
        require.async('own/select-linkage/jquery.cityselect',function(a){
            var p = d.find(".prov").attr("data-checked"),
                c = d.find(".city").attr("data-checked"),
                s = d.find(".dist").attr("data-checked");
                p = p?p:'';
                c = c?c:'';
                s = s?s:'';
                info = info == 'info'?false:true;
            var url = d.attr('data-selectdburl')?d.attr('data-selectdburl'):pubjspath+"js/examples/select-linkage/city.min.php";
            d.citySelect({url:url,prov:p, city:c, dist:s, nodata:"none",info:info});
        });
    }
    
    //错误提示
    exports.error = function(a,info){
        a.find("div.formerror").remove();
        a.append('<div class="formerror"><i class="fa fa-times"></i>'+info+'</div>');
    }
    
    //检测值是不是为空
    exports.nullval = function(a){
        if(!a || typeof(a) == "undefined" || a == 0 || a == '') return false;
    }

});
