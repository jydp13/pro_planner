<?php
include_once("page.php");
include_once("Database.php");
class Projects extends Page
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function show(){
		if (isset($_SESSION["login_status"])) {	
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

		}else{
			include_once("host.php");
			$redirect=new Host();
			$redirect_url=$redirect->get_host()."?page=signin";
			$redirect->internal_redirect($redirect_url);
		}
	}
}
?>