<?php
defined('IN_MET') or exit('No permission');	//所有文件都是已这句话开头，保证系统单入口。
class plugin_fwyz {

    public function doweb(){
        global $_M,$_YW;
        if(M_NAME == 'fwyz') {
            #获取$_YW 值
            fwweb::doconfig('doywt,doywc,dono');
            switch ($_YW['c']['template']) {
                case 'table':
                $foot_script.= '<!--[if IE]><script src="'.$_M['url'][own].'web/templates/js/compatible.js" type="text/javascript"></script><![endif]-->';
                #详情页面
                if($_M['form']['code']) $head_script .= '<link rel="stylesheet" type="text/css" href="'.$_M['url'][own].'web/templates/css/bootstrap.min.table.css" />';
                if($_YW['c']['css']) $foot_script .= '<script src="'.$_M['url'][own].'web/templates/js/ajax.js" type="text/javascript"></script>';
                break;

                case 'section':
                $head_script .= '<link rel="stylesheet" type="text/css" href="'.$_M['url'][own].'web/templates/css/bootstrap.min.zdy.css" />';

                $foot_script .= '<script src="'.$_M['url'][own].'web/templates/js/section.js" type="text/javascript"></script>';
                    break;
                default:
                    break;
            }
            #公用css 
            $head_script .= '<link rel="stylesheet" type="text/css" href="'.$_M['url'][own].'web/templates/css/fwyz.css" />';
            
            #输出
            $_M['html_plugin']['head_script']   = $_YW['head_script'] = $head_script;
            $_M['html_plugin']['foot_script']   = $_YW['foot_script'] = $foot_script;
        }
    }
}
?>