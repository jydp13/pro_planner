<?php
	/**
	 * 
	 */
	include_once("services.php");
	class Page 
	{
		
		private $title;
		private $logo_file;
 		private $footer;
 		private $menubar;
 		private $account_menubar;
 		private $service_obj;
 		function __construct(){
 			$common=simplexml_load_file("../config_files/common.xml") or die("unable to load config file");
 			$resources=simplexml_load_file("../config_files/resources.xml") or die("unable to load config file"); 			
 			$this->title=$common->title;
 			$this->footer=$common->footer;
 			$this->logo_file=$resources->logo;
 			$this->menubar=$common->header->menubar;
 			$this->account_menubar=$common->header->account_menubar;
 			$this->service_obj=new Services();
 		}
 		public function get_header(){
 			include_once("../public/html/header.html");
 		}
 		public function get_footer(){
 			include_once("../public/html/footer.html");
 			
 		}
 		public function page_server($page){
 			
 			if (isset($_SESSION["login_status"])) {
 				if ($page=="home" || $page=="user_account") {
 					$this->get_header();
 					$this->account_home_page();
 					$this->get_footer();
 				}else if ($page=="projects") {
 					$this->projects_page();
 				}else if ($page=="profile") {
 					$this->profile_page();
 				}

 				/*else{
 				 	//include_once("util.php");
					//$util_obj=new Util();
					//$util_obj->internal_redirect("?page=user_account");
 				}*/
			}else{
				$this->get_header();
				switch ($page) {
 					case 'home':
 						$this->home_page();
 						break;
 					case 'signin':
 						$this->signin_page();
 						break;
 					case 'signup':
 						$this->signup_page();
 						break;
 					case 'about':
 						$this->about_page();
 						break;
 					case 'forget_password':
 						$this->forget_password();
 						break;
 					default:
 						$this->default_page();
 						break;
 				}
 				$this->get_footer();
			}
 			
 		}
 		private function about_page(){
 			$this->service_obj->import_html("aboutpage_body");
 		}
 		private function home_page(){
 			$this->service_obj->import_html("homepage");
 		}
 		private function signin_page(){
 			$this->service_obj->import_html("signinpage_body");
 			
 		}
 		private function signup_page(){
 			$this->service_obj->import_html("signupage_body");
 			
 		}
 		private function account_home_page(){
 			$this->service_obj->import_html("account_home");
 			
 		}
 		private function profile_page(){
 			$this->service_obj->import_html("profile");
 			
 		}
 		private function forget_password(){
 			$this->service_obj->import_html("forget_password");
 			
 		}
 		private function projects_page(){
 			include_once("Database.php");
 			$database_obj=new Database();
			$conn=$database_obj->db_connect();
			$sql="SELECT * FROM projects WHERE email='".$_COOKIE["email"]."'";
			$result=$conn->query($sql);
			if (mysqli_num_rows($result)) {
			    echo	'<div id="sub_first">
				     		<h5>Create New Project<h5>
							<input type="text" name="new_project"><input type="submit" value="Create">
						</div>
						<hr>
						<h5>Your Projects</h5>
						<div id="sub_second"><table border="1">
						<tr>
							<td>Project Title</td><td>Discription</td><td>Category</td><td>Date</td>
						</tr>';
				while ($row=mysqli_fetch_assoc($result)) {
					//set cookie for further access
			include("../public/html/projects.html");
					
				
				}
				echo '</table></div>';
			}else{
				echo "You don't have any project yet";
			}
 		}
 		private function default_page(){
 				include_once("util.php");
				$util_obj=new Util();
				$util_obj->internal_redirect("?page=signin");
 		}

	}