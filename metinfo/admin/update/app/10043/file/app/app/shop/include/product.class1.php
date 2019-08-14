<?php
error_reporting(E_ERROR | E_PARSE);
$gotonew = 1;
function get_module($murlid, $furlid) {
	if(isset($murlid)){
		$murlids = explode('_', $murlid);
		$htmlurl_last = $murlids[count($murlids)-1];
		//是否是默认语言
		if($met_langok[$htmlurl_last]) {
			$lang = $htmlurl_last;
			unset($murlids[count($murlids)-1]);
			$htmlurl_last = $murlids[count($murlids)-1];
		}
		//列表页或内容页
		if(is_numeric($htmlurl_last) && count($murlids) != 1 && !strstr($htmlurl_last, '.')){
			$list = 1;
			return 'product_list';
		}else{
			$list = 0;
			return 'product_show';
		}
	}
		
}
if($cmodule == 'product_index'){
	if(@$_GET['metid']){
		if(@$_GET['list'] == 1){
			$cmodule='product_list';
		}else{
			$cmodule='product_show';
		}
	}
	// 如果是伪静态或静态
	if(@$_GET['murlid'] && @$_GET['furlid']){
		$cmodule = get_module($_GET['murlid'], $_GET['furlid']);
	}
}

define('PROOTPATH', substr(dirname(__FILE__), 0, -20));
	require_once PROOTPATH.'include/mobile_detect.php';
	require_once PROOTPATH.'include/mysql_class.php';
	$detect = new mobile_detect;
	$db_settings=array();
	$db_settings = parse_ini_file(PROOTPATH.'config/config_db.php');
	@extract($db_settings);
	$sql = new dbmysql();
	$sql->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
	$met_index_type = $sql->get_one("SELECT * FROM {$tablepre}config WHERE name='met_index_type' and lang='metinfo'");
	$met_index_type = $met_index_type['value'];

	if($_GET['lang']!="") {
		$lang = $_GET['lang'];
	}else{
		if($htmlurl_last) {
			$lang = $htmlurl_last;
		}else{
			$lang = $met_index_type;
		}
	}

if($cmodule == 'product_show' || $cmodule == 'product_list'){
	
	$is_mobile = 0;
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	if($_SERVER['HTTP_USER_AGENT']){
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
		if(preg_match($uachar, $ua) && !$detect->isTablet()){
			$is_mobile = 1;
		}
	}
	
	if($is_mobile){
		$query = "SELECT * FROM {$tablepre}config WHERE lang='{$lang}' AND name='wap_skin_user'";
		$muban = $sql->get_one($query);

	}else{
		$query = "SELECT * FROM {$tablepre}config WHERE lang='{$lang}' AND name='met_skin_user'";
		$muban = $sql->get_one($query);
	}
	$muban = $muban['value'];

	if(!file_exists(ROOTPATH.'templates/'.$muban.'/shop_product.php') || !file_exists(ROOTPATH.'templates/'.$muban.'/shop_product.html')){
		$gotonew = 0;
	}
	
}

$query = "SELECT * FROM {$tablepre}config WHERE lang='{$lang}' AND name='shopv2_open'";

$shopv2_open = $sql->get_one($query);
$sql->close();
$gotonew = $shopv2_open['value'];
if(file_exists(PROOTPATH.'/app/app/shop/include/my_product.class.php')){
	require_once PROOTPATH.'/app/app/shop/include/my_product.class.php';
}

?>