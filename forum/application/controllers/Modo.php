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
	class Modo extends CI_Controller
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

		function __construct()
		{
			parent::__construct();
			$this->load->model(array('admin_model', 'forum_model'));
			$this->load->library(array('form_validation', 'pagination', 'alert', 'bbcode'));
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
			if (auth_deny($this->status,MODO) || $this->idM != $this->uri->segment(3)){ 
			exit(show_error(ERR_HACK, 403, $heading = 'Nous Avons Rencontré Une Exception'));}
			
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

	  $this->load->model('msgs_model');
	  $query=$this->msgs_model->unread_msg($this->idM);
	  $this->nbr_msg=$query;
	
			//add last post
			// last member
			// last annonce



		}
		/**
		 * index shows modo's dashboard
		 *
		 * @return void
		 */		public function index()
		{
			$data['render'] = '';
			$data['title'] = 'dashbord';
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}

		/**
		 * all_cat whows all cat
		 *
		 * @return void
		 */		public function all_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'all_cat';
			$data['title'] = 'toutes les categories';
			$data['pic'] = $this->top_pic();
			$data['list_cat'] = $this->admin_model->list_cat();
			$this->display($data);
		}
		/**
		 * select_ord_cat Change Category Order
		 *
		 * @return void
		 */		function select_ord_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'select ord cat';
			$data['title'] = 'ordre categorie';
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->get_ord_cat();
			$this->display($data);
		}
		/**
		 * edit_ord_cat edit Category Order
		 *
		 * @return void
		 */		public function edit_ord_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['title'] = 'editer ordre categorie';
			$query = $this->admin_model->select_ord_cat();
			foreach ($query->result_array() as $val) :
				$order = (int) $this->input->post($val['cat_id']);
				//Et si l'ordre a changé depuis
				if ($val['cat_order'] != $order) {
					$this->admin_model->update_ord_cat($order, $val['cat_id']);
				}
			endforeach;
			//alert
			$this->alert->set('alert-success', 'L\'orde des catégories a été mis à jour avec succès.' . br(2) . '
						<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
						<a class="btn btn-success btn-sm" href="' . base_url('modo/select_ord_cat/' . $this->idM) . '">
						Autre édition</a>', TRUE);
			$this->display($data);
		}
		/**
		 * all_forum shows all forum
		 *
		 * @return void
		 */		public function all_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'all_forum';
			$data['title'] = 'tous les forums';
			$data['forums'] = $this->admin_model->liste_forum();
			$this->display($data);
		}
		/**
		 * move_forum move forum to an other category
		 *
		 * @return void
		 */		public function move_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'deplacer un forum';
			if ($this->input->post('submit')) {
				$forumId = $this->input->post('forumName');
				$catId = $this->input->post('cat');
				if ($this->admin_model->move_forum($catId, $forumId) > 0) {
					$forumName = $this->admin_model->get_forum_name($forumId);
					foreach ($forumName->result() as $val) :
						$forum = $val->forum_name;
					endforeach;
					$catName = $this->admin_model->get_cat_name($catId);
					foreach ($catName->result() as $val) :
						$cat = $val->cat_name;
					endforeach;
					$this->alert->set('alert-success', 'Le forum ' . $forum . ' a été déplacé avec succès vers la catégorie ' . $cat . br(2) . '
			  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('modo/move_forum/' . $this->idM) . '"> Déplacer Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
			} else {
				$data['render'] = 'move forum';
				$data['title'] = 'deplacer un forum';
				$data['query'] = $this->admin_model->liste_forum();
				$data['queryCat'] = $this->admin_model->get_all_cat();
				$this->display($data);
			}
		}

		/**
		 * select_ord_forum change forum ordr
		 *
		 * @return void
		 */		public function select_ord_forum()
		{

			$data['menu'] = menu($this->_menu());
			$data['render'] = 'select ord forum';
			$data['title'] = 'ordre des forums';
			$data['categorie'] = "";
			$data['pic'] = $this->top_pic();

			$data['query'] = $this->admin_model->ord_forum();
			$this->display($data);
		}

		/**
		 * edit_ord_forum editer l'ordre des forum
		 *
		 * @return void
		 */
		public function edit_ord_forum()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'edition ordre des forums';
			$query = $this->admin_model->get_ord_forum();
			foreach ($query->result_array() as $data1) {
				$ordre = (int) $this->input->post($data1['forum_id']);
				if ($data1['forum_order'] != $ordre) {
					$this->admin_model->loop_ord_forum($ordre, $data1['forum_id']);
				}
			}
			$this->alert->set('alert-success', 'L\'odre des forums a été modifié avec succès.' . br(2) . '
					  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a>', TRUE);
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['menu'] = menu($this->_menu());
			$this->display($data);
		}
		/**
		 * consulter_topic consulter tout les topics
		 *
		 * @return void
		 */
		public function consulter_topic()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'consulter les topic';
			$this->load->library('pagination');
			$config['base_url'] = base_url('modo/consulter_topic/' . $this->idM . '/');
			$config['total_rows'] = $this->db->count_all_results('fabb_topic');
			$config['per_page'] = $this->config_model->acp_topic_page();
			$config['num_links'] = 3;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<ul class="pagination pagination-sr">';
			$config['full_tag_close'] = '</ul>';
			$config['attributes'] = array('class' => 'page_link');
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
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$page = $this->uri->segment(4);
			$this->pagination->initialize($config);
			$data['link'] = $this->pagination->create_links();
			$data['query'] = $this->admin_model->consulter_topic($config['per_page'], $page);
			$data['pic'] = $this->top_pic();
			$data['render'] = 'consulter topic';
			$this->display($data);
		}
		/**
		 * edit_topic editer un topic
		 *
		 * @return void
		 */
		public function edit_topic()
		{

			$data['pic'] = $this->top_pic();
			$data['title'] = 'edition topic';
			$topic = (int) $this->uri->segment(4);
			$edit_t = $this->admin_model->check_createur_topic($topic);
			foreach ($edit_t->result() as $val) :
				$data['titre_topic'] = $val->topic_title;
				$topic_createur = $val->topic_owner;
				$val->topic_forum_id;
				$firstpost = $val->topic_firstpost;
			endforeach;
			$edit_p = $this->admin_model->get_post_topic($firstpost);
			foreach ($edit_p->result() as $val) :
				$data['post_text'] = $val->post_text;
				$data['post_time'] = $val->post_time;
				$post_forum = $val->post_forum_id;
				$data['post_id'] = $val->post_id;
			endforeach;
			$edit_f = $this->admin_model->get_forum_topic($post_forum);
			foreach ($edit_f->result() as $val) :
				$data['forum_name'] = $val->forum_name;
				$forum_cat = $val->forum_cat_id;
			endforeach;
			$edit_c = $this->admin_model->get_cat_topic($forum_cat);
			foreach ($edit_c->result() as $val) :
				$data['cat_name'] = $val->cat_name;
			endforeach;
			$edit_m = $this->admin_model->get_createur_topic($topic_createur);
			foreach ($edit_m->result() as $val) :
				$data['m_pseudo'] = $val->member_pseudo;
				$data['m_email'] = $val->member_email;
				$data['m_avatar'] = $val->member_avatar;
				$data['m_inscrit'] = $val->member_registred;
				$data['m_last_visit'] = $val->member_last_visit;
			endforeach;
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edit topic';
			$data['topic'] = &$topic;
			$this->display($data);
		}
		/**
		 * edited_topic editer un topic
		 *
		 * @return void
		 */
		public function edited_topic()
		{

			$data['menu'] = menu($this->_menu());
			$topic = (int) $this->uri->segment(4);
			$post_id = $this->input->post('post_id');
			$data['pic'] = $this->top_pic();
			$data['title'] = 'edition topic';
			$data['render'] = 'edit topic';
			$this->form_validation->set_rules('message', 'Message', 'required|min_length[3]|max_length[3000]');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				$message = $this->input->post('message');
				$this->admin_model->update_edit_post($message, $post_id);
				$this->admin_model->update_topic_vu($topic);
				$this->alert->set('alert-success', 'Le post a été édité avec succes.<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/consulter_topic/' . $this->idM) . '">Autre édition?</a> ');
				$data['render'] = 'infos';
				$this->display($data);
			}
		}
		/**
		 * delete_topic delete a topic
		 *
		 * @return void
		 */
		public function delete_topic()
		{
			$data['menu'] = menu($this->_menu());
			$topic = (int) $this->uri->segment(4);
			$data['pic'] = $this->top_pic();
			$data['title'] = 'suppression topic';
			$check_t = $this->admin_model->check_createur_topic($topic);
			foreach ($check_t->result() as $val) {
				$titre = $val->topic_title;
				$topic = $val->topic_id;
			}
			$this->alert->set('alert-danger', '<p>Êtes vous certains de vouloir supprimer le topic :<span style="color:#0002E1;"> ' . $titre . '</span> ?<br>
		  Le topic peut contenir plusieurs post, cette action est irréversible. Toutes les données du topic seront perdues
		  </p>
		  <p><a class="btn btn-danger btn-sm" href="' . base_url('modo/deleted_topic/' . $this->idM . '/' . $topic) . '">Supprimer</a>' . nbs(3) . '|' . nbs(3) . '<a class="btn btn-success btn-sm" href="' . base_url('modo/consulter_topic/' . $this->idM) . '">Annuler</a></p>', TRUE);

			$data['render'] = 'infos';
			$data['topic'] = &$topic;
			$this->display($data);
		}
		/**
		 * deleted_topic topic is deleted
		 *
		 * @return void
		 */
		public function deleted_topic()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'suppression topic';
			$topic = (int) $this->uri->segment(4);
			$createur = $this->admin_model->check_createur_topic($topic);
			foreach ($createur->result() as $val) {
				$topic_createur = $val->topic_owner;
			}

			if (!MODO) {
				exit(show_error(ERR_AUTH_DELETE, 403, $heading = 'Nous Avons Rencontré Une Exception'));
			} else {
				if ($this->admin_model->del_topic($topic) > 0) {
					$this->alert->set('alert-success', '<p>Le topic ainsi tous les post qui lui sont associés est suprimé avec succes.
		  </p>
		  <br><br>
		  <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/consulter_topic/' . $this->idM) . '">Retour</a></p>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>Nous somme désolés, le topic n\'est pas supprimé correctement, qulque chose aurait d&ucirc; perturber l\'éxécution normale du script.<br>
		  </p>' . br(2) . '
		  <p>
		  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/consulter_topic/' . $this->idM) . '">Retour</a>
		  </p>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}
		/**
		 * members_list render members list
		 *
		 * @return void
		 */
		public function members_list()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'list members';
			$data['memberlist'] = 'active';
			$data['pic'] = $this->top_pic();
			$data['title'] = 'liste des membres';
			$resp = $this->member_model->count_all_member();
			$limit = $this->input->post('limit') ? $this->input->post('limit') : $this->config_model->member_par_page();
			$config['base_url'] = base_url('modo/members_list/' . $this->idM . '/');
			$config['total_rows'] = $resp;
			$config['per_page'] = $limit;
			$config['num_links'] = 3;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<ul class="pagination pagination-ms">';
			$config['full_tag_close'] = '</ul>';
			$config['attributes'] = array('class' => 'page_link');
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
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['link'] = $this->pagination->create_links();
			$order_by = array('member_id', 'member_pseudo', 'member_post', 'member_last_visit');
			$tri_by = array('ASC', 'DESC');
			$sort = $this->input->post('sort') ? $this->input->post('sort') : 0;
			$tri = $this->input->post('tri') ? $this->input->post('tri') : 0;
			$page = $this->uri->segment(4, 0);
			$data['resp'] = $this->member_model->get_data_member($order_by[$sort], $tri_by[$tri], $limit, $page);
			$this->display($data);
		}
		/**
		 * select_member to edit a member action
		 *
		 * @return void
		 */
		public function select_member()
		{
			$data['menu'] = menu($this->_menu());
			switch ($this->uri->segment(4)) {
				case 'profil':
					$data['form_action'] = 'modo/profil_member/' . $this->idM;
					$data['bread'] = '<strong>:: consulter</strong>';
					$data['title'] = 'selection profil membre';
					break;
				case 'droit':
					$data['form_action'] = 'modo/droit_member/' . $this->idM;
					$data['bread'] = '<strong>:: droit </strong>';
					$data['title'] = 'selection droit membre';
					break;
				case 'bann':
					$data['form_action'] = 'modo/bann_member/' . $this->idM;
					$data['bread'] = '<strong>:: bannir </strong>';
					$data['title'] = 'selection bannir membre';
					break;
				case 'mail':
					$data['form_action'] = 'modo/simple_mail/' . $this->idM;
					$data['bread'] = '<strong>:: mail </strong>';
					$data['title'] = 'selection membre envoi simple';
					break;
				case 'avatar':
					$data['form_action'] = 'modo/update_avatar/' . $this->idM;
					$data['bread'] = '<strong>:: avatar </strong>';
					$data['title'] = 'selection membre update avatar';
					break;
				case 'delete':
					$data['form_action'] = 'modo/delete_member/' . $this->idM;
					$data['bread'] = '<strong>:: delete </strong>';
					$data['title'] = 'selection membre à supprimer';
					break;
			}
			$data['render'] = 'select member';
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}
		/**
		 * profil_member read profil member
		 *
		 * @return void
		 */
		public function profil_member()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['title'] = 'profil de membre';
			if (!$this->input->post('membre')) {
				$this->alert->set('alert-danger', 'Pour consulter le profil d\'un membre, vous devez introduire son pseudo.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/profil') . '"> Ressayer </a>');
				$data['bread'] = '<strong>:: consulter</strong>';

				$this->display($data);
			} elseif ($this->input->post('membre', true)) {
				$query = $this->admin_model->select_member($this->input->post('membre', true));
				if ($query->num_rows() > 0) {
					$data['query'] = &$query;
					$data['render'] = 'profil member';
					$data['title'] = 'profil de membre';

					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Le membre::<strong style="color:red"> ' . $this->input->post('membre') . '</strong> n\'éxiste pas dans la base de donnée.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/profil') . '"> Ressayer </a>');
					$data['title'] = 'profil de membre';
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}
		/**
		 * update_member function to update data members
		 *
		 * @return void
		 */
		public function update_member()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'mise à jour de profil';
			if ($this->input->post('submit')) {
				$form_errors = array();
				$i = 0;
				$query = $this->admin_model->member_by_id($this->input->post('membre_id'));
				foreach ($query->result() as $val) :
					$pseudo = $val->member_pseudo;
					$email = $val->member_email;
					$news = $val->member_notify;
					$signature = $val->member_signature;
					$website = $val->member_website;
				endforeach;

				$new_pseudo = $this->input->post('pseudo');
				$new_email = $this->input->post('email');
				$new_newsltr = $this->input->post('news_ltr');
				$new_signature = $this->input->post('signature');
				$new_website = $this->input->post('website');

				if (strlen($new_pseudo) < 3 || strlen($new_pseudo) > 32) {
					array_push($form_errors, 'le pseudo ne peut etre inferieur à 2 lettre ni superieur à 32 lettres');
					$i++;
				}

				if (!preg_match("#^[a-z0-9A-Z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $new_email)) {
					array_push($form_errors, "L'adresse E-mail semble etre invalide ou elle est vide");
					$i++;
				}
				if ($new_newsltr > 2 || $new_newsltr < 0) {
					array_push($form_errors, "la case news letter n'admet que le chiffre 0 ou 1");
					$i++;
				}
				if ($new_website) {

					$new_website = filter_var($new_website, FILTER_SANITIZE_URL);
					if (!filter_var($new_website, FILTER_VALIDATE_URL)) {
						array_push($form_errors, "La forme de l\'url du site web est invalide.");
						$i++;
					}
				}
				if (strlen($new_signature) > 128) {
					array_push($form_errors, "Par defaut,la signature est limitée à 128 caractere.<br>
			   Mais vous pouvez reconfigurer cette valeur en suivant le lien juste à gauche  : configuration.");
					$i++;
				}
				$query_2 = $this->admin_model->verify_member($this->input->post('membre_id'));
				foreach ($query_2->result() as $row) :
					if ($new_pseudo == $row->member_pseudo) {
						array_push($form_errors, 'ce pseudo est dejà utilisé par un autre membre');
						$i++;
					}
					if ($new_email == $row->member_email) {
						array_push($form_errors, 'cette adresse email est dejà utilisé par un autre membre');
						$i++;
					}
				endforeach;
				if ($i > 0) {
					$id = $this->input->post('membre_id');
					$data['query'] = $this->admin_model->member_by_id($id);
					$data['form_errors'] = $form_errors;
					$data['render'] = 'profil member';
					$this->display($data);
				} else {
					$pseudo = strtolower($this->input->post('pseudo'));
					$email = strtolower($this->input->post('email'));
					$news = $this->input->post('news_ltr');
					$signature = $this->input->post('signature');
					$website = $this->input->post('website');
					$data = array(
						'member_pseudo' => $pseudo,
						'member_email' => $email,
						'member_notify' => $news,
						'member_signature' => $signature,
						'member_website' => $website
					);
					if (($this->admin_model->update_profil_memeber($this->input->post('membre_id'), $data)) > 0) {
						$data['menu'] = menu($this->_menu());
						$this->alert->set('alert-success', 'Les informations du membre: ' . $pseudo . ' ont été mis à jour avec succes.<br><br>
						 <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
						 <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/profil') . '"> Autre Update </a>');
						$data['pic'] = $this->top_pic();
						$data['render'] = 'infos';
						$this->display($data);
						return;
					} else {
						$data['menu'] = menu($this->_menu());
						$this->alert->set('alert-danger', 'Les information du membre: ' . $pseudo . ' n\'ont pas été mis à jour. Si le problème persiste, veuillez contacter l\'équipe <a href="">forum fabb</a><br><br>
						   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> | <a class="btn btn-success btn-sm" href="' . base_url('modo/select_read_member/' . $this->idM) . '"> Page Précédente </a>');
						$data['render'] = 'infos';
						$data['pic'] = $this->top_pic();

						$this->display($data);
						return;
					}
				}
			} else {
				$pseudo = $this->input->post('membre');
				$data['query'] = $this->admin_model->select_member($pseudo);
				$data['render'] = 'profil member';
				$this->display($data);
				return;
			}
		}
		/**
		 * update_avatar update member s avatar
		 *
		 * @return void
		 */
		function update_avatar()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'mise à jour avatar membre';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour mettre à jour l\'avatar d\'un membre,
			   vous devez introduire son pseudo.<br><br>
				<a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/avatar') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
				if ($this->input->post('membre')) {
					$query = $this->admin_model->select_member($this->input->post('membre'));
					if ($query->num_rows() == 0) {
						$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans la base de
				  donnée.<br><br>
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/avatar/') . '"> Ressayer </a>');
						$data['render'] = 'infos';
						$this->display($data);
					} else {
						foreach ($query->result() as $val) :
							$data['avatar'] = $val->member_avatar;
							$data['pseudo'] = $val->member_pseudo;
							$data['id'] = $val->member_id;
						endforeach;
						$data['render'] = 'update avatar';
						$data['title'] = 'avatar membre';
						$this->display($data);
					}
				}
			} elseif ($this->input->post('modifier')) {
				$query = $this->admin_model->select_member($this->input->post('pseudo'));
				foreach ($query->result() as $val) :
					$data['avatar'] = $val->member_avatar;
					$data['pseudo'] = $val->member_pseudo;
					$data['id'] = $val->member_id;
				endforeach;
				if ($_FILES["avatar"]["size"] == 0) {
					$data['menu'] = menu($this->_menu());
					$this->alert->set('alert-success', 'Pour mettre à jour l\'avatar de::
						 <strong style="color:red">' . $val->member_pseudo . '</strong>, vous devez selectionner une image sur votre
						  ordinateur.<br><br>
						 <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
						 <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/avatar') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
				if ($_FILES["avatar"]["size"] > 0) {
					$file = @getimagesize($_FILES["avatar"]["tmp_name"]);
					$width = $file[0];
					$height = $file[1];
					$type = $file[2];
					$form_errors = array();
					$extension = array("png", "jpg", "jpeg", "gif", "GIF", "JPG", "JPEG", "PNG");
					$file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
					if (!in_array($file_extension, $extension)) {
						$form_errors[] = "L'extention : " . $file_extension . " de votre image n'est pas valide. Seulement
								les extentions png, gif, jpeg, et jpg sont acceptées";
					}
					if (($_FILES["avatar"]["size"] > $this->config_model->avatar_size())) {
						$form_errors[] = "Le poid de l'image dépasse les limites autorisées (10ko).";
					}
					if ($width > $this->config_model->avatar_width() || $height > $this->config_model->avatar_height()) {
						$form_errors[] = "Les dimensions de l'image dépassent la longueur et la largeur
								 autorisées (100x100)px.";
					}
					if (sizeof($form_errors) > 0) {
						$data['form_errors'] = $form_errors;
						$data['render'] = 'update avatar';
						$this->display($data);
					} else {
						$file = $_FILES['avatar']['tmp_name'];
						$sourceProperties = getimagesize($file);
						$fileNewName = time();
						$folderPath = "./assets/avatars/";
						$ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
						$imageType = $sourceProperties[2];
						switch ($imageType) {
							case IMAGETYPE_PNG:
								$imageResourceId = imagecreatefrompng($file);
								$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
								imagepng($targetLayer, $folderPath . $fileNewName . '.' . $ext);
								break;
							case IMAGETYPE_GIF:
								$imageResourceId = imagecreatefromgif($file);
								$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
								imagegif($targetLayer, $folderPath . $fileNewName . '.' . $ext);
								break;
							case IMAGETYPE_JPEG:
								$imageResourceId = imagecreatefromjpeg($file);
								$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
								imagejpeg($targetLayer, $folderPath . $fileNewName . '.' . $ext);
								break;
						}
						$data = array(
							'member_avatar' => $fileNewName . '.' . $ext
						);
						if ($this->admin_model->update_profil_memeber($val->member_id, $data) > 0) {
							if ($this->idM === (int) $this->uri->segment(3)) {
								$this->session->set_userdata('avatar', $fileNewName . '.' . $ext);
							}
							$data['menu'] = menu($this->_menu());
							$data['pic'] = $this->top_pic();
							$this->alert->set('alert-success', ' L\'avatar de ' . $val->member_pseudo . ' a été mis à jour
									   avec succes.<br><br>
									 <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo
									  </a> |
									  <a class="btn btn-success btn-sm" href="' . base_url(
								'modo/select_member/' . $this->idM . '/avatar'
							) . '"> Autre Update </a>');
							$data['render'] = 'infos';
							$this->display($data);
						} else {
							$data['menu'] = menu($this->_menu());
							$this->alert->set('alert-danger', 'La mise à jour de l\'avatar de: ' . $pseudo . ' n\'a pas
										réussie. Si le problème persiste, veuillez contacter l\'équipe <a
										href="https://www.forum-fabb.com/">forum fabb</a><br><br>
										<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour
										 Modo </a> |
									   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
							$data['render'] = 'infos';
							$this->display($data);
						}
					}
				}
			} elseif ($this->uri->segment(4)) {
				$query = $this->admin_model->member_by_id($this->uri->segment(4));
				foreach ($query->result() as $val) :
					$data['avatar'] = $val->member_avatar;
					$data['pseudo'] = $val->member_pseudo;
					$data['id'] = $val->member_id;
				endforeach;
				$data['render'] = 'update avatar';
				$data['title'] = 'avatar membre';
				$this->display($data);
			}
		} //end function
		/**
		 * droit_member editer droit membre
		 *
		 * @return void
		 */
		public function droit_member()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'droit member';
			$data['title'] = 'droit membre';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour mettre à jour le niveau d\'un membre,
			   vous devez introduire son pseudo.<br><br>
			  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/droit') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} elseif ($this->input->post('membre')) {
					$query = $this->admin_model->select_member($this->input->post('membre'));
					if ($query->num_rows() == 0) {
						$this->alert->set('alert-danger', 'Le membre: <strong>' . $this->input->post('membre') . '
				  </strong> n\'éxiste pas dans la base de
				  donnée.<br><br>
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/droit') . '"> Ressayer </a>');
						$data['render'] = 'infos';
						$this->display($data);
					} else {
						$membre = $this->input->post('membre');
						$data['render'] = 'droit member';
						$data['menu'] = menu($this->_menu());
						$membre = $this->input->post('membre');
						$data['pic'] = $this->top_pic();
						$data['title'] = 'droit membre';
						$data['query'] = $this->admin_model->select_member($membre);
						$this->display($data);
					}
				}
			} elseif ($this->input->post('envoyer')) {
				$membre = $this->input->post('member');
				$data['query'] = $this->admin_model->select_member($membre);
				$rang = (int) $this->input->post('droit');
				if ($rang == VISITOR) {
					$data['error'] = 'Veuillez ne pas selectionner sans niveau ';
					$data['member'] = $this->input->post('member');
					$data['render'] = 'droit member';
					$data['menu'] = menu($this->_menu());
					$data['title'] = 'droit membre';
					$data['pic'] = $this->top_pic();

					$this->display($data);
				}
				$this->admin_model->update_droit_member($rang, $membre);
				$this->alert->set('alert-success', 'La mise à jour du niveau du membre: ' . $membre . ' a été modifié avec succès.<br>
				 <br>
				 <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
				$data['render'] = 'infos';
				$this->display($data);
			}
		}
		/**
		 * bann_member bannir un membre
		 *
		 * @return void
		 */
		public function bann_member()
		{

			$data['menu'] = menu($this->_menu());
			$data['title'] = 'bannir un membre';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour bannir un membre, vous devez introduire son pseudo<br><br>
		   <a class="btn btn-danger btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/bann') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$this->display($data);
				} elseif ($this->admin_model->check_bann_name($this->input->post('membre'))) {
					if ($this->admin_model->bann_member($this->input->post('membre')) > 0) {
						$this->alert->set('alert-success', 'Le membre: ' . $this->input->post('membre') . ' a été
			   banni avec succès.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$data['pic'] = $this->top_pic();
						$this->display($data);
					} else {

						$this->alert->set('alert-danger', 'La mise à niveau du: ' . $this->input->post('membre') . ' n\'a pas
			  réussie. Si le problème persiste, veuillez contacter l\'équipe fabb.' . br(2) .

							safe_mailto($this->config_model->admin_contact(), 'contact', 'class="btn btn-success btn-sm"') . '
			  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$this->display($data);
					}
				} else {
					$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans
			  la base de donnée.<br><br>
		  <a class="btn btn-danger btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/bann') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$this->display($data);
				}
			}
		}
		/**
		 * delete_member delete a member
		 *
		 * @return void
		 */
		public function delete_member()
		{
			$this->form_validation->set_rules('membre', 'Pseudo Du Membre', 'required|trim|strtolower|callback_is_member');
			if ($this->form_validation->run() == FALSE) {
				$data['form_action'] = 'modo/delete_member/' . $this->idM;
				$data['bread'] = '<strong> :: Supprimer un membre </strong>';
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['render'] = 'select member';
				$data['title'] = 'supprimer un membre';
				$this->display($data);
			}

			if ($this->uri->segment(4) != FALSE) {
				$pseudo = $this->uri->segment(4);
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$this->alert->set('alert-danger', '<p style="color:red !important;font-size:18px;">
			Votre attention svp  ' . $this->pseudo . '....!</p>
			<p>Vous &ecirc;tes sur le point de supprimer le compte de :
			<span style="color:red;">' . $pseudo . '</span>.' . br(2) . '
			<a class="btn btn-danger btn-sm" href="' . base_url('modo/delete_pseudo/' . $this->idM . '/' . rawurlencode($pseudo)) . '">Supprimer</a> |
			<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Annuler</a>', TRUE);
				$this->display($data);
			} else {
				$pseudo = $this->input->post('membre');
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['title'] = 'supprimer un membre';
				$data['render'] = 'infos';
				$this->alert->set('alert-danger', '<p style="color:red !important;font-size:18px;">
			 On n\'a pas pu analyser le pseudo du membre à supprimer, veuillez ressayer svp.' . br(2) . '
			<a class="btn btn-danger btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/delete') . '">Ressayer</a> |
			<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Annuler</a>', TRUE);
				$this->display($data);
			}
		}
		/**
		 * is_member checks if is member
		 *
		 * @return void
		 */
		public function is_member()
		{
			$pseudo = $this->input->post('membre');
			$query = $this->member_model->isDeleted_pseudo($pseudo);
			if (!$pseudo) {
				$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">Veuillez renseigner un pseudo svp...!</span>');
				return false;
			} elseif ($query->num_rows() == 0) {
				$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">Le membre ::
			<strong>' . $pseudo . '</strong> n\'éxiste pas dans la base de donnée.</span>');
				return false;
			} else {
				foreach ($query->result() as $val) :
					$level = $val->member_level;
				endforeach;
				if ($level == DELETED) {
					$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">
			Le compte du membre :: ' . $pseudo . ' est déjà supprimé. Cette action n\'est pas nécéssaire.');
					return false;
				} else {
					return true;
				}
			}
		}
		/**
		 * delete_pseudo delete member by pseudo
		 *
		 * @return void
		 */
		public function delete_pseudo()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['title'] = 'supprimer un membre';
			$pseudo = rawurldecode($this->uri->segment(4));
			if ($this->member_model->del_by_pseudo($pseudo) > 0) {
				$this->alert->set('alert-success', '<p>Le compte de ' . $pseudo . ' est supprimé avec succès.' . br(2) . '
				  <a class="btn btn-danger btn-sm" href="' . base_url('modo/delete_member/' . $this->idM) . '">Autre suppression?</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('forum/') . '">Forum</a>', TRUE);
				$this->display($data);
			} else {
				if ($this->member_model->isDeleted_pseudo($pseudo) == true) {
					$this->alert->set('alert-success', '<p>Le compte de ' . $pseudo . ' est déjà supprimé. Cet action n\'est pas
					   nécéssaire.' . br(2) . '
					  <a class="btn btn-danger btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/delete') . '">Autre
					  suppression?</a> |
					  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
					  <a class="btn btn-success btn-sm" href="' . base_url('forum/') . '">Forum</a>', TRUE);
					$this->display($data);
				}
				$this->alert->set('alert-warning', '<p>
			  Nous sommes désolé le compte de ' . $pseudo . ' n\' pas été supprimé, si le problème perssiste veuillez
			   contacter l\'équipe du forum-fabb pour signaler cet inconvénient.' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>', TRUE);
				$this->display($data);
			}
		}
		/**
		 * list_bann list banned member
		 *
		 * @return void
		 */		
		public function list_bann()
		{

			$data['menu'] = menu($this->_menu());
			$data['bread'] = '<strong> :: Liste des bannis </strong>';
			$data['render'] = 'list bann';
			$data['title'] = 'liste des membres bannis';
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->get_bann_member();
			$this->display($data);
		}
		/**
		 * debann re-activate member
		 *
		 * @return void
		 */
		public function debann()
		{

			$data['menu'] = menu($this->_menu());
			$data['title'] = 'debannir un membre';
			if ($this->input->post('membre_id')) {
				foreach ($this->input->post('membre_id') as $val) {
					$this->admin_model->debann_member($val);
				}
				$this->alert->set('alert-success', 'Les membres selesctionnés ont été debannis avec succès.<br><br>
	 <a class="btn btn-success btn-sm" href="' . base_url('modo/list_bann/' . $this->idM) . '"> Autre Bann </a> |						     <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
	 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
				$data['render'] = 'infos';
				$data['pic'] = $this->top_pic();
				$this->display($data);
			} else {
				$this->alert->set('alert-danger', 'Veuillez selectionner au moins un membre pour actionner le debanissement.<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/list_bann/' . $this->idM) . '"> Autre Bann </a> |						          <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$this->display($data);
			}
		}
		/**
		 * inactif list of inactif members
		 *
		 * @return void
		 */
		public function inactif()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'inactifs';
			$data['title'] = 'membres inactifs';
			$data['bread'] = ' <strong>:: inactif </strong>';
			if ($this->input->post('tri') || $this->input->post('order')) {
				$tri_by = array('member_id', 'member_pseudo', 'member_post', 'member_last_visit');
				$order_by = array('ASC', 'DESC');
				$tri = $this->input->post('tri') ? $this->input->post('tri') : 0;
				$ord = $this->input->post('order') ? $this->input->post('order') : 0;
				$data['query'] =	$this->member_model->is_inactif($tri_by[$tri], $order_by[$ord]);
			} else {
				$data['query'] =	$this->member_model->is_inactif('member_id', 'ASC');
			}
			$this->display($data);
		}
		/**
		 * add_badwords add bad word
		 *
		 * @return void
		 */
		public function add_badwords()
		{

			$data['menu'] = menu($this->_menu());
			$data['render'] = 'add bad';
			$data['pic'] = $this->top_pic();
			$data['title'] = 'ajouter un mot vulgaire';
			$this->form_validation->set_rules('ajout', 'Mot', 'required|trim|is_unique[fabb_badwords.badword_word]');
			$this->form_validation->set_rules('subst', 'Masque', 'required|trim');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {

				if ($this->input->post('subst')) {
					$ajout = $this->input->post('ajout');
					$subst = $this->input->post('subst');
					$array = array(
						'badword_word' => $ajout,
						'badword_replace' => $subst
					);
					$this->admin_model->add_badwords($array);
					$this->alert->set('alert-success', 'Le mot ' . $ajout . ' est ajouté avec succès à votre liste des mots vulgaires.
				  <br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/add_badwords/' . $this->idM) . '">Ajouter autre mot </a> |						          <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}
		/**
		 * badwords shows all bad words
		 *
		 * @return void
		 */
		public function badwords()
		{

			$data['menu'] = menu($this->_menu());
			$data['render'] = 'bad words';
			$data['title'] = 'gerer mots vulgaires';
			$data['pic'] = $this->top_pic();
			if ($this->input->post('ajouter')) {
				$this->add_badwords();
			}
			$page = $this->uri->segment(4, 0);
			$limit = $this->input->post('limit') ? $this->input->post('limit') : $this->config_model->badword_par_page();
			$config['base_url'] = base_url('modo/badwords/' . $this->idM . '/');
			$config['total_rows'] = $this->admin_model->count_badwords();
			$config['per_page'] = $this->config_model->badword_par_page();
			$config['num_links'] = 3;
			//$config['uri_segment'] = 3;
			$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] = '</ul>';
			$config['attributes'] = array('class' => 'page_link');
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
			$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['link'] = $this->pagination->create_links();
			$order_by = array('badword_id', 'badword_word');
			$tri_by = array('ASC', 'DESC');
			$sort = $this->input->post('sort') ? $this->input->post('sort') : 0;
			$tri = $this->input->post('tri') ? $this->input->post('tri') : 0;
			$data['query'] = $this->admin_model->gerer_badwords($order_by[$sort], $tri_by[$tri], $limit, $page);
			if ($this->input->post('delete')) {
				if ($this->admin_model->delete_badwords($this->input->post('delete'))) {
					$this->alert->set('alert-success', 'Les mots selesctionnés ont été supprimés avec succès.<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/badwords/' . $this->idM) . '"> Bad words </a> |						          <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Veuillez selectionner au moins un mot SVP ...!<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/badwords/' . $this->idM) . '"> Ressayer </a> |						          <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
			$this->display($data);
		}
		/**
		 * simple_mail send simple email to  member
		 *
		 * @return void
		 */
		public function simple_mail()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'envoyer email';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Veuillez renseigner le pseudo du membre que vous voulez lui envoyer le message.
			<br><br>
			<a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/mail') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} elseif ($this->admin_model->select_member($this->input->post('membre'))->num_rows() == FALSE) {
					$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans la base de donnée.<br><br>
		<a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/mail') . '"> Ressayer </a> |
		<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$data['render'] = 'mail member';
					$query = $this->admin_model->select_member($this->input->post('membre'));
					foreach ($query->result() as $val) {
						$data['membre_pseudo'] = $val->member_pseudo;
						$data['membre_email'] = $val->member_email;
					}
					$this->display($data);
				}
			}
		}
		/**
		 * mail_member send email to member
		 *
		 * @return void
		 */
		public function mail_member()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'mail member';
			$data['title'] = 'mail member';
			$this->form_validation->set_rules('objet', 'Objet', 'required|max_length[256]');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['membre_email'] = $this->input->post('member_email');
				$data['membre_pseudo'] = $this->input->post('member_pseudo');
				$this->display($data);
			} else {
				$this->load->model('smtp_model');
				$this->load->library('phpmailer_lib');
				// PHPMailer object
				$mail = $this->phpmailer_lib->load();
				if ($this->smtp_model->active() == true) {
					// SMTP configuration
					$mail->isSMTP();
					$mail->Host     = $this->smtp_model->hostsmtp();
					$mail->SMTPAuth = true;
					$mail->Username = $this->smtp_model->usersmtp();
					$mail->Password = $this->smtp_model->pswsmtp();
					$mail->SMTPSecure = $this->smtp_model->cryptsmtp();
					$mail->Port     = $this->smtp_model->portsmtp();
				}
				$mail->setFrom($this->config_model->admin_contact(), $this->config_model->title_forum());
				$mail->addReplyTo($this->config_model->admin_contact(), 'No-reply');
				$mail->AddAddress($this->input->post('to'));
				$mail->Subject = $this->input->post('objet');
				// Set email format to HTML
				$mail->isHTML(true);
				$content = $this->input->post('message');
				$this->load->add_package_path(APPPATH . 'third_party/resources', FALSE);
				$htmlBody = $this->load->view('htmlHeader', $data, true);
				$htmlBody .= $content;
				$htmlBody .= $this->load->view('htmlFooter', $data, true);
				$this->load->remove_package_path(APPPATH . 'third_party/resources');
				$mail->Body = $htmlBody;
				$mail->CharSet = 'UTF-8';
				$mail->AltBody = $this->input->post('message');
				if ($mail->send()) {
					$this->alert->set('alert-success', 'Le message envoyé à ' . $this->input->post('to') . ' a été envoyé avec succes.<br><br>
			<a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/mail') . '">Envoyer autre message </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Le message envoyé à ' . $this->input->post('to') . ' a échoué.<br>
	   Veuillez consulter les causes suivantes:<br>' . $this->email->print_debugger() . '<br>
	   Si le probleme perssiste, veuillez contacter l\'équipe:<a href="https://www.forum-fabb.com/forum/contact"> fabb</a> <br><br>
	   <a class="btn btn-success btn-sm" href="' . base_url('modo/select_member/' . $this->idM . '/mail') . '">Ressayer </a> |
	   <a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '"> Retour Modo </a> |
	   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$this->display($data);
				}
			}
		}
		/**
		 * abus_report send abus report
		 *
		 * @return void
		 */
		public function abus_report()
		{
			$data['render'] = 'abus';
			$data['title'] = 'rapport d\'abus';
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$this->load->model('contact_model');
			$data['query'] = $this->contact_model->get_reports();
			$this->display($data);
		}
		/**
		 * read_abus read msg from good member
		 *
		 * @return void
		 */
		public function read_abus()
		{
			$this->load->model('contact_model');
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'rapport d\'abus';
			$data['render'] = 'read abus';
			$id = (int) $this->uri->segment(4);
			$data['query'] = $this->contact_model->get_message($id);
			$this->contact_model->update_read($id);
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}
		/**
		 * delete_report supprimer les rapports d'abus
		 *
		 * @return void
		 */
		public function delete_report()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$id_mess = $this->uri->segment(4);

			if ($this->uri->segment(5) === 'msg') {
				$this->alert->set('alert-warning', '<p>Attention : Vous voulez vraiment supprimer ce méssage..!</p>' . br(2) . '
		<a class="btn btn-danger btn-sm" href="' . base_url('delete/report/' . $this->idM . '/' . $id_mess . '/1') . '">Supprimer</a> |
		<a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Annuler</a> ', TRUE);
				$this->display($data);
			} elseif ($this->uri->segment(5) == '1') {
				$id_mess = $this->uri->segment(4);
				$this->load->model('contact_model');
				$resp = $this->contact_model->del_report($id_mess);
				if ($resp > 0) {
					$this->alert->set('alert-success', '<p>Le message a été supprimé avec succes..!<br></p>
					  <p><a class="btn btn-success btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Retour</a></p>', TRUE);
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>le méssage n\'est pas supprimé correctement.<br><br>
		  Si le problème perssite, veuillez contacter l\'équipe ::
		  <a class="btn btn-success btn-sm" href="https://www.forum-fabb.com/forum/contact"> fabb</a></p>', TRUE);

					$this->display($data);
				}
			}
		}
		/**
		 * gerer_robots continue to edit ads
		 *
		 * @return void
		 */
		public function gerer_robots()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'gerer robots';
			$data['title'] = 'gerer robots';
			$data['bread'] = ' <strong>:: Gerer les spiders </strong>';
			$data['bots'] = $this->admin_model->gerer_bots();
			$this->display($data);
		}
		/**
		 * unlock_bot this bot is safe
		 *
		 * @return void
		 */
		public function unlock_bot()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'deverouiller un robot';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->unlock_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' a été rendu légitime avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le statut du bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été changé.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '<a class="btn btn-primary btn-xs" href="https://www.forum-fabb.com/forum/contact">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			}
		}
		/**
		 * lock_bot bot is in the web
		 *
		 * @return void
		 */
		public function lock_bot()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'verouiller un robot';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->lock_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' a été bloqué avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été bloqué.' . br(1) . 'Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '<a class="btn btn-primary btn-xs" href="https://www.forum-fabb.com/forum/contact">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			}
		}
		/**
		 * delete_bots delete bot from db
		 *
		 * @return void
		 */
		public function delete_bots()
		{

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['title'] = 'supprimer un robot';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->delete_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . rawurldecode($this->uri->segment(5)) . ' a été
			  supprimé avec succès de la base de donnée.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été
			  supprimé.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="https://www.forum-fabb.com/forum/contact">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);

				$this->display($data);
				return;
			}
		}
		/**
		 * statistic some statistcs
		 *
		 * @return void
		 */
		public function statistic()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'statistic';
			$data['title'] = 'statistique du forum';
			$data['title'] = 'statistiques du forum';
			$data['list_forum'] = $this->admin_model->liste_forum();
			$data['totalMembers'] = $this->forum_model->count_users();
			$data['banned'] = $this->admin_model->banned_members();
			$data['deleted'] = $this->admin_model->deleted_account();
			$data['pending'] = $this->admin_model->pending_account();
			$data['actif'] = $this->admin_model->actif_account();
			$data['modo'] = $this->admin_model->modo_account();
			$data['admin'] = $this->admin_model->admin_account();
			$data['online'] = $this->admin_model->online_visitors();
			$data['data_online'] = $this->admin_model->online_visitors();
			$data['data_day'] = $this->admin_model->day_data_visit();
			$data['day'] = $this->admin_model->day_vositors();
			$data['week'] = $this->admin_model->week_visitors();
			$data['month'] = $this->admin_model->month_visitors();
			$data['year'] = $this->admin_model->year_visitors();
			$data['all_time'] = $this->admin_model->all_time_visit();
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}
		/**
		 * display helper function to display data
		 *
		 * @param  mixed $data
		 * @return void
		 */
		public function display($data)
		{

			$this->load->view('inc/header', $data);
			$this->load->view('inc/topPage', $data);
			$this->load->view('inc/navBar', $data);
			$this->load->view('modo/index', $data);
			$this->load->view('inc/footer', $data);
		}
		/**
		 * _menu helper function to render menu
		 *
		 * @return void
		 */		
		protected function _menu()
		{
			$tpid = $this->member_model->total_post_idm($this->idM);
			$ttid = $this->member_model->total_topic_idm($this->idM);
			$array = array(
				'lvl' => $this->lvl,
				'blink' => 'modo',
				'msg' => $this->msg,
				'nbr_msg' => $this->nbr_msg,
				'avatar' => $this->avatar,
				'pseudo' => $this->pseudo,
				'email' => $this->email,
				'status' => ADMIN,
				'idM' => $this->idM,
				'tpid' => $tpid,
				'ttid' => $ttid,
			);
			return $array;
		}
		/**
		 * top_pic render forum image
		 *
		 * @return void
		 */
		public function top_pic()
		{
			$photo = $this->admin_model->get_pics();
			foreach ($photo->result() as $pic) :
				$data['pic'] = $pic->pic_file;
			endforeach;
			return $data['pic'];
		}
        /**
         * error_view show errors
         *
         * @return void
         */
		public function error_view()
		{
			$this->load->view('error_view', array('error' => ' '));
		}
		/**
		 * anchor views popup msg
		 *
		 * @return void
		 */
		public function anchor()
		{
			$this->load->view('anchor/topage');
		}
		/**
		 * check_free_user must be unique pseudo
		 *
		 * @param  mixed $memberid
		 * @return void 
		 */
		public function check_free_user($memberid)
		{
			$query = $this->admin_model->member_by_id($memberid);
			foreach ($query->result() as $resp) :
				$member = $resp->membre_pseudo;
			endforeach;
			$query = $this->admin_model->concerned_member($member);

			$free_user = ($query->num_rows() == 0) ? 1 : 0;
			if ($free_user) {
				'Ce pseudo est déjà utilisé par un autre membre';
				return true;
			}
		}
		/**
		 * member_level update level member
		 *
		 * @param  mixed $rang
		 * @return void
		 */
		public function member_level($rang)
		{
			if ($rang == 'espace vide') {
				$this->form_validation->set_message('member_level', 'The {field} field can not be the word "test"');
				return FALSE;
			} else {
				return TRUE;
			}
		}
		/**
		 * alerter warning inactif member
		 *
		 * @return void
		 */
		public function alerter()
		{

			$member = rawurldecode($this->uri->segment(4));
			$query = $this->admin_model->select_member($member);
			foreach ($query->result() as $val) {
				$data['membre_pseudo'] = $val->member_pseudo;
				$data['membre_email'] = $val->member_email;
			}

			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'mail member';
			$this->display($data);
		}
		/**
		 * aviser alert member pm
		 *
		 * @return void
		 */
		public function aviser()
		{

			$recept = (int) $this->uri->segment(4);
			$pseudo = rawurldecode($this->uri->segment(5));
			$titre = 'Compte inactif';
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['render'] = 'compte inactif';
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: inactif </strong>';
			$message = 'Nous avons constaté que votre compte est inactif depuis plus de ' . $this->config_model->in_actif() . ' mois, le reglement nous olige de vous aviser sur cet état avant la supression de votre compte.<br>
						  Si vous vous &ecirc;tes enregisté par erreur sur le forum, aucune action n\'est à prévoir de votre part, votre compte sera supprimer automatiquement d\ici quelque temps.<br>
						  Merci pour votre compréhension.<br>
						  Le webmaster.';

			$array = array(
				'pmsg_sender' => $this->idM,
				'pmsg_recept' => $recept,
				'pmsg_object' => $titre,
				'pmsg_text' => $message,
				'pmsg_time' => time(),
				'pmsg_read' => '0',
			);
			$this->member_model->send_welcome_msg($array);
			$this->alert->set('alert-success', '<p>
			      Le message est envoyé avec succès à ' . $pseudo . ' l\'avisant sur l\'inactivité de son compte.' . br(2) . '
			      <a class="btn btn-primary btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('modo/inactif/' . $this->idM) . '">Autre action?</a> |', TRUE);
			$this->display($data);
		}
		/**
		 * mailer alert member email
		 *
		 * @return void
		 */		
		public function mailer()
		{

			$recept = $this->uri->segment(4);
			$pseudo = $this->uri->segment(5);
			$titre = 'Compte inactif';
			$data['render'] = 'compte inactif';
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'infos';
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: inactif </strong>';

			$message = 'Nous avons constaté que votre compte est inactif depuis plus de ' . $this->config_model->in_actif() . ' mois, le reglement nous olige de vous aviser sur cet état avant la supression de votre compte.<br>
						  Si vous vous &ecirc;tes enregisté par erreur sur le forum, aucune action n\'est à prévoir de votre part, votre compte sera supprimer automatiquement d\ici quelque temps.<br>
						  Merci pour votre compréhension.<br>
						  Le webmaster.';

			$array = array(
				'pmsg_sender' => $this->idM,
				'pmsg_recept' => $recept,
				'pmsg_object' => $titre,
				'pmsg_text' => $message,
				'pmsg_time' => time(),
				'pmsg_read' => '0',

			);
			$this->member_model->send_welcome_msg($array);

			$this->alert->set('alert-success', '<p>
			    Le message est envoyé avec succès à ' . $pseudo . ' l\'avisant sur l\'inactivité de son compte.' . br(2) . '
			    <a class="btn btn-primary btn-sm" href="' . base_url('modo/index/' . $this->idM) . '">Modo</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('modo/inactif/' . $this->idM) . '">Autre action?</a> |', TRUE);
			$this->display($data);
		}
	}




	/*
  $class_methods = get_class_methods('Admin');
  sort($class_methods);

  foreach ($class_methods as $method_name) {
	  echo '<p style="margin-left:20px;">'.$method_name.'<br>';
  }*/
	?>