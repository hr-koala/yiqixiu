<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class shop_seo_url {
	public function get($type){
		if($type == 'iis6'){
			return $this->iis6();
		}
		if($type == 'iis7'){
			return $this->iis7();
		}
		if($type == 'nagix'){
			return $this->nagix();
		}
		if($type == 'apache'){
			return $this->apache();
		}
		return  '';
	}
	
	public function iis6(){
		$nowpath=explode('/',$_SERVER["PHP_SELF"]);
		$cunt=count($nowpath)-2;
		for($i=0;$i<$cunt;$i++){
			$metbase.= $nowpath[$i].'/';
		}
		$str = 'RewriteRule '.$metbase.'product/tag/([^/\\\\]+)/([0-9]*)$ '.$metbase.'product/index.php?searchlist=$1&page=$2;'."\n";
		$str = 'RewriteRule '.$metbase.'product/searchs/([^/\\\\]+)/([0-9]*)$ '.$metbase.'product/index.php?searchs=$1&page=$2;'."\n";
		$str = 'RewriteRule '.$metbase.'product/no_order/([^/\\\\]+)/([0-9]*)$ '.$metbase.'product/index.php?no_order=$1&page=$2;'."\n";
		return $str;
	}

	public function iis7(){

		$str.= '<rule name="rule_shopv2_1" stopProcessing="true">'."\n";
		$str.= '<match url="^/product/tag/([^/\\\\]+)/([0-9]*)$" />'."\n";
		$str.= '<action type="Rewrite" url="product/index.php?searchlist={R:1}&amp;page={R:2}" />'."\n";
		$str.= '</rule>'."\n";
		
		$str.= '<rule name="rule_shopv2_2" stopProcessing="true">'."\n";
		$str.= '<match url="^/product/searchs/([^/\\\\]+)/([0-9]*)$" />'."\n";
		$str.= '<action type="Rewrite" url="product/index.php?searchs={R:1}&amp;page={R:2}" />'."\n";
		$str.= '</rule>'."\n";
		
		$str.= '<rule name="rule_shopv2_3" stopProcessing="true">'."\n";
		$str.= '<match url="^/product/no_order/([^/\\\\]+)/([0-9]*)$" />'."\n";
		$str.= '<action type="Rewrite" url="product/index.php?no_order={R:1}&amp;page={R:2}" />'."\n";
		$str.= '</rule>'."\n";

		return $str;
	}
	
	public function nagix(){	
		$str = 'rewrite ^/product/tag/([^/\\\\]+)/([0-9]*)$ /product/index.php?searchlist=$1&page=$2;'."\n";
		$str = 'rewrite ^/product/searchs/([^/\\\\]+)/([0-9]*)$ /product/index.php?searchs=$1&page=$2;'."\n";
		$str = 'rewrite ^/product/no_order/([^/\\\\]+)/([0-9]*)$ /product/index.php?no_order=$1&page=$2;'."\n";
		return $str;
	}
	
	
	public function apache(){	
		$str = 'RewriteRule ^/product/tag/([^/\\\\]+)/([0-9]*)$ /product/index.php?searchlist=$1&page=$2;'."\n";
		$str = 'RewriteRule ^/product/searchs/([^/\\\\]+)/([0-9]*)$ /product/index.php?searchs=$1&page=$2;'."\n";
		$str = 'RewriteRule ^/product/no_order/([^/\\\\]+)/([0-9]*)$ /product/index.php?no_order=$1&page=$2;'."\n";
		return $str;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>