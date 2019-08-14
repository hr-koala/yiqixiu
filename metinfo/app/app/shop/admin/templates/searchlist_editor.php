<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

echo <<<EOT
-->
<header class="slidePanel-header">
  <div class="overlay-top overlay-panel overlay-background bg-light-green-600">
    <div class="slidePanel-actions btn-group" aria-label="actions" role="group">
      <button type="button" class="btn btn-pure slidePanel-close icon wb-close" aria-hidden="true"></button>
    </div>
    <h4 class="stage-name"></h4>
  </div>
</header>
<div class="slidePanel-inner">
  <section class="slidePanel-inner-section">
    <div class="task-main">
        <form action="{$_M['url'][own_form]}a=doeditor_searchlist_tag_save&id={$tag['id']}">
          <div class="form-group">
            <input id="task-name" name="name" autocomplete="off" placeholder="字段名称" class="form-control" type="text" value="{$tag['name']}">
          </div>
		  <div class="form-group">
            <input id="task-title" name="title" autocomplete="off" placeholder="页面title" class="form-control" type="text" value="{$tag['title']}">
          </div>
		  <div class="form-group">
		    <textarea id="task-keywords" autocomplete="off" name="keywords" placeholder="关键词" class="form-control" rows="5">{$tag['keywords']}</textarea>
          </div>
		  <div class="form-group">
			<textarea id="task-description" autocomplete="off" name="description" placeholder="页面描述" class="form-control" rows="5">{$tag['description']}</textarea>
          </div>
		  <!--
		  <div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">{$_M['url']['site']}product/tag/</span>
			  <input id="task-url" name="url" placeholder="自定义URL，需要开启伪静态功能！" class="form-control" type="text" value="{$tag['url']}">
			</div>
          </div>	
		  -->
          <div class="form-group">
            <button class="btn btn-primary task-main-editor-save" type="button">保存</button>
            <a class="btn btn-sm btn-white task-main-editor-cancel slidePanel-close" href="javascript:void(0)">关闭</a>
          </div>
        </form>
    </div>
  </section>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>