<?php 
namespace Adminc\Controller;
use Adminc\Controller\BaseController;
header("Content-Type: text/html;charset=utf-8");
ini_set("max_execution_time",0);
class CjsysController extends BaseController
{
    public function index()
    {
		
		$ui['yxcj'] = 'active';
        $this->assign('ui',$ui);  
        $this -> display();
    } 

    public function yxcj()
    {
        $files = M('upfilesys');
        $cookie = tempnam('./cache', 'cookie');
        $img = './Uploads/syspic/yx/';
        $img2 = 'syspic/yx/';
        login_post($cookie);
        //$url2 = 'http://vservice.eqxiu.com/m/base/file/sysList?pageNo=1&pageSize=100&fileType=4&bizType=1&time=1435230963297';
        $url2 = 'http://vservice.eqxiu.com/m/base/file/sysList?pageNo=1&pageSize=10&fileType=4&bizType=0&time=1467728043910';
        $list = get_content($url2, $cookie);
        $list = json_decode($list, true);
		//var_dump($list);die;
        @ unlink($cookie);
        $i = 0;
		$y = 0;
        foreach ($list['list'] as $key => $data)
        {
            $file['filetype_int'] = $data['fileType'];
            $file['biztype_int'] = $data['bizType'];
            $file['create_time'] = date('Y-m-d H:i:s', time());
            $file['userid_int'] = 0; 
            $file['filename_varchar'] = $data['name'];
            $file['ext_varchar'] = $data['extName']; 
            $where['filename_varchar']=$data['name'];
            $temp = $files -> where($where) -> find();
            if(empty($temp)){
				$file['filesrc_varchar'] = $img2 . $this->save_pic('http://res.eqh5.com/' . $data['path'], $img);
				//echo $file['filesrc_varchar'];die;
            }

            //$this->ajaxReturn($i);
            //  print_r($file);exit;

            if(empty($temp)){
				$y++;
                $files -> add($file); 
            }else{
				$i++;
			}
            
        } 
         $this->success('本次增加' . $y . '个系统音效'.$i.'个已采集。');       
       
    } 
    public function sccj()
    {
        $files = M('upfilesys');
        $img = './Uploads/syspic/picnew/';
        $img2 = 'syspic/picnew/';
        $pageno = I('post.pageno', 1);
        $biztype = I('post.biztype');
        $tagid = I('post.tagid');
        $pagesize = I('post.pagesize', 999);
        $filetype = I('post.filetype', 1);
		if($filetype==0)
			$filetype = 1;
        $cookie = tempnam('./cache', 'cookie');
        $url2 = 'http://vservice.eqxiu.com/m/base/file/sysList?pageNo=' . $pageno . '&pageSize=' . $pagesize . '&fileType=' . $filetype . '&bizType=' . $biztype . '&tagId=' . $tagid . '&time=' . time();
        login_post($cookie);
        $list = get_content($url2, $cookie);
        $list = json_decode($list, true);
        $i = 0;
        foreach ($list['list'] as $var)
        {
            $i++;
            $pic = $files -> field('eqsrcthumb_varchar') -> where(array('eqsrcthumb_varchar' => $var['path'])) -> find();
            $data['userid_int'] = 0;
            $data['filename_varchar'] = $var['name'];
            $data['ext_varchar'] = $var['extName'];
            $data['filetype_int'] = $filetype;
            $data['biztype_int'] = $biztype;
            $data['tagid_int'] = $tagid;
            if (empty($pic))
            {
                $data['filesrc_varchar'] = $img2 . $this->save_pic('http://res.eqh5.com/' . $var['path'], $img);
                $data['filethumbsrc_varchar'] = $img2 . $this->save_pic('http://res.eqh5.com/' . $var['tmbPath'], $img);
            } 
            $data['eqsrcthumb_varchar'] = $var['path'];
            $data['create_time'] = date('Y-m-d H:i:s', time());
            if (empty($pic))
            {
                $files -> add($data);
            } 
        } 
        echo '本次更新' . $i . '个';
        @ unlink($cookie);
    } 

	public function cjtag(){
		$i = 0;
		$cookie = tempnam('./cache', 'cookie'); 
		login_post($cookie); 
		$url = 'http://vservice.eqxiu.com/m/base/file/tag/sys?bizType=8203';
		$list = get_content($url, $cookie);
		//die($list);
		$list = json_decode($list,true);
		foreach($list['list'] as $var){
			$data['tagid_int'] = $var['id'];
			$data['userid_int'] = 0;
			$data['name_varchar'] = $var['name'];
			$data['biztype_int'] = $var['bizType'];
			$data['type_int'] = 3;
			$data['create_time'] = date('Y-m-d H:i:s', time());
			$tag = M('tag');
			$where['tagid_int'] = $var['id'];
			$temp = $tag -> cache(true) ->where($where) -> find();
            if (empty($temp))
            {
				$i++;
                $tag -> add($data);
            } 
		}
		//echo '系统分类总更新<b>' . $i . '</b>个'; 
	}
	
    public function cjsys(){
		//$this->cjtag();
        $_post = I('post.');
        $scenepagesys = M('scenepagesys');
        $img = './Uploads/syspic/page/';
        $img2 = 'syspic/page/';
        $src2 = 'syspic/page/';
        // 设置cookie保存路径
        $cookie = tempnam('./cache', 'cookie'); 
		login_post($cookie);
        $url2 = 'http://vservice.eqxiu.com/m/scene/tpl/page/list/';
		$tagid = 1140;
		$i = 0;
		for($n = 0;$n <= 26;$n++){
			$post = array ('tagId' => $tagid + $n,
				'pageNo' => '1',
				'pageSize' => '100'
			);
			$list = $this->PostCurl($url2,$post,$cookie);
			//echo $list;die;
			$list = json_decode($list, true);
			S('_list', null);
			S('_list', $list);
			$list = S('_list');
			foreach ($list['list'] as $var)
			{
				//echo '当前循环第：<b>' . $i . $var['id'] . $var['name'] . '</b>次';
				$urls = 'http://vservice.eqxiu.com/m/scene/pageTpl/' . $var['id'];
				$content = get_content($urls, $cookie);
				//var_dump($var);die;
				//echo $content;die;
				preg_match_all("/\"(\w+|)(s|S)rc\":\"[\s\S]*?\"/isu", $content, $array);
				$array[0] = array_unique($array[0]);
				foreach ($array[0] as $key => $varn) {				
					$vars = $this->getNeedBetween($varn,':"','"',2);				
					$filepath[$key] = $vars;
					$filename[$key] = $this->get_filename($vars);              
				}
				$filepath = array_unique($filepath);
				foreach ($filepath as $key => $varx) {
					if(strstr($varx,"iframe")){
						unset($filepath[$key]);
					}
				}
				//var_dump($filepath);die;
				foreach ($filepath as $key => $vary) {
					$content = str_replace($vary, $src2.$this->get_filename($vary), $content);
					if(preg_match('|^http://|', $vary)){
						$this->save_pic($vary, $img);
					}else{
						$this->save_pic('http://res.eqh5.com/' . $vary, $img);
					}  
				}
				$content = preg_replace("/(syspic\/scene\/){2,}/",$src2,$content);
				$content = preg_replace("/(\.\w+){2,}/",'$1',$content);
				//echo $content;die;
				// preg_match_all("/((group\d\/\w+\/\w+\/\w+\/\w+(-\\w+)*+.(gif|jpg|jpeg|png|bmp|svg)))/isu", $content , $array);
				// $src3 = preg_replace("/(group\d\/\w+\/\w+\/\w+\/)/", $src2, $content);
				
				// foreach ($array[0] as $key => $_var)
				// {
					// $this->save_pic('http://res.eqh5.com/' . $_var, $img);
				// } 
				$content = json_decode(trim($content,chr(239).chr(187).chr(191)), true);
				//$content = json_decode($src3, true);
				$data['sceneid_bigint'] = $var['sceneId'];
				$data['pagename_varchar'] = $var['name'];
				//var_dump($var);die;
				$data['thumbsrc_varchar'] = $img2 . $this->save_pic('http://res.eqh5.com/' . $var['properties']['thumbSrc'], $img);
				$data['tagid_int'] = $tagid + $n;
				$data['eqsrc_varchar'] = $var['properties']['thumbSrc'];
				$data['biztype_int'] = $var['sceneId'];
				$data['pagecurrentnum_int'] = $var['num'];
				$data['eqid_int'] = $var['id'];
				$data['scenecode_varchar'] = $var['id'];
				$data['userid_int'] = 0;
				$data['createtime_time'] = date('Y-m-d H:i:s', time());
				$data['content_text'] = json_encode($content['obj']['elements']);
				$where['eqid_int'] = $var['id'];
				$temp = $scenepagesys ->where($where) -> find();
				if (empty($temp)){
					$i++; 
					$scenepagesys -> add($data);
				}else{
					$result = strstr($temp['tagid_int'], $data['tagid_int']);
					if(!$result){
						$savetemp = M("scenepagesys"); 
						$data2['tagid_int'] = $temp['tagid_int'].','.$data['tagid_int'];
						$savetemp->where('pageid_bigint='.$temp['pageid_bigint'])->save($data2);
					}
				}
				// if($i>10){
					// die;
				// }
				//die;
			} 
		}
		
		
        echo '系统组件总更新<b>' . $i . '</b>个'; 
        @ unlink($cookie); 
    }
	
	public function save_pic($url, $savepath = '') {
			$filename = $this->get_filename($url);
			if(file_exists($savepath.$filename)){
				 
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
			$this->write_filetext($filepath, $string);
			return $filename;
		}
    public function save_picY($url, $savepath = '') {
        $url = trim($url);
        $url = str_replace(" ", "%20", $url);
        $string = $this->read_filetext($url);
        if (empty($string)) {
				echo '读取不了文件'.$url;
            exit;
        }
        $filename = $this->get_filename($url);
        $this->make_dir($savepath);
        $filepath = $savepath . $filename;
        $this->write_filetext($filepath, $string);
        return $filename;
    }
    public function get_filename($filepath) {
		if(strstr($filepath,"?")){
			$filepath = substr($filepath,0,stripos($filepath,'?'));
		}//pppon.com
        $fr = explode("/", $filepath);
        $count = count($fr) - 1;
		if(strstr($fr[$count],".")){
			//echo $fr[$count];die;
			return $fr[$count];
		}else{
			return $fr[$count].'.'.$this->get_filetpye($filepath);
		}        
    }
	public function get_filetpye($url)
	{//pppon.com
		if(!preg_match('|^http://|', $url)){
			$url = 'http://res.eqh5.com/' . $url;
		}  
		// mime 和 扩展名 的映射
		$mimes=array(
			'image/bmp'=>'bmp',
			'image/gif'=>'gif',
			'image/jpeg'=>'jpg',
			'image/png'=>'png',
		);
		// 获取响应头
		if(($headers=get_headers($url, 1))!==false)
		{
			// 获取响应的类型
			$type=$headers['Content-Type'];
			// 如果符合我们要的类型
			if(isset($mimes[$type]))
			{
				//$fileName=uniqid();
				$ext=$mimes[$type];
			 }
		}
		return $ext;
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
	function PostCurl($url,$post,$cookie) { 
		$curl = curl_init();//初始化curl模块 
		curl_setopt($curl, CURLOPT_URL, $url);//提交的地址 
		curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//是否自动显示返回的信息 
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie); //读取cookie 
		curl_setopt($curl, CURLOPT_POST, 1);//post方式提交 
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息 
		curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36"); 
		$resp = curl_exec($curl);//执行cURL 
		curl_close($curl);//关闭cURL资源，并且释放系统资源 
		return $resp;
	} 
	public function getNeedBetween($kw1,$mark1,$mark2,$n){
		//pppon.com
		$kw = $kw1;
		$kw = '123' . $kw . '123';
		//$n = $n + 3;
		$st = stripos($kw,$mark1);
		$ed = stripos($kw,$mark2,$st);
		//echo $st."--".$ed.'----';
		if(($st==false||$ed==false)||$st>=$ed)
		return 0;
		$kw=substr($kw,($st+$n),($ed-$st-$n-3));
		return $kw;
	}
} 
