<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/multi-select/multi-select.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/multi-select/jquery.multi-select.js"></script>
<script src="{$uipath}js/components/multi-select.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>