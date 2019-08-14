<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
<script src="{$uipath}js/components/bootstrap-tokenfield.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>