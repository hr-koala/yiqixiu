<?php


/**
 * TODO  
 * @param $count 要分页的总记录数
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage($count, $pagesize = 10) {
	$p = new Think\Page($count, $pagesize);
	$p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$p->setConfig('prev', '上一页');
	$p->setConfig('next', '下一页');
	$p->setConfig('last', '末页');
	$p->setConfig('first', '首页');
	$p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	$p->lastSuffix = false;//最后一页不显示为总页数
	return $p;
}
function get_file($url,$name,$folder = './')
{
	set_time_limit((24 * 60) * 60);
	// 设置超时时间
	$destination_folder = $folder . '/';
	// 文件下载保存目录，默认为当前文件目录
	if (!is_dir($destination_folder)) {
		// 判断目录是否存在
		mkdirs($destination_folder);
	}
	$newfname = $destination_folder.$name;
	// 取得文件的名称
	$file = fopen($url, 'rb');
	// 远程下载文件，二进制模式
	if ($file) {
		// 如果下载成功
		$newf = fopen($newfname, 'wb');
		// 远在文件文件
		if ($newf) {
			// 如果文件保存成功
			while (!feof($file)) {
				// 判断附件写入是否完整
				fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
			}
		}
	}
	if ($file) {
		fclose($file);
	}
	if ($newf) {
		fclose($newf);
	}
	return true;
}

function mkdirs($path, $mode = '0777')
{
	if (!is_dir($path)) {
		// 判断目录是否存在
		mkdirs(dirname($path), $mode);
		// 循环建立目录
		mkdir($path, $mode);
	}
	return true;
}

function getMovietypeList(){
							   //               2         3             4               5							7					9
	$array=array('上下翻页','上下惯性翻页','左右翻页','左右惯性翻页','上下连续翻页','左右连续翻页','立体翻页','卡片翻页','放大翻页','交换翻页','翻书翻页','掉落翻页');
	return $array;
}

function getPageMode($mode){	
	$array=getMovietypeList();
	return $array[$mode];
}

function conf_read($file, $mode = true)
{
	$file=strpos($file,'php')!==false ? $file : $file.'.php';
	$cachefile = WWW_ROOT.'/Application/Common/'.$file;
	if(!file_exists($cachefile)) return array();
	return $mode ? include $cachefile : file_get_contents($cachefile);
}
function conf_write($file, $string, $type = 'array')
{	$file=strpos($file,'php')!==false ? $file : $file.'.php';

	if(is_array($string))
	{
		$type = strtolower($type);
		if($type == 'array')
		{
			$string = "<?php\n return ".var_export($string,TRUE).";\n?>";
		}
		elseif($type == 'constant')
		{
			$data='';
			foreach($string as $key => $value) $data .= "define('".strtoupper($key)."','".addslashes($value)."');\n";
			$string = "<?php\n".$data."\n?>";
		}
	}
	$strlen = @file_put_contents(WWW_ROOT.'/Application/Common/'.$file, $string);
	@chmod(WWW_ROOT.'/Application/Common/'.$file, 0777);
	return $strlen;
}

function getBiztypeCateName($value){
	return M('cate')->where('value='.$value)->getField('title');
}


function getBiztypeCateNameN($type,$value){
	//echo $value.'  '.$type;
	$title=M('cate')->where('value='.$value." AND type='$type'")->getField('title');
	
	return $title;
}
function getUserRole($role){
	$array=array('普通','VIP','顶级VIP' );
	return $array[$role];
}
function getUserType($role){
	$array=array('普通用户','企业用户','高级用户' ,'服务商用户');
	return $array[$role-1];
}

function getCateName($mode){
	
	$array=array('tpType'=>'图片','bgType'=>'背景','musType'=>'音乐','scene_type'=>'场景' );
	return $array[$mode];
}
function getTpyeNameToId($mode){
	$array=array('tpType'=>1,'bgType'=>0,'musType'=>33  ,'scene_type'=>2);
	return $array[$mode];
}
function getTpyeNameById($mode){
	$array=array( 0=>'bgType' ,1=>'tpType',33=>'musType'  ,2=>'scene_type');
	return $array[$mode];
}


function getUserName($id){
	$userinfo=M('users')->where("userid_int='$id'")->field('uname,email_varchar')->find();
	
	return $userinfo['uname']?$userinfo['uname']:$userinfo['email_varchar'];
}

function getAllCate(){
	$cateAll_list=M('cate')->select();
	$re_arr=array();
	foreach($cateAll_list as $k=>$row){
		
	}
	
}
function getSceneType($type='scene_type',$value){
	
	$title=M('cate')->where("value='$value' AND type='$type'")->getField('title');
	
	return $title;
	
}
function getSceneTag($biztypeId){

	$title=M('tag')->where("type_int=2 and tagid_int=".$biztypeId)->getField('name_varchar');
	return $title;
}
function getTagName($type_int,$biztypeId){
	if($type_int==2) return '';
	$title=M('tag')->where("type_int=$type_int and tagid_int=".$biztypeId)->getField('name_varchar');
	return $title;
}

function getAdWzi($ad_wzi){
	$arr=array('首页','尾页');
	return $arr[$ad_wzi];
}

function getOrderStatus($pay_status,$order_status){
	 
	$arr1=array('未付款','已付款');
	$arr2=array('未确定','已完成','等待买家付款');
	return $arr1[$pay_status].'、'.$arr2[$order_status];
}