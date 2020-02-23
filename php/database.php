<?php 
/**
  * 
  */
 class Database
 {
 	private $db_host;
	private $db_user;
	private $db_user_pass;
	private $database;
	function __construct()
	{
		$db_config_xml=simplexml_load_file("../config_files/db_config.xml") or die("unable to load config file");
		$host_config_xml=simplexml_load_file("../config_files/host_config.xml") or die("unable to load config file");
		$this->db_host=$host_config_xml->web_server;
		$this->db_user=$db_config_xml->username;
		$this->db_user_pass=$db_config_xml->password;
		$this->database=$db_config_xml->database;
	}
	public function db_connect(){
		$conn = new mysqli($this->db_host,$this->db_user,$this->db_user_pass);
		if($conn->connect_error){
  				die("connection failed".$conn->connect_error);
   		}else{
   			$sql="USE ".$this->database;
			$conn->query($sql);
   			return $conn;
   		}
	}
 } 
 ?>