<?php
return array(
	 

	'alipay_config'=>array(	 
		'partner'		=> C('ali_partner'),
		'key'			=> C('ali_key'),
		//签名方式 不需修改
		'sign_type'    => strtoupper('MD5'),

		//字符编码格式 目前支持 gbk 或 utf-8
		'input_charset'=> strtolower('utf-8'),

		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		'cacert'    => getcwd().'/cacert.pem',

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		'transport'    => 'http'
	),
	/**************************请求参数配置**************************/
	'alipay'=>array(
        //支付类型
        'payment_type' => 1,
        //必填，不能修改
        //服务器异步通知页面路径
        'notify_url' => 'http://' . $_SERVER['HTTP_HOST'].'/notify.php',
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
         'return_url' =>'http://' . $_SERVER['HTTP_HOST'].'/respond.php',
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //卖家支付宝帐户
        'seller_email' => C('seller_email')
        //必填
		/************************************************************/
	)
);