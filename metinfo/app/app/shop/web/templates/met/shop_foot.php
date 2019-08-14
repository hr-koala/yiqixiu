<!--<?php
echo <<<EOT
-->
<!--
EOT;
require_once $this->template('tem/shop_foot_custom'); 
echo <<<EOT
-->
<script src="{$uipath}vendor/jquery/jquery.min.js"></script>
<script src="{$uipath}vendor/bootstrap/bootstrap.min.js"></script>
<script src="{$uipath}js/core.min.js"></script>
<script src="{$uipath}assets/js/site.min.js"></script>
<!--asScrollable-->
<script src="{$uipath}vendor/asscrollable/jquery.asScrollable.all.min.js"></script>
<script src="{$uipath}js/components/asscrollable.min.js"></script>
<!--alertify-->
<link rel="stylesheet" href="{$uipath}vendor/alertify-js/alertify.min.css">
<script src="{$uipath}vendor/alertify-js/alertify.js"></script>
<!--placeholder-->
<script src="{$webpath}ui/vendor/jquery-placeholder/jquery.placeholder.min.js"></script>
<script src="{$uipath}js/components/jquery-placeholder.min.js"></script>
<!--
EOT;
?>