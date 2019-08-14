<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" name="myform" class="ui-from" action="{$this->action}" target="_self">
    <div class="v52fmbx">
<!--
EOT;
if($this->tname == 'detailed'){
$html   = '';
if($_YW['c']['typeon']) $typehtml = '<option value="type">'.$_YW['t']['yw063'].'</option>';
echo <<<EOT
-->
        <div class="v52fmbx-table-top">
            <div class="ui-float-right">
                <div class="ui-table-search">
                    <select name="search_field" data-table-search="1">
                        <option value="">{$_YW['t']['yw009']}</option>
                        <option value="name">{$_YW['t']['yw001']}</option>
                        {$typehtml}
                    </select>
                    <i class="fa fa-search"></i>
                    <input name="search" data-table-search="1" value="" class="ui-input"  style="width:180px; text-transform:uppercase" type="text">
                </div>
            </div>
            <div class="ui-float-left">
		<a href="{$_M['url']['own_name']}c=info_on&a=dodetailed" class="ui-addlist ui-table-addlist"><i class="fa fa-plus-circle"></i>{$_YW['t']['yw010']}</a>
            </div>
        </div>
<!--
EOT;
}
echo <<<EOT
-->
        <table class="display dataTable ui-table" data-table-ajaxurl="{$this->tableajax}" data-table-pagelength="20">
            <thead>
                <tr>
                    <th width="25" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" value="" type="checkbox"></th>
<!--
EOT;
$colspan    = count($title)+1;
foreach ($title as $v){
echo <<<EOT
-->
                    <th data-table-columnclass="met-center">{$v}</th>
<!--
EOT;
}
echo <<<EOT
-->
                    <th data-table-columnclass="met-center">{$_YW['t']['yw011']}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th><input name="id" data-table-chckall="id" value="" type="checkbox"></th>
                    <th colspan="{$colspan}" class="formsubmit">
                        <input type="submit" name="del" value="{$_YW['t']['yw007']}" class="submit" data-confirmsubmit="{$_YW['t']['yw006']}">
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</form>
              
<!--
EOT;
require $this->template('ui/foot');
?>