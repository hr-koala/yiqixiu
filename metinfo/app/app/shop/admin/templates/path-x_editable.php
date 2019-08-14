<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/x-editable/x-editable.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/x-editable/bootstrap-editable.min.js"></script>
<script src="{$uipath}vendor/x-editable/address.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>