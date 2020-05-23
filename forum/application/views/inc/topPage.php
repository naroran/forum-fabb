<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?> 
<header>
<div class="container-fluid banner">
<div class="row">
                 <div class="col-md-6 slogan">
                 <h1 class="ownwebsite text-center"><?= $this->config_model->title_forum(); ?></h1> 
                 
				 <?php
				 if(isset($logo)){
				 echo'
               <a href="'.home().'"><img height="40" width="40" class="img-responsive" src="'.base_url('/assets/uploads/'.$logo).'"  alt="logo"/></a>' ;}
				 ?> 
				 
				 <p style="text-align:center !important;">
				<span class="fslogan"> <?= $this->config_model->first_slogan();?></span>
                 </p> 
                          
                 </div>                 
                  <div class="col-md-6 sloganh3">
                  <?=br(2)?>
                 <img class="img-responsive" src="<?= base_url('/assets/uploads/'.$pic)?>"  alt="forum fabb" height="100" width="150">
                 <p class="fslogan"> <?= br(1).nl2br($this->config_model->second_slogan()).br(2); ?></p>             
                 </div>
</div>
<div class="row">
<div class="col-md-5"></div>
<div class="col-md-2">
<?php
if($this->avatar)
{
echo'<img class="img-responsive img-circle" src="'.thumb($this->avatar,40,40).'" alt=" no avatar"/>';
}
?> 
</div>
<div class="col-md-5"></div>
</div>
</div>
</header>