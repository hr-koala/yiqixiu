<?php
namespace Home\Controller;
use Think\Controller;
class UpfileController extends Controller {

	public function upload(){
		if(!defined('VIRIFY')){
			aboutaa();
		}
		 if(intval(session("userid"))==0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		} 
		 
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 5120000 ;// 设置附件上传大小  5M
		if(I('get.fileType',0)==2 || I('get.fileType',0)==4)
		{
			$upload->exts = array('mp3');// 设置附件上传类型
			$upload->savePath = 'mp3/'.session("userid").'/'; // 设置附件上传（子）目录
		}
		else
		{
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath = 'pic/'.session("userid").'/'; // 设置附件上传（子）目录
		}
		$upload->rootPath = './Uploads/'; // 设置附件上传根目录
		$upload->subName  = array('date','Ym');
		// 采用时间戳命名
		$upload->saveName = 'uniqid';
		// 采用GUID序列命名
		//$upload->saveName = 'guid'; 
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "文件上传错误!","obj"=> null,"map"=> null,"list"=> null));
			echo $this->error($upload->getError());
			exit;
			//$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			foreach($info as $file){
				$thubimagenew = $file['savepath'].$file['savename'];
				if(I('get.fileType',0)!=2 && I('get.fileType',0)!=4)
				{
					$image = new \Think\Image(); 
					$thubimage = $file['savepath'].$file['savename'];
					$image->open($upload->rootPath.$thubimage);
					$thubimagenew = str_replace(".".$file['ext'],"_thumb.".$file['ext'],$file['savename']);
					$thubimagenewftp =$thubimagenew;
					$thubimagenew =  $file['savepath'].$thubimagenew;
					//echo $thubimagenew; exit;
					// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
					if(I('get.fileType',0)==0)
					{
						$image->thumb(320, 486)->save($upload->rootPath.$thubimagenew);
					}
					else
					{ 
						$image->thumb(320,486)->save($upload->rootPath.$thubimagenew);
					}
				}
				$sizeint = intval($file['size']/1024);
				$jsonstr = '{"success":true,"code":200,"msg":"success","obj":{"id":9386090,"name":"'.$file['savename'].'","extName":"'.strtoupper($file['ext']).'","fileType":0,"bizType":0,"path":"'.$file['savepath'].$file['savename'].'","tmbPath":"'.$thubimagenew.'","createTime":1426209412922,"createUser":"'.session("userid").'","sort":0,"size":'.$sizeint.',"status":1},"map":null,"list":null}';
				

				
				$model = M('upfile');
				// 取得成功上传的文件信息
				// 保存当前数据对象

				$data['ext_varchar'] = strtoupper($file['ext']);
				$data['filename_varchar'] = $file['name'];
				$data['filetype_int'] = I('get.fileType',0);
				$data['biztype_int'] = I('get.bizType',0);
				$data['userid_int'] = session("userid");
				$data['filesrc_varchar'] = $file['savepath'].$file['savename'];
				$data['sizekb_int'] = $sizeint;
				$data['filethumbsrc_varchar'] = $thubimagenew;
				$data['create_time'] = date('y-m-d H:i:s',time());
				$model->add($data);
				echo $jsonstr;
			}
		}
    }
	
	public function uptokens(){
		header("Content-type: text/json; charset=utf-8"); 
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"expire":"3600","token":"JkbWPquRXw2qZpNqeM9Tja4rKlZmK0xSIoX-gOki:vR8CUXWLLZcziDfw9ose3vI4xTk=:eyJzY29wZSI6ImVxeGl1IiwicmV0dXJuQm9keSI6IntcIm5hbWVcIjogJChmbmFtZSksXCJzaXplXCI6ICQoZnNpemUpLFwid1wiOiAkKGltYWdlSW5mby53aWR0aCksXCJoXCI6ICQoaW1hZ2VJbmZvLmhlaWdodCksXCJrZXlcIjokKGtleSksXCJtaW1lTGltaXRcIjokKGltYWdlLyopfSIsImRlYWRsaW5lIjoxNDcwMTk4OTc5fQ=="},"list":null}';
	}
	public function upbase64(){
		header("Content-type: text/json; charset=utf-8"); 
		$data = file_get_contents('php://input');
		//保存base64字符串为图片
		//匹配出图片的格式
		$type = '.png';
		$basepath = 'pic/'.session("userid").'/';
		$savepath = './Uploads/'.$basepath;
		$savename = md5(uniqid());
		$new_file = $savepath.$savename.$type;
		if(file_put_contents($new_file, base64_decode($data))){
			$reinfo = $this->getImageInfo($new_file);
			//var_dump($reinfo);die;
			echo '{"name": null,"size": '.$reinfo["size"].',"w": '.$reinfo["height"].',"h": '.$reinfo["width"].',"key":"'.$basepath.$savename.$type.'","mimeLimit":null}';
		}else{
			echo '{"name": null,"size": 19926,"w": 1000,"h": 1000,"key":"FvGYN-NjKi-x8zn8uIGBULqtX_C6","mimeLimit":null}';
		}
		
		//echo $basedir;

		//echo $data;
		//echo '{"name": null,"size": 19926,"w": 1000,"h": 1000,"key":"FvGYN-NjKi-x8zn8uIGBULqtX_C6","mimeLimit":null}';
	}
	public function saveinfo(){
		header("Content-type: text/json; charset=utf-8");
		$model = M('upfile');
		// 取得成功上传的文件信息
		// 保存当前数据对象

		$data['ext_varchar'] = 'png';
		$data['filename_varchar'] = I('post.name',0);
		$data['filetype_int'] = I('post.fileType',0);
		$data['biztype_int'] = I('post.bizType',0);
		$data['userid_int'] = session("userid");
		$data['filesrc_varchar'] = I('post.path',0);
		$data['sizekb_int'] = I('post.size',0);
		$data['filethumbsrc_varchar'] = I('post.tmbPath',0);
		$data['create_time'] = date('y-m-d H:i:s',time());
		$result = $model->add($data);
		echo '{"success":true,"code":200,"msg":"操作成功","obj":{"id":'.$result.',"name":"'.$data['filename_varchar'].'","extName":"","fileType":'.$data['filetype_int'].',"bizType":'.$data['biztype_int'].',"path":"'.$data['filesrc_varchar'].'","tmbPath":"'.$data['filesrc_varchar'].'","sort":0,"size":'.$data['sizekb_int'].',"status":1,"libType":null,"delTime":null,"userType":null,"memberType":null,"price":null,"topicName":null},"map":null,"list":null}';
	}
	public function getImageInfo($img) //$img为图像文件绝对路径
	{
		$img_info = getimagesize($img);
		switch ($img_info[2]) {
			case 1:
				$imgtype = "GIF";
				break;
			case 2:
				$imgtype = "JPG";
				break;
			case 3:
				$imgtype = "PNG";
				break;
		}
		$img_type = $imgtype . "图像";
		$img_size = filesize($img); //获取文件大小
		 
		$new_img_info = array(
			"width" => $img_info[0],
			"height" => $img_info[1],
			"type" => $img_type,
			"size" => $img_size
		);
		return $new_img_info;
	}

	public function savewl(){
				
				$file =array();
				$file['savename'] = basename(I('get.url'));
				$url = I('get.url');
				$sizeint = '1.00';
				$jsonstr = '{"success":true,"code":200,"msg":"success","obj":{"id":9386090,"name":"'.$file['savename'].'","extName":"MP3","fileType":0,"bizType":0,"path":"'.$url.'","tmbPath":"'.$url.'","createTime":1426209412922,"createUser":"'.session("userid").'","sort":0,"size":'.$sizeint.',"status":1},"map":null,"list":null}';
				

				
				$model = M('upfile');
				// 取得成功上传的文件信息
				// 保存当前数据对象

				$data['ext_varchar'] = 'MP3';
				$data['filename_varchar'] = $file['savename'];
				$data['filetype_int'] = I('get.fileType',0);
				$data['biztype_int'] = 0;
				$data['userid_int'] = session("userid");
				$data['filesrc_varchar'] = $url;
				$data['sizekb_int'] = $sizeint;
				$data['filethumbsrc_varchar'] = $url;
				$data['create_time'] = date('y-m-d H:i:s',time());
				$model->add($data);
				echo $jsonstr;
	}

	function curl_post($url, $post) {  
		$options = array(  
			CURLOPT_RETURNTRANSFER => true,  
			CURLOPT_HEADER         => false,  
			CURLOPT_POST           => true,  
			CURLOPT_POSTFIELDS     => $post,  
		);  
	  
		$ch = curl_init($url);  
		curl_setopt_array($ch, $options);  
		$result = curl_exec($ch);  
		curl_close($ch);  
		return $result;  
	}  
	  

	public function userlist(){
		if(intval(session("userid"))==0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
		
		header('Content-type: text/json');
		$m_upfile = M('upfile');
		$where['userid_int']  = session("userid");
		$where['biztype_int']  = I('get.bizType',0);
		$where['filetype_int']  = I('get.fileType',0);
		if(I('get.tagId',0)>0)
		{
			$where['tagid_int']  = I('get.tagId',0);
		}
		$where['delete_int']  = 0;
		$pageshowsize = I('get.pageSize',17);
		if($pageshowsize>30){
			$pageshowsize = 30;
		}
		$m_upfilelist=$m_upfile->where($where)->order('fileid_bigint desc')->page(I('get.pageNo',1),$pageshowsize)->select();
		$m_upfile_count = $m_upfile->where($where) ->count();
		//var_dump($_scene_list);exit;     
		//$this->display();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$m_upfile_count.',"pageNo":'.I('get.pageNo',1).',"pageSize":'.$pageshowsize.'},"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["fileid_bigint"].',"name":'.json_encode($vo["filename_varchar"]).',"extName":"'.$vo["ext_varchar"].'","fileType":'.$vo["filetype_int"].',"bizType":'.$vo["biztype_int"].',"path":"'.$vo["filesrc_varchar"].'","tmbPath":"'.$vo["filethumbsrc_varchar"].'","createTime":1426209633000,"createUser":"'.$vo["userid_int"].'","sort":0,"size":'.$vo["sizekb_int"].',"status":1},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}


	public function syslist(){
		if(intval(session("userid"))==0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
		
		//header('Content-type: text/json');
		$m_upfile = M('upfilesys');
		 //音效 3.6版 
//		if(I('get.fileType',0)==4){  
//			$where['filetype_int']  = 2;
//			$where['biztype_int']  = 4;
//		}else{
			$where['filetype_int']  = I('get.fileType',0);
			
			if(I('get.bizType',0)>1){
				$where['biztype_int']  = I('get.bizType',0);
			}
		//}
		if(I('get.tagId',0)>0){
			$where['tagid_int']  = I('get.tagId',0);
		}
		
		$pageshowsize = I('get.pageSize',17);
		if($pageshowsize>40){
			$pageshowsize = 40;
		}
		$m_upfilelist=$m_upfile->where($where)->order('fileid_bigint ASC')->page(I('get.pageNo',1),$pageshowsize)->select();
			 
		 
		$m_upfile_count = $m_upfile->where($where) ->count();
		//var_dump($_scene_list);exit;     
		//$this->display();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":{"count":'.$m_upfile_count.',"pageNo":'.I('get.pageNo',1).',"pageSize":'.$pageshowsize.'},"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["fileid_bigint"].',"name":'.json_encode($vo["filename_varchar"]).',"extName":"'.$vo["ext_varchar"].'","fileType":'.$vo["filetype_int"].',"bizType":'.$vo["biztype_int"].',"path":"'.$vo["filesrc_varchar"].'","tmbPath":"'.$vo["filethumbsrc_varchar"].'","createTime":1426209633000,"createUser":"'.$vo["userid_int"].'","sort":0,"size":'.$vo["sizekb_int"].',"status":1},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}

	 
	public function systag(){
		
		//header('Content-type: text/json');
		$m_upfile = M('tag');
		$where['userid_int']  = 0;
		if(I('get.type',0)==1){
			$where['type_int']=1;
		}
		if(I('get.type',0)==2){
			$where['type_int']=2;
		}
		if(I('get.type',0)==88){
			$where['type_int']=88;
		}
        if(I('get.bizType',0)!=''){
			 
		  $where['biztype_int']  = I('get.bizType',0);
        }
		$pageshowsize = 30;

			$m_upfilelist=$m_upfile->where($where)->order('groupid_int asc,sort asc, tagid_int asc')->select();
		
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
		{ 

				$vo["biztype_int"]=$vo["biztype_int"]?intval($vo["biztype_int"]):0;
				$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].',"groupId":'.$vo["groupid_int"].'},';
			
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}

 
	public function systpltag(){
		if(intval(session("userid"))==0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 error');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
		
		//header('Content-type: text/json');
		$m_upfile = M('tag');
		$where['userid_int']  = 0;
		$where['type_int']  = 88;
		$where['biztype_int']  = I('get.bizType',0);
		$pageshowsize = 30;
		$m_upfilelist=$m_upfile->where($where)->order('tagid_int asc')->select();
		//var_dump($_scene_list);exit;     
		//$this->display();
		$jsonstr = '{"success":true,"code":200,"msg":"success","obj":null,"map":null,"list":[';
		$jsonstrtemp = '';
		foreach($m_upfilelist as $vo)
        {
			$jsonstrtemp = $jsonstrtemp .'{"id":'.$vo["tagid_int"].',"name":'.json_encode($vo["name_varchar"]).',"createUser":"0","createTime":1423122412000,"bizType":'.$vo["biztype_int"].'},';
		}
		$jsonstr = $jsonstr.rtrim($jsonstrtemp,',').'';
		$jsonstr = $jsonstr.']}';
		
		echo $jsonstr; 
		
	}


    public function delete(){
		$m_file = M("upfile");
		$map['fileid_bigint']= array('in',I('post.id',0));
		if(intval(session('userid'))!=1)
		{
			$map['userid_int']  = intval(session('userid'));
		}
		$fileinfo=$m_file->where($map)->select();

		if($fileinfo)
		{
			
			try {
				//$fullpath="./Uploads/".$fileinfo[0]["filethumbsrc_varchar"];
				//unlink($fullpath);
			} catch (Exception $e) {}
			try {
				//$fullpath="./Uploads/".$fileinfo[0]["filesrc_varchar"];
				//unlink($fullpath);
			} catch (Exception $e) {   

				$datainfo['delete_int'] = 1;
				$m_file->data($datainfo)->where($map)->save();

				//$m_file->where($map)->delete();
				echo json_encode(array("success" => false,
						"code"=> 404,
						"msg" => "delerror",
						"obj"=> null,
						"map"=> null,
						"list"=> null
					   )
				);
				exit();   
			}   
			$m_file->where($map)->delete();
			echo json_encode(array("success" => true,
									"code"=> 200,
									"msg" => "success",
									"obj"=> null,
									"map"=> null,
									"list"=> null
								   )
							);
		}


    }
	public function uptoken(){
		echo('{"success":true,"code":200,"msg":"操作成功","obj":null,"map":{"expire":"3600","token":"JkbWPquRXw2qZpNqeM9Tja4rKlZmK0xSIoX-gOki:o1GfrPL3oruA-1PKgA8A1RmtTmc=:eyJzY29wZSI6ImVxeGl1IiwicmV0dXJuQm9keSI6IntcIm5hbWVcIjogJChmbmFtZSksXCJzaXplXCI6ICQoZnNpemUpLFwid1wiOiAkKGltYWdlSW5mby53aWR0aCksXCJoXCI6ICQoaW1hZ2VJbmZvLmhlaWdodCksXCJrZXlcIjokKGtleSksXCJtaW1lTGltaXRcIjokKGltYWdlLyopfSIsImRlYWRsaW5lIjoxNDY3MjcxNTUxfQ=="},"list":null}');
	}
}