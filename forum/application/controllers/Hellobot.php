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
 * class extends Controller Class
 *
 * @package		fabb
 * @author		faci abdelhafid
 * @link		<https://www.forum-fabb.com/>
 */
class Hellobot extends CI_Controller
{
		/**
	* @var string $lvl reference to active session member level
	 */
	 public $lvl;
	/**
	 * @var string $pseudo reference to active session member pseudo
	 */
	 public $pseudo;
	/**
	 * @var string  $email reference to active session member email
	 */
	 public $email;
	 /**
	 * @var string reference to active session member avatar
	 */
	 public $avatar;
	 /**
	 * @var int $idM reference to active session member identification
	 */
	 public $idM;
	 /**
	 * @var int $nbr_msg reference to active session member inbox msg
	 */
	 public $nbr_msg;
	 /**
	 * @var string $msg reference to any msg for active session member
	 */
	public $msg;
	/**
	 * @var string $status reference to active session state member
	 */
	public $status;
	/**
	 * @var string $ip reference to active session ip member
	 */
	public $ip;
	/**
	 * @var string $bann reference to banned member
	 */
	public $bann;	
	
    /* Initialize the controller by calling the necessary helpers and libraries */
    public function __construct()
    {
        parent::__construct();
	if(!$this->input->ip_address()){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
	$this->ip=$this->session->has_userdata('ip')?$this->session->ip:$this->input->ip_address();
    
    }
    

    /* The default function that gets called when visiting the page */
    public function index()
    {
		
		$this->load->model('forum_model');
		
		if($this->forum_model->bad_bot($this->ip)==true){
			
			exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));	
		}else{
		
     	$query=dataVisitor($this->ip);
		$country=$query['country'];
		$code=$query['countryCode'];
		$city=$query['city'];
		
			$platform=$this->agent->platform();
			if ($this->agent->is_browser())
			{
			$agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
			$agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
			$agent = $this->agent->mobile();
			}
			else
			{
			$agent = 'Unidentified';
			}
		
		    $array=array('bot_id'=>$this->idM,
			         'bot_date'=>time(),
					 'bot_ip'=>$this->ip,
					 'bot_country'=>$country,
					 'bot_code'=>$code,
					 'bot_city'=>$city,
					 'bot_platform'=>$platform,
					 'bot_agent'=>$agent,
                     'bot_state'=>'1'
					);
		
		            $this->forum_model->insert_bot($array);
					exit('thinks for your visit');
					
		}
		    
    }

}
/* End of file hellobot.php */
/* Location: ./application/controllers/hellobot.php */