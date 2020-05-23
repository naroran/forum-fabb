<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
  <!--Footer-->
  
<footer>
<div style=" padding-top:20px;background-color:#2D2D2D; color:#FFFFFF;" class="container-fluid" >
<div class="row">
<div class="col-md-12">
      <div class="container">
          <div class="row">
          <div class="col-md-6">
          <p class="add-footer">Get connected with us on social networks!</p>
          
          </div>
          <div class="col-md-6">
          
    <div class="social_media"><a href="<?php echo $this->config_model->linkedin()?>"><img alt="linkedin" class="img-responsive" src="<?= base_url('assets/img/linkedin.png')?>"></a>
    </div>
    <div style="width:5px;" class="social_media"></div>
    
    <div class="social_media"><a href="<?php echo $this->config_model->twitter()?>"><img alt="twitter" class="img-responsive" 
    src="<?=base_url('assets/img/twitter.png')?>"></a></div>
    
    <div style="width:5px;" class="social_media"></div>
    <div class="social_media"><a href="<?php echo $this->config_model->facebook()?>"><img alt="facebook" class="img-responsive" src="<?= base_url('assets/img/facebook.png')?>"></a></div>
    <div style="width:5px;" class="social_media"></div>
 
          </div>
          </div>
      </div>
      <div class="container">
          <div class="row">
          <div class="col-md-12"><hr style="color:#89A0EF;"> </div>         
          </div>
      </div>      

      <div class="container">
          <div class="row">
          <div class="col-md-12 text-center"> 
<?php
if(isset($start_time)){
$delai=number_format((microtime(true)-$start_time),6);
    echo' <p style=" text-align:center;font-size:80%; font-style:italic;">forum fabb Powered by <a href="https://www.forum-fabb.com/"> fabb </a> ® Version 3.0.0<br>
Copyright © 2018 fabb Solutions, All rights reserved.<br>';
echo 'This page is generated in '. $delai.' secondes. fabb is running on codeigniter'  ;
}
else{
     echo'<p style=" text-align:center;font-size:80%; font-style:italic;">Powered by <a href="https://www.forum-fabb.com/"> fabb</a> ® Version 3.0.0<br>
Copyright © 2018 All rights reserved. fabb is running on codeigniter<br>';
}
?>
<br><br>
</p> </div>        
          </div>
      </div>      
         </div></div></div>         
</footer>
  <!--/ Footer-->

        <div class="overlay"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- JavaScript Bootstrap CDN -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>
$(document).ready(function(){
  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
});


</script>


<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>


<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script>
$(document).ready(function(){
  $("#mybad").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mybadwords tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
 </body>
</html>