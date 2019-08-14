<!--<?php
defined('IN_MET') or exit('No permission');	//所有文件都是已这句话开头，保证系统单入口。
if($_YW['c']['webstyle']) require $this->template('own/head');
echo <<<EOT
-->
<div class="yun_fwyz">
    <h2>{$_YW['c']['sstop']}</h2>
    <div class="yy_v52fmbx" id="input">
        <form method="POST" name="myform" class="ui-from" action="{$this->url}" target="_self">
            <input name="code" class="yy_srfwm" value="" type="text" style="text-transform:uppercase" placeholder="{$_YW['t']['yw135']}" autocomplete="off">
            <button name="submit" class="yy_submit" type="submit">{$_YW['t']['yw136']}</button>
        </form>
    </div>
    <div class="yy_bottom">{$_YW['c']['ssbottom']}</div>
</div>
<!--
EOT;
if($_YW['c']['webstyle']) require $this->template('own/foot');
?>