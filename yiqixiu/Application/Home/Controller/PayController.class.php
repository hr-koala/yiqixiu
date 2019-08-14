<?php
namespace Home\Controller;

use Think\Controller;

class PayController extends Controller
{
	public function _initialize()
	{
		header("Content-type:text/html;charset=utf-8");
		import('Vendor.Alipay.alipayCore', '', '.php');
		import('Vendor.Alipay.alipayMd5', '', '.php');
		import('Vendor.Alipay.alipayNotify', '', '.php');
		import('Vendor.Alipay.alipaySubmit', '', '.php');
	}

	public function test()
	{
		$alipay_config = C('alipay_config');
		print_r($_GET);
		print_r($alipay_config);
	}

	public function index()
	{
		if (C("pay_type") == 2) {
			header("Location: " . C('pay_taobaourl'));
		} else {
			$user_info = M('users')->where("userid_int='" . session('userid') . "'")->find();
			$goods_list = M('goods')->select();
			$this->assign('goods_list', $goods_list);
			$this->assign('user_info', $user_info);
			$this->assign('action', '');
			$this->display();
		}
	}

	public function userspay()
	{
		if (session('userid')) {
			$goodsInfo = M('goods')->where("id='" . I('post.gid') . "'")->find();
			if ($goodsInfo) {
				$goods_price = $goodsInfo['price'];
				$data['user_id'] = session('userid');
				$data['user_name'] = session('username');
				$data['add_time'] = time();
				$data['goods_id'] = $goodsInfo["id"];
				$data['goods_name'] = $goodsInfo["goods_name"];
				$data['xd_value'] = $goodsInfo["xd_value"];
				$jfee = (float)$goods_price;
				$data['order_amount'] = $total_fee = round($jfee, 2);
				$order_info = M('order_info');
				$result = $order_info->data($data)->add();
				if ($result && is_numeric($result)) {
					$codeno = date('Ymdhms') . $result;
					$updata['order_sn'] = $jcode = 'US' . $codeno;
					$updata['pay_status'] = 0;
					$upresult = $order_info->where(array('id' => $result))->save($updata);
					if ($upresult) {
						$configs = array('return_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/respond.php', 'out_trade_no' => $updata['order_sn'], 'subject' => $goodsInfo['goods_name'], 'total_fee' => $total_fee, 'body' => '充值秀点(' . $goodsInfo['xd_value'] . '点)', 'show_url' => '',);
						\Think\Log::write('调用支付宝接口' . '
' . var_export($configs, true));
						if (C('ali_service') == 'create_partner_trade_by_buyer') {
							$this->alipayapi3($configs);
						} else {
							$this->alipayapi($configs);
						}
					} else {
						$this->error('充值订单异常，订单号【' . $codeno . '】。');
					}
				} else {
					$this->error('充值订单异常，未生成订单。');
				}
			} else {
				$this->error('商品信息异常，未成生成订单。');
			}
		} else {
			$this->error('登录状态异常，无法提交充值操作！');
		}
	}

	public function alipayapi($configs)
	{
		$alipay_config = C('alipay_config');
		$payment_type = C('alipay.payment_type');
		$notify_url = C('alipay.notify_url');
		$seller_email = C('seller_email');
		$return_url = $configs['return_url'];
		$out_trade_no = $configs['out_trade_no'];
		$subject = $configs['subject'];
		$total_fee = $configs['total_fee'];
		$body = $configs['body'];
		$show_url = $configs['show_url'];
		$alipaySubmit = new \AlipaySubmit($alipay_config);
		$anti_phishing_key = '';
		$exter_invoke_ip = get_client_ip();
		$parameter = array("service" => "create_direct_pay_by_user", "partner" => trim(C('ali_partner')), "payment_type" => $payment_type, "notify_url" => $notify_url, "return_url" => $return_url, "seller_email" => $seller_email, "out_trade_no" => $out_trade_no, "subject" => $subject, "total_fee" => $total_fee, "body" => $body, "show_url" => $show_url, "anti_phishing_key" => $anti_phishing_key, "exter_invoke_ip" => $exter_invoke_ip, "_input_charset" => trim(strtolower($alipay_config['input_charset'])));
		$html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
		\Think\Log::write('$html_text' . '
' . $html_text);
		echo $html_text;
	}

	public function alipayapi3($configs)
	{
		$alipay_config = C('alipay_config');
		$payment_type = C('alipay.payment_type');
		$notify_url = C('alipay.notify_url');
		$seller_email = C('seller_email');
		$return_url = $configs['return_url'];
		$out_trade_no = $configs['out_trade_no'];
		$subject = $configs['subject'];
		$price = $configs['total_fee'];
		$quantity = "1";
		$logistics_fee = "0.00";
		$logistics_type = "EXPRESS";
		$logistics_payment = "SELLER_PAY";
		$body = $configs['body'];
		$show_url = $configs['show_url'];
		$receive_name = session("username") ? session("username") : '';
		$receive_address = '';
		$receive_zip = '';
		$receive_phone = session("phone") ? session("phone") : '';
		$receive_mobile = session("phone") ? session("phone") : '';
		$alipaySubmit = new \AlipaySubmit($alipay_config);
		$parameter = array("service" => "create_partner_trade_by_buyer", "partner" => trim($alipay_config['partner']), "payment_type" => $payment_type, "notify_url" => $notify_url, "return_url" => $return_url, "seller_email" => $seller_email, "out_trade_no" => $out_trade_no, "subject" => $subject, "price" => $price, "quantity" => $quantity, "logistics_fee" => $logistics_fee, "logistics_type" => $logistics_type, "logistics_payment" => $logistics_payment, "body" => $body, "show_url" => $show_url, "receive_name" => $receive_name, "receive_address" => $receive_address, "receive_zip" => $receive_zip, "receive_phone" => $receive_phone, "receive_mobile" => $receive_mobile, "_input_charset" => trim(strtolower($alipay_config['input_charset'])));
		$html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
		\Think\Log::write('$html_text' . '
' . $html_text);
		echo $html_text;
	}

	public function usersurl()
	{
		$alipay_config = C('alipay_config');
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		$msg = '';
		if ($verify_result) {
			\Think\Log::write('usersurl:验证成功' . "\n" . var_export($_GET, true));
			$out_trade_no = $_GET['out_trade_no'];
			$trade_no = $_GET['trade_no'];
			$trade_status = $_GET['trade_status'];
			if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
			} elseif ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				$order_info = M('order_info');
				$curinfo = $order_info->where(array('order_sn' => $out_trade_no))->find();
				if ($curinfo['pay_status'] == 0) {
					$msg = '充值异常(01)，请联系客服或管理员。（需提供当前订单号【' . $out_trade_no . '】和支付宝交易号【' . $trade_no . '】）';
				}
				if ($curinfo['pay_status'] == 1) {
					$msg = '充值成功！';
				}
			} else {
				$msg = '非法状态！';
			}
		} else {
			$msg = "无法接收通知！（身份验证失败，可能是客服端网络异常）";
		}
		$this->assign('action', 'return_msg');
		$this->assign('msg', $msg);
		$this->display('index');
	}

	public function notifyurl()
	{
		$alipay_config = C('alipay_config');
		$alipayNotify = new \AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
		if ($verify_result) {
			$out_trade_no = $_POST['out_trade_no'];
			$trade_no = $_POST['trade_no'];
			$trade_status = $_POST['trade_status'];
			\Think\Log::write('notifyurl:验证成功' . '
' . var_export($_POST, true));
			if ($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
				echo "success";
			} else if ($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				$this->deal_trade_ok($out_trade_no);
				echo 'success';
			} else if ($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				echo "success";
			} elseif ($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
				$this->deal_trade_ok($out_trade_no);
			}
			echo 'success';
		} else {
			echo 'fail';
			\Think\Log::write('notifyurl:验证失败' . '
' . var_export($_POST, true));
		}
	}

	function deal_trade_ok($out_trade_no)
	{
		$curinfo = M('order_info')->where(array('order_sn' => $out_trade_no))->find();
		if ($curinfo['pay_status'] == 0) {
			$goodsInfo = M("goods")->where("id='" . $curinfo["goods_id"] . "'")->find();
			$xd_value = $goodsInfo["xd_value"];
			M('users')->where('userid_int=\'' . $curinfo["user_id"] . "'")->setInc('xd', $xd_value);
			\Think\Log::write(D('')->getLastSql() . '
');
			M('order_info')->where(array('order_sn' => $out_trade_no))->save(array("pay_status" => 1, "order_status" => 1, "pay_time" => time()));
			$adddata = array('userid_int' => $curinfo["user_id"], 'sceneid' => 0, 'remark' => $other_arr['name'] . '购买秀点（商品【' . $goodsInfo["goods_name"] . '】）', 'opttime' => time(), 'xd' => $xd_value, 'biztype' => 1, 'biztitle' => '购买秀点');
			M('xdlog')->add($adddata);
			\Think\Log::write(D('')->getLastSql() . '
');
		}
	}
}