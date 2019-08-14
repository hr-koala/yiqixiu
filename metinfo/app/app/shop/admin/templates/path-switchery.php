<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/switchery/switchery.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/switchery/switchery.min.js"></script>
<script src="{$uipath}js/components/switchery.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>