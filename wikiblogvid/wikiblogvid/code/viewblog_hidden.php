<?php	

include('../data/dbfile.php');
include('../utility.php');
$utilities = new myfunctions;

	$subjects_rows = "";
	$retrieved = "";
	$subject_selected = "";
	$titles_rows = "" ;
	$title_selected = "";
	
	$user          = "";
	$date          = "";
	$blog          = "";
	$posted_user   = "";
	$posted_date   = "";
	$content_row   = "";
	$comments_rows = "";
	$display_comments = 0;
	
	
	
	
	
	if ( isset ( $_POST['subject'] ) )
	{
		$subject_selected = $_POST['subject'] ;
		
		if( $subject_selected > 0 )
		{
		
		if ($utilities -> load_titles() )
		{
		
		if ( isset( $_POST['view'] ) )
		{
			$subject_selected = $_POST['subject'] ;
			$title_selected =  $_POST['titles'] ;
			
			
			
			$utilities -> load_content();
			
			
			
			
			
			
			
		}
		}
		
		}
		
		
		
		
		
	}
	
	
$utilities->load_subjects();

	$fname = "";
	$lname = "";
	$username ="";
	$email = "";
	$pswd = "";
	$msg = "";
	$confirm = ""; 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['create']))
	{	    
	}	
	elseif (isset($_POST['clear']))
	{
	
	}

	
	
	
	
 
?>