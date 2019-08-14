<?php
$metcompress=load::own_class('admin/class/metcompress', 'new');
$shopadminpath = $metcompress->shopadminpath;

//$config  内置UI
//$paths[] 自定义引用文件
//CSS3动画
if($path['animsition']){
    $paths[] = "{$uipath}vendor/animsition/animsition.min.css";
    $paths[] = "{$uipath}vendor/animsition/animsition.min.js";
    $paths[] = "{$uipath}js/components/animsition.min.js";
}
//内容滚动
if($path['asScrollable']) {
    $paths[] = "{$uipath}vendor/asscrollable/asScrollable.min.css";
    $paths[] = "{$uipath}assets/examples/css/advanced/scrollable.css";
    $paths[] = "{$uipath}vendor/asscrollable/jquery.asScrollable.all.min.js";
    $paths[] = "{$uipath}vendor/asscroll/jquery-asScroll.min.js";
    $paths[] = "{$uipath}js/components/asscrollable.min.js";
}
//内容滚动?
if($path['ashoverscroll']) $paths[] = "{$uipath}vendor/ashoverscroll/jquery-asHoverScroll.min.js";
//复选框（左右移动开关）
if($path['switchery']){
    $paths[] = "{$uipath}vendor/switchery/switchery.min.css";
    $paths[] = "{$uipath}vendor/switchery/switchery.min.js";
    $paths[] = "{$uipath}js/components/switchery.min.js";
}
//步骤指南
if($path['intro']){
    $paths[] = "{$uipath}vendor/intro-js/introjs.min.css";
    $paths[] = "{$uipath}vendor/intro-js/intro.min.js";
}
//滑动面板（侧栏等）
if($path['slidepanel']){
    $paths[] = "{$uipath}vendor/slidepanel/slidePanel.min.css";
    $paths[] = "{$uipath}vendor/slidepanel/jquery-slidePanel.min.js";
    $paths[] = "{$uipath}js/components/slidepanel.min.js";
}
//国旗SVG图标
if($path['flag-icon']) $paths[] = "{$uipath}vendor/flag-icon-css/flag-icon.min.css";
//表单验证
if($path['formvalidation']){
    $paths[] = "{$uipath}vendor/formvalidation/formValidation.min.css";
    $paths[] = "{$uipath}vendor/formvalidation/formValidation.min.js";
    $paths[] = "{$uipath}vendor/formvalidation/js/language/zh_CN.js";
    $paths[] = "{$uipath}vendor/formvalidation/framework/bootstrap.min.js";
}
//表格控件
if($path['datatables']){
    $paths[] = "{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.css";
    $paths[] = "{$uipath}vendor/datatables-responsive/dataTables.responsive.min.css";
    $paths[] = "{$uipath}vendor/datatables/jquery.dataTables.min.js";
    $paths[] = "{$uipath}vendor/datatables-bootstrap/dataTables.bootstrap.min.js";
    $paths[] = "{$uipath}vendor/datatables-responsive/dataTables.responsive.js";
    $paths[] = "{$uipath}js/components/datatables.min.js";
    $paths[] = "{$uipath}js/plugins/selectable.min.js";
    $paths[] = "{$uipath}js/components/selectable.min.js";
}
//字体 web-icons
if($path['web-icons']) $paths[] = "{$uipath}fonts/web-icons/web-icons.min.css";
//字体 font-awesome
if($path['font-awesome']) $paths[] = "{$uipath}fonts/font-awesome/font-awesome.min.css";
//字体 glyphicons
if($path['font-glyphicons']) $paths[] = "{$uipath}fonts/glyphicons/glyphicons.min.css";
//鼠标滚轮支持(获取滚轮信息)
if($path['mousewheel']) $paths[] = "{$uipath}vendor/mousewheel/jquery.mousewheel.min.js";
//全屏
if($path['screenfull']) $paths[] = "{$uipath}vendor/screenfull/screenfull.min.js";
//菜单支持
if($path['menu']) $paths[] = "{$uipath}assets/js/sections/menu.min.js";
//菜单栏支持
if($path['menubar']) $paths[] = "{$uipath}assets/js/sections/menubar.min.js";
//网格菜单
if($path['gridmenu']) $paths[] = "{$uipath}assets/js/sections/gridmenu.min.js";
//侧边栏
if($path['sidebar']) $paths[] = "{$uipath}assets/js/sections/sidebar.min.js";
//通知
if($path['toastr']){
    $paths[] = "{$uipath}vendor/toastr/toastr.min.css";
    $paths[] = "{$uipath}vendor/toastr/toastr.min.js";
}
//alert美化
if($path['alertify']){
    $paths[] = "{$uipath}vendor/alertify-js/alertify.min.css";
    $paths[] = "{$uipath}vendor/alertify-js/alertify.js";
}
//点击编辑 X-Editable
if($path['x_editable']){
    $paths[] = "{$uipath}vendor/x-editable/x-editable.min.css";
    $paths[] = "{$uipath}vendor/x-editable/bootstrap-editable.min.js";
    $paths[] = "{$uipath}vendor/x-editable/address.js";
}
//TAG插件
if($path['tokenfield']){
    $paths[] = "{$uipath}vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.css";
    $paths[] = "{$uipath}vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.js";
    $paths[] = "{$uipath}js/components/bootstrap-tokenfield.min.js";
}
//下拉菜单高级插件 Select 2
if($path['select_2']){
    $paths[] = "{$uipath}vendor/select2/select2.min.css";
    $paths[] = "{$uipath}vendor/select2/select2.full.min.js";
    $paths[] = "{$uipath}js/components/select2.min.js";
}
//日期插件
if($path['datepicker']){
    $paths[] = "{$uipath}vendor/bootstrap-datepicker/bootstrap-datepicker.min.css";
    $paths[] = "{$uipath}vendor/clockpicker/clockpicker.min.css";
    $paths[] = "{$uipath}vendor/bootstrap-datepicker/bootstrap-datepicker.min.js";
    $paths[] = "{$uipath}js/components/bootstrap-datepicker.min.js";
    $paths[] = "{$uipath}vendor/clockpicker/bootstrap-clockpicker.min.js";
    $paths[] = "{$uipath}js/components/clockpicker.min.js";
}
//数字微调
if($path['asspinner']){
    $paths[] = "{$uipath}vendor/asspinner/asSpinner.min.css";
    $paths[] = "{$uipath}vendor/asspinner/jquery-asSpinner.min.js";
    $paths[] = "{$uipath}js/components/asspinner.min.js";
}
//弹窗
if($path['bootbox']){
    $paths[] = "{$uipath}vendor/bootbox/bootbox.min.js";
    $paths[] = "{$uipath}js/components/bootbox.min.js";
}
//拖动
if($path['jquery-ui']) $paths[] = "{$uipath}vendor/jquery-ui/jquery-ui.min.js";
//多选 select
if($path['multi-select']){
    $paths[] = "{$uipath}vendor/multi-select/multi-select.min.css";
    $paths[] = "{$uipath}vendor/multi-select/jquery.multi-select.js";
    $paths[] = "{$uipath}js/components/multi-select.min.js";
}
//触发动画
if($path['appear']){
    $paths[] = "{$uipath}vendor/jquery-appear/jquery.appear.js";
    $paths[] = "{$uipath}js/components/jquery-appear.min.js";
}
if($path['style']) $paths[] = "{$_M[url][own]}admin/templates/css/style.css";
if($path['tableset']) $paths[] = "{$_M[url][own]}admin/templates/js/tableset.js";
if($path['discount']) $paths[] = "{$_M[url][own]}admin/templates/js/discount.js";
if($path['finance_index']) $paths[] = "{$_M[url][own]}admin/templates/js/finance_index.js";
if($path['freight']){
    $paths[] = "{$_M[url][own]}admin/templates/css/freight.css";
    $paths[] = "{$_M[url][own]}admin/templates/js/freight.js";
}
if($path['chartist']){
    $paths[] = "{$_M[url][own]}admin/templates/ui/vendor/chartist-js/chartist.min.css";
    $paths[] = "{$_M[url][own]}admin/templates/ui/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css";
    $paths[] = "{$_M[url][own]}admin/templates/ui/vendor/chartist-js/chartist.min.js";
    $paths[] = "{$_M[url][own]}admin/templates/ui/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js";
}
if($path['ecommerce']) $paths[] = "{$_M[url][own]}admin/templates/css/ecommerce.css";
if($path['order_index']) $paths[] = "{$_M[url][own]}admin/templates/js/order_index.js";
if($path['order_list']) $paths[] = "{$_M[url][own]}admin/templates/js/order_list.js";

//UI注册
$metcompress->config = $config;
//文件前缀
$metcompress->prefix = 'metinfo_';
//缓存
$metcompress->cache = false;
if($metcompress->cache){
    $metcompress->ui_version[css]='?2017011209';
    $metcompress->ui_version[js]='?2017011209';
}
//执行合并
$resui = $metcompress->getui($paths);
?>