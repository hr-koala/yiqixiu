<?php

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::own_class('cloud');

//后台管理类
class appadmin extends admin{
    
    /*
     * $urlc            URL上c的值
     * $urla            URL上a的值
     * $action          表单提交URL
     * $tableajax       table数据获取URL
     * $addlisturl      table新增行URL
     * $tname           当前数据库缩写
     */
    public $urlc;
    public $urla;
    public $action;
    public $tableajax;
    public $addlisturl;
    public $tname;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        self::doconfig('doywt,doywc');
    }
    
    #加载cloud方法
    public function doconfig($str = '') {
        $arr    = explode(",",$str);
        foreach ($arr as $val) {
            cloud::$val();
        }
    }
    
    #URL上c的值 a的值
    public function urlca($c,$a) {
        $this->urlc = $c;
        $this->urla = $a;
    }
    
    #URL处理
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
    }
    
    #删除表数据
    public function delsql($sqlk,$where){
        global $_M;
        DB::query("DELETE FROM {$sqlk} WHERE {$where} ");
    }
    
    #修改表数据
    public function amendsql($sqlk,$field,$where) {
        global $_M;
        DB::query("UPDATE {$sqlk} SET {$field} WHERE {$where} ");
    }
    
    #新增表数据
    public function addsql($sqlk,$field) {
        global $_M;
        DB::query("INSERT INTO {$sqlk} SET {$field}");
    }
    
    #获取线路信息
    public function linecontent($id) {
        global $_M,$_YW;
        $query  = "SELECT num,info FROM {$_YW['k']['line']} where id = '{$id}' ";
        return DB::get_one($query);
    }
    
    #获取时间路线信息
    public function linetimecontent($id) {
        global $_M,$_YW;
        $query  = "SELECT * FROM {$_YW['k']['linetime']} where id = '{$id}' ";
        $info = DB::get_one($query);
        $info['line'] = self::linecontent($info['line']);
        return $info;
    }
    
    

}

?>