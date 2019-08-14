<?php
namespace Home\Controller;
use Think\Controller;
 class PayController extends Controller{
	public function unlogin() {
		if (intval(session('userid')) == 0) {
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo '您还没有登录，请登录！';
			exit ;
		}
	}
	public function _initialize() {
		header('Content-type: application/json;charset=UTF-8');
		if (intval(session('userid')) != 100) {
			$wheresessionuser["userid_int"] = intval(session('userid'));

		}
	}

   public function Alipay(){  
        $this -> unlogin();
       $pay['qq']=C('pay_qq');
		$pay['pay_name']= 2 ;//C('pay_name');
       $pay['taobaourl']=C('pay_taobaourl');
       if($pay['pay_name']==1){
           header("Location: ".$pay['taobaourl']);
       }else{
          $this->assign("pay",$pay);
         $this->display();   
       }

        }

	public function setconfig()
	{
		$alipay_config['partner'] = trim($this->alipayConfig['pid']);
		$alipay_config['key'] = trim($this->alipayConfig['key']);
		$alipay_config['sign_type'] = strtoupper('MD5');
		$alipay_config['input_charset'] = strtolower('utf-8');
		$alipay_config['cacert'] = getcwd() . '\\ThinkPHP\\Library\\Alipay\\cacert.pem';
		$alipay_config['transport'] = 'http';
		return $alipay_config;
	}
	public function return_url ()
	{
		import("@.ORG.Alipay.AlipayNotify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();
		if ($verify_result)
		{
			$out_trade_no = $this->_get('out_trade_no');
			$trade_no = $this->_get('trade_no');
			$trade_status = $this->_get('trade_status');
			if ($this->_get('trade_status') == 'TRADE_FINISHED' || $this->_get('trade_status') == 'TRADE_SUCCESS')
			{
				$product_cart_model = M('product_cart');
				$order = $product_cart_model->where(array('orderid' => $out_trade_no))->find();
				if (!$this->wecha_id)
				{
					$this->wecha_id = $order['wecha_id'];
				}
				$sepOrder = 0;
				if (!$order)
				{
					$order = $product_cart_model->where(array('id' => $out_trade_no))->find();
					$sepOrder = 1;
				}
				if ($order)
				{
					if ($order['paid'] == 1)
					{
						exit('该订单已经支付,请勿重复操作');
					}
					if (!$sepOrder)
					{
						$product_cart_model->where(array('orderid' => $out_trade_no))->setField('paid', 1);
					}
					else
					{
						$product_cart_model->where(array('id' => $out_trade_no))->setField('paid', 1);
					}
					$member_card_create_db = M('Member_card_create');
					$userCard = $member_card_create_db->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
					$member_card_set_db = M('Member_card_set');
					$thisCard = $member_card_set_db->where(array('id' => intval($userCard['cardid'])))->find();
					$set_exchange = M('Member_card_exchange')->where(array('cardid' => intval($thisCard['id'])))->find();
					$arr['token'] = $this->token;
					$arr['wecha_id'] = $this->wecha_id;
					$arr['expense'] = $order['price'];
					$arr['time'] = time();
					$arr['cat'] = 99;
					$arr['staffid'] = 0;
					$arr['score'] = intval($set_exchange['reward']) * $order['price'];
					M('Member_card_use_record')->add($arr);
					$userinfo_db = M('Userinfo');
					$thisUser = $userinfo_db->where(array('token' => $thisCard['token'], 'wecha_id' => $arr['wecha_id']))->find();
					$userArr = array();
					$userArr['total_score'] = $thisUser['total_score'] + $arr['score'];
					$userArr['expensetotal'] = $thisUser['expensetotal'] + $arr['expense'];
					$userinfo_db->where(array('token' => $thisCard['token'], 'wecha_id' => $arr['wecha_id']))->save($userArr);
					$this->redirect(U('Product/my', array('token' => $order['token'], 'wecha_id' => $order['wecha_id'], 'success' => 1)));
				}
				else
				{
					exit('订单不存在：' . $out_trade_no);
				}
			}
			else
			{
				exit('付款失败');
			}
		}
		else
		{
			exit('不存在的订单');
		}
	}
	public function notify_url()
	{
		echo "success";
		eixt();
	}
        
        
}