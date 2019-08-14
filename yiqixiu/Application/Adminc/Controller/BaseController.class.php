<?php
namespace Adminc\Controller;
use Think\Controller;
class BaseController extends Controller {
	
   protected function _initialize(){
	   
	   $this->assign('Adminusername', session('adminUser')); 
		$this->assign('Adminuserid', session('adminUserid')); 
	   
	   
		if(!session('adminUser')){		 
			//$this->redirect('auth/login');
			header('Location: ' . '/adminc.php?c=auth&a=login');
		}
		else {
			return true;
		}
		
	}
	
	    /**
     * 解析数据库语句函数
     * @param string $sql  sql语句   带默认前缀的
     * @param string $tablepre  自己的前缀
     * @return multitype:string 返回最终需要的sql语句
     */
    public function sql_split($sql, $tablepre) {
        if ($tablepre != "cj_")
            $sql = str_replace("cj_", $tablepre, $sql);
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);

        if ($r_tablepre != $s_tablepre)
            $sql = str_replace($s_tablepre, $r_tablepre, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num++;
        }
        return $ret;
    }

	
	
	
	protected function all_insert($name = '', $back = '/index') {
		$name = $name ? $name : MODULE_NAME;
		$db = D ( $name );
		if ($db->create () === false) {
			$this->error ( $db->getError () );
		} else {
			$id = $db->add ();
			if ($id) {
				$this->success ( '操作成功', U ( MODULE_NAME . $back ) );
			} else {
				$this->error ( '操作失败', U ( MODULE_NAME . $back ) );
			}
		}
	}
}