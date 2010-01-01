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