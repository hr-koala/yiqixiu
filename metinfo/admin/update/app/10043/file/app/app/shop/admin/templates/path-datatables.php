<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{$uipath}vendor/datatables-responsive/dataTables.responsive.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<script src="{$uipath}vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.js"></script>
<script src="{$uipath}vendor/datatables-responsive/dataTables.responsive.js"></script>
<script src="{$uipath}js/components/datatables.min.js"></script>
<script src="{$uipath}js/plugins/selectable.min.js"></script>
<script src="{$uipath}js/components/selectable.min.js"></script>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>