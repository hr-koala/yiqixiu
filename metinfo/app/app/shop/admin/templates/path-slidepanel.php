<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/slidepanel/slidePanel.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/slidepanel/jquery-slidePanel.min.js"></script>
<script src="{$uipath}js/components/slidepanel.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>