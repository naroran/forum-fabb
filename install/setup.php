<?php
include('header.php');
include('resources/link.php');
			  $conn=open_conn();
			  $db=dbname();
			  $i=1;

            $table=array('fabb_adds','fabb_badwords','fabb_bots','fabb_cat','fabb_config','fabb_contact',
				'fabb_description_page','fabb_flood','fabb_forum','fabb_friends','fabb_members','fabb_online',
				'fabb_page_adds', 'fabb_pic', 'fabb_pmsgs', 'fabb_post', 'fabb_pseudos', 'fabb_smtp',
				'fabb_testimo','fabb_title_page','fabb_topic','fabb_topic_view','fabb_version'
				);


	?>
  		<div class="row">
        <div class="col-md-12">
        <div class="progress" style="height:30px;">
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="56" 
          aria-valuemin="0" aria-valuemax="100" style="width:56%"><span style="font-size:11px;">56% Completed</span>
          </div>
        </div>
        </div></div>   
        
                     <h4>Etape 4 :: Installation des tables </h4>
    <table style="font-size:1.2rem;" class=" table table-hover table-responsive table-bordred">
    <tr>
    <th>#</th>
    <th>Liste tables dans <strong style="color:green"><?= dbname() ?></strong>  </th>
    <th>état</th>
    </tr>
    <?php

	
$sql = "SHOW TABLES FROM $db";
	
	$resp = $conn->query($sql);
	
	if(!$resp) { echo "Erreur de connection à la base de donnée :: $db"; }
	
	
	while($row = mysqli_fetch_row($resp)){	
  //$row = $result->fetch_row()
	
	echo'<tr>';
	echo'<td>'.$i.'</td>';
	echo'<td>';
	if(in_array($row[0],$table)){
		echo $row[0];
	}else {echo $row[0].'<span style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 table extra fabb</span> ';
	 }
	echo'</td>
	<td>';
	 if(in_array($row[0],$table)){echo'<span style="color:green" class="glyphicon glyphicon-ok"></span>';}
	 else {echo'<span style="color:red" class="glyphicon glyphicon-remove"></span>';}
	 echo'
	 </td>	
	</tr>';
	$i++;
	}
	echo '</table>';
	
	//close_conn($conn);
	?>
            <form action="index.php" method="post">
        <div class="form-group">
        <input type="hidden" name="install" value="admin">
        <input class="btn btn-primary btn-block" type="submit" name="submit" value="suivant">
        </div>
        </form>
        
        </div>
        </div>
    <?php
	
  include('footer.php');
				?>