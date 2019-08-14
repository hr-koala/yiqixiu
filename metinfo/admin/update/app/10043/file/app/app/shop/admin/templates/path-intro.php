<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/intro-js/introjs.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/intro-js/intro.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>