<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    p {
        font-size: vh;
        color: rgb(234, 11, 55) !important;
        padding: 20px 20px;
        color: #8B8B8B;
    }

    body {
        margin-top: 30vh;
    }
    </style>
</head>

<body style="background-image:<? base_url('assets/img/page.png')?>">
    <div class="container">
        <div class="row">
            <div class="com-md-2"></div>
            <div class="com-md-8">
                <?php
if($view_add->num_rows()>0){
foreach($view_add->result() as $val):
echo $val->add_code .br(3).'
<input type="button" class="btn btn-primary btn-sm" value="Fermer la fenêtre" onclick="self.close()">';
endforeach;
}else{
echo'<p class=" bg-warning">Cette publicité est désactivée, veuillez l\'activer en suite vous pouvez la visualiser...!</p>';
echo br(3).'
<input type="button" class="btn btn-primary btn-sm" value="Fermer la fenêtre" onclick="self.close()">';
}
?>
            </div>
            <div class="com-md-2"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>