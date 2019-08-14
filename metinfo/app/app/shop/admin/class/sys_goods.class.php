<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class sys_goods {

	public function json_product_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		
		$p = $_M['table']['product'];
		$s = $_M['table']['shopv2_product'];
		
		if($_M['config']['shopv2_open']){//开启在线订购时
			$table = $p.' Left JOIN '.$s." ON ({$p}.id = {$s}.pid)";
			$where = "{$p}.lang='{$_M['lang']}' and ({$p}.recycle = '0' or {$p}.recycle = '-1') {$where}";
		}else{
			$table = $p;
			$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		}

		$data = $this->table->getdata($table, '*', $where, $order);

		foreach($data as $key=>$val){
			if(!$val['pid'])$data[$key]['pid'] = $val['id'];
		}

		return $data;
	}
	
	public function json_return($data){
		$this->table->rdata($data);
	}
	
	public function default_value($list){
		global $_M;
		if($list['id']){
			$product = $this->get_product($list['id']);
			$list['plist'] = jsonencode($this->get_plist($list['id']));
			$list['paralist'] = $product['paralist'];
			$list['logistic'] = $product['logistic'];
			$list['price'] = $product['price'];
			$list['stock'] = $product['stock'];
			$list['stock_show'] = $product['stock_show'];
			$list['original'] = $product['original']>0?$product['original']:'';
			$list['freight_mould'] = $product['freight_mould'];
			$list['freight'] = $product['freight'];
			$list['purchase'] = $product['purchase'];
			$list['lnvoice'] = $product['lnvoice'];
			$list['message'] = $product['message'];
			$list['user_discount'] = $product['user_discount'];
			$list['freight_type']=2;
			if(!$list['logistic'])$list['freight_type']=0;
			if($list['freight_mould'])$list['freight_type']=1;
		}else{
			$list['freight'] = '0.00';
			$list['freight_type'] = 2;
			$list['purchase'] = 0;
			$list['user_discount'] = 1;
			$list['stock_show'] = 1;
			$list['lnvoice'] = 0;
		}
		return $list;
	}
	
	public function copy_product($pid,$newid){
		global $_M;
		$form = $this->get_product($pid);
		$this->insert_product_sql($newid,$form['paralist'],$form['logistic'],$form['price'],$form['stock_show'],$form['stock'],$form['original'],$form['freight_mould'],$form['freight'],$form['purchase'],$form['message'],$form['user_discount'],$form['lnvoice']);
		$plist = $this->get_plist($pid);
		foreach($plist as $val){
			$this->insert_plist_sql($newid,$val['price'],$val['valuelist'],$val['stock'],0);
		}
	}
	
	public function del_product($pid){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_product']} WHERE pid='{$pid}'";
		DB::query($query);
		$query = "DELETE FROM {$_M['table']['shopv2_plist']} WHERE pid='{$pid}'";
		DB::query($query);
	}
	
	public function save_product($pid,$form){
		global $_M;
		if($form['shop_paralist']){
			$paralist = stripslashes($form['shop_paralist']);
			$paralists = json_decode($paralist, true);
			$this->para_update($paralists);
		}
		switch($form['freight_type']){
			case 0:
				$form['logistic'] = 0;
				$form['freight_mould'] = 0;
				$form['freight'] = 0;
			break;
			case 1:
				$form['logistic'] = 1;
				$form['freight'] = 0;
			break;
			case 2:
				$form['logistic'] = 1;
				$form['freight_mould'] = '';
			break;
		}
		if($this->get_product($pid)){
			$this->update_product_sql($pid,$paralist,$form['logistic'],$form['price'],$form['stock_show'],$form['stock'],$form['original'],$form['freight_mould'],$form['freight'],$form['purchase'],$form['shop_message'],$form['user_discount'],$form['lnvoice']);
		}else{
			$this->insert_product_sql($pid,$paralist,$form['logistic'],$form['price'],$form['stock_show'],$form['stock'],$form['original'],$form['freight_mould'],$form['freight'],$form['purchase'],$form['shop_message'],$form['user_discount'],$form['lnvoice']);
		}
		$this->insert_plist($pid,$form['shop_plist']);
	}
	
	public function para_update($paralist){
		global $_M;
		foreach($paralist as $val){
			if($val['value']){
				$query = "SELECT * FROM {$_M['table']['shopv2_para']} WHERE value='{$val[value]}'";
				$para = DB::get_one($query); 
				if($para){
					if($para['valuelist']!=$val['valuelist']){
						$ypara = explode(',',$para['valuelist'].$val['valuelist']);
						$ypara = array_unique($ypara);
						$valuelist = '';
						foreach($ypara as $v){
							if($v)$valuelist.= $v.',';
						}
						$query = "UPDATE {$_M['table']['shopv2_para']} SET valuelist = '{$valuelist}' WHERE id = '{$para[id]}'";
						DB::query($query);
					}
				}else{
					$query = "INSERT INTO {$_M['table']['shopv2_para']} SET
						value          	= '{$val[value]}',
						valuelist     	= '{$val[valuelist]}'
					";
					DB::query($query);
				}
			}
		}
	}

	public function update_product_sql($pid,$paralist,$logistic,$price,$stock_show,$stock,$original,$freight_mould,$freight,$purchase,$message,$user_discount,$lnvoice){
		global $_M;
		if(!$pid){
			return false;
		}
		$query = "UPDATE {$_M['table']['shopv2_product']} SET
			paralist     	= '{$paralist}',
			logistic     	= '{$logistic}',
			price        	= '{$price}',
			stock_show      = '{$stock_show}',
			stock        	= '{$stock}',
			original        = '{$original}',
			freight_mould   = '{$freight_mould}',
			freight         = '{$freight}',
			purchase        = '{$purchase}',
			message         = '{$message}',
			lnvoice         = '{$lnvoice}',
			user_discount   = '{$user_discount}'
			WHERE pid       = '{$pid}'
		";
		DB::query($query);
		$this->update_searchlist($pid);
	}
	
	public function insert_product_sql($pid,$paralist,$logistic,$price,$stock_show,$stock,$original,$freight_mould,$freight,$purchase,$message,$user_discount,$lnvoice){
		global $_M;
		if(!$pid){
			return false;
		}
		$query = "INSERT INTO {$_M['table']['shopv2_product']} SET
			pid          	= '{$pid}',
			paralist     	= '{$paralist}',
			logistic     	= '{$logistic}',
			price        	= '{$price}',
			stock_show      = '{$stock_show}',
			stock        	= '{$stock}',
			original        = '{$original}',
			freight_mould   = '{$freight_mould}',
			freight         = '{$freight}',
			purchase        = '{$purchase}',
			message         = '{$message}',
			lnvoice         = '{$lnvoice}',
			user_discount   = '{$user_discount}'
		";
		DB::query($query);
		$inid = DB::insert_id();
		$this->update_searchlist($inid);
		return $inid;
	}
	
	public function update_searchlist($pid){
		global $_M;
		$s = '';
		$query  = "SELECT * FROM {$_M['table']['product']} WHERE id = {$pid}";
		$p = DB::get_one($query);
		$s .= $p['title'].'|';
		if($p['class1']){
			$cid = $p['class1'];
			$query  = "SELECT * FROM {$_M['table']['column']} WHERE id = {$cid}";
			$c = DB::get_one($query);
			$s .= $c['name'].'|';
		}
		if($p['class2']){
			$cid = $p['class2'];
			$query  = "SELECT * FROM {$_M['table']['column']} WHERE id = {$cid}";
			$c = DB::get_one($query);
			$s .= $c['name'].'|';
		}
		if($p['class3']){
			$cid = $p['class3'];
			$query  = "SELECT * FROM {$_M['table']['column']} WHERE id = {$cid}";
			$c = DB::get_one($query);
			$s .= $c['name'].'|';
		}
		
		$query  = "SELECT * FROM {$_M['table']['plist']} WHERE listid = '{$pid}' AND module = 3";
		$para = DB::get_all($query);
		foreach($para as $key=>$val){
			if(!$val['imgname'] && $val['info'])$s .= $val['info'].'|';
		}

		$query  = "SELECT * FROM {$_M['table']['shopv2_product']} WHERE pid = '{$pid}'";
		$st = DB::get_one($query);
		$paralistarray = jsondecode($st['paralist']);
		foreach($paralistarray  as $key=>$val){
			$s .= str_replace(',', '|', $val['valuelist']).'|';
		}
		$s = str_replace('||', '|',trim($s, '|'));
		$query = "UPDATE {$_M['table']['shopv2_product']} SET searchlist = '{$s}' WHERE pid = '{$pid}'";
		DB::query($query);
	}
	
	public function update_searchlist_all(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_product']}";
		$result = DB::query($query);
		while($list = DB::fetch_array($result)){
			$this->update_searchlist($list['pid']);
		}
	}
	
	
	public function insert_plist($pid,$standard){
		global $_M;
		$query = "DELETE FROM {$_M['table']['shopv2_plist']} WHERE pid='{$pid}'";
		DB::query($query);
		if($standard){
			$standard = stripslashes($standard);
			$standard = json_decode($standard, true);
			foreach($standard as $val){
				$this->insert_plist_sql($pid,$val['price'],$val['valuelist'],$val['stock'],$val['sales']);
			}
		}
	}
	public function insert_plist_sql($pid,$price,$valuelist,$stock,$sales){
		global $_M;
		if(!$pid){
			return false;
		}
		$query = "INSERT INTO {$_M['table']['shopv2_plist']} SET
			pid          = '{$pid}',
			price        = '{$price}',
			valuelist    = '{$valuelist}',
			stock        = '{$stock}',
			sales        = '{$sales}'
		";
		DB::query($query);
		return DB::insert_id();
	}
	
	public function get_product($pid){
		global $_M;
		$query   = "SELECT * FROM {$_M['table']['shopv2_product']} WHERE pid='{$pid}'";
		$product = DB::get_one($query); 
		return $product;
	}
	
	public function get_plist($pid){
		global $_M;
		$query   = "SELECT * FROM {$_M['table']['shopv2_plist']} WHERE pid='{$pid}'";
		$plist = DB::get_all($query); 
		return $plist;
	}
	
	public function get_para(){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['shopv2_para']} WHERE value!=''";
		$para = DB::get_all($query); 
		foreach($para as $val){
			$valuelist = explode(',',$val['valuelist']);
			$paras[$val['value']] = $valuelist;
		}
		return $paras;
	}
	
	public function get_tmpname($tmpname){
		if($tmpname == 'product_shop_index'){
			return PATH_WEB.'app/app/shop/admin/templates/product_shop_index.php';
		}
		if($tmpname == 'product_shop'){
			return PATH_WEB.'app/app/shop/admin/templates/product_shop.php';
		}
	}
	
	public function plgin_json_list(){
		global $_M;
		$moduleclass = load::mod_class('content/class/sys_product', 'new');
		$class1 = $_M['form']['class1'];
		$class2 = $_M['form']['class2'];
		$class3 = $_M['form']['class3'];
		$keyword = $_M['form']['keyword'];
		$search_type = $_M['form']['search_type'];
		$orderby_hits = $_M['form']['orderby_hits'];
		$orderby_addtime = $_M['form']['orderby_addtime'];
		
		$ps = $_M['config']['shopv2_open']?$_M['table']['product'].'.':'';
		
		$where = $class1&&$class1!='所有栏目'&&$class1!='null'?"and {$ps}class1 = '{$class1}'":'';  
		$where.= $class2&&$class2!='null'?"and {$ps}class2 = '{$class2}'":'';  
		$where.= $class3&&$class3!='null'?"and {$ps}class3 = '{$class3}'":''; 
		$where.= $keyword?"and {$ps}title like '%{$keyword}%'":''; 
		switch($search_type){
			case 0:break;
			case 1:
				$where.= "and {$ps}displaytype = '0'"; 
			break;
			case 2:
				$where.= "and {$ps}com_ok = '1'"; 
			break;
		}		
		
		$met_class = $moduleclass->column(2,3);
		$order = $moduleclass->list_order($met_class[$classnow]['list_order']);
		if($orderby_hits)$order = "{$ps}hits {$orderby_hits}";
		if($orderby_addtime)$order = "{$ps}addtime {$orderby_addtime}";
		
		if($_M['config']['shopv2_open']){//开启在线订购时
			$orderby_stock = $_M['form']['orderby_stock'];
			$orderby_sales = $_M['form']['orderby_sales'];
			$orderby_price = $_M['form']['orderby_price'];
			if($orderby_stock)$order = "{$_M['table']['shopv2_product']}.stock {$orderby_stock}";
			if($orderby_sales)$order = "{$_M['table']['shopv2_product']}.sales {$orderby_sales}";
			if($orderby_price)$order = "{$_M['table']['shopv2_product']}.price {$orderby_price}";
			if($search_type==4)$where.= "and {$_M['table']['shopv2_product']}.stock = '0'"; 
		}
		
		$userlist = $this->json_product_list($where, $order);
		
		foreach($userlist as $key=>$val){
			//开启在线订购时
			if($_M['config']['shopv2_open'])$val['price_html'] = '<p style="color:#f60;">'.load::app_class('shop/web/class/web_func', 'new')->price_str($val['price']).'</p>';
			//
			$val['url']   = $moduleclass->url($val,3);
			$val['state'] = $val['displaytype']?'':'<span class="label label-default">前台隐藏</span>';
			if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">定时发布</span>':'';
			$val['state'].= $val['com_ok']?'<span class="label label-info" style="margin-left:8px;">推荐</span>':'';
			$val['state'].= $val['top_ok']?'<span class="label label-success" style="margin-left:8px;">置顶</span>':'';
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] = "
				<div class=\"media\">
				  <div class=\"media-left\">
					<a href=\"#\">
					  <img class=\"media-object\" src=\"{$val['imgurls']}\" width=\"60\">
					</a>
				  </div>
				  <div class=\"media-body\">
					<a href=\"{$val['url']}\" target=\"_blank\">{$val['title']}</a>
					{$val['price_html']}
				  </div>
				</div>
			";
			$list[] = $val['hits'];
			if($_M['config']['shopv2_open']){//开启在线订购时
				$list[] = $val['stock'];
				$list[] = $val['sales'];
				if($val['stock']==0)$val['state'].= '<span class="label label-danger" style="margin-left:8px;">已售罄</span>';
			}
			$list[] = $val['addtime'];
			$list[] = $val['state'];
			$list[] = "<input name=\"no_order-{$val['id']}\" type=\"text\" class=\"ui-input text-center\" value=\"{$val[no_order]}\">";
			$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}\" class=\"edit\">编辑</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">删除</a>
			";
			$rarray[] = $list;
		}
		$this->json_return($rarray);
		return true;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>