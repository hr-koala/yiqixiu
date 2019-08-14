<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/asspinner/asSpinner.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/asspinner/jquery-asSpinner.min.js"></script>
<script src="{$uipath}js/components/asspinner.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>