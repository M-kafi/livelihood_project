<?php	
session_start();

if ( isset( $_SESSION['userid'] ) )
	{
		



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
	$display_buttons = 0;
	
	$status = "";
	$status_row ="";
	$status_selected ="";
$utilities->load_subjects();

 if ( isset( $_POST['save'] ) )
 {

	$title_selected =  $_POST['titles'] ;
	$status_selected = $_POST['status_selected'];
		update_status();
		
		
			
 }
 elseif ( isset ( $_POST['cancel']  ) )
 {
	 
	  header ("Location: ./landingpage.php");	
	 
 }
	 



	
	
	if ( isset ( $_POST['subject'] ) )
	{
		$subject_selected = $_POST['subject'] ;
		
		if( $subject_selected > 0 )
		{
		
		if ($utilities -> load_titles_admin() )
		{
		
				if ( isset( $_POST['titles'] ) )
				{
							$subject_selected = $_POST['subject'] ;
							$title_selected =  $_POST['titles'] ;
							
							
							
							$utilities -> load_content_admin();
							
							if ( $title_selected )
							{
							$display_buttons = 1;
									
									if ( load_status() )
									{
										
										
										$status_selected = $_POST['status_selected'];
										
									 
										
										
										
										
										
									 
									 
									}
									else
									{
										
										
									}
									
							}
							
							
							
					
					
					
					
				}
		}
		
		}
		
	
		
	
		
	}
	 
	

	
	
	
		
		
	}
	else
	{
		 header ("Location: ../index.php");	
	}
	
	
	
	
	
	
	
	//////////////////////////////
	
	
	

	
	
	function update_status()
	{
		global $utilities, $status, $connection, $retrieved, $status_selected, $title_selected ;
		
		
		
		if ( $utilities -> update_status() )
		{
				return 1;
			
		}
		else
		{
			return 0;
		}
		
		
	}
	
	
	
	
	
	
	
	
	function load_status()
	{
		
		global $utilities, $status, $connection, $retrieved, $title_selected , $status_row  ;
		
		
		if ( $utilities -> load_status() )
		{
				return 1;
			
		}
		else
		{
			return 0;
		}
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['create']))
	{	    
	}	
	elseif (isset($_POST['clear']))
	{
	
	}

	
	
	
	
 
?>