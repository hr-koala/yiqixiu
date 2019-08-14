<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appadmin');

class table_on extends appadmin {
    
    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        parent::doconfig('donav');
        parent::urlca('table_off','doindex');
    }
    
    //列表
    public function dodetailed() {
        global $_M,$_YW;
        nav::select_nav(0);
        $this->url('detailed');
        $title  = array($_YW['t']['yw001'],$_YW['t']['yw002'],$_YW['t']['yw003'],$_YW['t']['yw043'],$_YW['t']['yw004']);
        if($_YW['c']['typeon']) array_splice($title, 1, 0, $_YW['t']['yw063']);
        require $this->template('own/table');
    }
}

?>