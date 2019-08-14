<?php
defined('IN_MET') or exit ('No permission');

load::own_class('admin/class/fwadmin');

//表格
class table_off extends fwadmin {
    
    //获取的ID
    private $allid;

    //表名
    private $sqlk;
    
    //语言
    public $lang;
    
    //code 关联的info_id
    public $info_id = array();
    
    //code info 信息状态
    public $recycle;

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->lang     = $_M['lang'];
        $this->tname    = $_M['form']['tname'];
        $this->sqlk     = $_YW['k'][$this->tname];
        $this->recycle  = $_M['form']['recycle'];
    }

    //保存主方法
    public function dotable(){
        global $_M,$_YW;
        $this->allid  = array_filter(explode(',', $_M['form']['allid']));
        switch ($_M['form']['submit_type']) {
            case 'save':
                $this->save();
                break;
            case 'del':
                $this->del();
                break;
            case 'delamend':
            case 'saveamend':
                $this->amend();
                break;
            case 'delall':
                $this->delall();
                break;
            case 'delamendall':
            case 'savaamendall':
                $this->amendall();
                break;
            case 'backups':
                $this->backups();
                break;

            default:
                break;
        }
        
        switch ($this->tname) {
            case 'info':
            case 'code':
                $this->tname    .= '&recycle='.$this->recycle;
                break;
            case 'list':
                $this->tname    .= '&pid='.$_M['form']['pid'];
                break;
            case 'record':
                $this->tname    .= '&code_id='.$_M['form']['code_id'];
                break;

            default:
                break;
        }

        turnover($_M['url']['own_name'] . 'c=table_on&a=do'.$this->tname, $_YW['t']['yw041']);
    }
    
    //保存
    private function save() {
        global $_M,$_YW;
        foreach ($this->allid as $id) {
            if($id){
                $info   = $this->info($id);
                if(is_number($id)){
                    $field  = $this->datafield($info);
                    $where  = " id = '{$id}' ";
                    parent::amendsql($this->sqlk,$field,$where);
                    //兼容单选、下拉
                    if($_M['form']['morz'] && $this->tname == 'list') {
                        $where  = " bigid = '{$_M['form']['pid']}' AND lang = '{$this->lang}' ";
                        $field  = " default_value = '' ";
                        parent::amendsql($_YW['k']['list'],$field,$where);
                        
                        $morz   = $this->mrz($id);
                        $where  = " id = '{$morz}' ";
                        $field  = " default_value = '{$morz}' ";
                        parent::amendsql($_YW['k']['list'],$field,$where);
                    }
                }  else {
                    $field  = $this->datafield($info);
                    parent::addsql($this->sqlk,$field,$where);
                }
            }
        }
    }

    //并非彻底删除
    private function amend(){
        global $_M,$_YW;
        self::delamendcodeinfo();
        foreach ($this->allid as $id) {
            if($id){
                $time = time();
                $field  = $this->recycle?" recycle='0', deltime='{$time}' ":" recycle='1' ";
                
                if($this->tname == 'code' && $_YW['c']['fwdel'] && self::ckinfocode($id) == false){
                    $where  = " id = '{$this->info_id[$id]}' ";
                    parent::amendsql($_YW['k']['info'],$field,$where);
                }
                
                if($this->tname == 'info'){
                    $where  = " info_id = '{$id}' ";
                    parent::amendsql($_YW['k']['code'],$field,$where);
                }
                
                $where  = " id='{$id}' ";
                parent::amendsql($this->sqlk,$field,$where);
                
            }
        }
    }
    
    //删除
    private function del() {
        global $_M;
        self::delamendcodeinfo();
        foreach ($this->allid as $id) {
            if($id){
                $this->batchdel($id);
                
                //删除本表
                $where  = " id = '{$id}' ";
                parent::delsql($this->sqlk,$where);
            }
        }
    }
    
    //一键放入回收站
    private function amendall() {
        global $_M,$_YW;
        $where  = " recycle = '{$this->recycle}' ";
        $time = time();
        $field  = $this->recycle?" recycle='0', deltime='{$time}' ":" recycle='1' ";

        if($this->tname == 'info'){
            $query  = "SELECT id FROM {$this->sqlk} where lang='{$this->lang}' AND {$where} ";
            $info   = DB::get_all($query);
            $i  = 0;
            foreach ($info as $key => $val) {
                $data[] = $val['id'];
                $i++;
                if($i == 1000 || $key == count($info) -1 ){
                    $i = 0;
                    $id   = arrayto_string($data,',');
                    parent::amendsql($_YW['k']['code'],$field," info_id IN({$id}) ");
                    parent::amendsql($this->sqlk,$field," id IN({$id}) ");
                    $data   = array();
                }
            }
        }
        
        if($this->tname == 'code'){
            $query  = "SELECT id,info_id FROM {$this->sqlk} where {$where} ";
            $info   = DB::get_all($query);
            
            $i  = 0;
            foreach ($info as $key => $val) {
                $data[] = $val['id'];
                $info_id[] = $val['info_id'];
                $i++;
                if($i == 1000 || $key == count($info) -1 ){
                    $i = 0;
                    if($_YW['c']['fwdel'] || $this->recycle == 0){
                        $infoid   = arrayto_string($info_id,',');
                        parent::amendsql($_YW['k']['info'],$field," id IN({$infoid}) ");
                    }
                    $id   = arrayto_string($data,',');
                    parent::amendsql($this->sqlk,$field," id IN({$id}) ");
                    $data   = $info_id  = array();
                }
            }
        }
    }


    //一键彻底删除
    private function delall() {
        global $_M,$_YW;
        
        if($this->tname == 'record'){
            $where  = " lang = '{$this->lang}' ";
            if($_M['form']['code_id']) $where  .= " AND code_id = '{$_M['form']['code_id']}' ";
            
            $query  = "SELECT code_id,COUNT(`code_id`) num FROM {$this->sqlk} where {$where} GROUP BY `code_id` ";
            $result = DB::query($query);
            while($val = DB::fetch_array($result)){
                parent::amendsql($_YW['k']['code']," total = '0' "," id = '{$val['code_id']}' ");
            }
            
            parent::delsql($this->sqlk,$where);
            
        }

        $where  = " recycle = '{$this->recycle}' ";
        if($this->tname == 'info'){
            $query  = "SELECT id FROM {$this->sqlk} where lang='{$this->lang}' AND {$where} ";
            $info   = DB::get_all($query);
            $i  = 0;
            foreach ($info as $key => $val) {
                $data[] = $val['id'];
                $i++;
                if($i == 1000 || $key == count($info) -1 ){
                    $i = 0;
                    $id   = arrayto_string($data,',');
                    parent::delsql($_YW['k']['plist']," listid IN ({$id}) ");
                    
                    $query  = "SELECT id FROM {$_YW['k']['code']} where info_id IN ({$id}) ";
                    $code   = DB::get_all($query);
                    $codeid = arrayto_string(array_column($code, 'id'),',');
                    self::qrcode($codeid);
                    parent::delsql($_YW['k']['record']," code_id IN ({$codeid}) ");
                    
                    parent::delsql($_YW['k']['code']," info_id IN ({$id}) ");
                    parent::delsql($this->sqlk," id IN ({$id}) ");
                    $data   = array();
                }
            }

        }
        
        if($this->tname == 'code'){
            $query  = "SELECT id,info_id FROM {$this->sqlk} where {$where} ";
            $info   = DB::get_all($query);
            $recycle    = array(1,0);
            $query  = "SELECT id,info_id FROM {$this->sqlk} where recycle = '{$recycle[$this->recycle]}' ";
            $code   = DB::get_all($query);
            $code   = array_column($code, 'info_id');

            $i  = 0;
            foreach ($info as $key => $val) {
                $data[] = $val['id'];
                if(in_array($val['info_id'],$code) && is_arrempty($code)){
                    $info_id[] = $val['info_id'];
                }else{
                    $del_id[] = $val['info_id'];
                }
                $i++;
                if($i == 1000 || $key == count($info) -1 ){
                    $i = 0;
                    if($_YW['c']['fwdel']){
                        $delid   = arrayto_string($del_id,',');
                        parent::delsql($_YW['k']['plist']," listid IN ({$delid}) ");
                        parent::delsql($_YW['k']['info']," id IN({$delid}) ");
                    }
                    $id   = arrayto_string($data,',');
                    self::qrcode($id);
                    parent::delsql($_YW['k']['record']," code_id IN ({$id}) ");
                    parent::delsql($this->sqlk," id IN({$id}) ");
                    
                    if(is_arrempty($info_id)){
                        $infoid   = arrayto_string($info_id,',');
                        parent::amendsql($_YW['k']['info']," delcodenum = ABS(delcodenum + 1) "," id IN ({$infoid}) ");
                    }
                    $data   = $info_id  = $del_id = array();
                }
            }
        }
    }

    //备份
    private function backups() {
        global $_M,$_YW;
        if(!$_YW['c']['csvbf']){
            //标记状态
            cloud::addconsql('csvbf', $fcsv);
            $backups    = load::own_class('backups','new');
            $backups->set('qrcode',cloud::qrcodeinfo());
            $backups->doaddupcvs();
            //改变状态
            cloud::addconsql('csvbf', '');
        }else{
            cloud::scriptgo($_YW['t']['yw126']);
        }
        exit;
    }





    /********************************************************
     * 
     *              数据方法、逻辑以外的具体执行方法
     * 
     * ******************************************************/
    
    //删除二维码 $id 防伪码列表的ID
    private function qrcode($id) {
        global $_M,$_YW;
        load::sys_func('file');
        $query  = "SELECT id,code FROM {$_YW['k']['code']} where id IN ({$id}) ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $image  =   '../app/app/'.$_YW['n'].'/qrcode/'.$val['code'].'.png';
            delfile($image);
        }
    }

    //批量删除关联表
    private function batchdel($id){
        global $_M,$_YW;
        switch ($this->tname) {
            case 'parameter':
                parent::delsql($_YW['k']['list']," bigid = '{$id}' ");
                parent::delsql($_YW['k']['plist']," paraid = '{$id}' ");
                break;
            case 'code':
                $ckinfocode = self::ckinfocode($id,0);
                if($_YW['c']['fwdel'] && $ckinfocode == false){
                    parent::delsql($_YW['k']['plist']," listid = '{$this->info_id[$id]}' ");
                    parent::delsql($_YW['k']['info']," id = '{$this->info_id[$id]}' ");
                }
                
                self::qrcode($id);
                parent::delsql($_YW['k']['record']," code_id IN ({$id}) ");
                
                if($_YW['c']['fwdel'] == 0 || $ckinfocode != false){
                    parent::amendsql($_YW['k']['info']," delcodenum = ABS(delcodenum + 1) "," id = '{$this->info_id[$id]}' ");
                }
                break;
            case 'info': 
                parent::delsql($_YW['k']['plist']," listid = '{$id}' ");
                
                $query  = "SELECT id FROM {$_YW['k']['code']} where info_id = '{$id}' ";
                $code   = DB::get_all($query);
                $codeid = arrayto_string(array_column($code, 'id'),',');
                self::qrcode($codeid);
                parent::delsql($_YW['k']['record']," code_id IN ({$codeid}) ");
                
                parent::delsql($_YW['k']['code']," info_id = '{$id}' ");
                break;
            case 'record':
                $query  = "SELECT code_id FROM {$this->sqlk} where lang='{$this->lang}' AND id='{$id}' ";
                $code_id   = DB::get_one($query);
                parent::amendsql($_YW['k']['code']," total = ABS(total - 1) "," total > 0 AND id = '{$code_id['code_id']}' ");
                break;
            default:
                break;
        }
                    
    }

    //获取信息
    private function info($id) {
        global $_M;
        switch ($this->tname) {
            case 'info':
            case 'code':
                $info  = array(
                    'no_order'          =>  $_M['form']['no_order-'.$id],
                );
                break;
            case 'parameter':
                $info  = array(
                    'no_order'      =>  $_M['form']['no_order-'.$id],
                    'name'          =>  $_M['form']['name-'.$id],
                    'description'   =>  $_M['form']['description-'.$id],
                    'type'          =>  $_M['form']['type-'.$id],
                    'wr_ok'         =>  $_M['form']['wr_ok-'.$id],
                    'lang'          =>  $this->lang,
                );
                break;
            case 'list':
                $info  = array(
                    'no_order'      =>  $_M['form']['no_order-'.$id],
                    'info'          =>  $_M['form']['info-'.$id],
                    'bigid'         =>  $_M['form']['pid'],
                    'default_value' =>  $this->mrz($id),
                    'lang'          =>  $this->lang,
                );
                
                break;
            default:
                break;
        }
        
        return $info;
    }
    
    //获取默认值
    private function mrz($id) {
        global $_M;
        $morz   = $_M['form']['morz'];
        if(!$morz){
            $morz = $_M['form']['morz-' . $id];
        }
        return $morz;
    }
    
    //code_info 删除时的操作
    private function delamendcodeinfo() {
        global $_M,$_YW;
        if($this->tname == 'code' && $_YW['c']['fwdel']){
            self::codeinfoid();
        }
    }
    
    //根据ID数据获取所有的列表信息
    private function codeinfoid() {
        global $_M;
        $allid  = arrayto_string($this->allid,',');
        $query  = "SELECT id,info_id FROM {$this->sqlk} WHERE id IN({$allid}) ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $this->info_id[$val['id']]  = $val['info_id'];
        }
    }
    
    /*
     * 查询info 是否有关联其他防伪码
     * $del 1 为放入回收站的判断
     *      0 彻底删除
     */
    private function ckinfocode($id,$del = 1) {
        global $_M;
        if($del == 1) $where = " AND recycle = '1' ";
        $query  = "SELECT id FROM {$this->sqlk} WHERE info_id = '{$this->info_id[$id]}' {$where} AND id != '{$id}' ";
        $info   = DB::get_one($query);
        return $info;
    }

    //字段信息
    private function datafield($form) {
        global $_M;
        $karr = DB::get_all("DESC {$this->sqlk}");
        foreach ($karr as $v) {
            $arr[$v['Field']] = $v['Field'];
        }
        $formarr = array_intersect_key($form, $arr);
        foreach ($formarr as $k => $v) {
            $zfc .= $k . "=" . "'" . $v . "'" . ",";
        }
        return rtrim($zfc, ",");
    }
}
?>