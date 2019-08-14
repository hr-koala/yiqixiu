<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");
class SjController extends Controller {
    
    
        public function check(){
		if(intval(session('userid'))>0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			cookie('USERID',session('userid'));
			cookie('MD5STR',session('md5str'));
			$property='null';
			$mytplid=M('mytpl')->where('userid_int='.session('userid'))->getField('id');
 			if($mytplid){
				$property='{\"myTplId\":'.$mytplid.'}';
 			}
			$userInfoStr='"id":"'.session('userid').'","loginName":"'.session('username').'","xd":0,"sex":1,"phone":null,"tel":null,"qq":null,"headImg":"'.session('headImg').'","idNum":null,"idPhoto":null,"regTime":1425093623000,"extType":0,"property":"'.$property.'","companyId":null,"deptName":null,"deptId":0,"name":"'.session('username').'","email":null,"type":1,"status":0,"relType":null,"companyTplId":null,"roleIdList":[]';
			$jsonStr='{"success":true,"code":200,"msg":"操作成功","obj":{'.$userInfoStr.'},"map":null,"list":null}';
			echo $jsonStr;
		}
		else
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
		}
    }
    
       public function login(){
		if (IS_POST && intval(session('userid'))==0) {
			$datas = $_POST;
			$password_varchar = md5($datas['password']);
			$userinfo['email_varchar'] = $datas['username'];
			$userinfo['status_int'] = 1;
			$User = M('users');
			$returnInfo=$User->where($userinfo)->find();
		 	
			if($returnInfo){
				if($returnInfo['password_varchar']==$password_varchar){
					
					if($returnInfo['end_time']  && $returnInfo['end_time'] <time()){ 
							
						echo  '{"success":false,"code":1004,"msg":"您的账号已过期，请与管理员联系","map":{"isValidateCodeLogin":false}}';
						
					}else{
						
						session('userid',$returnInfo["userid_int"]);
                        session('headImg',$returnInfo["headimg"]);
						session('username',$returnInfo["email_varchar"]);
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
		}
    }

	
    public function register(){	 
		if (IS_POST) {
            session(null);
			$datas = $_POST;
            $User = M('users');
			$userinfo['password_varchar'] = md5($datas['password']);
			$userinfo['email_varchar'] = $datas['email'];
            $arr = explode("@",$datas['email']);
            $userinfo['uname'] = $arr[0];
			$userinfo['end_time'] =C('reg_validdays')>0? time()+intval(C('reg_validdays'))*24*3600:0;
			$userinfo['create_time'] = date('y-m-d H:i:s',time());
			$userinfo['last_time'] = date('y-m-d H:i:s',time());
			$userinfo['createip_varchar'] = get_client_ip();
			$userinfo['lastip_varchar'] = get_client_ip();
            $where['email_varchar']= $datas['email'];
            $users=$User->where($where)->find();
			//$returnInfo=$User->add($userinfo);
			if(empty($users))
			{
              $returnInfo =  $User->add($userinfo);
 			 
                Cookie(array('JSESSIONID'=>md5($userinfo['userid_int']),'domain'=>'.g.com','path'=>'/'));
				cookie('MD5STR',md5('adklsj[]999875sssee,'.$returnInfo));
				header('HTTP/1.1 200 ok');
				echo '{"success":true,"code":200,"msg":"操作成功","obj":{"id":"'.$returnInfo.'","loginName":"'.$userinfo['email_varchar'].'","type":1,"status":1,"name":"'.$userinfo['email_varchar'].'","email":"'.$userinfo['email_varchar'].'","regTime":1426860543533,"roleIdList":null},"map":null,"list":null}';
               
				
			}
			else
			{
 
				echo '{"success":false,"code":1006,"msg":"重复注册","obj":null,"map":null,"list":null}';
                
				
			}
		}
    }
    
    public function promotion() {
     
		$jsonstr = '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[';
		$_scene = M('scene');
		$where['delete_int'] = 0;
		$where['is_tpl']  =0;
		$where['applyPromotion']  = 2;
		$pageshowsize = I('get.pageSize', 6);
		if ($pageshowsize > 10) {
			$pageshowsize = 10;
		} 
		$_scene_list = $_scene -> where($where) -> order('rank desc,sceneid_bigint desc') -> page(I('get.pageNo', 1), $pageshowsize) -> select();
		$jsonstrtemp = '';
		foreach ($_scene_list as $vo) {
	$jsonstrtemp = $jsonstrtemp . '{"id": ' . $vo["sceneid_bigint"] . ',"name": ' . json_encode($vo["scenename_varchar"]) . ',
            "createUser": "' . $vo['userid_int'] . '","createTime": 1423645519000,"type": ' . $vo["scenetype_int"] . ',    "pageMode": ' . $vo["movietype_int"] . ',"image": {"bgAudio": {"url": "' . $vo["musicurl_varchar"] . '","type": "' . $vo["musictype_int"] . '"},"imgSrc": "' . $vo["thumbnail_varchar"] . '", "hideEqAd": false, "isAdvancedUser": false},
            "isTpl": 0,"isPromotion": 0,"status": ' . $vo['showstatus_int'] . ',"createTime": 423645519000,            
            "code": "' . $vo["scenecode_varchar"] . '",     
            "sort": 0,"pageCount": 0,"dataCount": 0,"showCount": ' . $vo["hitcount_int"] . ',"userLoginName": null,           "userName":null
        },';
		}

		$jsonstr = $jsonstr . rtrim($jsonstrtemp,',') . ']}';
		echo $jsonstr;
	}
 
}