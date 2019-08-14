<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function unlogin(){
		if(intval(session('userid')) == 0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
	}
    public function check(){
		if(intval(session('userid'))>0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			cookie('USERID',session('userid'));
			cookie('MD5STR',session('md5str'));
			
			$_info = M('users')->where('userid_int='.session('userid'))->select();
			
			
	/*		$role_str=$_info[0]['role'] ? ',"role":'.$_info[0]['role'] :',"role":0';
			
			$_info[0]["xd"]=$_info[0]["xd"] ? intval($_info[0]["xd"]):0;
			$_info[0]["sex"]=$_info[0]["sex"] ? intval($_info[0]["sex"]):0;
			$_info[0]["type"]=$_info[0]["type"]? intval($_info[0]["type"]):1;
			$userInfoStr='"id":'.session('userid').',"loginName":"'.$_info[0]["email_varchar"].'","xd":'.$_info[0]["xd"].$role_str.',"sex":'
			.$_info[0]["sex"].',"phone":'.json_encode($_info[0]["phone"]).',"tel":'
			.json_encode($_info[0]["tel"]).',"qq":'.json_encode($_info[0]["qq"]).',"headImg":'
			.$img.',"idNum":null,"idPhoto":null,"regTime":1425093623000,"extType":0,"property":"'
			.$property.'","companyId":null,"deptName":null,"deptId":0,"name":'.json_encode($_info[0]["uname"]).',"email":"'.$_info[0]["email_varchar"].'","type":'.$_info[0]["type"].',"status":'.$_info[0]["status_int"].',"relType":null,"companyTplId":null,"roleIdList":['.$_info[0]["level_int"].']';
			*/
			session('level_int',$_info["level_int"]);
			session('type',$_info["type"]);
			$userInfoStr=getUsreJsonStr($_info[0]);
			$jsonStr='{"success":true,"code":200,"msg":"操作成功","obj":{'.$userInfoStr.'},"map":null,"list":null}';
			echo $jsonStr;
		}
		else
		{   
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			//header('HTTP/1.1 401.3 Unauthorized');   //header('HTTP/1.1 401 Unauthorized');
			// header('status: 401 Unauthorized'); 
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> 'NOLOGION',"list"=> null));
		}
    }
	
	public function promotion(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":{"id":13531,"code":"001","title":"邀请好友送秀点","startDate":1423843200000,"endDate":1424102399000,"link":null,"status":1,"type":1,"ios":0,"android":0,"image":null},"map":null,"list":null}';
	}
    public function login(){		
		header("Content-type: text/json; charset=utf-8");
		if (IS_POST && intval(session('userid'))==0) {
			$datas = $_POST;
			$field=C('REG_FIELD')? C('REG_FIELD'):'email_varchar';	

			$password_varchar = md5($datas['password']);
			$userinfo[$field] = $datas['username'];
			$userinfo['status_int'] = 1;
			
			$User = M('users');
			 
			$returnInfo=$User->where($userinfo)->find();
			
			if($returnInfo){
				if($returnInfo['password_varchar']==$password_varchar){
					
					if(intval( $returnInfo['end_time'] )>0  && $returnInfo['end_time'] <time()){ 
						
						echo  '{"success":false,"code":1004,"msg":"您的账号已过期，请与管理员联系","map":{"isValidateCodeLogin":false}}';
						
					}else{
						
						session('userid',$returnInfo["userid_int"]);
						session('name',$returnInfo["uname"]);
						session('username',$returnInfo[$field]);
						session('phone',$returnInfo['phone']);
						session('level_int',$returnInfo["level_int"]);
						session('type',$returnInfo["type"]);
						session('email',$returnInfo["email_varchar"]);
						session('md5str',md5('adklsj[]999875sssee,'.$returnInfo["id"]));
						cookie('USERID',$returnInfo["userid_int"]);
						cookie('MD5STR',md5('adklsj[]999875sssee,'.$returnInfo["id"]));
						header('HTTP/1.1 200 ok');
						
						
						$update['last_time'] = date('y-m-d H:i:s',time());
						$User->where(array('userid_int'=>$returnInfo["userid_int"]))->save($update);
						echo '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":null}';
						
					}
					exit;
				}else{
					echo  '{"success":false,"code":1004,"msg":"密码错误","map":{"isValidateCodeLogin":false}}';
					
				}
				
			}else{
				echo  '{"success":false,"code":1003,"msg":"账号不存在或者已经被禁用","map":{"isValidateCodeLogin":false}}';
				exit;
			} 
		}else{
				echo '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":null}';
			
		}
    }

	public function checkN(){	
		header("Content-type: text/json; charset=utf-8");
		$userinfo[email_varchar] = I('get.username',0);
		$User = M('users');
		$is_exist_id=$User->where($userinfo)->getField('userid_int');
		if($is_exist_id){
			echo '{"success":false,"code":1006,"msg":"账号已经存在","obj":null,"map":null,"list":null}';
			exit;	
		}else{
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
		}
	}
	
    public function register(){	 
		header("Content-type: text/html; charset=utf-8");
		if (IS_POST) {
			if(!C('is_open_reg')){
				 
				echo '{"success":false,"code":1006,"msg":"网站关闭注册","obj":null,"map":null,"list":null}';
				exit;	
			}
			$datas = $_POST;
			$field='email_varchar';	

			$userinfo['password_varchar'] = md5($datas['password']);
			$userinfo[$field] = $datas['email'];
				
			if(!$datas['password']){
				 
				echo '{"success":false,"code":1006,"msg":"密码不能为空","obj":null,"map":null,"list":null}';
				exit;	
			}	
		    if($field!='email_varchar')	{
			   $userinfo['email_varchar'] = $datas['email'].'@qq.com';
			
			}	
		
			$User = M('users');
			$is_exist_id=$User->where("$field='".$userinfo[$field] ."'")->getField('userid_int');
			 if($is_exist_id){
				 
				echo '{"success":false,"code":1006,"msg":"账号已经存在","obj":null,"map":null,"list":null}';
				exit;	
			}
			
			
			$userinfo['create_time'] = date('y-m-d H:i:s',time());
			$userinfo['last_time'] = date('y-m-d H:i:s',time());
			$userinfo['end_time'] =C('reg_validdays')>0? time()+intval(C('reg_validdays'))*24*3600:0;
			$userinfo['createip_varchar'] = get_client_ip();
			$userinfo['lastip_varchar'] = get_client_ip();
			 
			$userinfo['headimg']='';
			$userinfo['xd'] = C('xd');
			$userinfo['allow_nums'] = C('allow_nums')?intval(C('allow_nums')):0;
			$returnInfo=$User->add($userinfo);
			
			if($returnInfo)
			{
				 	session('userid',$returnInfo);
				session('username',$userinfo[$field]);
				session('email',$userinfo['email_varchar']);
				session('md5str',md5('adklsj[]999875sssee,'.$returnInfo));
				cookie('USERID',$userinfo['email_varchar']);
				cookie('MD5STR',md5('adklsj[]999875sssee,'.$returnInfo));
				header('HTTP/1.1 200 ok');
				//$userInfo_str='"id":"'.$returnInfo.'","loginName":"'.$userinfo[$field].'","type":1,"status":1,"name":"'.$userinfo[$field].'","email":"'.$userinfo['email_varchar'].'","regTime":1426860543533,"roleIdList":null';
				$userinfo['status_int']=1;
				$userInfo_str=getUsreJsonStr($userinfo);
				
				echo '{"success":true,"code":200,"msg":"操作成功","obj":{'.$userInfo_str.'},"map":null,"list":null}';
				
			}
			else
			{
				//header('HTTP/1.1 401 Unauthorized');
				echo json_encode(array("success" => false,"code"=> 1006,"msg" => "帐号重复","obj"=> null,"map"=> array("isValidateCodeLogin"=>false),"list"=> null));
				
			}
		}
    }
	  public function retrieve(){
        $datas = $_POST;
        $user=M('users');
       // $geetest = D('Geetest');
        $where['email_varchar']=$datas['email'];
       // $geetest->set_privatekey("4cd7b256aa9fb2c493a68c8ab85ffb14");
        $users=$user->where($where)->select();   
    if ($users[0]['email_varchar']=$where['email_varchar']) {
        $name=$users[0]['email_varchar'];
        $Token=md5($where['email_varchar'].time());
        $time['token_exptime'] = time()+60*60*24;
        $time['token']=$Token;
        $url=C('SITE_INFO.url');
    $mb=<<<hoa
          <p>Hi，$name ：<br  />
你申请的找回密码成功，请点击下面的链接，根据页面提示完成密码重置：<br  />
$url#/home/reset?resetToken=$Token   </p>
<p>如果链接无法点击，请完整拷贝到浏览器地址栏里直接访问。有效期24小时</p>
<p>（这是一封自动发送的邮件，请不要直接回复）</p>
<p><br  />
 </p>
hoa;
		if(SendMail($name,"找回密码",$mb)){
				 $user->where($where)->save($time);
			 echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
			
		}else{ 
			echo '{"success":false,"code":1005,"msg":"邮件配置错误","obj":null,"map":null,"list":null}';exit;
			}

	 }else{
	   echo '{"success":false,"code":1003,"msg":"邮件不在在","obj":null,"map":null,"list":null}';
	 }
   
 }  

	public function reset(){
		$datas = $_POST;
		$user=M('users');
		$Token['token']=$datas['key'];
		$yz=$user->where($Token)->select(); 
		$newPwd=md5($datas['newPwd']);
		if($yz){
			if(time()>$yz[0]['token_exptime']){
				echo '{"success":false,"code":1011,"msg":"该链接已失效!","obj":null,"map":null,"list":null}';  
			}else{
				$nwspw['password_varchar'] =$newPwd;
				if(!empty($datas['newPwd'])){
					$user->where($Token)->save($nwspw);
					echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
				}else{
					echo '{"success":false,"code":1011,"msg":"密码不能为空哦","obj":null,"map":null,"list":null}';  
				}

			}
		}else{
			echo '{"success":false,"code":1011,"msg":"验证错误","obj":null,"map":null,"list":null}'; 
		}
		
	}    
	public function save(){
		$this->unlogin();
		$_user=M('users');
		$datas = $_POST;
		$where['userid_int'] = session('userid');
		$returnInfo=$_user->where($where)->find();
		//echo $datas['headImg'];
		if(isset($datas['name'])){
			$datainfo['uname'] = $datas['name'];
			$datainfo['headimg'] = $datas['headImg'];
			$datainfo['phone'] = $datas['phone'];
			$datainfo['tel'] = $datas['tel'];
			$datainfo['qq'] = $datas['qq'];
			$datainfo['sex'] = $datas['sex'];
			//echo 'sex-'.$datas['sex'];
		}else{			
			$datainfo['uname'] = $returnInfo['uname'];
			$datainfo['headimg'] = $datas['headImg'];
			$datainfo['phone'] = $returnInfo['phone'];
			$datainfo['tel'] = $returnInfo['tel'];
			$datainfo['qq'] = $returnInfo['qq'];
			$datainfo['sex'] = $returnInfo['sex'];
			//echo 'name-null';
		}
		$_user->data($datainfo)->where($where)->save();				
		//$userInfo_str='"id":"'.session("userid").'","loginName":"'.$returnInfo['email_varchar'].'","xd":'.$returnInfo['xd'].',"sex":'.($datainfo['sex']==''?'0':$datainfo['sex']).',"phone":'.($datainfo['phone']==''?'""':'"'.$datainfo['phone'].'"').',"tel":'.($datainfo['tel']==''?'""':'"'.$datainfo['tel'].'"').',"qq":'.($datainfo['qq']==''?'""':'"'.$datainfo['qq'].'"').',"headImg":"'.$datainfo['headimg'].'","idNum":null,"idPhoto":null,"regTime":null,"extType":0,"property":null,"companyId":null,"deptName":null,"deptId":0,"name":'.($datainfo['uname']==''?'""':'"'.$datainfo['uname'].'"').',"email":"'.$returnInfo['email_varchar'].'","type":'.$returnInfo['type'].',"status":'.$returnInfo['status_int'].',"relType":null,"companyTplId":null,"roleIdList":[]';
		
		$userInfo_str=getUsreJsonStr($returnInfo);
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":{'.$userInfo_str.'},"map":null,"list":null}';
		echo $jsonstr;
	}
	
	public function changePwd(){
		$this->unlogin();
		$_user=M('users');
		$datas = $_POST;
		$where['userid_int'] = session('userid');
		$returnInfo=$_user->where($where)->find();
		$password_varchar = md5($datas['oldPwd']);
		$datainfo['password_varchar'] = md5($datas['newPwd']);
		if($returnInfo['password_varchar']==$password_varchar){
			$_user->data($datainfo)->where($where)->save();
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
		}else{
			echo '{"success":false,"code":1004,"msg":"旧密码不正确","obj":null,"map":null,"list":null}';
		}
		
	}
	
	public function giveXd(){
		$this->unlogin();
		$_user=M('users');
		$tousername = I('post.toUser','yy');
        $xdCount = I('post.xdCount',0);
		$opttime = I('get.time',0);
		$where['userid_int'] = session('userid');
		$where2['email_varchar'] = $tousername;			
		$returnInfo=$_user->where($where)->find();
		$returnInfo2=$_user->where($where2)->find();
		$datainfo['xd'] = $returnInfo['xd']-$xdCount;
		$datainfo2['xd'] = $returnInfo2['xd']+$xdCount;  
		if(!$returnInfo||$datainfo['xd']<0){
			echo '{"success":false,"code":1010,"msg":"秀点不足","obj":null,"map":null,"list":null}';
		}elseif(is_array($returnInfo2)){
			$_user->data($datainfo)->where($where)->save();
			$_user->data($datainfo2)->where($where2)->save();		
			$_xdlog = M(xdlog);
			$loginfo['userid_int'] = session('userid');
			$loginfo['biztitle'] = "转送";
			$loginfo['biztype'] = 1;
			$loginfo['opttime'] = $opttime;
			$loginfo['xd'] = $xdCount;
			$loginfo['remark'] = "为".$tousername."成功转送".$xdCount."个秀点！";	 
			$id = $_xdlog->data($loginfo)->add();  	
			$loginfo2['userid_int'] = $returnInfo2['userid_int'];
			$loginfo2['biztitle'] = "获得";
			$loginfo2['biztype'] = 2;
			$loginfo2['opttime'] = $opttime;
			$loginfo2['xd'] = $xdCount;
			$loginfo2['remark'] = "成功获取".$returnInfo['uname']."转送的".$xdCount."个秀点！";
			$_xdlog->data($loginfo2)->add();
			$_xdlogcount=$_xdlog->where($loginfo)->count();
			
			echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$_xdlogcount.',"pageNo":1,"pageSize":10},"list":[{"id":"'.$id.'","bizTitle":"转送","bizType":1,"optTime":'.$opttime.',"sceneId":null,"remark":"'.$loginfo['remark'].'","xd":'.$xdCount.'}]}';
		}elseif($returnInfo2['userid_int'] == session('userid')){
			echo '{"success":false,"code":1010,"msg":"不能给自己转送","obj":null,"map":null,"list":null}';
		}else{
			echo '{"success":false,"code":1010,"msg":"用户不存在","obj":null,"map":null,"list":null}';
		}
	}
	
	public function xdlog(){
		$this->unlogin();
		$_xdlog = M(xdlog);
		$loginfo['userid_int'] = session('userid');
		$_log_list=$_xdlog->where($loginfo)->page(I('get.pageNo',1),I('get.pageSize',10))->order("opttime desc")->select();
		 
		$_xdlogcount=$_xdlog->where($loginfo)->count();
		$jsonstr =  '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":'.$_xdlogcount.',"pageNo":'.I('get.pageNo',1).',"pageSize":'.I('get.pageSize',10).'},"list":[';
		$jsonstrtemp = '';
		foreach($_log_list as $vo)
        {
			$vo['xd']=intval($vo['xd']);
			$vo["sceneid"]=$vo["sceneid"]?intval($vo["sceneid"]) :0;
			$jsonstrtemp = $jsonstrtemp .'{"id":"'.$vo["id"].'","bizTitle":"'.$vo["biztitle"].'","bizType":'.$vo["biztype"].',"optTime":"'.date('Y-m-d H:i',$vo["opttime"]).'","sceneId":'.$vo["sceneid"].',"remark":'.json_encode($vo['remark']).',"xd":'.$vo['xd'].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		echo $jsonstr;
	}
	
	public function xdStat(){
		$_xdlog = M('xdlog');
		$where['userid_int']  = intval(session('userid'));
		$where['biztype']  = 1;
		$give=$_xdlog->where($where)->sum('xd');
		$where['biztype']  = 2;
		$add=$_xdlog->where($where)->sum('xd');
		$where['biztype']  = 3;
		$pay=$_xdlog->where($where)->sum('xd') ;
		$give=$give?$give:0;
		$pay=$pay?$pay:0;
		$add=$add?$add:0;
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"give":'.$give.',"pay":'.$pay.',"add":'.$add.'},"list":null}';
	}
	
	public function msgList(){
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":5,"pageNo":1,"pageSize":5},"list":[{"id":15381137,"type":2,"bizType":3,"toUser":"4a2d8af94b7cf1db014bc3e4ebd27856","toEmail":"minglangasp@qq.com","fromUser":"4a2d8af948fd5bc40148fdbfc6640018","sendTime":1427335605000,"title":"秀点火热发售","content":"秀点火热发售，一份200元（含200个秀点），移步易企秀微信公众号，回复［0326］即可购买","status":1,"ext":null,"roleIdList":null},{"id":10765343,"type":2,"bizType":3,"toUser":"4a2d8af94b7cf1db014bc3e4ebd27856","toEmail":"minglangasp@qq.com","fromUser":"4a2d8af948fd5bc40148fdbfc6640018","sendTime":1425549612000,"title":null,"content":"易企秀产品更新2015.3.5 祝元宵快乐 http://eqxiu.com/s/fq4ZBB","status":1,"ext":null,"roleIdList":null}]}';
	}
	public function lists(){
	  	
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"count":0,"pageNo":1,"pageSize":10},"list":[]}';	
	}
	
	
	public function saveMyTpl(){
		if(!defined('VIRIFY')){
			virifylocal();
		}
		$this->unlogin();
		$m_scenepage=M('scenepage');
		$datas = json_decode(file_get_contents("php://input"),true);

	 
		$myTplId = intval($datas['sceneId']);
		if(!$myTplId){
			$datatpl['userid_int'] = intval(session('userid'));
			$datatpl['type'] = 1;
			$myTplId=M('mytpl')->data($datatpl)->add();  
		}
		if($myTplId){
			
			$datainfo['pagecurrentnum_int'] = intval($datas['num']);
			$datainfo['content_text'] = json_encode($datas['elements']);
			
			$datainfo['properties_text'] =  'null';
			$datainfo['scenecode_varchar'] =  'U6040278S2';
			$datainfo['pagename_varchar'] =  $datas['name'] ;
			$datainfo['userid_int'] = intval(session('userid'));
			$datainfo['createtime_time'] = date('y-m-d H:i:s',time());
			$datainfo['sceneid_bigint'] = $myTplId;
			$datainfo['myTypl_id'] = $myTplId;		
			$m_scenepage->add($datainfo);
			$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":'.$myTplId.',"map":null,"list":null}';
 			
			
		}else{
 			$jsonStr='{"success":false,"code":100,"msg":"操作失败","obj":'.$myTplId.',"map":null,"list":null}';
			 
		}
		echo $jsonstr;
			
	}
	public function getMyTpl(){
		$this->unlogin();
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		
		$where['myTypl_id']= I('get.id',0);
		$where['userid_int']  = intval(session('userid'));
		$_scene_list= M('scenepage')->where($where)->order('pagecurrentnum_int asc')->select();
		
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			
			$replaceArray = json_decode($vo['content_text'],true);
			foreach($replaceArray as $key => $value){
				$replaceArray[$key]['sceneId'] = $where['myTypl_id'];
				$replaceArray[$key]['pageId'] = $vo['pageid_bigint'];
			}
			$replaceArray = json_encode($replaceArray);
			
			$jsonstrtemp = $jsonstrtemp .'{
			 "id": '.$vo["pageid_bigint"].',
            "sceneId": '.$where['myTypl_id'].',
            "name": '.json_encode($vo["scenename_varchar"]).', 
            "num": '.$vo["pagecurrentnum_int"].', 
            "properties": null, 
            "elements": '.$replaceArray.', 
            "scene": null
        },';
		}
		
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}
	// 2015-7-
	public function mytplbycate(){
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		
		$where['myTypl_id']= I('get.id',0);
		if(I('get.cateid',0)>0){
			$where['my_type_cate']= I('get.cateid',0);
		}
		$where['userid_int']  = intval(session('userid'));
		$_scene_list= M('scenepage')->where($where)->order('pagecurrentnum_int asc')->select();
		
		$jsonstrtemp = '';
		foreach($_scene_list as $vo){
			
			$replaceArray = json_decode($vo['content_text'],true);
			foreach($replaceArray as $key => $value){
				$replaceArray[$key]['sceneId'] = $where['myTypl_id'];
				$replaceArray[$key]['pageId'] = $vo['pageid_bigint'];
			}
			$replaceArray = json_encode($replaceArray);
			
			$jsonstrtemp = $jsonstrtemp .'{
			 "id": '.$vo["pageid_bigint"].',
            "sceneId": '.$where['myTypl_id'].',
            "name": '.json_encode($vo["scenename_varchar"]).', 
            "num": '.$vo["pagecurrentnum_int"].', 
            "properties": null, 
            "elements": '.$replaceArray.', 
            "scene": null
        },';
		}
		
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}   
	public function getMyTplCate(){
		$jsonstr='{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		
		$where['type']  ='mytpl_type';
		$_scene_list= M('cate')->where($where)->order('sort asc,id asc')->select();
		$jsonstrtemp = '{"id":0,"name":"全部","sort":1},';
		foreach($_scene_list as $vo){
			
			$jsonstrtemp = $jsonstrtemp .'{
				 "id": '.$vo['id'].',           
				"name": "'.$vo['title'].'", 
				"sort": '.$vo['sort'].'
				
			},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').']}';
		echo $jsonstr;
	}
	
	public function Alipay(){
		
		$this->display();
	}
 
	
	public function xd(){		
			$this->unlogin();
		$_info = M('users')->where("userid_int='".session('userid')."'")->select();
		$jsonStr='{"success":true,"code":200,"msg":"操作成功","obj":'.$_info[0][xd].',"map":"'.$_info[0]['phone'].'","list":null}';
        echo $jsonStr;
    }

    public function logout(){
		session('userid',null);
		session('username',null);
		session('email',null);
		session('md5str',null);
		cookie('USERID',null);
		cookie('MD5STR',null);
		header("Location: http://".$_SERVER['HTTP_HOST']."");
    }
	
	
	public function active(){
		$hash=I("get.hash","");
		if(empty($hash)){
			$this->error("激活码不存在");
		}
		$users_model=M("Users");
		$find_user=$users_model->where(array("user_activation_key"=>$hash))->find();
		
		if($find_user){
			$result=$users_model->where(array("user_activation_key"=>$hash))->save(array("user_activation_key"=>"","checkemail"=>1));
			
			if($result){
				$find_user['checkemail']=1;
				$_SESSION['user']=$find_user;
				$this->success("用户激活成功，正在登录中...",__ROOT__."/");
			}else{
				$this->error("用户激活失败!",U("user/login/index"));
			}
		}else{
			$this->error("用户激活失败，激活码无效！",U("user/login/index"));
		}
		
	}
	
			//发送邮件
	protected  function _send_to_active(){
		$site_url=$_SERVER['SERVER_NAME'];
		$option = M('Options')->where(array('option_name'=>'member_email_active'))->find();
		if(!$option){
			echo  '{"success":false,"code":1003,"msg":"网站未配置账号激活信息，请联系网站管理员","map":{"isValidateCodeLogin":false}}';
			//$this->error('网站未配置账号激活信息，请联系网站管理员');
		}
		$options = json_decode($option['option_value'], true);
		//邮件标题
		$title = $options['title'];
		$uid= $_SESSION['userid'];
		$username= $_SESSION['name'];
		$time = time();
	    $where['email_varchar']=$_SESSION['email'];
		$activekey=md5('jihuo'.$uid.time().uniqid());
		$users_model=M("Users");
		$result=$users_model->where(array("userid_int"=>$uid))->save(array("user_activation_key"=>$activekey));
		if(!$result){
			$this->error('激活码生成失败！');
		}
		//生成激活链接
		$url = C('site_url').'/index.php?c=user&a=active&hash='.$activekey;
		//邮件内容
		$template = $options['template'];
		$content = str_replace(array('http://#link#','#username#','搜虎精品社区','http://test.souho.net'), array($url,$username,C('site_name'),C('site_url')),$template);
		$send_result=sp_send_email($_GET['email'], $title, $content, $time);
		if($send_result['error']){
			echo  '{"success":false,"code":1003,"msg":"激活邮件发送失败，请尝试登录后，手动发送激活邮件！","map":{"isValidateCodeLogin":false}}';
			exit();
			//$this->error('激活邮件发送失败，请尝试登录后，手动发送激活邮件！');
		}
	}

	
	public function email(){
		$this -> unlogin();
    	$where['email_varchar']=$_POST['email'];
		$users_model=M("Users");
    	$result = $users_model->where($where)->count();
		if($result || $email_varchar<0 || $email_varchar<0){
			echo  '{"success":false,"code":1003,"msg":"邮箱已存在","map":{"isValidateCodeLogin":false}}';
			exit;
    	}
		$where2['email_varchar'] = $_SESSION['email'];
		$user = $users_model->where($where2)->find();
		if(md5($_POST['pass'])!=$user['password_varchar']){
			echo '{"success":false,"code":1004,"msg":"密码错误","obj":null,"map":null,"list":null}';
		}else{
			if (IS_POST){
				$data['email_varchar'] = $_POST['email'];
				$data["checkemail"] = 0;
				$yhxx = array_filter($yhxx);
				$users["userid_int"] = $_SESSION['userid'];
				$users_model -> where(array('userid_int' => $users["userid_int"])) -> save($data);
			}
				session('email',$_POST['email']);
				$this->_send_to_active();
				echo '{"success":true,"code":200,"msg":"激活邮件发送成功，请在24小时内验证你的邮箱","obj":null,"map":null,"list":null}';
		}
	}
	
	public	function forget_password(){
		if(IS_POST){
			$users_model=M("Users");
			$email=I("post.email");
			$find_user=$users_model->where(array("email_varchar"=>$email))->find();
			if($find_user){
				$datas = $_POST;
				$user=M('users');
				$where['email_varchar']=$email;
				$users=$user->where($where)->select();   
				$name=$users[0]['uname'];
				$Token=md5('findpassword'.$where['email_varchar'].time());
				$time['token_exptime'] = time()+60*60*24;
				$time['token']=$Token;
				$url=C('site_url');
				$title = '找回密码';
				$mb=<<<hoa
          <p>Hi，$name ：<br  />
你申请的找回密码成功，请点击下面的链接，根据页面提示完成密码重置：<br  />
$url/#/home/reset?resetToken=$Token   </p>
<p>如果链接无法点击，请完整拷贝到浏览器地址栏里直接访问。有效期24小时</p>
<p>（这是一封自动发送的邮件，请不要直接回复）</p>
<p><br  />
 </p>
hoa;
				$send_result=sp_send_email($email, $title, $mb);
				if($send_result['error']){
					echo  '{"success":false,"code":1003,"msg":"激活邮件发送失败，请尝试登录后，手动发送激活邮件！","map":{"isValidateCodeLogin":false}}';
				}
				$user->where($where)->save($time);
				echo '{"success":true,"code":200,"msg":"密码重置邮件发送成功","obj":null,"map":null,"list":null}';
			}else {
				echo '{"success":false,"code":1003,"msg":"账号不存在","obj":null,"map":null,"list":null}';			
			}
					
		}	

	}
	
	 public function reset_password(){
        $datas = $_POST;
        $user=M('users');
        $Token['token']=$datas['key'];
        $yz=$user->where($Token)->select(); 
        $newPwd=md5($datas['newPwd']);
        if($yz){
         if(time()>$yz[0]['token_exptime']){
             echo '{"success":false,"code":1011,"msg":"该链接已失效!","obj":null,"map":null,"list":null}';  
         }else{
         $nwspw['password_varchar'] =$newPwd;
          if(!empty($datas['newPwd'])){
            $user->where($Token)->save($nwspw);
            echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
          }else{
             echo '{"success":false,"code":1011,"msg":"密码不能为空哦","obj":null,"map":null,"list":null}';  
          }

                }
     }else{
        echo '{"success":false,"code":1011,"msg":"验证错误","obj":null,"map":null,"list":null}'; 
     }
     
	}   	
	
	public function markRead(){
		$ids = explode(',',I('get.ids'));
		$count = count($ids);
		for($i=0;$i<$count;$i++){
			$data['newid_int'] = $ids[$i];
			$data['userid_int'] = session('userid');
			M('message')->data($data)->add();
		}
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
	}
}