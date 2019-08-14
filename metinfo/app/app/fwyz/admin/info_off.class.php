<?php
defined('IN_MET') or exit ('No permission');

load::own_class('admin/class/fwadmin');
load::own_func('admin');

class info_off extends fwadmin {
    
    //完整表名
    private $sqlk;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
    }
    
    public function doeditorinfo() {
        global $_M;
        
        //内容判断修改或者新增
        if($_M['form']['id']){
            $this->amend();
        }else{
            $this->add();
        }

        if($this->tname == 'info'){
            $recycle    = '&recycle= 1';
        }
        if(($this->tname == 'parameter' && $_M['form']['id']) || $this->tname == 'info'){
            turnover($_M['url']['own_name'] . 'c=table_on&a=do'.$this->tname.$recycle, $_YW['t']['yw041']);
        }
        turnover($_M['url']['own_name'] . 'c=info_on&a=doeditor'.$this->tname, $_YW['t']['yw041']);
    }
    
    //新增
    private function add() {
        global $_M;
        $form   = $_M['form'];
        if($this->tname == 'info'){
            $form['issue'] = Agly(); //获取管理员
            $form['addtime'] = Atime('1');
            $form['amendtime'] = Atime('1');
        }
        
        $field  = $this->datafield($form, $this->sqlk);
        $infoid =  DB::query("INSERT INTO {$this->sqlk} SET {$field} ");
        $form['info_id']    = DB::insert_id($infoid);
        
        if($this->tname == 'info'){
            $this->addcodesql($form,$form['info_id']);
            //自定义字段
            $zdy    = load::own_class('custom_field','new');
            $zdy->set('operation','add');
            $zdy->set('listid',$form['info_id']);
            $zdy->save();
        }
    }
    
    //修改
    private function amend() {
        global $_M,$_YW;
        $form   = $_M['form'];
        if($this->tname == 'info'){
            $form['issue'] = Agly(); //获取管理员
            $form['amendtime'] = Atime('1');
            $form   = cloud::delkey($form,'addtime');//删除防伪码
            $this->addcodesql($form,$form['id']);
            //自定义字段
            $zdy    = load::own_class('custom_field','new');
            $zdy->set('listid',$_M['form']['id']);
            $zdy->save();
        }
        
        $where  = " id = '{$form['id']}' AND lang = '{$_M['lang']}' ";
        $field  = $this->datafield($form, $this->sqlk);
        DB::query("UPDATE {$this->sqlk} SET {$field} WHERE {$where} ");
    }
    

    /*
     * 字段信息
     * @param   $form    数据
     * @param   $sqlk    数据库/ 字符串则默认是数据库，为数组则默认是数据库数据
     */
    private function datafield($form,$sqlk = '') {
        global $_M;
        $sqlk   = $sqlk == ''?$this->sqlk:$sqlk;
        $karr = DB::get_all("DESC {$sqlk}");
        foreach ($karr as $v) {
            $sqlarr[$v['Field']] = $v['Field'];
        }
        $formarr = array_intersect_key($form, $sqlarr);
        foreach ($formarr as $k => $v) {
            $zfc .= $k . "=" . "'" . $v . "'" . ",";
        }
        return rtrim($zfc, ",");
    }
    
}
?>