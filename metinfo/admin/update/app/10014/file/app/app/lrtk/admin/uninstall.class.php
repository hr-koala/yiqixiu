<?php
defined('IN_MET') or exit ('No permission');

load::sys_class('admin');
load::sys_class('nav.class.php');
load::sys_func('file');

class uninstall extends admin {

    private $no;    //应用NO值
    private $m_name;  //应用文件夹
    private $file = '';  //前台入口文件
    
    public function __construct() {
        global $_M;
        parent::__construct();
        $this->no   = $_M['form']['no'];
        $this->firstsql();
    }

    public function dodel() {
        global $_M;
        //删除一些提前删除的内容

        //删除自定义表
        $this->zdysql();
        
        //删除固定的app表
        $this->appsql();
        
        //删除应用文件
        $this->delfile();
    }
    
    //优先执行代码[推荐]
    private function firstsql() {
        global $_M;
        //查询应用的文件夹
        $mname    = $this->sqlone('applist');
        $this->m_name = $mname['m_name'];
        //查询应用是否使用栏目
        $where  = "module='{$this->no}'";
        $file   = $this->sqlone('column',$where);
        if($file){
            $this->file = $file['foldername'];
        }
    }

    //删除自定义表
    private function zdysql() {
        global $_M;
        $zdy    = array('yw_lrtk');
        foreach ($zdy   as $val){
            $zdys[] = $val;
        }
        //删除云配置文件//cloud_config
//        $zdys[]  = $this->cloud();
        //删除自定义表
        foreach ($zdys as $val){
            $this->deltablesql($val);
        }
        //删除配置文件
        foreach ($zdys as $val){
            $zdyc   .= $val;
        }
        del_table($zdyc);
    }

    //删除固定的app表
    private function appsql() {
        global $_M;
        //删除栏目接口表
        $this->delsql('ifcolumn');
        
        //删除应用生成文件所调用事件的信息表
        $this->delsql('ifcolumn_addfile');
        
        //删除会员侧导航信息表
        $this->delsql('ifmember_left');
        
        //删除应用插件表
        $this->delsql('app_plugin');

        //删除网站后台栏目信息表
        $where  = "field='{$this->no}'";
        $this->delsql('admin_column',$where);
        
        //删除网站栏目信息表
        $where  = "module='{$this->no}'";
        $this->delsql('column',$where);
        
        //删除语言表
        $where  = "app='{$this->no}'";
        $this->delsql('language',$where);
        
        //删除应用注册表
        $this->delsql('applist');
    }

    //删除应用文件夹
    private function delfile() {
        if($this->file){
            deldir('../'.$this->file);
        }
        if($this->m_name){
            deldir('../app/app/'.$this->m_name);
        }
    }
    
    //对公用配置表卸载处理
    private function cloud() {
        global $_M;
        $where  = "m_name='{$this->m_name}'";
        if($this->sqlcounter('cloud_config',$where) > 0){
            $this->delsql('cloud_config',$where);
        }
        if($this->sqlcounter('cloud_config') == 0){
            return 'cloud_config';
        }
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
    private function sqlcounter($tname,$where = '') {
        global $_M;
        $table  = $_M['table'][$tname];
        if($where){
            $where  = 'WHERE '.$where;
        }
        return DB::counter("{$table} {$where}");
    }
    
    //公共删除数据
    private function delsql($tname,$where = '') {
        global $_M;
        $table  = $_M['table'][$tname];
        if(!$where){
            $where  = "no='{$this->no}'";
        }
        DB::query("DELETE FROM {$table} WHERE {$where}");
    }
    
    //公共删除表
    private function deltablesql($tname) {
        global $_M;
        $table  = $_M['table'][$tname];
        DB::query("DROP TABLE `{$table}`");
    }

}
?>