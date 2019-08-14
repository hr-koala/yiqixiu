<?php

defined('IN_MET') or exit('No permission');

load::own_class('appadmin');

/*
 * 配置
 * 包含其他功能初始化
 */
class config extends appadmin {
    
    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        parent::doconfig('donav');
        nav::select_nav(99);
        cloud::tablejqcss();
    }

    //API密钥填写页初始化
    public function doindex(){
        global $_M,$_YW;
        require $this->template('own/config');
    }

    //API配置信息保存
    public function doconfig(){
        global $_M,$_YW;
        $default    = array('select1'=>'','select2'=>'','select3'=>'','city1'=>'','city2'=>'','city3'=>'','city4'=>'');
        $form   = array_merge($default,$_M['form']);
        self::configsql($form);
        turnover($_M['url']['own_form'] . 'a=doindex', $_YW['t']['yw008']);
    }
    
    //配置信息保存
    public function configsql($form,$lang = '') {
        global $_M;
        if($lang == '') $lang = $_M['lang'];
        //程序运行必备
        $aa = array('apikey','city','state','company','select1','select2','select3','radio','maxwidth','webtext1','webtext2','about','lnglat','diycss','corporatename','city1','city2','city3','city4','typeon','type'); 

        $zb  = array_merge($aa);
        $arr = array_intersect_key($form, array_combine($zb,$zb)); //对比数组
        foreach ($arr as $k => $v) {
            $array[] = "('{$k}','{$_M['form']['n']}','{$v}','{$lang}')";
        }
        $str    = arrayto_string($array,',');
        DB::query("INSERT INTO {$_M['table']['cloud_config']} (name,m_name,value,lang) VALUES {$str} ON DUPLICATE KEY UPDATE value=VALUES(value)");
    }
    
}

?>