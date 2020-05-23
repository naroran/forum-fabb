<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>  <?php if (isset($title)) echo  $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/ico" href="<?=base_url('favicon.ico'); ?>">
<link rel="icon" type="image/png" href="<?=base_url('favicon.png'); ?>">
  <script src="<?= base_url('assets/js/website.js')?>"></script>
 
<?php
if(isset($add_img) && $add_img=='add_img'){?>
<script>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php
}
?>

<link rel="stylesheet" href="<?= base_url('assets/css/custom.css')?>">
<script src="<?= base_url('assets/js/custom.js')?>"></script>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<?php
if(isset($menuvertical)){
	?>
	
    
    <style>

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    color: #fff;
    transition: all 0.3s;
	border-radius:4px 4px;;
	background: #000222;
    background: -moz-linear-gradient(top,  #000222 0%, #4b637c 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#000222), color-stop(100%,#4b637c));
    background: -webkit-linear-gradient(top,  #000222 0%,#4b637c 100%);
    background: -o-linear-gradient(top,  #000222 0%,#4b637c 100%);
    background: -ms-linear-gradient(top,  #000222 0%,#4b637c 100%);
    background: linear-gradient(top,  #000222 0%,#4b637c 100%);
}


#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}


a[data-toggle="collapse"] {
    position: relative;
}

a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
   /* content: 'e259';*/
    display: block;
    position: absolute;
    right: 20px;
    font-family: 'Glyphicons Halflings';
    font-size: 0.6em;
}
a[aria-expanded="true"]::before {
   /* content: 'e260';*/
}


ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.topage {
    padding: 20px;
}

ul.topage a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

a.article, a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}

</style>

	<?php
	}
	
?>
<link rel="stylesheet" href="<?= base_url('assets/css/body.css')?>">

<style>
.dropdownaction{ background:none!important;}
.dropdownaction a:hover{ color:rgb(242,186,17,0.5)!important;}
</style>


<script src="<?=base_url('assets/js/pace.js')?>"></script>
 </head>
 <body> 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    