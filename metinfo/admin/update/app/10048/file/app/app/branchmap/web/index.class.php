<?php
defined('IN_MET') or exit ('No permission');

load::own_class('appweb');

class index extends appweb {
    
    //过滤方法名
    private $do = array('doindex','doajax','doajaxcl');
    
    //ajax判断
    private $where = '';


    public function __construct() {
        global $_M,$_YW;
        parent::__construct();
        //过滤
        if(!in_array(M_ACTION,$this->do)){
            //报错
            $this->doindex();
            exit(0);
        }
    }
    
    //页面初始化
    public function doindex() {
        global $_M,$_YW;
        if($_YW['c']['state'] == 0){
            $num    = self::num();
            $info = $this->info($_YW['c']['webtext1']);
        }
        require $this->custom_template('own/index', 0);
    }
    
    //前台互动数据
    public function doajax() {
        global $_M,$_YW;
        $this->where = " lang = '{$_M['lang']}' ";
        if($_M['form']['type']) $this->where .= " AND type= '{$_M['form']['type']}' ";
        if($_M['form']['province']) $this->where .= " AND province= '{$_M['form']['province']}' ";
        if($_M['form']['city']) $this->where .= " AND city= '{$_M['form']['city']}' ";
        if($_M['form']['district']) $this->where .= " AND district= '{$_M['form']['district']}'";
        if($_M['form']['state'] == 2){
            //是否返回公司地址
            $arr = self::corporate();
        }else{
            //标注列表
            $arr = self::infodata();
        }
        
        echo jsoncallback($arr);
    }
    
    //own.JS lang语言数组调用
    public function doajaxcl() {
        global $_M,$_YW;
        parent::doconfig('dono');
        echo jsoncallback($_YW);
    }
    
    //返回公司单独的信息
    private function corporate() {
        global $_M,$_YW;
        $mobile = is_mobile_client()?'#allmap':'javascript:;';
        
        $about  = $_YW['c']['about']?'<p>'.$_YW['t']['yw055'].'：'.$_YW['c']['about'].'</p>':'';
        $map    =  array(
                    stringto_array(
                        $_YW['c']['lnglat']
                        .',<div class="BMap_bubble_content" style="width: auto; height: auto;"><table><tbody><tr><td valign="top" style="border-top:none;" nowrap="">'
                        . '<p><b>'.$_YW['c']['corporatename'].'</b></p>'
                        . '<p>'.$_YW['t']['yw038'].'：'.$_YW['c']['city1'].$_YW['c']['city2'].$_YW['c']['city3'].$_YW['c']['city4'].'</p>'
                        . $about
                        . '</td></tr></tbody></table></div>'
                    ,',')
            );
        
        $lnglat  = stringto_array($_YW['c']['lnglat'],',');
        $aboutinfo    = $_YW['c']['about']?'<p class="list-group-item-text">'.$_YW['t']['yw055'].'：'.$_YW['c']['about'].'</p>':'';
        $info = '<a href="'.$mobile.'" class="list-group-item lnglat" data-lng="'.$lnglat[0].'" data-lat="'.$lnglat[1].'" data-num="0">
                            <h4 class="list-group-item-heading">'.$_YW['c']['corporatename'].'</h4>
                            <p class="list-group-item-text">'.$_YW['t']['yw038'].'：'.$_YW['c']['city1'].$_YW['c']['city2'].$_YW['c']['city3'].$_YW['c']['city4'].'</p>
                            '.$aboutinfo.'
                        </a>';
        $num = '';
        return array('code' => 1,'data' => $map,'info' => $info,'num'=>$num);
    }


    //数据处理
    private function infodata() {
        global $_M,$_YW;
        $query      = "SELECT * FROM {$_YW['k']['detailed']} where {$this->where} ORDER BY id asc";
        $result = DB::query($query);
        $map = array();
        $info = '';
        $code = 0;
        $i  = 0;
        
        $mobile = is_mobile_client()?'#allmap':'javascript:;';
        
        while($val = DB::fetch_array($result)){
            $code = 1;
            $telarr = array($val['tel'],$val['fixedtel']);
            $telstr = trim(arrayto_string($telarr,'，'), "，");
            $tel    = $telstr?'<p>'.$_YW['t']['yw056'].'：'.$telstr.'</p>':'';
            $type   = $val['type'] && $_YW['c']['typeon']?'<p class="">'.$_YW['t']['yw063'].'：'.$val['type'].'</p>':'';
            
            
            $map[]    =  stringto_array($val['lnglat']
                    .',<div class="BMap_bubble_content" style="width: auto; height: auto;"><table><tbody><tr><td valign="top" style="border-top:none;" nowrap="">'
                    . '<p><b>'.$val['name'].'</b></p>'
                    . $type
                    . '<p>'.$_YW['t']['yw002'].'：'.$val['province'].$val['city'].$val['district'].$val['address'].'</p>'
                    . '<p>'.$_YW['t']['yw037'].'：'.$val['region'].'</p>'
                    . $tel
                    . '</td></tr></tbody></table></div>',',');
            
            $lnglat  = stringto_array($val['lnglat'],',');
            $telinfo    = $telstr?'<p class="list-group-item-text">'.$_YW['t']['yw057'].'：'.$telstr.'</p>':'';
            $typetwo    = $val['type'] && $_YW['c']['typeon']?'<p class="list-group-item-text">'.$_YW['t']['yw067'].'：'.$val['type'].'</p>':'';
            $info .= '<a href="'.$mobile.'" class="list-group-item lnglat" data-lng="'.$lnglat[0].'" data-lat="'.$lnglat[1].'" data-num="'.$i.'">
                                <h4 class="list-group-item-heading">'.$val['name'].'</h4>'.$typetwo.'
                                <p class="list-group-item-text">'.$_YW['t']['yw038'].'：'.$val['province'].$val['city'].$val['district'].$val['address'].'</p>
                                '.$telinfo.'
                            </a>';
            $i++;
        }
        
        if(!$code){
            $info = $this->info($_YW['c']['webtext2']);
        }
        
        $num    = self::num($i);
        
        return array('code' => $code,'data' => $map,'info' => $info,'num'=>$num);
    }


    //默认LI
    private function info($info) {
        global $_M,$_YW;
        return '<div class="list-group-item">'.$info.'</div>';
    }
    
    //统计
    private function num($num = false) {
        global $_M,$_YW;
        $gnum    = DB::counter($_YW['k']['detailed'], "WHERE lang='{$_M['lang']}' ");
        $city = '';
        if($_M['form']['state']) $city = '，'.$_YW['t']['yw058'].'&nbsp;'.$num.'&nbsp;'.$_YW['t']['yw040'];
        
        return '<label class="control-label num">'.$_YW['t']['yw039'].'：</label>'
                . '<span class="control-label num">'.$_YW['t']['yw059'].'&nbsp;'.$gnum.'&nbsp;'.$_YW['t']['yw040'].$city.'</span>';
    }
}
?>