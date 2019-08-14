<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appadmin');

class info_on extends appadmin {

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        parent::doconfig('donav');
        parent::urlca('info_off','doindex');
    }
    
    //添加下载信息
    public function dodetailed() {
        global $_M,$_YW;
        nav::select_nav(0);
        $this->url('detailed','&id='.$_M['form']['id']);
        
        $query  = "SELECT * FROM {$_YW['k'][$this->tname]} where id = '{$_M['form']['id']}' ";
        $info   = DB::get_one($query);
        
        if($_YW['c']['typeon']) {
            foreach (stringto_array($_YW['c']['type'],'|') as $val) {
                $option[]   = '<option value="'.$val.'">'.$val.'</option>';
            }
            $hop    = arrayto_string($option,'');
            $html   =   '<dl>
                            <dt>'.$_YW['t']['yw063'].'</dt>
                            <dd class="ftype_select">
                                <div class="fbox form-inline">
                                    <select name="type" class="form-control" data-required="1" data-checked="'.$info['type'].'">
                                        <option value="">'.$_YW['t']['yw066'].'</option>'.$hop.'
                                    </select>
                                </div>
                            </dd>
                        </dl>';
        }
        
        require $this->template('own/info');
    }

}
?>