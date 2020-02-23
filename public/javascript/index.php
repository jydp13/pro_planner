
<?php
	include_once("../../php/host.php");
	$host_obj=new Host();
	$host_obj->internal_redirect($host_obj->get_host());
?>