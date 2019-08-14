<?php
namespace Home\Controller;
use Think\Controller;
 
class AuthController extends Controller {
	public function login(){
		$this->display('login');
	}
	
	public function register(){
		$this->display('register');
	}
	
	public function other(){
		$this->display('other');
	}
	
}

