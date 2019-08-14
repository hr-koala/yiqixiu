/*
 * mythis       当前点击的输入框
 * marker       最后的地图初始返回对象
 * lng、lat     最后的地图经纬度
 *
 * map           地图初始化
 * name          当前点击的输入框name值
 * cachei        用来判断地图是否进行缓存,当刷新后重置，这样保证弹窗时地图可进行视角展示缓存
 * myIcon        当前图标
 */
define(function (require, exports, module) {

    var common = require('common'); //加载公共函数文件（语言文字获取等）  
    var city = cl.c.city, marker, lng, lat,map1,map2,map2points = '', myIcon, select1 = '',select2='',select3='',city1='',city2='',address='',myGeo,points = '',citylevel = '';

    $(document).ready(function(){
        // 创建Map实例
        map1 = new BMap.Map("allmap", {enableMapClick: false});
        
        var lnglat = $('input[name="lnglat"]').val();
        if (lnglat !== ''){
            var lnglats = lnglat.split(",");
            lng = lnglats[0], lat = lnglats[1];
            city = points = new BMap.Point(lng, lat);
            citylevel = 14;
        }
        
        // 初始化地图,设置中心点坐标和地图级别
        map1.centerAndZoom(city,citylevel);
        // 开启鼠标滚轮缩放
        map1.enableScrollWheelZoom(true);

        // 编写自定义函数，创建标注     
        myIcon = new BMap.Icon("http://api.map.baidu.com/img/markers.png", new BMap.Size(19, 25), {
            // 指定定位位置。   
            // 当标注显示在地图上时，其所指向的地理位置距离图标左上   
            // 角各偏移10像素和25像素。您可以看到在本例中该位置即是   
            // 图标中央下端的尖角位置。   
            anchor: new BMap.Size(10, 25),
            // 设置图片偏移。   
            // 当您需要从一幅较大的图片中截取某部分作为标注图标时，您   
            // 需要指定大图的偏移位置，此做法与css sprites技术类似。   
            imageOffset: new BMap.Size(0, -300)   // 设置图片偏移   
        }); 
        //地址解析
        myGeo = new BMap.Geocoder();
        if (citylevel !== '') addOverlay(map1);
    })
    
    //当前页面的标注
    function addOverlay(map){
        if(!lng || typeof(lng)=="undefined" || lng == 0){
            return false;
        }
        marker = '';
        marker = markerpoint();
        marker.setIcon(myIcon);
        map.addOverlay(marker);
    }
    
    $(document).on('change keyup', ".mapinputselect input, .mapinputselect select", function () {
        var level = cityselect();
        if(city2) location(map1,level);
    })
    
    //获取选择信息
    function cityselect(){
        var citytext = $('.mapinputselect'),level=12;
        
        select1 = citytext.find(".prov option:selected").val();
        select2 = citytext.find(".city option:selected").val();
        select3 = citytext.find(".dist option:selected").val();
        address = citytext.find("input[name='address']").val();
            
        if(!select1 || typeof(select1)=="undefined" || select1 == 0) select1 = '';
        if(!select2 || typeof(select2)=="undefined" || select2 == 0) select2 = '';
        if(!select3 || typeof(select3)=="undefined" || select3 == 0) select3 = '';
        if(address){
            level = 14;
        }else{
            address = '';
        }
        
        city1   = select2 + select3;
        city2 = select2 + select3 + address;
        return level;
    }
    
    //进行地址解析定位
    function location(map,level){
        myGeo.getPoint(city2,function(point){
            points = point;
            if (point) {
                map.setZoom(level);
                map.panTo(point);
            }else{
//                alert("您选择地址没有解析到结果!");
            }
        },select1);
    }
    
    //弹窗打开前
    $('#myModal').on('show.bs.modal', function (e) {
        cityselect();
        if(city1){
            $('h4.modal-title').html(cl.t.yw034 + '：'+select1+'<small style="padding-left:15px;">'+city2+'</small>');
        }else{
            ownfunc.error($(".mapinputselect .fbox"),cl.t.yw035);
            return false;
        }
        
    })
    
    //新窗口打开
    $('#myModal').on('shown.bs.modal', function (e) {
        if(points != map2points){
            // 创建Map实例
            map2 = new BMap.Map("allmap2", {enableMapClick: false});
            // 初始化地图,设置中心点坐标和地图级别
            map2.centerAndZoom(points,14);
            // 开启鼠标滚轮缩放
            map2.enableScrollWheelZoom(true);
            map2points = points;
        }
        //将已有标记添加上
        addOverlay(map2);
        
        //ajax查找当前地区的代理商将点的标注添加在地图上
        $.getJSON(own_name + "c=ajax&a=doindex",{id:$(this).attr('infoid'),province:select1,city:select2,district:select3},function (json) {
            $.each(json, function (i, val) {
                if (val !== '') {
                    eachlnglat(val);
                }
            })
        })
        
        //点击百度地图时触发
        map2.addEventListener("click", function (e) {
            //清除标注
            map2.removeOverlay(marker);
            //赋值给输入框
            lng = e.point.lng, lat = e.point.lat;
            addOverlay(map2)
        });
    });
    
    //获取经纬度 创建标注
    function markerpoint() {
        return  new BMap.Marker(new BMap.Point(lng, lat)); //  获取经纬度 创建标注
    }
    
    //地图标记插入地图
    function eachlnglat(laglats) {
        var arr = [], markers = '';
        arr = laglats.split(",");
        markers = new BMap.Marker(new BMap.Point(arr[0], arr[1]));
        // 将标注添加到地图中
        map2.addOverlay(markers);
    }
    
    $('#myModal .btn-primary.button').click(function () {
        //判断是否进行了标注
        if(!lng || typeof(lng)=="undefined" || lng == 0){
            return false;
        }
        //返回值
        $('input[name="lnglat"]').val(lng + ',' + lat);
        //清除标注
        map1.clearOverlays(); 
        //地图显示
        map1.panTo(new BMap.Point(lng, lat));
        //对地图一进行标注
        addOverlay(map1)
        //关闭对话框
        $('#myModal').modal('hide');
    })
    
    
    //隐藏
    $('#myModal').on('hidden.bs.modal', function (e) {
        map2.clearOverlays(); //清除标注
        var lnglat = $('input[name="lnglat"]').val();
        if(lnglat != lng + ',' + lat){
            lng = lat = '';
        }
        
        if (lnglat !== ''){
            var lnglats = lnglat.split(",");
            lng = lnglats[0], lat = lnglats[1];
        }
    });

});