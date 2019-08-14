<?php

defined('IN_MET') or exit('No permission');

//公共配置类
class cloud{

    #获取完整数据库
    public function dosqlk() {
        global $_M,$_YW;
        $_YW['n']   = M_NAME;
        $tablename = array('detailed');
        foreach ($tablename as $val) {
            $_YW['k'][$val] = $_M['table'][$_YW['n'].'_'.$val];
        }
    }
    
    #后台导航
    public function donav() {
        global $_M,$_YW;
        return array(
            nav::set_nav(0, $_YW['t']['yw041'], $_M['url']['own_name'] . 'c=table_on&a=dodetailed'),
            nav::set_nav(99, $_YW['t']['yw042'], $_M['url']['own_name'] . 'c=config&a=doindex'),
        );
    }
    
    #栏目信息
    public function dono() {
        global $_M,$_YW;
        $query = "SELECT no FROM {$_M['table']['applist']} WHERE m_name='{$_YW['n']}' ";
        $no = DB::get_one($query);
        $_YW['no']  = $no['no'];
        $query = "SELECT * FROM {$_M['table']['column']} WHERE module='{$no['no']}' AND lang='{$_M['lang']}' ";
        $_YW['c']['column'] = DB::get_one($query);
    }

    #配置信息
    public function doywc($lang = ''){
        global $_M,$_YW;
        if($lang == '') $lang = $_M['lang'];
        $query = "select name,value from {$_M['table']['cloud_config']} where m_name = '{$_YW['n']}' AND lang = '{$lang}' ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $_YW['c'][$val['name']] = $val['value'];
        }
    }
    
    #语言文字
    public function doywt(){
        global $_M,$_YW;
        self::dosqlk();
        $file   = PATH_APP_FILE.'lang/'.$_M['lang'].'.php';
        if(!file_exists($file)){
            $file   = PATH_APP_FILE.'lang/cn.php';
        }
        
        require_once($file);
    }
    
    //写入文件
    public function writefile($lj,$text) {
        global $_M;
        $myfile = fopen("{$lj}", "w");
        fwrite($myfile, $text);
        fclose($myfile);
    }
    
    //jq、css
    public function tablejqcss() {
        global $_M,$_YW;
        $maxwidth = '';
        if($_YW['c']['radio'] == 2) $maxwidth   = is_number($_YW['c']['maxwidth'])?'max-width:'.$_YW['c']['maxwidth'].'px;':'max-width:'.$_YW['c']['maxwidth'].';';
        $css    = '
                    .yunwang-metinfo .yunbranchmap{'.$maxwidth.' margin:30px auto; border-radius: 6px;}

                    .yunwang-metinfo .yunbranchmap .panel-heading{padding: 5px 10px;}
                    .yunwang-metinfo .yunbranchmap .mapinputselect .control-label:nth-child(5){margin-left: 30px;}

                    .yunwang-metinfo .yunbranchmap .namelist{padding-right: 0px; padding-left: 0px;}
                    .yunwang-metinfo .yunbranchmap .namelist .listgroup{height: 520px; overflow-y: auto; padding: 0px 15px;}
                    .yunwang-metinfo .yunbranchmap .panel{margin-bottom: 0px;}

                    .yunwang-metinfo .yunbranchmap #allmap{width:100%;height:520px; background: none;}
                    .yunwang-metinfo .yunbranchmap #allmap p{margin: 0 0 2px;}
                    .yunwang-metinfo .yunbranchmap .BMap_pop div:nth-child(1) div:nth-child(1){border-radius:6px 0 0 0;}
                    .yunwang-metinfo .yunbranchmap .BMap_pop div:nth-child(3) div:nth-child(1){border-radius:0 6px 0 0;}
                    .yunwang-metinfo .yunbranchmap .BMap_pop div:nth-child(5) div:nth-child(1){border-radius:0 0 0 6px;}
                    .yunwang-metinfo .yunbranchmap .BMap_pop div:nth-child(7) div:nth-child(1){border-radius:0 0 6px 0;}
                ';
                
        $css    .= $_YW['c']['diycss'];
        cloud::writefile(PATH_APP_FILE.'web/templates/css/'.$_YW['n'].'.css',$css);
    }
    
}

//兼容函数array_column
if (!function_exists('array_column')) {
    function array_column($input, $columnKey, $indexKey = NULL) {
        $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
        $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
        $result = array();
        foreach ((array) $input AS $key => $row) {
            if ($columnKeyIsNumber) {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
            } else {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
            }
            if (!$indexKeyIsNull) {
                if ($indexKeyIsNumber) {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && !empty($key)) ? current($key) : NULL;
                    $key = is_null($key) ? 0 : $key;
                } else {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }
            $result[$key] = $tmp;
        }
        return $result;
    }
}

//访问端检测
if (!function_exists('is_mobile_client')) {
    function is_mobile_client() {
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        $uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
        if (($ua != '' && preg_match($uachar, $ua))) {
            return true;
        } else {
            return false;
        }
    }
};
?>