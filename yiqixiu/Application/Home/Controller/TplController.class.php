<?php
namespace Home\Controller;
use Think\Controller;
class TplController extends Controller{

        public function unlogin(){
		if(intval(session('userid')) == 0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
			exit;
		}
    }
	
    
    public function _initialize(){
        header('Content-type: application/json;charset=UTF-8');
		if(intval(session('userid')) != 100)
		{
			$wheresessionuser["userid_int"] = intval(session('userid'));
			
		}
	}

    public function page() {
	 $this->unlogin();
		echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":[{"id":16630,"name":"版式","value":"1101","type":"tpl_page","sort":1,"status":1,"remark":null},{"id":16632,"name":"风格","value":"1103","type":"tpl_page","sort":2,"status":1,"remark":null},{"id":16631,"name":"互动","value":"1102","type":"tpl_page","sort":3,"status":1,"remark":null}]}';
    }


}