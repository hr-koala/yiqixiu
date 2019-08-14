<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class sys_order_stat{
	
	public $last;
	public $first;
	public $order;
	
	public function __construct() {
		global $_M;
		$this->order = 	load::own_class('admin/class/sys_order', 'new');
		$lastarray   = $this->getlastMonthDays(time());
		$this->last  = $this->order->get_statistics(date('Y-m-01',$lastarray[0]), date('Y-m-d',$lastarray[1]));
		$this->first = $this->order->get_statistics(date('Y-m-01',time()), date('Y-m-d',time()));
	}
	
	public function getlastMonthDays($date){
		 $timestamp=$date;
		 $firstday = strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1).'-01');
		 $lastday  = strtotime(date('Y-m-01',$firstday)." +1 month -1 day");
		 return array($firstday,$lastday);
	}
	
	public function last_month_today($time){
		$last_month_time = mktime(date("G", $time), date("i", $time),
					date("s", $time), date("n", $time), 0, date("Y", $time));
		$last_month_t =  date("t", $last_month_time);
		if ($last_month_t < date("j", $time)) {
			return date("Y-m-t H:i:s", $last_month_time);
		}
		return date(date("Y-m", $last_month_time) . "-d", $time);
	}
	
	public function slot(){
		$slot = array();
		for($i=1;$i<24;$i++){
			$slot[$i] = 0;
		}
		return $slot;
	}
	
	public function slotarry($slot){
		$arry = array();
		foreach($slot as $k => $v){
			$arry[] = $v;
		}
		return $arry;
	}
	
	public function dayslotincome(){
		$search = " AND (ptime >= '".strtotime(date('Y-m-d 00:00:00',time()))."' AND ptime <= '".strtotime(date('Y-m-d 23:59:59',time()))."') ";
		$income  = 'ptime DESC ';
		$incomes = $this->order->get_order_list($search, $income);
		$slot = $this->slot();
		foreach($incomes as $val){
			$h = date('H',$val['ptime']);
			if($h<10)$h = str_replace("0","",$h);
			$slot[$h] = $slot[$h]?$slot[$h]+$val['tprice']:$val['tprice'];
		}
		return $this->slotarry($slot);
	}
	
	public function dayslotorder(){
		$search = " AND (rtime >= '".strtotime(date('Y-m-d 00:00:00',time()))."' AND rtime <= '".strtotime(date('Y-m-d 23:59:59',time()))."') ";
		$order  = 'rtime DESC ';
		$orders = $this->order->get_order_list($search, $order);
		$slot = $this->slot();
		foreach($orders as $val){
			$h = date('H',$val['rtime']);
			if($h<10)$h = str_replace("0","",$h);
			$slot[$h] = $slot[$h]?$slot[$h]+1:1;
		}
		return $this->slotarry($slot);
	}
	
	public function weekslotorder(){
		$w = date('w',time());
		$w = $w==0?7:$w;
		$order  = $this->order->get_statistics(date('Y-m-d',time()-(86400*($w-1))), date('Y-m-d',time()));
		$slot = array();
		foreach($order['detail'] as $val){
			$slot[] = $val['order_number'];
		}
		return $slot;
	}
	
	public function weekslotincome(){
		$w = date('w',time());
		$w = $w==0?7:$w;
		$order  = $this->order->get_statistics(date('Y-m-d',time()-(86400*($w-1))), date('Y-m-d',time()));
		$slot = array();
		foreach($order['detail'] as $val){
			$slot[] = $val['income'];
		}
		return $slot;
	}
	
	public function monthslotorder(){
		$order  = $this->order->get_statistics(date('Y-m-01',time()), date('Y-m-d',time()));
		$slot = array();
		foreach($order['detail'] as $val){
			$slot[] = $val['order_number'];
		}
		return $slot;
	}
	
	public function monthslotincome(){
		$order  = $this->order->get_statistics(date('Y-m-01',time()), date('Y-m-d',time()));
		$slot = array();
		foreach($order['detail'] as $val){
			$slot[] = $val['income'];
		}
		return $slot;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>