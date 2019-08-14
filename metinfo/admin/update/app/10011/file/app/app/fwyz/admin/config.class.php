<?php

defined('IN_MET') or exit('No permission');

load::own_class('admin/class/fwadmin');
load::own_func('admin');

//config 将tname    转成跳转的方法名
class config extends fwadmin {

    /*
     * @param   $nav        生成后的侧栏导航HTML
     * @param   $navsign    导航选中标记
     */
    public $nav;
    public $navsign;
    
    public function __construct() {
        global $_M;
        parent::__construct();
        $this->tname    = $_M['form']['tname'];
        parent::doconfig('dono');
    }
    
    private function confignav($on) {
        $this->navsign  = $on;
        parent::doconfig('donav,dosidebar');
        nav::select_nav(100);
        parent::urlc('config','doeditorpzn');
        parent::url('do'.$on);
        cloud::tablejqcss();
    }

    //基础配置
    public function doadmin() {
        global $_M,$_YW;
        self::confignav('admin');
        //微信设置
        if(file_exists(PATH_ALL_APP.'met_wechat/include/class/LW_BASE.class.php'))  self::wechat();
        require $this->template('own/config');
    }
    
    //防伪码设置
    public function docode() {
        global $_M,$_YW;
        self::confignav('code');
        if(DB::counter($_YW['k']['code']) > 0) $configtips = 'configtips';
        
        require $this->template('own/config');
    }

    //前台基础
    public function doweb() {
        global $_M,$_YW;
        self::confignav('web');
        
        $lanmu   = '<a href="'.$_M[url][site_admin].'column/" target="_blank" >'.$_YW['t']['yw069'].'</a>';
        $fanwen  = '<a href="'.$_M['url']['site'].$_YW['c']['column']['foldername'].'" target="_blank" >'.$_YW['t']['yw068'].'</a>';
        
        require $this->template('own/config');
    }
    
    //前台模板
    public function dotemplate() {
        global $_M,$_YW;
//        $template   = 'do'.$_YW['c']['template'];
//        self::confignav('template');
//        self::$template();
    }


    //table模板
    public function dotable() {
        global $_M,$_YW;
        self::confignav('table');
        require $this->template('own/config');
    }
    
    //section模板
    public function dosection() {
        global $_M,$_YW;
        self::confignav('section');
        require $this->template('own/config');
    }
    

    //配置信息保存
    public function doeditorpzn() {
        global $_M,$_YW;
        $form   = $_M['form'];
        $lang   = $_M['lang'];
        switch ($this->tname) {
            case 'doweb':
                #执行
                if($form['dir_name']) self::column($form['dir_name']);
                self::ctitle($form['ctitle']);
                break;
            case 'docode':
                #BUG过度
                $form['olddata']   = sqlinsert($_POST['olddata']);
                if($form['space'] > 0) $form['olddata'] = 0;
                #执行
                foreach (stringto_array($form['open'],'|') as $val) {
                    if(!$form['fwlength_'.$val]) $form['fwlength_'.$val] = 4;
                }
                
                # 保存公用字段
                $arr    = array('space','open','fwlength_1','fwlength_2','fwlength_3','fwlength_4','fwlength_5');
                $formarr = array_intersect_key($form, array_combine($arr,$arr)); //对比数组
                if(DB::counter($_YW['k']['code']) <= 0) self::configsql($formarr,'cloud');
                #注销注销公用字段
                $form   = cloud::delkey($form,'space,open,fwlength_1,fwlength_2,fwlength_3,fwlength_4,fwlength_5');
                break;
            default:
                break;
        }

        self::configsql($form,$lang);
        turnover($_M['url']['own_form'].'a='.$this->tname, $_YW['t']['yw041']);
    }
    
    //后台函数-文件夹修改
    private function column($dir_name) {
        global $_M,$_YW;
        //修改入口文件
        if (rename("../{$_YW['c']['column']['foldername']}", "../{$dir_name}")) {
            //修改文件名
            DB::query("UPDATE {$_M['table']['column']} SET foldername='{$dir_name}' WHERE module='{$_YW['no']}' AND lang='{$_M['lang']}' ");
            //修改栏目接口文件（方便删除应用时调用）
            DB::query("UPDATE {$_M['table']['ifcolumn']} SET fixed_name='{$dir_name}' WHERE no='{$_YW['no']}' ");
        } else {
            echo "<script type='text/javascript'> alert('".$_YW['t']['yw156']."');window.history.back(); </script>";
            die();
        }
    }
    
    //修改后台标题
    private function ctitle($ctitle) {
        global $_M,$_YW;
        //修改标题
        DB::query("UPDATE {$_M['table']['column']} SET ctitle='{$ctitle}' WHERE module='{$_YW['no']}' AND lang='{$_M['lang']}' ");
    }

    //配置信息保存
    public function configsql($form,$lang = '') {
        global $_M;
        if($lang == '') $lang = $_M['lang'];
        //防伪码设置
        $ee = array('fwlength_1','fwtype_1','open','fwlength_2','fwtype_2','fwlength_3','fwtype_3','fwlength_4','fwtype_4','fwlength_5','fwtype_5','space','fwqian_1','fwqian_2','fwqian_3','fwqian_4','fwqian_5','fwhou_1','fwhou_2','fwhou_3','fwhou_4','fwhou_5');
        //前台web基础
        $web    = array('template','webstyle','bodycolor','bodyimg','bodyrepeat');

        //程序运行必备
        $aa = array('fwlb','fwdel','fwmakenum','olddata','numonoff','additional','word','picurl','description');     //配置页面参数
        $bb = array('sstop', 'ssbottom', 'ssbjt', 'color', 'scolor','hoverscolor' ,'sstopjl','t_css');    //查询页面参数
        $cc = array('cxcolor', 'cxcolor5','cxwidth');    //表格样式返回结果页面参数
        $dd = array('jdzpjg', 'jdjmwl','celan','css');    //简单样式返回结果页面参数

        //模板二
        $ss = array('s_width','s_logo','s_ctitle','s_css','subsection');

        $zb  = array_merge($aa,$bb,$cc,$dd,$ee,$web,$ss);
        $arr = array_intersect_key($form, array_combine($zb,$zb)); //对比数组
        foreach ($arr as $k => $v) {
            $array[] = "('{$k}','{$_M['form']['n']}','{$v}','{$lang}')";
        }
        $str    = arrayto_string($array,',');
        DB::query("INSERT INTO {$_M['table']['cloud_config']} (name,m_name,value,lang) VALUES {$str} ON DUPLICATE KEY UPDATE value=VALUES(value)");
    }
    
    //微信配置
    private function wechat() {
        global $_M,$_YW;
        session_start();
        $LW_BASE = load::own_class('../met_wechat/include/class/LW_BASE', 'new');
        /**
         * on 字段 必填 关键词开关 1 为插入或更新关键词，0为删除关键词
         * word 字段 选填 如果type设置为3，则不填，type为2或1，需要填写关键词 “|关键词1|关键词2”
         * type 字段 必填 3代表此应用完全接管没有匹配到关键词的数据，2代表模糊匹配关键词，1代表精确匹配关键词
         * is_own 字段 必填 1代表用户在主应用管理中不可见，防止误删；0代表在主应用管理中可见，可操作！！
         * m_name 字段 必填 你当前应用的m_name
         * m_class 字段 必填 你当前应用的m_class
         * m_action 字段 必填 post关键词给你的方法
         * m_num 字段 选填 方便你查询自己多个关键词做区分用，内容自己定义
         * own_url 字段 选填 如果你觉得需要其它参数，请填入“&type=1”之类的参数，&开头哦！！
         * level 字段 选填 数值为0-10，数值越大，优先级越高，默认为0
         *
         *
         * 其它说明
         * type为3时 只要关键词表中没有匹配到的，就会原封不动的转发给你的应用！！！
         * type为2时 的模糊匹配，word设置为“|哈哈”，用户发送“哈”即可识别。
         * type为2时 还做了一个#识别，word设置为“|防伪码”，用户发送“防伪码#ASHD-SJDK-KSJD”，即可成功识别，
         * type为1时 的精确匹配，word设置为“|哈哈”，用户发送“哈哈”才可以识别。
         */
        if(in_array(2, stringto_array($_YW['c']['additional'],'|') )){
            if($_YW['c']['word'] != '') $LW_BASE->save_keywords(1,$_YW['c']['word'],2,1,$_YW['n'],'index','dowechat',''.$_YW['c']['wechat'],$_YW['n'],9);
        }else{
//            $LW_BASE->save_keywords(0,'','','',$_YW['n'],'','','',$_YW['n']);
        }
    }
    
}

?>