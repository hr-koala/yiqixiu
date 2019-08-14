<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
    .stat_list{background: #f7f7f7; width: 100%;}
    .yun{display: none;}
</style>
<form method="POST" name="myform" class="ui-from" action="{$this->action}" target="_self">
    <div class="v52fmbx">
<!--
EOT;
if($this->tname == 'code' || $this->tname == 'info' || $this->tname == 'record'){
echo <<<EOT
-->
        <div class="v52fmbx-table-top">
<!--
EOT;
if($this->tname != 'record'){
require $this->template('own/table_right');
require $this->template('own/table_left');
}
//查询记录
if($this->tname == 'record'){
echo <<<EOT
-->
    <div class="container-fluid" style="padding:0px;">
        <div class="row">
            {$modecolor}
        </div>
    </div>
<!--
EOT;
}
echo <<<EOT
-->
        </div>
<!--
EOT;
}
echo <<<EOT
-->
        <table class="display dataTable ui-table" data-table-ajaxurl="{$this->tableajax}" data-table-pagelength="{$_YW['c']['fwlb']}">
            <thead>
<!--
EOT;
require $this->template('own/table_head');
echo <<<EOT
-->
            </thead>
            <tbody>

            </tbody>
            <tfoot>
<!--
EOT;
require $this->template('own/table_foot');
echo <<<EOT
-->
            </tfoot>
        </table>
    </div>
</form>
<!--
EOT;
require $this->template('ui/foot');
?>