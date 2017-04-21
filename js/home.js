$(document).ready(function(){
 

    
    //--------------------to show and hide the navigation bar ---------------
      $("#navBar").hide();
    
    var status = 0;
     $("#burgerButton").click( function(){
     if ( status == 1 )
         {
              $("#navBar").hide(1000);
             status = 0;
         
         }
     else if ( status == 0 )
         {
              $("#navBar").show(1000);
             status = 1;
         }
     
         
  
     
     
 } );

 //--end of th function to show and hide the navigation bar --


        
   // $("#one").hide();
 //  $("#two").hide();
   //$("#three").hide();
    
    
    $("#one").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px' },1000);
    $("#two").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px'}, 2000 );
    $("#three").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px'},3000 );
    
});
     
    
    
    
    
