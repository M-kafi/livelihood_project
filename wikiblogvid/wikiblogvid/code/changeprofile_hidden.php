<?php	
	
	
	
	session_start();
	
	if ( isset( $_SESSION['userid'] ) )
	{
		
		
	
	
		
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
	$user_id = $_SESSION['userid'];
	
	load_questions();
	$errors = array();
	
	
	
	load_info();
	

	if(isset($_POST['change']))
	{	    
		
		if(Get_Data()) // capture data from screen
		{
				clear_username_email($user_id);
				
				
			if(validate_username($username))
			{
				
				
				
				if(validate_Email($email))
				{
					if(update_user($fname,$lname,$username,$email, $secrect_question, $secrect_answer, $user_id))
					{
						header('Location: ../customer/landing.php');
					}
					else
					{
						$msg = "Could not change profile";
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
	

	
	
	}
	else 
	{
	  header ("Location: ../index.php");	
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
	function update_user($fname,$lname,$uname,$email,$secrect_question, $secrect_answer,$user_id )
	{
		$utils = new myfunctions();
		
		if($utils->update_user($fname,$lname,$uname,$email,$secrect_question, $secrect_answer,$user_id))
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		
	}
	
	
	function clear_username_email($user_id)
	{
		$utils = new myfunctions();
		
		$utils->clear_username_email($user_id);
		
		
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
	
	
	function load_info()
	{
		
		$utils = new myfunctions();
		
		
		if($utils->load_info())
		{
			return 1;
			
		}
		else
		{
			
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
	
	
	
	
	
	