<?php
/**
 * 
 */
include_once("database.php");
class Services extends Database
{
	private $conn,$user_exists;
	function __construct()
	{
		parent::__construct();
		$this->conn=parent::db_connect();
	}
	public function signin($username,$password){
		$sql="SELECT * FROM user WHERE email='".$username."' AND password='".$password."'";
		$result=$this->conn->query($sql);
		if (mysqli_num_rows($result)) {
				$row=mysqli_fetch_assoc($result);
				$_SESSION["login_status"]=1;
				setcookie("email",$row["email"]);
				setcookie("mobileno",$row["mobileno"]);
				setcookie("firstname",$row["firstname"]);
				setcookie("lastname",$row["lastname"]);
				include_once("util.php");
				$util_obj=new Util();
				$util_obj->internal_redirect("?page=user_account");
		}else{
			$sql2="SELECT * FROM user WHERE email='".$username."'";
			$result2=$this->conn->query($sql2);
			if (mysqli_num_rows($result2)) {
				echo "You have entered into wrong password";
			}else{
				echo "This user does not exists";
			}
		}
	}
	public function signup($firstname,$lastname,$email,$mobileno,$password){
		$this->user_check();
		if ($this->user_exists==1) {
			echo "This email is allready ragistered";
		}else if($this->user_exists==0){
				$sql="INSERT INTO user(firstname,lastname,email,mobileno,password) 
			  VALUES('".$firstname."','".$lastname."','".$email."','".$mobileno."','".$password."')";
				if ($this->conn->query($sql)) {
				//close database connection
				include_once("util.php");
				$util_obj=new Util();
				$util_obj->internal_redirect("?page=signin");
			}
		}
	}
	public function logout(){
		include_once("util.php");
		$Util_obj=new Util();
		$redirect_url="?page=signin";
		//deleting cookies variable by setting time of following cookies one hour ago
		setcookie ("email", "", time() - 3600);
		setcookie ("firstname", "", time() - 3600);
		setcookie ("lastname", "", time() - 3600);
		setcookie ("mobileno", "", time() - 3600);
		//destroying all session variable for example session variable login_status
		session_destroy();
		$Util_obj->internal_redirect($redirect_url);
	}
	private function default_service(){
		echo "this is default service";
	}
	private function user_check(){
		$sql="SELECT email FROM user WHERE email='".$this->email."'";
		if (mysqli_num_rows($this->conn->query($sql))) {
			$this->user_exists=1;
		}else{
			$this->user_exists=0;
		}
	}
	public function import_html($filename){
		$file_dir="../public/html/".$filename.".html";
		include_once($file_dir);
	}
	
	
	
}
?>