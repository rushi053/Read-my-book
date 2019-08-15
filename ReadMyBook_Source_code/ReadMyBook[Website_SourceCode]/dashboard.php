 <?php  
 
 if(isset($_POST["gatsby"]))  
 {  
      
           if(file_exists('user_books.json'))  
           {  
                $current_data = file_get_contents('user_books.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'book_name'               =>     'the great gatsby'
                       
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                file_put_contents('user_books.json', $final_data);
                
           }  
           
 } 
 
 if(isset($_POST["london"]))  
 {  
      
           if(file_exists('user_books.json'))  
           {  
                $current_data = file_get_contents('user_books.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'book_name'               =>     'London chronicles' 
                       
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                file_put_contents('user_books.json', $final_data);
           }
        
 } 
 
 
 
 if(isset($_POST["suzy"]))  
 {  
      
           if(file_exists('user_books.json'))  
           {  
                $current_data = file_get_contents('user_books.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'book_name'               =>     'suzy'  
                  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                file_put_contents('user_books.json', $final_data);
           }
 } 
 
  if(isset($_POST["twin"]))  
 {  
      
           if(file_exists('user_books.json'))  
           {  
                $current_data = file_get_contents('user_books.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'book_name'               =>     'twin paradox',  
                  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                file_put_contents('user_books.json', $final_data);
           }
 } 
 ?>

<DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html"><small>Read my book</small></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
	          
              <li class="nav-item"><a href="index.html" class="nav-link">Logout</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	          
	        </ul>
	      </div>
		  </div>
	  </nav>
    <!-- END nav -->
 

    <section class="ftco-menu mb-5 pb-5">
    	<div class="container">
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		          <div class="col-md-12 nav-link-wrap mb-5">
		            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		            	<a class="nav-link active" id="v-pills-0-tab" data-toggle="pill" href="#v-pills-0" role="tab" aria-controls="v-pills-0" aria-selected="true">Popular</a>

		              <a class="nav-link" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="false">Sci-fi</a>

		              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Mystery</a>

		              <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Romance</a>
		            </div>
		          </div>
		         <form method="post">
		             
		          <div class="col-md-12 d-flex align-items-center">
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-0-tab">
		              	<div class="row">
		              		<div class="col-md-3">
						        		<div class="menu-entry">
						    					<a href="#" class="img" style="background-image: url(images/menu-1.jpg);"></a>
						    					<div class="text text-center pt-4">
						    						<h3><label name="book_name">The Great Gatsby</label></h3>
						    						<p>A small river named Duden flows by their place and supplies</p>
						    						
						    						<p><input type="submit" name="gatsby" value="Add to Alexa" class="btn btn-primary" /></p>
						    					</div>
						    				</div>
						        	</div>
						        	<div class="col-md-3">
						        		<div class="menu-entry">
						    					<a href="#" class="img" style="background-image: url(images/menu-2.jpg);"></a>
						    					<div class="text text-center pt-4">
						    						<h3><a href="">London Chronicles</a></h3>
						    						<p>A small river named Duden flows by their place and supplies</p>
						    						
						    						<p><input type="submit" name="london" value="Add to Alexa" class="btn btn-primary" /></p>
						    					</div>
						    				</div>
						        	</div>
						        	
						        	
						        	<div class="col-md-3">
						        		<div class="menu-entry" >
						    					<a href="#" class="img" style="background-image: url(images/menu-3.jpg);"></a>
						    					<div class="text text-center pt-4">
						    						<h3><a href="">Suzy</a></h3>
						    						<p>A small river named Duden flows by their place and supplies</p>
						    						<p><input type="submit" name="suzy" value="Add to Alexa" class="btn btn-primary" /></p>
						    						
						    					</div>
						    				</div>
						        	</div>
						        	<div class="col-md-3" >
						        		<div class="menu-entry">
						    					<a href="#" class="img" style="background-image: url(images/menu-4.jpg);"></a>
						    					<div class="text text-center pt-4">
						    						<h3><a href="">The Twin Paradox</a></h3>
						    						<p>A small river named Duden flows by their place and supplies</p>
						    						
						    						<p><input type="submit" name="twin" value="Add to Alexa" class="btn btn-primary" /></p>
						    					</div>
						    				</div>
						        	</div>
						        	 
		              </div>
		              	
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
    	</div>
    </section>

   
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>