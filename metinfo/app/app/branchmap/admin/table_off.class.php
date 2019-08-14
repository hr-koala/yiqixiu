<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appadmin');

//表格
class table_off extends appadmin {
    
    //获取的ID
    private $allid;

    //表名
    private $sqlk;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
    }

    //主方法
    public function doindex(){
        global $_M,$_YW;
        $this->allid  = array_filter(explode(',', $_M['form']['allid']));
        switch ($_M['form']['submit_type']) {
            case 'del':
                $this->del();
                break;
            default:
                break;
        }

        turnover($_M['url']['own_name'] . 'c=table_on&a=do'.$this->tname, $_YW['t']['yw008']);
    }
    
    //删除
    private function del() {
        global $_M;
        foreach ($this->allid as $id) {
            if($id){
                //删除记录
                if($this->tname == 'detailed'){
                    DB::query("DELETE FROM {$_YW['k']['operating']} WHERE infoid = '{$id}' ");
                }
                //删除本表
                $where  = " id = '{$id}' ";
                DB::query("DELETE FROM {$this->sqlk} WHERE {$where} ");
            }
        }
    }
}
?>