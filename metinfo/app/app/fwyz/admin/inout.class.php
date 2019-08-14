<?php

defined('IN_MET') or exit('No permission');

load::own_class('admin/class/fwadmin');
load::own_func('admin');

class inout extends fwadmin {
    
    /*导入*/
    private $feofl;         //导入状态标记
    private $parameter  = array();      //自定义字段信息
    private $title      = array();      //表格标头
    private $addinfo    = array();      //准备入库的sql
    private $errorinfo  = array();      //错误记录

    private $inoutnum   = array();      //商品编号
    private $numall     = array();      //全部商品编号，验证使用
    private $errorfile;                 //错误文件路径

    public function __construct() {
        global $_M;
        parent::__construct();
    }

    //批量导入（初始化）
    public function doaddcsvdr() {
        global $_M,$_YW;
        parent::doconfig('donav');
        nav::select_nav(10);
        
        #安全设置添加CSV格式
        $cvsarr = stringto_array($_M['config']['met_file_format'],'|');
        if(!in_array('csv',$cvsarr)){
            $cvsarr[]    = 'csv';
            $csvstr  = arrayto_string($cvsarr,'|');
            $field   = "value = '{$csvstr}' ";
            $where    = "name = 'met_file_format' AND lang = '{$_M['lang']}' ";
            parent::amendsql($_M['table']['config'],$field,$where);
        }

        require $this->template('own/inout');
    }
    
    //导入文件存放
    public function doaddcvsajax() {
        global $_M,$_YW;
        if($_YW['c']['csvfile']){
            $this->delfile($_YW['c']['csvfile']);                  //检查并删除上次上传的文件(获取因为某种因素没有执行完成)
        }
        
        //存入的一次执行的行数
        if(!$_M['form']['csvhs']) $_M['form']['csvhs'] = 1000;
        cloud::addconsql('csvhs', $_M['form']['csvhs']);
        
        $upfile = load::sys_class('upfile', 'new'); //加载上传类
        $upfile->set_upfile();                      //设置文件上传模式
        $upfile->set('format','csv');               //设置允许上传文件的后缀名
        $ret = $upfile->upload('mycsv');            //上传文件
        if ($ret['error'] == 0) {
            $file = $ret['path']; 
            cloud::addconsql('csvfile', $file);                  //文件存放地址入库（临时存放）
            $line   = self::filelength($file) - 1;           //文件行数
            echo self::ajaxfh('2','1',$line,'0',self::round($line,'1')+1,0);
            exit(0);
        } else {
            echo self::ajaxfh($ret['errorcode'],'0');
            exit(0);
        }
    }
    
    //ajax导入主函数
    public function doaddajax() {
        global $_M,$_YW;
        self::csvtemplate();
        $num    = $_M['form']['num'];
        $error  = $_M['form']['error'];
        $this->errorfile  = PATH_APP_FILE.'lang/error.csv';
        if($error == 0){
            self::csvsccw();
        }
        
        $file = $this->csv_get_lines($_YW['c']['csvfile'],$_YW['c']['csvhs'], $num);      //获取的数据
        $i  = $e = 0;
        foreach ($file as $key => $val) {
            if ($val != '') {
                if (!is_strempty(self::cvsdryz($val))) {
                    self::sqlinfo($val);
                }else{
                    $error++;
                    $e++;
                }
                $i++;
                if($i >= 50 || $key == count($file) -1 ){
                    $i  = 0;
                    self::cvssql();
                    if($e){
                        self::errorcsv();
                        $e  = 0;
                    }
                }
            }
            $num = $num + 1;    //记录执行了多少条
        }
        
        usleep(100); //整理要返回给ajax的内容
        $line = $_M['form']['line'];
        $baifen = self::round($line, $num);    //百分比数据
        if ($this->feofl) {
            $state = '0';
            $baifen = '100';
            $this->delfile($_YW['c']['csvfile']);      //删除上传的文件
            cloud::addconsql('csvfile', '');      //清空赋值
        } else {
            $state = '2';
        }
        
        echo self::ajaxfh($state, '1', $line, $num, $baifen, $error);
        ob_flush(); 
        flush();
        exit(0);
    }
    
    /**
     * csv_get_lines 读取CSV文件中的某几行数据
     * @param $csvfile csv文件路径
     * @param $lines 读取行数
     * @param $offset 起始行数
     * @return array
     * */
    private function csv_get_lines($csvfile, $lines, $offset = 0) {
        global $_M,$_YW;
        if (!$fp = fopen($csvfile, 'r')) {
            return false;
        }
        $i = $j = 0;
        while (false !== ($line = fgets($fp))) {
            if ($i++ < $offset) {
                continue;
            }
            break;
        }
        $y  = 0;
        $sql = self::csvarr(); //获取基础数组
        while (($j++ < $lines) && !feof($fp)) {
            $data = fgetcsv($fp);
            $x = 0;
            foreach ($data as $key => $val) {
                $arr[$y][$sql[$x]] = iconv('GBK', 'utf-8', $val);
//                if($sql[$x] == 'code')  $arr[$y][$sql[$x]] = self::inoutcodeformatting($arr[$y][$sql[$x]]);
                $x++;
            }
            $y++;
        }
        //判断是否到了末尾
        if(feof($fp)){
            $this->feofl    = true;
        }
        fclose($fp);
        return $arr;
    }
    
    //数据整理
    private function sqlinfo($val) {
        global $_M;
        if($val['num'] == ''){
            $val['num'] = self::cknuminfo();
            $this->numall[] = $val['num'];
        }
        $this->inoutnum[] = $val['num'];
        
        if($val['code'] == ''){
            $val['code']    =  arrayto_string($this->codemake(),'$$$$');
        }else{
            foreach (stringto_array($val['code'],'$$$$') as $v) {
                $str    = cloud::codeformatting($v);
                $this->code[]  = $str;
                $code[] = $str;
            }
            $val['code']    = arrayto_string($code,'$$$$');
        }
        $this->addinfo[]    = $val;
        
    }
    
    //编号生成
    private function cknuminfo() {
        if(is_strempty($this->numall)){
            $a  = end($this->numall);
        }else{
            $a  = cloud::codenum('num');
            if (!$a) {
                $a = '1000000000';
            }
        }
        
        do{
            $a++;
            $a  = self::cknum($a);
        } while (cloud::codenum('num',$a) != false);
        
        return $a;
    }
    
    //编码验证
    private function cknum($num) {
        if(in_array($num,$this->numall)){
            $num++;
            self::cknum($num);
        }
        return $num;
    }

    //导入文件验证
    private function cvsdryz($val) {
        global $_M,$_YW;
        $val['error']   = '';
        //判断标题
        if ($val['title'] == '') {
            $a[] = $_YW['t']['yw122'];
        }
        
        //判断商品编号
        if($val['num']){
            if(is_number($val['num'])){
                if (cloud::codenum('num',$val['num']) != false) {
                    $a[] = $_YW['t']['yw123'];
                }else{
                    if(in_array($val['num'],$this->numall)) $a[] = $_YW['t']['yw123'];
                }
                $this->numall[]   = $val['num'];
            }else{
                $a[] = $val['num'].$_YW['t']['yw303'];
            }
        }
        
        //判断防伪码
        if($val['code'] != ''){
            $array  = stringto_array($val['code'],'$$$$');
            if (count($array) == count(array_unique($array))) {
                foreach ($array as $v) {
                    $code   = cloud::ckcode(cloud::codeformatting($v));
                    if ($code['ck'] != 1) {
                        $a[] = $v.$code['info'];
                    }else{
                        if(in_array($v,  $this->code)) $a[] = $v.$_YW['t']['yw304'];
                    }
                }
            }else{
                $a[] = $_YW['t']['yw305'];
            }
        }
        
        $val['error']    =   arrayto_string($a, '、');
        if($val['error'] != ''){
            $this->errorinfo[]  = $val;
        }
        return $val['error'];
    }

    //生成错误文件
    private function errorcsv() {
        global $_M;
        foreach ($this->errorinfo as $val) {
            $str[] = Aarrfi($val, ',');
        }
        
        $nr = iconv('utf-8', 'GBK', arrayto_string($str,"\r\n"));
        Axrfile($this->errorfile, "\r\n".$nr, false);       //记录到文件，不覆盖
        $this->errorinfo    = array();
    }

    //生成记录错误的文件--标题
    private function csvsccw() {
        global $_M,$_YW;
        $title  = $this->title;
        $title[]    = $_YW['t']['yw121'];
        $str = iconv('utf-8', 'GBK', arrayto_string($title, ','));
        Axrfile($this->errorfile, $str, true); //覆盖
    }
    
    //固定字段信息补充
    private function info() {
        global $_M;
        return   array(
            'issue'         =>  Agly(),
            'addtime'       =>  Atime('1'),
            'amendtime'     =>  Atime('1'),
        );
    }

    //入库处理
    private function cvssql() {
        global $_M,$_YW;
        //获取补充数组
        $infofield  = self::info();
        
        //获取info表
        foreach ($this->addinfo as $val) {
            $field[]   = "('{$val['title']}','{$val['num']}','{$val['info']}','{$val['content']}','{$infofield['issue']}','{$infofield['addtime']}','{$infofield['amendtime']}','{$_M['lang']}')";
        }
        $str    = arrayto_string($field,',');
        
        if($str){
            DB::query("INSERT INTO {$_YW['k']['info']} (title,num,info,content,issue,addtime,amendtime,lang) values {$str} ");
            usleep(5);
            //获取info表填写ID
            $num    = arrayto_string($this->inoutnum,',');
            $query  = "SELECT id,num FROM {$_YW['k']['info']} where num IN ($num) ";
            $info   = DB::get_all($query);
            $info   = array_column($info, 'id','num');
            $this->inoutnum = $this->numall = array();
            
            //code//ZDY
            $field  = array();
            $i  = 0;
            foreach ($this->addinfo as $key => $val) {
                foreach (stringto_array($val['code'],'$$$$') as $vc) {
                    $code[]   = "('{$vc}','{$info[$val['num']]}','{$_M['lang']}')";
                }
                foreach ($this->parameter as $k => $v) {
                    if($val['zdy_' . $k] != ''){
                        $field[]  = "('{$info[$val['num']]}','{$k}','{$val['zdy_' . $k]}','{$v['name']}','{$_M['lang']}')";
                    }
                }
                $i++;
                if($i >= 500 || $key == count($this->addinfo) -1 ){
                    $i = 0;
                    $str    = arrayto_string($code,',');
                    DB::query("INSERT INTO {$_YW['k']['code']} (code,info_id,lang) values {$str} ");

                    $str    = arrayto_string($field,',');
                    DB::query("INSERT INTO {$_YW['k']['plist']} (listid,paraid,info,imgname,lang) values {$str} ");
                    $code   = $field = array();
                }
            }
        }

        $this->addinfo  = $this->code = array();
    }


    /**********************************************************************************
     * 
     *                               导出文件格式
     * 
     * *******************************************************************************/
    
    //导出数据//导出标准格式
    public function doaddupcvs() {
        global $_M,$_YW;
        self::csvtemplate();
        //文件名
        $file_name = iconv("utf-8", "GBK", $_YW['t']['yw127']);
        $csv_name = $file_name . '.csv';
        //准备内容
        $zfc = Aarrfi($this->title, ',');   //arrayto_string()可使用他替换
        $str = iconv('utf-8', 'GBK', $zfc);
        //导出CSV文件
        $this->export_csv($csv_name, $str);
    }

    //输出指定格式的文件
    private function export_csv($filename, $data) {
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=" . $filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $data;
    }
    
    
    /*****************************************************************************
     * 
     * 函数
     * 
     *****************************************************************************/
    
    //计算CSV文件内容多少行
    private function filelength($file) {
        global $_M;
        $fl = fopen($file,'r');
        $i  = 0;
        while(!feof($fl)){
            fgets($fl);
            $i++;
        }
        fclose($fl);
        return $i;
    }
    
    //计算百分比 四舍五入
    private function round($zong,$fen) {
        global $_M;
        $a  = round(($fen/$zong)*100,0);//四舍五入成整数
        return $a;
    }
    
    //ajax返回的状态信息（进度条专用）
    private function ajaxfh($state,$qstate,$line = '',$num = '',$baifen = '',$error = '',$content = '') {
        global $_M;
        if($qstate != '0'){
            $arr = array( 
                'state'=>$state,        //运行状态 0：停止运行 1：提交的form 2：执行循环，数据检测，查错或者入库
                'line'=>$line,          //总行数
                'num'=>$num,            //第几行
                'baifen'=>$baifen,      //百分比数
                'error'=>$error,      //返回错误行数
                'content'=>$content     //返回的内容
            );
        }  else {
            $arr = array( 
                'qstate'=>$qstate,      //前台状态 弹窗或者在原来页面打印 0：弹窗 1：页面输出
                'content'=>$state     //返回的内容
            );
        }
        return jsoncallback($arr);
    }
    
    //导入基础数组整理
    private function csvarr() {
        global $_M;
        $i  = 0;
        foreach ($this->title as $k => $v) {
            $arr[$i]    = $k;
            $i++;
        }
        return $arr;
    }
    
    //导入导出数组(管理员、新增时间、更新时间除外)
    private function csvtemplate() {
        global $_M,$_YW;
        $arr    = array(
            'title'         => $_YW['t']['yw306'],
            'num'           => $_YW['t']['yw015'],
            'code'          => $_YW['t']['yw014'],
            'info'          => $_YW['t']['yw024'],
            'content'       => $_YW['t']['yw307'],
        );
        $zdy    = self::zdytitle();
        if(is_arrempty($zdy)){
            $arr  = array_merge($arr,$zdy); //php小BUG 有数组为空时，数组合并会不返回任何值
        }
        $this->title    = $arr;
    }
    
    /*
     * 导入导出数组
     * 不加任何排序，这样可以更好的组织内容录入，防止编个编辑后，后台调整了排序，还需要再调整表格
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