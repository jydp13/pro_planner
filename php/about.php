<?php
/**
 * 
 */
include_once("page.php");
class About extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
 		parent::get_header();
 		include_once("../public/html/aboutpage_body.html");
 		parent::get_footer();
 	}
}
?>