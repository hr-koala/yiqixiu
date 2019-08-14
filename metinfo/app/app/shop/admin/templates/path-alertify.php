<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/alertify-js/alertify.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/alertify-js/alertify.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>