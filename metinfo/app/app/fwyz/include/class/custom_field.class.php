<?php
/*
 * 作者：蝴蝶效应
 * QQ：415420792
 */
defined('IN_MET') or exit('No permission');

//自定义字段类
class custom_field {

    //当前应用文件名
    private $m_name    = M_NAME;
    
    //当前语言
    private $lang;

    //查询自定义字段
    private $parameter = array();

    //选项
    private $list = array();
    
    //处理过程中需要的数据转变
    private $batch = array();

    //当前字段类型
    private $type   = '';
    
    //参数内容值
    private $plist = array();
 
    /*
     * 选项的值状态,仅针对选项，单选、多选、下拉’
     * id\info
     * $listid  列表信息ID
     */
    private $option = 'info';
    private $listid = '';

    //保存和修改状态标记，默认为修改
    private $operation = 'amend';

    /*
     * 判断当前显示的字段名
     * 用来标记是否在列表显示的依据
     * $this->displaytype值等于1为显示，设计时需注意
     */
    private $displaytype = 'displaytype';
    
    //初始化
    public function __construct() {
        global $_M;
        $this->lang   = $_M['lang'];
        $this->parameter();
    }
    
    //赋值
    public function set($name,$value) {
        global $_M;
        if($value === NULL){
            return false;
        }
        $name_arr   = array('listid','option','operation','displaytype');
        if(in_array($name,$name_arr)){
            $this->$name    = $value;
        }
    }

    /******************************************************************
     *                         生成form表单HTML
     * ***************************************************************/
    
    //form 时的数据操作
    public function form() {
        if(!is_arrempty($this->parameter)){
            return false;
        }
        
        //获取已有的数据
        if($this->listid != ''){
            $this->plist();
        }
        
        //查询选项
        $this->listxx();
        //组合默认值
        $this->mrz();
        
        //进行数据处理
        foreach ($this->parameter as $key => $val) {
            //当前字段数据转换处理
            $this->ifbatch($val);
            //当前字段类型
            $this->type = $val['type'];
            //根据选项的不同使用时稍作调整
            $type   = array(1=>'input',2=>'select',3=>'textarea',4=>'checkboxradio',5=>'enclosure',6=>'checkboxradio',7=>'datetime');
            $list[] = $this->$type[$this->type]();
        }
        
        //输出HTML
        foreach ($list as $val) {
            $html  .= '<dl>'.$val.'</dl>';
        }
        
        return $html;
    }
    
    //对使用的一些判断进行批量处理
    private function ifbatch($val) {
        $this->batch  = '';
        //name
        $this->batch['name']        = 'zdy_'.$val['id'];
        //是否必填
        $this->batch['wr_ok']       = $val['wr_ok'] == 1?' data-required="1" ':'';

        //title
        $this->batch['title']       = '<dt>'.$val['name'].'</dt>';
        //字段说明
        $this->batch['tips']        = '<span class="tips">'.$val['description'].'</span>';
        
        //默认值
        $this->batch['default']     = $this->plist[$val['id']]['info'];
        
        //下拉选项
        if($val['type'] == 2){
            foreach ($this->list[$val['id']] as $k => $v){
                $this->batch['option']    .= '<option value="'.$v[$this->option].'">'.$v['info'].'</option>';
            }
        }
        
        //单选\多选
        if(in_array($val['type'],array(4,6))){
            $type   = $val['type'] == 4?'checkbox':'radio';
            $i  = 0;
            foreach ($this->list[$val['id']] as $k => $v){
                $wr_ok  = $default = '';
                if($i == 0){
                    $wr_ok      = $this->batch['wr_ok'];
                    $default    = '  data-checked = "'.$this->batch['default'].'"';
                }
                $this->batch['option']    .= '<label><input name="'.$this->batch['name'].'" type="'.$type.'" value="'.$v[$this->option].'" '.$wr_ok.$default.'>'.$v['info'].'</label>';
                $i++;
            }
        }
        
    }
    
    /******************************************************************
     *                         form类型html
     * ***************************************************************/

    //简短输入框样式
    private function input() {
        global $_M;
        //data-required
        return  $this->batch['title']
                                .'<dd class="ftype_input">
                                    <div class="fbox">
                                        <input type="text" name="'.$this->batch['name'].'" value="'.$this->batch['default'].'" '.$this->batch['wr_ok'].'>
                                    </div>
                                    '.$this->batch['tips'].'
                                </dd>';
    }
    
    //文本输入框
    private function textarea() {
        global $_M;
        return  $this->batch['title']
                                .'<dd class="ftype_textarea">
                                        <div class="fbox">
                                                <textarea name="'.$this->batch['name'].'" '.$this->batch['wr_ok'].'>'.$this->batch['default'].'</textarea>
                                        </div>
                                        '.$this->batch['tips'].'
                                </dd>';
    }
    
    //下拉菜单 
    private function select() {
        global $_M,$_YW;
        return   $this->batch['title']
                                .'<dd class="ftype_select">
                                        <div class="fbox">
                                                <select name="'.$this->batch['name'].'" '.$this->batch['wr_ok'].'  data-checked = "'.$this->batch['default'].'"' .'>
                                                        <option value="">'.$_YW['t']['yw155'].'</option>
                                                        '.$this->batch['option'].'
                                                </select>
                                        </div>
                                        '.$this->batch['tips'].'
                                </dd>';
       
    }
    
    //单选和多选
    private function checkboxradio() {
        global $_M;
        $ftype  = $this->type == 4?'ftype_checkbox':'ftype_radio';
        return   $this->batch['title']
                                .'<dd class="'.$ftype.' ftype_transverse">
                                        <div class="fbox">
                                                '.$this->batch['option'].'
                                        </div>
                                        '.$this->batch['tips'].'
                                </dd>';
    }
    
    //附件
    private function enclosure() {
        
    }

    //日期时间
    private function datetime() {
        global $_M;
        return  $this->batch['title']
                                .'<dd class="ftype_day">
                                        <div class="fbox">
                                            <input type="input" name="'.$this->batch['name'].'" '.$this->batch['wr_ok'].' value="'.$this->batch['default'].'" >
                                        </div>
                                        '.$this->batch['tips'].'
                                </dd>';
    }





    /******************************************************************
     *                         form 表单数据保存
     * ***************************************************************/
    public function save($form = ''){
        global $_M;
        if($form == '') $form   = $_M['form'];
        //$key 是ID 等于$val['id']
        foreach ($this->parameter as $key => $val) {
            if($form['zdy_' . $key] != ''){
                $zid[$key]  = array('info' => $form['zdy_' . $key],'imgname'=> $val['name']);
            }
        }

        $paraid = array();
        if($this->operation == 'amend'){
            $this->plist();
            $paraid = $this->plist;
        }
        
        //判断是否有新增
        $arr    = array_diff_key ($zid,$paraid);
        foreach ($arr as $k => $v){
            $query = "INSERT INTO {$_M['table'][$this->m_name.'_plist']} SET listid = '{$this->listid}',paraid = '{$k}',info = '{$v['info']}', imgname = '{$v['imgname']}',lang = '{$this->lang}' ";
            DB::query($query);
        }
        
        //判断是否有删除【删除不在这里控制】【转为列表控制】
        //$arr    = array_diff_key ($paraid,$zid);
        
        //判断要修改的
        $arr    = array_intersect_key($zid,$paraid);
        foreach ($arr as $k => $v){
            $query = "UPDATE {$_M['table'][$this->m_name.'_plist']} SET info = '{$v['info']}',imgname = '{$v['imgname']}' where listid = '{$this->listid}' AND paraid = '{$k}' AND lang = '{$this->lang}'";
            DB::query($query);
        }
        
    }


    /******************************************************************
     *                        table 表格标题\列表数据
     * ***************************************************************/
    
    /*
     * 返回需要显示的标题
     * $title   数组
     * $index   插入位置，数组是从0开始计算的
     */
    public function title($title,$index = 1) {
        global $_M;
        //$title防止他之前还有其他标题
        //$key 是ID 等于$val['id']
        foreach ($this->parameter as $key => $val) {
            if($val[$this->displaytype] == 1){
                $t[]  = $val['name'];
            }
        }
        
        array_splice($title, $index, 0, $t);
        return $title;
    }
    
    //表格数据 接受listid数组
    public function table() {
        global $_M;
        //$key 是ID 等于$val['id']
        foreach ($this->parameter as $key => $val) {
//            if($val[$this->displaytype] == 1){
                $paraid  .= $val['id'].',';
                //当前数据类别
                $type[$val['id']]  = $val['type'];
//            }
        }
        $paraid = rtrim($paraid, ",");

        $this->listxx(" bigid IN({$paraid}) AND ");
        
        $listid = arrayto_string($this->listid,',');

        $query  = "SELECT id,listid,info,paraid FROM {$_M['table'][$this->m_name.'_plist']} WHERE listid IN({$listid}) AND paraid IN({$paraid}) AND lang = '{$this->lang}' ORDER BY FIND_IN_SET(paraid,'{$paraid}') ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $plist[$val['listid']][$val['id']]  = array(
                'info'      => $val['info'],
                'type'    => $type[$val['paraid']],
            );
        }
        
        $enlist = array();
        foreach ($this->listid as $val){
            foreach ($plist[$val] as $v) {
                if(in_array($v['type'],array(2,4,6))){  //246
                    $str    = $zfc    = '';
                    if($v['type'] == 4){
                        $str    = explode('|',$v['info']);
                        foreach ($str as $vxx) {
                            $zfc .= $this->list[$vxx].'|';
                        }
                        $enlist[$val][] = rtrim($zfc, "|");
                    }else{
                        $enlist[$val][] = $this->list[$v['info']];
                    }
                }else{
                    $enlist[$val][] = $v['info'];
                }
            }
        }
        return $enlist;
    }
     

   /******************************************************************
     *                          公共数据查询
     * ***************************************************************/

    //查询parameter字段
    private function parameter() {
        global $_M;
        //按照ID组成新数组
        $query = "SELECT * FROM {$_M['table'][$this->m_name.'_parameter']} where lang='{$this->lang}' ORDER BY no_order";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $this->parameter[$val['id']]    = $val;
        }
    }
    
    //查询选项
    private function listxx($where = '') {
        global $_M;
        $query = "SELECT * FROM {$_M['table'][$this->m_name.'_list']} where {$where} lang = '{$this->lang}' ORDER BY no_order";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            if($where){
                $this->list[$val['id']]  = $val['info'];
            }else{
                $this->list[$val['bigid']][$val['id']]    = $val;
            }
        }
    }
    
    //查询数据内容
    private function plist() {
        global $_M;
        //先获取默认值
        $query = "SELECT * FROM {$_M['table'][$this->m_name.'_plist']} where lang = '{$this->lang}' AND listid = '{$this->listid}' ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $this->plist[$val['paraid']]    = array('id'=>$val['id'],'info'=>$val['info']);
        }
    }
    
    //默认值
    private function mrz() {
        global $_M;
        foreach ($this->parameter as $val) {
            if($this->plist[$val['id']]['info'] == ''){
                $info   = '';
                if(in_array($val['type'],array(2,4,6))){
                    foreach ($this->list[$val['id']] as $v) {
                        if ($v['default_value']) {
                            if($val['type'] == 4){
                                $info  .= "|" . $v['info'];
                            }else{
                                $info  = $v['info'];
                            }
                        }
                    }
                }else{
                    $info  = $val['mrz'];
                }
                $this->plist[$val['id']]  = array('info'=>$info);
            }
        }
    }
    
    
}

/*
 * QQ：415420792
 * 生成修改表单
 * $zdy    = load::own_class('custom_field','new');
    $zdy->set('listid',$id);
    $info    = $zdy->form();
 
 * 生成新表单
 *  $zdy    = load::own_class('custom_field','new');
    $info = $zdy->form();
 
 * 保存新表单
 * $zdy    = load::own_class('custom_field','new');
    $zdy->set('operation','add');
    $zdy->set('listid',$id);
    $zdy->save();
 
 * 保存修改表单
 * $zdy    = load::own_class('custom_field','new');
    $zdy->set('listid',$id);
    $zdy->save();
  
 * 表格title 生成方式
 * $zdy    = load::own_class('custom_field','new');
    $zdy->set('displaytype','displaytype');
    $title = $zdy->title($title,1);

 * 表格列表数据
 * $zdy    = load::own_class('custom_field','new');
    $zdy->set('listid',$listid);
    $table = $zdy->table();
 * 
 * 实现自动生成表单填写字段
 * 实现表单修改
 * 
 * 实现表格列表中按照需要显示内容
 */

?>