<?php
defined('IN_MET') or exit('No permission'); require_once $this->template('ui/head'); echo <<<EOF
-->

<link rel="stylesheet" type="text/css" href="{$_M[url][site]}app/app/zorlan_wenzhangcaiji/admin/templates/static/metinfo.css?$jsrand" />
<link rel="stylesheet" type="text/css" href="{$_M[url][site]}app/app/zorlan_wenzhangcaiji/admin/templates/static/common.css?$jsrand" />
<script type="text/javascript" src="{$_M[url][site]}app/app/zorlan_wenzhangcaiji/admin/templates/static/jquery.min.js?$jsrand"></script>
<script type="text/javascript" src="{$_M[url][site]}app/app/zorlan_wenzhangcaiji/admin/templates/static/common.js?$jsrand"></script>

<!--
EOF;
?>