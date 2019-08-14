<?php

defined('IN_MET') or exit('No permission');

load::sys_class('web');
load::own_class('cloud');

//后台管理类
class fwweb extends web{

    public $frequency = FALSE;      //查询频率
    public $recordmode = array();      //查询记录返回数组


    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        //会先执行插件，这里的方法只是补充作用
        if(!is_arrempty($_YW)) self::doconfig('doywt,doywc,dono');
    }
    
    //公共
    public function doconfig($str = '') {
        $arr    = explode(",",$str);
        foreach ($arr as $val) {
            cloud::$val();
        }
    }
    
    //修改表数据
    public function amendsql($sqlk,$field,$where) {
        global $_M;
        DB::query("UPDATE {$sqlk} SET {$field} WHERE {$where} ");
    }
    
    //新增表数据
    public function addsql($sqlk,$field) {
        global $_M;
        DB::query("INSERT INTO {$sqlk} SET {$field}");
    }
    
    //URL
    public function weburl() {
        global $_M,$_YW;
        $mode   = is_mobile_client()?2:1;
        return $_M['url']['site'].$_YW['c']['column']['foldername'].'/code.php?lang='.$_M['lang'].'&a=do'.$_YW['c']['template'];
    }
    
    //URL
    public function webajaxurl($id) {
        global $_M,$_YW;
        return $_M['url']['site'].$_YW['c']['column']['foldername'].'/code.php?lang='.$_M['lang'].'&a=doipajax&id='.$id.'&time='.time();
    }
    
    //info
    public function errorinfo($info) {
        global $_M,$_YW;
        if($_YW['c']['css'] && $_YW['c']['template'] == 'table'){
            echo '<strong><font color="#ff0000" ;="">'.$info.'</font></strong>';
            exit;
        }else{
            cloud::scriptgo($info);
        }
    }
    
    /*
     * 计算两个时间戳之间相差的日时分秒
     * $begin_time 开始时间戳
     * $end_time 结束时间戳
     * $timediff    相差秒
     */
    public function timediff($begin_time,$end_time){
        if($begin_time < $end_time){
            $starttime = $begin_time;
            $endtime = $end_time;
        }else{
            $starttime = $end_time;
            $endtime = $begin_time;
        }

        //计算天数
        $timediff = $endtime-$starttime;
//        $days = intval($timediff/86400);
//        //计算小时数
//        $remain = $timediff%86400;
//        $hours = intval($remain/3600);
////        //计算分钟数
//        $remain = $remain%3600;
//        $mins = intval($remain/60);
////        //计算秒数
//        $secs = $remain%60;
//        $res = array("day" => $days,"hour" => $hours,"min" => $mins,"sec" => $secs);
        return $timediff;
    }
    
    //检测查询频率
    public function frequency($code_id) {
        global $_M,$_YW;
        $ip         = cloud::_get_client_ip();
        $mode       = self::mode();
        $query  = "select time from {$_YW['k']['record']} where code_id = '{$code_id}' AND ip = '{$ip}' AND mode='{$mode}' AND lang = '{$_M['lang']}' ";
        $diff   = DB::get_one($query);
        //一个小时内只做一次记录
        if(self::timediff($diff['time'], time()) > 3600 || $diff == FALSE){
            $this->recordmode = array(
                'ip'        => $ip,
                'mode'      => $mode,
                'code_id'   => $code_id,
                );
            $this->frequency  = TRUE;
        }
    }


    //查询类型
    public function mode() {
        global $_M;
        $mode   = '';
        switch ($_M['form']['a']) {
            case 'doqrcode':
                $mode = '0';
                break;
            case 'dotable':
            case 'dosection':
                $mode   = is_mobile_client()?2:1;
                break;
            case 'doweixin':
                $mode = 3;
                break;

            default:
                break;
        }
        return $mode;
    }
    
    public function webqcodewechaterror() {
        global $_M,$_YW;
        $num    = $_M['form']['a'] == 'doqrcode'?1:2;
        if(cloud::qcodewechat($num) == FALSE){
            $error  = $num == 1?$_YW['t']['yw132']:$_YW['t']['yw134'];
            echo $error;
            exit;
        }
    }


    //二维码，微信查询功能验证
    public function webqcodewechat($num) {
        global $_M,$_YW;
        if(cloud::qcodewechat($num) == FALSE){
            if($num == 1){
                echo $_YW['t']['yw132']; 
            }else{
                //微信
                $resultStr = array (
                    'type' => 'text',
                    'text' => urlencode($_YW['t']['yw134'])
                );
                echo json_encode($resultStr);
            }
            exit;
        }
        
    }

}

?>