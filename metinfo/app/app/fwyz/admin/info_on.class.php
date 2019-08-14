<?php
defined('IN_MET') or exit ('No permission');

load::own_class('admin/class/fwadmin');
load::own_func('admin');

class info_on extends fwadmin {
    
    public function __construct() {
        global $_M;
        parent::__construct();
        parent::doconfig('donav');
        parent::urlc('info_off','doeditorinfo');
    }
    
    //ajax
    private function ajaxurl($a) {
        global $_M;
        return $_M[url][own_name].'c=ajax&a='.$a;
    }

    //防伪码添加/修改
    public function doeditorinfo() {
        global $_M,$_YW;
        $id = $_M['form']['id'];
        $this->url('info','id='.$id);
        if($id){
            nav::select_nav(20);
            $query = "SELECT * FROM {$_YW['k']['info']} where id='{$id}' ";
            $nrxx = DB::get_one($query);
            
            $query = "SELECT code FROM {$_YW['k']['code']} where info_id='{$id}' limit 0,30;";
            $code = DB::get_all($query);
            
            $nrxx['xxgxsj']   = Atime(1);
            $ajaxn  = $this->ajaxurl('doxgspyz&id='.$id);
        }else{
            nav::select_nav(10);
            $ajaxn  = $this->ajaxurl('dospyz');
            $nrxx = array(
                'issue'         => Agly(),
                'addtime'       => Atime(1),
                'amendtime'     => Atime(1),
                'num'           => $this->fwnum(),
                'code'          => $this->codemake(),
            );
        }

        //自定义字段
        $zdy    = load::own_class('custom_field','new');
        if($id) $zdy->set('listid',$id);
        $typez = $zdy->form();
        
        require $this->template('own/info_code');
    }
    
    //默认值
    public function doparameter() {
        global $_M,$_YW;
        nav::select_nav(10);
        $id = $_M['form']['id'];
        $this->url('parameter','id='.$id);

        $query  = "SELECT * FROM {$_YW['k']['parameter']} where lang='{$_M['lang']}'  AND id = '{$id}' ";
        $kzzd   = DB::get_one($query);
        $mrz    = $kzzd['mrz'];
        $top    = '<dl><dt>'.$kzzd['name'].'</dt>';
        $bottom = $kzzd['description'] ? '</div><span class="tips">'.$kzzd['description'].'</span></dd></dl>' : '</div></dd></dl>';
        switch ($kzzd['type']) {
            case "1"://简短
                $typez = '<dd class="ftype_input"><div class="fbox"><input name="mrz" value="'.$mrz.'" type="text">';
                break;
            case "3"://文本
                $typez = '<dd class="ftype_textarea"><div class="fbox"><textarea name="mrz" placeholder="'.$kzzd['description'].'" >'.$mrz.'</textarea>';
                break;
            case "5"://附件
                $typez = '<dd class="ftype_upload"><div class="fbox"><input name="mrz" data-upload-type="doupimg" class="text" value="'.$mrz.'" type="text">';
                break;
            case "7"://时间
                $typez = '<dd class="ftype_day"><div class="fbox"><input type="input" name="mrz" value="'.$mrz.'"></div></dd>';
                break;
            default:
                break;
        }
        $tablee = $top.$typez.$bottom;
        require $this->template('own/info_mrz');
    }
}
?>