define(function (require, exports, module) {
    
    var common = require('common'); //加载公共函数文件（语言文字获取等
    var owns = 'tems/web/templates/',cl={},url = $(".yunbranchmap").data('url'),m_name = $(".yunbranchmap").data('m_name');
    //获取自定义语言参数（全局使用需要放顶部）
    $.ajax({
        type: "POST",
        url: url + m_name + "/?a=doajaxcl",
        dataType: "json",
        async: false,
        success: function (data) {
            cl = data;
        },
        error: function (jqXHR, textStatus, errorMsg) {
            alert(jqXHR+textStatus+errorMsg);
        }
    });
    
    //地图
    var city = cl.c.city,map,myGeo,ywdlmap = new Object(),data,select1 = '',select2= '',select3='',state = cl.c.state,type='';

    if(cl.c.state == 1){
        select1=cl.c.select1?cl.c.select1:'',
        select2=cl.c.select2?cl.c.select2:'',
        select3=cl.c.select3?cl.c.select3:'';
    }
    
    if(cl.c.state == 2){
        select1=cl.c.city1?cl.c.city1:'',
        select2=cl.c.city2?cl.c.city2:'',
        select3=cl.c.city3?cl.c.city3:'';
    }
    
    
    //城市选择
    require.async('tems/select-linkage/jquery.cityselect',function(a){
        var d = $(".ftype_select-linkage .fbox");
        var p = d.find(".prov").attr("data-checked"),
            c = d.find(".city").attr("data-checked"),
            s = d.find(".dist").attr("data-checked");
            p = p?p:select1;
            c = c?c:select2;
            s = s?s:select3;
        var url = d.attr('data-selectdburl')?d.attr('data-selectdburl'):tems +"select-linkage/city.min.js";
        d.citySelect({url:url,prov:p, city:c, dist:s, nodata:"none"});
    });
                
    // 创建Map实例
    map = new BMap.Map("allmap", {enableMapClick: false});
    // 初始化地图,设置中心点坐标和地图级别
    map.centerAndZoom(city);
    // 开启鼠标滚轮缩放
    map.enableScrollWheelZoom(true);
    //添加百度地图工具默认缩放平移控件
    map.addControl(new BMap.NavigationControl());  
    //地址解析
    myGeo = new BMap.Geocoder();
    
    //页面加载完成后
    $(document).ready(function(){
        if(cl.c.state != 0) ywdlmap.selectcity();
    })
    
    //城市查询
    $(document).on('change', ".mapinputselect select", function () {
        var citytext = $('.mapinputselect');
            select1 = citytext.find(".prov option:selected").val(),
            select2 = citytext.find(".city option:selected").val(),
            select3 = citytext.find(".dist option:selected").val();
            type = citytext.find(".type option:selected").val();
        
        if(!select1 || typeof(select1)=="undefined" || select1 == 0) select1 = '';
        if(!select2 || typeof(select2)=="undefined" || select2 == 0) select2 = '';
        if(!select3 || typeof(select3)=="undefined" || select3 == 0) select3 = '';
        if(!type || typeof(type)=="undefined" || type == 0) type = '';
        state = 1;
        ywdlmap.selectcity();
    })
    
    //获取城市选择信息
    ywdlmap.selectcity = function(){
        ywdlmap.location();
        $.getJSON(url + m_name + "/?a=doajax",{province:select1,city:select2,district:select3,state:state,type:type},function (json) {
            data = json.data;
            map.clearOverlays(); //清除标注
            if(json.code == 1){
                ywdlmap.addmapdata(json.data);
            }
            ywdlmap.addmapinfo(json.info,json.num);
        })
    }
    
    //列表信息
    ywdlmap.addmapinfo = function(info,num){
        $(".listgroup div.list-group").html(info);
        $(".mapinputselect .num").remove();
        if(state != 2) $(".mapinputselect").append(num);
    }
    
    //进行地址解析定位
    ywdlmap.location = function(){
        var city2 = select2 + select3;
        if(city2 == ''){
            map.setZoom(10);
            map.centerAndZoom(select1);
        }else{
            myGeo.getPoint(city2,function(point){
                if (point) {
                    map.setZoom(12);
                    map.panTo(point);
                }
            },select1);
        }
    }
    
    //给地图添加标注
    ywdlmap.addmapdata = function(data){
        
        for(var i=0;i<data.length;i++){
            var marker = new BMap.Marker(new BMap.Point(data[i][0],data[i][1]));  // 创建标注
            var content = data[i][2];
            map.addOverlay(marker);               // 将标注添加到地图中
            if(state == 2) marker.setAnimation(BMAP_ANIMATION_BOUNCE);
            ywdlmap.addClickHandler(content,marker);
        }
    }

    //添加弹窗事件
    ywdlmap.addClickHandler = function(content,marker){
        marker.addEventListener("click",function(e){
            ywdlmap.openInfo(content,e)
        });
    }

    //弹窗内容事件
    ywdlmap.openInfo = function(content,e){
            var p = e.target;
            var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
            var infoWindow = new BMap.InfoWindow(content);  // 创建信息窗口对象 
            map.openInfoWindow(infoWindow,point); //开启信息窗口
            map.setZoom(16);
            map.panTo(point);
    }
    
    //根据信息定位
    $(document).on('click',".lnglat",function(){
        $('.namelist .list-group a.lnglat').removeClass("active");
        $(this).addClass('active');
        
        var lng = $(this).data('lng'), lat = $(this).data('lat'), num = $(this).data('num');
        var point = new BMap.Point(lng,lat);
        var content = data[num][2];
        var infoWindow = new BMap.InfoWindow(content);  // 创建信息窗口对象 
        map.openInfoWindow(infoWindow,point); //开启信息窗口
        map.setZoom(16);
        map.panTo(point);
    })
    
});
