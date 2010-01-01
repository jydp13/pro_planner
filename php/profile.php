<?php
include_once("page.php");
class Profile extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
		if (isset($_SESSION["login_status"])) {
		   	include_once("../public/html/profile.html");	
		}else{
			include_once("host.php");
			$redirect=new Host();
			$redirect_url=$redirect->get_host()."?page=signin";
			$redirect->internal_redirect($redirect_url);
		}
	}
}
?>