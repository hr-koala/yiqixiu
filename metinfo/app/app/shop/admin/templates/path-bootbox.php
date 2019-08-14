<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->

<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/bootbox/bootbox.min.js"></script>
<script src="{$uipath}js/components/bootbox.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>