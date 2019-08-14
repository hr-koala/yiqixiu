<?php

defined('IN_MET') or exit('No permission');

class plugin_branchmap {
    //前端插件
    public function doweb(){
        global $_M;
        if(M_NAME == branchmap) {
            //css
            $_M['html_plugin']['head_script'] .= '<link rel="stylesheet" type="text/css" href="'.$_M['url'][own].'web/templates/css/yunwang.bootstrap.min.css" />';
            $_M['html_plugin']['head_script'] .= '<link rel="stylesheet" type="text/css" href="'.$_M['url'][own].'web/templates/css/branchmap.css" />';
            //JS
            $file = '../templates/'.$_M['config']['met_skin_user'].'/js/own.js';
            if($_M['config']['metinfover'] == 'v1' && file_exists($file)){
                $_M['html_plugin']['foot_script'] .= '<script src="'.$_M['url']['own'].'web/templates/js/sea.v1.js" type="text/javascript"></script>';
            }else{
                $_M['html_plugin']['foot_script'] .= '<script src="'.$_M['url']['own'].'web/templates/js/sea2.2.1.js" type="text/javascript"></script>';
            }
            
        }   
    }

}
?>