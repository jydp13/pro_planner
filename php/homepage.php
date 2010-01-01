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
 			if (isset($_SESSION["login_status"])) {
 				include_once("../public/html/account_home.html");
 			}else{
 				include_once("../public/html/homepage.html");
 			}
 			parent::get_footer();
 	}
} 
 ?>