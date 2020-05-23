<?php defined('BASEPATH') OR exit('No direct script access allowed');
function readMore($content, $chars = 128,$id) {
	
	$atts = array(
        'width'       => 800,
        'height'      => 600,
        'scrollbars'  => 'yes',
        'status'      => 'yes',
        'resizable'   => 'yes',
        'screenx'     => 0,
        'screeny'     => 0,
        'window_name' => '_blank');
		
            $content = substr($content,0,$chars);  
            $content = substr($content,0,strrpos($content,' '));  
            $content = $content.' .....'. anchor_popup('search/read_more/'.$id ,' Lire plus ',$atts);  
            return $content;  
        }
?>
<div class="container">
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <p></p>
 <?php
	   if(isset($resp)){
		   
		   echo form_open('search/recherche');
   ?>
    <label for="term" id="term" class="search-label">Mot De Recherche</label>
    <div class="input-group">
      <input type="text" name="term" class="form-control" placeholder="Entrez un mot ou une expression de recherche..." id="term">
      <span class="input-group-btn">
        <input class="btn btn-primary" name="submit"  type="submit" value="Rechercher">
      </span>
    </div><!-- /input-group -->
  
  
       <?php
	   form_close();
		   echo'
		   <br><br>
		   <hr>
		   <br><br>';
		   echo $links;
		  echo' <table style="font-size:1.2rem !important" class="table table-striped table-responsive">
       <tr>
       <th>resultat de recherche</th>
       <th>Posté le</th>
       <th>auteur</th>
       </tr>';
	   	foreach($resp->result() as $val):
	  echo' <tr>
       <td style="width:60%;">
	   '.$val->topic_title.'<br>
	   '.readMore($val->post_text, 128,$val->post_id).'<br>
	   
	   </td>
       <td>'.date("d/M/Y h:i:s", $val->post_time).'</td>
       <td>'.$val->member_pseudo.'<br>';
	   if($val->member_avatar!='aghnostos'){
	   
	   echo'<img alt="avatar" src="'.thumb(base_url('assets/uploads/'.$val->member_avatar),30,30).'">';
	   
	   }
	   else{
	 echo'<img alt="avatar" src="'.thumb(base_url('assets/upload/aghnostos.png'),30,30).'">';
		   }
	   echo'<br>
	   inscrit: le '.date("d/M/Y à h:i:s", $val->post_time).'
	   
	   </td>
       </tr>';
	   endforeach;
	      
      echo' </table>';
       echo $links;
       }
	   ?>
</div>
    <div class="col-md-2"></div>
    </div></div>