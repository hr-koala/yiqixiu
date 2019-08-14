<?php
namespace Home\Controller;
use Think\Controller;
class StatController extends Controller {
    public function index(){
        if (IS_GET) {
            $datas = I('get.'); 
            $_tj = M('stat');
			// $where['STAT_DATE']=array('GT',substr($datas['startDate'], 0, -3));
            
            //print_r(date('Y-m-d H:i:s', substr($datas['startDate'], 0, -3)));
            $data=substr($datas['endDate'], 0, -3);
            $data1=substr($datas['startDate'], 0, -3);
            $where['STAT_DATE']=array('gt',$data1);
            //$where['stat_date']=array('egt',$data);
            $where['SCENE_ID']=$datas['id'];
            $_wxtj=$_tj->where($where)->field('id',true)->order('stat_date asc')->limit(30)->select();
        foreach ($_wxtj as $key => $data )
            {
                $_wxtj[$key] =  array_change_key_case($data,CASE_UPPER);
                $_wxtj[$key]['STAT_DATE'] =date('Y-m-d',$data['stat_date']); 
                $_wxtj[$key]['SHOW'] =$data['shows'];
            }
            $jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":4,"pageNo":1,"pageSize":30},"list":';
            $jsonstrtemp = '';
            $jsonstrtemp = $jsonstrtemp .json_encode($_wxtj);
            // groupmessage 群,  singlemessage  朋友 , timeline  朋友圈
            // tj_fxnx ,1朋友圈 2朋友 3微信群 0其它
            $jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'}';
            echo $jsonstr;
        }
		

    }
	
	public function statget(){
		$date = date("Y-m-d");
		$where['stat_date'] = $date;
		$where['sceneid_bigint'] = I('get.sceneid',0);
		$userid = M('scene')->where('sceneid_bigint='.I('get.sceneid',0))->getField('userid_int');

		$_stat = M('stat');
		$_stat_id = $_stat->where($where)->find();
		$datainfo['add_time'] = mktime(0,0,0,date("m"),date("d"),date("Y"));	
		switch (I('get.type',0)) {
			case 0:
				echo "type = 0";
				break;
			case 10: //show
				//echo "link";
				if($_stat_id){
					$datainfo['show'] = $_stat_id['show'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 'show-save';					
				}else{
					$datainfo['show'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 'show-add';
				}
				break;
			case 1: //link
				//echo "link";
				if($_stat_id){
					$datainfo['link'] = $_stat_id['link'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 'link-save';					
				}else{
					$datainfo['link'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 'link-add';
				}
				\Think\Log::write(	'link-add'.  D('')->getLastSql()); 
				break;
			case 2: //tel
				//echo "tel";
				if($_stat_id){
					$datainfo['tel'] = $_stat_id['tel'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 'tel-save';					
				}else{
					$datainfo['tel'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 'tel-add';
				}
				\Think\Log::write(	'tel'.  D('')->getLastSql()); 
				break;
			case 3: //s_mobile
				//echo "s_mobile";
				if($_stat_id){
					$datainfo['s_mobile'] = $_stat_id['s_mobile'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 's_mobile-save';					
				}else{
					$datainfo['s_mobile'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 's_mobile-add';
				}
				\Think\Log::write(	's_mobile'.  D('')->getLastSql()); 
				break;
			case 4: //s_wx_single
				//echo "s_wx_single";
				if($_stat_id){
					$datainfo['s_wx_single'] = $_stat_id['s_wx_single'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 's_wx_single-save';					
				}else{
					$datainfo['s_wx_single'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 's_wx_single-add';
				}
				\Think\Log::write(	's_wx_single'.  D('')->getLastSql()); 
				
				break;
			case 5: //s_wx_timeline
				//echo "s_wx_timeline";
				if($_stat_id){
					$datainfo['s_wx_timeline'] = $_stat_id['s_wx_timeline'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 's_wx_timeline-save';					
				}else{
					$datainfo['s_wx_timeline'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 's_wx_timeline-add';
				}
				break;
			case 6: //s_wx_group
				//echo "s_wx_group";
				if($_stat_id){
					$datainfo['s_wx_group'] = $_stat_id['s_wx_group'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 's_wx_group-save';					
				}else{
					$datainfo['s_wx_group'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 's_wx_group-add';
				}
				break;
			case 7: //data
				//echo "data";
				if($_stat_id){
					$datainfo['data'] = $_stat_id['data'] + 1;
					M('stat')->data($datainfo)->where('id='.$_stat_id['id'])->save();
					echo 'data-save';					
				}else{
					$datainfo['data'] = 1;
					$datainfo['sceneid_bigint'] = I('get.sceneid',0);
					$datainfo['userid_int'] = $userid;
					$datainfo['show'] = 1;
					$datainfo['stat_date'] = $date;
					M('stat')->data($datainfo)->add();
					echo 'data-add';
				}
				break;
			default:
				echo "type not find";
		}
	}
	
	
	

 

}