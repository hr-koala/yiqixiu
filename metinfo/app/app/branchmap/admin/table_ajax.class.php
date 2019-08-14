<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appadmin');

//表格
class table_ajax extends appadmin {
    
    //可使用此类的表名数组
    private $namearr    = array('detailed','operating');
    
    //列表
    private $list;

    //表名
    private $sqlk;
    
    //搜索数组，安全过滤使用
    private $search_arr = array('name','type');

    //搜索关键词
    private $search = '';
    
    //搜索字段
    private $search_field = '';

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
    }
    
    //表格数据
    public function doindex() {
        global $_M;
        //加载表格数据获取类
        $table = load::sys_class('tabledata', 'new');
        //查询条件
        $where = $this->where(); 
        //排序方式
        $order = $this->order(); 
        //获取数据
        $data   = $table->getdata($this->sqlk, '*', $where, $order);
        //数据整理
        $array  = $this->sqlarr($data);
        //返回数据
        $table->rdata($array);
    }
    
    /*
     * 【列出】
     * 搜索
     */
    private function search() {
        global $_M;
        $this->search       = trim(strtoupper($_M['form']['search']));
        $this->search_field = $_M['form']['search_field'];
        if($this->search && in_array($this->search_field, $this->search_arr)){
            $field  = " AND {$this->search_field} like '%{$this->search}%' ";
        }

        return $field;
    }

    /*
     * 【列出】
     * SQL判断语句$where .= $this->search();
     */
    private function where() {
        global $_M;
        $where  = "lang = '{$_M[lang]}' ";
        $where .= $this->search();
        return $where;
    }
    
    /*
     * 【列出】
     * SQL排序方式语句
     */
    private function order() {
        global $_M;
        $order   = 'id desc';
        return $order;
    }
    
    /*
     * 【列出】
     * 返回数据数组
     */
    private function sqlarr($data) {
        global $_M;
        $tname  = $this->tname;
        if(in_array($tname,$this->namearr)){
            foreach ($data as $val) {
                $this->$tname($val);
                $this->operation($val);
                $array[] = $this->list;
            }
            return $array;
        }else{
            return false;
        }
    }
    
    //操作
    private function operation($val) {
        global $_M,$_YW;
        if($this->tname == 'detailed') $operation = '<a href="'.$_M['url']['own_name'].'c=info_on&a=dodetailed&id='.$val['id'].'&tname='.$this->tname.'" >'.$_YW['t']['yw005'].'</a>&nbsp;&nbsp;&nbsp;';
        $operation    .=  '<a href="'.$_M['url']['own_name'].'c=table_off&a=doindex&submit_type=del&allid='.$val['id'].'&tname='.$this->tname.'" data-confirm="'.$_YW['t']['yw006'].'" >'.$_YW['t']['yw007'].'</a>';
        $this->list[] = $operation;
    }
    
    //信息列表
    private function detailed($val,$checked = '') {
        global $_M,$_YW;
        if($this->search){
            $val[$this->search_field] = str_ireplace($this->search, '<font color="#FF0000">'.$this->search.'</font>', $val[$this->search_field]);
        }
        $this->list   = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        $this->list[] = $val['name'];
        if($_YW['c']['typeon'])  $this->list[] = $val['type'];
        $this->list[] = $val['province'].$val['city'].$val['district'].$val['address'];
        $this->list[] = $val['region'];
        $this->list[] = $val['tel'];
        $this->list[] = $val['lnglat'];

    }
    
    
}

?>