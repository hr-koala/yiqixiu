<?php
namespace Home\Controller;
use Think\Controller;
class PayController extends Controller {
    public function _initialize(){
		header("Content-type:text/html;charset=utf-8");
		import('Vendor.Alipay.alipayCore','','.php');
		import('Vendor.Alipay.alipayMd5','','.php');
		import('Vendor.Alipay.alipayNotify','','.php');
		import('Vendor.Alipay.alipaySubmit','','.php'); 		
    }
	public function test(){
		$alipay_config = C('alipay_config');
		print_r($_GET);
		print_r($alipay_config);		 
		
		//echo 'ddddd'.C('alipay_config.sign_type');	
		 
		//print_r($_GET);
	}
	
	public function index(){

		if(C("pay_type")==2){
			 header("Location: ".C('pay_taobaourl'));
		}else{
		
			$user_info = M('users')->where("userid_int='".session('userid')."'")->find();
			$goods_list=M('goods')->select();
			$this->assign('goods_list', $goods_list); 
			$this->assign('user_info', $user_info); 
			 $this->assign('action', ''); 
			
//			$this->assign('msg', '充值成功'); 
//			$this->assign('action', 'return_msg'); 
			$this->display();  
		}
	}
	//提交订单入口
    public function userspay(){
		if(session('userid')){
			
			$goodsInfo=M('goods')->where("id='".I('post.gid')."'")->find();
		 
			if($goodsInfo){
				
				$goods_price=$goodsInfo['price'];
				$data['user_id']		= session('userid'); //用户账号
				$data['user_name']  =session('username'); 
				$data['add_time']	= time(); //订单记录产生时间
				$data['goods_id']	= $goodsInfo["id"];
				$data['goods_name']	= $goodsInfo["goods_name"];
				$data['xd_value']	= $goodsInfo["xd_value"];
				$jfee = (float) $goods_price; //强制金额浮点数
				$data['order_amount']	= $total_fee = round($jfee, 2); //精确到小数点后两位
				$order_info = M('order_info');
				$result = $order_info->data($data)->add();
				if($result && is_numeric($result)){
					$codeno 	= date('Ymdhms').$result;
				

					$updata['order_sn']		= $jcode = 'US'.$codeno;
				
					$updata['pay_status'] 		= 0;	//未支付状态

					$upresult = $order_info->where(array('id'=>$result))->save($updata);
					if($upresult){
						$configs = array(
							'return_url'	=>'http://' . $_SERVER['HTTP_HOST'].'/respond.php',	//pay/usersurl服务器同步通知页面路径(必填) 
							//'notify_url'	=>'',	//服务器异步通知页面路径(必填)     
							'out_trade_no'	=>$updata['order_sn'],	//商户订单号(必填)
							'subject'		=>$goodsInfo['goods_name'],	//订单名称(必填)
							'total_fee'		=>$total_fee,	//付款金额(必填)
							'body'			=>'充值秀点('.$goodsInfo['xd_value'].'点)',	//订单描述
							'show_url'		=>'',	//商品展示地址
							);
						//调用支付宝接口
						\Think\Log::write('调用支付宝接口'."\n".var_export($configs,true)); 
						 
						$this->alipayapi($configs);
					}else{ //充值异常(序号)，请联系客服或管理员。
						$this->error('充值订单异常，订单号【'.$codeno.'】。');
					}
				}else{
					$this->error('充值订单异常，未生成订单。');
				}
			}else{
				$this->error('商品信息异常，未成生成订单。');
			}
    	}else{
			$this->error('登录状态异常，无法提交充值操作！');    		
    	}
    }
	
	//alipay支付接口  //参数额外配置数组$configs
	public function alipayapi($configs){
		/****************************************************/
		//>>>>>>>>>>>>第一步
		//根据alipay源文件加载顺序依次加载配置
		$alipay_config = C('alipay_config');
		 

		/**************************请求参数配置**************************/
        //支付类型
        $payment_type = C('alipay.payment_type');
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C('alipay.notify_url');
         //卖家支付宝帐户
		$seller_email = C('seller_email');

        //必填
        //页面跳转同步通知页面路径
        $return_url = $configs['return_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		/****************************************************/
		//>>>>>>>>>>>>第二步
		//接收动态订单数据
        //商户订单号
        $out_trade_no = $configs['out_trade_no'];
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $configs['subject'];
        //必填

        //付款金额
        $total_fee = $configs['total_fee'];
        //必填

        //订单描述
        $body = $configs['body'];
        //商品展示地址
        $show_url = $configs['show_url'];
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

		$alipaySubmit = new \AlipaySubmit($alipay_config);
        //防钓鱼时间戳
        $anti_phishing_key = '';//$alipaySubmit->query_timestamp();
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
		$exter_invoke_ip = get_client_ip();//get_client_ip();   //Thinkphp3.2 系统集成的获取客户端ip方法
        //非局域网的外网IP地址，如：221.0.0.1
		/************************************************************/
		//>>>>>>>>>>>>第三步
		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service" => "create_direct_pay_by_user",  //  trade_create_by_buyer 双功能  create_partner_trade_by_buyer
			"partner" => trim(C('ali_partner')),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);

		//建立请求
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		
		\Think\Log::write('$html_text'."\n".$html_text); 
		echo $html_text;
	}

	public function usersurl(){
		//计算得出通知验证结果
		$alipay_config = C('alipay_config');   //必须

		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		$msg='';
		
		if($verify_result) {//验证成功
			\Think\Log::write('notifyurl:验证成功'."\n".var_export($_GET,true)); 			
			//请在这里加上商户的业务逻辑程序代码
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
			//商户订单号
			$out_trade_no = $_GET['out_trade_no'];

			//支付宝交易号
			$trade_no = $_GET['trade_no'];

			//交易状态
			$trade_status = $_GET['trade_status'];

		    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				$order_info = M('order_info');
				$curinfo = $order_info->where(array('order_sn'=>$out_trade_no))->find();
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序
				if($curinfo['pay_status'] == 0){ //0未支付状态
					$msg='充值异常(01)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）';			
				}
				if($curinfo['pay_status'] == 1){
					$msg= '充值成功！';
				}
		    }
		    else {
				//echo "trade_status=".$_GET['trade_status'];
				$msg='非法状态！';
		    }
		 
		}
		else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		  $msg= "无法接收通知！（身份验证失败，可能是客服端网络异常）";
		}
		$this->assign('action', 'return_msg'); 
		$this->assign('msg', $msg); 
	    $this->display('index');  
	}

	public function notifyurl(){
		//计算得出通知验证结果
		$alipay_config = C('alipay_config');	//必须

		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		if($verify_result) {//验证成功			
			//请在这里加上商户的业务逻辑程序代
			
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			
			//商户订单号

			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号

			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];

     		\Think\Log::write('notifyurl:验证成功'."\n".var_export($_POST,true)); 
		if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') { //
				
				//该种交易状态只在两种情况下出现
				//1、开通了普通即时到账，买家付款成功后。
				//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。
			$curinfo = M('order_info')->where(array('order_sn'=>$out_trade_no))->find();
			 
				if($curinfo['pay_status'] == 0){  
					$goodsInfo=M("goods")->where("id='".$curinfo["goods_id"]."'")->find();
					$xd_value=$goodsInfo["xd_value"];			
				    M("users")->where("userid_int=".$curinfo["user_id"])->setInc('xd',$xd_value);
					
					\Think\Log::write(D('')->getLastSql()."\n");
					 M('order_info')->where(array('order_sn'=>$out_trade_no))->save(array(
					  "pay_status"=>1,
						"order_status"=>1,
					  "pay_time" =>time()
					 ));
					$adddata=array('userid_int'=>$curinfo["user_id"],
						'sceneid'=>0,
						'remark'=>$other_arr['name']. '购买秀点（商品【'.$goodsInfo["goods_name"].'】）',
						'opttime'=>time(),
						'xd'=>$xd_value,
						'biztype'=>1,
						'biztitle'=>'购买秀点'
						);
					
					M('xdlog')->add($adddata);
					 
					 
					 \Think\Log::write(D('')->getLastSql()."\n");
				}
		        
		    }
		   
         
			echo "success";		//请不要修改或删除
	 
		}
		else {
		    //验证失败
		    echo "fail";
			\Think\Log::write('notifyurl:验证失败'."\n".var_export($_POST,true)); 
		   
		}
	}
}