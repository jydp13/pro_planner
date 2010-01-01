<?php
/**
account page for usr
user can enter into account after just signed up and sign in 
when user just signed up user will send to authentiaction process and sign in
this page is responsible for what feature and thing will be in user account 
 * 
 */
include_once("page.php");
class Account extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
		if (isset($_SESSION["login_status"])) {
			parent::get_header();
		   	include_once("../public/html/account_home.html");
			parent::get_footer();	
		}else{
			include_once("host.php");
			$redirect=new Host();
			$redirect_url=$redirect->get_host()."?page=signin";
			$redirect->internal_redirect($redirect_url);
		}
	}
}
?>