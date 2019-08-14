<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/formvalidation/formValidation.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/formvalidation/formValidation.min.js"></script>
<script src="{$uipath}vendor/formvalidation/js/language/zh_CN.js"></script>
<script src="{$uipath}vendor/formvalidation/framework/bootstrap.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>