<?php 
/**
 * 
 */
session_start();

class Index
{
	private $page,$service,$service_obj;
	private $php_dir="../php/";
	public $username,$password,$firstname,$lastname,$email,$mobileno;
//******************************************************************************************************************************
	function __construct()
	{	
		if (isset($_GET["page"])) {
			$this->page=$_GET["page"];	
		}else if (isset($_POST["username"])&&isset($_POST["password"])) {
			$this->service="signin";
			$this->username=$_POST["username"];
			$this->password=$_POST["password"];

		}else if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["mobileno"]) && isset($_POST["password"]) && isset($_POST["password_confirm"]) ) {
				if ($_POST["password"]==$_POST["password_confirm"]) {
					$this->service="signup";
					$this->firstname=$_POST["firstname"];
					$this->lastname=$_POST["lastname"];
					$this->email=$_POST["email"];
					$this->mobileno=$_POST["mobileno"];
			$this->password=$_POST["password"];
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
//****************************************************************************************************************************
	public function get_var($var){
		if ($var=="page") {
			return $this->page;
		}else if ($var=="service") {
			return $this->service;
		}
		
	}
//****************************************************************************************************************************
	public function import($file){
		$file_dir=$this->php_dir.$file.".php";
		include_once($file_dir);
	}
//*********************************************************************************************************************	
}
$index_obj=new Index();
$page=$index_obj->get_var("page");
$service=$index_obj->get_var("service");
if (isset($page)) {
	$index_obj->import("page");
	$page_obj=new Page();
	$page_obj->page_server($page);
}else if (isset($service)) {
	$index_obj->import("services");
	$service_obj=new Services();
	if ($service=="signin") {
		$service_obj->signin($index_obj->username,$index_obj->password);
	}else if ($service=="signup") {
		$service_obj->signup($index_obj->firstname,$index_obj->lastname,$index_obj->email,$index_obj->mobileno,$index_obj->password);
	}else if ($service=="logout") {
		$service_obj->logout();
	}else if ($service=="default") {
		$service_obj->default_service();
	}
}



?>