<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
   
    <div class="search">
    <?php if(isset($advise)){
    echo'<div style="color:red;">';
	echo $advise;
	echo '<hr>';
	echo'</div>';
	}
    echo form_open('search/recherche');
            echo form_error('term'); ?>
     <label for="term" id="term" class="label-control">Mot De Recherche</label>
     <div class="input-group">
      <input type="text" name="term" class="form-control" placeholder="Entrez un mot ou une expression de recherche..." id="term">
      <span class="input-group-btn">
        <input class="btn btn-primary" name="submit"  type="submit" value="Rechercher">
      </span>
    </div>
      <?php
	   form_close();
	  ?>  
      <br><br>
      <br>
      <br>     
</div>
</div>
<div class="col-md-3"></div>
</div>
  </div>