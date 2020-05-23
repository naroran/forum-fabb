<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title> bad bot</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- jQuery library  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
body{margin-top:5rem;font-size:1.2rem;}


h1{ margin:1.5em 0; text-align:center;
font-size:2.5em;
text-shadow: 0 0 5px #FFF, 0 0 10px #FFF, 0 0 15px #FFF, 0 0 20px #6A2D73, 0 0 30px #6A2D73, 0 0 40px #6A2D73, 0 0 55px #6A2D73, 0 0 75px #6A2D73;
color: #FFFFFF;
}	
h3{ margin-left:1.5rem; 
font-size:1.5rem;
color:#6B6B6B;}
p.content{ line-height:2.2rem; margin:2rem 1.5rem;color:#6B6B6B;}
.central{background: rgba(141,154,241,0.5); border-radius:5px;
    padding:0 0 !important;}
	.footer{padding-top:20px;
	background-color:#2D2D2D; 
	color:#FFFFFF; 
	border-bottom-right-radius:5px; 
	border-bottom-left-radius:5px;
		}	
</style>
</head>
<body>
<div class="container">
                  <div class="row">
                  <div class="col-md-1"></div>
                          <div class="col-md-10 central">
                              
                                 <h1>forum fabb</h1>   

	<?php
	
	 if(has_alert()):  
		foreach(has_alert() as $type => $message): ?>  
			<div class="alert alert-dismissible <?php echo $type; ?>">  
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<?php echo $message; ?>  
			</div>  
		<?php endforeach;  
	endif; 
	echo br(5);
	?>
 <div class="footer">
        <div class="row">
        <div class="col-md-12">
        <p style=" text-align:center;font-size:80%; font-style:italic;">
        Powered by <a href="https://www.forum-fabb.com/"> fabb</a> ® Version 1.0.0<br>
        Copyright © 2018 All rights reserved.</p>
        </div>
        </div>        
        </div>
        </div>
<div class="col-md-1"></div>
</div></div>
 </body>
</html>