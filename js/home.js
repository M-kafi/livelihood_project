$(document).ready(function(){
  

    

    change_text();
  
    
    

    
    
    setInterval(function() {
            // code to be repeated
         $("#b").hide();
  $("#a").hide().fadeIn(5000).fadeOut(3000,  function(){   $("#b").fadeIn(5000).fadeOut(3000);    } );
        
      }, 16000); // every 1000 ms
    
    function change_text(){
   
    $("#b").hide();
  $("#a").hide().fadeIn(5000).fadeOut(3000,  function(){   $("#b").fadeIn(5000).fadeOut(3000);    } );
           
        
    };
   
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

 //--end of the function to show and hide the navigation bar --

    
    
    $("#one").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px' },1000);
    $("#two").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px'}, 2000 );
    $("#three").animate({width:'250px', paddingleft:'20px', opacity: '1', right: '0px'},3000 );
    
    
    
    
    //--------------projects section------------
    
   
    
    
        
    if ( $(window).width() > 1025) {      
  //Add your javascript for large screens here 
        
        
   

    
    //---- trigger the event when the mouse over the element -----
    $(".part").mouseover( function(){
        
        
        
        var el = this ;
        
        //--- only start the event if the mouse stays for specific time over the element ---
         start = setTimeout(function(){ 
         $( el).nextAll().animate({left: '+=2.5%'});
        $( el).prevAll().animate({left: '-=2.5%'});
       $( el).animate({width: '+=5%',
                         left: '-=2.5%',
                        zIndex:'9'
                        
                        });
                         
        //--- after the event is done change the value to 1                 
               done = 1;          
                         
                         
                         
                         }, 500);
      
        
      
    } );
  
    
    
    //----- trigger the event only if the mouse leaves the element and the done is 1
     $(".part").mouseout( function(){
         
         //--- stop the time out event to not trigger the first event and not doing any changes ---
          clearTimeout(start);
        
         
         
         var el  = this;
         
         //---- if the previous event occurred then trigger the event to set the properties to it's initial values ----
         if ( done == 1 )
             {
       $( el).nextAll().animate({left: '-=2.5%'});
          $( el).prevAll().animate({left: '+=2.5%'});
         $( el).animate({width: '-=5%',
                          left: '+=2.5%',
                            zIndex:'5'
                          
                          });
                 done = 0;
             }
                          
        
    } );
    
        
        
        } 
else {
  //Add your javascript for small screens here 
}
 
    
    
    



    

    
});
     


    

    
 //-------END of project section ------   
    
    //----- change the text of the header in the project section ----

    







//------END of changing the text in projects section -----
