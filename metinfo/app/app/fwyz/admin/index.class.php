<?php

defined('IN_MET') or exit('No permission');

load::own_class('admin/class/fwadmin');

class index extends fwadmin {
    
    public function __construct() {
        global $_M;
        parent::__construct();
        parent::doconfig('donav');
    }

    //管理列表初始化
    public function doindex() {
        global $_M,$_YW;
        $record = $_YW['k']['record'];
        $code   = $_YW['k']['code'];
        $info   = $_YW['k']['info'];
        nav::select_nav(0);
        
        $num    = DB::get_all("select sum(delcodenum) num from `{$info}` where delcodenum != 0 AND lang = '{$_M['lang']}' ");
        
        $addup  = array(
            'record'    => DB::counter($record," where lang = '{$_M['lang']}' "),
            'month'     => DB::counter($record," where date_format(from_unixtime(time), '%Y%m') = date_format(curdate() , '%Y%m')  AND lang = '{$_M['lang']}' "),
            'day'       => DB::counter($record," where to_days(now()) = to_days(from_unixtime(time))  AND lang = '{$_M['lang']}' "),
            'code'      => DB::counter($code),
//            'code'      => DB::counter($code," where recycle = '1' "),
            'codea'     => DB::counter($code," where recycle = '0' "),
            'codeb'     => $num[0]['num'],
            'info'      => DB::counter($info," where lang = '{$_M['lang']}' "),
            'infoa'      => DB::counter($info," where recycle = '1' AND lang = '{$_M['lang']}' "),
            'infob'      => DB::counter($info," where recycle = '0' AND lang = '{$_M['lang']}' "),
        );
            
        require $this->template('own/index');
    }

}
?>