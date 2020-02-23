<?php
/**
 this file is responsible for signing up of user
 */
include_once("database.php");
class Create extends Database
{
	private $firstname,$lastname,$email,$mobileno,$password;
	function __construct($firstname,$lastname,$email,$mobileno,$password)
	{
		parent::__construct();
		//senetize these variable before assigning into variable
		$this->firstname=$firstname;
		$this->lastname=$lastname;
		$this->email=$email;
		$this->mobileno=$mobileno;
		$this->password=$password;
	}
	public function create_user(){
		$conn=parent::db_connect();
		$sql="INSERT INTO user(firstname,lastname,email,mobileno,password) 
			  VALUES('".$this->firstname."','".$this->lastname."','".$this->email."','".$this->mobileno."','".$this->password."')";
		if ($conn->query($sql)) {
			include_once("host.php");
			$host_obj=new Host();
			$url=$host_obj->get_host()."?page=signin";
			$host_obj->internal_redirect($url);
		}
	}
}
?>