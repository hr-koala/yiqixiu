<?php

defined('IN_MET') or exit('No permission');

class webinfo {
    
    #防伪码主信息
    private $code = array();
    #详细的查询记录
    private $record = array();
    #标记code查询数据成功
    private $mold = false;

    public function __construct() {
        global $_M,$_YW;
        self::codesql();
    }
    
    //防伪码查询状态
    public function mold() {
        return $this->mold;
    }
    
    //防伪码ID
    public function codeid() {
        return $this->code['id'];
    }
    
    //查询总数加1
    public function totalnum() {
        $this->code['record']   = $this->code['record'] + 1;
    }

    //record总数
    public function number() {
        global $_M,$_YW;
        return $this->code['record'];
    }
    
    //返回所有的信息数组
    public function infocode() {
        return $this->code;
    }
    
    //返回带有HTML的数组
    public function table() {
        global $_M,$_YW;
        if($_YW['c']['numonoff']) $numonoff = '<tr><th>'.$_YW['t']['yw015'].'</th><td>'.$this->code['num'].'</td></tr>';
        //固定的格式
        $table  = '<tr><th>'.$_YW['t']['yw020'].'</th><td>'.$this->code['title'].'</td></tr>
                  '.$numonoff.'
                  <tr><th>'.$_YW['t']['yw014'].'</th><td>'.$this->code['code'].'</td></tr>
                  <tr><th>'.$_YW['t']['yw179'].'</th><td>'.$this->code['record'].'</td></tr>';
        
        //输出样html
        $html   = '
            <H3>'.$_YW['t']['yw019'].'</H3>
            <table class="table table-bordered table-hover">
                <tbody>
                  '.$table.$this->code['plist'].'
                </tbody>
            </table>
                ';
        
        //是否输出详细内容
        if($this->code['content']){
            $html   .= '
                        <H3>'.$_YW['t']['yw029'].'</H3>
                        <div class="yun_table_div">'.$this->code['content'].'</div>';
        }
        return $html;
    }
    

    //查询信息
    public function codesql($type = 'info') {
        global $_M,$_YW;
        
        $code   = $info = array();
        //code
        $query  = "select id,code,qrcode,info_id from {$_YW['k']['code']} where code = '{$_M['form']['code']}' AND recycle = '1' ";
        $code   = DB::get_one($query);
        
        if($code != false){
            $this->mold    = true;
        }
        //info
        $query  = "select title,num,content from {$_YW['k']['info']} where id = '{$code['info_id']}' ";
        $info   = DB::get_one($query);
        
        $this->code = array_merge($code,$info);
        
        //plist
        $query  = "select paraid,info,imgname from {$_YW['k']['plist']} where listid = '{$this->code['info_id']}' ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $plist[$val['paraid']]  = $val;
        }
        
        //plist 进行排序以及格式的输出 //where lang='{$_M['lang']}'
        $query	= "SELECT id,type FROM {$_YW['k']['parameter']} ORDER BY no_order";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            if($type == 'array'){
                $this->code['plist'][$val['id']]    = $plist[$val['id']];
            }else{
                if($plist[$val['id']]['info'] !=''){
                    if($val['type'] == 4) $plist[$val['id']]['info'] = str_replace('|',"、", $plist[$val['id']]['info']);
                    $this->code['plist']    .= '<tr><th>'.$plist[$val['id']]['imgname'].'</th><td>'.$plist[$val['id']]['info'].'</td></tr>';
                }
            }
            
        }
        
        //record总数
        $this->code['record']   = DB::counter($_YW['k']['record']," where code_id = '{$this->code['id']}' ");
        
        //record
//        $query  = "select * from {$_YW['k']['record']} where code_id = '{$this->code['id']}' ";
//        $result = DB::query($query);
//        while($val = DB::fetch_array($result)){
//            $this->record[$val['id']]  = $val;
//        }

    }
}

?>