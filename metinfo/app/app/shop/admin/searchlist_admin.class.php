<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class searchlist_admin extends admin {
	public $searchlist;
	
	public function __construct() {
		parent::__construct();
		global $_M;
		load::own_class('admin/class/shop_nav', 'new');
		nav::set_nav(6, '搜索选项设置', "{$_M[url][adminurl]}n=shop&c=searchlist_admin&a=doindex");
		nav::select_nav(6);
		$this->searchlist = load::own_class('admin/class/sys_searchlist', 'new');
	}
		
	public function doindex(){
		global $_M;
		require_once $this->template('own/searchlist_index');
	}
	
	public function dojson_searchlist_list(){
		global $_M;
		$data = $this->searchlist->get_searchlist_all();
		jsoncallback($data);
	}
	
	public function doadd_searchlist(){
		global $_M;
		$val['name'] = $_M['form']['name'];
		$val['no_order'] = $this->searchlist->get_searchlist_order($_M['form']['sid']) + 1;
		$id = $this->searchlist->save_searchlist($val);	
		jsoncallback(array('msg'=>'suc','id'=>$id));
	}
	
	public function doeditor_searchlist_name(){
		global $_M;
		$val['name'] = $_M['form']['name'];
		$val['id'] = $_M['form']['id'];
		$this->searchlist->save_searchlist($val);
		jsoncallback(array('msg'=>'suc'));
	}
	
	public function dodel_searchlist(){
		global $_M;
		$val['id'] = $_M['form']['id'];
		$this->searchlist->del_searchlist($val['id']);
		jsoncallback(array('msg'=>'suc'));
	}
	
	public function doeidtor_searchlist_order(){
		global $_M;
		$idlists = explode('|', trim($_M['form']['idlist'], '|'));
		foreach($idlists as $key=>$validlists){
			list($sid, $ids) = explode('-', trim($validlists, '-'));
			$sids[] = $sid;
			$idss = explode(',', $ids);
			$this->searchlist->order_searchlist_tag($sid, $idss);
		}
		$this->searchlist->order_searchlist($sids);
		jsoncallback(array('msg'=>'suc'));
	}
	
	public function doadd_searchlist_tag(){
		global $_M;
		$val['name'] = $_M['form']['name'];
		$val['sid'] = $_M['form']['sid'];
		$val['no_order'] = $this->searchlist->get_searchlist_tag_order($_M['form']['sid']) + 1;
		$id = $this->searchlist->save_searchlist_tag($val);	
		jsoncallback(array('msg'=>'suc','id'=>$id));
	}
	
	public function doeditor_searchlist_tag(){
		global $_M;
		$tag = $this->searchlist->get_searchlist_onetag($_M['form']['id']);
		require_once $this->template('own/searchlist_editor');
	}
	
	public function doeditor_searchlist_tag_save(){
		global $_M;
		global $_M;
		$val['id'] = $_M['form']['id'];
		$val['name'] = $_M['form']['name'];
		$val['title'] = $_M['form']['title'];
		$val['keywords'] = $_M['form']['keywords'];
		$val['description'] = $_M['form']['description'];
		$val['url'] = $_M['form']['url'];
		$this->searchlist->save_searchlist_tag($val);
		jsoncallback(array('msg'=>'suc'));
	}

	public function dodel_searchlist_tag(){
		global $_M;
		$val['id'] = $_M['form']['id'];
		$this->searchlist->del_searchlist_tag($val['id']);
		jsoncallback(array('msg'=>'suc'));
	}
	
	
	public function doaddsearchlist(){
		global $_M;
		$id = 'new-'.$_M[form][ai];
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" class=\"ui-input\" name=\"no_order-{$id}\" value=\"0\" data-required=\"1\"></td>
					<td><input type=\"text\" class=\"ui-input\" name=\"name-{$id}\" value=\"\" data-required=\"1\"></td>
					<td><input type=\"text\" class=\"ui-input\" name=\"value-{$id}\" value=\"\" data-required=\"1\"></td>
					<td><a href=\"\" class=\"delet\">{$_M[word][js49]}</a></td>
				</tr>"; 
		echo $metinfo;
	}
	
	public function dotablesearchlist(){
		global $_M;
		$allid = explode(',' , $_M['form']['allid']);
		$data = array();
		$list = array();
		foreach($allid as $key=>$val){
			if($val){
				if(is_number($val)){
					$list['id'] = $val;
				}else{
					$list['id'] = "";
				}
				$list['name'] = $_M['form']['name-'.$val];
				$list['value'] = $_M['form']['value-'.$val];
				$list['no_order'] = $_M['form']['no_order-'.$val];
				$data[$val] = $list;
				$list = array();
			}
		}

		if($_M['form']['submit_type'] == 'save'){
			foreach($data as $key=>$val){
				$this->searchlist->save_searchlist($val);
			}
		}else{
			foreach($data as $key=>$val){
				if(is_number($val['id']))$this->searchlist->del_searchlist($val['id']);
			}
		}
		turnover("{$_M[url][own_form]}a=doindex");
	}
	
	public function doupdatese(){
		global $_M;
		$this->searchlist = load::own_class('admin/class/sys_goods', 'new')->update_searchlist_all();	
		turnover("{$_M[url][own_form]}a=doindex");
	}
}