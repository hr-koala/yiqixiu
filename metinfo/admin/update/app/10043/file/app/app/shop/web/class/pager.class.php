<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/** 
 * 分页类
 * @param string $total		    总个数
 * @param string $pages			一共多少页
 * @param string $cur_page		当前页
 * @param string $SELF			当前页的链接
 * @param string $met_pageskin	分页样式：前台默认样式5，后台的固定了。
 */
class pager {
	public $total;				
	public $pagesize;				
	public $pages;					
	public $cur_page;				
	public $link;				
	public $fristlink;					
	public $met_pageskin;
	
	/** 
	 * 初始化函数 
	 * @param string $table		查询的表名
	 * @param string $where		where条件
	 * @param string $order		order条件
	 * @param string $link		分页链接，也就是第一页的链接
	 * @param string $seolink	首页链接自定义
	 * @param string $page_now	跳转到的页码
	 * @param string $pagesize	每一页多少
	 */
	public function __construct($link, $page_now, $total, $pagesize = 20, $fristlink = ''){
		global $_M;	
		$page_now = $page_now ? $page_now : 1;
		$this->cur_page = $page_now;	
		$this->set('pagesize', $pagesize);
		$this->set('link', $link);
		$this->set('total', $total);	
		$this->set('pages', ceil($this->total / $this->pagesize));
		if($page_now > $this->pages){
			$page_now = $this->pages;
		}
		$this->set('fristlink', $fristlink);
	}
	
	/** 
	 * 设置常用属性
	 * @param string $name	要设置的键名
	 * @param string $value	对应的值名
	 */
	public function set($name, $value){
		global $_M;		
		if($value === NULL){
			return false;
		}	
		switch($name){			
			case 'link';
				$this->link = $value;
			break;
			
			case 'fristlink';
				$this->fristlink = $value;
			break;
			
			case 'total';
				$this->total =  $value;
			break;
			
			case 'pagesize';
				$this->pagesize = $value;
			break;
			
			case 'pages';
				$this->pages = $value;
			break;
		}	
	}
	
	/** 
	 * 获取分页html函数
	 * @return string 分页html   
	 */
	public function get_html(){	
		global $_M;

		$firestpage = $this->fristlink ? $this->fristlink : $this->get_page_url(1) ;
		$prepage = $this->cur_page == 1 ? $firestpage : $this->get_page_url($this->cur_page-1);
		$exc = '';
		$text="
				<div class='met_shopv2_pager'>
				";
		if ($this->cur_page == 1){     //$this->_cur_page当前页面的码数
			if($this->pages!=0){
				$text.="
				<span class='PreSpan'>{$_M['word']['PagePre']}</span>
				";
			}
		}else{
			$text.="<a href=".$prepage." class='PreA'>{$_M['word']['PagePre']}</a>";
		}
			
		if($this->pages >7 ){
		   if($this->cur_page>4){
				$firstPage = "
					<a href=".$firestpage." class='firstPage'>1...</a>
					";
			
				if(($this->pages-$this->cur_page)>=4){
					$startnum=$this->cur_page-3;
					$endnum=$this->cur_page+3;			
				}else{
					$startnum=$this->pages-6;
					$endnum=$this->pages;
				}
			}else{
				$startnum=1;
				$endnum=7;		
			}
			
			if(($this->pages-$this->cur_page)>3){
				$lastPage = "
					<a href=".$this->get_page_url($this->pages)." class='lastPage'>...".$this->pages."</a>
			";
			}
		}else{
			$startnum=1;
			$endnum=$this->pages;	
		}
		 
		  $text.=$firstPage;
		  
		for($i=$startnum;$i<=$endnum;$i++){
			$pageurl=$i==1?$firestpage:$this->get_page_url($i);
			if($i==$this->cur_page){$page_stylenow="class='Ahover'";}
				$text.="
					<a href=".$pageurl." $page_stylenow>".$i."</a> 
				   ";
			$page_stylenow='';
		}
		$text.=$lastPage;
		if ($this->cur_page == $this->pages){
			$text.="	    <span class='NextSpan'>{$_M['word']['PageNext']}</span>
					";
		}else{
			if($this->pages!=0){
				$text.="	    <a href=".$this->get_page_url($this->cur_page+1)." class='NextA'>{$_M['word']['PageNext']}</a>
					";
			}
		}
			 
		if($this->pages!=0){
			for($i=1;$i<=$this->pages;$i++){
				if($i==$this->cur_page){
					$text.="
					<span class='PageText'>{$_M['word']['PageGo']}</span>
					<input type='text' id='metPageT' data-pageurl='".$this->link."' value='".$i."' />
					<input type='button' id='metPageB' value='".$_M['word']['Page']."' />";	
				}
			}			  
			  
		}	   
		$text .="
			</div>
		";	
	
		return $text; 
	}
	
	/** 
	 * 获取前台分页html函数，样式可选
	 * @return string 前台分页html  
	 */	
	public function get_page_url($page){
		return str_replace('[page]', $page, $this->link);
	}
		
}


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>