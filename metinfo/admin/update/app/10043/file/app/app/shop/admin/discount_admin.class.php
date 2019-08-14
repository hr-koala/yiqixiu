<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class discount_admin extends admin {
	public $discount;
	
	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		nav::select_nav(4);
		$this->discount = load::own_class('admin/class/sys_discount', 'new');
	}
	
	public function dojson_discount_list(){
		global $_M;
		$search.= $_M['form']['keyword'] ? " and name like '%{$_M['form']['keyword']}%' ":""; 
		$time = time();
		if($_M['form']['state'] == 1){
			$search.= " and s_time > '{$time}'";
		}else if($_M['form']['state'] == 2){
			$search.= " and s_time < '{$time}' and e_time > '{$time}'";
		}else if($_M['form']['state'] == 3){
			$search.= " and e_time < '{$time}'";
		}else{
			$search.= "";
		}
		$order = ' id desc ';
		$data = $this->discount->json_discount_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$list[] = "<span class=\"checkbox-custom checkbox-primary\"><input name=\"id\" type=\"checkbox\" class=\"selectable-item\" value=\"{$val[id]}\"><label></label></span>";
			$list[] = $val['name'];
			$list[] = $val['par'];
			if($val['one_user'] == 1){
				$list[] = '无限制';
			}else{
				$list[] = "{$val['one_user_have']}/人";	
			}
			$list[] = date('Y-m-d H:i', $val['s_time']).'至<br />'.date('Y-m-d H:i', $val['e_time']);
			$list[] = "{$val['receive']}/{$val['amount']}";
			$list[] = "{$val['used']}/{$val['amount']}";
			$list[] = "<a href=\"{$_M['url'][own_form]}a=doeditor&id={$val['id']}\">编辑</a> <a href=\"{$_M['url'][own_form]}a=doeditordiscount&id={$val['id']}\">预览领取页面</a>";
			$rarray[] = $list;
		}
		$this->discount->json_return($rarray);	
	}

	public function doindex(){
		global $_M;
		require_once $this->template('own/discount_index');
	}

	public function doeditor(){	
		global $_M;
		$discount = $this->discount->get_discount_by_id($_M['form']['id']);
		$discount = $this->discount->analysis($discount);
		$discount['s_time_1'] = date("Y-m-d", $discount['s_time']);
		$discount['s_time_2'] = date("H:i", $discount['s_time']);
		$discount['e_time_1'] = date("Y-m-d", $discount['e_time']);
		$discount['e_time_2'] = date("H:i", $discount['e_time']);
		$group = load::sys_class('group', 'new')->get_group_list();
		$action ='doeditorsave';
		$check_all_goods[$discount['all_goods']] = "checked";
		require_once $this->template('own/discount_editor');
	}
	
	public function doadd(){	
		global $_M;
		$discount['one_user'] = 0;
		$discount['one_user_have'] = 1;
		$discount['all_goods'] = 1;
		$group = load::sys_class('group', 'new')->get_group_list();
		$action ='doaddsave';
		$check_all_goods[1] = "checked";
		$discount['s_time_1'] = date("Y-m-d", time());
		$discount['s_time_2'] = date("H:i", time());
		$discount['e_time_1'] = date("Y-m-d", time());
		$discount['e_time_2'] = date("H:i", time());
		require_once $this->template('own/discount_editor');
	}
	
	public function doeditorsave(){
		global $_M;
		if(!$_M['form']['id']){
			turnover("{$_M[url][own_form]}a=doindex", "数据错误");
		}
		if($_M['form']['e_time'] < $_M['form']['s_time']){
			turnover("{$_M[url][own_form]}a=doeditor&id={$_M['form']['id']}", "结束时间必须大于开始时间");
		}
		$this->save($_M['form']);	
		turnover("{$_M[url][own_form]}a=doindex");
	}
	
	public function doaddsave(){
		global $_M;
		if($_M['form']['e_time'] < $_M['form']['s_time']){
			turnover("{$_M[url][own_form]}a=doeditor&id={$_M['form']['id']}", "结束时间必须大于开始时间");
		}
		$this->save($_M['form']);	
		turnover("{$_M[url][own_form]}a=doindex");
	}
	
	public function dojson_goods_list(){
		global $_M;

		$search.= $_M['form']['keyword']?"and title like '%{$_M['form']['keyword']}%'":'';

		$order = '';
		$goods = load::own_class('admin/class/sys_goods', 'new');
		$data = $goods->json_product_list($search, $order);
		foreach($data as $key=>$val){
			$list = array();
			$list[] = $val['title'];
			$list[] = timeFormat(strtotime($val['addtime']));
			if($this->discount->is_discount_goods($val['id'], $_M['form']['select_goods'])){
				$list[] = "<div id=\"select-{$val[pid]}\"><a class=\"noselect_p\" data-id=\"{$val[pid]}\" href=\"javascript:;\">已选取</a></div>";

			}else{ 
				$list[] = "<div id=\"select-{$val[pid]}\"><a class=\"select_p\" data-id=\"{$val[pid]}\" href=\"javascript:;\">选取</a></div>";
			}
			$rarray[] = $list;
		}
		$goods->json_return($rarray);	
	}
	
	public function do_json_discount_goods(){
		global $_M;
		$ids = explode(',', $_M['form']['idlist']);
		$html = '';
		foreach($ids as $key=>$val){
			if($val){
				$query = "SELECT * FROM {$_M['table']['product']} WHERE id = '{$val}'";
				$p = DB::get_one($query);
				$html .= "<div id=\"goods-div-{$val['id']}\" class=\"col-lg-8\" style=\"margin-top:1px;\">
								<span class=\"btn btn-primary\">
									<span>{$p['title']}</span>
									<button type=\"button\" class=\"close\" style=\"margin-top:-4px;\">
										<span style=\"font-size:20px;\" aria-hidden=\"true\">&nbsp;<a href=\"javascript:;\"  class=\"del-goods\" data-id=\"{$val['id']}\" style=\"color:#fff;\">&times;</a></span>
									</button>
								</span>		
							</div>
				";
			}
		}
		echo $html;
		
	}
	
	public function save($data){
		$data['s_time'] = strtotime("{$data['s_time_1']} {$data['s_time_2']}");
		$data['e_time'] = strtotime("{$data['e_time_1']} {$data['e_time_2']}");
		$info = copykey($data, $this->discount->save_discount_key());

		$this->discount->save_discount($info);
	}
	
	public function dodel(){
		global $_M;
		$allid = explode(',' , $_M['form']['allid']);
		foreach($allid as $key=>$val){
			if($val)$this->discount->del_discount($val);
		}
		$retun['success'] = '删除成功';
		echo jsonencode($retun);
	}
	
	
	
	
	
	
	
	
	
	
	
	
}