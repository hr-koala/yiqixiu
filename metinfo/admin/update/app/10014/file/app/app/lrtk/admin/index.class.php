<?php

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::own_func('config');

class index extends admin {

    public $con;//配置数组
	
    public function __construct() {
        global $_M;
        parent::__construct();
        $this->con  = CON($_M['lang']);
    }

    //配置文件初始化
    public function doindex() {
        global $_M;      
        $con    = $this->con;
        $url    = $_M[url][own].'admin/templates/';
        //排序图标
        $a[0]   = "<li class=\"radio_0 none\"><div style=\"background:#666666 url({$url}img/r_top.png) center center no-repeat;\" title=\"0\"></div></li>";
        $a[1]   = "<li class=\"radio_1 none\"><div style=\"background:#fbb01f url({$url}img/r_phone.png) center center no-repeat;\" title=\"1\"></div></li>";
        $a[2]   = "<li class=\"radio_2 none\"><div style=\"background:#78c340 url({$url}img/r_wx.png) center center no-repeat;\" title=\"2\"></div></li>";
        $a[3]   = "<li class=\"radio_3 none\"><div style=\"background:#6da9de url({$url}img/r_qq.png) center center no-repeat;\" title=\"3\"></div></li>";
        $a[4]   = "<li class=\"radio_4 none\"><div style=\"background:#E7162C url({$url}img/r_xl.png) center center no-repeat;\" title=\"4\"></div></li>";
        $a[5]   = "<li class=\"radio_5 none\"><div style=\"background:#006A93 url({$url}img/r_tx.png) center center no-repeat;\" title=\"5\"></div></li>";
        $orderlist   = explode(',',$con['orderlist']);
        foreach ($orderlist as $k => $v) {
            $list  .=  $a[$v];
        }
        require $this->template('own/index');
    }
    
    //处理
    public function doeditorpz() {
        global $_M;
        $form   = $_M['form'];
        zx($form);
        turnover("{$_M['url']['own_form']}a=doindex","{$_M['word']['yw_lrtk_bccg']}");
    }
    
    //还原配置
    public function doeditormrpz() {
        global $_M;
        $form   = morenpz($_M['lang']);
        zx($form);
        turnover("{$_M['url']['own_form']}a=doindex","{$_M['word']['yw_lrtk_hycg']}");
    }
}

?>