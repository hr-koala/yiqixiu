<?php

defined('IN_MET') or exit('No permission');

//侧栏导航
function Anav($nav,$on) {
    foreach ($nav as $k => $v) {
        $b  = $k == $on?'on':'';
        if($v != ''){
            $a  .= '<li><a href="'.$v['0'].'" class="'.$b.'">'.$v['1'].'</a></li>';
        }
    }
    return '<ul>'.$a.'</ul></div>';
}

//获取管理员
function Agly() {
    global $_M;
    $a = admin_information();
    return $a[admin_id];
}

//时间
function Atime($s = '') {
    global $_M;
    $j  = $s == ''?'0':$s;
    $time   = array('Y-m-d','Y-m-d H:i:s','Ymd','YmdHis');
    return date($time[$j], time());
}




/*暂时保留*/


//数组变成字符串(分隔符自定义，暂时不删除兼容之前其他地方使用)
function Aarrfi($arr,$fg,$html = '') {
    global $_M;
    foreach ($arr as $k => $v) {
        if($html == ''){
            $sj .= $v.$fg;
        }  else {
            //$a = strip_tags($v);
            $b = str_replace(array("\r\n", "\r", "\n"," "), "", $v);
            $sj .= $b.$fg;
        }
    }
    $sj = rtrim($sj,$fg);
    return $sj;
}

//写入文件(支持覆盖或者不覆盖)
function Axrfile($lj,$nr,$over) {
    global $_M;
    $a = $over?'w':'a';
    load::sys_func('file');
    $lj = path_absolute($lj);
    makefile($lj,$over);
    $myfile = fopen("{$lj}", "{$a}");
    fwrite($myfile, $nr);
    fclose($myfile);
}

?>