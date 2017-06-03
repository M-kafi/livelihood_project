<?php

$name = "";
$email = "";
$phone = "";
$message = "";
$note    = "";


if ( isset($_POST['send']) )
{

$name =  $_POST['name'];
$email =  $_POST['email'];
$phone =  $_POST['phone'];
$message =  $_POST['message']."\n\r"."Sender email: ".$email."\n\r"."Phone: ".$phone ;

$to = "mohamadkafi1985@gmail.com" ;
$subject = "Email from contact us in Livelihood website";
$header = "From: livelihodd@example.com";

mail($to,$subject,$message,$header);

$note ="Your message has been submitted!";


}

?>


<!doctype html>
<html>


<head>

    <!-- add the title here -->
     <title> contact us </title>
    
    <!-- meta data   >>>>>>>>>>>>>>>>>>>>>>>>>>>> needs to be added <<<<<<<<<<<<<<<<<<<  -->
      <meta charset="UTF-8">
      <meta name="description" content="Greater support for skills development among disadvantaged groups, and for workers in low-skills jobs most likely to be affected by automation will be critical to developing an economy that works for all. Livelihood Project's objective is to constantly innovate in evidence based future skills development among people facing barriers to sustainable and resilient employment. We employ digital and data technology as well as advances in behavioural science to achieve our objective, Toronto, Canada.">
      <meta name="keywords" content="future skills, soft skills, skills development, sustainable livelihood, economic integration,Toronto, Canada">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <!----------------------------------- css ----------------------------------------->
    
     <link rel="stylesheet" type="text/css" href="css/contact_us.css" >
    
    <!-- font's links -->
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Average+Sans" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Abel|Amatic+SC|Asap|Signika|Tenali+Ramakrishna" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
    
    <!-- css ends here -->
    
    <!----------------------------------links-------------------------------------->
    
    <!-----Jquery from google CDN----->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   
     <!-----reference to js file for this page home.js----->
    <script src="./js/home.js" >  </script>

</head>

<body>

    <!-- the main element includes the all document page -->
    <main>
        
        <!--header element for logo -->
        <header><a id="logo" ></a></header>
        
        
        <!-- nav element for the navigation bar -->
          <a id="burgerButton" ></a>
        <nav id="navBar" > 
            <a>Home</a>
            <a>Introduction</a>
            <a>Our Story</a>
            <a>Our ambition</a>
            <a>Contact us</a>
        
        </nav>
        
        
        
 <!--------First section  ---------->
 
        <section  id = "first_section"  >
            
            <?php echo $note; ?>
            
            <section  id = "float_container" >
        <section id="contact_form" >
            <h3 id ="header_text" >Submit your question or comment</h3>
            
            <form action="" method="post" >
            
            <input type = "text" name="name" placeholder = "Name... " class="input_a" />
            <input type ="tel" name="phone" placeholder = "Phone..."  class="input_a" /> 
            
            <br />
                
            <input type="email" name="email" placeholder = "Email..." class="input_b" />
            <br />
            <br />
             
            
            <textarea name="message" rows="5" cols="50" placeholder="Message..."  class ="input_c" ></textarea>
            <br />
            <br />
            <input type="submit" value = "Send" name="send"  />
            
            </form>
            
        </section>
            
        <section id="directions" >
            <p>visit us at Livelihood cafe 25, Augusta . ONtario</p>
            <p>Directions: </p>
            
            <div id = "map_img" >
            
            
            </div>
            
            
            
        </section>
                
                
    </section>
            
         <section id="contact_details" >
            <p>
                Email: hello@livelihoodproject.org<br />
                Phone number: 647 - 687 - 5187 
             </p>
                 
                 
           
            
            
            
        </section>
            
            
               
            <section id="social_media" >
           <span id ="social_media_title" >Social media:</span><br />
           <a class="social_media_link" > <img class="social_media_img" src = "images/Fb.png" alt = "facebook"  />  </a>
           <a  class="social_media_link"> <img class = "social_media_img" src = "images/Tw.png" alt = "twitter"  />  </a>
           <a class="social_media_link" > <img class = "social_media_img" src ="images/In.png" alt = "instagram"  />  </a>
                 
                  Social media:<br /> 
           
            
            
            
        </section>
            
            
        
        </section>
            
            
            
              
 <!--------END of fifth section  ---------->
          
            
<!------------ Footer -------------- >




<!-----------END of footer ---------------->
            
            
            
         </article>
        
        </section>
  <!-- End of the second section of the page -->
    
    
    
    
    
    
    
    
    </main>
    
    
    
    
    
    
    
    
</body>    
    
    
    
    
</html>    