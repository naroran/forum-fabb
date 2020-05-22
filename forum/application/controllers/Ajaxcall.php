<?php
/**
 * fabb An open source application developed within codeigniter framework
 *
 * This content is released under the GNU General Public License version 3
 *
 * Copyright (c) 2018 - 2020, faci abdelhafid bulletin board :: fabb
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see https:
 *
 * The GNU General Public License does not permit incorporating your program
 * into proprietary programs.  If your program is a subroutine library, you
 * may consider it more useful to permit linking proprietary applications with
 * the library.  If this is what you want to do, use the GNU Lesser General
 * Public License instead of this License.  But first, please read
 * https:
 *
 * @see commercial  use doc/commercial.txt
 * @package	Fabb  application web community
 * @author	faci abdelhafid <admin@forum-fabb.com>
 * @subpackage Controllers
 * @copyright	Copyright (c) 2018 - 2020, fabb <https://www.forum-fabb.com>
 * @link	<https://www.forum-fabb.com>
 * @since	Version 1.7.19
 * @filesource
 */
 defined('BASEPATH') OR exit('No direct script access allowed');
 defined ('FABB') OR exit("read the installation instructions carefully OR re-install fabb ");
/**
 * Ajaxcall class to handle live post
 */
class Ajaxcall extends CI_Controller {
 function __construct() {
	parent::__construct();
	 $this->load->library('bbcode');
	}
/**
 * index go back si vous n'etes pas invités
 *
 * @return void
 */
public function index()
{
	$this->load->view('error404');
}
/**
 * new_pm send new private msg
 *
 * @return void
 */
public function new_pm()
{
	if($this->input->post('to')){
	$dest=$this->input->post('to');
	}else{$dest='';}
	echo 'Destinataire :: '.$this->bbcode->netcode($dest).'<br>';
	if($this->input->post('objet')){
	$objet=$this->input->post('obje');
	}else{
	$objet='';
	}
	echo 'Objet :: '.$this->bbcode->netcode($objet).'<br>';
	if($this->input->post('message')){
	$message=$this->input->post('message');
	}
	else{
	 $message='';
	}
	echo '<strong>Texte Message ::</strong> '.$this->bbcode->netcode($message);
	//end if
	}//end reply post	
/**
 * reply_pm view live reply private msg
 *
 * @return void
 */
public function reply_pm()
{
  if($this->input->post('message') )
	{
		if(!$this->input->post('objet')|| !$this->input->post('message')){
		echo '<p style="color:red !important">1- Il se peut que vous avez oublié un champ vide.<br>
		2- L\'objet et le corp du message sont obligatoires.</p>';
			}
			else{
	$titre=$this->input->post('objet');
	echo '<strong>Objet Message :: </strong>' .$titre. br(2);
	$message=$this->input->post('message');
	echo '<strong>Texte Message ::</strong> '.$this->bbcode->netcode($message);
	//echo json_encode($data);
	//echo json_encode($data); 
		}
			}
			//end if
			}//end reply
/**
 * reply_post view live reply post
 *
 * @return void
 */
public function reply_post()
{
			$message=$this->input->post('message');
		 if(strlen($message)<4){
		echo '<p style="color:red !important">1- Il se peut que vous avez oublié de rédiger votre réponse.<br></p>';
			}
			else{
	$message=$this->input->post('message');
	echo '<strong>Texte Message ::</strong> '.$this->bbcode->netcode($message);
			}
			//end if
			}//end reply post	
/**
 * edit_post view live edit post
 *
 * @return void
 */
public function edit_post()
{
			$message=$this->input->post('message');
		 if(strlen($message)<4){
		echo '<p style="color:red !important">1- Il se peut que vous avez oublié de rédiger votre réponse.<br></p>';
			}
			else{

	$message=$this->input->post('message');
	echo '<strong>Texte Message ::</strong> '.$this->bbcode->netcode($message);
			}
			//end if
			}//end reply post	
/**
 * new_topic view live new post
 *
 * @return void
 */
public function new_topic()
{
			if($this->input->post('titre')){
				$objet=$this->input->post('titre');
				}else{
				$objet='Veuillez indiquez un titre à votre topic';
				}
		echo 'Objet :: '.$this->bbcode->netcode($objet).'<br>';
			if($this->input->post('message')){
				$message=$this->input->post('message');
			}
			else{
				 $message='';
			}
	echo '<strong>Texte Message ::</strong> '.$this->bbcode->netcode($message);
			//end if
			}//end reply															
}//end class