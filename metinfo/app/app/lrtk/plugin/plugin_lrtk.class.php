<?php
defined('IN_MET') or exit('No permission');	//所有文件都是已这句话开头，保证系统单入口。
class plugin_lrtk {
    public function doweb(){
        global $_M;
        $query = "select * from {$_M['table']['yw_lrtk']} where lang = '{$_M[lang]}' ";
        $pz = DB::get_all($query);
        $arrlength = count($pz);
        $i = 0;
        for ($y = 0; $y < $arrlength; $y++) {	//组建数组$pzlb 配置列表
            $name = $pz[$i]['name'];
            $value = $pz[$i]['value'];
            $pzlb[$name] = $value;
            $i++;
        }
        if($pzlb['radio1'] == 1) {
            $_M['html_plugin']['head_script'].= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$_M['url'][own]}admin/templates/css/ywlrtk.css\" />";
            $_M['html_plugin']['foot_script'].= "<script src=\"{$_M['url'][own]}admin/templates/js/ywlrtk.js\" type=\"text/javascript\"></script>";
        }
    }
}
?>