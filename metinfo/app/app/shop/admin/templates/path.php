<?php
defined('IN_MET') or exit('No permission');
//CSS3动画
if($path['animsition'])require $this->template('own/path-animsition');
//内容滚动
if($path['asScrollable'])require $this->template('own/path-asScrollable');
//内容滚动?
if($path['ashoverscroll'])require $this->template('own/path-ashoverscroll');
//复选框（左右移动开关）
if($path['switchery'])require $this->template('own/path-switchery');
//步骤指南
if($path['intro'])require $this->template('own/path-intro');
//滑动面板（侧栏等）
if($path['slidepanel'])require $this->template('own/path-slidepanel');
//国旗SVG图标
if($path['flag-icon'])require $this->template('own/path-flag-icon');
//表单验证
if($path['formvalidation'])require $this->template('own/path-formvalidation');
//表格控件
if($path['datatables'])require $this->template('own/path-datatables');
//字体 web-icons
if($path['web-icons'])require $this->template('own/path-web-icons');
//字体 font-awesome
if($path['font-awesome'])require $this->template('own/path-font-awesome');
//字体 glyphicons
if($path['font-glyphicons'])require $this->template('own/path-glyphicons');
//鼠标滚轮支持(获取滚轮信息)
if($path['mousewheel'])require $this->template('own/path-mousewheel');
//全屏
if($path['screenfull'])require $this->template('own/path-screenfull');
//菜单支持
if($path['menu'])require $this->template('own/path-menu');
//菜单栏支持
if($path['menubar'])require $this->template('own/path-menubar');
//网格菜单
if($path['gridmenu'])require $this->template('own/path-gridmenu');
//侧边栏
if($path['sidebar'])require $this->template('own/path-sidebar');
//通知
if($path['toastr'])require $this->template('own/path-toastr');
//alert美化
if($path['alertify'])require $this->template('own/path-alertify');
//点击编辑 X-Editable
if($path['x_editable'])require $this->template('own/path-x_editable');
//TAG插件
if($path['tokenfield'])require $this->template('own/path-tokenfield');
//下拉菜单高级插件 Select 2
if($path['select_2'])require $this->template('own/path-select_2');
//日期插件
if($path['datepicker'])require $this->template('own/path-datepicker');
//数字微调
if($path['asspinner'])require $this->template('own/path-asspinner');
//弹窗
if($path['bootbox'])require $this->template('own/path-bootbox');
//拖动
if($path['jquery-ui'])require $this->template('own/path-jquery-ui');
//多选 select
if($path['multi-select'])require $this->template('own/path-multi-select');
//触发动画
if($path['appear'])require $this->template('own/path-appear');
?>