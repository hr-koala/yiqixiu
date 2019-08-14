<?php
defined('IN_MET') or exit('No permission');

//执行
function zx($form) {
    global $_M;
    CSQL($form);
    $js = js($form);
    $css = css($form);
}
//配置信息
function CON($lang) {
    global $_M;
    $query = "select * from {$_M['table']['yw_lrtk']} where lang = '{$lang}' ";
    $pz = DB::get_all($query);
    $arrlength = count($pz);
    $i = 0;
    for ($y = 0; $y < $arrlength; $y++) {	//组建数组$pzlb 配置列表
        $name = $pz[$i]['name'];
        $value = $pz[$i]['value'];
        $pzlb[$name] = $value;
        $i++;
    }
    return $pzlb;
}

//配置信息数据入库处理
function CSQL($form) {
    global $_M;
    $zb  = array('radio1','checkbox','lang','textjdn1','textjdn2','textjdn3','textjdn4','textjdn5','bottom','right','orderlist','wxwz','wxwzz','wxwzk','wxwzh'); //提交页面字段名称
    foreach ($zb as $key => $val) {
        $arr [$val] = $val;
    }
    $a = array_intersect_key($form,$arr); //对比数组
    foreach ($a as $k => $v) {
        if($k != 'lang'){
            $ar[$k] = array(name => $k ,value => $v, lang => $a['lang']);
        } 
    }
    foreach ($ar as $k => $v) {
        $a   = zfc($v);
        $sql = "INSERT INTO {$_M['table']['yw_lrtk']} SET {$a} ON DUPLICATE KEY UPDATE value='$v[value]'";
        $z  .=  DB::query($sql);
    }
}

//组成字符串
function zfc($z) {
    foreach ($z as $k => $v) {
        $arr .= $k."="."'".$v."'".",";
    }
    $arr = rtrim($arr, ",");
    return $arr;
}

//默认配置信息组
function morenpz($lang) {
    $arr['lang']        = $lang;
    $arr['radio1']      = '1';
    $arr['checkbox']    = '0|1|2|3|4|5';
    $arr['textjdn1']    = '15069846560';
    $arr['textjdn2']    = '../app/app/lrtk/admin/templates/img/yw.jpg';
    $arr['textjdn3']    = '415420792';
    $arr['textjdn4']    = 'http://t.qq.com/vipwangwei?preview';
    $arr['textjdn5']    = 'http://t.qq.com/vipwangwei?preview';
    $arr['bottom']      = '40';
    $arr['right']       = '40';
    $arr['wxwz']        = '0';
    $arr['wxwzz']       = '75';
    $arr['wxwzk']       = '160';
    $arr['wxwzh']       = '160';
    $arr['orderlist']   = '5,4,3,2,1,0';
    return $arr;
}

//css
function css($con) {
    global $_M;
    //基础
    $c = " .yun-izl-rmenu{position:fixed; right:{$con['right']}px;  bottom:{$con['bottom']}px;  z-index:999; }
            .yun-izl-rmenu .ywbtn{width:72px; height:73px; margin-bottom:1px; cursor:pointer; position:relative;}";
    //回到顶部
    $a['0'] = " .yun-izl-rmenu .btn-top{background:url(../img/r_top.png) center center no-repeat; background-color:#666666; display:none;}
                 .yun-izl-rmenu .btn-top:hover{background-color:#444;}";
    //客服电话
    $a['1'] = " .yun-izl-rmenu .btn-phone{background:url(../img/r_phone.png) center center no-repeat; background-color:#fbb01f;}
                .yun-izl-rmenu .btn-phone:hover{background-color:#ff811b;}
                 .yun-izl-rmenu .btn-phone .phone{background-color:#ff811b; position:absolute; width:160px; left:-160px; top:0px; line-height:73px; color:#FFF; font-size:18px; text-align:center; display:none;}";
    //微信
    $a['2'] = " .yun-izl-rmenu .btn-wx{background:url(../img/r_wx.png) center center no-repeat; background-color:#78c340;}
                .yun-izl-rmenu .btn-wx:hover{background-color:#58a81c;}
                .yun-izl-rmenu .btn-wx .pic{position:absolute; right:{$con['wxwzz']}px; bottom:{$con['wxwz']}px; display:none;width:{$con['wxwzk']}px; max-width:{$con['wxwzk']}px;height:{$con['wxwzh']}px;}";
    //QQ
    $a['3'] = " .yun-izl-rmenu .btn-qq{background:url(../img/r_qq.png) center center no-repeat; background-color:#6da9de; display: block;}
                .yun-izl-rmenu .btn-qq:hover{background-color:#488bc7;}
                .yun-izl-rmenu a.btn-qq, .yun-izl-rmenu a.btn-qq:visited{background:url(../img/r_qq.png) center center no-repeat; background-color:#6da9de; text-decoration:none; display:block;}";
    //新浪微博
    $a['4'] = " .yun-izl-rmenu .btn-xl{background:url(../img/r_xl.png) center center no-repeat; background-color:#E7162C; text-decoration:none; display:block;}
                .yun-izl-rmenu .btn-xl:hover{background-color:#fe4256; text-decoration:none;}";
    //腾讯微博
    $a['5'] = " .yun-izl-rmenu .btn-tx{background:url(../img/r_tx.png) center center no-repeat; background-color:#006A93; display:block; text-decoration:none;}
                .yun-izl-rmenu .btn-tx:hover{background-color:#009bd7; text-decoration:none;}";

    //输出内容
    $b  = $c;
    $checkbox   = explode('|',$con['checkbox']);
    foreach ($checkbox as $k => $v) {
        $b  .=  $a[$v];
    }
    $lj     = PATH_OWN_FILE."templates/css/ywlrtk.css";
    wjxr($lj,$b);
    return $b;
}
    
//js
function js($con) {
    global $_M;
    //返回顶部
    $h['0'] = "<div class=\"ywbtn btn-top\"></div>";
    //电话
    $h['1'] = "<div class=\"ywbtn btn-phone\"><div class=\"phone\">{$con['textjdn1']}</div></div>";
    //微信
    $url    = wjewm($con);
    $h['2'] = "<div class=\"ywbtn btn-wx\"><img class=\"pic\" src=\"{$url}\" onclick=\"return false;\"/></div>";
    //QQ客服
    $href   = is_number($con['textjdn3'])?"tencent://Message/?Uin={$con['textjdn3']}&websiteName=www.yunwang.wang=&Menu=yes":$con['textjdn3'];
    $h['3'] = "<a href=\"{$href}\" class=\"ywbtn btn-qq\"></a>";
    //新浪微博
    $h['4'] = "<a href=\"{$con['textjdn4']}\" class=\"ywbtn btn-xl\" target=\"_blank\"></a>";
    //腾讯微博
    $h['5'] = "<a href=\"{$con['textjdn5']}\" class=\"ywbtn btn-tx\" target=\"_blank\"></a>";

    //组件选中数组
    $checkbox   = explode('|',$con['checkbox']);
    foreach ($checkbox as $k => $v) {
        $b[$v]  .=  $h[$v];
    }
    //输出排序
    $orderlist   = explode(',',$con['orderlist']);
    foreach ($orderlist as $k => $v) {
        $list  .=  $b[$v];
    }
    $htnl   = "<div id=\"izl_rmenu\" class=\"yun-izl-rmenu\">".$list."</div>";
    $html   = addslashes($htnl);
    //基础
    $a      = "$(function(){
                var tophtml=\"".$html."\";
                $(\"body\").after(tophtml);
                $(\"#izl_rmenu\").each(function(){
                    $(this).find(\".btn-wx\").mouseenter(function(){
                        $(this).find(\".pic\").fadeIn(\"fast\");
                    });
                    $(this).find(\".btn-wx\").mouseleave(function(){
                        $(this).find(\".pic\").fadeOut(\"fast\");
                    });
                    $(this).find(\".btn-phone\").mouseenter(function(){
                        $(this).find(\".phone\").fadeIn(\"fast\");
                    });
                    $(this).find(\".btn-phone\").mouseleave(function(){
                        $(this).find(\".phone\").fadeOut(\"fast\");
                    });
                    $(this).find(\".btn-top\").click(function(){
                        $(\"html, body\").animate({
                            \"scroll-top\":0
                        },\"fast\");
                    });
                });
                var lastRmenuStatus=false;
                $(window).scroll(function(){//bug
                    var _top=$(window).scrollTop();
                    if(_top>200){
                        $(\"#izl_rmenu\").data(\"expanded\",true);
                    }else{
                        $(\"#izl_rmenu\").data(\"expanded\",false);
                    }
                    if($(\"#izl_rmenu\").data(\"expanded\")!=lastRmenuStatus){
                        lastRmenuStatus=$(\"#izl_rmenu\").data(\"expanded\");
                        if(lastRmenuStatus){
                            $(\"#izl_rmenu .btn-top\").slideDown();
                        }else{
                            $(\"#izl_rmenu .btn-top\").slideUp();
                        }
                    }
                });
            });
        ";
    $lj     = PATH_OWN_FILE."templates/js/ywlrtk.js";
    wjxr($lj,$a);
    return $a;
}

//写入文件
function wjxr($lj,$nr) {
    global $_M;
    $myfile = fopen("{$lj}", "w");
    fwrite($myfile, $nr);
    fclose($myfile);
    return $a;
}
//微信二维码
function wjewm($con){
    global $_M;
    $thumb = load::sys_class('thumb', 'new');
    $thumb->set('thumb_width',$con['wxwzk']);
    $thumb->set('thumb_height',$con['wxwzh']);
    $thumb->set('thumb_kind', 1);
    $return_thumb = $thumb->createthumb($con['textjdn2']);
    $textjdn2   = $return_thumb['error'] == 0?$return_thumb['path']:$con['textjdn2'];
    $site   = explode('../',$textjdn2);
    $site   = $site['1'];
    $url    = $_M[url][site].$site;
    return $url;
}
?>