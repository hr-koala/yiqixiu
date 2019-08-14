<?php
defined('IN_MET') or exit ('No permission');

load::own_class('admin/class/fwadmin');

class table_on extends fwadmin {
    
    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        parent::doconfig('donav','dosidebar');
        parent::urlc('table_off','dotable');
    }

    //防伪码列表
    public function docode() {
        global $_M,$_YW;
        $recycle = $_M['form']['recycle'];
        $this->url('code','recycle='.$recycle.'&info_id='.$_M['form']['info_id']);
        
        $total    = '<a href="javascript:;" class="orderby-link">'.$_YW['t']['yw179'].'</a><input name="total" data-table-search="1" type="hidden">';
        if($recycle){
            nav::select_nav(10);
            $title  = array($_YW['t']['yw042'],$_YW['t']['yw014'],$total,$_YW['t']['yw020'],$_YW['t']['yw015'],$_YW['t']['yw024'],$_YW['t']['yw180']);
            if(cloud::qcodewechat(1)) array_splice($title, 1, 0, $_YW['t']['yw206']);
        }else{
            self::navacross();
            nav::select_nav(90);
            $title  = array($_YW['t']['yw014'],$total,$_YW['t']['yw020'],$_YW['t']['yw015'],$_YW['t']['yw024'],$_YW['t']['yw180'],$_YW['t']['yw044']);
        }
        
        require $this->template('own/table');
    }
    
    //自定义字段
    public function doparameter() {
        global $_M,$_YW;
        nav::select_nav(10);
        $this->url('parameter');
        $title  = array($_YW['t']['yw042'],$_YW['t']['yw107'],$_YW['t']['yw108'],$_YW['t']['yw109'],$_YW['t']['yw110']);
        require $this->template('own/table');
    }
    
    //自定义字段选项
    public function dolist(){
        global $_M,$_YW;
        nav::select_nav(10);
        $title  = array($_YW['t']['yw042'],$_YW['t']['yw107'],$_YW['t']['yw111']);
        $this->url('list','pid='.$_M['form']['pid']);
        require $this->template('own/table');
    }
    
    //产品信息模板
    public function doinfo() {
        global $_M,$_YW;
        $recycle = $_M['form']['recycle'];
        $this->url('info','recycle='.$recycle.'&info_id='.$_M['form']['info_id']);
        
        if($recycle){
            nav::select_nav(20);
            $title  = array($_YW['t']['yw042'],$_YW['t']['yw020'],$_YW['t']['yw015'],$_YW['t']['yw176'],$_YW['t']['yw024'],$_YW['t']['yw036']);
        }else{
            self::navacross();
            nav::select_nav(90);
            $title  = array($_YW['t']['yw020'],$_YW['t']['yw015'],$_YW['t']['yw176'],$_YW['t']['yw024'],$_YW['t']['yw044']);
        }
        
        require $this->template('own/table');
    }
    
    
    //回收站上的导航
    private $navacross;
    
    private function navacross(){
        global $_M,$_YW;
        $nav    = array(
            'code'  => array('0' => $_M['url']['own_name'] . 'c=table_on&a=docode&recycle=0','1' => $_YW['t']['yw142']),
            'info'  => array('0' => $_M['url']['own_name'] . 'c=table_on&a=doinfo&recycle=0','1' => $_YW['t']['yw178'])
        );
        
        foreach ($nav as $k => $v) {
            $b  = $k == $this->tname?'on':'';
            if($v != ''){
                $this->navacross  .= '<a href="'.$v['0'].'" class="'.$b.' ui-addlist ui-table-addlist navacross yun">'.$v['1'].'</a>';
            }
        }
    }
    
    //统计
    public function dorecord() {
        global $_M,$_YW;
        nav::select_nav(0);
        $this->url('record','code_id='.$_M['form']['code_id']);
        
        $title  = array($_YW['t']['yw014'],$_YW['t']['yw284'],'IP',$_YW['t']['yw285'],$_YW['t']['yw286'],$_YW['t']['yw287']);
        
        parent::modecolor();
        foreach (array(10,11,0,1,2,3) as $val) {
            $modecolor .= self::modecolortotal($val);
        }
        
        require $this->template('own/table');
    }
    
    //各种类型统计
    private function modecolortotal($mode = 0) {
        global $_M,$_YW;
        $where  = " lang = '{$_M['lang']}' ";
        if($_M['form']['code_id']) $where  .= " AND code_id = '{$_M['form']['code_id']}' ";
        switch ($mode) {
            case 10:
                if($_M['form']['code_id']){
                    $total  = $_YW['t']['yw225'].'：'.DB::counter($_YW['k']['record']," code_id = '{$_M['form']['code_id']}' ");
                }else{
                    $total  = $_YW['t']['yw225'].'：'.DB::counter($_YW['k']['record']);
                }
                
                break;
            case 11:
                $total  = $_YW['t']['yw226'].'：'.DB::counter($_YW['k']['record'], "WHERE {$where}");
                break;

            default:
                $total  = $this->modecolor['mode'][$mode].'：'.DB::counter($_YW['k']['record'], "WHERE {$where} AND mode ='{$mode}' ");
                break;
        }
        return '<div class="col-md-2 col-md-2 col-md-2 text-center"><div class="list-group" style="margin-bottom:0px;"><div class="list-group-item" style="background: #f7f7f7">'.$total.'</div></div></div>';
    }
}
?>