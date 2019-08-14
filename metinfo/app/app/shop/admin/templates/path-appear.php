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
<script src="{$uipath}vendor/jquery-appear/jquery.appear.js"></script>
<script src="{$uipath}js/components/jquery-appear.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>