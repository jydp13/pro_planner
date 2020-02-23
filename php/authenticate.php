
<?php
/**
 * 
 */
include_once("database.php");
class Authenticate extends Database
{	
	private $user_exists,$password_metch;
	function __construct(){
		parent::__construct();
		$this->user_exists=0;
		$this->password_metch=0;
	}


	public function user_check($username,$password){
		//this function will check username and password provided by the user during sign in and set cookiee
		$conn=parent::db_connect();
		$sql1="SELECT * FROM user";
		$result=$conn->query($sql1);
		if (mysqli_num_rows($result)) {
			while ($row=mysqli_fetch_assoc($result)) {
				if ($username===$row["email"]) {
					$this->user_exists=1;
					if ($password===$row["password"]) {
						$this->password_metch=1;
					}
				}
			}
			if ($this->user_exists==1 && $this->password_metch==1) {
				echo "You have entered your account";
				//send user to his/her account from here
				$_SESSION["login_status"]=1;
				include_once("host.php");
				$host_obj=new Host();
				$url=$host_obj->get_host()."?page=user_account";
				$host_obj->internal_redirect($url);
			}else if ($this->user_exists==1 && $this->password_metch==0) {
				echo "You have enter wrong password";
						
			}else if ($this->user_exists==0 && $this->password_metch==0 || $this->user_exists==0) {
				echo "This user does not exists";
			}else{
				echo "something went wrong";
			}
		}else{
			echo "currently no user is signed up ";
		}
	}
}
?>