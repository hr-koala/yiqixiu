<?php

defined('IN_MET') or exit('No permission');

load::sys_class('web');
load::own_class('cloud');

//后台管理类
class appweb extends web{

    //应用文件名
    public $m_name    = M_NAME;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        self::doconfig('doywt,doywc');
        cloud::tablejqcss();
    }
    
    //公共
    public function doconfig($str = '') {
        $arr    = explode(",",$str);
        foreach ($arr as $val) {
            cloud::$val();
        }
    }

}

?>