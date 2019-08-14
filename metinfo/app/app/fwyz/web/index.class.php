<?php
defined('IN_MET') or exit('No permission');	

load::own_class('web/class/fwweb');

class index extends fwweb {
    
    private $url;
    private $ado    = array('doqrcode','dotable','dosection','doipajax','doweixin');
    private $webinfo = '';

    public $mobile;
    public $formcode;
    public $infowidth = '';

    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        $this->url  = parent::weburl();
        #前端计算输入框判断
        $this->mobile   = is_mobile_client()?1:0;
        $this->formcode = $_M['form']['code']?1:0;
    }

    //查询页面
    public function doindex() {
        global $_M,$_YW;
        cloud::tablejqcss();
        
        //section模板
        if($_YW['c']['template'] == 'section'){
            $space  = cloud::space();
            $_YW['c']['celan']  = 0;
        }

        if($_YW['c']['webstyle']){
            require $this->template('own/'.$_YW['c']['template']);
        }else{
            require $this->custom_template('own/'.$_YW['c']['template'], $_YW['c']['celan']);
        }
    }
    
    //结果页面
    public function docode() {
        global $_M,$_YW;
        
        if($_M['form']['a'] == 'doqrcode' || $_M['form']['a'] == 'doweixin') parent::webqcodewechaterror();
        
        $_M['form']['code'] = cloud::codeformatting($_M['form']['code']);
        
        //检测a的值是否合法
        if(in_array($_M['form']['a'],$this->ado)){
            
            //城市信息记录
            if($_M['form']['a'] == 'doipajax'){
                self::doipajax();
                exit(0);
            }

            //判断code 是否为空
            if(!cloud::ckspace($_M['form']['code'])){
                $this->errorinfo($_YW['t']['yw133']);
            }
        
            //进行值的输出
            $this->webinfo = load::own_class('webinfo','new');
            
            $this->frequency($this->webinfo->codeid());
            if($this->frequency) $this->webinfo->totalnum();
            
            if($this->webinfo->mold()){
                #前端判断
                $this->infowidth    = $this->mobile?' style="width:100%;" ':'';
                
                self::$_M['form']['a']();
            }else{
                $this->errorinfo($_YW['t']['yw187']);
            }
        }else{
            echo $_YW['t']['yw313'];
            header("location:http://www.taomoban.wang"); //该网站被人试图利用本应用攻击时才执行。
            exit(0);
        }
    }
    
    //qrcode二维码
    private function doqrcode() {
        global $_M,$_YW;
        $this->html  =   $this->webinfo->table();
        cloud::tablejqcss();
        require $this->template('own/index');
    }
    
    //微信
    private function doweixin() {
        global $_M,$_YW;
        $this->html  =   $this->webinfo->table();
        cloud::tablejqcss();
        require $this->template('own/index');
    }
    
    //table结果页面
    private function dotable() {
        global $_M,$_YW;
        if($_YW['c']['css']){
            $number = $this->webinfo->number();
            if($this->webinfo->mold()){
                echo '<strong><font color="#000000" ;="">'.$_YW['t']['yw314'].'：'.$_YW['c']['jdzpjg'].'，'.$_YW['t']['yw315'].'：'.$number.' 次。</font></strong>';
            }else{
                echo '<strong><font color="#ff0000" ;="">'.$_YW['t']['yw314'].'：'.$_YW['c']['jdjmwl'].'，'.$_YW['t']['yw315'].'：'.$number.' 次。</font></strong>';
            }
            exit(0);
        }else{
            $this->html  =   $this->webinfo->table();
            if($_YW['c']['webstyle']){
                require $this->template('own/index');
            }else{
                require $this->custom_template('own/index', $_YW['c']['celan']);
            }
        }
        
    }
    
    //section结果页面
    private function dosection() {
        global $_M,$_YW;
        $this->html  =   $this->webinfo->table();
        if($_YW['c']['webstyle']){
            require $this->template('own/index');
        }else{
            require $this->custom_template('own/index', $_YW['c']['celan']);
        }
    }
    
    //微信结果
    public function dowechat() {
        global $_M,$_YW;
        parent::webqcodewechat(2);
        /**
         * 接收处理post过来的数据
         * 下边的内容固定不要动！！！！！
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') //一定要判断，POST过来的数据才进行接下来的处理
        $post_data = json_decode($GLOBALS["HTTP_RAW_POST_DATA"], ture);
        $search = stringto_array($post_data['Content'],'#');
        $_M['form']['a']    = 'doweixin';
        $_M['form']['code'] = cloud::codeformatting($search[1]);

        //判断code 是否为空
        if(!cloud::ckspace($_M['form']['code'])){
            cloud::wechaterror($_YW['t']['yw133']);
        }

        //进行值的输出
        $this->webinfo = load::own_class('webinfo','new');

        $this->frequency($this->webinfo->codeid());
        if($this->frequency) $this->webinfo->totalnum();

        if($this->webinfo->mold()){

            /**
            * 所有参数一定注意大小写！！！！
            * $post_data 里边包含
            *            ToUserName      //开发者微信号
            *            FromUserName    //发送方帐号（用户OpenID）
            *            CreateTime      //消息创建时间 （整型）
            *            MsgType         //消息类型 text,image,voice,video等等，一般只会给你传递text类型消息
            *            MsgId           //消息id，64位整型
            * $post_data 里不同类型消息还包含
            *     text   Content         //文本消息内容
            *     image  PicUrl          //图片链接
            *            MediaId         //图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
            *
            *     其它json数据的不同请去微信开发文档自行查看，目前只能转发给你文字类型消息，其它类型，后边更新
            *     https://mp.weixin.qq.com/wiki/17/f298879f8fb29ab98b2f2971d42552fd.html
            */
           switch ($post_data['MsgType']) {
               case 'text':
                   /**
                    * 如果需要回复内容给用户，请返回一个json，可以发送给用户多种类型的消息！
                    * 目前仅支持，text，image，news类型，其它后期考虑支持！
                    * type 你想返回给用户的消息类型
                    *      text  类型
                    *          text = 文字类型信息必须经过urlencode()，这样可以回复给用户带有emoji的消息
                    *      image 类型
                    *          mediaid = 微信公众号素材中，图片的mediaid
                    *      news  类型  图文消息类型
                    *          news_list = 一个图文数据的数组 最多包含10条数据 包含以下内容
                    *                  title  图文标题
                    *                  description  描述 30字以内
                    *                  picurl 图片地址 包含http://的完整地址
                    *                  url    文章链接 图文消息点开的链接 包含http://的完整地址
                    */

                   $arr    = $this->webinfo->infocode();
                   if($arr == FALSE){
                       $resultStr = array (
                           'type' => 'text',
                           'text' => urlencode($_YW['t']['yw137'])
                       );  
                   }else{
                       $resultStr = array (
                           'type' => 'news'
                       );
                       $resultStr['news_list'][$i]['title'] = $_YW['t']['yw142'].$_YW['t']['yw138'];
                       $resultStr['news_list'][$i]['picurl'] = cloud::imgexplode($_YW['c']['picurl']);
                       $resultStr['news_list'][$i]['description'] = $_YW['c']['description'];
                       $resultStr['news_list'][$i]['url'] = cloud::wechaturl($_M['form']['code']);
                   }
                   $resultStr = json_encode($resultStr);
                   break;
           }
           /**
            * 直接输出上边生成的json数据就可以了！！！！
            * 切记，如果你只收消息，不回消息，那么一定要返回一个空值，即 $resultStr = '';
            */
           echo $resultStr;
        }else{
            cloud::wechaterror($_YW['t']['yw187']);
        }
        
    }


    //ipajax
    public function doipajax() {
        global $_M,$_YW;
        if($_M['form']['codeidip']){
            load::own_class('ip');
            $ip = ip::find($_M['form']['codeidip']);
            $field  = " country = '{$ip[0]}',prov = '{$ip[1]}',city = '{$ip[2]}' ";
            parent::amendsql($_YW['k']['record'],$field," id= {$_M['form']['id']} ");
            met_setcookie('codeidip','');
        }
    }
    
    //查询记录
    public function __destruct() {
        global $_M,$_YW;
        if($this->webinfo == '') return false;
        if($this->webinfo->mold()){
            $issue      = member_information();
            $time       = time();
            
            //一个小时内只做一次记录
            if($this->frequency){
                $field   = "lang = '{$_M['lang']}', time = '{$time}', code_id='{$this->recordmode['code_id']}',ip = '{$this->recordmode['ip']}', issue  = '{$issue['username']}',mode='{$this->recordmode['mode']}' ";
                $this->addsql($_YW['k']['record'],$field);
                $ipajax   = parent::webajaxurl(DB::insert_id());
                
                $this->amendsql($_YW['k']['code']," total = ABS(total + 1) "," id = '{$this->recordmode['code_id']}' ");
                met_setcookie('codeidip',$this->recordmode['ip']);
                
                //console.log(json)
                echo "<script>$.getJSON('{$ipajax}',function (json) {});</script>";
            }
        }
    }

}
?>