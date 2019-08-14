<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 14-2-26
 * Time: 下午2:16
 */
return array(
    'URL_ROUTE_RULES'=>array(
		/*分类*/
        'v/:id' => 'View/index',  //  'v-:id' => 'View/index',
        'v-:id' => 'View/indexz',  //  'v-:id' => 'View/index',
        'm/font/info' => 'Fonts/info',  //  'v-:id' => 'View/index',
        'auth/login/other' => 'auth/other',  //  'v-:id' => 'View/index',
		'm/base/file/uptokens' => 'Upfile/uptokens', 
		'm/base/file/upbase64' => 'Upfile/upbase64', 
		'm/base/file/info/save' => 'Upfile/saveinfo', 
		'm/scene/tag/page/list' => 'Scene/tagPageList', 
		'm/scene/tag/page/set' => 'Scene/tagPageSet', 
		//'/^[a-zA-Z]+(\/[a-zA-Z]+)?$/' => '/#/:0',
		
    ),
);