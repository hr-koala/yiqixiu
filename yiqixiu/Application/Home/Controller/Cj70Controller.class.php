<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");
ini_set("max_execution_time",0);

class Cj70Controller extends Controller {
    public function index() {
		if(!isset($_SESSION['adminUser'])){
			exit();
		}
		$cs = trim($_GET['cs']);
		
		if(strpos($cs,'-')){
			//$csa = str_replace('-A','',$cs);
			$arrc = explode("-",$cs);
			$csa = $arrc[0];
			//die('-');
			$sceneid=$this->getSceneId($csa);
		}else{
			//die('0');
			$sceneid=$this->getSceneId($cs);
		}
		//die($sceneid);

        $user = M("scene");
		//die(var_dump($cs)); 
        $where['eqcode'] = $cs;
        $code = $user->where($where)->select();
		$url = 'http://www.70c.com/As/getAs?sceneid=' . $sceneid.'&objID=&p=0'.'&parameter='.$cs;
		
        $da = $this->GetCurlnew($url,$cs);
		 

		$da=str_replace(array(',"trigger":{}','70C.COM','i.70c.com','70c.com','70度'),array('',C('site_name'),C('site_name'),C('site_name'),C('site_name')),$da);
		//if(C('ISLOG')) \Think\Log::write($url.'str_replace后'.var_export($da,true)."\n"); 
		//$da = str_replace(,'',$da);
		//exit($da);
        $img = './Uploads/syspic/scene70/';
        $img2 = './Uploads/';
        $mp3 = './Uploads/syspic/mp370/';
        $resp = json_decode($da, true);
		//if(C('ISLOG')) 
		\Think\Log::write('resp = json_decode($da返回'.var_export($resp,true)."\n url:".$url." -----------\n"); 
		
		if($resp == null){
			echo json_encode(array(
				"msg" => "官方返回的数据为空!，请稍后再试!"
				));
			exit;	
		  	
		}
		
		
        if (empty($code) and $resp[obj][name] !== '该场景已关闭') {
			 //cloudapppic/2015/5/28/445bbbd03c4a2d88.png
			  //http://res.70c.com/cloudappmp3/2015/4/20/2f48ce529b68a81f.mp3
			  //images/sceneedit/solidcolor/c16c5d62f891d55d1fa68be7f66d80496e83ce49c3ae-TBJYXX_fw658.jpg
			 //preg_match_all("/cloudapppic(\\/\\w+)*\.(gif|jpg|jpeg|png|bmp)/isu", $eqxcjt, $preg_pic);
			//$da = 'http://res.70c.com/cloudapppic/crop/2015/8/5/4ffc0e82e70af299.png';
			preg_match_all("/((cloudapppic(\\/\\w+)*\.(gif|jpg|jpeg|png|bmp|svg)))/isu", $da, $array); 
			//echo json_encode(array(
			//	"msg" => $array
			//	));
			//exit;			
			preg_match_all("/((images(\\/\\w+)*\.(gif|jpg|jpeg|png|bmp|svg|jpe)))/isu", $da, $array2); 
			
			$pic_bg=array_merge($array[0],$array2[0]);
			
			$src2 = 'syspic/scene70/'; 
			 
		if(C('ISLOG')) \Think\Log::write('要下载易企秀的图片'.var_export($pic_bg,true)."\n\n -----------\n"); 
			
			 $src3 = preg_replace(array('/(cloudapppic(\\/\\w+)*\/)/','(images(\\/\\w+)*\/)'), $src2, $da);
		 	
            $resp2 = json_decode($src3, true);
 			
			if(C('ISLOG'))  \Think\Log::write('$resp2 = syspic/scene/后'.var_export($resp2,true)."\n\n -----------\n"); 
			

            foreach ($pic_bg as $key => $var) {
                $urls[$key] = pathinfo($pic_bg[$key]);
                $this->save_pic('http://res.70c.com/' . $var, $img);

            }
            $data['scenename_varchar'] = $resp['obj']['name'];
            $data['scenecode_varchar'] = 'S' . (date('y', time()) - 9) . date('m', time()) . randorderno(6, -1);
            $data['eqid_int'] = $resp['obj']['id'];
            $data['eqcode'] =$cs;// $resp['obj']['code'];
            $data['createtime_time'] = date('Y-m-d H:i:s', time());
            $data['showstatus_int'] = 1;
            $data['movietype_int'] = 0;
			$data['userid_int'] =0;
 
			//$str=str_replace('\\"','"',$resp['obj']['bgAudio']);		
		    //$resp['obj']['bgAudio']=json_decode($str,true);
			if (!empty($resp['obj']['image']['bgAudio']['url'])) {
				if (preg_match('|^http://|', $resp['obj']['image']['bgAudio']['url'])) {
					$mp = $resp['obj']['image']['bgAudio']['url'];
				} elseif (isset($resp['obj']['image']['bgAudio']['url'])) {
					$mp = 'http://res.70c.com/' . $resp['obj']['image']['bgAudio']['url'];
				}
				$data['musicurl_varchar'] = 'syspic/mp370/' . $this->save_pic($mp, $mp3);
			 } else {
			}
			
            $pic1 = 'http://res.70c.com/' . $resp['obj']['image']['imgSrc'];
            $data['thumbnail_varchar'] = 'syspic/scene70/' . $this->save_pic($pic1, $img);
            $data['scenetype_int'] = $resp['obj']['type'];
			$data['is_tpl'] = 1;
            $data['desc_varchar'] = $resp['obj']['description'];
            $data['biztype_int'] = $resp['obj']['type'];
            $data['musictype_int'] = $resp['obj']['image']['bgAudio']['type'];
            $data['musictype_int'] = (empty($resp['obj']['image']['bgAudio']['type'])) ? 'null' : $data['musictype_int'];
			
			//2015-5-25
			$data['scenetype_int']= $_GET['scenetypeB'] ? intval($_GET['scenetypeB']) :'101';
			$data['tagid_int']= $_GET['scenetypeS'] ? intval($_GET['scenetypeS']) :'20';			
			
			//\Think\Log::write('$_GET ：'. D('')->getLastSql()."\n".var_export($_GET,true)."\n\n -----------\n");
			if(C('ISLOG')) \Think\Log::write('78$data'.var_export($data,true)); 
			
            if ($lastInsId = $user->add($data)) {
				if(C('ISLOG'))  \Think\Log::write('scene 表'. D('')->getLastSql()."\n".var_export($data,true)."\n\n -----------\n");
				//2015-5-25
				if($data['musicurl_varchar']&& $_GET['isMusicToSys']){
					$fileData=array(
						'userid_int'=>0,
						'filetype_int'=>2,
						'filesrc_varchar'=>$data['musicurl_varchar'],
						'create_time'=>date('y-m-d H:i:s',time()),
						'biztype_int'=>1,
						'filename_varchar'=>'模板采集ID为'.$lastInsId.'的音乐',
						'ext_varchar'=>'MP3'
						
						);
					M('upfilesys')->add($fileData);	
						
					//\Think\Log::write('upfilesys 表'. D('')->getLastSql()."\n".var_export($fileData,true));
					
				}
				
				
				
                echo json_encode(array(
                    "msg" => "成功采集",
                    "url" => 'http://' . $_SERVER['HTTP_HOST'] . '/v-' . $data['scenecode_varchar']
                ));
            } else {
			    //die(var_dump("数据写入错误"));
				\Think\Log::write("-------------------------------\n".'数据写入错误,sql：'.D('')->getLastSql()."\n"); 
                echo json_encode(array(
                    "msg" => "数据写入错误"
                ));
            }
			if($lastInsId){
				$dd = M("scenepage");
				$de['sceneid_bigint'] = $lastInsId;
				$de['scenecode_varchar'] = $cs;
				$de['createtime_time'] = date('Y-m-d H:i:s', time());
				$de['content_text'] = '';
				$de['pagename_varchar'] = 'admin';
				$de['userid_int'] =0;   
				$de['properties_text'] = 'null';
				foreach ($resp2['list'] as $k => $var) {
					$tttt=$var['elements'];
					
					
					$de['content_text'] = json_encode($tttt);
					$de['pagecurrentnum_int'] = $k + 1;
					$dd->add($de);
				}
			} 
        } elseif (isset($_GET['cpic'])) {
            $dd = M("scenepage");
            $where['sceneid_bigint'] = $_GET['id'];
            $data = $dd->where($where)->field('content_text')->select();
        } else {
            if (!empty($code[0][scenecode_varchar])) {
                echo json_encode(array(
                    "msg" => "已经存在",
                    "url" => 'http://' . $_SERVER['HTTP_HOST'] . '/v-' . $code[0][scenecode_varchar]
                ));
            } else {
                echo json_encode(array(
                    "msg" => "参数不对"
                ));
            }
        }
    }
    public function searchMultiArray(array $array, $search, $mode = 'key') {
        $res = array();
        foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
            if ($search === $ {
                $ {
                    "mode"
                }
            }) {
                if ($mode == 'key') {
                    $res[] = $value;
                } else {
                    $res[] = $key;
                }
            }
        }
        return $res;
    }
    public function my_file_exists($file) {
        if (preg_match('/^http:\/\//', $file)) {
            if (ini_get('allow_url_fopen')) {
                if (@fopen($file, 'r')) return true;
            } else {
                $parseurl = parse_url($file);
                $host = $parseurl['host'];
                $path = $parseurl['path'];
                $fp = fsockopen($host, 80, $errno, $errstr, 10);
                if (!$fp) return false;
                fputs($fp, "GET {$path} HTTP/1.1 \r\nhost:{$host}\r\n\r\n");
                if (preg_match('/HTTP\/1.1 200/', fgets($fp, 1024))) return true;
            }
            return false;
        }
        return file_exists($file);
    }
	public function getSceneId($code){
		$sceneid='';
		$search[]='/A/i';	$replace[]='0';
		$search[]='/C/i';	$replace[]='1';
		$search[]='/F/i';	$replace[]='2';
		$search[]='/Z/i';	$replace[]='3';
		$search[]='/W/i';	$replace[]='4';
		$search[]='/G/i';	$replace[]='5';
		$search[]='/J/i';	$replace[]='6';
		$search[]='/Q/i';	$replace[]='7';
		$search[]='/Y/i';	$replace[]='8';
		$search[]='/S/i';	$replace[]='9';
		
		$sceneid= preg_replace($search,$replace,$code);
		return $sceneid;
	}
    public function save_pic($url, $savepath = '') {
		//$url='http://res.70c.com/cloudapppic/crop/2015/8/5/4ffc0e82e70af299.png';
		 $filename = $this->get_filename($url);

	 if(file_exists($savepath.$filename)){
		  \Think\Log::write('已存在的图片地址：'.$url."\n"); 
		 return $filename;
	 }
        $url = trim($url);
        $url = str_replace(" ", "%20", $url);
			
        $string = $this->read_filetext($url);
        if (empty($string)) {
				\Think\Log::write("-------------------------------\n".'读取不了文件,地址：'.$url."\n"); 
           // echo '读取不了文件';
             return $filename;
        }
       
        $this->make_dir($savepath);
        $filepath = $savepath . $filename;
		//		 echo json_encode(array(
		//		"msg" => $filepath
		//		));
		//	exit;
        $this->write_filetext($filepath, $string);
        return $filename;
    }
    public function get_filename($filepath) {
        $fr = explode("/", $filepath);
        $count = count($fr) - 1;

        return $fr[$count];
    }
    public function read_filetext($filepath) {
		
        $filepath = trim($filepath);
        $htmlfp = @fopen($filepath, "r");
        if (strstr($filepath, "://")) {
            while ($data = @fread($htmlfp, 500000)) {
                $string.= $data;
            }
        } else {
            $string = @fread($htmlfp, @filesize($filepath));
        }
        @fclose($htmlfp);
        return $string;
    }
    public function write_filetext($filepath, $string) {

        $fp = @fopen($filepath, "w");
        @fputs($fp, $string);
        @fclose($fp);
    }
    public function make_dir($path) {
        if (!file_exists($path)) {
            $mk = @mkdir($path, 0777, true);
            @chmod($path, 0777);
        }
        return true;
    }
	public function GetCurlnew($url,$cs) {
        $curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_REFERER, 'http://www.70c.com/w/'.$cs);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
	
    public function GetCurl($url) {
        $curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
} ?>
