<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title> password recovery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- ----------- google font ----------- -->
<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
body{margin-top:5rem;}
p.content{ font-size:1.2em text-align:justify;font-family: 'Lato', sans-serif; font-style:normal; line-height:2em;}
.logo{
-webkit-box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
-moz-box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
box-shadow: 9px -6px 19px 8px rgba(143,149,186,0.75);
padding:20px; margin:40px 0; border-radius:8px;	
	}
.raison{ font-size:18px; font-family:'Lato', sans-serif;
 color: #FFFFFF;
background: #232323;
text-shadow: 0 0 5px #FFF, 0 0 10px #FFF, 0 0 15px #FFF, 0 0 20px #49ff18, 0 0 30px #49FF18, 0 0 40px #49FF18, 0 0 55px #49FF18, 0 0 75px #49ff18;
color: #FFFFFF;
background: #232323;
}
	.droit{ text-align:center; font-size:70%; margin-top:10%; margin-bottom:1%;}
	.footer p{background-color: #000000; color:#FFFFFF; text-align:center;font-size:80%; font-style:italic; padding:20px;}
</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="row">
                <div class="col-xs-12">
                <div class="text-center"><p class="logo raison"><?= $raison ?></p></div>
        
        
