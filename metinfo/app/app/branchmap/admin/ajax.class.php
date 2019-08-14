<?php

defined('IN_MET') or exit('No permission');

load::own_class('appadmin');

/*
 * 配置
 * 包含其他功能初始化
 */
class ajax extends appadmin {
    
    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
    }

    //API密钥填写页初始化
    public function doindex(){
        global $_M,$_YW;
        $id = $_M['form']['id'] == ''?0:$_M['form']['id'];
        
        $where = "where id != '{$id}' AND lang = '{$_M['lang']}' ";
        $where .= " AND province= '{$_M['form']['province']}' ";
        $where .= " AND city= '{$_M['form']['city']}' ";
        $where .= " AND district= '{$_M['form']['district']}'";
        
        $query      = "SELECT id,lnglat FROM {$_YW['k']['detailed']}  {$where}";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $arr[$val['id']]    = $val['lnglat'];
        }
        echo jsoncallback($arr);
    }
    
    //own.JS lang语言数组调用
    public function doajaxcl() {
        global $_M,$_YW;
        parent::doconfig('dono');
        echo jsoncallback($_YW);
    }
    
}

?>