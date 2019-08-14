<!--<?php
defined('IN_MET') or exit('No permission');
$placeholder    = $this->tname == 'code'?$_YW['t']['yw016']:$_YW['t']['yw174'];
echo <<<EOT
-->
<div class="ui-float-right">
    <div class="ui-table-search">
<!--
EOT;
if($this->tname == 'info'){
echo <<<EOT
-->
        <select name="search_field" data-table-search="1">
            <option value="num">{$_YW['t']['yw015']}</option>
            <option value="title">{$_YW['t']['yw020']}</option>
        </select>
<!--
EOT;
}
echo <<<EOT
-->
        <i class="fa fa-search"></i>
        <input name="search" data-table-search="1" value="" class="ui-input" placeholder="{$placeholder}" style="width:180px; text-transform:uppercase" type="text">
    </div>
</div>
<!--
EOT;
        
?>