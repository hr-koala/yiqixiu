<?php
defined('IN_MET') or exit ('No permission');

load::sys_class('admin');
load::sys_class('nav.class.php');

class install  {
    
    private $no = 10011;
    private $m_name = 'fwyz';
    private $ver = '3.4';
    
    public function dosql() {
        global $_M;
        $query = "select * from {$_M['table']['applist']} where no='{$this->no}'";
        $stall = DB::get_one($query);
        if(!$stall){
            $this->msql($this->no);           //初始安装应用，安装完成后版本号变成3.1
            //echo '安装成功！';
        }else{
            $ver = $stall[ver];
            switch ($ver) {
                case "1.0":
                    $this->FWA();        //更新到 1.1
                    $this->FWB();        //更新到 1.2
                    $this->FWC();        //更新到 2.0
                    break;
                case "1.1":
                    $this->FWB();        //更新到 1.2
                    $this->FWC();        //更新到 2.0
                    break;
                case "1.2":
                    $this->FWC();        //更新到 2.0
                    break;
                case "2.0":
                    $this->FWD();        //更新到 3.0
                    break;
                case "3.0":
                    $this->FWE();        //更新到 3.1
                    break;
                case "3.1":
                    $this->FWF();        //更新到 3.2
                    break;
                case "3.2":
                    self::fwver('3.3');  //更新到 3.3
                    break;
                case "3.3":
                    # 调整公用参数，优化多语言设置问题
                    self::FWH();  //更新到 3.4
                    break;
                default:
                    break;
            }
            //echo '您的系统中已存在该应用或系统中的应用和要安装的应用在应用编号上有冲突！';
        }
	return 'complete';
    }
    
    
    
    
    
    
    /**
     *     
     * 【   各个版本更新主方法  】
     * 
    **/
    //3.4更新内容
    private function FWH() {
        global $_M;
        //删除公用参数
        // 'space','open','fwlength_1','fwlength_2','fwlength_3','fwlength_4','fwlength_5'
        $table  = $_M['config']['tablepre'].'cloud_config';
        $where  = " name IN('space','open','fwlength_1','fwlength_2','fwlength_3','fwlength_4','fwlength_5') AND m_name = '{$this->m_name}' ";
        DB::query("delete from {$table} where {$where}  AND lang != 'cn' ");
        //调整原cn 为公用参数
        DB::query("UPDATE {$table} SET lang = 'cloud' where {$where} AND lang = 'cn' ");
        self::fwver('3.4');
    }
    //3.2更新内容
    private function FWF() {
        global $_M;
        $this->fwver('3.2');
    }
    //3.1更新内容
    private function FWE() {
        global $_M;
        //先修改默认值【必须】
        $langsz = $this->langsz();
        foreach ($langsz as $kl => $vl){
            $mrz = $this->mrz31($vl);
            foreach ($mrz as $k => $v){
                $query = "INSERT INTO {$_M['config']['tablepre']}cloud_config SET m_name = '{$this->m_name}',name='{$k}',lang='{$vl}',value='{$v}'";
                DB::query($query);
            }
        }
        //修改code字段
        $query = "ALTER TABLE  `{$_M['config']['tablepre']}{$this->m_name}_code` ADD `total` int(11) NOT NULL DEFAULT '0' AFTER `info_id`" ;
        DB::query($query);
        //计算总计
        $query  = "SELECT code_id,COUNT(`code_id`) num FROM `{$_M['config']['tablepre']}{$this->m_name}_record` GROUP BY `code_id` ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            DB::query("UPDATE `{$_M['config']['tablepre']}{$this->m_name}_code` SET total = '{$val['num']}' WHERE id = '{$val['code_id']}' ");
        }
        
        $this->fwver('3.1');
    }
    //3.0更新内容
    private function FWD() {
        global $_M;
        //先修改默认值【必须】
        $langsz = $this->langsz();
        foreach ($langsz as $kl => $vl){
            $mrz = $this->mrz3($vl);
            foreach ($mrz as $k => $v){
                $query = "INSERT INTO {$_M['config']['tablepre']}codepz SET name='{$k}',lang='{$vl}',value='{$v}'";
                DB::query($query);
            }
        }
        //更新配置信息
        $this->config();
        //修改原数据库表名，变成应用文件名_表名
        $this->rename();
        
        $this->fwver('3.0');
    }

  //2.0更新内容（统一将前面所有版本更新为2.0全新版本，所有源码均重构。数据库表、字段无改动）
    private function FWC() {
        global $_M;
        //删除所有的语言参数（初始安装已集成）
        $query = "delete from {$_M['table']['language']} where app='{$this->no}'";
        DB::query($query);
        //增加需要的语言参数入库（初始安装已集成）
        $this->language();
        //删除冗余的后台插件数据表（初始安装已集成）
        $query = "delete from {$_M['table']['app_plugin']} where no='{$this->no}' AND m_action='doadmin'";
        DB::query($query);
        //配置参数的默认值(初始安装已集成)
        $langsz = $this->langsz();
        foreach ($langsz as $kl => $vl){
            $mrz = $this->mrz2($vl);
            foreach ($mrz as $k => $v){
                $query = "INSERT INTO {$_M['config']['tablepre']}codepz SET name='{$k}',lang='{$vl}',value='{$v}'";
                DB::query($query);
            }
        }
        //最后更改版本号到（2.0）
        $this->fwver('2.0');
    }
    
    //1.2更新内容(可供1.1版本以前使用)
    private function FWB() {
        global $_M;
        //添加栏目(初始安装已集成)
        $query = "select * from {$_M['table']['column']} where module='{$this->no}'";
        $catalog_1 = DB::get_one($query);
        if(!$catalog_1) {
            echo '1';
            //无栏目时创建(初始安装已集成)
            $this->mrzlm();
        }
        //最后更改版本号到（1.2）
        $this->fwver('1.2');
    }
    
    //1.1更新内容（次更新只为已是1.0版本使用）
    private function FWA() {
        global $_M;
        //增加code_list表字段（初始安装已集成）
        $query = "ALTER TABLE  `{$_M['config']['tablepre']}code_list` ADD  `default_value` VARCHAR(50) NULL AFTER  `no_order`" ;
        DB::query($query);
	//防伪码前缀（初始安装已集成）
        $query = "INSERT INTO {$_M['config']['tablepre']}codepz SET name='fwqian',lang='cn',value='FW'";
        DB::query($query);
        //最后更改版本号到（1.1）
        $this->fwver('1.1');
    }
    
    
    
    
    
    /**
     *     
     * 【   以下为辅助方法以及默认数组设置  】
     * 
    **/
    //3.0修改配置文件
    private function config(){
        global $_M;
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
        //获取配置信息
        $query = "select * from {$_M['table']['codepz']}";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            if($val['name'] == 'fwqian') $val['name'] = 'fwqian_1';
            $query = "INSERT INTO {$_M['config']['tablepre']}cloud_config SET m_name = '{$this->m_name}',name='{$val['name']}',lang='{$val['lang']}',value='{$val['value']}'";
            DB::query($query);
        }
        $query = " DROP TABLE `{$_M['config']['tablepre']}codepz` ";
        DB::query($query);
        
    }
    
    //3.0修改表名，为了统一写法
    private function rename(){
        global $_M;
        //主表
        DB::query(" alter table `{$_M['config']['tablepre']}code` rename `{$_M['config']['tablepre']}{$this->m_name}_codeinfo`; ");
        DB::query(" alter table `{$_M['config']['tablepre']}code_parameter` rename `{$_M['config']['tablepre']}{$this->m_name}_parameter`; ");
        DB::query(" alter table `{$_M['config']['tablepre']}code_list` rename `{$_M['config']['tablepre']}{$this->m_name}_list`; ");
        DB::query(" alter table `{$_M['config']['tablepre']}code_plist` rename `{$_M['config']['tablepre']}{$this->m_name}_plist`; ");
        del_table('code|code_parameter|code_list|code_plist|codepz');
        $tablelist  = $this->m_name.'_codeinfo|'.$this->m_name.'_parameter|'.$this->m_name.'_list|'.$this->m_name.'_plist';
        add_table($tablelist);
        
        //对数据库进行拆分
        //code  防伪码
        //info  产品信息
        
        /*
         * title    信息标题
         * issue    信息添加管理员
         * num      信息编号    弱化此功能
         * content  详细内容
         * info 备注
         * addtime  信息添加时间
         * amendtime    信息修改时间
         * deltime      信息删除时间   
         * delcodenum   删除的防伪码个数
         *
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `title` varchar(200) NOT NULL,
                          `no_order` int(11) NOT NULL DEFAULT '0',
                          `num` bigint(20) NOT NULL,
                          `content` longtext,
                          `info` text,
                          `issue` varchar(100) NOT NULL,
                          `addtime` datetime NOT NULL,
                          `amendtime` datetime NOT NULL,
                          `recycle` int(2) NOT NULL DEFAULT '1',
                          `deltime` int(11) NOT NULL,
                          `delcodenum` int(11) NOT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          UNIQUE KEY `num_lang` (`num`,`lang`),
                          PRIMARY KEY (`id`)";
        $this->createsql('info',$field);
        
        /*
         * id   
         * code 防伪码
         * qrcode 防伪码二维码
         * deltime  删除（回收站）时间
         * recycle  防伪码状态
         * info_id  信息表ID
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `no_order` int(11) NOT NULL DEFAULT '0',
                          `code` varchar(50) NOT NULL,
                          `qrcode` varchar(255) NOT NULL,
                          `barcode` varchar(255) NOT NULL,
                          `deltime` int(11) NOT NULL,
                          `recycle` int(2) NOT NULL DEFAULT '1',
                          `info_id` int(11) NOT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          UNIQUE KEY `codes` (`code`),
                          PRIMARY KEY (`id`)";
        $this->createsql('code',$field);
        
        //首先创建两个自定义字段
        
        $query = "select lang from {$_M['config']['tablepre']}{$this->m_name}_codeinfo GROUP BY lang";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $dy = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_parameter SET 
                no_order = '0',
                name = '出厂时间',
                description = '',
                type = '7',
                wr_ok = '0',
                lang = '{$val['lang']}'
            ";
            DB::query($dy);
            $dyid[$val['lang']]   =  DB::insert_id();
            $ge = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_parameter SET 
                no_order = '0',
                name = '保修日期',
                description = '',
                type = '7',
                wr_ok = '0',
                lang = '{$val['lang']}'
            ";
            DB::query($ge);
            $geid[$val['lang']]   =  DB::insert_id();
        }
        
        //信息分离导入
        $query = "select * from {$_M['config']['tablepre']}{$this->m_name}_codeinfo";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $recycle    = $val['recycle'] == 0?1:0;
            $deltime    = strtotime($val['scsj']);
            $no_order   = $val['paixu'];
            $sql = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_info SET 
                title = '{$val['title']}',
                no_order = '{$no_order}',
                num = '{$val['num']}',
                content = '{$val['content']}',
                info = '{$val['beizhu']}',
                issue = '{$val['issue']}',
                addtime = '{$val['tjsj']}',
                amendtime = '{$val['xxgxsj']}',
                recycle = '{$recycle}',
                deltime = '{$deltime}',
                lang = '{$val['lang']}'
            ";
            DB::query($sql);
            $info_id    = DB::insert_id();
            $q = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_code SET
                no_order = '{$no_order}',
                code = '{$val['number']}',
                deltime = '{$deltime}',
                recycle = '{$recycle}',
                info_id = '{$info_id}',
                lang = '{$val['lang']}'
            ";
            DB::query($q);
            //对两个时间分别添加到自定义字段内
            $plist = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_plist SET listid = '{$info_id}', paraid = '{$dyid[$val['lang']]}', info = '{$val['delivery']}', imgname = '出厂时间', lang = '{$val['lang']}' ";
            DB::query($plist);
            $plist = "INSERT INTO {$_M['config']['tablepre']}{$this->m_name}_plist SET listid = '{$info_id}', paraid = '{$geid[$val['lang']]}', info = '{$val['guarantee']}', imgname = '保修日期', lang = '{$val['lang']}' ";
            DB::query($plist);
        }
        
        $query = " DROP TABLE `{$_M['config']['tablepre']}{$this->m_name}_codeinfo` ";
        DB::query($query);
        del_table($this->m_name.'_codeinfo');
        
        //新增统计表
        /*
         * id 
         * issue    会员ID
         * code_id  防伪码ID
         * ip       IP
         * country  国家
         * prov     城市
         * city     地区
         * time     查询时间
         * mode     查询方式 0 网页 1 二维码
         * 
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `issue` varchar(255) NOT NULL,
                          `ip` varchar(20) NOT NULL,
                          `country` varchar(100),
                          `prov` varchar(100),
                          `city` varchar(100),
                          `code_id` int(11) NOT NULL,
                          `time` int(11) NOT NULL,
                          `mode` varchar(50) NOT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('record',$field);
        
    }


    //全局数据库以及语言执行完后，开始默认值以及默认栏目创建（只有初始安装执行）
    private function mrz() {
        global $_M;
        //初始安装默认值入库
        $langsz = $this->langsz();
        foreach ($langsz as $kl => $vl){
            $mrz = $this->mrystop($vl);
            foreach ($mrz as $k => $v){
                $query = "INSERT INTO {$_M['config']['tablepre']}cloud_config SET m_name = '{$this->m_name}',name='{$k}',lang='{$vl}',value='{$v}'";
                DB::query($query);
            }
        }
        $cloud  = self::mrzcloud();
        foreach ($cloud as $k => $v){
            $query = "INSERT INTO {$_M['config']['tablepre']}cloud_config SET m_name = '{$this->m_name}',name='{$k}',lang='cloud',value='{$v}'";
            DB::query($query);
        }
        
        //初始创建栏目（与1.2更新公用）
        $this->mrzlm();
        //初始化 language表数据（与2.0更新公用）
        $this->language();
    }
    
    //创建栏目，先查询栏目接口信息，保证信息一致（与1.2更新公用）
    private function mrzlm() {
        global $_M;
        $langsz = $this->langsz();
        $query = "select * from {$_M['table']['ifcolumn']} where no='{$this->no}'";
        $ifcolumn = DB::get_one($query);
        $sj = $this->langsj();
        $fixed      = $ifcolumn[fixed_name];            //栏目目录文件名
        foreach ($langsz as $k => $v) {
            $appname    = $sj[$v]['fwname'];
            $query = "INSERT INTO {$_M['table']['column']} SET name='{$appname}',foldername='{$fixed}',module='{$this->no}',no_order='100',if_in='1',classtype='1',out_url='{$_M[url][site]}{$fixed}',isshow='1',lang='{$v}',nav='1'";
            DB::query($query);
        }
        $this->scfile($fixed);
    }
    
    //生成前台入口文件(不生成前台入口配置里面保存时会报错)
    private function scfile($fixed) {
        global $_M;
        $query  = "select * from {$_M['table']['ifcolumn_addfile']} where no = '{$this->no}' ";
        $wenj   = DB::get_all($query);
        load::sys_func('file');
        $fi = path_absolute($fixed);
        makedir($fi);
        if(getdirpower($fi) == false){
            modifydirpower($fi,777);
        }
        foreach ($wenj as $k => $v) {
            $lj = '../'.$fixed.'/'.$v['filename'];
            $lj = path_absolute($lj);
            makefile($lj,true);
            if(getfilepower($lj) == false){
                modifyfilepower($lj,0777);
            }
            $myfile = fopen("{$lj}", "w");
            $nr = "<?php\n"
            . "define('M_NAME', '{$v['m_name']}');\n"
            . "define('M_MODULE', '{$v['m_module']}');\n"
            . "define('M_CLASS', '{$v['m_class']}');\n"
            . "define('M_ACTION', '{$v['m_action']}');\n"
            . "require_once '../app/app/entrance.php';\n"
            . "?>";
            fwrite($myfile, $nr);
            fclose($myfile);
       }
    }
    
    //初始化 language表数据(仅后台系统调用的语言参数才入库，其他语言参数全部改用直接调用文件)
    private function language() {
        global $_M;
        $sj = $this->langsj();
        //根据语言依次执行
        $langsz = $this->langsz();
        foreach ($langsz as $kl => $vl){
            foreach ($sj[$vl] as $k => $v) {
                if($k != 'fwcxzqts' || $k != 'fwcxcwts'){
                    $query = "INSERT INTO {$_M['table']['language']} SET name='{$k}',value='{$v}',site='1',no_order='0',array='0',app='{$this->no}',lang='{$vl}'";
                    DB::query($query);
                }
            }
        }
    }
    
    //获取多语言参数数组
    private function langsj() {
        global $_M;
        //获取语言文件内容，对JSon字符串 进行处理，最后转换成数组
        $clang = file_get_contents(PATH_ALL_APP.$this->m_name.'/lang/langsql.php');
        $clang = str_replace(array("\r\n", "\r", "\n"), "", $clang);
        $sj = jsondecode($clang);
        return $sj;
    }
    
    //基础语言数组
    private function langsz() {
        $arr    = array();
        $arr['cn']       = 'cn';
        $arr['en']       = 'en';
        $arr['tc']       = 'tc';
        return $arr;
    }
    
    //全局默认参数
    private function mrystop($l) {
        global $_M;
        $cl = $this->langsj();
        return array(
            'fwdel'                     => 1,
            'fwlb'                      => 10,
            'fwmakenum'                 => 1,
            'fwqian_1'                  => 'FW',
            'fwtype_1'                  => 0,
            'fwqian_2'                  => '',
            'fwtype_2'                  => 0,
            'fwqian_3'                  => '',
            'fwtype_3'                  => 0,
            'fwqian_4'                  => '',
            'fwtype_4'                  => 0,
            'fwqian_5'                  => '',
            'fwtype_5'                  => 0,
            'template'                  => 'section',
            'webstyle'                  => 0,
            'celan'                     => 1,
            'color'                     => '#F2F2F2',
            'scolor'                    => '#3498DB',
            'hoverscolor'               => '#3498DB',
            'sstopjl'                   => '30',
            'css'                       => '0',
            'cxwidth'                   => '90%',
            'cxcolor'                   => '#FFFFFF',
            'cxcolor5'                  => '#333333',
            'jdzpjg'                    => $cl[$l]['fwcxzqts'],
            'jdjmwl'                    => $cl[$l]['fwcxcwts'],
            'bodycolor'                 => '#FFFFFF',
            'bodyrepeat'                => 3,
            's_width'                   => '70%',
            's_logo'                    => '../app/app/'.$this->m_name.'/lang/s_logo.png',
            'csvhs'                     => 10,
            'numonoff'                  => 1,
            'subsection'                => 0,
        );
    }
    
    //公用参数
    private function mrzcloud() {
        global $_M;
        return array(
            'space'                     => 0,
            'open'                      => 1,
            'fwlength_1'                => 4,
            'fwlength_2'                => '',
            'fwlength_3'                => '',
            'fwlength_4'                => '',
            'fwlength_5'                => '',
        );
    }


    //2.0升级需要的默认值（新版中新增加的）
    private function mrz2($l) {
        global $_M;
        return array(
            'no'                        => $this->no,   //方便应用内调用应用编号***必须有
            'cxwidth'                   => '90%',
            'jdzpjg'                    => $cl[$l]['fwcxzqts'],
            'jdjmwl'                    => $cl[$l]['fwcxcwts'],
            'css'                       => 0,
            'celan'                     => 1,
            'fwlb'                      => 10,
            'csvhs'                     => 10,
        );
    }
    
    //3.0升级需要的默认值（新版中新增的）
    private function mrz3($l) {
        global $_M;
        return array(
            'fwdel'                     => 1,
            'fwmakenum'                 => 1,
            'errorcorrectionlevel'      => 'H',
            'matrixpointsize'           => 8,
            'space'                     => 0,
            'open'                      => 1,
            'fwlength_1'                => 11,
            'fwtype_1'                  => 0,
            'fwqian_2'                  => '',
            'fwlength_2'                => '',
            'fwtype_2'                  => 0,
            'fwqian_3'                  => '',
            'fwlength_3'                => '',
            'fwtype_3'                  => 0,
            'fwqian_4'                  => '',
            'fwlength_4'                => '',
            'fwtype_4'                  => 0,
            'fwqian_5'                  => '',
            'fwlength_5'                => '',
            'fwtype_5'                  => 0,
            'template'                  => 'table',
            'webstyle'                  => 0,
            'hoverscolor'               => '#3498DB',
            'bodycolor'                 => '#FFFFFF',
            'bodyrepeat'                => 3,
            'olddata'                   => 1,
            's_width'                   => '70%',
            's_logo'                    => '../app/app/'.$this->m_name.'/lang/s_logo.png',
        );
    }
    
    //3.0升级需要的默认值（新版中新增的）
    private function mrz31($l) {
        global $_M;
        return array(
            'numonoff'                  => 1,
            'subsection'                => 1,
        );
    }


    //全局版本号更新
    private function fwver($ver) {
        global $_M;
        $query = "UPDATE {$_M['table']['applist']} SET ver='{$ver}' where no='{$this->no}' AND m_name='{$this->m_name}' ";
        DB::query($query);
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
    
    
    
    /**
     *     
     * 【   (主方法)初始数据库以及默认值的安装  】
     * 
    **/
    private function msql() {
        global $_M;
        /*
         * title    信息标题
         * issue    信息添加管理员
         * num      信息编号
         * content  详细内容
         * info 备注
         * addtime  信息添加时间
         * amendtime    信息修改时间
         * recycle  防伪码状态1 为正常 0 为删除
         * deltime      信息删除时间   
         * delcodenum   删除的防伪码个数
         *
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `title` varchar(200) NOT NULL,
                          `no_order` int(11) NOT NULL DEFAULT '0',
                          `num` bigint(20) NOT NULL,
                          `content` longtext,
                          `info` text,
                          `issue` varchar(100) NOT NULL,
                          `addtime` datetime NOT NULL,
                          `amendtime` datetime NOT NULL,
                          `recycle` int(2) NOT NULL DEFAULT '1',
                          `deltime` int(11) NOT NULL,
                          `delcodenum` int(11) NOT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          UNIQUE KEY `num_lang` (`num`,`lang`),
                          PRIMARY KEY (`id`)";
        $this->createsql('info',$field);
        
        /*
         * id   
         * code 防伪码
         * qrcode 二维码
         * barcode  条形码
         * deltime  删除（回收站）时间
         * recycle  防伪码状态1 为正常 0 为删除
         * info_id  信息表ID
         * total    查询总计
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `no_order` int(11) NOT NULL DEFAULT '0',
                          `code` varchar(50) NOT NULL,
                          `qrcode` varchar(255) NOT NULL,
                          `barcode` varchar(255) NOT NULL,
                          `deltime` int(11) NOT NULL,
                          `recycle` int(2) NOT NULL DEFAULT '1',
                          `info_id` int(11) NOT NULL,
                          `total` int(11) NOT NULL DEFAULT '0',
                          `lang` varchar(50) DEFAULT NULL,
                          UNIQUE KEY `codes` (`code`),
                          PRIMARY KEY (`id`)";
        $this->createsql('code',$field);
        
        /*
         * id 
         * issue    会员ID
         * code_id  防伪码ID
         * ip       IP
         * country  国家
         * prov     城市
         * city     地区
         * time     查询时间
         * mode     查询方式 0/二维码,1/电脑端,2/移动端
         * 
         */
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `issue` varchar(255) NOT NULL,
                          `ip` varchar(20) NOT NULL,
                          `country` varchar(100),
                          `prov` varchar(100),
                          `city` varchar(100),
                          `code_id` int(11) NOT NULL,
                          `time` int(11) NOT NULL,
                          `mode` int(2) NOT NULL DEFAULT '0',
                          `lang` varchar(50) DEFAULT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('record',$field);
        /**
        * 2、增加新表
        * name	参数名称，				description 	简短描述
        * id	添加信息自动增加，		no_order 		用于信息排序[后台]
        * type	参数类型（1:简短|2:下拉|3:文本|4:多选|5:附件|6:单选）				
        * wr_ok 是否必填 1为必填，0为不必填
        * lang	语言[后台]
        **/
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `name` varchar(100) NOT NULL,
                          `description` text NOT NULL,
                          `no_order` int(2) NOT NULL DEFAULT '0',
                          `type` int(2) NOT NULL,
                          `wr_ok` int(2) NOT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          `mrz` text NOT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('parameter',$field);
        /**
        * 3、增加新表
        * bigid	参数名称ID，met_code_parameter表ID值
        * id	添加信息自动增加
        * info	参数值
        * no_order	排序
        * lang	语言[后台]
        **/
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `bigid` int(11) NOT NULL,
                          `info` varchar(255) NOT NULL,
                          `no_order` int(2) NOT NULL DEFAULT '0',
                          `default_value` varchar(50) DEFAULT NULL,
                          `lang` varchar(50) DEFAULT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('list',$field);
        /**
        * 4、增加新表
        * id		添加信息自动增加
        * listid	所属信息ID
        * paraid	参数名称ID，met_code_parameter表ID值
        * info 		参数值
        * imgname	附件字段文字名称
        * lang	语言[后台]
        **/
        $field = "`id` int(11) NOT NULL AUTO_INCREMENT,
                          `listid` int(11) NOT NULL,
                          `paraid` int(11) NOT NULL,
                          `info` text,
                          `imgname` varchar(255) NOT NULL,
                          `lang` varchar(50) NOT NULL,
                          PRIMARY KEY (`id`)";
        $this->createsql('plist',$field);
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
                    `lang` varchar(20) NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `name_lang` (`name`,`m_name`,`lang`)";
        $this->createsql('cloud_config',$field);
        
        //添加应用应用信息
        $updatetime = time();
        $query = "INSERT INTO {$_M['table']['applist']} SET no='{$this->no}',ver='{$this->ver}',m_name='{$this->m_name}',m_class='index',m_action='doindex',appname='\$_M[''word''][''fwname'']',info='\$_M[''word''][''fwjs'']',updatetime='{$updatetime}'";
        DB::query($query);
        
        //ifcolumn_addfile应用生成文件所调用事件的信息表
        $query = "INSERT INTO {$_M['table']['ifcolumn_addfile']} SET no='{$this->no}',filename='index.php',m_name='{$this->m_name}',m_module='web',m_class='index',m_action='doindex'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['ifcolumn_addfile']} SET no='{$this->no}',filename='code.php',m_name='{$this->m_name}',m_module='web',m_class='index',m_action='docode'";
        DB::query($query);
        
        //ifcolumn栏目接口,先查询栏目是否有重复
        $query = "select * from {$_M['table']['column']} where foldername='code'";
        $catalog = DB::get_one($query);
        if($catalog){
            $catalog1 = random(5,4);
            $catalog1 = 'code'.$catalog1;
        } else {
            //查询栏目接口是否有重复
            $query = "select * from {$_M['table']['ifcolumn']} where fixed_name='code'";
            $fixed_name = DB::get_one($query);
            if($fixed_name){
                $catalog1 = random(5,4);
                $catalog1 = 'code'.$catalog1;
            }else{
                $catalog1 = 'code';
            }
        }
        //栏目接口信息入库
        $query = "INSERT INTO {$_M['table']['ifcolumn']} SET no='{$this->no}',name='{$this->m_name}',appname='\$_M[''word''][''fwmodule'']',addfile='1',memberleft='1',uniqueness='0',fixed_name='{$catalog1}'";
        DB::query($query);
        
        //app_plugin应用插件
        $query = "INSERT INTO {$_M['table']['app_plugin']} SET no_order='1',no='{$this->no}',m_name='{$this->m_name}',m_action='doweb',effect='1'";
        DB::query($query);
        
        //执行默认值安装
        $this->mrz();
    }
}
?>