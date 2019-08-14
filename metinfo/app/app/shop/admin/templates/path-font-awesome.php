<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<!--
EOT;
if(!$foot){
echo <<<EOT
-->
<link rel="stylesheet" href="{$uipath}fonts/font-awesome/font-awesome.min.css">
<!--
EOT;
}else{
echo <<<EOT
-->
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>