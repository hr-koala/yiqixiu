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
<script src="{$uipath}vendor/jquery-ui/jquery-ui.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>