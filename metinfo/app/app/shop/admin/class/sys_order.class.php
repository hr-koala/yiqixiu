<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::own_class('web/class/web_order');

class sys_order extends web_order{

	public function auto_statistics(){
		global $_M;
		$query = "SELECT max(start_time) FROM {$_M['table']['shopv2_order_statistics']} WHERE  statistics_time='86400' AND lang='{$_M['lang']}'";
		$max = DB::get_one($query);
		$now = strtotime(date('Y-m-d 00:00:00'));
		$stime = $max['max(start_time)'] ? $max['max(start_time)'] : $now;
		$stime = $stime - 86400;
		while($stime<=$now){
			$etime = $stime + 86399;
			$query = "SELECT * FROM {$_M['table']['shopv2_order']} WHERE state>1 AND rtime>={$stime} AND rtime<{$etime} AND lang='{$_M['lang']}' AND type=1";
			$order = DB::get_all($query);
			$order_number = 0;
			$income = 0;
			$order_user_array = array();
			foreach($order as $key=>$val){
				$order_number ++;
				$income += $val['tprice'];
				$order_user_array[$val['uid']] = 1;
			}

			$order_user = count($order_user_array);
			$order_user_list = trim(implode('|', array_keys($order_user_array)));
			$query = "SELECT * FROM {$_M['table']['shopv2_order_statistics']} WHERE start_time='{$stime}' AND statistics_time='86400' AND lang='{$_M['lang']}'";
			$statistics = DB::get_one($query);
			if($statistics){
				$query = "UPDATE {$_M['table']['shopv2_order_statistics']} SET order_number='{$order_number}',income='{$income}',order_user='{$order_user}',order_user_list='{$order_user_list}' WHERE id='{$statistics['id']}'";
				DB::query($query);
			}else{
				$query = "INSERT INTO {$_M['table']['shopv2_order_statistics']} SET start_time='{$stime}',statistics_time='86400',order_number='{$order_number}',income='{$income}',order_user='{$order_user}',order_user_list='{$order_user_list}',lang='{$_M['lang']}'";
				DB::query($query);
			}
			$stime = $stime + 86400;
		}
		
	}
	
	public function get_statistics($sdate, $edate){
		global $_M;
		list($syear, $smouth, $sday) = explode('-', $sdate);
		if($syear&&$smouth&&$sday){
			$stime = strtotime("{$syear}-{$smouth}-{$sday} 00:00:00");
			$dkay = date('Y-m-d', $stime);
			$type = 'day';
		}else if($syear&&$smouth){
			$stime = strtotime("{$syear}-{$smouth}-1 00:00:00");
			$dkay = date('Y-m', $stime);
			$type = 'mouth';
		}else if($syear){
			$stime = strtotime("{$syear}-1-1 00:00:00");
			$dkay = date('Y', $stime);
			$type = 'year';
		}else{
			return false;
		}
		
		list($eyear, $emouth, $eday) = explode('-', $edate);
		if($eyear&&$emouth&&$eday){
			$etime = strtotime("{$eyear}-{$emouth}-{$eday} 23:59:59");
		}else if($eyear&&$emouth){
			$etime = strtotime("{$eyear}-{$emouth}-1 00:00:00  +1 month -1 day") + 86399;
		}else if($eyear){
			$etime = strtotime("{$eyear}-12-31 23:59:59");
		}else{
			return false;
		}
		
		$query = "SELECT * FROM {$_M['table']['shopv2_order_statistics']} WHERE start_time>='{$stime}' AND start_time<='{$etime}' AND lang='{$_M['lang']}' ORDER BY start_time ASC";
		$statistics = DB::get_all($query);
		$key = 0;
		$data['sum']['order_number'] = 0;
		$data['sum']['income'] = 0;
		$data['sum']['order_user'] = 0;
		$data['sum']['order_user_list'] = '';
		while($stime<$etime){
			if(!isset($data['detail'][$dkay])){
				$data['detail'][$dkay]['order_number'] = 0;
				$data['detail'][$dkay]['income'] = 0;
				$data['detail'][$dkay]['order_user_list'] = '';
				$data['detail'][$dkay]['order_user'] = 0;
			}
			if($statistics[$key]['start_time'] == $stime){
			
				$data['detail'][$dkay]['order_number'] += $statistics[$key]['order_number'];
				$data['detail'][$dkay]['income'] += $statistics[$key]['income'];
				$data['detail'][$dkay]['order_user_list'] = $this->statistics_user_count($data['detail'][$dkay]['order_user_list'], $statistics[$key]['order_user_list']);
				$data['detail'][$dkay]['order_user'] = $data['detail'][$dkay]['order_user_list'] ? count(explode('|', $data['detail'][$dkay]['order_user_list'])) : 0;

				$data['sum']['order_number'] += $statistics[$key]['order_number'];
				$data['sum']['income'] += $statistics[$key]['income'];
				$data['sum']['order_user_list'] = $this->statistics_user_count($data['sum']['order_user_list'], $statistics[$key]['order_user_list']);
				$data['sum']['order_user'] = $data['sum']['order_user_list']? count(explode('|', $data['sum']['order_user_list'])) : 0;
				
				$key ++;
			}
			$stime = $stime + 86400;	
			switch($type){
				case 'day' :
					if(date('Y-m-d', $stime)!=$dkay){
						$dkay = date('Y-m-d', $stime);
					}
				break;
				case 'mouth' :
					if(date('Y-m', $stime)!=$dkay){
						$dkay = date('Y-m', $stime);
					}
				break;
				case 'year' :
					if(date('Y', $stime)!=$dkay){
						$dkay = date('Y', $stime);
					}
				break;
			}		
		}
		return $data;
	}
	
	public function statistics_user_count($list1, $list2){
		$array1 = explode('|', $list1);
		$array2 = explode('|', $list2);
		return trim(implode('|', array_unique(array_merge($array1, $array2))), '|');
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>