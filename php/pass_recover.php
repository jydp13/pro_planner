<?php
include_once("page.php");
class Forget_Password extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
			parent::get_header();
		   	include_once("../public/html/forget_password.html");
		   	parent::get_footer();	
	}
}
?>