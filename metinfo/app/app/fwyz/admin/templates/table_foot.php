<!--<?php
defined('IN_MET') or exit('No permission');

$tfsave = '<input name="save" value="'.$_YW['t']['yw006'].'" class="submit" type="submit">';
$tfdel  = '<input name="del" value="'.$_YW['t']['yw007'].'" class="submit" type="submit" data-confirm="'.$_YW['t']['yw012'].'">';
$tfadd  = '<a href="javascript:;" class="ui-addlist ui-float-left " data-table-addlist="'.$this->addlisturl.'"><i class="fa fa-plus-circle"></i>'.$_YW['t']['yw112'].'</a>';

switch ($this->tname) {
    case 'code':
    case 'info':
        if($recycle){
            if($_YW['c']['csvbf']){
                $a1 = '<a href="javascript:void(0);" class="submit yw_dca yw_dcr adian" style="background:#999999;">'.$_YW['t']['yw004'].'</a>';
            }else{
                $a1  = '<a href="'.$_M['url']['own_name'].'c=inout&a=doaddupcvs&csv=dc" class="submit yw_dca yw_dcr metalert" target="_blank" data-confirm="'.$_YW['t']['yw005'].'">'.$_YW['t']['yw004'].'</a>';
            }

            $tablefoot   = $tfsave.'<input name="delamend" value="'.$_YW['t']['yw173'].'" class="submit" type="submit" data-confirm="'.$_YW['t']['yw008'].'">
                            <input name="delamendall" value="'.$_YW['t']['yw181'].'" class="submit yun yun_right" type="submit" data-confirm="'.$_YW['t']['yw184'].'">
                            <a tabindex="0" role="button" href="'.$this->backupurl.'" class="btn btn-sm btn-warning yun yun_right backup" type="submit"  data-toggle="popover" data-trigger="focus">'.$_YW['t']['yw214'].'</a>';
        }else{
            $tablefoot   = '<input name="saveamend" value="'.$_YW['t']['yw010'].'" class="submit" type="submit">
                            <input name="del" value="'.$_YW['t']['yw011'].'" class="submit" type="submit" data-confirm="'.$_YW['t']['yw012'].'">
                            <input name="delall" value="'.$_YW['t']['yw185'].'" class="submit btn-danger yun yun_right" type="submit" data-confirm="'.$_YW['t']['yw186'].'">
                            <input name="savaamendall" value="'.$_YW['t']['yw182'].'" class="submit yun yun_right" type="submit" data-confirm="'.$_YW['t']['yw183'].'">
                            ';
        }
        break;
    case 'record':
        $tablefoot  = $tfdel;
        $tablefoot  .= '<input name="delall" value="'.$_YW['t']['yw185'].'" class="submit btn-danger yun yun_right" type="submit" data-confirm="'.$_YW['t']['yw186'].'">';
        break;
    default:
        $tablefoot  = $tfsave.$tfdel.$tfadd;
        break;
}

echo <<<EOT
-->
<tr>
    <th><input name="id" data-table-chckall="id" value="" type="checkbox"></th>
    <th colspan="{$colspan}" class="formsubmit">
        {$tablefoot}
    </th>
</tr>
<!--
EOT;
?>