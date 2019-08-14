<?php
return array(
    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'SHOW_PAGE_TRACE' => FALSE,
    'TOKEN_ON' => true, // 是否开启令牌验证
    'TOKEN_NAME' => '__yj__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => FALSE, //令牌验证出错后是否重置令牌 默认为true

    'LOAD_EXT_CONFIG' => 'systemConfig,websetConfig,wxapi,setmail,pay,config_alipay,home70,home70_sub,jsvion,scenelink,otherlogin',

    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
    'MODULE_ALLOW_LIST'     =>  array('Home','s','Alipay'), // 配置你原来的分组列表
    'DEFAULT_MODULE'        =>  'Home', // 配置你原来的默认分组
	'MODULE_DENY_LIST'      =>  array('Common','Runtime','Ucenter'),
	'URL_ROUTER_ON'   => true,// 开启路由
	'URL_MODEL' =>0,
   'HOME_PAGESIZE' =>12,
   'JS_VISION'=>3.4,
// 配置邮件发送服务器
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
	
// 数据库备份配置
    'DATA_BACKUP_COMPRESS' =>'1', //是否启用压缩0:不压缩1:启用压缩，（压缩备份文件需要PHP环境支持gzopen,gzwrite函数)
    'DATA_BACKUP_COMPRESS_LEVEL' =>'9',//文件压缩级别:1:普通4:一般9:最高 (该配置在开启压缩时生效)
    'DATA_BACKUP_PART_SIZE' =>'20971520', // 数据库备份卷大小,该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M
	'DATA_BACKUP_PATH' =>'./Data/', // 数据库备份根路径,路径必须以" /" 结尾
	
	
'IS_OPEN_STATIC' =>true,  //false
'IS_USER_TPL_ROLE'=>true, //vincent
'SYS_LINK' => true,   //vincent
'VI_SCENECODE'=>true,  //vincent
//'IS_OPEN_ONY_WECHAT'=>true ,   //vincent
'MANAGE_TPL_UID'=>4,	

//'IS_OPEN_article'=>true,   // 旅行
 
);