<?php

defined('IN_MET') or exit('No permission');

class backups {
    
    private $csvname;   //文件名
    public  $recycle;
    private $qrcode;    //二维码内容

    private $parameter  = array();      //自定义字段信息
    private $title      = array();      //表格标头
    
    private $info_code_id = array();  //信息ID


    public function __construct() {
        global $_M,$_YW;
        $date = date('Ymd', time());
        $filename = iconv("utf-8", "GBK", $_YW['t']['yw125'] . $_M['lang'] . $date);
        $this->csvname  = $filename . '.csv';
        $this->recycle  = $_M['form']['recycle'];
        if($_M['form']['info_code_id']) {
            $this->info_code_id  = array(
                "info" => " AND id = '{$_M['form']['info_code_id']}' ",
                "code" => " AND info_id = '{$_M['form']['info_code_id']}' "
            );
        }
    }
    
    /**
	 * 为字段赋值
	 * @param  string  $name    字段名称
	 * @param  mixed   $value   要赋给字段的值
	 * @return boolean  		属性名不正确或值没有返回false
	 */
	public function set($name,$value) {
            if($value == null){
                return false;
            }
            switch($name){
                case 'csvname':
                    $this->csvname = $value;
                break;
                case 'recycle':
                    $this->recycle = $value;
                break;
                case 'qrcode':
                    $this->qrcode = $value;
                break;
                default:
                    return false;
                break;
            }
        }
    
    //导出数据
    public function doaddupcvs() {
        global $_M,$_YW;
        //输出头部
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $this->csvname);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        //刷新buffer
        ob_flush();
        flush();
        $file  = fopen('php://output', 'a');

        //先将标题写入文件
        $title  = self::arrzbm(self::csvtemplate(),'utf-8' , 'GBK'); 
        if(!fputcsv($file, $title)){
            //改变状态
            cloud::addconsql('csvbf', '');
        }
        ob_flush();
        flush();

        # 获取数据总条数
        $num    = DB::counter($_YW['k']['info'] , "WHERE lang='{$_M['lang']}' AND recycle = '{$this->recycle}' ");
        $pag    = ceil($num/500);
        for ($i = 0; $i < $pag; $i++){
            $info   = self::bckinfsql($i);
            $infoid = array_column($info, 'id');
            $plist  = self::bckplistsql($infoid);
            if($_M['form']['tname'] == 'info'){
                $code   = self::bckcodesql($infoid);
                $array  = self::bckcsvinfo($info,$code,$plist);
            }elseif($_M['form']['tname'] == 'code'){
                $code   = self::bckcodesqlc($infoid);
                $array  = self::bckscvcode($code,$info,$plist);
            }

            $y = 0;
            $listnum = 1000;
            foreach ($array as $val) {
                //返回数据
                $y++;
                # 每隔$listnum行，刷新一下输出buffer,大数据量时处理
                # 刷新一下输出buffer，防止由于数据过多造成问题
                if ($listnum == $y) {
                    ob_flush();
                    # 刷新buffer
                    flush();
                    $y = 0;
                }
                
                $arr = self::arrzbm($val,'utf-8' , 'GBK');
                fputcsv($file, $arr);
            }
        }
        fclose($file);
    }
    
    //数组整理信息为主(防伪码用$$$$分割)
    private function bckcsvinfo($info,$code,$plist) {
        global $_M,$_YW;
        foreach ($info as $key => $val) {
            //整理数组
            $list[$key]   = array(
                'title'     =>  $val['title'],
                'num'       =>  $val['num'],
                'code'      =>  $code[$key]['code'],
//                'qrcode'    =>  self::qrcode($code[$key]['code']),
                'info'      =>  $val['info'],
                'content'   =>  $val['content'],

            );
            
            if(cloud::qcodewechat(1)) $list[$key]['qrcode']   = self::qrcode($code[$key]['code']);

            foreach ($this->parameter as $pv){
                $list[$key]['zdy'.$pv['id']]   = $plist[$key][$pv['id']]['info'];
            }
        }
        return $list;
    }
    
    //将防伪码以$$$$分割的组成qrcode
    private function qrcode($code) {
         global $_M,$_YW;
        foreach (stringto_array($code,'$$$$') as $val){
            $qrcode[] = $this->qrcode.$val.'&lang='.$_M['lang'];
        }
        return arrayto_string($qrcode,'$$$$');
    }


    //整理数组//以防伪码为主
    private function bckscvcode($code,$info,$plist) {
        global $_M,$_YW;
        $i  = 0;
        foreach ($code as $val){
            
            $list[$i]   = array(
                'title'     =>  $info[$val['info_id']]['title'],
                'num'       =>  $info[$val['info_id']]['num'],
                'code'      =>  $val['code'],
                'info'      =>  $info[$val['info_id']]['info'],
                'content'   =>  $info[$val['info_id']]['content'],
            );
            
            if(cloud::qcodewechat(1))   $list[$i]['qrcode'] = $this->qrcode.$val['code'].'&lang='.$val['lang'];
            
            //plist
            foreach ($this->parameter as $pv){
                $list[$i]['zdy'.$pv['id']]   = $plist[$val['info_id']][$pv['id']]['info'];
            }
            
            $i++;
        }
        return $list;
    }


    /**********************************************************************************
     * 
     *                              数据获取
     * 
     **********************************************************************************/

    //获取info
    private function bckinfsql($pag) {
        global $_M,$_YW;
        $start  = $pag*500;
        $filed  = "title,num,info,content,id";
        $query = "SELECT {$filed} FROM {$_YW['k']['info']} where lang='{$_M['lang']}' AND recycle='{$this->recycle}' {$this->info_code_id['info']} ORDER BY `no_order` asc LIMIT {$start},500 ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $info[$val['id']]  = $val;
        }
        return $info;
    }
    
    //获取code//适合防伪码个数较少的情况一般40以内的
    private function bckcodesql($id) {
        global $_M,$_YW;
        DB::query("SET GLOBAL group_concat_max_len=10240000");
        DB::query("SET SESSION group_concat_max_len=10240000");
        $infoid = arrayto_string($id,',');
        $filed  = "group_concat(code separator '$$$$') code ,group_concat(qrcode separator '$$$$') qrcode,info_id";
        $query  = "SELECT {$filed} FROM {$_YW['k']['code']} where info_id IN($infoid) AND recycle='{$this->recycle}' GROUP BY info_id";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $val['code']    = rtrim($val['code'], "$$$$");
            $val['qrcode']  = rtrim($val['qrcode'], "$$$$");
            $code[$val['info_id']]  = $val;
        }
        return $code;
    }
    
    //获取防伪码以防伪码为主
    private function bckcodesqlc($id) {
        global $_M,$_YW;
        $infoid = arrayto_string($id,',');
        $filed  = "id,code,qrcode,info_id";
        $query  = "SELECT {$filed} FROM {$_YW['k']['code']} where info_id IN($infoid) AND recycle='{$this->recycle}' {$this->info_code_id['code']}";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $code[$val['id']]  = $val;
        }
        return $code;
    }

    //获取plist
    private function bckplistsql($id) {
        global $_M,$_YW;
        $listid = arrayto_string($id,',');
        $filed  = 'id,listid,paraid,info';
        $query  = "SELECT {$filed} FROM {$_YW['k']['plist']} where listid IN($listid) ";
        $result = DB::query($query);
        while($val = DB::fetch_array($result)){
            $plist[$val['listid']][$val['paraid']]  = $val;
        }
        return $plist;
    }
    
    /*****************************************************************************
     * 
     * 函数
     * 
     *****************************************************************************/
    
    //对数组的值进行转码并返回(一维数组)
    public function arrzbm($arr,$u,$g) {
        global $_M;
        foreach ($arr as $k => $v) {
            $newarr[$k] = iconv($u,$g,$v);
        }
        return $newarr;
    }
    
    /*********************************************************************************
     * 
     *                                  导入导出公用函数
     * 
     ********************************************************************************/
    
    
    # 导入导出数组(保持和导入格式一样)
    public function csvtemplate() {
        global $_M,$_YW;
        $arr    = array(
            'title'         => $_YW['t']['yw306'],
            'num'           => $_YW['t']['yw015'],
            'code'          => $_YW['t']['yw014'],
            'info'          => $_YW['t']['yw024'],
            'content'       => $_YW['t']['yw307'],
            
        );
        
        if(cloud::qcodewechat(1)) $arr['qrcode']    = $_YW['t']['yw206'];
        
        $zdy    = self::zdytitle();
        if(is_arrempty($zdy)){
            # php小BUG 有数组为空时，数组合并会不返回任何值
            $arr  = array_merge($arr,$zdy); 
        }
        $this->title    = $arr;
        return $arr;
    }
    
    /*
     * 导入导出数组
     * 不加任何排序，这样可以更好的组织内容录入，防止编辑后，后台调整了排序，还需要再调整表格
     */
    private function zdytitle() {
        global $_M,$_YW;
        $q = "SELECT id,name FROM {$_YW['k']['parameter']} where lang='{$_M['lang']}' ";
        $result = DB::query($q);
        while($val = DB::fetch_array($result)){
            $this->parameter[$val['id']]    = $val;
            $arr['zdy_'.$val['id']]    = $val['name'];
        }
        return $arr;
    }
    
}

?>