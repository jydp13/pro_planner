<?php 
/**
 * 
 */
session_start();
class Index
{
	private $page,$service;
	function __construct()
	{
		if (isset($_GET["page"])) {
			$this->page=$_GET["page"];	
		}else if (isset($_POST["username"])&&isset($_POST["password"])) {
			$this->service="authentication";
		}else if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["mobileno"]) && isset($_POST["password"]) && isset($_POST["password_confirm"]) ) {
				if ($_POST["password"]==$_POST["password_confirm"]) {
					$this->service="create_user";	
				}else{
					echo "Both  password  should be same";
					//internal redirect to signup page again if this condition occur
				}
		}else if (isset($_GET["service"])) {
			$this->service=$_GET["service"];
		}else{
			$this->page="home";
		}
	}
	public function get_page(){
		switch ($this->page) {
			case 'signin':
				include_once("../php/signin.php");
				$obj=new SignIn();
				$obj->show();
				break;
			case 'about':
				include_once("../php/about.php");
				$obj=new About();
				$obj->show();
				break;
			case 'home':
				include_once("../php/homepage.php");
				$obj=new Home();
				$obj->show();
				break; 
	 		case 'create_account':
	 			include_once("../php/signup.php");
	 			$obj=new SignUp();
	 			$obj->show();
	 			break;
	 		case 'password_recover':
	 			include_once("../php/pass_recover.php");
	 			break;
	 		case 'user_account':
	 			include_once("../php/user_account.php");
	 			$obj=new Account();
	 			$obj->show();
	 			break;
			default:
				echo "<br>sorry we are unable to serve requested page";
				break;
		}
	}
	public function get_service(){
		switch ($this->service) {
			case 'authentication':
				include_once("../php/authenticate.php");
				$obj=new Authenticate();
				$obj->user_check($_POST["username"],$_POST["password"]);
				break;
			case 'create_user':
	 			include_once("../php/create.php");
	 			$obj=new Create($_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["mobileno"],$_POST["password"]);
	 			$obj->create_user();
	 			break;
	 		case 'logout':
	 			$this->user_logout();
	 			break;
			default:
				echo "sorry we are unable to serve your requesed service";
				break;
		}
	}
	public function get_var($var){
		if ($var=="page") {
			return $this->page;
		}else if ($var=="service") {
			return $this->service;
		}
		
	}
	private function user_logout(){
		unset($_SESSION["login_status"]);
		session_destroy();
		include_once("../php/host.php");
		$host_obj=new Host();
		$url=$host_obj->get_host()."?page=signin";
		$host_obj->internal_redirect($url);
	}
}
//execution start here
$index_obj=new Index();
$page=$index_obj->get_var("page");
$service=$index_obj->get_var("service");
if (isset($page)) {
	$index_obj->get_page();
}else if (isset($service)) {
	$index_obj->get_service();
}

?>