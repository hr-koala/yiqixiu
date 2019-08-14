<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<tr>
    <th width="25" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" value="" type="checkbox"></th>
<!--
EOT;
$colspan    = count($title)+1;
foreach ($title as $val){
echo <<<EOT
-->
    <th data-table-columnclass="met-center">{$val}</th>
<!--
EOT;
}
if(!$recycle && ($this->tname == 'code' || $this->tname == 'info')){
    $colspan--;
}

if($recycle || ($this->tname != 'code' && $this->tname != 'info') ){
echo <<<EOT
-->
    <th data-table-columnclass="met-center">{$_YW['t']['yw043']}</th>
<!--
EOT;
}
echo <<<EOT
-->
</tr>
<!--
EOT;
?>