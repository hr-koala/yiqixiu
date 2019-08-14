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

    var common = require('common'); //加载公共函数文件
    var city = '',marker, lng, lat,map,point ='', myIcon,myGeo,level = 12,select1,select2,select3,address;

    //弹窗打开前
    $('#myModal').on('show.bs.modal', function (e) {
        select1 = $(".configcity .prov option:selected").val();
        select2 = $(".configcity .city option:selected").val();
        select3 = $(".configcity .dist option:selected").val();
        address = $(".configcity input[name='city4']").val();

        if(!select1 || typeof(select1)=="undefined" || select1 == 0) select1 = '';
        if(!select2 || typeof(select2)=="undefined" || select2 == 0) select2 = '';
        if(!select3 || typeof(select3)=="undefined" || select3 == 0) select3 = '';
        if(!address || typeof(address)=="undefined" || address == 0) address = '';
        
        if(select2 == ''){
            ownfunc.error($(".configcity .fbox"),cl.t.yw035);
            return false;
        }else{
            if(select1 + select2 + select3 + address != city) point = '';
            $('h4.modal-title').html(cl.t.yw053);
        }
    })
    
    //新窗口打开
    $('#myModal').on('shown.bs.modal', function (e) {
        // 创建Map实例
        if(point == ''){
            map = new BMap.Map("allmap3", {enableMapClick: false});
            // 开启鼠标滚轮缩放
            map.enableScrollWheelZoom(true);
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
            point = 1;
        }
        
        var lnglat = $('input[name="lnglat"]').val();
        if (lnglat != ''){
            var lnglats = lnglat.split(",");
            lng = lnglats[0], lat = lnglats[1];
            // 初始化地图,设置中心点坐标和地图级别
            map.centerAndZoom(new BMap.Point(lng, lat),14);
            addOverlay();
        }
        
        if(select2 != ''){
            if(address != '') level = 14;
            myGeo.getPoint(select2 + select3 + address,function(point){
                if (point) {
                    map.centerAndZoom(point,level);
                }else{
//                    alert("您选择地址没有解析到结果!");
                }
            },select1);
            
            city = select1+select2 + select3 + address;
        }

        //点击百度地图时触发
        map.addEventListener("click", function (e) {
            //清除标注
            map.removeOverlay(marker);
            //赋值给输入框
            lng = e.point.lng, lat = e.point.lat;
            addOverlay()
        });
        
    });
    
    //获取经纬度 创建标注
    function markerpoint() {
        return  new BMap.Marker(new BMap.Point(lng, lat)); //  获取经纬度 创建标注
    }
    
    //当前页面的标注
    function addOverlay(){
        if(!lng || typeof(lng)=="undefined" || lng == 0) return false;
        marker = '';
        marker = markerpoint();
        marker.setIcon(myIcon);
        map.addOverlay(marker);
    }
    
    $('#myModal .btn-primary.button').click(function () {
        //判断是否进行了标注
        if(!lng || typeof(lng)=="undefined" || lng == 0) return false;
        //返回值
        $('input[name="lnglat"]').val(lng + ',' + lat);
        //关闭对话框
        $('#myModal').modal('hide');
    })
    
    
    //隐藏
    $('#myModal').on('hidden.bs.modal', function (e) {
        map.clearOverlays(); //清除标注
    });

});