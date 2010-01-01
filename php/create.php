<?php
/**
 this file is responsible for signing up of user
 */
include_once("database.php");
class Create extends Database
{
	private $firstname,$lastname,$email,$mobileno,$password,$conn,$user_exists;
	function __construct($firstname,$lastname,$email,$mobileno,$password)
	{
		parent::__construct();
		$this->conn=parent::db_connect();
		//senetize these variable before assigning into variable
		$this->firstname=$firstname;
		$this->lastname=$lastname;
		$this->email=$email;
		$this->mobileno=$mobileno;
		$this->password=$password;
		$this->user_exists=0;
	}
	public function create_user(){
		$this->check_user();
		if ($this->user_exists==1) {
			echo "This email is allready ragistered";
		}else if($this->user_exists==0){
				$sql="INSERT INTO user(firstname,lastname,email,mobileno,password) 
			  VALUES('".$this->firstname."','".$this->lastname."','".$this->email."','".$this->mobileno."','".$this->password."')";
				if ($this->conn->query($sql)) {
				//close database connection
				include_once("host.php");
				$host_obj=new Host();
				$url=$host_obj->get_host()."?page=signin";
				$host_obj->internal_redirect($url);
			}
		}
		
	}
	private function check_user(){
		$sql="SELECT email FROM user WHERE email='".$this->email."'";
		if (mysqli_num_rows($this->conn->query($sql))) {
			$this->user_exists=1;
		}else{
			$this->user_exists=0;
		}
	}
}
?>