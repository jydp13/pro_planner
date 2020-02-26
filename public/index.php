<?php 
/**
 * 
 */
session_start();
class Index
{
	private $page,$service;
	private $php_dir="../php/";
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
/*
public function get_page($p){
$this->import("page");
$page_obj=new Page();
$page_obj->page_server($p);
	
}




*/
	public function get_page(){
		switch ($this->page) {
			case 'signin':
				$this->import("signin");
				$obj=new SignIn();
				$obj->show();
				break;
			case 'about':
				$this->import("about");
				$obj=new About();
				$obj->show();
				break;
			case 'home':
				$this->import("homepage");
				$obj=new Home();
				$obj->show();
				break; 
	 		case 'create_account':
	 			$this->import("signup");
	 			$obj=new SignUp();
	 			$obj->show();
	 			break;
	 		case 'password_recover':
	 			$this->import("pass_recover");
	 			$obj=new Forget_Password();
	 			$obj->show();
	 			break;
	 		case 'user_account':
	 			$this->import("user_account");
	 			$obj=new Account();
	 			$obj->show();
	 			break;
	 		case 'profile':
	 			$this->import("profile");
	 			$obj=new Profile();
	 			$obj->show();
	 			break;
	 		case 'projects':
	 			$this->import("projects");
	 			$obj=new Projects();
	 			$obj->show();
	 			break;
			default:
				echo "<br>Requested page is not implemented yet";
				break;
		}
	}
	public function get_service(){
		switch ($this->service) {
			case 'authentication':
			 	$this->import("authenticate");
				$obj=new Authenticate();
				$obj->user_check($_POST["username"],$_POST["password"]);
				break;
			case 'create_user':
				$this->import("create");
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
		//deleting cookies variable by setting time of following cookies one hour ago
		setcookie ("email", "", time() - 3600);
		setcookie ("firstname", "", time() - 3600);
		setcookie ("lastname", "", time() - 3600);
		setcookie ("mobileno", "", time() - 3600);
		//destroying all session variable for example session variable login_status
		session_destroy();
		$this->import("host");
		$host_obj=new Host();
		$url=$host_obj->get_host()."?page=signin";
		$host_obj->internal_redirect($url);
	}
	private function import($file){
		$file_dir=$this->php_dir.$file.".php";
		include_once($file_dir);
	}
		
}
//execution start here
$index_obj=new Index();
$page=$index_obj->get_var("page");
$service=$index_obj->get_var("service");
if (isset($page)) {
	$index_obj->get_page();//$index_obj->get_page($page);
}else if (isset($service)) {
	$index_obj->get_service();
}

?>