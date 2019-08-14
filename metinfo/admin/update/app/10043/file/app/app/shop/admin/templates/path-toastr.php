<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/toastr/toastr.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/toastr/toastr.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>