<?php
defined('IN_MET') or exit ('No permission');

load::own_class('admin/class/fwadmin');

//表格
class table_ajax extends fwadmin {
    
    /*
     * @param   $namearr    可使用此类的表名数组
     * @param   $list       列表
     * @param   $sqlk       完整表名
     */
    private $namearr    = array('code','info','parameter','list','record');
    
    //列表
    private $list;

    //表名
    private $sqlk;
    
    //简短数据库名
    public $tname;
    
    //搜索数组，安全过滤使用
    private $search_arr = array('code','num','title');

    //搜索关键词
    private $search = '';
    
    //搜索字段
    private $search_field = '';
    
    /*
     * 临时字段 判断列表类型
     * recycle      code 数据判断
     * info_id      info ID
     * parameter    parameter 某ID表数据
     * infodata     信息
     */
    
    private $recycle;
    private $info_id;
    private $parameter;
    private $infodata;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
        $this->recycle  = $_M['form']['recycle'];
    }
    
    //表格数据
    public function dotable() {
        global $_M;
        //加载表格数据获取类
        $table = load::sys_class('tabledata', 'new');
        //显示字段
        $field  = $this->sqlfield();
        //查询条件
        $where = $this->where(); 
        //排序方式
        $order = $this->order(); 
        //获取数据
        $data   = $table->getdata($this->sqlk, $field, $where, $order);
        //数据整理
        $array  = $this->sqlarr($data);
        //返回数据
        $table->rdata($array);
    }
    
    /*
     * 【列出】
     * 显示字段
     */
    private function sqlfield() {
        global $_M;
        $field  = '*';
        return $field;
    }


    /*
     * 【列出】
     * 搜索
     */
    private function search() {
        global $_M;
        $this->search       = trim(strtoupper($_M['form']['search']));
        if($this->search == '') return ''; 
        
        $this->search_field = $_M['form']['search_field'];
        if($this->tname == 'code') $this->search_field = 'code';
        
        if($this->search && in_array($this->search_field, $this->search_arr)){
            $field  = " AND {$this->search_field} like '%{$this->search}%' ";
        }
        
        return $field;    
    }

    /*
     * 【列出】
     * SQL判断语句
     */
    private function where() {
        global $_M;
        $where  = "lang = '{$_M[lang]}' ";
        switch ($this->tname) {
            case 'info':
                if($_M['form']['info_id']) $where .= " AND id = '{$_M['form']['info_id']}' ";
            case 'code':
                $where .= $this->search();
                $where .= " AND recycle = '{$this->recycle}' ";
                if($_M['form']['info_id'] && $this->tname != 'info') $where .= " AND info_id = '{$_M['form']['info_id']}' ";
                break;
            case 'list':
                $where .= " AND bigid = '{$_M['form']['pid']}' ";
                break;
            case 'record':
                if($_M['form']['code_id']) $where .= " AND code_id = '{$_M['form']['code_id']}' ";
                break;
            default:
                break;
        }
        
        return $where;
    }
    
    /*
     * 【列出】
     * SQL排序方式语句
     */
    private function order() {
        global $_M;
        $order   = ' `id` desc';
        switch ($this->tname) {
            case 'parameter':
                $order  =   ' `no_order`';
                break;
            case 'info':
            case 'code':
                if($this->recycle){
                    $order  =   ' `no_order` asc,'.$order;
                }else{
                    $order  =   ' `deltime` DESC,'.$order;
                }
                
                if($this->tname == 'code' && $_M['form']['total']) $order =  ' `total` '.$_M['form']['total'].','.$order;
                break;
            default:
                break;
        }
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
            if($tname == 'code'){
                //获取所有的id
                $idarr  = array_column($data, 'info_id');
                $this->info_id = arrayto_string(array_unique($idarr),',');
                $this->infodata();
            }
            if($tname == 'info'){
                //获取备份URL
                $this->url('info','tname=code&recycle='.$this->recycle);
                //获取所有的id
                $this->info_id = array_column($data, 'id');
                $this->codenum();
            }
            
            if($tname == 'list'){
                $tname  = 'dolist';
                $this->parameterdata();
            }
            
            if($tname == 'record'){
                parent::modecolor();
                if(!$_M['form']['code_id']) $this->info_id = arrayto_string(array_column($data, 'code_id'),',');
                $this->codedata();
            }
            
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
        switch ($this->tname) {
            case 'info':
                $a  = '<a href="'.$_M['url']['own_name'].'c=info_on&a=doeditorinfo&id='.$val['id'].'">'.$_YW['t']['yw169'].'</a>&nbsp;&nbsp;<a href="'.$this->backupurl.'&info_code_id='.$val['id'].'" data-confirm="'.$_YW['t']['yw073'].'">'.$_YW['t']['yw087'].'</a>&nbsp;&nbsp;';
            case 'code':
                $operation    =    $this->recycle?$a:date('Y-m-d H:i:s', $val['deltime']);
                if($this->recycle){
                    $operation    .=    '
                            <a href="'.$_M['url']['own_name'].'c=table_off&a=dotable&submit_type=delamend&allid='.$val['id'].'&tname='.$this->tname.'&recycle='.$val['recycle'].'" data-confirm="' . $_YW['t']['yw008'] . '">' . $_YW['t']['yw173'] . '</a>';
                }
                break;
            case 'parameter':
                if ($val['type'] == '2' || $val['type'] == '4' || $val['type'] == '6') {
                    $operation = '<a href="' . $_M['url']['own_name'] . 'c=table_on&a=dolist&pid=' . $val['id'] . '" target="_blank" >' . $_YW['t']['yw157'] . '</a>&nbsp;&nbsp;';
                } else {
                    $operation = '<a href="' . $_M['url']['own_name'] . 'c=info_on&a=doparameter&id=' . $val['id'] . '" >' . $_YW['t']['yw111'] . '</a>&nbsp;&nbsp;';
                }
                break;
            case 'list':
                $del  = '&pid='.$_M['form']['pid'];
                break;
            case 'record':
                $del  = '&code_id='.$_M['form']['code_id'];
                break;
            default:
                break;
        }
        if($this->tname != 'code' && $this->tname != 'info'){
            $operation .= '<a href="' . $_M['url']['own_name'] . 'c=table_off&a=dotable&submit_type=del&allid=' . $val['id'] .$del. '&tname='.$this->tname.'" data-confirm="' . $_YW['t']['yw012'] . '">' . $_YW['t']['yw007'] . '</a>';
        }
        
        $this->list[] = $operation;
    }
    
    /*
     * 【新行】
     * 新增行分发
     */
    public function doifai(){
        global $_M;
        $val['id'] = 'new-'.$_M['form']['ai'];
        $tname  = $this->tname;
        if(in_array($tname,$this->namearr)){
            if($tname == 'list'){
                $tname  = 'dolist';
                $this->parameterdata();
            }
            $this->$tname($val,'checked=""');
        }
        $this->addlist();
    }
    
    /*
     * 【新行】
     * 生成文件新增行
     */
    private function addlist() {
        global $_M,$_YW;
        $metinfo = '<tr class="even newlist">';
        foreach ($this->list as $v){
            $metinfo .= '<td class=" met-center">'.$v.'</td>';
        }
        $metinfo    .= '<td class=" met-center"><a href="" class="delet">'.$_YW['t']['yw052'].'</a></td></tr>';
        echo $metinfo;
    }

    //防伪码列表
    private function code($val,$checked = '') {
        global $_M,$_YW;
        $code   = $val['code'];
        if($this->search){
            $val[$this->search_field] = str_ireplace($this->search, '<font color="#FF0000">'.$this->search.'</font>', $val[$this->search_field]);
        }
        $this->list   = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        if($this->recycle){
            $this->list[] = '<input name="no_order-'.$val['id'].'" class="ui-input met-center" style="max-width:50px;" value="'.$val['no_order'].'" type="text">';
            if(cloud::qcodewechat(1)){
                $title  = $_YW['t']['yw142'].'：'.$code;
                $this->list[] = '<img src="'.$_M['url']['own'].'admin/templates/img/code.png" class="img-rounded qrcode" style="width: 50px;" data-code="'.$code.'" title="'.$title.'" />';
            }
        }
        $this->list[] = $val['code'];
        $this->list[] = '<a href="'.$_M['url']['own_name'].'c=table_on&a=dorecord&code_id='.$val['id'].'">'.$val['total'].'</a>';
        $this->list[] = '<a href="'.$_M['url']['own_name'].'c=table_on&a=doinfo&recycle=1&info_id='.$val['info_id'].'">'.$this->infodata[$val['info_id']]['title'].'</a>';
        $this->list[] = $this->infodata[$val['info_id']]['num'];
        $this->list[] = $this->infodata[$val['info_id']]['info'];
        $this->list[] = $this->infodata[$val['info_id']]['addtime'];
        
    }
    
    //信息模板列表
    private function info($val,$checked = '') {
        global $_M,$_YW;
        if($this->search){
            $val[$this->search_field] = str_ireplace($this->search, '<font color="#FF0000">'.$this->search.'</font>', $val[$this->search_field]);
        }
        $this->list   = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        if($this->recycle) $this->list[] = '<input name="no_order-'.$val['id'].'" class="ui-input met-center" style="max-width:50px;" value="'.$val['no_order'].'" type="text">';
        $this->list[] = $val['title'];
        $this->list[] = $val['num'];
        $this->list[] = '<a href="'.$_M['url']['own_name'].'c=table_on&a=docode&recycle=1&info_id='.$val['id'].'">'.$_YW['t']['yw299'].'：<font color="#FF0000">'.$this->infodata[$val['id']]['new'].'</font></a>&nbsp;&nbsp;'
                        . '<a href="'.$_M['url']['own_name'].'c=table_on&a=docode&recycle=0&info_id='.$val['id'].'">'.$_YW['t']['yw300'].'：'.$this->infodata[$val['id']]['old'].'</a>&nbsp;&nbsp;'
                        . $_YW['t']['yw007'].'：'.$val['delcodenum'];
        $this->list[] = $val['info'];
        if($this->recycle) $this->list[] = $val['amendtime'];
    }
    
    //字段列表
    private function parameter($val,$checked = '') {
        global $_YW;
        $this->list = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        $this->list[] = '<input name="no_order-'.$val['id'].'" class="ui-input met-center" style="max-width:40px;" value="'.$val['no_order'].'" type="text">';
        $this->list[] = '<input name="name-'.$val['id'].'" class="ui-input met-center" value="'.$val['name'].'" style="width:92%;" type="text" data-required="1">';
        $this->list[] = '<input name="description-'.$val['id'].'" class="ui-input met-center"  value="'.$val['description'].'" style="width:95%;" type="text">';
        
        $this->list[] = '<select name="type-' . $val['id'] . '" data-checked="' . $val['type'] . '">'
                        . '<option value="1">' . $_YW['t']['yw158'] . '</option>'
                        . '<option value="2">' . $_YW['t']['yw159'] . '</option>'
                        . '<option value="3">' . $_YW['t']['yw160'] . '</option>'
                        . '<option value="4">' . $_YW['t']['yw161'] . '</option>'
                        //. '<option value="5">' . $_YW['t']['yw162'] . '</option>'
                        . '<option value="6">' . $_YW['t']['yw163'] . '</option>'
                        . '<option value="7">' . $_YW['t']['yw172'] . '</option></select>';
        $this->list[] = '<input name="wr_ok-'.$val['id'].'" value="1" type="checkbox" data-checked="'.$val['wr_ok'].'">';
    }
    
    //字段列表
    private function dolist($val,$checked = '') {
        $stat = '';
        if($this->parameter['type'] == 2 || $this->parameter['type'] == 6) {
            $type   = 'radio';
            $name   = 'morz';
            if($val['default_value']) {//&& $checked == ''
                $stat = 'checked';
            }
        }
        
        if($this->parameter['type'] == 4) {
            $type   = 'checkbox';
            $name   = 'morz-'.$val['id'];
//            if($checked == ''){
                foreach (explode('-',$this->parameter['mrz']) as $val1) {
                    if($val['default_value']) {
                        $stat = 'checked';
                    }
                }
//            }
        }
        
        $this->list = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        $this->list[] = '<input name="no_order-'.$val['id'].'" class="ui-input met-center" style="max-width:40px;" value="'.$val['no_order'].'" type="text">';
        $this->list[] = '<input name="info-'.$val['id'].'" class="ui-input"  value="'.$val['info'].'" style="width:85%;" type="text" data-required="1">';
        $this->list[] = '<input name="'.$name.'" value="'.$val['id'].'" class="mrzz" type="'.$type.'" '.$stat.' >';
    }
    
    //统计列表
    private function record($val,$checked = '') {
        global $_M,$_YW;
        $this->list = array();
        $this->list[] = '<input name="id" value="'.$val['id'].'" type="checkbox" '.$checked.'>';
        $this->list[] = $this->infodata[$val['code_id']];
        $this->list[] = $val['issue'];
        $this->list[] = $val['ip'];
        $this->list[] = $val['country'] != ''?$val['country'].' '.$val['prov'].' '.$val['city']:$_YW['t']['yw301'];
        $this->list[] = '<font color="'.$this->modecolor['color'][$val['mode']].'">'.$this->modecolor['mode'][$val['mode']].'</font>';

        $this->list[] = date("Y-m-d H:i:s",$val['time']);
    }


    //parameter 数据
    private function parameterdata() {
        global $_M,$_YW;
        $query = "SELECT * FROM {$_YW['k']['parameter']} where lang='{$_M['lang']}' AND id = '{$_M['form']['pid']}' ";
        $this->parameter = DB::get_one($query);
    }
    
    //info 信息
    private function infodata() {
        global $_M,$_YW;
//        $zdy    = load::own_class('custom_field','new');
//        $zdy->set('listid',  stringto_array($this->info_id,',') );
//        $plist = $zdy->table();
        $query  = "SELECT * FROM {$_YW['k']['info']} WHERE id IN({$this->info_id}) AND lang = '{$_M['lang']}' ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $this->infodata[$val['id']]  = $val;
//            $this->infodata[$val['id']]['plist']  = $plist[$val['id']];
        }
    }
    
    //获取单条code数据
    private function codedata() {
        global $_M,$_YW;
        if($_M['form']['code_id']){
            $query  = "SELECT id,code FROM {$_YW['k']['code']} WHERE id = '{$_M['form']['code_id']}' ";
            $code   = DB::get_one($query);
            $this->infodata[$code['id']]  = $code['code'];
        }else {
            $query  = "SELECT * FROM {$_YW['k']['code']} WHERE id IN({$this->info_id}) ";
            $result = DB::query($query);
            while($val = DB::fetch_array($result)){
                $this->infodata[$val['id']]  = $val['code'];
            }
        }
        
    }


    //获取防伪码个数
    private function codenum() {
        global $_M,$_YW;
        foreach ($this->info_id as $val){
            $this->infodata[$val]['old']   =  DB::counter($_YW['k']['code'] , "WHERE info_id ='{$val}' AND recycle = '0' ");
            $this->infodata[$val]['new']   =  DB::counter($_YW['k']['code'] , "WHERE info_id ='{$val}' AND recycle = '1' ");
        }
    }

}

?>