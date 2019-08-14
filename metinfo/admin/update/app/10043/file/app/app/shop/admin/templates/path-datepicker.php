<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{$uipath}vendor/clockpicker/clockpicker.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{$uipath}js/components/bootstrap-datepicker.min.js"></script>
<script src="{$uipath}vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="{$uipath}js/components/clockpicker.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>