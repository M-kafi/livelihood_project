<?php
	include('../utility.php');
	$username = "";
	$password = "";
	$row ;
	$role="";
	
	if(isset($_POST['login']))
	{
		Get_Data();
		
		call_login($username,$password);
		print_r($row);
		$_SESSION['userid'] = $row[0];
		$_SESSION['firstname'] = $row[1];
		$_SESSION['lastname'] = $row[3];
		$_SESSION['role'] = $row[9];
		$role = $row[9];
		if($role == 1)
		{
			header('Location: ../administration/landingpage.php');
		}
		else if($role == 2)
		{
			header('Location: ../customer/landing.php');
		}
	}
	
	function Get_Data()
	{
		global $username, $password;
		$username = $_POST['email'];
		$password = $_POST['pswd'];
	}
	function call_login($username,$password)
	{
		global $row;
		$password = md5($password);
		$utils = new myfunctions;
		$row = $utils->verify_login($username,$password);	
		
	}
?>