<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
<div class="row">
<br>
<div class="col-md-3">

            <!-- column1, Vertical Dropdown Menu -->
            <div id="main-menu" class="list-group">
            <a href="<?= base_url('member/index/'.$this->idM)?>" class="list-group-item active">Dashbord</a>
            <div style="height:2px; width:auto; color:#B8B350;"></div>
            
            <a href="<?=base_url('member/view_profil/'.$this->idM)?>" class="list-group-item active">Mon Profil</a>
            <div style="height:2px; width:auto; color:#B8B350;"></div>
            
           <a href="<?=base_url('update/profile/'.$this->idM)?>" class="list-group-item active">Update Profil</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div> 
           
           <a href="<?= base_url('member/member_list/'.$this->idM.'/')?>" class="list-group-item active">Liste des membres</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div>
           
           <a href="<?=base_url('member/select_friend/'.$this->idM.'/')?>" class="list-group-item active">Ajouter un ami</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div> 
           
           <a href="<?=base_url('liste/amis/'.$this->idM)?>" class="list-group-item active">Listes des amis</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div>  
         
           <a href="#sub-menu" class="list-group-item active" data-toggle="collapse" data-parent="#main-menu">Messagerie 
           <span style="margin-right:10px;" class="caret"></span></a>
           
           <div class="collapse list-group-level1" id="sub-menu">
           <a href="<?= base_url('boite/messagerie/'.$this->idM)?>" class="list-group-item" data-parent="#sub-menu">Consulter</a>
            <a href="<?= base_url('nouveau/message/'.$this->idM)?>" class="list-group-item" data-parent="#sub-menu">Ecrire</a>
            </div>
            <div style="height:2px; width:auto; color:#B8B350;"></div>
            
           <a href="<?=base_url('member/del_account/'.$this->idM)?>" class="list-group-item active">Supprimer Son Compte</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div> 
           
           <a href="<?=base_url('logout') ?>" class="list-group-item active">Deconnexion</a>
           <div style="height:2px; width:auto; color:#B8B350;"></div> 
            </div>
        

</div>
<div class="col-md-9">

<?php
switch($render){
		case 'view profil':
	foreach($rep->result() as $value):
	?>
    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
    <li class="active">Consulter Profil</li>
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Consulter Son Profil : <strong><?= $value->member_pseudo?> </strong></th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page, vous pouvez consulter votre profil.<br>
          Si vous souhaiter apporter des modifications à votre profil, veuillez cliquer sur modifier en fin de page ou à gauche de cette fen&ecirc;tre sur Update Profil.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
    <?php		


	  echo' <table style="font-size:1.2rem" class="table table-striped table-responsive"> 
        <tr>
        <th>Renseignements sur le profil</th>             
        <th>Data</th>
        </tr> 
		<tr>
		<td>Pseudo</td>
		<td>'.htmlspecialchars($value->member_pseudo).'</td>
		</tr>
		<tr>
		<td>Adresse e-Mail</td>
		<td> '.htmlspecialchars($value->member_email).'</td>
		</tr>
		<tr>
		<td>Date Inscription</td>
		<td> Inscrit depuis '.date('d-m-Y',$value->member_registred).'</td>
		</tr>
		<tr>
		<td>Pays</td>
		<td>'.htmlspecialchars($value->member_location).'</td>
		</tr>
        <tr>
		<td>Avatar</td>
		<td><img src="'.thumb(base_url('assets/avatar/'.$value->member_avatar),60,60).'"
       alt="Ce membre n a pas d avatar" /></td>
		</tr>
				<tr>
		<td>Téléphone</td>
		<td>'.htmlspecialchars($value->member_phone).'</td>
		</tr>
				<tr>
		<td>Status</td>
		<td>'.htmlspecialchars($value->member_level).'</td>
		</tr>
				<tr>
		<td>Signature</td>
		<td>'.htmlspecialchars($value->member_signature).'</td>
		</tr>
				<tr>
		<td>Nom</td>
		<td>'.htmlspecialchars($value->member_name).'</td>
		</tr>
				<tr>
		<td>Prénom</td>
		<td>'.htmlspecialchars($value->member_forname).'</td>
		</tr>
				<tr>
		<td>Age</td>
		<td>'.htmlspecialchars(check_age($value->member_age)).'</td>
		</tr>
				<tr>
		<td>Sexe</td>
		<td>'.htmlspecialchars($value->member_gender).'</td>
		</tr>
				<tr>
		<td>Occupation</td>
		<td>'.htmlspecialchars($value->member_work).'</td>
		</tr>
				<tr>
		<td>Avertissement</td>
		<td>'.htmlspecialchars($value->member_warning).'</td>
		</tr>
				<tr>
		<td>Motif</td>
		<td>'.htmlspecialchars($value->member_ban_reason).'</td>
		</tr>
				<tr>
		<td>Site web</td>
		<td>'.htmlspecialchars($value->member_website).'</td>
		</tr>
		<tr>
		<td>Total de Sujets</td>
		<td>'.htmlspecialchars($value->tt_topic).'</td>
		</tr>
		<tr>
		<td>Nombre De Poste</td>
		<td>'.htmlspecialchars($value->member_post).'</td>
		</tr>
		
				<tr>
		<td>Notification</td>';
		if($value->member_notify==1){$notify= 'Vous avez choisi d\'ccepter les Notifications';}
		else{$notify= 'Vous avez refusé les Notifications';}
		
		echo'<td>'.$notify.'</td>
		</tr>


		</table>';
		endforeach;
	   



          echo '<p><a class="btn btn-success btn-sm"  href="'.$this->agent->referrer().'"> Retour </a> | 
		  <a class="btn btn-success btn-sm"  href="'.base_url('update/profile/'.$this->idM).'"> Mettre à Jour </a></p>';
	   
	  
	
	break;
//------------------------------------------ update profil -------------------------------------

case 'update profil':
?>
    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
    <li class="active">Update Profil</li>
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Mettre à jour Son Profil :<?php if(set_value('pseudo')){echo' <strong>'. $value->member_pseudo.' </strong>';}?></th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page, vous pouvez mettre à jour votre profil.<br>
          Si vous souhaiter apporter des modifications à votre profil, nous vous rappelons que par mesure de sécurité votre mot de passe actuel est obligatoire.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
<?php


	$action=base_url('update/profile/'.$this->idM);
$attributs=array('name'=>'update_profil',
                 'autocomplete'=>'on',
				 'class="form-horizontal"');
$hidden=array('address_ip'=>$_SERVER['REMOTE_ADDR']
			  );
		  
echo form_open_multipart($action,$attributs,$hidden);

		foreach($query->result() as $val):

		$email=set_value('email')?set_value('email'):$val->member_email;
		$phone=set_value('tel')?set_value('tel'):$val->member_phone;
		$website=set_value('website')?set_value('website'):$val->member_website;
		$location=set_value('localisation')?set_value('localisation'):$val->member_location;
		$name=set_value('nom')?set_value('nom'):$val->member_name;
		$forname=set_value('prenom')?set_value('prenom'):$val->member_forname;
		$work=set_value('func')?set_value('func'):$val->member_work;
		$signature=set_value('signature')?set_value('signature'):$val->member_signature;		
		
		echo'   <div class="form-group ">
		      <label class="control-label col-sm-3" for="pseudo">Pseudo</label> 
			  
			  <div class="col-sm-5">
              <input class="form-control input-sm" name="pseudo" type="text" id="pseudo" value="'.$val->member_pseudo.'" readonly disabled >
			  
              </div></div>'.br(3);
			//  ----------------------------------------------------------------
			
				echo' <div class="form-group">
				'.form_error('act').'
		      <label class="control-label col-sm-3 text-muted" for="act">Password Actuel 
			  <span data-toggle="tooltip" title="Pour effectuer une modification dans votre profil et par mesure de securité vous devez renseigner votre mot de passe actuel.">'.nbs(2).$this->config->item('required').'</span> 
			  
			  </label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm" type="password" name="act" id="act" >
			  </div></div>'.br(2);	  
		//--------------------------------------------------------------------------------
			
			  echo' <div class="form-group">
			  '.form_error('password').'
		      <label data-toggle="tooltip" title="vous n\'etes pas obligé de changer votre mot de passe mais vous pouvez le faire si vous le desirez." class="control-label col-sm-3" for="password">Nouveau mot de Passe </label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm " type="password" name="password" id="password" >
			  </div></div>'.br(2);
//-------------------------------------------------------------------------------------
               
				echo' <div class="form-group">
				'.form_error('confirm').'
		      <label class="control-label col-sm-3" data-toggle="tooltip" title="Confirmez votre nouveau mot de passe." for="confirm">Confirmer MDP</label> 
			  
			  <div class="col-sm-5">
			 
              <input class="form-control input-sm " type="password" name="confirm" id="confirm">
			  </div></div>'.br(2);
//------------------------------------------------------------------------------------------------			  			  	
				echo' <div class="form-group">
				'.form_error('email').'
		      <label class="control-label col-sm-3" data-toggle="tooltip" title="Si vous changez votre adresse e-mail, vous devez la reconfirmer, autrement pas mal de services sur le site vous seront retirés" for="email">Adresse e-mail </label>
 
			  
			  <div class="col-sm-5">
              <input class="form-control input-sm " type="text" name="email" id="email" value="'.$email.'">
			  </div></div>'.br(2);	
//--------------------------------------------------------------------------------------------------			  		  		
echo' <div class="form-group">
'.form_error('tel').'
		      <label class="control-label col-sm-3" data-toggle="tooltip" title="Votre numero de telephone sans espace entre les chiffres." for="tel"> Téléphone </label>
 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm " placeholder="exemple: 12345678912345 sans espace ni symbol" type="tel" name="tel" 
			  id="tel" value="'.$phone.'">
			  </div></div>'.br(2);	
//---------------------------------------------------------------------------------------------------------			  	
		echo' <div class="form-group">
		'.form_error('website').'
		      <label class="control-label col-sm-3" data-toggle="tooltip" title="Si vous avez un site web, vous pouvez renseigner son URL, sinon laissez vide." for="website">Site web </label>
 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm " type="url" name="website" id="website" value="'.$website.'">
			  </div></div>'.br(2);	
//-------------------------------------------------------------------------------------------------------			  
				echo' <div class="form-group">
				'.form_error('localisation').'
		      <label class="control-label col-sm-3" for="localisation">Pays </label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm" type="text" name="localisation" id="localisation" 
			  value="'.htmlspecialchars($location).'">		  
			  </div></div>'.br(2);	
//--------------------------------------------------------------------------------------------------------------		
					echo' <div class="form-group">
					'.form_error('nom').'
		      <label class="control-label col-sm-3" for="nom">Nom</label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm" type="text" name="nom" id="nom" value="'.htmlspecialchars($name).'">		  
			  </div></div>'.br(2);	
//---------------------------------------------------------------------------------------------------------			  	
							echo' <div class="form-group">
							'.form_error('prenom').'
		      <label class="control-label col-sm-3" for="prenom">Prenom</label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm" type="text" name="prenom" id="prenom" value="'.htmlspecialchars($forname).'">		              </div></div>'.br(2);	
	//---------------------------------------------------------------------------------------------		  
		
				echo' <div class="form-group">
		      <label class="control-label col-sm-3" data-toggle="tooltip" title="Votre age est calculé en fonction de votre DDN exacte."  for="age"> Age </label> ';
			  if($val->member_age==false){
				  $age='Non renseigné';
				  }else{$age=check_age($val->member_age);}
			  
			 echo' <div class="col-sm-5">
              <input class="form-control input-sm" type="text" disabled readonly value="'.$age.'">		             
			   </div></div>'.br(2);	
//-----------------------------------------------------------------------------------------------
				echo' <div class="form-group">
		      <label class="control-label col-sm-3" data-html="true" data-toggle="tooltip" title="Si vous n\'avez pas renseigné votre DDN ou si vous vous etes trompé, vous pouvez modifier votre date de naissance ci-dessous. 
			   <br> DDN= Date De Naissance" for="ddn">Modifier DDN</label> 
			  
			  <div class="col-sm-5">
			  
       <input class="form-control input-sm" type="text" name="ddn" placeholder="Exemple: 24/12/1970">
	   		
			</div></div>'.br(2);	
//------------------------------------------------------------------------------------			   			   	
			
				echo' <div class="form-group">
				<label class="control-label col-sm-3" for="sexe">Sexe </label> 
			  
			  <div class="col-sm-5">
              <input class="form-control input-sm" type="text" disabled readonly value="'.$val->member_gender.'">		             
			   </div></div>'.br(2);	
//----------------------------------------------------------------------------------------------------
			  echo' <div class="form-group">
		      <label class="control-label col-sm-3" for="sexe">Definir Son Sexe</label>
			  
			<div class="col-sm-5">
			<select class="form-control input-sm" id="sexe" name="sexe">
			<option value="undefined">Choisir</option>
			<option value="homme">Homme</option>
			<option value="femme">Femme</option>
            </select>
			   </div></div>'.br(2);	  
	//----------------------------------------------------
					echo' <div class="form-group">
					'.form_error('func').'
				<label class="control-label col-sm-3" data-toggle="tooltip" title="Vous pouvez nous faire connaitre votre fonction, cela nous aidera enormement à mieux selectionner les messages pertinents qui peuvent vous interesser. " for="func">Occupation</label> 
			  
			  <div class="col-sm-5">
			  
              <input class="form-control input-sm" type="text" name="func" id="func" value="'.htmlspecialchars($work).'" />	             
			   </div></div>'.br(2);	
	//-----------------------------------------------------------------------------------------

		echo' <div class="form-group">
				<label class="control-label col-sm-3">Avatar Actuel </label> 
			  
			  <div class="col-sm-5">
<img data-toggle="tooltip" title="Si vous dicidez de modifier votre avatar actuel, un nouveau avatar (par defaut) vous sera attribué  automatiquement."  class="img-thumbnail" src="'.thumb(base_url('assets/avatars/'.$val->member_avatar),30,30).'" alt="pas d avatar" />             
			   </div></div>'.br(2);		
//----------------------------------------------------------------------------------------------

					echo' <div class="form-group">
					'.form_error('avatar').'
				<label class="control-label col-sm-3" for="avatar">Modifier Son Avatar</label> 
			  
			  <div class="col-sm-5">
			  
               <input class="btn-success" type="file" name="avatar" id="avatar" />
              <span style="font-size:11px;color:red">évitez les images sombres, foncées ou totalement noires</span>              
			   </div></div>'.br(2);	
//-----------------------------------------------------------------------------------------------------
					echo' <div class="form-group">
				<label class="control-label col-sm-3"  for="notify">Notification</label> 
			  
			  <div class="col-sm-5">
			   <input type="radio" name="newsltr" checked value="1"> Accepter<br>
               <input type="radio" name="newsltr" value="0"> Refuser<br>
			   </div></div>'.br(2);				   			   		   		   		
//---------------------------------------------------------------------------------------

			echo' <div class="form-group">
			'.form_error('signature').'
				<label class="control-label col-sm-3" data-html="true" data-toggle="tooltip" title="La signature est votre 
				slogan, 
				votre proverbe préféré ou toute expression de sagesse dans laquelle plongent vos convictions<br>
				Max :: '.$this->config_model->signature().' caractères.
				" 
				for="signature">Signature</label> 
			  <div class="col-sm-5">
                <textarea class="form-control" rows="5wh" name="signature" id="signature">
				 '.trim(htmlspecialchars($signature)).'</textarea>             
			      </div></div>';				
					
				
			echo' <div class="form-group">
				<label class="control-label col-sm-3" > </label>
				
							  <div class="col-sm-5"><br><br>';	
					
					
		?>
        
        <input class="btn btn-success btn-sm" type="submit" value="Valider" data-toggle="tooltip" title="Acceptez et validez les changements et modifications de votre profil "/> | 
        <input type="reset" class="btn btn-success btn-sm" value="Reset" data-toggle="tooltip" title="Efface toutes les données actuelles renseignées dans les champs. " /> | 
        
        <a href="<?=base_url('member/index/'.$this->idM)?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="Quitter sans rien modifier, vous serez redirigé vers le paneau U-Panel.">U-Panel</a>
        <br><br>
                </div></div>
                </form>
        
		<?php
	   
		endforeach;

	break;
	
//----------------------------------------------- member liste ----------------------------------------

case'list membre':

?>
    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Liste Membres</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Liste Des Membres </th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page, vous pouvez consulter la liste des membres du forum .<br>
          Vous pouvez afficher la liste des membres selon les critères de choix disponibles. Pour revenir à l'affichage par defaut          cliquez sur : <strong>default</strong> dans le champ de selection Nbr de lignes.<br> 
          <strong style="background-color:rgb(85,85,85); padding:2px;">Astuce de Recherche:</strong> Dans le champ Nbr de lignes, choisissez le plus grand nombre.<br>
          Ensuite dans le champ recherche rapide, en introduisant les premières lettre du pseudo du membre à rechercher, les résultats s'auto-eliminent pour n'afficher que le membre dont le pseudo concorde à votre recherche.  
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
  <?php

	   
	   echo $link;	
	echo form_open('member/member_list/'.$this->idM.'/','class="form-inline"');
	
	echo '
<div class="form-group">';
echo '<label for="sort">Trier par : </label>
<select class="form-control input-sm" name="sort" id="sort">
<option value="0">Membre id </option>
<option value="1" >Pseudo</option>
<option value="2" >Nbre Messages</option>
<option value="3">Dernière visite</option>
</select>
</div>

<div class="form-group">
<label for="tri"> Mode : </label>
<select class="form-control input-sm" name="tri" id="tri">
<option value="0" >Croissant</option>
<option value="1" >Décroissant</option>
</select>
</div>

<div class="form-group">
<label for="limit"> Nbr de lignes </label>
<select class="form-control input-sm" name="limit" id="limit">
<option value="50">50 lignes</option>
<option value="75">75 lignes</option>
<option value="100">100 lignes</option>
<option value="150">150 lignes</option>
<option value="200">200 lignes</option>
<option value="500">500 lignes</option>
<option value="1000">1000 lignes</option>
<option value="'.$this->config_model->member_par_page().'">Défault</option>
</select>
</div>

<div class="form-group">
<input class="btn btn-primary btn-sm" name="envoyer" type="submit" value="Envoyer" />
</div>';
echo form_close();




if ($resp->num_rows()!=NULL)
{
?>
<br>
  <input class="form-control" id="myInput" type="text" placeholder="Recherche rapide ...">
  <br>
	    <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive text-center text-secondary"> 
        <thead>
       <tr style="color:#6F6F6F;">
       <th class="text-center"><small><strong> id </strong></small></th> 
       <th class="text-center"><small><strong>Pseudo</strong></small></th> 
       <th class="text-center"><small><strong>Avatar</strong></small></th>                    
       <th class="text-center"><small><strong>Messages</strong></small></th>
       <th class="text-center"><small><strong>Inscrit depuis</strong> </small></th>
       <th class="text-center"><small><strong>Dernière visite</strong></small></th>                       
       <th class="text-center"><small><strong>Connecté</strong></small></th>             

       </tr>
       </thead>
       <tbody id="myTable">
       <?php
       //On lance la boucle

       foreach ($resp->result() as $value)
       {
           echo '<tr style="color:#6F6F6F;">
           <td>'.htmlspecialchars($value->member_id).'</td>		   
		   <td>
           <a data-toggle="tooltip" title="Allez voir le profil de '.htmlspecialchars($value->member_pseudo).' " href="'.base_url('visit/profil/'.$this->idM.'/'.$value->member_id).'">
           '.htmlspecialchars($value->member_pseudo).'</a></td>
		   
           <td><img class="img-fluid img-thumbnail" src="'.thumb(base_url('assets/avatars/'.$value->member_avatar),25,25).'"></td>
		   
		   <td>'.$value->member_post.'</td>
           <td>'.date('d-m-Y',$value->member_registred).'</td>
           <td>'.time_elapsed($value->member_last_visit).'</td>';
           if (empty($value->online_id)) echo '<td>'.$this->config->item('wifi_off').'</td>'; 
           else echo '<td>'.$this->config->item('wifi_on').'</td>';
           echo '</tr>';
       }
      
       ?>
       </tbody>
       </table>
       <?php
	   echo $link;	
}
else //S'il n'y a pas de message
{
    echo'<p>Ce forum ne contient aucun membre actuellement</p>';
}
?>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
break;	
//-------------------------------------- visit profil ----------------------------

case'visit profil':
?>
    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Visite Profil</a></li>
    
    </ul>
    <?php
foreach($rep->result() as $data):
echo'
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Visite De Profil</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page, vous pouver consulter le profil du membre:<strong> '.ucfirst($data->member_pseudo).'</strong><br>
		   dont les informations sont illustrées ci-dessous.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>';



	   //---------------------------------------------------------------
	  echo' <table style="font-size:1.2rem" class="table table-striped table-responsive"> 
        <tr>
        <th>Renseignements sur le profil</th>             
        <th>Data</th>
        </tr> 
		<tr>
		<td>Pseudo</td>
		<td>'.stripslashes(htmlspecialchars($data->member_pseudo)).'</td>
		</tr>
		<tr>
		<td>Adresse e-Mail</td>
		<td>'.  safe_mailto($data->member_email,'creer contact').nbs(2).'<i data-toggle="tooltip" title="Vous devez posséder un client de méssagerie sur votre machine">'.$this->config->item('fas_info').'</i> </td>
		</tr>';
		
	   switch($data->member_level){
	   case 0:
	    $statut='Membre inactif';
		
		   break;
		case 2:   
		   $statut='Membre inactif';
	
		   break;
	     case 3:
		 $statut='Membre inactif';
		
		 break;
		case 4:  
		   $statut='Membre activé';
		
		   break;
		case 5:  
		   $statut='Modérateur';
		
		   break;
		case 6:  
		$statut='Administrataur';
		break;
		}
		echo '<tr>
		<td>statut</td>
		<td>';
		echo $statut;
		echo'</td>
		</tr>';
		
		echo'<tr>
		<td>Date Inscription</td>
		<td>'.date('\L\e d M Y \à H\hi \m\i\n',$data->member_registred).'</td>
		</tr>
		<tr>
		<td>Nbr De Poste</td>
		<td>'.$data->member_post.'</td>
		</tr>
		<tr>
		<td>Pays</td>
		<td>'.htmlspecialchars($data->member_location).'</td>
		</tr>
        <tr>
		<td>Avatar</td>
		<td><img src="'.thumb(base_url('assets/avatars/'.$data->member_avatar),60,60).'"
       alt="Ce membre n a pas d avatar" /></td>
		</tr>
			

		</table>';
		endforeach;
	      echo '<a class="btn btn-primary btn-sm" href="'.$this->agent->referrer().'"> Retour </a> | 
		  	      <a class="btn btn-primary btn-sm" href="'.base_url('member/selected_friend/'.$this->idM.'/'.$data->member_pseudo).'"> Proposer amitié </a> ';
		  echo br(2);
	

break;
	//---------------------------------- select friend -------------------------------------------
	case 'select friend':
	
?>
    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Ajouter Ami(e)</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Ajouter un ami(e) à votre liste</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          si vous connaissez le pseudo du membre que vous voulez ajouter comme ami(e), veuillez introduire son pseudo dans le champ ci-dessous. <br>
          Si non vous pouver faire une recherche dans la liste des membres.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
<?php
	echo'<div class="row">
	<div class="col-md-6">';
		
	 echo form_open('member/selected_friend/'.$this->idM);
	 
       echo  '<label for="pseudo" id="pseudo">Entrer un Pseudo <span style=" color:red">*</span></label>
	  
        
        <input type="text" id="pseudo" name="pseudo" class="form-control input-sm com-sm-6" placeholder="ex: Beatrice" autofocus>
		'.br(2).'
	         <input class="btn btn-primary btn-sm" type="submit" value="Valider" data-toggle="tooltip" title="Validez le pseudo de la personne que vous voulez ajouter à votre liste d\'amis "/>
			 
			 <a href="'.base_url('member').'" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Annuler et retour au controll panel">Annuler</a>
			 
			 
    
			 
	
		 </div>
		<div class="col-md-6"></div>
		 </div>';
		 
    echo form_close();
		 
	break;	

	//------------------------------------------------------------------------
	
	
	case 'friends':
	
	?>
				    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
    <li><a>Liste Ami(e)s</a></li>
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Liste Des Ami(e)s </th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page, vous pouvez consulter la liste de vos ami(e)s .<br>
          La liste des ami(e)s est divisée en deux tableux, dans le premier tableau sont listés vos amis dont votre amité a déjà été approuvée.<br>
          Dans le 2<sup>eme</sup> tableau sont listés les membres qui sollicitent votre amitié.<br>           
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <?php
				//-----------------------------------------------------------
				
			  echo '<table style="font-size:1.2rem" class="table table-striped table-responsive"> 
       <tr>
       <th>Liste Des Amis</th>                       
       </tr>
	   </table>	';	
	   	if($query->num_rows()>0){
		    echo'<p>Nombre total des ami(e)s :: ('.$query->num_rows().')</a>';
			}

	 
	 echo '<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
    <th>Pseudo</th>
    <th>Date d\'ajout</th>
    <th>Action</th>
    <th>Connecté(e)</th></tr>';
	
	if ($query->num_rows() == 0)
    {
      echo '<td colspan="4"><p style="text-align:center;color:red !important;">Vous n\'avez aucun ami pour l\'instant</p></td>';
    }else{
	  foreach($query->result() as $value):
    
        echo '<tr>
		<td>
		<a href="'.rawurlencode(base_url('member/visit_profil/'.$this->idM.'/'.$value->friend)).'">'.htmlspecialchars($value->member_pseudo).'</a></td>
        <td>'.date('d/m/Y',$value->friend_since).'</td>';
      
	   echo' <td><a class="btn btn-primary btn-xs" href="'.base_url('member/repondre/'.$this->idM.'/'.$value->friend).'">Envoyer un MP</a> |         
		
		<a class="btn btn-danger btn-xs" href="'.base_url('member/del_friend/'.$this->idM.'/del/'.$value->friend.'/'
		.rawurlencode($value->member_pseudo)).'">Supprimer</a></td>';
		
		
		
        if (!empty($value->online_id)) 
		echo '<td>'.$this->config->item('wifi_on').'</td>'; 
		else 
		echo '<td>'.$this->config->item('wifi_off').'</td>';
        echo '</tr>';
    endforeach;
	}
	echo '</table>';
	//-------------------------------------- pending friends -----------------------------------------
		   	if($pending->num_rows()>0){
				
	echo'<p>Amitié(s) en attente de confirmation :: ('.$pending->num_rows().')</p>';
			}else {echo '<p>Proposition d\'amitié :: RAS';
			}
	echo '<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">
    <th>Pseudo</th>
    <th>Date de demande</th>
    <th>Action</th>
    <th>Connecté(e)</th>
	</tr>';


	
	if ($pending->num_rows() == 0)
    {
        echo '<td colspan="4"><p style="text-align:center;color:red !important;">Vous n\'avez aucune proposition d\'amitié pour l\'instant</td>';
    }else{
	  foreach($pending->result() as $val):
    
        echo '<tr>
		<td>
		<a href="'.base_url('member/visit_profil/'.$this->idM.'/'.$val->friend).'">'.rawurlencode($val->member_pseudo).'</a></td>
        <td>'.date('d/m/Y',$val->friend_since).'</td>';
      
	   echo' <td>
<a class="btn btn-success btn-xs"  href="'.base_url('member/confirm_friend/'.$this->idM.'/'.$val->friend.'/'.rawurlencode($val->member_pseudo)).'">Accepter </a> | 
	   
<a class="btn btn-danger btn-xs"  href="'.base_url('member/denied_friendship/'.$this->idM.'/'.$val->friend.'/'.rawurlencode($val->member_pseudo)).'">Réfuser</a>             
		
		</td>';
		
		
        if (!empty($val->online_id)) 
		echo '<td>'.$this->config->item('wifi_on').'</td>'; 
		else 
		echo '<td>'.$this->config->item('wifi_off').'</td>';
        echo '</tr>';
    endforeach;
	}
    echo '</table>';

	break;	
	
//-------------------------------------- inbox -------------------------------------------
	case 'inbox':
	    ?>
            <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Inbox</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;"><p>Boite Messagerie</p></th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page vous recevez les messages de tous les autres membres.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
   <?php
  echo' 
    <p><a data-toggle="tooltip" title="écrire un nouveau message" class="btn btn-primary btn-xs" href="'.base_url('nouveau/message/'.$this->idM).'">Nouveau</a>';
    if ($resp->num_rows()>0)
    {
		echo'
		 <table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive"> 
        <tr>
        <th>&Eacute;tat</th>
        <th>Titre</th>
        <th>Expéditeur</th>
        <th>Date</th>
		<th>Connecté</th>
        <th>Action</th>
        </tr>
		
		';
        foreach ($resp->result()as $data):
        {
            echo'<tr>';
            if($data->pmsg_read == 0)
            {
            echo'<td><img src="'.base_url('assets/img/msg_non_lu.png').'" alt="Non lu" /></td>';
            }
            else 
            {
            echo'<td>
			<img src="'.base_url('assets/img/msg_deja_lu.png').'" alt="Déja lu" /></td>';
            }
            echo'<td>';
        echo'<p><a data-toggle="tooltip" title="Cliquez pour lire le méssage envoyé par '.htmlspecialchars($data->member_pseudo).'" href="'.base_url('lire/message/'.$this->idM.'/'.$data->pmsg_id).'">
            '.htmlspecialchars($data->pmsg_object).'</a></p></td>
            <td id="mp_expediteur">
            <a href="'.base_url('visit/profil/'.$this->idM.'/'.$data->member_id).'">
            '.htmlspecialchars($data->member_pseudo).'</a></td>
            <td id="mp_time">'.date('\l\e d M Y \à  H:i:s',$data->pmsg_time).'</td>';
			        if (!empty($data->online_id)) 
		echo '<td>'.$this->config->item('wifi_on').'</td>'; 
		else 
		echo '<td>'.$this->config->item('wifi_off').'</td>';
            
			echo'<td>';


        echo'<a href="'.base_url('delete/message/'.$this->idM.'/'.$data->pmsg_id.'/delete').'">'. $this->config->item('delete').'</a>
			</td></tr>';
			
        } 
		endforeach;
        echo '</table>';

    } //Fin du if
    else
    {
		echo'
		<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive"> 
        <tr>
        <th>&nbsp;</th>
        <th>Titre</th>
        <th>Expéditeur</th>
        <th>Date</th>
        <th>Action</th>
        </tr>
           <tr>
            <td colspan="5">
			<p class="text-center">Vous n\'avez aucun message privé pour l\'instant.</p><br><br>
        <p class="text-center"><a class="btn btn-success btn-sm" href="'.base_url('panel/index/'.$this->idM).'">Retour U-Panel</a></p></td>

			</tr>
        </table>';
	}

	
	break;	
	
	//---------------------------------------- consulter -----------------------------------------------
	
	
	case 'consulter':
	?>
    
                <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Consulter pm</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Consulter le Messages</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Dans cette page vous consulter les messages qui vous ont été envoyés par vos amis membres.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
    <?php
		 foreach($query->result() as $data):
     
    echo'<p><a href="'.$this->agent->referrer().'">
	<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Retour page précédente">Retour</button></a>';
   
    echo'<a href="'.base_url('reply/pm/'.$this->idM.'/'.$data->pmsg_sender.'/'.$data->member_pseudo).'">
    
	<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Répondre à ce message">Répondre</button></a></p>'; 
	
	?>
	
<table style="font-size:1.2rem" class="table table-striped table-bordered table-responsive">   
    <tr>
    <th>Auteur</th>             
    <th>Message</th>       
    </tr>
    <tr>
    <td>
    <?php
	 echo'<a href="'.base_url('visit/profil/'.$this->idM.'/'.$data->member_id).'">'.$data->member_pseudo.'</a></td>
    <td>Posté à '.date('H\hi \m\i\n \l\e d M Y',$data->pmsg_time).'</td>
    </tr>
    <tr>
    <td>';
    echo'<p><img class="img-circle" src="'.thumb(base_url('assets/avatars/'.$data->member_avatar),40,40).'" alt="avatar" />
    <br />Inscrit le : '.date('d/m/Y',$data->member_registred).'
    <br />Post(s) : '.$data->member_post.'
    <br />Pays : '.htmlspecialchars($data->member_location).'</p>
    </td>
	<td>';
        
    echo nl2br($data->pmsg_text).'
    <hr />'.nl2br($data->member_signature).'
    </td>
	</tr>
	</table>';
	endforeach;

	break;	
	
	//--------------------------------------------------------------------
	case 'ecrire message':
		 	?>
                        <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Ecrire</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped containerbox">
		  <tr>
		  <th style="color: #7F7F7F !important;">Nouveau Message</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Cette page vous permet d'écrire un nouveau méssage.
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>
            
        <?php    
     $action=base_url('nouveau/message/'.$this->idM);
	$attributs=array('name'=>'myform',
	'id'=>'myform',
	'name'=>'myform');
$this->load->add_package_path(APPPATH.'third_party/resources', FALSE);
if($this->config_model->bbcode()=='oui'){
$this->load->view('textbbcode'); 
}
if($this->config_model->smiley()=='oui'){
	$this->load->view('textsmiley');
}

$this->load->remove_package_path(APPPATH.'third_party/resources');
	
	echo '<hr style=" margin-left:0 !important;width:60%;">'; 
	
   
	 echo form_open($action,$attributs); 
     echo form_error('to'); ?>
     <div class="form-group">
   <label for="to">Destinataire <span style=" color:red">*</span></label>
	 <input style="width:60%" type="text" id="to" name="to" class="form-control" value="<?= set_value('to'); ?>" autofocus>
		</div>

   
   <?php echo form_error('objet'); ?>
   <div class="form-group">
   <label for="titre">Objet <span style=" color:red">*</span></label>
   <input style="width:60%" type="text" id="titre" name="objet" class="form-control" required value="<?= set_value('objet'); ?>" />
   </div>
  
   
   <?php echo form_error('message'); ?> 
   <div class="form-group">
<label for="message">Message <span style=" color:red">*</span></label>
<textarea class="form-control" style="width:60%; height:30vh;" id="message" name="message"><?php if($this->input->post('message')) echo htmlspecialchars($this->input->post('message')); ?></textarea>
</div>

 
   <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Envoyer" />
   <input class="btn btn-primary btn-sm" type="reset" name="Effacer" value="Effacer" />
   <input type="submit" class="btn btn-default btn-sm" id="preview" name="preview" value="Preview" /> 
   
   
	<?php
	echo form_close();
    ?>
     <fieldset>
            <div id="loading"><img src="<?= base_url('assets/img/loader.gif')?>"></div>
        <div id="preview_rep"></div>
        </fieldset>
        <br><br>
<script>
$(document).ready(function() {
	
		$("#smilies").css('display','none');
	$("#smiley img").click(function(){
    $("#smilies").toggle(1000);
  });
  
  
				
			 
		     $("#loading").css("display", "none");
			 //$('#ajax-loader').css('display', 'block').css('top', posTop() + 15);
		                                    

	

       $("#preview").click(function(e) {
		   e.preventDefault();
		   
		   
         var formInput = $('#myform').serialize();
		 
$.ajax({
       url:'<?=base_url("ajaxcall/new_pm")?>',
	   type:"post",
	  data:formInput,
	  beforeSend: function(){
		  $("#loading").fadeIn(2000);
		  
		  }         
	   
       }).done(function (result) {
		   

		   
       $("#preview_rep").html(result);

	   
       }).fail(function (xhr, status, error) {
       $("#preview_rep").html("Result: " + status + "<br> " + error + " :" + xhr.status + "<br> " + xhr.statusText);
	   
       });
	   $(document).ajaxComplete(function(){
		 $("#loading").fadeOut(2000); 
		 
		 });
	   
	   
});
});	

</script>

    <?php
	break;	
	
	//----------------------------------------- repondre --------------------------------------------------
	case 'repondre pm':
	
?>
                        <ul class="breadcrumb">    
                        <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
        <li><a>Répondre</a></li>
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">Répondre aux Messages</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
		  <p style="color:#F0F0F0 !important;">
          Cette page vous permet de répondre à un méssage re&ccedil;u ou d'envoyer un message à un de vous ami(e).
           </p>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <hr>

<?php	
$this->load->add_package_path(APPPATH.'third_party/resources');
		  
		  if($this->config_model->bbcode()=='oui'){
		  $this->load->view('textbbcode'); 
		  }
		  if($this->config_model->smiley()=='oui'){
			  $this->load->view('textsmiley');
		  }

$this->load->remove_package_path(APPPATH.'third_party/resources');
	
	echo '<hr style=" margin-left:0 !important;width:60%;">'; 
	
	if($query->num_rows()>0){
		
	
			foreach($query->result() as $val):
			  
   
   	$action=base_url('reply/pm/'.$this->idM.'/'.$val->member_id.'/'.$val->member_pseudo.'/');
	$attributs=array('name'=>'myform',
	                 'id'=>'myform');
	
	

echo form_open($action,$attributs);  
 ?>
 <fieldset>
<div class="form-group">
   <label for="objet">Destinataire </label>
   <input style="width:60%" class="form-control" type="text" id="dest_pseudo" disabled name="dest" value="<?=$val->member_pseudo; ?>" />
   </div>
    </fieldset>
   
   <fieldset>
   <div class="form-group">
  <div> <?= form_error('objet'); ?></div>
   <label for="objet">Objet </label>
   
<input style="width:60%" class="form-control userinput" type="text" id="objet" name="objet" value="<?= set_value('objet'); ?>" />
   
      <div><?= form_error('message'); ?></div>
      </div>
      </fieldset>
     
   <fieldset>
   <label for="message">Message</label>
   <textarea class="form-control userinput" style="width:60%; height:30vh;"  id="message" name="message"><?php if($this->input->post('message')) echo htmlspecialchars($this->input->post('message')); ?>
   </textarea>
   
   </fieldset>
   
   <br>
   <fieldset>
   
      <div class="form-group">
      <input type="submit" class="btn btn-default btn-sm" id="submit" name="valider" value="Valider" />
            <input type="reset" class="btn btn-default btn-sm" id="effacer" name="effacer" value="Effacer" />
   <input type="submit" class="btn btn-default btn-sm" id="preview" name="preview" value="Preview" /> 
   <!--   <input class="btn btn-default btn-sm" id="clear" name="clear" value="Clear"> -->
    </div>
   </fieldset>
   
   <?php
   endforeach;
	   echo form_close();
	}
	else{
		echo '
		<div class="bg-warning">
		<p style="color:red !important; font-size:1.2rem;padding:30px;">Important :: Il se peut que l\'expediteur a supprimé son compte, dans ce cas vous ne pouvez pas lui répondre.</p>';
		echo'<p style=" text-align:center;padding:30px;"><a href="'.$this->agent->referrer().'">
	<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="Retour page précédente">Retour</button></a></p>
		
		</div>
		
		
		';
		}

?>
           <fieldset>
            <div id="loading"><img src="<?= base_url('assets/img/loader.gif')?>"></div>
        <div id="preview_rep"></div>
        </fieldset>
        <br><br>
<script>
$(document).ready(function() {
	
		$("#smilies").css('display','none');
	$("#smiley img").click(function(){
    $("#smilies").toggle(1000);
  });
  
  
				
			 
		     $("#loading").css("display", "none");
			 //$('#ajax-loader').css('display', 'block').css('top', posTop() + 15);
		                                    

	

       $("#preview").click(function(e) {
		   e.preventDefault();
		   
		   
         var formInput = $('#myform').serialize();
		 
$.ajax({
       url:'<?=base_url("ajaxcall/reply_pm")?>',
	   type:"post",
	  data:formInput,
	  beforeSend: function(){
		  $("#loading").fadeIn(2000);
		  
		  }         
	  //+ '&arquivo_facil_tk=' + $.cookie('arquivo_facil_co'),
	
	   
	   
	   
	   
       }).done(function (result) {
		   

		   
       $("#preview_rep").html(result);

	   
       }).fail(function (xhr, status, error) {
       $("#preview_rep").html("Result: " + status + "<br> " + error + " :" + xhr.status + "<br> " + xhr.statusText);
	   
       });
	   $(document).ajaxComplete(function(){
		 $("#loading").fadeOut(2000); 
		 
		 });
	   
	   
});
});	
	
</script>
<?php
	break;	
	
//-------------------------------------- infos ---------------------------------------------------	
		  case 'infos':
		  echo br(4);
		  ?>
          <div class="row" style="padding:20px 20px;">
          <div class="col">

	<?php if(has_alert()):  
		foreach(has_alert() as $type => $message): ?>  
			<div class="alert alert-dismissible <?php echo $type; ?>">  
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<?php echo $message; ?>  
			</div>  
		<?php endforeach;  
	endif; 
	?>
    </div></div>
    <?php	
	break;
	

	//--------------------------------------- default --------------------------------
default:
switch($this->lvl){
	case MEMBER:
	$status='chère membre';
	break;
	case MODO:
	$status='chère modérateur';
	break;
	case ADMIN:
	$status='chère administrateur';
	break;
	
	
	}
?>    <ul class="breadcrumb">
    <li><a href="<?=base_url('forum')?>">Forum</a></li>
    <li><a href="<?=base_url('member/index/'.$this->idM)?>">U-panel</a></li>
    <li><a>Dashboard</a></li>
     
    
    </ul>
    	 <div class="btn-success" style="border-radius:5px; padding:10px 10px;">
		  <table style="font-size:1.2rem" class="table table-responsive table-striped">
		  <tr>
		  <th style="color: #7F7F7F !important;">User Control Panel</th>
		  </tr>
		   
		  
		  <tr>
		  <td>
          <br>
          <h3 style="font-size:90%;color:#F0F0F0 !important;"><strong>Bienvenue <?= $status.' '.$this->pseudo?></strong> </h3>
<p style="color:#F0F0F0 !important;">Vous êtes sur le paneau de control de votre compte, l'appellation U-Panel est acronyme de user panel.
Sur la section gauche de cette fenêtre sont listés les différents liens que vous pouvez suivre pour consulter, modifier, ou mettre à jour votre profil.
<?php 
if($this->lvl!=ADMIN){
	?>
Un profil complet nous aidera énormément à vous bien servir et à vous éviter d'introduire vos informations à chaque fois quand la situation l'oblige.
Vos informations ne seront jamais divulguées,  ni à la disposition de quiconque.</p>
       <?php
}?>
		  </td>
		  </tr>
          
		  </table>
		  </div>
          <br>

          <hr>
<?php
break;	

}


//---------------------------------------------------add badwords -------------------------------



?>
 </div>
</div></div>
