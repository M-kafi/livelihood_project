<?php	

session_start();
  include('../utility.php'); 
	$msg ="";
	$email="";
	$answer="";
	$password="";
	$confirm ="";
	$secretquestion="";
	$userid = "";
	$errors = array();
	global $questions_rows;
	global $secretquestion;
	$readytosave =0;
	$retrieved="";
	$email_row = "";
	// setup 
	
	
	
		if(load_questions())
		{
			
		}
		else
		{
			die("Can not load Required Information :: Err# 1254");
		}
		
	
	if(isset($_POST['verifyemail']))
	{
		
		
			//verify user selected the correct question and entered the correct answer		
			if(validate_Input_entered_QAE())
			{
				
				if ( verify_correct_email($email) )
				{
					
				
					if(verify_correct_answer($userid,$secretquestion,$answer))
					{	
						
						
						$_SESSION['userid'] = $userid; 
						$readytosave = 1;
						
						
					}
					else
					{
						$readytosave = 0;
						$msg = "Could not validate information provided";
					}
					
				
				}
				else
				{
					$msg = "you entered a wrong email address!";
				}
				
				
			}
			else
			{
					$msg = "Enter your email then select Secret Questions and enter an Answer";
			}
		
	}
	else if(isset($_POST['cancel']))
	{
		header('Location: ./profile.php');
	}
	else if(isset($_POST['change']))
	{	
	
		$readytosave = 1;
	    if(validate_password_confirm_entered())
		{	
			if(validate_password_confirm_entered())
			{
				$msg ="";
				if(validate_password_confirm_match())
				{
					
					$userid = $_SESSION['userid'] ; 
					if (Update_Password($password,$userid) )
					{
					$msg="";
					
					session_destroy();
					
					header('Location: ../customer/landing.php');
					}
					else
					{
						$msg = "couldn't change the password!";
						
					}
				
				
				
				
				}
				else
				{
					$msg = "Password and Confirm do not match";
				}			
			}
			else
			{
				$msg = "Please enter your password and then confirm it";
			}
		}
		else
		{
				$msg = "Select Secret Questions and enter an Answer";
		}
		
		
	
	
	}
	
	
	
	
	
	
	
	
	//////////////////////////
	
	
	
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
	
	
	function verify_correct_email( $email )
	{
		
		$utils = new myfunctions();
		
		if ( $utils->verify_correct_email( $email ) )
		{
			return 1;
			
		}
		else
		{
			return 0 ;
		}
		
		
		
	}
	
	
	
	function Update_Password($password,$user)
{
	$utils = new myfunctions();
		
		if($utils->Update_Password( $password,$user ))
		{
			return 1;
		}
		else
		{
			$msg = "Couldn't update password!";
			return 0;
			
		}
}
	
	
	
	
	
	
	function validate_password_confirm_match()
{
	global $password,$confirm;
	$encyptpass = md5($password);
	$encrypcon = md5($confirm);
	if($encyptpass == $encrypcon)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
	
	function validate_Input_entered_QAE()
	{
		global $connection,$secretquestion,$answer,$msg,$email,$errors;
		$secretquestion = $_POST['secretquestion'];
		$answer =  trim($_POST['answer']);
		$email = trim($_POST['email']);
		validate_input($secretquestion,'secretquestion');
		validate_input($answer,'answer');	
		validate_input($email,'email');	
		
		if(count($errors) == 0)
		{			
			return 1;
		}
		else
		{		
			return 0;
		}
	}	
function validate_input($string,$err)
	{
		global $errors;
		$string = trim($string);
		if(!empty($string))
		{
			return 1;
		}
		else
		{
			$errors[$err] = "*";			
			return 0;
		}
	}
	
	function verify_correct_answer($theuser,$thequestion,$theanswer)
{
	global $connection;
	
	$utils = new myfunctions();
		
		if($utils->verify_correct_answer($theuser,$thequestion,$theanswer))
		{
			return 1;
		}
		else
		{
			
			return 0;
			
		}
	
	
	
}



function validate_password_confirm_entered()
{
	global $password,$confirm,$msg,$secretquestion, $email, $answer, $errors;
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	$secretquestion = $_POST['secretquestion'];	
	$email= $_POST['email'];	
	$answer= $_POST['answer'];	
	$userid =$_SESSION['userid'];
	$readytosave =1;	
	validate_input($password, 'password');
	validate_input($confirm, 'confirm');	
	if(count($errors) == 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
	
	
	/////////////////////////////
	
	
	
	
	

?>
	
	
	
	
	
	
 
