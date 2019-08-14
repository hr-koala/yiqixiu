<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
/**
 * 支付基类
 * 集成支付：微信、财付通、支付宝、网银、PayPal
 */
ini_set('date.timezone','Asia/Shanghai');
load::sys_class('web');
load::sys_func('admin');
load::sys_func('str');
load::sys_func('array');
class pay extends web{
    public function __construct() {
        global $_M;
        //定义一些可以预定义的变量值
        parent::__construct();
        
    }
    
    /**
     * 购物车订单提交入口
     */
    public function doindex(){
        global $_M;
		
        //$this->check();
        //获取订单参数
        $date['body']         = $_M['form']['body'];
        $date['subject']      = $_M['form']['subject'];
        $date['out_trade_no'] = $_M['form']['out_trade_no'];
        $date['attach']       = $_M['form']['attach'];
        $date['goods_tag']    = $_M['form']['goods_tag'];
        $date['product_id']   = $_M['form']['product_id'];
        $date['total_fee']    = $_M['form']['total_fee'];
        $date['no']           = $_M['form']['no']?$_M['form']['no']:'1111111111';
        if($date['out_trade_no'] && $date['total_fee'] && $date['subject']) {
            $this->CreateOrder($date);                                          //创建账单 存储订单信息到数据库
            $title = '选择在线支付方式';
            $paymentlist = $this->GetPaymentList();                             //获取处于开启状态的支付接口
            require_once $this->template('own/index');
        }else{
            echo "<script type=\"text/javascript\">alert(\"订单参数异常！请重新下单\");location.href=\"{$_M['url']['site']}member\"</script>";
        }
		
    }
    /**
     * 订单支付跳转
     */
    public function dopay() {
        global $_M;
        $out_trade_no = $_M['form']['out_trade_no'];
        $type         = $_M['form']['paytype']?$_M['form']['paytype']:(empty($_GET["code"])?'':'6');
        $date         = $this->GetOeder($out_trade_no);
        $status       = $this->CheckOrderPayStatus($out_trade_no);
        $paymentlist  = $this->GetPaymentList();                                //获取处于开启状态的支付接口
        if(!$this->GetPayOpen()) {
            //获取接口开关状态，关闭时直接跳转至网站首页
            echo "<script type=\"text/javascript\">alert(\"未开启支付接口，请联系网站管理员。\");location.href=\"{$_M['url']['site']}\"</script>"; 
            //header("Location:{$_M['url']['site']}member");
        } else if(!$out_trade_no && $type != '6') {
            echo "<script type=\"text/javascript\">alert(\"订单异常，请重新下单支付！\");location.href=\"{$_M['url']['site']}member\"</script>"; 
            //header("Location:{$_M['url']['site']}member");
        } else if(!$status && in_array($type, $paymentlist)) {                  //检测订单支付状态，并检测传入支付方式开启状态
            $this->UpadteOrderPaymentType($type, $out_trade_no);                //更新订单支付类型
            switch ($type) {
                case 1://微信扫码支付
                    $wxpay     = load::mod_class('pay/wxpay.class.php', 'new'); //加载微信支付处理类
                    $code_url  = $wxpay->wxpay($date);                          //调用微信支付接口
                    require_once $this->template('own/wxpay');
                    break;
                case 2://财付通支付tenpay
                    $tenpay   = load::mod_class('pay/tenpay.class.php', 'new'); //加载财付通支付处理类
                    $code_url = $tenpay->tenpay($date);                         //调用财付通支付接口
                    break;
                case 3://支付宝支付
                    $alipay = load::mod_class('pay/alipay.class.php', 'new');   //加载支付宝支付处理类
                    $alipay->alipay($date);                                     //调用支付宝支付接口
                    break;
                case 4://网银支付
                    $unionpay = load::mod_class('pay/unionpay.class.php', 'new');  //加载银联支付处理类
                    $unionpay->unionpay($date);                                 //调用银联支付接口
                    break;
                case 5://PayPal支付
                    $paypal = load::mod_class('pay/paypal.class.php', 'new');   //加载银联支付处理类
                    $paypal->paypal($date);                                     //调用paypal支付接口
                    break;
                case 6://微信H5-JsApiPay支付
                    $wxpay     = load::mod_class('pay/wxpay.class.php', 'new'); //加载微信支付处理类
                    if($_GET['code']){
                        session_start();
                        $date           = $_SESSION["temp"];
                        $date['openId'] = $wxpay->GetOpen_ID();
                        $return         = $wxpay->JsApiPay($date);              //调用微信支付接口
                        require_once $this->template('own/jsapi');
                    }else{
                        //session 存储订单信息，备用
                        session_start();
                        $_SESSION["temp"] = $date;
                        $wxpay->GetOpen_ID();
                    }
                    break;
                default:
                    break;
            }
        } else {
            echo "<script type=\"text/javascript\">alert(\"非法操作！\");location.href=\"{$_M['url']['site']}member\"</script>";
        }
    }
    
    /**
     * 订单查询
     */
    public function doquery() {
        global $_M;
        $pay_type = $_M['form']['paytype'];
        switch ($pay_type) {
            case 1://微信订单查询
                $wxpay  = load::mod_class('pay/wxpay.class.php', 'new');
                $pay    = $wxpay->wxpayQuery();
				echo json_encode($pay);
                break;
            case 2://财付通订单查询
                $pay = $this->tenpayQuery(); 
                break;
            case 3://支付宝订单查询
                $pay = $this->alipayQuery(); 
                break;
            case 4://网银订单查询
                $pay = $this->unionpayQuery(); 
                break;
            case 5://PayPal订单查询
                $pay = $this->paypalQuery(); 
                break;
            default:
                break;
        }
    }
    
    /**
     * 创建订单存储至数据库
     */
    public function CreateOrder($date) {
        global $_M;
        $order = $this->GetOeder($date['out_trade_no']);                        //根据订单号进行重复订单查询
        if(!$order&&is_arrempty($date)) {                                       //订单不存在且订单数据不为空时进行订单信息存储，并返回订单号
            $date['order_time']   = date("YmdHis");
            //$date['out_trade_no'] = $this->get_num_str();
            $query = "INSERT INTO {$_M['table']['pay_order']} SET no='{$date[no]}',callback_url='{$date[return_url]}',out_trade_no='{$date[out_trade_no]}',subject='{$date[subject]}',product_id='{$date[product_id]}',body='{$date[body]}',goods_tag='{$date[goods_tag]}',attach='{$date[attach]}',show_url='{$date[show_url]}',total_fee='{$date[total_fee]}',order_time='{$date[order_time]}',pay_time='',pay_type='',callback='0',status='0'";
            DB::query($query);
            return TRUE;
        }
    }
    /**
     * 异步通知 处理
     */
    public function donotify() {
        global $_M;
        //=======【微信异步通知验证】==========================
        $xml   = $GLOBALS['HTTP_RAW_POST_DATA'];
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        if($array && $array['out_trade_no']) {
            $date = $this->GetOeder($array['out_trade_no']);
            $this->doNotify_wxpay($date);
        }

        $out_trade_no = $_M['form']['out_trade_no']?$_M['form']['out_trade_no']:$_POST['orderId'];
        if($out_trade_no) {
            $date = $this->GetOeder($out_trade_no);
            //=======【支付宝异步通知验证】==========================
            if($date['pay_type'] === '3') {
                $this->doNotify_alipay($date);
            }
            //=======【银联异步通知验证】==========================
            if($date['pay_type'] === '4') {
                $this->doNotify_unionpay($date);
            }
        }
    }
    
    public function doNotify_wxpay($date) {
        $wxpay = load::mod_class('pay/wxpay.class.php', 'new');
        if($wxpay->donotify($date['out_trade_no'])) {                           //异步通知验证
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_alipay($date) {
        global $_M;
        $alipay = load::mod_class('pay/alipay.class.php', 'new');
        //异步通知验证
        if($alipay->donotify()&&!$date['status']&&($_M['form']['trade_status']==='TRADE_SUCCESS'||$_M['form']['trade_status']==='TRADE_FINISHED')) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    public function doNotify_unionpay($date) {
        $unionpay = load::mod_class('pay/unionpay.class.php', 'new');   //同步通知验证
        if($unionpay->donotify($date)) {
            $this->UpadteOrder($date['pay_type'],$date['out_trade_no']);
        }
    }
    /**
     * 同步通知 处理
     */
    public function doreturn() {
        global $_M;
        $out_trade_no = $_M['form']['out_trade_no']?$_M['form']['out_trade_no']:$_POST['orderId'];
        $date         = $this->GetOeder($out_trade_no);
        $title        = '订单支付成功';
        $this->UpadteOrderReturnType($out_trade_no);                            //接收到同步通知后根据订单号更改【同步通知】状态
        $return_url   = $date['callback_url']?$date['callback_url']:$this->template('own/return');          //获取自定义同步通知返回地址，为自定义则使用默认地址
        if($date['pay_type']==='1' || $date['pay_type']==='6') {
            $wxpay = load::mod_class('pay/wxpay.class.php', 'new');
            if($wxpay->OrderQuery($out_trade_no)) {
				if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }
        if($date['pay_type'] === '3' && $_M['form']['total_fee'] === $date['total_fee']) {
            $alipay = load::mod_class('pay/alipay.class.php', 'new');           //同步通知验证
            if($alipay->doreturn()&&($_GET['trade_status']==='TRADE_SUCCESS'||$_GET['trade_status']==='TRADE_FINISHED')) {
				if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }
        if($date['pay_type']==='4') {
            $unionpay = load::mod_class('pay/unionpay.class.php', 'new');       //同步通知验证
            if($unionpay->donotify($date)) {
                if($date['callback_url']){
					header("Location: {$date['callback_url']}");
					die();
				}else{
					require_once $return_url;
				}
            }
        }
    }
    /**
     * 根据订单号out_trade_no更新订单【支付状态】
     */
    public function UpadteOrder($pay_type,$out_trade_no) {
        global $_M;
        $pay_time = date("YmdHis");
        $query    = "UPDATE {$_M['table']['pay_order']} SET pay_time='{$pay_time}',pay_type='{$pay_type}',status='1' WHERE out_trade_no='{$out_trade_no}'";
        DB::query($query);
        $this->toapp($out_trade_no);
    }
	
    public function toapp($out_trade_no) {	
        global $_M;
        $query = "SELECT * FROM {$_M['table']['pay_order']} WHERE out_trade_no='{$out_trade_no}'";
        $pay   = DB::get_one($query);
        load::plugin('dopay', 0, array('pay'=>$pay));//加载插件
    }
	
    /**
     * 根据订单号out_trade_no更新订单【开始时间】、【支付类型】
     */
    public function UpadteOrderPaymentType($pay_type,$out_trade_no) {
        global $_M;
        $pay_time = date("YmdHis");
        $query    = "UPDATE {$_M['table']['pay_order']} SET pay_time='{$pay_time}',pay_type='{$pay_type}' WHERE out_trade_no='{$out_trade_no}'";
        DB::query($query);
    }
    /**
     * 根据订单号out_trade_no更新订单【同步通知状态】
     * 1|已接收到通知
     * 0|默认为未接收到通知
     */
    public function UpadteOrderReturnType($out_trade_no) {
        global $_M;
        $query    = "UPDATE {$_M['table']['pay_order']} SET callback='1' WHERE out_trade_no='{$out_trade_no}'";
        DB::query($query);
    }
    /**
     * 根据订单号out_trade_no获取订单支付状态
	 *  TRUE|已支付
	 * FALSE|未支付
     */
    public function CheckOrderPayStatus($out_trade_no) {
        $order = $this->GetOeder($out_trade_no);
        if($order['status']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * 根据out_trade_no查询订单
     * 返回订单信息
     */
    public function GetOeder($out_trade_no) {
        global $_M;
        if($out_trade_no) {
            $query = "SELECT * FROM {$_M['table']['pay_order']} WHERE out_trade_no='{$out_trade_no}'";
            $array = DB::get_one($query);
            return $array;
        } else {
            return FALSE;
        }
    }
    /**
     * 根据接口类型获取接口参数
     */
    public function GetAPI($type, $name) {
        global $_M;
        if($type&&$name) {
            $table = $_M['config']['tablepre'].'pay_api';
            $query = "SELECT value FROM {$table} WHERE name='{$name}'AND paytype='{$type}';";
            $arr   = DB::get_one($query);
            $value = $arr['value'];
        }else{
            $value = 'Fail!';
        }
        return $value;
    }
    /**
     * 获取接口开关
     */
    public function GetPayOpen() {
        global $_M;
        $table = $_M['config']['tablepre'].'pay_config';
        $query = "SELECT value FROM {$table} WHERE name='payment_open'";
        $arr   = DB::get_one($query);
        $value = $arr['value'];
        return $value;
    }
    /**
     * 获取已开启的支付接口
     */
    public function GetPaymentList() {
        global $_M;
        $table = $_M['config']['tablepre'].'pay_config';
        $query = "SELECT value FROM {$table} WHERE name='payment_type'";
        $arr   = DB::get_one($query);
        $value = stringto_array($arr['value'],'|');
        return $value;
    }
    protected function template($path){
        global $_M;
        list($postion, $file) = explode('/',$path);
        if ($postion == 'own') {
            return PATH_OWN_FILE."templates/met/{$file}.php";
        }
        if ($postion == 'ui') {
            return PATH_SYS."include/public/ui/web/{$file}.php";
        }
        if($postion == 'tem'){
            if($_M['custom_template']['sys_content']){
                $flag = 1;
            }else{
                $flag = 0;
            }
            if (file_exists(PATH_TEM."pay/{$file}.php")) {
                $_M['custom_template']['sys_content'] = PATH_TEM."pay/{$file}.php";
            }else{	
                if (file_exists(PATH_SYS."web/pay/templates/met/{$file}.php")) {
                    $_M['custom_template']['sys_content'] = PATH_SYS."web/pay/templates/met/{$file}.php";
                }
            }
            if($flag == 1){
                return $_M['custom_template']['sys_content'];
            }else{
                return $this->template('ui/compatible');
            }
			
        }			
    }
    
    /**
      * 重写web类的load_url_unique方法，获取前台特有URL
      */
    protected function load_url_unique() {
        global $_M;
        parent::load_url_unique();
        $_M['url']['own_func'] = $_M['url']['site'].'app/system/web/pay/include/function/';
        $_M['url']['own_class'] = $_M['url']['site'].'app/system/web/pay/include/class/';
        $_M['url']['pay_notify'] = $_M['url']['site'].'pay/notify.php';
        $_M['url']['pay_return'] = $_M['url']['site'].'pay/return.php';
        
        $_M['url']['tem'] = $_M['url']['site'].'app/system/web/pay/templates/met/';
        if($_M['lang'] != $_M['config']['met_index_type']){
            $lang = "?lang={$_M['lang']}";
        }
        $lang = "?lang={$_M['lang']}";
        $_M['url']['login'] = $_M['url']['site']."member/login.php{$lang}";
        $_M['url']['register'] = $_M['url']['site']."member/register_include.php{$lang}";
        $_M['url']['register_userok'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=douserok";
        $_M['url']['getpassword'] = $_M['url']['site']."member/getpassword.php";
        $_M['url']['profile'] = $_M['url']['site']."member/basic.php{$lang}"; 
        $_M['url']['profile_safety'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety"; 
        $_M['url']['pass_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dopasssave"; 
        $_M['url']['mailedit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailedit"; 
        $_M['url']['maileditok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailok"; 
        $_M['url']['profile_safety_emailadd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_emailadd"; 
        $_M['url']['profile_safety_telok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telok"; 
        $_M['url']['profile_safety_telvalid'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telvalid"; 
        $_M['url']['profile_safety_teladd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teladd"; 
        $_M['url']['profile_safety_teledit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teledit"; 
        $_M['url']['info_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doinfosave";
        $_M['url']['valid_email_repeat'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dovalid_email"; 
        $_M['url']['valid_email'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=doemailvild"; 
        $_M['url']['valid_phone'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dophonecode"; 
        $_M['url']['login_check'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin";	
        $_M['url']['register_save'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dosave";	
        $_M['url']['password_email'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=doemail";
        $_M['url']['password_valid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dovalid";
        $_M['url']['password_telvalid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dotelvalid";
        $_M['url']['password_valid_phone'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dophonecode";
        $_M['url']['login_out'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologout";	
        $_M['url']['login_other'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=doother";	
        $_M['url']['login_other_register'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_register";	
        $_M['url']['login_other_info'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_info";	
    }
    
}
?>