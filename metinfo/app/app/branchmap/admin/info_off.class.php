<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appadmin');

class info_off extends appadmin {
    
    //完整表名
    private $sqlk;
    
    private $form;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->form     = $_M['form'];
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
    }
    
    public function doindex() {
        global $_M,$_YW;
        //内容判断是否要正式发布
        if($_M['form']['id']){
            $this->amend();
        }else{
            $this->add();
        }
        
        turnover($_M['url']['own_name'] . 'c=table_on&a=do'.$this->tname, $_YW['t']['yw008']);
    }
    
    //新增
    private function add() {
        global $_M;
        $field  = $this->field();
        DB::query("INSERT INTO {$this->sqlk} SET {$field} ");
    }
    
    //修改
    private function amend($id = '') {
        global $_M;
        $where  = " id = '{$_M['form']['id']}' ";
        $field  = $this->field();
        DB::query("UPDATE {$this->sqlk} SET {$field} WHERE {$where} ");
    }
    
    //字段
    private function field(){
        global $_M,$_YW;
        $info   = "
            name        = '{$this->form['name']}',
            region      = '{$this->form['region']}',
            lnglat      = '{$this->form['lnglat']}',
            address     = '{$this->form['address']}',
            province    = '{$this->form['select1']}',
            city        = '{$this->form['select2']}',
            district    = '{$this->form['select3']}',
            tel         = '{$this->form['tel']}',
            fixedtel    = '{$this->form['fixedtel']}',
            lang        = '{$_M['lang']}'
                ";
        if($_YW['c']['typeon']) $info .= ", type    = '{$this->form['type']}'";
        return $info;
    }
    
    
}
?>