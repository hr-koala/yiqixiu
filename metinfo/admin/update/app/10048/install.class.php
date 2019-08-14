<?php
defined('IN_MET') or exit ('No permission');

load::sys_class('admin');
load::sys_class('nav.class.php');
load::sys_func('file');

//手动安装时，或者发给客户自己手动安装时请将标记 ① ② 的注释去掉

class install // //标记①
{
    private $no = 10048;    //应用NO值
    private $m_name = 'branchmap';    //应用文件
    private $ver = '1.6';    //应用版本号
    private $fixed_name;


    public function __construct() {
        global $_M;
        // //标记②
    }
 
    //安装主方法
    public function dosql() {
        global $_M;
        $stall = $this->sqlone('applist');
        if(!$stall){
            //开始执行程序[需要的东西可以在下面执行了]
            $this->appsql();
            //再执行自定义的一些表SQL
            $this->zdysql();
            //安装其他
            $this->mydefault();
        }else{
            switch ($stall['ver']) {
                case "1.2":
                    //更新到 1.3
                    self::langsql('update1.3');
                    self::sjver('1.3');
                    break;
                case "1.3":
                    //更新到 1.4
                    self::sjver('1.4');
                    break;
                case "1.4":
                    //更新到 1.5
                    self::sjver('1.5');
                    break;
                case "1.5":
                    #   更新到 1.6
                    #   修复固定电话长度问题
                    self::up16();
                    break;
                default:
                    break;
            }
            //echo '您的系统中已存在该应用或系统中的应用和要安装的应用在应用编号上有冲突！';
        }
	return 'complete';
    }
    
    //  1.6版本修改
    private function up16() {
        global $_M;
        DB::query("ALTER TABLE {$_M['config']['tablepre']}{$this->m_name}_detailed MODIFY COLUMN `fixedtel` varchar(255)");
        self::sjver('1.6');
    }


    //全局版本号更新
    private function sjver($ver) {
        global $_M;
        $query = "UPDATE {$_M['table']['applist']} SET ver='{$ver}' where no='{$this->no}' AND m_name='{$this->m_name}' ";
        DB::query($query);
    }

    //自定义SQL
    private function zdysql() {
        global $_M;
        /*
         * 店铺详细资料
         * name         公司名称
         * region       经销区域
         * address      详细地址
         * province     省
         * city         市区
         * district     县市
         * lnglat       经纬度定位
         * tel       手机号
         * fixedtel       固定电话
         * type      商户类型
         * `province` int(11) NOT NULL DEFAULT '0',
            `city` int(11) NOT NULL DEFAULT '0',
            `district` int(11) NOT NULL DEFAULT '0',
         */
        $field = "  `id` int(11) NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          `region` varchar(255) NOT NULL,
                          `lnglat` varchar(255) NOT NULL,
                          `address` varchar(255) NOT NULL,
                          `province` varchar(255) NOT NULL,
                          `city` varchar(255) NOT NULL,
                          `district` varchar(255) NOT NULL,
                          `tel` varchar(11),
                          `fixedtel` varchar(255),
                          `type` varchar(11),
                          `lang` varchar(50) DEFAULT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('detailed',$field);
        
        /**
        * 1、增加新表
        * name	配置名称
        * id	添加信息自动增加，		
        * value	配置名称值
        * lang	语言[后台]
        **/
        $field = "  `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(150) NOT NULL,
                    `m_name` varchar(100) NOT NULL,
                    `value` text,
                    `lang` varchar(50) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `name_lang` (`name`,`m_name`,`lang`)";
        $this->createsql('cloud_config',$field);
    }
    
    //执行APP相关的表数据插入
    private function appsql() {
        global $_M;
        $time   = time();
        //注册应用
        $field  = "no='{$this->no}',ver='{$this->ver}',m_name='{$this->m_name}',m_class='table_on',m_action='dodetailed',appname='\$_M[''word''][''branchmap_name'']',info='\$_M[''word''][''branchmap_info'']',addtime='{$time}',updatetime=''";
        $this->addsql('applist',$field);
                        
        //栏目接口表   
        $this->fixed_name = $this->fixedname('branchmap');
                    
        $field  = "no='{$this->no}',name='{$this->m_name}',appname='\$_M[''word''][''branchmap_name'']',addfile='1',memberleft='0',uniqueness='0',fixed_name='{$this->fixed_name}'";
        $this->addsql('ifcolumn',$field);
                    
        //应用生成文件所调用事件
        $field  = "no='{$this->no}',m_name='{$this->m_name}',filename='index.php',m_module='web',m_class='index',m_action='@\$_GET[a]'";
        $this->addsql('ifcolumn_addfile',$field);
                    
        //应用插件
        $field  = "no='{$this->no}',m_name='{$this->m_name}',no_order='1',m_action='doweb',effect='1'";
        $this->addsql('app_plugin',$field);
    }

    //全局默认参数
    private function mydefault() {
        global $_M;
        //安装语言包
        self::langsql($this->m_name);
        //创建入口
        self::column();
    }

    //公共查询方法
    private function sqlone($tname,$where = '') {
        global $_M;
        $table  = $_M['table'][$tname];
        if(!$where){
            $where  = "no='{$this->no}'";
        }
        return DB::get_one("select * from {$table} where {$where}");
    }

    //公共查询方法
    private function sqlall($tname,$where = '') {
        global $_M;
        $table  = $_M['table'][$tname];
        if(!$where){
            $where  = "no='{$this->no}'";
        }
        return DB::get_all("select * from {$table} where {$where}");
    }

    //公共写入方法
    private function addsql($tname,$field = '') {
        global $_M;
        $table  = $_M['table'][$tname];
        DB::query("INSERT INTO {$table} SET {$field}");
    }
    
    //公共写入方法
    private function createsql($tname,$field) {
        global $_M;
        if($tname   != 'cloud_config'){
            $tname  = $this->m_name.'_'.$tname;
        }
        $table  = $_M['config']['tablepre'].$tname;
        DB::query("CREATE TABLE `{$table}` ( {$field} ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
        add_table($tname);
    }

    //计算前台入口的文件名
    private function fixedname($fixed_name = '') {
        if($fixed_name == ''){
            return  $fixed_name;
        }
        do{
            if($xyx == 1){
                $catalog1 = random(5,4);
                $fixed_name = $fixed_name.$catalog1;
            }
            $where  = "foldername='{$fixed_name}'";  //前台入口文件
            $fname = $this->sqlone('column',$where);
            $xyx  = 1;
        } while ($fname != false);

        do{
            if($yxy == 1){
                $catalog1 = random(5,4);
                $fixed_name = $fixed_name.$catalog1;
            }
            $where  = "fixed_name='{$fixed_name}'";  //前台入口文件
            $fname = $this->sqlone('ifcolumn',$where);
            $yxy  = 1;
        } while ($fname != false);
        return  $fixed_name;
    }

    #云网开发工具生成
    private function langsql($filename) {
        global $_M;
        $file  = PATH_ALL_APP.$this->m_name.'/lang/'.$filename.'.sql';
        $_sql = file_get_contents($file);
        $_arr = explode("#;#;", $_sql);
        foreach ($_arr as $val) {
            $val    = str_replace("{\$_M['config']['tablepre']}", $_M['config']['tablepre'], $val);
            $val    = str_replace("{\$this->no}", $this->no, $val);
            DB::query($val);
        }
    }
    
    //创建前台栏目入口
    private function column() {
        global $_M;
        $name   = array('cn'=>'加盟店查询','en'=>'Join store query','tc'=>'加盟店査詢');
        foreach (array('cn','en','tc') as $k => $v) {
            DB::query("INSERT INTO {$_M['table']['column']} SET name='{$name[$v]}',foldername='{$this->fixed_name}',module='{$this->no}',no_order='100',if_in='1',classtype='1',out_url='{$_M['url']['site']}{$this->fixed_name}',isshow='1',lang='{$v}',nav='1'");
        }
        
        $file   = DB::get_all("select * from {$_M['table']['ifcolumn_addfile']} where no = '{$this->no}' ");
        load::sys_func('file');
        $fi = path_absolute($this->fixed_name);
        makedir($fi);
        if(getdirpower($fi) == false) modifydirpower($fi,777);
        foreach ($file as $k => $v) {
            $lj = '../'.$this->fixed_name.'/'.$v['filename'];
            $lj = path_absolute($lj);
            makefile($lj,true);
            if(getfilepower($lj) == false) modifyfilepower($lj,0777);
            $action = strstr($v['m_action'],'@$_')?$v['m_action']:"'".$v['m_action']."'";
            $myfile = fopen("{$lj}", "w");
            $nr = "<?php\n"
            . "define('M_NAME', '{$v['m_name']}');\n"
            . "define('M_MODULE', '{$v['m_module']}');\n"
            . "define('M_CLASS', '{$v['m_class']}');\n"
            . "define('M_ACTION', {$action});\n"
            . "require_once '../app/app/entrance.php';\n"
            . "?>";
            fwrite($myfile, $nr);
            fclose($myfile);
       }
    }
    
}
?>