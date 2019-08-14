<?php
defined('IN_MET') or exit ('No permission');

load::sys_class('admin');
load::sys_class('nav.class.php');
//执行
function zx($form) {
    global $_M;
    CSQL($form);
}

//配置信息数据入库处理
function CSQL($form) {
    global $_M;
    $zb  = array('radio1','checkbox','lang','textjdn1','textjdn2','textjdn3','textjdn4','textjdn5','bottom','right','orderlist','wxwz','wxwzz','wxwzk','wxwzh'); //提交页面字段名称
    foreach ($zb as $key => $val) {
        $arr [$val] = $val;
    }
    $a = array_intersect_key($form,$arr); //对比数组
    foreach ($a as $k => $v) {
        if($k != 'lang'){
            $ar[$k] = array(name => $k ,value => $v, lang => $a['lang']);
        } 
    }
    foreach ($ar as $k => $v) {
        $a   = zfc($v);
        $sql = "INSERT INTO {$_M['table']['yw_lrtk']} SET {$a} ON DUPLICATE KEY UPDATE value='$v[value]'";
        $z  .=  DB::query($sql);
    }
}

//组成字符串
function zfc($z) {
    foreach ($z as $k => $v) {
        $arr .= $k."="."'".$v."'".",";
    }
    $arr = rtrim($arr, ",");
    return $arr;
}

//默认配置信息组
function morenpz($lang) {
    $arr['lang']        = $lang;
    $arr['radio1']      = '2';
    $arr['checkbox']    = '0|1|2|3|4|5';
    $arr['textjdn1']    = '15069846560';
    $arr['textjdn2']    = '../app/app/lrtk/admin/templates/img/yw.jpg';
    $arr['textjdn3']    = '415420792';
    $arr['textjdn4']    = 'http://t.qq.com/vipwangwei?preview';
    $arr['textjdn5']    = 'http://t.qq.com/vipwangwei?preview';
    $arr['bottom']      = '40';
    $arr['right']       = '40';
    $arr['wxwz']        = '0';
    $arr['wxwzz']       = '75';
    $arr['wxwzk']       = '160';
    $arr['wxwzh']       = '160';
    $arr['orderlist']   = '5,4,3,2,1,0';
    return $arr;
}

class install {
    
    private $no = 10014;
    private $m_name = 'lrtk';
    
    public function dosql() {
        global $_M;
        $query = "select * from {$_M['table']['applist']} where no='{$this->no}'";
        $stall = DB::get_one($query);
        if(!$stall){
            $this->cs();
          //  echo '安装成功！';
        }else{
            switch ($stall['ver']) {
                case "1.0.0":
                    $this->fwver('1.1');        //更新到 1.1
                    break;
                case "1.1":
                    $this->fwver('1.2');        //更新到 1.1
                    break;
                default:
                    break;
            }
            echo '您的系统中已存在该应用或系统中的应用和要安装的应用在应用编号上有冲突！';
        }
    }
    
    //全局版本号更新
    private function fwver($ver) {
        global $_M;
        $query = "UPDATE {$_M['table']['applist']} SET ver='{$ver}' where no='{$this->no}' AND m_name='{$this->m_name}' ";
        DB::query($query);
    }
    
    //1.0.0版本安装
    public function cs() {
        global $_M;
        $query = "INSERT INTO {$_M['table']['applist']} SET no='{$this->no}',ver='1.0.0',m_name='{$this->m_name}',m_class='index',m_action='doindex',appname='\$_M[''word''][''yw_lrtk_name'']',info='\$_M[''word''][''yw_lrtk_namesm'']',updatetime='1414995306'";
        DB::query($query);
        /**
        * 1、增加新表
        * name	配置名称
        * id	添加信息自动增加，		
        * value	配置名称值
        * lang	语言[后台]
        **/
        $query = "CREATE TABLE `{$_M['config']['tablepre']}yw_lrtk` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(200) NOT NULL,
                `value` text,
                `lang` varchar(50) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uc_PersonID` (`name`,`lang`)
                ) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8";
        DB::query($query);
        add_table("yw_lrtk");
        //app_plugin表数据插件
        $query = "INSERT INTO {$_M['table']['app_plugin']} SET no_order='1',no='{$this->no}',m_name='{$this->m_name}',m_action='doweb',effect='1'";
        DB::query($query);
        //language表数据
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzbsm',value='fill in the customer service telephone number',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxza',value='return to top',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzb',value='customer service phone',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzsm',value='Please fill in the corresponding information selection',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxz',value='Feature selection',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnpz',value='Function settings',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgb',value='off',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kga',value='open',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgsm',value='Front desk will no longer show closed.',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kg',value='Application of switch',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_cjpz',value='The plug-in configuration',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzsm',value='设置在页面的显示位置。',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpx',value='图标排序',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpxsm',value='拖动图标进行排序，从左到右，在前台显示为从上到下',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymr',value='还原默认',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymrsm',value='您确定要还原吗？将会清楚您所配置的信息。',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_submit',value='保存',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_bccg',value='保存成功',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hycg',value='还原成功',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwz',value='微信二维码',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzsm',value='默认值距离下方：0px，距离右边 75px',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzk',value='宽',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzh',value='高',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_name',value='Online customer service network',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_namesm',value='Microblogging, QQ customer service, the official micro channel, customer service phone, return to the top five for the side edge tool, the mouse across a two-dimensional code icon will pop up a two-dimensional code image scrolling web pages to a certain height shows the top button, simple and practical, compatible with mainstream browsers.',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzsm',value='默認值距離下方：0px，距離右邊 75px',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzh',value='高',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzk',value='寬',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hycg',value='還原成功',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwz',value='微信二維碼',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymrsm',value='您確定要還原嗎？將會清楚您所配置的信息。',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_submit',value='保存',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_bccg',value='保存成功',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymr',value='還原默認',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpxsm',value='拖動圖標進行排序，從左到右，在前臺顯示為從上到下',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpx',value='圖標排序',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzb',value='距離右邊',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzsm',value='設置在頁面的顯示位置。',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswza',value='距離下方',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wzsz',value='位置設置',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswz',value='顯示位置',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzesm',value='填寫微博完整地址',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzf',value='騰訊微博',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzc',value='official WeChat',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzcsm',value='Upload WeChat two-dimensional code, the default size: 160px*160px',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzd',value='QQ customer service',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzdsm',value='Fill in the QQ account, marketing QQ enterprise QQ can directly fill in the production link address',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxze',value='Sina microblogging',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzesm',value='fill micro-blog full address',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzf',value='Tencent microblogging',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wzsz',value='location settings',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswz',value='display position',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswza',value='distance below',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzb',value='distance to the right',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzsm',value='Set in the display position of the page.',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpx',value='Icon sorting',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_tbpxsm',value='Drag the icon to sort, from left to right, in the front display is from top to bottom',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymr',value='To restore the default',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hymrsm',value='Are you sure you want to restore? You will know the configuration information.',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_submit',value='save',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_bccg',value='Successfully saved',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_hycg',value='Reduction of success',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwz',value=' WeChat two-dimensional code',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzsm',value=' the default distance below: 0px, 75px from right',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzk',value=' wide',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wxwzh',value=' high',site='1',no_order='0',array='0',app='{$this->no}',lang='en'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_name',value='雲網線上客服',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_namesm',value='微博、QQ客服、官方微信、客服電話、返回頂部五合為壹側邊工具，鼠標劃過二維碼圖標會彈出二維碼圖片，滾動網頁到壹定高度時顯示返回頂部按鈕，簡潔實用，兼容主流瀏覽器。',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_cjpz',value='插件配置',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kg',value='應用開關',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgsm',value='關閉後前臺不會再顯示。',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kga',value='開啟',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgb',value='關閉',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnpz',value='功能設置',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxz',value='功能選擇',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzsm',value='選擇後請填寫相應的信息',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxza',value='返回頂部',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzb',value='客服電話',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzbsm',value='填寫客服電話號碼',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzc',value='官方微信',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzcsm',value='上傳微信二維碼,前臺顯示默認大小：160px*160px',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzd',value='QQ客服',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzdsm',value='填寫QQ帳號，行銷QQ企業QQ可直接填寫生成連結位址',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxze',value='新浪微博',site='1',no_order='0',array='0',app='{$this->no}',lang='tc'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswzb',value='距离右边',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswz',value='显示位置',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_xswza',value='距离下方',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzf',value='腾讯微博',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_wzsz',value='位置设置',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzesm',value='填写微博完整地址',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxze',value='新浪微博',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzdsm',value='填写QQ账号，营销QQ企业QQ可直接填写生成链接地址',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzd',value='QQ客服',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzcsm',value='上传微信二维码,前台显示默认大小：160px*160px',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzc',value='官方微信',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzbsm',value='填写客服电话号码',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzb',value='客服电话',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgb',value='关闭',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnpz',value='功能设置',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxz',value='功能选择',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxzsm',value='选择后请填写相应的信息',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_gnxza',value='返回顶部',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_cjpz',value='插件配置',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kg',value='应用开关',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kgsm',value='关闭后前台不会再显示。',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_kga',value='开启',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_namesm',value='微博、QQ客服、官方微信、客服电话、返回顶部五合为一侧边工具，鼠标划过二维码图标会弹出二维码图片，滚动网页到一定高度时显示返回顶部按钮，简洁实用，兼容主流浏览器。',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        $query = "INSERT INTO {$_M['table']['language']} SET name='yw_lrtk_name',value='云网在线客服',site='1',no_order='0',array='0',app='{$this->no}',lang='cn'";
        DB::query($query);
        //初始化数据
        $form   = morenpz('cn');
        zx($form);
        $form   = morenpz('en');
        zx($form);
        $form   = morenpz('tc');
        zx($form);
    }
}
?>