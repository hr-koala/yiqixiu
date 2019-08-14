<?php
namespace Home\Controller;
use Think\Controller;
class StaticsController extends Controller {

    public function typelist(){
		header("Content-type: text/html; charset=utf-8"); 
		
		 
		
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = ''; 
		$list=M('cate')->where("type='scene_type'")->order('sort asc,id asc')->select();
	 	
		foreach($list as $i=> $vo){
			$sort=$i+1;
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":"'.$vo["title"].'","type":"'.$vo["value"].'","sort":'.$sort.',"status":1,"remark":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;  
		
		//echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":111,"name":"行业","value":"101","type":"scene_type","sort":1,"status":1,"remark":null},{"id":16634,"name":"企业","value":"103","type":"scene_type","sort":2,"status":1,"remark":null},{"id":16635,"name":"个人","value":"102","type":"scene_type","sort":3,"status":1,"remark":null},{"id":16636,"name":"节假","value":"104","type":"scene_type","sort":4,"status":1,"remark":null},{"id":16637,"name":"风格","value":"105","type":"scene_type","sort":5,"status":1,"remark":null}]}';
	}
    public function typelistb(){
		header("Content-type: text/html; charset=utf-8"); 
		
		 
		
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = ''; 
		$list=M('cate')->where("type='scene_type'")->order('sort asc,id asc')->select();
	 	
		foreach($list as $i=> $vo){
			$sort=$i+1;
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":"'.$vo["title"].'","value":"'.$vo["value"].'","type":"'.$vo["type"].'","sort":'.$sort.',"status":1,"remark":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;  
		
		//echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":111,"name":"行业","value":"101","type":"scene_type","sort":1,"status":1,"remark":null},{"id":16634,"name":"企业","value":"103","type":"scene_type","sort":2,"status":1,"remark":null},{"id":16635,"name":"个人","value":"102","type":"scene_type","sort":3,"status":1,"remark":null},{"id":16636,"name":"节假","value":"104","type":"scene_type","sort":4,"status":1,"remark":null},{"id":16637,"name":"风格","value":"105","type":"scene_type","sort":5,"status":1,"remark":null}]}';
	}
 public function msgList(){
        $msg=M('news');
		$status = 1;
        $count = $msg->where($where) -> count();

		$msglist = $msg->where($where)->order('id desc')->select();
        $jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$count.',"pageNo":1,"pageSize":'.$count.'},"list":[';
        foreach ($msglist as $var)
        {
		  $read = M('message');
		  $where1['userid_int'] = session('userid');
		  $where1['newid_int'] = $var['id'];
		  $result = $read->where($where1)-> count();
		  if($result > 0){
			  $status = 2; 
			  if($_GET['unread'] == true){
				  $count = $count-1;
				  $jsonstr ='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$count.',"pageNo":1,"pageSize":'.$count.'},"list":[';
				  continue;
			  }
		  }
          $jsonstrtemp = $jsonstrtemp.'{"id":'.$var['id'].',"type":2,"bizType":'.$var['biztype'].',"toUser":'.json_encode($var['toUser']).',"toEmail":'.json_encode($var['toEmail']).',"fromUser":'.json_encode($var['fromUser']).',"sendTime":'.$var['sendtime'].'000,"title":'.json_encode($var['title']).',"content":'.json_encode($var['content']).',"status":'.$status.',"ext":null,"roleIdList":null},';  
        }
        $jsonstr = $jsonstr . rtrim($jsonstrtemp, ',') . ']}';
        
       echo $jsonstr;
        
    }
   public function getExposeTypes(){
		echo '{"success":true,"code":200,"msg":"操作成功","list":[{"id":180,"name":"色情、赌博、毒品","value":"1","type":"expose_types","sort":1,"status":1,"lang":"zh_CN","scope":"pc"},{"id":181,"name":"谣言、社会负面、诈骗","value":"2","type":"expose_types","sort":2,"status":1,"lang":"zh_CN","scope":"pc"},{"id":182,"name":"邪教、非法集会、传销","value":"3","type":"expose_types","sort":3,"status":1,"lang":"zh_CN","scope":"pc"},{"id":183,"name":"医药、整形、虚假广告","value":"4","type":"expose_types","sort":4,"status":1,"lang":"zh_CN","scope":"pc"},{"id":184,"name":"有奖集赞和关注转发","value":"5","type":"expose_types","sort":5,"status":1,"lang":"zh_CN","scope":"pc"},{"id":185,"name":"违反国家政策和法律","value":"6","type":"expose_types","sort":6,"status":1,"lang":"zh_CN","scope":"pc"},{"id":34054,"name":"其他原因","value":"7","type":"expose_types","sort":7,"status":1,"lang":"zh_CN","scope":"pc"}]}';	
	}
	public function getPageTplType(){
		header('Content-type: text/json');
		header('HTTP/1.1 200 ok');
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":16630,"name":"版式","value":"1101","type":"tpl_page","sort":1,"status":1,"remark":null},{"id":16632,"name":"风格","value":"1103","type":"tpl_page","sort":2,"status":1,"remark":null},{"id":16631,"name":"互动","value":"1102","type":"tpl_page","sort":3,"status":1,"remark":null}]}';	
	}
    public function all(){
		header('Content-type: text/json');
		header('HTTP/1.1 200 ok');
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":[{"id":16633,"name":"行业","value":"101","type":"scene_type","sort":1,"status":1,"remark":null}],"list":null}';
	}
	
	
	public function getCate(){
		header("Content-type: text/html; charset=utf-8"); 
		
		
		
		if(I('get.filetype')){
			$type=intval(I('get.filetype',0));
			$type_js='musType';
		}else{
			$type=intval(I('get.type',0));
			$type_js=$type==1? 'tpType':'bgType';
		}
		$list=M('cate')->where("type='".$type_js."'")->select();
		$count = count($list);
		$jsonstr = '{"total":'.$count.',"rows":[';
		$jsonstrtemp = '';
		foreach($list as $i=> $vo){
			$sort=$i+1;
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"lang":"zh_CN","name":"'.$vo["title"].'","value":'.$vo["value"].',"type":"'.$type_js.'","sort":'.$sort.',"status":1,"remark":null},';
		}
		
		$jsonstrtemp = $jsonstrtemp.'{"id":67243,"name":"背景","value":"1301","type":"tpType","sort":1301,"status":1,"remark":null,"lang":"zh_CN","scope":"all"},';
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;  
	}
	
	public function getCateB(){
		header("Content-type: text/html; charset=utf-8"); 
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		
		if(I('get.filetype')){
			$type=intval(I('get.filetype',0));
			$type_js='musType';
		}else{
			$type=intval(I('get.type',0));
			$type_js=$type==1? 'tpType':'bgType';
		}
		
		$list=M('cate')->where("type='".$type_js."'")->select();
	 
		foreach($list as $i=> $vo){
			$sort=$i+1;
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["id"].',"name":"'.$vo["title"].'","value":'.$vo["value"].',"type":"'.$type_js.'","sort":'.$sort.',"status":1,"remark":null},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;  
	}
	
	public function scene_template_prices(){
		echo '{"success":true,"code":200,"msg":"操作成功","list":[{"id":14863,"name":"免费","value":"0","type":"scene_template_prices","sort":1,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14857,"name":"10","value":"10","type":"scene_template_prices","sort":2,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14858,"name":"20","value":"20","type":"scene_template_prices","sort":3,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14859,"name":"30","value":"30","type":"scene_template_prices","sort":4,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14860,"name":"40","value":"40","type":"scene_template_prices","sort":5,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14861,"name":"50","value":"50","type":"scene_template_prices","sort":6,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"},{"id":14862,"name":"60","value":"60","type":"scene_template_prices","sort":7,"status":1,"remark":"使用样例价格表","lang":"zh_CN","scope":"all"}]}';
	}
	
	public function history_save(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
	
	public function tagList(){
		header("Content-type: text/html; charset=utf-8"); 
		$where['biztype_int'] = I('get.bizType',0);
		$list = M('tag')->where($where)->order('tagid_int asc')->select();
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($list as $vo){
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":"'.$vo["name_varchar"].'","bizType":'.$vo["biztype_int"].',"type":'.$vo["type_int"].',"lang":null,"groupId":10},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}
	 
}