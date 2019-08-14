<?php

defined('IN_MET') or exit('No permission');

//公共配置类
class cloud{

    //获取完整数据库
    public function dosqlk() {
        global $_M,$_YW;
        $_YW['n']   = M_NAME;
        $tablename = array('code','info','list','parameter','plist','record');
        foreach ($tablename as $val) {
            $_YW['k'][$val] = $_M['table'][$_YW['n'].'_'.$val];
        }
    }
    
    //后台导航
    public function donav() {
        global $_M,$_YW;
        return array(
            nav::set_nav(0, $_YW['t']['yw170'], $_M['url']['own_name'] . 'c=index&a=doindex'),
            nav::set_nav(10, $_YW['t']['yw001'], $_M['url']['own_name'] . 'c=table_on&a=docode&recycle=1'),
            nav::set_nav(20, $_YW['t']['yw175'], $_M['url']['own_name'] . 'c=table_on&a=doinfo&recycle=1'),
            nav::set_nav(90, $_YW['t']['yw003'], $_M['url']['own_name'] . 'c=table_on&a=docode&recycle=0'),
            nav::set_nav(100, $_YW['t']['yw002'], $_M['url']['own_name'] . 'c=config&a=doadmin'),
            
        );
    }
    
    //栏目信息
    public function dono() {
        global $_M,$_YW;
        $query = "SELECT no FROM {$_M['table']['applist']} WHERE m_name='{$_YW['n']}' ";
        $no = DB::get_one($query);
        $_YW['no']  = $no['no'];
        $query = "SELECT * FROM {$_M['table']['column']} WHERE module='{$no['no']}' AND lang='{$_M['lang']}' ";
        $_YW['c']['column'] = DB::get_one($query);
    }

    //配置信息
    public function doywc($lang = ''){
        global $_M,$_YW;
        if($lang == '') $lang = $_M['lang'];
        $query = "select name,value from {$_M['table']['cloud_config']} where m_name = '{$_YW['n']}' AND (lang = '{$lang}' OR lang='cloud') ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $_YW['c'][$val['name']] = $val['value'];
        }
    }
    
    //语言文字
    public function doywt(){
        global $_M,$_YW;
        self::dosqlk();
        $file   = PATH_APP_FILE.'lang/'.$_M['lang'].'.php';
        if(!file_exists($file)){
            $file   = PATH_APP_FILE.'lang/cn.php';
        }
        require_once($file);
    }
    
    //二级导航
    public function dosidebar() {
        global $_M,$_YW;
        $sidebar    = array(
            'admin'  => array(
                'admin'     =>  array('0' => $_M['url']['own_name'].'c=config&a=doadmin','1' => $_YW['t']['yw070']),
                'code'      =>  array('0' => $_M['url']['own_name'].'c=config&a=docode','1' => $_YW['t']['yw171']),
            ),
            'web'  => array(
                'web'       =>  array('0' => $_M['url']['own_name'].'c=config&a=doweb','1' => $_YW['t']['yw070']),
//                'template'  =>  array('0' => $_M['url']['own_name'].'c=config&a=dotemplate','1' => '模板'),
                'table'     =>  array('0' => $_M['url']['own_name'].'c=config&a=dotable','1' => $_YW['t']['yw264']),
                'section'   =>  array('0' => $_M['url']['own_name'].'c=config&a=dosection','1' => $_YW['t']['yw265']),
            ),
        );
        
        
        $this->nav   =   '<div class="panel panel-info ">';
        if(is_arrempty($sidebar['admin'])){
            $this->nav   .=   '<div class="panel-heading">
                        <h3 class="panel-title">'.$_YW['t']['yw070'].'</h3></div><div class="panel-body">';
            $this->nav   .=   Anav($sidebar['admin'],  $this->navsign);
        }

        if(is_arrempty($sidebar['web'])){
            $this->nav   .=  '<div class="panel-heading twoh3">
                        <h3 class="panel-title">'.$_YW['t']['yw071'].'</h3></div><div class="panel-body">';
            $this->nav   .=   Anav($sidebar['web'],$this->navsign);
        }
        $this->nav   .=   '</div>';
    }

    /*
     * 防伪码，商品编号查询
     * @param   $field  获取防伪码 code
     * @param   $w  获取商品编号 num 
     * 
     */
    public function codenum($field = 'code',$w = '') {
        global $_M,$_YW;
        $sqlk   = $_YW['k'][$field];
        if($field != 'code'){
            $sqlk   = $_YW['k']['info'];
            $where = " lang = '{$_M['lang']}' ";
            if($w){
                $where .= " AND ";
            }
        }

        if($w){
            $where .= " {$field} = '{$w}' ";
        }
        
        $sql    = "select {$field} from {$sqlk} where {$where} ORDER BY id desc";
        $info   = DB::get_one($sql);
        if($info != false){
            $info = $info[$field];
        }
        return $info;
    }

    //防伪码分隔符
    public function space() {
        global $_YW;
        $space  = array('','  ','-');
        return $space[$_YW['c']['space']];
    }
    
    //判断字符类型,是否只包含字符或者数字
    public function match($str) {
        global $_M,$_YW;
        /*
        * ctype_alnum(string $text)：//检查是否是字母或数字或字母数字的 组合
        * ctype_alpha(string $text)：check for alphabetic character(s) //检查字符串是否是字母
        * ctype_cntrl(string $text)：check for control character(s) //是否是控制字符如\n,\r,\t
        * ctype_digit(strint $text)：check for numeric character(s) //是否是数字表示的字符
        * ctype_graph(string $text)：Check for any printable character(s) except space //检查是否有任何可打印字符，除了空格（补）
        * ctype_lower()：check for lowercase character(s)//检查是否是小写字母
        * ctype_upper()：check for uppercase character(s)//检查是否是大写字母
        */
        $str    = str_replace(self::space(),"",$str);
        return ctype_alnum($str);
    }

    /*
     * 防伪码的效验
     * @param $code 防伪码
     */
    public function ckspace($code) {
        global $_YW;
        if($_YW['c']['olddata']) return true;
        $open   = stringto_array($_YW['c']['open'],'|');
        if($_YW['c']['space'] == 0){
            $length = 0;
            foreach ($open as $val) {
                $length   += $_YW['c']['fwlength_'.$val];
            }
            if(strlen($code) != $length) return false;
        }else{
            $arr    = stringto_array($code,self::space());
            if(count($arr) != count($open)) return false;
            foreach ($open as $key => $val) {
                if(strlen($arr[$key]) != $_YW['c']['fwlength_'.$val]) return false;
            }
        }
        
        return true;
    }
    
    /*
     * 格式校验前对防伪码格式化容错最高
     * $code    防伪码字符串
     */
    public function codeformatting($code) {
        global $_M,$_YW;
        if($_YW['c']['olddata']) return self::strFilter($code);
//        if($_YW['c']['space'] != 1) return $code;
        $str = str_replace(array(" ", " "," ","	","-","—",'_'), "", $code);
        $length = $fwlength = 0;
        $fwstr  = array();
        foreach (stringto_array($_YW['c']['open'],'|') as $key => $val) {
            $fwlength   = $_YW['c']['fwlength_'.$val];
            $fwstr[]  = strcut($str, $length,$fwlength);
            $length += $fwlength;
        }
        if(strlen($str) == $length) $str  = arrayto_string($fwstr,self::space());
        return $str;
    }
    
    //过滤特殊字符
    public function strFilter($str){
        $str = str_replace('`', '', $str);
        $str = str_replace('·', '', $str);
        $str = str_replace('~', '', $str);
        $str = str_replace('!', '', $str);
        $str = str_replace('！', '', $str);
        $str = str_replace('@', '', $str);
        $str = str_replace('#', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('￥', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('……', '', $str);
        $str = str_replace('&', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('(', '', $str);
        $str = str_replace(')', '', $str);
        $str = str_replace('（', '', $str);
        $str = str_replace('）', '', $str);
        $str = str_replace('-', '', $str);
        $str = str_replace('_', '', $str);
        $str = str_replace('——', '', $str);
        $str = str_replace('+', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('【', '', $str);
        $str = str_replace('】', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace(';', '', $str);
        $str = str_replace('；', '', $str);
        $str = str_replace(':', '', $str);
        $str = str_replace('：', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('“', '', $str);
        $str = str_replace('”', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace('，', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('《', '', $str);
        $str = str_replace('》', '', $str);
        $str = str_replace('.', '', $str);
        $str = str_replace('。', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('、', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('？', '', $str);
        return trim($str);
    }

    /*
     * 防伪码格式以及值的有效性
     * @param   $code   防伪码
     */
    public function ckcode($code) {
        global $_YW;
        $arr    = array();
        if(self::ckspace($code)){
            if(self::codenum('code',$code) == false){
                $arr['ck']  = 1;
                $arr['info']  = $_YW['t']['yw049'];
            }else{
                $arr['ck']  = 0;
                $arr['info']  = $_YW['t']['yw050'];
            }
        } else {
            $arr['ck']  = 2;
            $arr['info']  = $_YW['t']['yw051'];
        }
        return $arr;
    }
    
    /*
     * 删除数组键值，注销多个值用,分割
     * $arr     原数组
     * $ys      需要删除的数组键值字符串多个值使用,分割
     */
    public function delkey($arr,$ys) {
        global $_M;
        $zfc    = explode(',',$ys);
        foreach ($zfc as $k => $v) {
            if(array_key_exists($v,$arr)){
                unset($arr[$v]);//注销
            }
        }
        return $arr;
    }
    
    //单条配置语句入库
    public function addconsql($name, $val = '') {
        global $_M,$_YW;
        DB::query("INSERT INTO {$_M['table']['cloud_config']} (name,lang,m_name,value) VALUES ('{$name}','{$_M['lang']}','{$_YW['n']}','{$val}') ON DUPLICATE KEY UPDATE value='{$val}' ");
    }
    
    //信息JQ弹出并刷新当前页面
    public function scriptgo($info) {
        global $_M;
        echo "<script>alert('{$info}');history.go(-1);</script>";
        exit(0);
    }
    
    //微信错误
    public function wechaterror($info) {
        global $_M;
        $resultStr = array (
            'type' => 'text',
            'text' => urlencode($info)
        );
        echo json_encode($resultStr);
        exit;
    }
    
    //写入文件
    public function writefile($lj,$text) {
        global $_M;
        $myfile = fopen("{$lj}", "w");
        fwrite($myfile, $text);
        fclose($myfile);
    }
    
    //二维码内容
    public function qrcodeinfo($code = '') {
        global $_M,$_YW;
        //读取栏目数据
        self::dono();
        return $_M['url']['site'].$_YW['c']['column']['foldername'].'/code.php?a=doqrcode&code='.rawurlencode($code);
    }

    #二维码和微信功能开启
    public function qcodewechat($num) {
        global $_M,$_YW;
        return in_array($num, stringto_array($_YW['c']['additional'],'|'));
    }
    
    #微信内容
    public function wechaturl($code = '') {
        global $_M,$_YW;
        //读取栏目数据
        self::dono();
        return $_M['url']['site'].$_YW['c']['column']['foldername'].'/code.php?a=doweixin&code='.rawurlencode($code);
    }
    
    #图片地址
    public function imgexplode($picurl = '') {
        global $_M,$_YW;
        if($picurl == '') return '';
        $img    = explode('../',$picurl);
        return $_M['url']['site'].$img[1];
    }
    
    //jq、css
    public function tablejqcss() {
        global $_M,$_YW;
        $scolor     = $_YW['c']['scolor'];
        $hrscolor   = $_YW['c']['hoverscolor'];
        if(!$_YW['c']['sstopjl']) $_YW['c']['sstopjl'] = 0;
        switch ($_YW['c']['template']) {
            case 'table':
                $ssbjt  = explode('../',$_YW['c']['ssbjt']);
                $style  = $_YW['c']['ssbjt']?"background:{$_YW['c']['color']} url({$_M['url']['site']}{$ssbjt[1]}) no-repeat center center":"background:{$_YW['c']['color']}";
                $css    = '
                    div.yun_fwyz{ 
                        width:100%; padding:15px; overflow: hidden;
                        box-sizing:border-box; -moz-box-sizing:border-box; /* Firefox */ -webkit-box-sizing:border-box; /* Safari */ 
                        padding:'.$_YW['c']['sstopjl'].'px 15px; '.$style.'
                    }
                    div.yun_fwyz h2{
                        text-align:center; padding-bottom:80px;  font-size: 26px;  font-weight: bold;  letter-spacing: 8px;
                    }
                    div.yun_fwyz .yy_bottom{
                        width: 332px; text-align:left; padding-top:15px; margin:0 auto;;
                    }

                    div.yun_fwyz .yy_v52fmbx {
                        width: 332px; height:34px; overflow: hidden; z-index: 1; margin:0 auto; 
                    }
                    div.yun_fwyz .yy_v52fmbx .yy_srfwm {
                        padding:0px 5px; width:220px; height:34px; line-height:28px;  
                        border: 1px solid #CCC; background: #FFF; z-index: 999;  float:left; color: #333; outline: none;
                    }
                    div.yun_fwyz .yy_v52fmbx .yy_submit {
                        background:'.$scolor.'; width:100px; height:34px; line-height: 26px;  
                        text-align:center; padding-left: 5px; cursor: pointer; border: 1px solid '.$scolor.'; float:right;
                        outline: none; color: #fff; letter-spacing:5px; 
                        box-sizing:border-box; -moz-box-sizing:border-box; /* Firefox */ -webkit-box-sizing:border-box; /* Safari */ 
                    }
                    div.yun_fwyz .yy_v52fmbx .yy_submit:hover{
                        border: 1px solid '.$hrscolor.'; background:'.$hrscolor.';
                    }
                    div.yun_fwyz .yy_v52fmbx .yy_srfwm:hover{
                        border: 1px solid '.$hrscolor.';
                    }
                    ';
                break;
            case 'section':
                $s_logo     = explode('../',$_YW['c']['s_logo']);
                $s_width    = is_number($_YW['c']['s_width'])?$_YW['c']['s_width'].'px':$_YW['c']['s_width'];
                $css    = '
                    div.yun_fwyz .yun_section{background:'.$_YW['c']['color'].';}
                    div.yun_fwyz .colmd h2{ 
                        margin: 0; line-height: 78px; font-size: 20px; color: #424242; font-weight: normal;     border-bottom: 1px solid #e0e0e0;
                    }
                    div.yun_fwyz .colmd h3 {
                        font-size: 18px; color: #616161; font-weight: normal;
                    }
                    div.yun_fwyz .section_z{padding:0px 40px; }
                    input.yun_input{outline: 0;}
                    div.yun_fwyz .section_info .yun_input{ 
                        width: 100px; padding: 10px 5px; border: 1px solid #e0e0e0; font-size: 14px; line-height: 18px; 
                        background: #fff; -webkit-transition: border-color .2s linear; transition: border-color .2s linear; 
                        margin: 0; vertical-align: baseline; float: left;  margin-right: 10px; margin-top:15px;
                    }
                    div.yun_fwyz .section_info .yun_input:hover{border-color: #b0b0b0;}
                    div.yun_fwyz .section_info input.yun_input:focus{ border-color: '.$hrscolor.';}

                    div.yun_fwyz button{width: 160px; height: 40px; background: '.$scolor.'; border-color: '.$scolor.';}
                    div.yun_fwyz button:hover{background-color:'.$hrscolor.'; border-color: '.$hrscolor.';}

                    div.yun_fwyz .section_y{padding:0px 20px;}
                    div.yun_fwyz .section_y .section_yinfo{padding:10px 0px;}
                    
                    @media (min-width: 970px) {
                        div.yun_fwyz{
                            max-width:'.$s_width.'; margin:0 auto; padding:'.$_YW['c']['sstopjl'].'px 0px; overflow: hidden;
                        }
                        
                        div.yun_fwyz .section_info .yun_input{padding: 10px 16px;}
                        
                        div.yun_fwyz .section_z .section_info{
                            padding: 40px 20px 0px 210px; 
                            background: url('.$_M['url']['site'].$s_logo[1].') no-repeat 50px 50px;
                            overflow: hidden;
                        }

                        div.yun_fwyz .form-section{ margin-bottom:20px; overflow: hidden;}
                    }
                    @media (max-width: 970px) {
                        div.yun_fwyz{
                            margin:0 auto; padding-bottom:20px; overflow: hidden;
                        }
                        div.yun_fwyz .colmd{margin-top:20px;}
                        
                        div.yun_fwyz .section_z .section_info{
                            padding: 10px 0px; overflow: hidden;
                        }
                        div.yun_fwyz .form-section{margin: 0 auto; margin-bottom:20px; overflow: hidden;}
                    }
                    ';
                
                $_YW['c']['cxwidth']    = $_YW['c']['s_width'];
                break;
            default:
                break;
        }

        //详情页
        if((!$_YW['c']['css'] && $_YW['c']['template'] == 'table') || $_YW['c']['template'] != 'table' || $_M['form']['a'] == 'doqrcode' || $_M['form']['a'] == 'doweixin'){
            $width  = is_number($_YW['c']['cxwidth'])?$_YW['c']['cxwidth'].'px':$_YW['c']['cxwidth'];
            $css    .= '
                    .yun_table_info{
                        width:'.$width.'; overflow: hidden; margin:0 auto; padding:20px 0px; background: #ffffff;
                        box-sizing:border-box; -moz-box-sizing:border-box; /* Firefox */ -webkit-box-sizing:border-box; /* Safari */
                    }
                    .yun_fwyz_info{padding:0px 10px;}
                    .yun_table_info h3{
                        text-align:center; padding: 10px 0px; font-size:16px; letter-spacing: 15px;  margin: 0px;
                        background:'.$_YW['c']['cxcolor'].'; color:'.$_YW['c']['cxcolor5'].';
                    }
                    .yun_table_info .yun_table_div{padding:15px; line-height: 26px; margin:0 auto; overflow: hidden;}
                    .yun_table_info .table{margin-bottom:0px;}
                    .yun_table_info th{text-align: center;}';
        }
        
        if($_YW['c']['webstyle']){
            if($_YW['c']['bodyimg']) {
                $bodyimg    = explode('../',$_YW['c']['bodyimg']);
                $repeat     = array('repeat','repeat-x','repeat-y','no-repeat');
                $css .= 'body{background:'.$_YW['c']['bodycolor'].' url('.$_M['url']['site'].$bodyimg[1].') '.$repeat[$_YW['c']['bodyrepeat']].' center center;}';
            }else{
                $css    .= 'body{background:'.$_YW['c']['bodycolor'].';}';
            }
            
        }
        
        //DIY CSS
        $diycss = array(
          'table'           => $_YW['c']['t_css'], 
          'section'         => $_YW['c']['s_css'], 
        );
        
        $css    .=  $diycss[$_YW['c']['template']];
        
//        $css    = str_replace(array("\r\n", "\r", "\n", "\t"), "", $css);
        cloud::writefile(PATH_APP_FILE.'web/templates/css/fwyz.css',$css);
    }
    
    //获取IP 穿透CDN
    public function _get_client_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
                foreach ($matches[0] AS $xip) {
                        if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                                $ip = $xip;
                                break;
                        }
                }
        } elseif(isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        return $ip;
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