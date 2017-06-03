<?php	
	session_start();
	if(isset($_SESSION['userid']))
	{
		$role = $_SESSION['role'];
		if($role == 2)
		{
			// place all the code in this page
		}
		else
		{
		    session_destroy();
			header('Location: ../index.php'); // redirect user if not role 1
		}
	}
	else
	{
		session_destroy();
		header('Location: ../index.php'); // redirect user if user not logged in
	}


 
?>