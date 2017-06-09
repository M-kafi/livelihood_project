<?php	

session_start();

include('../data/dbfile.php');
include('../utility.php');


global $connection, $retreived ,$content;

$user_name ="";
$subject = "";
$title = "";
$date  = date("d/m/Y");
$comment ="";
$msg="";


$utilities = new myfunctions;

	if ( isset( $_SESSION['userid'] ) )
	{
		
		if ( isset( $_SESSION['blog_id'] )  )
		{
			
			 $user       = $_SESSION['userid'];
			$blog_id    = $_SESSION['blog_id'];
		    $subject_id = $_SESSION['subject_id'];
			
            if ( load_content_for_comment() )
			{
				if ( isset ( $_POST['comment'] ) )
				{
					$comment = $_POST['comment_text'];
					
					if ( !empty($comment) )
					{
						
					
							if ( add_new_comment() )
							{
								
								
								unset ( $_SESSION['blog_id'] );
								unset ( $_SESSION['subject_id'] );
								
								header ( "Location: ./landing.php" );
								
							}
							
					}
					else
					{
						
						$msg = "Please enter your comment!";
					}
					
				}
				elseif ( isset ( $_POST['cancel'] ) )
				{
					
					
								
								unset ( $_SESSION['blog_id'] );
								unset ( $_SESSION['subject_id'] );
								
								header ( "Location: ./landing.php" );
								
					
				}
		
					
				
			}
			
			
			
			
			
			
			
		}
		else
		{
			
			echo "error! can't find the blog id";
			
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	else
	{
		 header ("Location: ../index.php");	
	}
	

	
	
	
	
	
	
	//////////////////////////////////////////////
	
	
	
	function add_new_comment()
	{
		global $utilities, $comment, $user, $blog_id, $subject_id, $connection, $retreived ,$content ;
		
		if (	$utilities -> add_new_comment() )
	 {
		 return 1;
	 }
	 else
	 {
		 return 0;
	 }
		
		
	}
	
	
	
	function load_content_for_comment()
	{
		global $utilities, $user, $blog_id, $subject_id, $connection, $retreived ,$content ;
		
	 if (	$utilities -> load_content_for_comment() )
	 {
		 return 1;
	 }
	 else
	 {
		 return 0;
	 }
		
		
	}
 
?>