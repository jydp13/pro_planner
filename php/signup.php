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
		parent::get_header();
 		include_once("../public/html/signupage_body.html");
 		parent::get_footer();
	}
}
?>