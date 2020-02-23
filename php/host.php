<?php
/**
 * 
 */
class Host
{
	private $web_server;
	function __construct()
	{
	 	$host_config=simplexml_load_file("../config_files/host_config.xml") or die("unable to load config file");
	 	$this->web_server=$host_config->web_server;

	}
	public function get_host(){
		return $this->web_server;
	}
	public function internal_redirect($redirect_distination){
		header("Location: http://".$redirect_distination);
		die();
	}

}