<?php
	include('../data/dbfile.php');
	
	class myfunctions
	{
		
		
	
		
		
		
		
		
		
		
		
		public function validate_input($string)
		{			
			$string = trim($string);
			if(empty($string))			
			{
				return 0;
			}	
			else
			{
				return 1;
			}
			
		}
		public function verify_login($username,$password)
		{
			global $connection;
			$sql ="call users_verify_login('$username','$password')";			
			$connection->next_result();
			if($retrieved = $connection->query($sql))
			{
				
				echo $retrieved->num_rows;
				if($retrieved->num_rows)
				{
					echo "num rows";
					$row = $retrieved->fetch_row();
					return $row;
				}
				else
				{
					return 0;
				}
			}
		}
		// will check to see if email exists
		public function Check_Email_Exists($email)
		{
			global $connection;
			$sql = "call users_email_check('$email')";					
			$connection->next_result();
			if($retrieved = $connection->query($sql))
			{			
				if($retrieved->num_rows)
				{
					return 0 ; // email in use
				}
				else
				{
					return 1; // email not found
				}
			}
			else
			{	
			
				return 1 ; 
			}
		}
		// will check to see if user name exists
		public function Check_UserName($uname)
		{
			global $connection;
			$sql = "call users_check_username('$uname')";
			$connection->next_result();
			if($retrieved = $connection->query($sql))
			{
				if($retrieved->num_rows)
				{
					return 0;
				}
				else
				{
					return 1;
				}
			}
			else
			{
				return 0;
			}
		}
		
		// will save user (still need to save secret question)
		public function User_Insert($fname,$lname,$uname,$email,$pswd)
		{
			global $connection,$user_id, $secrect_question, $secrect_answer;
			$sql = "call users_insert('$fname','$lname','$uname','$email','$pswd')";
			$connection->next_result();
			if($retrieved = $connection->query($sql))
			{
				$sql = " call get_user_inserted_id( '$fname','$lname','$uname' )";
				$connection->next_result();
				$retrieved = $connection->query($sql);
				$user_id = $retrieved ->fetch_row();
				$user_id = $user_id[0];
				$user_id;
				$sql = " call user_question_answer_insert( $user_id, '$secrect_question','$secrect_answer' ); ";
				$connection->next_result();
				$retrieved = $connection->query($sql);
				
				
				
				
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		
		
		
		public	function load_subjects()
		{
			global $connection, $subjects_rows, $retrieved;
			
			$sql = "call load_subjects()";
			$connection->next_result();
			$retrieved = $connection -> query( $sql );
			
			if ( $retrieved ->num_rows )
			{
				$subjects_rows = $retrieved -> fetch_all( MYSQLI_ASSOC );
				return 1;
			}
			else
			{
				die('Database Query Failed loading subjects');
			}
			
			
			
			
		}
		
		public function clear_username_email($user_id)
		{
			global $connection, $retrieved;
			$sql = "call clear_username_email($user_id)";
			$connection->next_result();
			$retrieved = $connection->query($sql);
			
		}
		
		public function update_user($fname,$lname,$uname,$email,$secrect_question, $secrect_answer, $user_id )
		{
			global $connection, $retrieved;
			$sql = "call update_user('$fname','$lname','$uname','$email', $user_id)";
			$connection->next_result();
			
		  if (	$retrieved = $connection->query($sql) )
		  {  
		  $sql = " call update_question_answer($user_id, $secrect_question, '$secrect_answer' )	";
			$connection->next_result();
			if ($retrieved = $connection->query($sql)) 
			{
			
			
				
				return 1;
			}
		  }
		
			else
			{
					return 0;
			}
			
			
		}
		
		public function load_titles()
		{
			global $connection, $titles_rows, $subject_selected, $retrieved;
			
			$sql =" call load_titles_by_subject( $subject_selected ) ";
			
			$connection->next_result();
			$retrieved = $connection -> query ( $sql );
			
			if ( $retrieved -> num_rows )
			{
				$titles_rows = $retrieved -> fetch_all( MYSQLI_ASSOC );
				return 1;
				
			}
			else
			{
				return 0;
			}
		

			
			
			
		}
		
		
		
		
		public function verify_correct_email( $email )
		{
			global $connection, $retrieved, $userid ,$email_row ;
			
			$sql = " call verify_correct_email('$email') ";
			$connection->next_result();
			$retrieved = $connection -> query( $sql );
			
			if ( $retrieved -> num_rows )
			{
			
			$email_row = $retrieved -> fetch_row();
			
			 $userid =  $email_row[0] ; 
			return 1;
			
			}
			else
			{
				return 0;
				
			}
			
			
			
		}
		
		
			public function load_info()
		{
			global $connection, $fname, $lname, $username, $email, $pswd, $msg,
			$confirm, $secrect_question, $secrect_answer,
			$retrieved, $questions_rows, $user_id;
			
			$sql =" call load_info_by_user_id($user_id) ";
			
			$connection->next_result();
			$retrieved = $connection -> query ( $sql );
			
			if ( $retrieved -> num_rows )
			{
				$info_row = $retrieved -> fetch_row();
				
				$fname = $info_row[0];
				$lname = $info_row[1];
				$username = $info_row[2];
				$email = $info_row[3];
				$secrect_question = $info_row[4];
				$secrect_answer = $info_row[5];
				
				return 1;
				
			}
			else
			{
				return 0;
			}
		

			
			
			
		}
		
		
		
		public function verify_correct_answer($theuser,$thequestion,$theanswer)
		{
			global $connection ,$retrieved ; 
			
			$sql =" call verify_correct_answer($theuser,$thequestion,'$theanswer') ";
			$connection->next_result();
			$retrieved = $connection -> query ( $sql );
			
			if ( $retrieved -> num_rows )
			{
				
				return 1 ;
				
			}
			else
			{
				return 0;
				
				
			}
			
			
			
			
		}
		
		public function Update_Password($password,$user)
{
	global $connection, $retrieved;
	$encryppassword = md5($password);
	$sql = "call user_update_password('$encryppassword',$user)";
	
	$connection->next_result();
	if($retrieved = $connection->query($sql))
	{
		
		return 1;
	}
	else
	{
		return 0;
	}
}
		
		
		
		
		
		public function load_content()
		{
			global $connection,$display_comments, $comments_rows, $user, $blog, $date, $content_row, $title_selected, $posted_user, $posted_date, $retrieved;
			
			if ( $title_selected )
			{
			
				$sql =" call load_blog_content( $title_selected ) ";
				
				$connection->next_result();
				$retrieved = $connection -> query ( $sql );
				
				if ( $retrieved -> num_rows )
				{
					$content_row = $retrieved -> fetch_row();
					
					$blog = $content_row[0];
					$date = $content_row[1];
					$user = $content_row[4]." ".$content_row[4];
					
					$sql = " call load_comments( $title_selected ) ";
					$connection -> next_result();
					
					$retrieved = $connection -> query( $sql );
					
					if( $retrieved ->num_rows )
					{
						$comments_rows = $retrieved -> fetch_all();
						
						 $display_comments = 1;
						
						
						
					}
					
				}
			
			}
			
		}
		
		
		public function load_questions()
		{
			global $connection, $questions_rows, $retrieved;
			
			$sql = " call load_questions() ";
			$connection->next_result();
			$retrieved = $connection -> query ( $sql );
			
			if ( $retrieved ->num_rows )
			{
				$questions_rows = $retrieved ->fetch_all( MYSQLI_ASSOC );
				return 1;
				
			}
			else
			{
				return 0 ;
				
			}
			
			
			
			
			
		}
		
		
		
		
		
		
		
	} // end of class
?>