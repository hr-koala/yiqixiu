<!--<?php
defined('IN_MET') or exit('No permission');	//所有文件都是已这句话开头，保证系统单入口。
if($_YW['c']['webstyle']) require $this->template('own/head');
$fwlength   = $opennum = 0;
foreach (stringto_array($_YW['c']['open'],'|') as $val) {
    $opennum++;
    $fwlength   += $_YW['c']['fwlength_'.$val];
    $input  .= '<input class="yun_input img-rounded" type="text" autocomplete="off" maxlength="'.$_YW['c']['fwlength_'.$val].'">';
}
if($opennum <= 1 || $_YW['c']['olddata'] || $_YW['c']['subsection']) $input  = '<input class="yun_input img-rounded" type="text" autocomplete="off" ">';


if($_YW['c']['sstop']) $sstop = '<h2>'.$_YW['c']['sstop'].'</h2>';
if($_YW['c']['s_ctitle']) $s_ctitle = '<h2>'.$_YW['c']['s_ctitle'].'</h2>';
echo <<<EOT
-->
<div class="yun_fwyz container-fluid">
    <div class="row">
        <div class="colmd col-md-8 col-xs-12">
            <div class="yun_section section_z img-rounded">
                {$sstop}
                <div class="section_info ">
                    <h3>{$_YW['t']['yw188']}&nbsp;{$fwlength}&nbsp;{$_YW['t']['yw189']}{$_YW['t']['yw142']}</h3>
                    <form method="POST" name="myform" class="ui-from" action="{$this->url}" target="_self">
                    <div id="input" class="form-section">{$input}</div>
                    <div class="form-section">
                        <input type="hidden" name="code" data-space="{$space}">
                        <button name="submit" class="yy_submit btn btn-primary type="submit">{$_YW['t']['yw136']}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="colmd col-md-4 col-xs-12">
            <div class="yun_section section_y img-rounded">    
                {$s_ctitle}
                <div class="section_yinfo">{$_YW['c']['ssbottom']}</div>
            </div>
        </div>
    </div>
</div>
<!--
EOT;
if($_YW['c']['webstyle']) require $this->template('own/foot');
?>