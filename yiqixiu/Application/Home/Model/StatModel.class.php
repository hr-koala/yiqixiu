<?php
namespace Home\Model;
use Think\Model;
class StatModel extends Model{
    protected $autoCheckFields = false;
    public function  tongji(){
     //   $nowDateArray  = getdate(time());
       // $dayStart   =mktime(0,0,0,$nowDateArray[ "mon"],$nowDateArray[ "mday"],$nowDateArray[ "year"]);  //当天开始时间戳
        //$dayEnd   =mktime(23,59,59,$nowDateArray[ "mon"],$nowDateArray[ "mday"],$nowDateArray[ "year"]); //当天结束时间戳
        
        $cur_date = strtotime(date('Y-m-d'));
        $_scene = M('scene');
        $_Tj = M('stat');
        $where['scenecode_varchar']=I('get.id');
		$_scene_list=$_scene->where($where)->find();  
        $h = intval(date("H"));
        $data['SCENE_ID'] = $_scene_list['sceneid_bigint'];
        $data['STAT_DATE'] = time();
        $whid['SCENE_ID'] = $_scene_list['sceneid_bigint'];
        $whid['STAT_DATE']  = array('egt',$cur_date);
        $var = $_Tj -> where($whid) -> select(); 
        // print_r($var);exit;
        // groupmessage 群,  singlemessage  朋友 , timeline  朋友圈
        // tj_fxnx ,1朋友圈 2朋友 3微信群 0其它
        if (!empty($var))
        {
            $where['SCENE_ID'] = $_scene_list['sceneid_bigint'];
            $where['delete_int']  = 0;
            $where['STAT_DATE']  = array('egt',$cur_date);
            if ($h < 23 || $h >0)
            { 
                if (I('get.from') == 'timeline')
                {
                    $_Tj -> where($where) -> setInc('S_WX_TIMELINE', 1);
                    $_Tj -> where($where) ->setInc('SHOWS',1);
                } elseif (I('get.from') == 'singlemessage')
                {
                 
                   $_Tj -> where($where) -> setInc('S_WX_SINGLE', 1);
                   $_Tj -> where($where) ->setInc('SHOWS',1);
                } elseif (I('get.from') == 'groupmessage')
                {
                     
                   $_Tj -> where($where) -> setInc('S_WX_GROUP', 1);
                   $_Tj -> where($where) ->setInc('SHOWS',1);
                } 
                else
                {
                   
                    $_Tj -> where($where) -> setInc('S_MOBILE', 1);
                    $_Tj -> where($where) ->setInc('SHOWS',1);
                } 
            } 
          
        } 
        else
        {
                $data['SHOWS']=1;
                $_Tj -> data($data) -> add();
            
        } 
    } 
} 

