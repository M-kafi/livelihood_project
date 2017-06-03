<?php	
	include('../utility.php'); 
	$fname = "";
	$lname = "";
	$username ="";
	$email = "";
	$pswd = "";
	$msg = "";
	$confirm = "";
	$secrect_question = "";
	$secrect_answer = "";
	$retrieved = "";
	$questions_rows = "";
	$user_id = "";
	
	load_questions();
	$errors = array();
	

	if(isset($_POST['create']))
	{	    
		
		if(Get_Data()) // capture data from screen
		{
			$pswd = md5($pswd);		
			if(validate_username($username))
			{
				
				if(validate_Email($email))
				{
					if(Insert_user($fname,$lname,$username,$email,$pswd))
					{
						header('Location: ../account/login.php');
					}
					else
					{
						$msg = "Could not create profile";
					}
				}
				else
				{
					$msg = "Email already entered";
				}
			}
			else
			{
				$msg = "User Name already Taken";
			}
		}
		else
		{
			$msg = "Information missing";
		}
	
	}	
	elseif (isset($_POST['clear']))
	{
		clear_screen();
		header('Location: ../index.php');
	}

	function Get_Data()
	{
		global $errors, $fname,$lname,$username,$email,$pswd, $confirm, $secrect_answer, $secrect_question; 
		try
		{
			$fname = $_POST['first'];
			$lname = $_POST['last'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$pswd = $_POST['pswd'];		
			$confirm = $_POST['confirm'];
			$secrect_question = $_POST['secrect_question'];
	        $secrect_answer = $_POST['secrect_answer'];
			
			if(validate_data())						
			{			
				return 1;
			}
			else
			{
				return 0;
			}
			
		}
		catch(Exception $ex)
		{
			return 0;
		}
		
	}
	
	function validate_data()
	{
		global  $errors,$fname,$lname,$username,$email,$pswd,$secrect_question, $secrect_answer, $confirm;		
		$utils = new myfunctions();
		if($utils->validate_input($fname) == 0)
		{
			$errors['first'] = "*";
		}
		if(!$utils->validate_input($lname))
		{
			$errors['last'] = "*";
		}
		if(!$utils->validate_input($username))
		{
			$errors['username'] = "*";
		}
		
		if(!$utils->validate_input($email))
		{
			$errors['email'] = "*";
		}
		if(!$utils->validate_input($pswd))
		{
			$errors['pswd'] = "*";
		}
		if(!$utils->validate_input($confirm))
		{
			$errors['confirm'] = "*";
		}	
        if(!$utils->validate_input($secrect_question))
		{
			$errors['secrect_question'] = "*";
		}		
        if(!$utils->validate_input($secrect_answer))
		{
			$errors['secrect_answer'] = "*";
		}			
		if(count($errors))
		{
			return 0;
		}
		else
		{
			return 1;
		}
		
	} 
	
	function validate_username($uname)
	{
		$utils = new myfunctions();
		
		if($utils->Check_UserName($uname))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function validate_Email($email)
	{
		$utils = new myfunctions();		
		if($utils->Check_Email_Exists($email))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function Insert_user($fname,$lname,$uname,$email,$pswd)
	{
		$utils = new myfunctions();
		
		if($utils->User_Insert($fname,$lname,$uname,$email,$pswd))
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		
	}
	
	function load_questions()
	{
		$utils = new myfunctions();
		
		if($utils->load_questions())
		{
			return 1;
		}
		else
		{
			$msg = "Couldn't load secret questions!";
			return 0;
			
		}
		
		
		
	}
	
    function clear_screen()
	{
		$fname = "";
		$lname = "";
		$username ="";
		$email = "";
		$pswd = "";
		$msg = "";
		$confirm = "";
	}
	
?>