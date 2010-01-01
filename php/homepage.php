<?php
/**
  * 
  */
include_once("page.php");
 class Home extends Page
 {
 	function __construct()
 	{
 		parent::__construct();
 	}
 	public function show(){
 			parent::get_header();
 			include_once("../public/html/homepage_body.html");
 			parent::get_footer();
 	}
} 
 ?>