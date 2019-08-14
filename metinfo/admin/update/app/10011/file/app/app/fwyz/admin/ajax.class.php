<?php

defined('IN_MET') or exit('No permission');

load::own_class('admin/class/fwadmin');

class ajax extends fwadmin {

    public function __construct() {
        global $_M;
        parent::__construct();
    }

    /**
     * 【ajax表单】
     * dospyz	商品编号验证
     * dofwyz	防伪号码验证，全站统一不分语言
     * doxgspyz	修改原有商品编号时验证
     * */
    public function dospyz() {
        global $_M,$_YW;
        $num = $_M['form']['num'];
        $lang = $_M['form']['lang'];
        $numy = is_number($num);
        $length = str_length($num);
        //检测商品编号是否是数字字符串，长度是否正确
        if ($numy && $length >= 10 && $length <= 15) {
            $query = "select num from {$_YW['k']['info']} where  num = '{$num}' AND lang = '{$lang}' ";
            $num = DB::get_one($query);
            if ($num == false) {
                echo "1|" . $_YW['t']['yw045'];
            } else {
                echo "0|" . $_YW['t']['yw046'];
            }
        } else {
            echo "0|" . $_YW['t']['yw047'];
        }
    }

    //修改原有商品编号时验证
    public function doxgspyz() {
        global $_M,$_YW;
        $num = $_M['form']['num'];
        $id = $_M['form']['id'];
        $lang = $_M['form']['lang'];
        $query = "select num from {$_YW['k']['info']} where  num = '{$num}' AND id = '{$id}' AND lang = '{$lang}' ";
        $qnum = DB::get_one($query);
        if ($qnum == false) {
            $numy = is_number($num);
            $length = str_length($num);
            //检测商品编号是否是数字字符串，长度是否正确
            if ($numy && $length >= 10 && $length <= 15) {
                $query = "select num from {$_YW['k']['info']} where  num = '{$num}' AND lang = '{$lang}' ";
                $num = DB::get_one($query);
                if ($num == false) {
                    echo "1|" . $_YW['t']['yw045'];
                } else {
                    echo "0|" . $_YW['t']['yw046'];
                }
            } else {
                echo "0|" . $_YW['t']['yw047'];
            }
        } else {
            echo "1|" . $_YW['t']['yw048'];
        }
    }
    
    //防伪号码验证全站统一不分语言
    public function dofwyz() {
        global $_M,$_YW;
        $_M['form']['code'] = cloud::codeformatting($_M['form']['code']);
        if(cloud::match($_M['form']['code'])){
            $code   = cloud::ckcode($_M['form']['code']);
        }else{
            $code   = array('ck' => 0, 'info' => $_YW['t']['yw051']);
        }
        
        if($code['ck'] == 1){
            echo '1|'.$code['info'];
        }else{
            echo '0|'.$code['info'];
        }
        
    }
    
    //防伪码生成
    public function dofwcode() {
        global $_M;
        echo jsoncallback($this->codemake($_M['form']['num']));
    }
    
    //二维码生成(JS)
    public function doqrcode() {
        global $_M,$_YW;
        $url    = cloud::qrcodeinfo($_M['form']['code']);
        echo $url.'&lang='.$_M['lang'];
    }
    
    //own.JS lang语言数组调用
    public function doajaxcl() {
        global $_M,$_YW;
        parent::doconfig('dono');
        echo jsoncallback($_YW);
    }
    
    
    //图表数据
    public function doecharts() {
        global $_M,$_YW;
        $array  = self::echartsconfig(self::dataday(),array(self::datamode(10),self::datamode(0),self::datamode(1),self::datamode(2),self::datamode(3) ));
        echo jsoncallback($array);
    }
    
    //获取日期
    private function dataday() {
        global $_M;
        $day    = array();
        switch ($_M['form']['addup']) {
            case 'date':
                for($i=0;$i<=30;$i++){
                    $day[] = date("Y/m/d", strtotime(' -'. $i . 'day'));
                }
                break;
            case 'week':
                for($i=0;$i<=7;$i++){
                    $day[] = date("Y/m/d", strtotime(' -'. $i . 'day'));
                }
                break;
            case 'day':
                for($i=23;$i>-1;$i--){
                    $day[] = sprintf('%02s', $i);
                }
                break;

            default:
                break;
        }

        return array_reverse($day);
    }
    
    //获取数据
    private function datamode($mode) {
        global $_M,$_YW;
        if($mode != 10) $modes = " AND mode = '{$mode}' ";
        $record = $_YW['k']['record'];
        switch ($_M['form']['addup']) {
            case 'date':    //30天内
                $query = "select from_unixtime(time,'%Y/%m/%d') time, count(*) num from `{$record}` 
                        where 
                        date_sub(curdate(), INTERVAL 30 DAY) <= from_unixtime(time,'%Y%m%d') {$modes} AND lang = '{$_M['lang']}' 
                        GROUP BY from_unixtime(time,'%Y%m%d') 
                        ORDER BY time";
                break;
            case 'week':    //7天内
                $query = "select from_unixtime(time,'%Y/%m/%d') time, count(*) num from `{$record}` 
                        where 
                        date_sub(curdate(), INTERVAL 7 DAY) <= from_unixtime(time,'%Y%m%d') {$modes} AND lang = '{$_M['lang']}' 
                        GROUP BY from_unixtime(time,'%Y%m%d') 
                        ORDER BY time";
                break;
            case 'day':     //今天
                $query = "select from_unixtime(time,'%H') time, count(*) num from `{$record}` 
                        where 
                        to_days(now()) = to_days(from_unixtime(time)) {$modes} AND lang = '{$_M['lang']}' 
                        GROUP BY from_unixtime(time,'%H') 
                        ORDER BY time";
                break;

            default:
                break;
        }

        $info   = DB::get_all($query);
        $data   = array_column($info, 'num','time');

        foreach (self::dataday() as $val) {
            $str[]  = $data[$val] != ''?$data[$val]:0;
        }
        //arrayto_string($str,',')'-'
        $name   = array($_YW['t']['yw206'],$_YW['t']['yw207'],$_YW['t']['yw208'],$_YW['t']['yw224'],10 => $_YW['t']['yw209']);
        $arr    = array(
            'type'      =>  'line',
            'name'      =>  $name[$mode],
            'data'      =>  $str,
            'smooth'    => true,
            'markPoint' =>  array(
                'data' => array(
                    array('name' => $_YW['t']['yw060'], 'type' => 'max'),array( 'name' => $_YW['t']['yw061'], 'type' => 'min')
                )
            ),
            'markLine'  =>  array(
                'data' => array(
                    array('name' => $_YW['t']['yw062'], 'type' => 'average') 
                )
            ),
        );
        return $arr;
    }
    
    //图表公用属性
    private function echartsconfig($xaxisdata,$series) {
        global $_M,$_YW;
        $subtext = array(
            'date'  => $_YW['t']['yw210'],
            'week'  => $_YW['t']['yw211'],
            'day'   => $_YW['t']['yw212'],
        );

        return array(
            'title'     =>  array('text' => $_YW['t']['yw191'], 'subtext' => $subtext[$_M['form']['addup']], 'left' => '40'),
            'legend'    =>  array('data' => array($_YW['t']['yw209'],$_YW['t']['yw206'],$_YW['t']['yw207'],$_YW['t']['yw208'],$_YW['t']['yw224'])),
            'grid'      =>  array('show' => true, 'left' => '0', 'right' => '3%', 'bottom' => '8', 'containLabel' => true),
            'xAxis'     =>  array('type' => 'category', 'boundaryGap' => false, 'axisTick' => array('interval' => 0), 'data' => $xaxisdata),
            'yAxis'     =>  array('type' => 'value', 'axisLabel' => array('formatter' => '{value} '.$_YW['t']['yw302'])),
            'tooltip'   =>  array('trigger' =>  'axis'),
            'toolbox'   =>  array(
                'show'  => true,
          
                'feature'   => array(
                    'saveAsImage'   => array('show' => true),
                    'restore'       => array('show' => true),
                    'dataView'      => array('show' => true, 'readOnly' => false),
                    'magicType'     => array('show' => true, 'type' => array('line','bar')),
                ), 
                'right' => '3%'),
            'series'    =>  $series,
        );
        
    }
    
}

?>