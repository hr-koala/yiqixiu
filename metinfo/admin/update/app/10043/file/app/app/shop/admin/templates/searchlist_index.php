<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$path['animsition'] = 1;
$path['asScrollable'] = 1;
$path['ashoverscroll'] = 1;
$path['flag-icon'] = 1;
$path['formvalidation'] = 1;
$path['web-icons'] = 1;
$path['bootbox'] = 1;
$path['jquery-ui'] = 1;
$path['slidepanel'] = 1;
$path['alertify'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own]}admin/templates/css/searchlist.css">
<script>
  var own = '{$_M[url][own]}';
  var lang = '{$_M[lang]}';
  var site_admin = '{$_M[site_admin]}';
  var uipath = '{$uipath}';
</script>
<body class="app-taskboard">
  <div class="page animsition">
    <div class="page-header">
      <h1 class="page-title">商品筛选</h1>
    </div>
    <div class="page-content">
      <ul class="taskboard-stages" id="taskboard-stages" data-url="{$_M[url][own_form]}a=doeidtor_searchlist_order"></ul>
    </div>
  </div>
  <button class="site-action site-floataction btn-raised btn btn-success btn-floating"
  type="button" data-toggle="modal" data-target="#addStageFrom" style="position:relative;display: block;margin-right: auto;margin-left: auto;margin-top: 50px;">
    <i class="icon wb-plus" aria-hidden="true"></i>
  </button>
  <div class="modal fade" id="addStageFrom" aria-hidden="true" aria-labelledby="addStageFrom"
  role="dialog" tabindex="-1">
    <div class="modal-dialog modal-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
          <h4 class="modal-title">新增搜索项</h4>
        </div>
        <div class="modal-body">
          <form action="#" method="post" role="form">
            <div class="form-group">
              <input type="text" class="form-control" autocomplete="off" id="name" name="name" placeholder="搜索项名称">
            </div>
          </form>
        </div>
        <div class="modal-footer text-left">
          <button id="taskboard-stage-creat" class="btn btn-primary" data-dismiss="modal"
          type="button" data-url="{$_M['url']['site_admin']}index.php?n=shop&c=searchlist_admin&a=doadd_searchlist&lang={$_M[lang]}">创建</button>
          <a class="btn btn-sm btn-white" data-dismiss="modal" href="javascript:void(0)">取消</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
  <script src="{$uipath}assets/js/app.min.js"></script>
  <script src="{$_M[url][own]}admin/templates/js/searchlist.js"></script>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>