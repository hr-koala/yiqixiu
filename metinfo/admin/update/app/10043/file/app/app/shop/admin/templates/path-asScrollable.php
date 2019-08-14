<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/asscrollable/asScrollable.min.css">
<link rel="stylesheet" href="{$uipath}assets/examples/css/advanced/scrollable.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
<script src="{$uipath}vendor/asscroll/jquery-asScroll.min.js"></script>
<script src="{$uipath}js/components/asscrollable.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>