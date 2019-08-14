<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/select2/select2.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/select2/select2.full.min.js"></script>
<script src="{$uipath}js/components/select2.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>