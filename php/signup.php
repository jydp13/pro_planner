<?php
/**
 * 
 */
include_once("page.php");
class SignUp extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
		if (isset($_SESSION["login_status"])) {
				include_once("host.php");
				$host_obj=new Host();
				$url=$host_obj->get_host()."?page=user_account";
				$host_obj->internal_redirect($url);
		}else{
				parent::get_header();
 				include_once("../public/html/signupage_body.html");
 				parent::get_footer();
 		}
	}
}
?>