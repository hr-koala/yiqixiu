<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/animsition/animsition.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/animsition/animsition.min.js"></script>
<script src="{$uipath}js/components/animsition.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>