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
defined ('FABB') OR exit("read the installation instructions carefully OR re-install fabb");
/**
* class extends Controller Class
*
* @package		fabb
* @author		faci abdelhafid
* @link		<https://www.forum-fabb.com/>
*/
class Search extends CI_Controller {
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
/**
* __construct
*
* @return mixed
*/
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','captcha','security'));
		$this->load->model(array('msgs_model','forum_model'));
		$this->load->library(array('pagination','encryption','form_validation','alert','bbcode'));
		$this->load->config('glyph');
		$this->lvl = $this->session->has_userdata('lvl')?$this->session->lvl:1;
		$this->pseudo = $this->session->has_userdata('pseudo')?$this->session->pseudo:'';
		$this->email = $this->session->has_userdata('email')?$this->session->email:'';
		$this->avatar = $this->session->has_userdata('avatar')?$this->session->avatar:'';
		$this->idM = $this->session->has_userdata('idM')?$this->session->idM:0;
		$this->msg = $this->session->has_userdata('msg')?$this->session->msg:NULL;
		$this->nbr_msg = $this->session->has_userdata('nbr_msg')?$this->session->nbr_msg:0;
		$this->status = $this->session->has_userdata('status')?$this->session->status:VISITOR;
		$this->bann = $this->session->has_userdata('bann')?$this->session->bann:BANNED;
		if(!$this->input->ip_address()){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons Rencontré Une Exception'));}
		$this->ip= $this->session->has_userdata('ip')?$this->session->ip:$this->input->ip_address();
		if($this->bann){show_error(ERR_BANN, 403,$heading = 'Nous Avons Rencontré Une Exception');}
		if($this->forum_model->bad_bot($this->ip)==true){exit(show_error(ERR_HACK, 403,$heading = 'Nous Avons
		Rencontré Une Exception'));}
		if($this->member_model->is_online($this->ip)>0){
		$this->member_model->update_online($this->ip);
		}
		else {
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
		$array=array('online_id'=>$this->idM,
			 'online_time'=>time(),
			 'online_ip'=>$this->ip,
			 'online_country'=>$country,
			 'online_code'=>$code,
			 'online_city'=>$city,
			 'online_platform'=>$platform,
			 'online_browser'=>$agent
			);
		$this->member_model->insert_online($array);
		}
		if(auth_access($this->status,PENDING))
		{
		$this->load->model('msgs_model');
		$query=$this->msgs_model->unread_msg($this->idM);
		$this->nbr_msg=$query;
		}
	}	
	/**
	 * index
	 *
	 * @return void
	 */
	public function index(){
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='recherche sur le forum';
		$this->form_validation->set_rules('term','Mot De Recherche', 'required|trim|htmlspecialchars|strtolower|min_length[3]|max_length[32]|regex_match[#^[a-zA-Z0-9_. -]{1,}$#]');
		if ($this->form_validation->run() == FALSE)
		{
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('search/index',$data);
		$this->load->view('inc/footer',$data);
		}
		else{
			$this->result();
			}
	}	
	/**
	 * _menu
	 *
	 * @return void
	 */
	protected function _menu(){
		$tpid=$this->member_model->total_post_idm($this->idM);
		$ttid=$this->member_model->total_topic_idm($this->idM);
		$array=array(
		'lvl'=> $this->lvl,
		'blink'=> 'search',
		'msg'=> $this->msg,
		'idM'=>$this->idM,
		'nbr_msg'=> $this->nbr_msg,
		'avatar'=> $this->avatar,
		'pseudo'=> $this->pseudo,
		'email'=> $this->email,
		'status'=> $this->status,
		'idM'=>$this->idM,
		'tpid'=>$tpid,
		'ttid'=>$ttid,
		);
		return $array;
	}	
	/**
	 * display
	 *
	 * @param  mixed $data
	 * @return void
	 */
	public function display($data){
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('search/result',$data);
		$this->load->view('inc/footer', $data);
	}	
	/**
	 * top_pic
	 *
	 * @return void
	 */
	public function top_pic(){
		$this->load->model('admin_model');
		$photo=$this->admin_model->get_pics();
		foreach($photo->result() as $pic):
		return $pic->pic_file;
		endforeach;
	}	
	/**
	 * recherche
	 *
	 * @return void
	 */
	public function recherche() {
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='forum fabb';
		$this->form_validation->set_rules('term','Mot De Recherche', 'required|trim|htmlspecialchars|strtolower|min_length[2]|max_length[32]|regex_match[#^[a-zA-Z0-9_. -]{1,}$#]');
		if ($this->form_validation->run() == FALSE)
		{
		$data['blink']='search';
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('search/index',$data);
		$this->load->view('inc/footer',$data);
		}
		else{
			$this->result();
			}
	}	
	/**
	 * result
	 *
	 * @return void
	 */
	public function result(){
		$data['menu']=menu($this->_menu());
		$data['pic']=$this->top_pic();
		$data['title']='forum fabb';
		$searched_term = $this->input->post('term');
			$rows=$this->member_model->cherche($searched_term);
			if($rows->num_rows()==0){
				$data['advise']='Mot de recherche :<span style=" padding:2px 4px;background-color:yellow"> ' .$searched_term.'</span> n\'a abouti à aucun résultat. <br>
				Essayez d\'affiner votre recherche avec d\'autres mots plus explicites.';
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topPage',$data);
		$this->load->view('inc/navBar',$data);
		$this->load->view('search/index',$data);
		$this->load->view('inc/footer');
				}
			else{
			$num_rows=$rows->num_rows();
		$this->load->model('config_model');
		$config['base_url'] = base_url('search/index');
		$config['total_rows'] = $num_rows;
		$config['per_page'] = $this->config_model->search_result();
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['resp'] = $this->member_model->limitsearch($searched_term,$config["per_page"], $page);
		$data['title']='recherche sur le forum';
		$data['render']='result';
			$this->load->view('inc/header',$data);
			$this->load->view('inc/topPage',$data);
			$this->load->view('inc/navBar',$data);
			$this->load->view('search/result',$data);
			$this->load->view('inc/footer',$data);
		}
	}
	/**
	 * read_more
	 *
	 * @return void
	 */	
	public function read_more(){
		if($this->uri->segment(3)){
		$id=$this->uri->segment(3);
		$data['post_text']=$this->member_model->search_post($id);
		$this->load->view('search/read_more',$data);
		}
	}
}
