<?php

/**
 * 
 */
class Util
{
	
	private $web_server;
	private $source_dir = array("css","html","javascript","public_resource_file","public");
	function __construct()
	{
	 	$host_config=simplexml_load_file("../config_files/host_config.xml") or die("unable to load config file");
	 	$this->web_server=$host_config->web_server;

	}
	public function get_host(){
		return $this->web_server;
	}
	public function set_host($host){
		$this->web_server=$host;
	}
	public function internal_redirect($redirect_distination){
		$url=$this->web_server.$redirect_distination;
		header("Location: http://".$url);
		die();
	}
	public function import_php($source_dir,$filename){
		foreach ($source_dir as $value) {
			if ($value==$source_dir) {
				$php_dir="../".$source_dir."/".$filename."php";
				include_once($php_dir);
			}
		}
	}
}
?>