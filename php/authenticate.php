
<?php
/**
 * 
 */
include_once("database.php");
class Authenticate extends Database
{	
	function __construct(){
		parent::__construct();
	}


	public function user_check($username,$password){
		//this function will check username and password provided by the user during sign in and set cookiee
		$conn=parent::db_connect();
		$sql="SELECT * FROM user WHERE email='".$username."' AND password='".$password."'";
		$result=$conn->query($sql);
		if (mysqli_num_rows($result)) {
				$_SESSION["login_status"]=1;
				include_once("host.php");
				$host_obj=new Host();
				$url=$host_obj->get_host()."?page=user_account";
				$host_obj->internal_redirect($url);
		}else{
			$sql2="SELECT * FROM user WHERE email='".$username."'";
			$result2=$conn->query($sql2);
			if (mysqli_num_rows($result2)) {
				echo "You have entered into wrong password";
			}else{
				echo "This user does not exists";
			}
		}
	}
}
?>