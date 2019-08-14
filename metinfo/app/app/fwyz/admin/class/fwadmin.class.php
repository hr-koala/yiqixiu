<?php

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::own_class('cloud');

//后台管理类
class fwadmin extends admin{
    
    /*
     * $urlc            URL上c的值
     * $urla            URL上a的值
     * $action          表单提交URL
     * $tableajax       table数据获取URL
     * $addlisturl      table新增行URL
     * backupurl        数据备份URL
     * $tname           当前数据库缩写
     * $mode            查询类型和颜色
     */
    public $urlc;
    public $urla;
    public $action;
    public $tableajax;
    public $addlisturl;
    public $tname;
    public $code    = array();
    public $modecolor   = array();

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        self::doconfig('doywt,doywc');
    }
    
    //公共
    public function doconfig($str = '') {
        $arr    = explode(",",$str);
        foreach ($arr as $val) {
            cloud::$val();
        }
    }
    
    public function urlc($c,$a) {
        $this->urlc = $c;
        $this->urla = $a;
    }
    
    //URL处理
    public function url($tname = '',$where = '') {
        global $_M;
        if($where) $where  = '&'.$where;
        if($tname){
            $this->tname    = $tname;
            $tname  = '&tname='.$this->tname;
            $urlname            = $_M['url']['own_name'].'a='.$this->urla.$tname.$where.'&';
            $this->action       = $urlname.'c='.  $this->urlc;
        }
        if($this->urlc == 'table_off'){
            $this->tableajax    = $urlname.'c=table_ajax';
            $this->addlisturl   = $_M['url']['own_name'].'c=table_ajax&a=doifai'.$tname.$where;
        }
        //备份
        $this->backupurl    = $_M['url']['own_name'].'c=table_off&a=dotable&submit_type=backups'.$where;
    }
    
    //删除表数据
    public function delsql($sqlk,$where){
        global $_M;
        DB::query("DELETE FROM {$sqlk} WHERE {$where} ");
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
    
    //生成商品编号并效验值
    public function fwnum() {
        $a  = cloud::codenum('num');
        if (!$a) {
            $a = '1000000001';
        } else {
            do{
                $a++;
            } while (cloud::codenum('num',$a) != false);
        }
        return $a;
    }
    
    /*
     * 单挑防伪码生成并效验值
     * @param   $code['code'] 不带分隔符
     * @param   $code['space'] 带分隔符
     */
    public function fwcode() {
        global $_M,$_YW;
        do {
            $code   =  self::newcode();
        } while (cloud::codenum('code',$code['space']) != false);
        return $code['space'];
    }
    
    /*
     * 生成防伪码
     * @param   $space  带分隔符
     * @param   $code   不带分隔符
     */
    public function newcode() {
        global $_M,$_YW;
        $open   = stringto_array($_YW['c']['open'],'|');
        foreach ($open as $val){
            $length = $_YW['c']['fwlength_'.$val] - strlen($_YW['c']['fwqian_'.$val]) - strlen($_YW['c']['fwhou_'.$val]);
            $code    = self::random($_YW['c']['fwqian_'.$val],$_YW['c']['fwhou_'.$val],$length,$_YW['c']['fwtype_'.$val]);
            if(strlen($code) > $_YW['c']['fwlength_'.$val])$code   = strcut($code,0,$_YW['c']['fwlength_'.$val]);
            $space  .= $code;
            $fwcode .= $code;
            if(end($open) != $val){
                $space   .= cloud::space();
            }
        }
        return array('code' => $fwcode, 'space' => $space);
    }
    
    /*
     * 生成随机数
     * $prefix      前缀
     * $prefih      后缀
     * $length      长度
     * $type        类型
     */
    private function random($prefix,$prefih,$length,$type) {
        global $_M,$_YW;
        //随机生成
        $str    = random($length,$type);
        mt_srand((double)microtime()*1000000);
        switch (mt_rand(0,3)) {
            # 重新生成
            case 0:
                $str    = random($length,$type);
                break;
            # 字符串翻转
            case 1:
                $str    = strrev($str);
                break;
            # 随机打乱
            case 2:
                $str    = str_shuffle($str);
                break;
            default:
                break;
        }
        return $prefix.$str.$prefih;
    }

    //批量生成防伪码生成
    public function codemake($num = '') {
        global $_M,$_YW;
        if($num == '') $num = $_YW['c']['fwmakenum'];
        $i = $count = 0;
        #方法1：必须满足个数，若是没有新的值可用时，容易出现问题
        while ($count < $num){
            $code[$i] = self::batchmakecode();
            $this->code[]   = $code[$i];
            $i++;
            $count = count($this->code);
        }
        
        //方法二：只满足循环次数
//        for ($i=0;$i<$num;$i++){
//            $code[$i] = self::batchmakecode();
//            $this->code[]   = $code[$i];
//        }
        return $code;
    }
    
    //防伪码批量生成，代码优化
    private function batchmakecode() {
        do {
            $code   =  self::coderandom();
        } while (cloud::codenum('code',$code['space']) != false);
        return $code['space'];
    }


    //防伪码生成,并效验生成防伪码是否重复
    private function coderandom() {
        $code    = self::newcode();
        if(in_array($code['space'],  $this->code)){
            $code    = self::coderandom();
        }
        return $code;
    }
    
    //防伪码录入[一直是新增]
    public function addcodesql($form,$id){
        global $_M,$_YW;
        $i  = 0;
        $code   = stringto_array($form['code'],'$$$$');
        foreach ($code as $key => $val) {
            $val    = cloud::codeformatting($val);
            $ck = cloud::ckcode($val);
            if($ck['ck'] == 1){
                $field[]   = "('{$val}','{$id}','{$form['lang']}')";
            }
            $i++;
            if($i >= 500 || $key == count($code) -1 ){
                $i  = 0;
                $str    = arrayto_string($field,',');
                DB::query("INSERT INTO {$_YW['k']['code']} (code,info_id,lang) values {$str} ");
                $field    = array();
            }
        }
    }
    
    //删除指定文件
    public function delfile($file){
        global $_M;
        load::sys_func('file');
        $li = path_absolute($file);
        delfile($li);
    }
    
    //查询类型文字和颜色
    public function modecolor() {
        global $_M,$_YW;
        $this->modecolor =  array(
            'mode'  => array($_YW['t']['yw206'],$_YW['t']['yw207'], $_YW['t']['yw208'], $_YW['t']['yw224']),
            'color' => array('#FF0000','#FF7400','#CD0074','#00CC00')
        );
        return $this->modecolor;
    }

}

?>