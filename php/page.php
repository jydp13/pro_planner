<?php
	/**
	 * 
	 */
	class Page 
	{
		
		private $title;
		private $logo_file;
 		private $footer;
 		private $menubar;
 		private $account_menubar;
 		function __construct(){
 			$common_xml=simplexml_load_file("../config_files/common.xml") or die("unable to load config file");
 			$this->title=$common_xml->title;
 			$this->footer=$common_xml->footer;
 			$this->logo_file=$common_xml->header->logo;
 			$this->menubar=$common_xml->header->menubar;
 			$this->account_menubar=$common_xml->header->account_menubar;
 		}
 		public function get_header(){
 			include_once("../public/html/header.html");
 		}
 		public function get_footer(){
 			include_once("../public/html/footer.html");
 			
 		}

	}