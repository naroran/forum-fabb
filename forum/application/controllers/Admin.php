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
	 * Admin class to handle admin work
	 */
	class Admin extends CI_Controller
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
		 * @var string $msg reference to active session member message
		 */
		public $msg;
		/**
		 * @var int $nbr_msg reference to active session member number msg
		 */
		public $nbr_msg;
		/**
		 * @var string $status reference to active session state member
		 */
		public $status;
		/**
		 * @var string $ip reference to active session ip member
		 */
		public $ip;

		/**
		 * __construct construct function
		 *
		 * @return void
		 */
		function __construct()
		{
			parent::__construct();
			$this->load->model(array('admin_model', 'forum_model', 'smtp_model'));
			$this->load->library(array('form_validation', 'pagination', 'alert', 'bbcode'));
			$this->load->config('glyph');
			$this->lvl = $this->session->has_userdata('lvl') ? (int) $this->session->lvl : 1;
			$this->pseudo = $this->session->has_userdata('pseudo') ? $this->session->pseudo : FALSE;
			$this->email = $this->session->has_userdata('email') ? $this->session->email : FALSE;
			$this->avatar = $this->session->has_userdata('avatar') ? $this->session->avatar : FALSE;
			$this->idM = $this->session->has_userdata('idM') ? (int) $this->session->idM : 0;
			$this->msg = $this->session->has_userdata('msg') ? $this->session->msg : FALSE;
			$this->nbr_msg = $this->session->has_userdata('nbr_msg') ? $this->session->nbr_msg : FALSE;
			$this->status = $this->session->has_userdata('status') ? $this->session->status : VISITOR;
			if (!$this->input->ip_address()) {
				exit(show_error(ERR_HACK, 403, $heading = 'Nous Avons Rencontré Une Exception'));
			}
			$this->ip = $this->session->has_userdata('ip') ? $this->session->ip : $this->session->set_userdata('ip', $this->input->ip_address());
			if ($this->forum_model->bad_bot($this->ip) == true) {
				exit(show_error(ERR_HACK, 403, $heading = 'Nous Avons Rencontré Une Exception'));
			}
			if ($this->status != ADMIN || $this->idM != $this->uri->segment(3)) {
				exit(show_error(ERR_HACK, 403, $heading = 'Nous Avons Rencontré Une Exception'));
			}
			if ($this->member_model->is_online($this->ip) > 0) {
				$this->member_model->update_online($this->ip);
			} else {
				$query = dataVisitor($this->input->ip_address());
				$country = $query['country'];
				$code = $query['countryCode'];
				$city = $query['city'];
				$platform = $this->agent->platform();
				if ($this->agent->is_browser()) {
					$agent = $this->agent->browser() . ' ' . $this->agent->version();
				} elseif ($this->agent->is_robot()) {
					$agent = $this->agent->robot();
				} elseif ($this->agent->is_mobile()) {
					$agent = $this->agent->mobile();
				} else {
					$agent = 'Unidentified';
				}
				$array = array(
					'online_id' => $this->idM,
					'online_time' => time(),
					'online_ip' => $this->ip,
					'online_country' => $country,
					'online_code' => $code,
					'online_city' => $city,
					'online_platform' => $platform,
					'online_browser' => $agent
				);
				$this->member_model->insert_online($array);
			}
			$this->load->model('msgs_model');
			$query = $this->msgs_model->unread_msg($this->idM);
			$this->session->set_userdata('nbr_msg', $query);
		}

		/**
		 * index shows admin's dashboard
		 *
		 * @return void
		 */
		public function index()
		{
			$data['render'] = '';
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['title'] = 'dashboard admin';
			$data['start_time']=microtime(true);
			$this->display($data);
		}

		/**
		 * config make forum configuration
		 *
		 * @return void
		 */
		public function config()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'configuration';
			$data['title'] = 'configuration forum';
			$data['logo'] = $this->logo();
			$data['res'] = $this->forum_model->get_configuration();
			if (!$this->input->post('config')) {
				$data['pic'] = $this->top_pic();
				$this->display($data);
			} else {
				foreach ($data['res']->result_array() as $data) :
					if ($data['config_value'] != $this->input->post($data['config_name'])) {
						$data['value'] = $this->input->post($data['config_name']);
						$this->admin_model->update_config($data['value'], $data['config_name']);
					}
				endforeach;
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'infos';
				$this->alert->set('alert-success', ' Les changements ont été mis à jour avec succès.' . br(2) . '
			  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('admin/config/' . $this->idM) . '">
			  Autre Configurations</a>', TRUE);
				$this->display($data);
			}
		}
		/**
		 * add_logo add logo to your forum
		 *
		 * @return void
		 */
		public function add_logo()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'ajouter image';
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			if ($this->input->post('add_logo') !== '1') {
				$data['add_logo'] = 'add_logo';
				$data['render'] = 'add logo';
				$this->display($data);
			} else {
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '10000';
				$config['max_width'] = '500';
				$config['max_height'] = '500';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('logo')) {
				$data_pic = $this->upload->data();
				$data_infos = array('pic_file' => strtolower($data_pic['file_name']),
				                     'pic_title'=>'logo forum'         );
				$this->admin_model->store_logo($data_infos);
				$this->alert->set('alert-success', ' L\'image du forum est uploadée avec succes.' . br(2) . '
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$data['img_forum'] = 'active';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Erreurs:<br>
						 Veuillez corriger les erreurs suivantes: ' . $this->upload->display_errors() . '
						 <a class="btn btn-success btn-sm" href="' . base_url('admin/add_logo/'.$this->idM) . '">Ressayer</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}		

		/**
		 * add_img change img of forum
		 *
		 * @return void
		 */
		public function add_img()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'ajouter image';
			$data['pic'] = $this->top_pic();
			if ($this->input->post('add_img') !== '1') {
				$data['add_img'] = 'add_img';
				$data['render'] = 'add img';
				$data['logo'] = $this->logo();
				$this->display($data);
			} else {
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = TRUE;
				$config['max_size'] = '204800';
				$config['max_width'] = '300';
				$config['max_height'] = '200';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload(strtolower('userfile'))) {
					$data_pic = $this->upload->data();
					$data_infos = array('pic_file' => $data_pic['file_name']);
					$this->admin_model->store_pic($data_infos);
					$this->alert->set('alert-success', ' L\'image du forum est uploadée avec succes.' . br(2) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$data['img_forum'] = 'active';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'ERREURS:<br>
						 Veuillez corriger les erreurs suivantes: ' . $this->upload->display_errors() . '
						 <a class="btn btn-success btn-sm" href="' . base_url('admin/add_img/' . $this->idM) . '">Ressayer</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}

		/**
		 * all_cat whows all cat
		 *
		 * @return void
		 */
		public function all_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'all_cat';
			$data['title'] = 'toutes les categories';
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['list_cat'] = $this->admin_model->list_cat();
			$this->display($data);
		}

		/**
		 * add_cat add a category to forum
		 *
		 * @return void
		 */
		public function add_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'add cat';
			$data['title'] = 'ajouter une categorie';
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			if ($this->uri->segment(4) !== 'new_cat') {
				$this->display($data);
			} else {
				$this->form_validation->set_rules('nom', 'Nom catégorie', 'trim|required|is_unique[fabb_cat.cat_name]');
				if ($this->form_validation->run() == FALSE) {
					$this->display($data);
				} else {
					$query = $this->admin_model->max_cat();
					foreach ($query->result() as $val) {
						$data = array(
							'cat_name' => $this->input->post('nom'),
							'cat_order' => $val->ordre + 10
						);
						$this->admin_model->add_cat($data);
						$data['pic'] = $this->top_pic();
						$data['logo'] = $this->logo();
						$data['render'] = 'infos';
						$data['menu'] = menu($this->_menu());
						$data['title'] = 'ajouter une categorie';
						$this->alert->set('alert-success', 'La categorie a été ajouté avec succès' . br(2) . '
						  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour</a> |
						  <a class="btn btn-success btn-sm" href="' . base_url('admin/add_cat/' . $this->idM) . '">
						  Ajouter categorie</a>', TRUE);
						$this->display($data);
					}
				}
			}
		}

		/**
		 * select_cat select category to edit it
		 *
		 * @return void
		 */
		public function select_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'selection de categorie';
			$data['render'] = 'select cat';
			$data['logo'] = $this->logo();
			$data['query'] = $this->admin_model->get_all_cat();
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}


		/**
		 * edit_cat edit a category
		 *
		 * @return void
		 */
		public function edit_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'edition de categorie';
			$data['render'] = 'edit cat';
			$data['logo'] = $this->logo();
			$data['query'] = $this->admin_model->editable_cat($this->input->post('cat'));
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}


		/**
		 * edited_cat edited category
		 *
		 * @return void
		 */
		public function edited_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edited cat';
			$data['logo'] = $this->logo();
			$data['title'] = 'edition categorie';
			$titre = $this->input->post('nom');
			$cat = $this->input->post('cat');
			$query = $this->admin_model->verif_edit_cat($titre, $cat);
			if ($query->num_rows() == 0) {
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'infos';
				$data['title'] = 'edition categorie';
				$data['menu'] = menu($this->_menu());
				$this->alert->set('alert-danger', 'Le nom ' . $this->input->post('nom') . ' existe déjà dans la base de donnée' . br(1) . '
					   vous ne pouvez pas donner le m&ecirc;me nom à 2 categories avec un contenu différent.' . br(2) . '
					   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour</a> |
					   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_cat/' . $this->idM) . '">Ressayer</a>', TRUE);
				$this->display($data);
			} else {
				$this->admin_model->update_edited_cat($titre, $cat);
				$data['cat'] = "active";
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'infos';
				$data['menu'] = menu($this->_menu());
				$this->alert->set('alert-success', 'La catégorie ' . $this->input->post('nom') . ' a été mise à jour avec
				 succès.' . br(2) . '
				 <a class="btn btn-success btn-sm" href="' . base_url('admin/index/'.$this->idM) . '">Retour</a> |
				 <a class="btn btn-success btn-sm" href="' . base_url('admin/select_cat/'.$this->idM) . '">Continuer L\'édition?</a>
				  ', TRUE);
				$this->display($data);
			}
		}


		/**
		 * del_cat delete a category
		 *
		 * @return void
		 */
		public function del_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'selection categorie à supprimer';
			$data['render'] = 'del cat';
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->get_all_cat();
			$this->display($data);
		}

		/**
		 * categorie confirm category
		 *
		 * @return void
		 */
		public function categorie()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'delete_cat';
			$data['logo'] = $this->logo();
			$data['title'] = 'categorie';
			$cat_id = $this->input->post('cat');
			if ($this->admin_model->nbr_forum($cat_id) > 0) {
				$resp = $this->admin_model->editable_cat($cat_id);

				foreach ($resp->result() as $row) :
					$cat_name = $row->cat_name;
				endforeach;
			}
			$resp_2 = $this->admin_model->get_forum_id($cat_id);
			$forum_id = array();
			if ($resp_2->num_rows() > 0) {
				foreach ($resp_2->result_array() as $row) {
					$forum_id[] = $row['forum_id'];
				}
			}
			$nbr_forum = sizeof($forum_id) ? sizeof($forum_id) : 0;
			$topic_id = array();
			if (sizeof($forum_id) > 0) {
				$resp_3 = $this->admin_model->nbr_topic($forum_id);
				foreach ($resp_3->result_array() as $val) {
					$topic_id[] = $val['topic_id'];
				}
			}
			$nbr_topic = sizeof($topic_id) ? sizeof($topic_id) : 0;
			$post_id = array();
			if (sizeof($topic_id) > 0) {
				$resp_4 = $this->admin_model->nbr_post($topic_id);
				foreach ($resp_4->result_array() as $val) {
					$post_id[] = $val['post_id'];
				}
			}
			$nbr_post = sizeof($post_id) ? sizeof($post_id) : 0;
			if ($this->uri->segment(4) === 'supprimer') {
				$this->alert->set('alert-danger', heading('Avertissement', 5, 'style="color:red"') . '
				  &Ecirc;tes vous certain de vouloir supprimer la catégorie: <span style="color:red"> ' . $cat_name . ' </span>?.<br>
				  Cette action est irréverssible. <br>
				  La categorie <span style="color:red"> ' . $cat_name . ' </span> contient :<br>
				  ' . $nbr_forum . ' forms.<br>
				  ' . $nbr_topic . ' topic.<br>
				  ' . $nbr_post . ' post.<br>
				  Tous les forums, topic et post qui sont associés à cette categorie seront suprimés définitivement.' . br(2) . '
			   ' . anchor('admin/delete_cat/' . $this->idM . '/1/' . rawurlencode($cat_name), 'Supprimer', 'class="btn btn-danger btn-sm"') .
					' |
			   ' . anchor('admin/del_cat/' . $this->idM, nbs(3) . 'Annuler' . nbs(3), 'class="btn btn-success btn-sm"'), TRUE);
				$data['render'] = 'infos';
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$this->display($data);
			}
		}

		/**
		 * delete_cat category is deleted
		 *
		 * @return void
		 */
		public function delete_cat()
		{
			$data['menu'] = menu($this->_menu());
             $data['logo'] = $this->logo();
			$data['render'] = 'infos';
			$data['title'] = 'suppression categorie';
			$data['pic'] = $this->top_pic();

			if ($this->uri->segment(4) == 1) {
				$cat_name = rawurldecode($this->uri->segment(5));
				$cat_id = $this->admin_model->select_cat_id($cat_name);
				foreach ($cat_id->result() as $val) {
					$cat_id = $val->cat_id;
				}
				if ($this->admin_model->delete_cat($cat_id) > 0) {
					$this->alert->set('alert-success', 'La categorie ' . $cat_name . ' et tout les forums, topic et post qui lui sont
				   associés ont étaient supprimés avec succès.' . br(2)
						. anchor('admin/del_cat/' . $this->idM, 'Autre Suppression', 'class="btn btn-success btn-sm"') . ' |
				  ' . anchor('admin/index/' . $this->idM, nbs(3) . 'Retour Admin' . nbs(3), 'class="btn btn-success btn-sm"'), TRUE);
					$data['render'] = 'infos';
					$data['menu'] = menu($this->_menu());
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'il semble que la suppression a échoué. veuillez ressayer
					  ultérieurement.<br>
							  Si le probleme perssiste, veuillez informer l\'équipe fabb.'
						. anchor('contact', 'contact fabb', 'class="btn btn-success btn-sm"') . ' |
				  ' . anchor('admin/index/' . $this->idM, nbs(3) . 'Retour Admin' . nbs(3), 'class="btn btn-success btn-sm"'), TRUE);
				}
				$this->display($data);
			}
		}

		/**
		 * select_ord_cat Change Category Order
		 *
		 * @return void
		 */
		function select_ord_cat()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'select ord cat';
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['title'] = 'changer ordre categorie';
			$data['query'] = $this->admin_model->get_ord_cat();
			$this->display($data);
		}

		/**
		 * edit_ord_cat edit Category Order
		 *
		 * @return void
		 */
		public function edit_ord_cat()
		{
            $data['menu'] = menu($this->_menu());
			$data['render'] = 'edit ord cat';
			$data['title'] = 'editer ordre cat';
			$data['logo'] = $this->logo();
			$query = $this->admin_model->select_ord_cat();
			foreach ($query->result_array() as $val) :
				$order = (int) $this->input->post($val['cat_id']);
				if ($val['cat_order'] != $order) {
					$this->admin_model->update_ord_cat($order, $val['cat_id']);
				}
			endforeach;
			$this->alert->set('alert-success', 'L\'orde des catégories a été mis à jour avec succès.' . br(2) . '
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_ord_cat/' . $this->idM) . '">
					  Continuer L\'édition?</a>', TRUE);
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'infos';
			$this->display($data);
		}

		/**
		 * all_forum shows all forum
		 *
		 * @return void
		 */
		public function all_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'all_forum';
			$data['title'] = 'tout les forums';
			$data['logo'] = $this->logo();
			$data['list_forum'] = $this->admin_model->liste_forum();
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}

		/**
		 * add_forum add a forum to category
		 *
		 * @return void
		 */
		public function add_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'creer forum';
			$data['title'] = 'ajouter un forum';
			$data['logo'] = $this->logo();
			if (!$this->uri->segment(4)) {
				$data['res'] = $this->admin_model->create_forum();
				$this->display($data);
			} else {
				if ($this->uri->segment(4) !== 'create') {
					exit(show_error(ERR_HACK, 403, $heading = 'Nous Avons Rencontré Une Exception'));
				}
	if($this->forum_model->count_all_forum()!=NULL){
	$this->form_validation->set_rules('nom', 'Nom du forum', 'min_length[4]|max_length[128]|trim|required|callback_forum_uniq');
	}else{
	$this->form_validation->set_rules('nom', 'Nom du forum', 'min_length[4]|max_length[128]|trim|required');	}
	$this->form_validation->set_rules('desc', 'Desception', 'trim|required|max_length[128]');
	$this->form_validation->set_rules('page', 'Forum Groupe', 'required|callback_page');
	$this->form_validation->set_rules('cat', 'Categorie', 'required|callback_cat');
	if ($this->form_validation->run() == FALSE) {
		$data['res'] = $this->admin_model->create_forum();

		$data['pic'] = $this->top_pic();
		$data['logo'] = $this->logo();

		$this->display($data);
		return;
	}
	$query = $this->admin_model->max_ordre_forum();
	foreach ($query->result() as $val) {
		$order = $val->max_ordre + 10;
	}

				$data = array(
					'forum_cat_id' => $this->input->post('cat'),
					'forum_name' => $this->input->post('nom'),
					'forum_desc' => $this->input->post('desc'),
					'forum_order' => $order,
					'forum_group' => $this->input->post('page'),
					'forum_auth_view' => '1',
					'forum_auth_topic' => '4',
					'forum_auth_post' => '4',
					'forum_auth_annonce' => '6',
					'forum_auth_modo' => '5',
				);
					$this->admin_model->add_forum($data);
					$this->alert->set('alert-success', 'Le forum ' . $this->input->post('nom') . ' a été ajouté avec succès.' . br(2) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
					<a class="btn btn-success btn-sm" href="' . base_url('admin/add_forum/' . $this->idM) . '">
					Ajouter forum?</a>
					', TRUE);
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$data['title'] = 'ajouter un forum';
					$data['menu'] = menu($this->_menu());
					$this->display($data);
				//}
			}
		}
		
		/**
		 * forum_uniq checks for unique forum name
		 *
		 * @return void
		 */
		public function forum_uniq()
		{
			$catid=$this->input->post('cat');
			$name=$this->input->post('nom');
			if ($this->forum_model->uniqForumName($catid,$name)) {
				$this->form_validation->set_message(__function__, '<span style=" font-size:10px;color:red;">Un forum du m&ecirc;me nom ('.$this->input->post('nom').')  existe déjà dans la m&ecirc;me catégorie</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}
		/**
		 * cat checks form to add category
		 *
		 * @return void
		 */
		public function cat()
		{
			if ($this->input->post('cat') == 'choisir') {
				$this->form_validation->set_message('cat', '<span style=" font-size:11px;color:red;">Le champ %s ne peut &ecirc;tre
			choisir</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}

		/**
		 * select_forum select forum to edit it
		 *
		 * @return void
		 */
		public function select_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'select forum';
			$data['title'] = 'selection de forum';
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->liste_forum();
			$this->display($data);
		}

		/**
		 * edit_forum edition forum
		 *
		 * @return void
		 */
		public function edit_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edit forum';
			$data['title'] = 'editer un forum';
			$data['logo'] = $this->logo();
			$forum = $this->input->post('forum');
			$data['query'] = $this->admin_model->selected_forum($forum);
			$data['query2'] = $this->admin_model->get_all_cat();
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}

		/**
		 * edited_forum edited forum
		 *
		 * @return void
		 */
		public function edited_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['logo'] = $this->logo();
			$inputName = $this->input->post('nom', true);
			$desc = $this->input->post('desc', true);
			$cat = (int) $this->input->post('depl', true);
			$forum_id = (int) $this->input->post('forum_id', true);
			$verif = $this->admin_model->selected_forum($forum_id);
			foreach ($verif->result() as $val) :
				$forumName = $val->forum_name;
			endforeach;
			$etat = $this->admin_model->verif_edited_forum($inputName);
			if (($forumName === $inputName && $etat <= 1) || ($forumName !== $inputName && $etat == 0)) {
				$array = array(
					'id' => $forum_id,
					'cat_id' => (int) $this->input->post('depl'),
					'name' => $this->input->post('nom'),
					'desc' => $this->input->post('desc')
				);
				$this->admin_model->update_edited_forum($array);
				$this->alert->set('alert-success', 'Le forum ' . $this->input->post('nom') . ' a été modifié avec
				 succès.' . br(2) . '
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				<a class="btn btn-success btn-sm" href="' . base_url('admin/select_forum/' . $this->idM) . '">
				Autre édition?</a>', TRUE);
				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$data['title'] = 'editer un forum';
				$data['logo'] = $this->logo();
				$data['menu'] = menu($this->_menu());
				$this->display($data);
			} elseif ($forumName !== $inputName && $etat > 0) {
				$this->alert->set('alert-danger', 'Le forum ' . $this->input->post('nom') . ' existe déjà.' . br(2) . '
							  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
							  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_forum/' . $this->idM) . '">
							  Ressayer</a>
							  ', TRUE);

				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$data['logo'] = $this->logo();
				$data['menu'] = menu($this->_menu());
				$this->display($data);
			}
		}

		/**
		 * move_forum move forum to an other category
		 *
		 * @return void
		 */
		public function move_forum()
		{

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
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
				 <a class="btn btn-success btn-sm" href="' . base_url('admin/move_forum/' . $this->idM) . '"> Déplacer Autre Forum </a>');
					$data['menu'] = menu($this->_menu());
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$data['title'] = 'deplacer un forum';
					$this->display($data);
				}
			} else {

				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['render'] = 'move forum';
				$data['logo'] = $this->logo();
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
		 */
		public function select_ord_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'ordre des forums';
			$data['render'] = 'select ord forum';
			$data['logo'] = $this->logo();
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
			$data['title'] = 'editer ordre forum';
			$data['logo'] = $this->logo();
			$query = $this->admin_model->get_ord_forum();
			foreach ($query->result_array() as $data1) {
				$ordre = (int) $this->input->post($data1['forum_id']);
				if ($data1['forum_order'] != $ordre) {
					$this->admin_model->loop_ord_forum($ordre, $data1['forum_id']);
				}
			}
			$this->alert->set('alert-success', 'L\'odre des forums a été modifié avec succès.' . br(2) . '
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a>', TRUE);

			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'infos';
			$data['menu'] = menu($this->_menu());
			$this->display($data);
		}

		/**
		 * select_droit_forum select droit des forums
		 *
		 * @return void
		 */
		function select_droit_forum()
		{
			$data['menu'] = menu($this->_menu());
			$data['title'] = 'selection droit des forums';
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'select droit forum';
			$data['query'] = $this->admin_model->liste_forum();
			$this->display($data);
		}

		/**
		 * edit_droit édition droit des forums
		 *
		 * @return void
		 */
		function edit_droit()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edit droit';
			$data['logo'] = $this->logo();
			$data['title'] = 'edition droit de forum';
			$data['query'] = $this->admin_model->edit_droit_forum($this->input->post('forum'));
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$this->display($data);
		}

		/**
		 * edited_droit droits edités de forum
		 *
		 * @return void
		 */
		public function edited_droit()
		{
            $data['menu'] = menu($this->_menu());
			$data['logo'] = $this->logo();
			$data['title'] = 'edition droit de forum';
            $auth_view = (int) $this->input->post('forum_auth_view');
			$auth_post = (int) $this->input->post('forum_auth_post');
			$auth_topic = (int) $this->input->post('forum_auth_topic');
			$auth_annonce = (int) $this->input->post('forum_auth_annonce');
			$auth_modo = (int) $this->input->post('forum_auth_modo');
			$forum = (int) $this->input->post('forum_id');
			$array = array(
				'forum_auth_view' => $auth_view,
				'forum_auth_post' => $auth_post,
				'forum_auth_topic' => $auth_topic,
				'forum_auth_annonce' => $auth_annonce,
				'forum_auth_modo' => $auth_modo
			);
			if ($this->admin_model->update_droit_forum($forum, $array)) {
				$this->alert->set('alert-success', 'Les droits sur le forum ont été modifiés avec succès.' . br(2) . '
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_droit_forum/' . $this->idM) . '">Droit forum?</a>', TRUE);

				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$data['logo'] = $this->logo();
				$data['title'] = 'edition droit des forums';
				$data['menu'] = menu($this->_menu());
				$this->display($data);
			} else {
				$this->alert->set('alert-danger', 'On n\'a pas pu modifier les droits du forum.<br>

				  Veuillez signaler ce problème à l\'équipe du forum fabb ' . br(2) . '
					  <a class="btn btn-success btn-sm" href="' . base_url('contact') . '">Contactez fabb</a> |
					  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> ', TRUE);

				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$data['logo'] = $this->logo();
				$data['title'] = 'edition droit des forums';
				$data['menu'] = menu($this->_menu());
				$this->display($data);
			}
		}

		/**
		 * delete_forum supprimer un forum
		 *
		 * @return void
		 */
		public function delete_forum()
		{
			if ($this->input->post('forum')) {
				$forum_id = $this->input->post('forum');
				$forum_name = $this->admin_model->selected_forum($forum_id);
				foreach ($forum_name->result() as $val) :
					$forum_name = $val->forum_name;
				endforeach;
				$this->alert->set('alert-danger', 'Veuillez confirmer la suppression du forum : ' . $forum_name . '<br>
				Tous les topic et post qui lui sont associé seront supprimés. Cette action est irréversible.' . br(2) . '
				<a class="btn btn-danger" href="' . base_url('admin/delete_forum/' . $this->idM . '/1/' . $forum_id) . '"> Supprimer </a> &nbsp;&nbsp; <a class="btn btn-success" href="' . base_url('admin/index/' . $this->idM) . '">Annuller</a> ', true);
				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$data['logo'] = $this->logo();
				$data['menu'] = menu($this->_menu());
				$data['title'] = 'suppression de forum';
				$this->display($data);
			} elseif ($this->uri->segment(4) == '1') {
				$forum_id = (int) $this->uri->segment(5);
				$this->admin_model->update_nbr_msg_members($forum_id);
				if ($this->admin_model->delete_forum($forum_id)) {
					$this->alert->set('alert-success', 'Le forum est supprimé avec succes.<br><br>
		            <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a>&nbsp;&nbsp;
		            | ' . nbs(2) . '
		            <a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Retour forum</a> |
		            <a class="btn btn-success btn-sm" href="' . base_url('admin/delete_forum/' . $this->idM) . '">Autre supression?</a> ', true);
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$data['title'] = 'suppression de forum';
					$data['menu'] = menu($this->_menu());
					$this->display($data);
				} else {
					    $this->alert->set('alert-danger', 'Un problème est survenu lors de la suppression du forum.
						Veuillez signaler ce problème à l\'équipe du forum fabb ' . br(2) . '
					    <a class="btn btn-success btn-sm" href="' . base_url('contact') . '">Contactez fabb</a> |
					    <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> ', TRUE);
				}
			} else {
				$data['render'] = 'delete forum';
				$data['menu'] = menu($this->_menu());
				$data['logo'] = $this->logo();
				$data['title'] = 'suppression de forum';
				$data['query'] = $this->admin_model->liste_forum();
				$data['pic'] = $this->top_pic();
				$this->display($data);
			}
		}

		/**
		 * consulter_topic consulter tout les topics
		 *
		 * @return void
		 */
		public function consulter_topic()
		{
			$data['menu'] = menu($this->_menu());
			$data['logo'] = $this->logo();
			$data['title'] = 'consulter les topic';
			$this->load->library('pagination');
			$config['base_url'] = base_url('admin/consulter_topic/' . $this->idM . '/');
			$config['total_rows'] = $this->db->count_all_results('fabb_topic');
			$config['per_page'] = $this->config_model->acp_topic_page();
			$config['num_links'] = 2;
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
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
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
			$data['logo'] = $this->logo();
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
			$data['logo'] = $this->logo();
			$data['render'] = 'edit topic';
			$this->form_validation->set_rules('message', 'Message', 'required|min_length[3]|max_length[3000]');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				$message = $this->input->post('message');
				$this->admin_model->update_edit_post($message, $post_id);
				$this->admin_model->update_topic_vu($topic);
				$this->alert->set('alert-success', 'Le post a été édité avec succes.<br><br>
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
				<a class="btn btn-success btn-sm" href="' . base_url('admin/consulter_topic/' . $this->idM) . '">Autre édition?</a>
				');
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
			$data['logo'] = $this->logo();
			$check_t = $this->admin_model->check_createur_topic($topic);
			foreach ($check_t->result() as $val) {
				$titre = $val->topic_title;
				$topic = $val->topic_id;
			}
			$this->alert->set('alert-danger', '<p>Êtes vous certains de vouloir supprimer le topic :<span style="color:#0002E1;"> ' . $titre . '</span> ?<br>
		  Le topic peut contenir plusieurs post, cette action est irréversible. Toutes les données du topic seront perdues
		  </p>
		  <p><a class="btn btn-danger btn-sm" href="' . base_url('admin/deleted_topic/' . $this->idM . '/' . $topic) . '">Supprimer</a>' . nbs(3) . '|' . nbs(3) . '<a class="btn btn-success btn-sm" href="' . base_url('admin/consulter_topic/' . $this->idM) . '">Annuler</a></p>', TRUE);
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
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			$topic = (int) $this->uri->segment(4);
			$createur = $this->admin_model->check_createur_topic($topic);
			foreach ($createur->result() as $val) {
				$topic_createur = $val->topic_owner;
			}
			if ($this->admin_model->del_topic($topic) > 0) {
				$this->alert->set('alert-success', '<p>Le topic ainsi tous les post qui lui sont associés est suprimé avec succes.
		       </p>
		       <br><br>
		       <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		       <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a> |
		       <a class="btn btn-success btn-sm" href="' . base_url('admin/consulter_topic/' . $this->idM) . '">Page Précédente</a></p>', TRUE);
				$data['render'] = 'infos';
				$this->display($data);
			} else {
				     $this->alert->set('alert-danger', '<p>Nous somme désolés, le topic n\'est pas supprimé correctement, qulque chose aurait d&ucirc; perturber l\'éxécution normale du script.<br>
		             vous etes invité à contacter l\'équipe du forum fabb .</p>' . br(2) . ' <p>
		             <a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Forum</a> |
		             <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
		             <a class="btn btn-success btn-sm" href="' . base_url('admin/consulter_topic/' . $this->idM) . '">Retour</a> |
		             <a class="btn btn-success btn-sm" href="https: </p>', TRUE);
				     $data['render'] = 'infos';
				     $this->display($data);
			}
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
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->unlock_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' a été redu légitime avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a></p>', TRUE);
				$this->display($data);
				return;
			} else {

				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le statut du bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été changé.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('contact') . '">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);

				$this->display($data);
				return;
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
			$data['logo'] = $this->logo();
			$data['render'] = 'list members';
			$data['memberlist'] = 'active';
			$data['pic'] = $this->top_pic();
			$data['title'] = 'liste des membres';
			$limit = $this->input->post('limit') ? $this->input->post('limit') : $this->config_model->member_par_page();
			$config['base_url'] = base_url('admin/members_list/' . $this->idM . '/');
			$config['total_rows'] = $this->db->count_all_results('fabb_members');
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
			$data['logo'] = $this->logo();
			switch ($this->uri->segment(4)) {
				case 'profil':
					$data['title'] = 'consulter/editer un membre';
					$data['form_action'] = 'admin/profil_member/' . $this->idM;
					$data['bread'] = '<strong>:: consulter</strong>';
					break;
				case 'droit':
					$data['title'] = 'consulter/editer droit membre';
					$data['form_action'] = 'admin/droit_member/' . $this->idM;
					$data['bread'] = '<strong>:: droit </strong>';
					break;
				case 'bann':
					$data['title'] = 'bannir un membre';
					$data['form_action'] = 'admin/bann_member/' . $this->idM;
					$data['bread'] = '<strong>:: bannir </strong>';
					break;
				case 'mail':
					$data['title'] = 'envoyer email à un membre';
					$data['form_action'] = 'admin/simple_mail/' . $this->idM;
					$data['bread'] = '<strong>:: mail </strong>';
					break;
				case 'avatar':
					$data['title'] = 'mise à jour de l\'avatr d\'un membre';
					$data['form_action'] = 'admin/update_avatar/' . $this->idM;
					$data['bread'] = '<strong>:: avatar </strong>';
					break;
				case 'delete':
					$data['title'] = 'supprimer un membre';
					$data['form_action'] = 'admin/delete_member/' . $this->idM;
					$data['bread'] = '<strong>:: delete </strong>';
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
			$data['logo'] = $this->logo();
			$data['render'] = 'infos';
			$data['title'] = 'profil de membre';
			if (!$this->input->post('membre')) {
				$this->alert->set('alert-danger', 'Pour consulter le profil d\'un membre, vous devez introduire son pseudo.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/profil') . '"> Ressayer </a>');
				$data['bread'] = '<strong>:: consulter</strong>';
				$this->display($data);
			} elseif ($this->input->post('membre', true)) {
				$query = $this->admin_model->select_member($this->input->post('membre', true));
				if ($query->num_rows() > 0) {
					$data['query'] = &$query;
					$data['render'] = 'profil member';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Le membre::<strong style="color:red"> ' . $this->input->post('membre') . '</strong> n\'éxiste pas dans la base de donnée.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/profil') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}

		/**
		 * droit_member editer droit membre
		 *
		 * @return void
		 */
		public function droit_member()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'droit member';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour mettre à jour le niveau d\'un membre,
			   vous devez introduire son pseudo.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/droit') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$data['menu'] = menu($this->_menu());
					$data['pic'] = $this->top_pic();
					$this->display($data);
				} elseif ($this->input->post('membre')) {
					$query = $this->admin_model->select_member($this->input->post('membre'));
					if ($query->num_rows() == 0) {
						$this->alert->set('alert-danger', 'Le membre: <strong>' . $this->input->post('membre') . '
			</strong> n\'éxiste pas dans la base de
			donnée.<br><br>
			<a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			<a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/droit') . '"> Ressayer </a>');
						$data['render'] = 'infos';
						$this->display($data);
					} else {
						$membre = $this->input->post('membre');
						$data['render'] = 'droit member';
						$data['logo'] = $this->logo();
						$data['menu'] = menu($this->_menu());
						$membre = $this->input->post('membre');
						$data['pic'] = $this->top_pic();
						$data['query'] = $this->admin_model->select_member($membre);
						$this->display($data);
					}
				}
			} elseif ($this->input->post('envoyer')) {
				$membre = $this->input->post('member');
				$data['query'] = $this->admin_model->select_member($membre);
				$rang = (int) $this->input->post('droit');
				if ($rang == VISITOR) {
					$data['error'] = 'Veuillez ne pas selrctionner sans niveau ';
					$data['member'] = $this->input->post('member');
					$data['render'] = 'droit member';
					$data['menu'] = menu($this->_menu());
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				}
				$this->admin_model->update_droit_member($rang, $membre);
				$this->alert->set('alert-success', 'La mise à jour du niveau du membre: ' . $membre . ' a été modifié avec succès.<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
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
			$data['logo'] = $this->logo();
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour bannir un membre, vous devez introduire son pseudo<br><br>
		   <a class="btn btn-danger btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/bann') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['title'] = 'bannir un membre';
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				} elseif ($this->admin_model->check_bann_name($this->input->post('membre'))) {
					if ($this->admin_model->bann_member($this->input->post('membre')) > 0) {
						$this->alert->set('alert-success', 'Le membre: ' . $this->input->post('membre') . ' a été
						   banni avec succès.<br><br>
						   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
						   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$data['pic'] = $this->top_pic();
						$data['logo'] = $this->logo();
						$data['title'] = 'bannir un membre';
						$this->display($data);
					} else {

						$this->alert->set('alert-danger', 'La mise à niveau du: ' . $this->input->post('membre') . ' n\'a pas
						  réussie. Si le problème persiste, veuillez contacter l\'équipe fabb.' . br(2) .
							safe_mailto($this->config_model->admin_contact(), 'contact', 'class="btn btn-success btn-sm"') . '
						  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
						   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$data['logo'] = $this->logo();
						$data['title'] = 'bannir un membre';
						$this->display($data);
					}
				} else {
					$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans
						la base de donnée.<br><br>
		   <a class="btn btn-danger btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/bann') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$data['title'] = 'bannir un membre';
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
			$data['active'] = $this->admin_model->active_smtp();
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'mail member';
			$data['logo'] = $this->logo();
			$this->form_validation->set_rules('objet', 'Objet', 'required|max_length[256]');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['active'] = $this->admin_model->active_smtp();
				$data['membre_email'] = $this->input->post('member_email');
				$data['membre_pseudo'] = $this->input->post('member_pseudo');
				$this->display($data);
			} else {
				$this->load->model('smtp_model');
				$this->load->library('phpmailer_lib');
				$mail = $this->phpmailer_lib->load();
				if ($this->smtp_model->active() == true) {
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
					$this->alert->set('alert-success', 'Le message envoyé à ' . $this->input->post('to') . ' a été envoyé avec succes.
			 <br><br>
					 <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/mail') . '">Envoyer autre message </a> |
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['pic'] = $this->top_pic();
					$data['render'] = 'infos';
					$data['logo'] = $this->logo();
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Le message envoyé à ' . $this->input->post('to') . ' a échoué.<br>
	   Veuillez ressayer ultérieurement.<br>
	  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/mail') . '">Ressayer </a> |
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				}
			}
		}

		/**
		 * simple_mail send simple email to  member
		 *
		 * @return void
		 */
		public function simple_mail()
		{
			$data['active'] = $this->admin_model->active_smtp();
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['title'] = 'mail member';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Veuillez renseigner le pseudo du membre que vous voulez lui envoyer le message.
				   <br><br>
		   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/mail') . '"> Ressayer </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} elseif ($this->admin_model->select_member($this->input->post('membre'))->num_rows() == FALSE) {
					$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans
					la base de donnée.<br><br>
					 <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/mail') . '"> Ressayer </a> |
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$data['active'] = $this->admin_model->active_smtp();
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
		 * update_avatar update member s avatar
		 *
		 * @return void
		 */
		function update_avatar()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['title'] = 'mise à jour avatar membre';
			if ($this->input->post('submit')) {
				if (!$this->input->post('membre')) {
					$this->alert->set('alert-danger', 'Pour mettre à jour l\'avatar d\'un membre,
			   vous devez introduire son pseudo.<br><br>
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/avatar') . '"> Ressayer </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
				if ($this->input->post('membre')) {
					$query = $this->admin_model->select_member($this->input->post('membre'));
					if ($query->num_rows() == 0) {
						$this->alert->set('alert-danger', 'Le membre: ' . $this->input->post('membre') . ' n\'éxiste pas dans la base de
				  donnée.<br><br>
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Retour Forum </a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/avatar/') . '"> Ressayer </a>');
						$data['render'] = 'infos';
						$this->display($data);
					} else {
						foreach ($query->result() as $val) :
							$data['avatar'] = $val->member_avatar;
							$data['pseudo'] = $val->member_pseudo;
							$data['id'] = $val->member_id;
						endforeach;
						$data['render'] = 'update avatar';
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
						 <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
						 <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/avatar') . '"> Ressayer </a>');
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
							'member_avatar' => $fileNewName . '.' . $ext);
						if ($this->admin_model->update_profil_memeber($val->member_id, $data) > 0) {
							$this->session->set_userdata('avatar', $fileNewName . '.' . $ext);
							$data['menu'] = menu($this->_menu());
							$data['pic'] = $this->top_pic();
							$data['logo'] = $this->logo();
							$data['title'] = 'mise à jour avatar membre';
							$this->alert->set('alert-success', ' L\'avatar de ' . $val->member_pseudo . '
								 a été mis à jour avec succes.<br><br>
								   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
						  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/avatar') . '"> Autre Update </a>');
							$data['render'] = 'infos';
							$this->display($data);
						} else {
							$data['menu'] = menu($this->_menu());
							$this->alert->set('alert-danger', 'La mise à jour de l\'avatar de: ' . $val->member_pseudo . ' n\'a pas réussie. Si le problème persiste, veuillez contacter l\'équipe <a href="https:
									<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
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
				$this->display($data);
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
			$data['form_action'] = 'admin/delete_member/' . $this->idM;
			$data['bread'] = '<strong> :: Supprimer un membre </strong>';
			$data['menu'] = menu($this->_menu());
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			$data['render'] = 'select member';
			$data['title'] = 'supprimer un membre';
			$this->display($data);
			} 
			
			if ($this->uri->segment(4) != FALSE) {
				$pseudo = $this->uri->segment(4);
				$data['menu'] = menu($this->_menu());
				$data['logo'] = $this->logo();
				$data['pic'] = $this->top_pic();
				$data['render'] = 'infos';
				$this->alert->set('alert-danger', '<p style="color:red !important;font-size:18px;">
			  Votre attention svp  ' . $this->pseudo . '....!</p>
			  <p>Vous &ecirc;tes sur le point de supprimer le compte de :
			  <span style="color:red;">' . $pseudo . '</span>.' . br(2) . '
			  <a class="btn btn-danger btn-sm" href="' . base_url('admin/delete_pseudo/' . $this->idM . '/' . rawurlencode($pseudo)) . '">Supprimer</a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Annuler</a>', TRUE);
				$this->display($data);
			} else {
				$pseudo = $this->input->post('membre');
				$data['menu'] = menu($this->_menu());
				$data['logo'] = $this->logo();
				$data['pic'] = $this->top_pic();
				$data['title'] = 'supprimer un membre';
				$data['render'] = 'infos';
				$this->alert->set('alert-danger', '<p style="color:red !important;font-size:18px;">
			   On n\'a pas pu analyser le pseudo du membre à supprimer, veuillez ressayer svp.' . br(2) . '
			  <a class="btn btn-danger btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/delete').'">Ressayer</a> |
			  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Annuler</a>', TRUE);
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
		$pseudo=$this->input->post('membre');
		$query=$this->member_model->isDeleted_pseudo($pseudo);
		if (!$pseudo) {
				$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">Veuillez renseigner un pseudo svp...!</span>');
				return false;
			} 
			elseif($query->num_rows()==0){
			$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">Le membre ::
		  <strong>' . $pseudo . '</strong> n\'éxiste pas dans la base de donnée.</span>');
				return false;
				}
			
			
			else{
		  foreach($query->result() as $val):
		  $level=$val->member_level;
		  endforeach;
		   if($level==DELETED)
		   {
				$this->form_validation->set_message('is_member', '<span style="color:red;font-size:11px;">
		  Le compte du membre :: ' . $pseudo . ' est déjà supprimé. Cette action n\'est pas nécéssaire.');
		  					return false;
				
             }
					else{
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
			$data['logo'] = $this->logo();
			$data['title'] = 'supprimer un membre';
			$pseudo = rawurldecode($this->uri->segment(4));
			if ($this->member_model->del_by_pseudo($pseudo) > 0) {
				$this->alert->set('alert-success', '<p>Le compte de ' . $pseudo . ' est supprimé avec succès.' . br(2) . '
				  <a class="btn btn-danger btn-sm" href="' . base_url('admin/delete_member/' . $this->idM) . '">Autre suppression?</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Forum</a>', TRUE);
				$this->display($data);
			} else {
				if ($this->member_model->isDeleted_pseudo($pseudo) == true) {
					$this->alert->set('alert-success', '<p>Le compte de ' . $pseudo . ' est déjà supprimé. Cet action n\'est pas
				   nécéssaire.' . br(2) . '
				  <a class="btn btn-danger btn-sm" href="' . base_url('admin/delete_member/' . $this->idM) . '">Autre suppression?</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Forum</a>', TRUE);
					$this->display($data);
				}
				$this->alert->set('alert-warning', '<p>
			  Nous sommes désolé le compte de ' . $pseudo . ' n\' pas été supprimé, si le problème perssiste veuillez
			   contacter l\'équipe du forum-fabb pour signaler cet inconvénient.' . br(2) . '
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
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
			$data['logo'] = $this->logo();
			$data['title'] = 'liste des membres bannis';
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->get_bann_member();
			$this->display($data);
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
			$data['logo'] = $this->logo();
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
			$data['logo'] = $this->logo();
			$data['title'] = 'ajouter mot vulgaire';
			$data['pic'] = $this->top_pic();
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
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/add_badwords/' . $this->idM) . '">Ajouter autre mot </a> |						  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
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
			$data['logo'] = $this->logo();
			$data['title'] = 'gerer mots vulgaires';
			$data['pic'] = $this->top_pic();
			if ($this->input->post('ajouter')) {
				$this->add_badwords();
			}
			$page = $this->uri->segment(4, 0);
			$limit = $this->input->post('limit') ? $this->input->post('limit') : $this->config_model->badword_par_page();
			$config['base_url'] = base_url('admin/badwords/' . $this->idM . '/');
			$config['total_rows'] = $this->db->count_all_results('fabb_badwords');
			$config['per_page'] = $this->config_model->badword_par_page();
			$config['num_links'] = 3;
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
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/badwords/' . $this->idM) . '"> Bad words </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Veuillez selectionner au moins un mot SVP ...!<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/badwords/' . $this->idM) . '"> Ressayer </a> |								<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
			$this->display($data);
		}

		/**
		 * add_smtp create smtp method
		 *
		 * @return void
		 */
		public function add_smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'ajouter smtp';
			$data['logo'] = $this->logo();
			$data['title'] = 'ajouter smtp';
			$data['pic'] = $this->top_pic();
			$this->form_validation->set_rules('name', 'Smtp Titre', 'required|is_unique[fabb_smtp.smtp_name]');
			$this->form_validation->set_rules('host', 'Smtp Host', 'required');
			$this->form_validation->set_rules('port', 'Smtp Port', 'required|is_numeric');
			$this->form_validation->set_rules('user', 'Smtp User', 'required');
			$this->form_validation->set_rules('psw', 'Smtp Password', 'required');
			$this->form_validation->set_rules('crypt', 'Smtp Crypto', 'required');
			$this->form_validation->set_rules('mailtype', 'Smtp MailType', 'required');
			$this->form_validation->set_rules('charset', 'Smtp Charset', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				$insert = array(
					'smtp_name' => $this->input->post('name'),
					'smtp_host' => $this->input->post('host'),
					'smtp_psw' => $this->input->post('psw'),
					'smtp_port' => $this->input->post('port'),
					'smtp_user' => $this->input->post('user'),
					'smtp_crypt' => $this->input->post('crypt'),
					'smtp_charset' => $this->input->post('charset'),
					'smtp_mailtype' => $this->input->post('mailtype'),
					'smtp_active' => 1
				);
				if ($this->admin_model->insert_smtp($insert) > 0) {
					$this->alert->set('alert-success', '<p>Vos information de connexion smtp se sont enregistrés avec succes.</p>
		  <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>Vos information de connexion smtp n\ont pas pu &ecirc;tre enregistrés.</p>
		  <p>Veuillez ressayer ultérieurement. Si le problème persiste, veuillez contacter l\équipe fabb .</p>
		  <p><a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}

		/**
		 * select_smtp edit smtp
		 *
		 * @return void
		 */
		public function select_smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'select smtp';
			$data['logo'] = $this->logo();
			$data['title'] = 'selection smtp';
			$data['pic'] = $this->top_pic();
			$data['query'] = $this->admin_model->smtp();
			$this->display($data);
		}

		/**
		 * edit_smtp edit your smtp
		 *
		 * @return void
		 */
		public function edit_smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edit smtp';
			$data['logo'] = $this->logo();
			$data['title'] = 'editer smtp';
			$data['pic'] = $this->top_pic();
			$smtp = $this->input->post('smtp_id');
			$data['query'] = $this->admin_model->get_smtp($smtp);
			$this->display($data);
		}

		/**
		 * active_smtp chechs if smtp is active
		 *
		 * @return void
		 */
		public function active_smtp()
		{
			$this->load->model('smtp_model');
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'avtive smtp';
			$data['title'] = 'avtive smtp';
			$data['smtp'] = $this->admin_model->smtp();
			$data['active'] = $this->admin_model->active_smtp();
			$this->form_validation->set_rules('choix', 'Active smtp', 'required|callback_check_choix');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				if ($this->input->post('choix') == 0) {
					$this->admin_model->reset_smtp();
					$this->alert->set('alert-success', ' <p>Toutes les connexions  smtp sont désactivées, la fonction sendMail sera utilisée lors de l\'envoi de vos méssage.
					' . br(2) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				} else {
					$this->admin_model->reset_smtp();
					if ($this->admin_model->update_choix($this->input->post('choix')) > 0) {
						$this->alert->set('alert-success', ' <p>Votre choix smtp est enregistré avec succès.
					' . br(2) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$data['pic'] = $this->top_pic();
						$data['logo'] = $this->logo();
						$this->display($data);
					} else {
						$this->alert->set('alert-danger', 'La modification de l\'état de votre smtp a échoué, veuillez ressayer ultérieurement.' . br(2) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$data['pic'] = $this->top_pic();
						$data['logo'] = $this->logo();
						$this->display($data);
					}
				}
				$this->display($data);
			}
		}

		/**
		 * test_email sending email test
		 *
		 * @return void
		 */
		public function test_email()
		{
			$this->load->model('smtp_model');
			$data['smtp_name'] = $this->smtp_model->namesmtp();
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'tester email';
			$data['logo'] = $this->logo();
			$data['title'] = 'tester email';
			$data['pic'] = $this->top_pic();
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				$this->load->library('phpmailer_lib');
				$mail = $this->phpmailer_lib->load();
				if ($this->smtp_model->active() == 1) {
					$mail->isSMTP();
					$mail->Host     = $this->smtp_model->hostsmtp();
					$mail->SMTPAuth = true;
					$mail->Username = $this->smtp_model->usersmtp();
					$mail->Password = $this->smtp_model->pswsmtp();
					$mail->SMTPSecure = $this->smtp_model->cryptsmtp();
					$mail->Port     = $this->smtp_model->portsmtp();
				} else {
					$mail->isMail();
				}
				$mail->setFrom($this->config_model->admin_contact(), $this->config_model->title_forum());
				$mail->addReplyTo($this->config_model->admin_contact(), 'No-reply');
				$mail->AddAddress($this->input->post('to'));
				$mail->Subject = $this->input->post('objet');
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
					$this->alert->set('alert-success', 'Le message envoyé à ' . $this->input->post('to') . ' a été envoyé avec succes.' . br(2) . '
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', 'Le message envoyé à ' . $this->input->post('to') . ' a échoué.<br>
	   Si le probleme perssiste, veuillez contacter l\'équipe du forum-fabb' . br(2) . '
	  <a class="btn btn-success btn-sm" href=""https:
	  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
	  <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
					$data['render'] = 'infos';
					$data['pic'] = $this->top_pic();
					$data['logo'] = $this->logo();
					$this->display($data);
				}



			}
		}

		/**
		 * masse_mail send bulk email
		 *
		 * @return void
		 */
		public function masse_mail()
		{
			if ($this->input->post('Envoyer_mail')) {
				if (!$this->input->post('mailto')) {
					$data['menu'] = menu($this->_menu());
					$data['pic'] = $this->top_pic();
					$data['render'] = 'masse mail';
					$data['logo'] = $this->logo();
					$data['title'] = 'masse mail';
					$data['bread'] = 'Email en masse';
					$data['error'] = 'Il faut selectionner au moins une adresse email, ou bien utilisez <strong>"Envoi simple"</strong> pour envoyer un message pour un seul membre.';
					$data['query'] = $this->member_model->get_all_users();
					$this->display($data);
				}

				$data['to'] = $this->input->post('mailto');
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'mail members';
				$this->display($data);
			} elseif ($this->input->post('masse_mails')) {
				$mail = array();
				$dest = $this->input->post('to');
				$to = explode(',', $dest);
				foreach ($to as $addr) {
					$mail[] = $addr . ',';
				}
				$data['to'] = $mail;
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'mail members';
				$this->form_validation->set_rules('to', 'TO');
				$this->form_validation->set_rules('from', 'From', 'required');
				$this->form_validation->set_rules('objet', 'Objet', 'required');
				$this->form_validation->set_rules('message', 'Message', 'required');
				if ($this->form_validation->run() == FALSE) {
					$this->display($data);
				} else {
					$to = $this->input->post('to');
					$objet = $this->input->post('objet');
					$message = $this->input->post('message');
					$this->load->model('smtp_model');
					$this->load->library('phpmailer_lib');
					$mail = $this->phpmailer_lib->load();
					if ($this->smtp_model->active() == true) {
						$mail->isSMTP();
						$mail->Host     = $this->smtp_model->hostsmtp();
						$mail->SMTPAuth = true;
						$mail->Username = $this->smtp_model->usersmtp();
						$mail->Password = $this->smtp_model->pswsmtp();
						$mail->SMTPSecure = $this->smtp_model->cryptsmtp();
						$mail->Port     = $this->smtp_model->portsmtp();
					}
					$mail->CharSet = 'UTF-8';
					$mail->isHTML(true);
					$content = $this->input->post('message');
					$this->load->add_package_path(APPPATH . 'third_party/resources', FALSE);
					$mail->Subject = $this->input->post('objet');
					$htmlBody = $this->load->view('htmlHeader', $data, true);
					$htmlBody .= $content;
					$htmlBody .= $this->load->view('htmlFooter', $data, true);
					$this->load->remove_package_path(APPPATH . 'third_party/resources');
					$mail->setFrom($this->config_model->admin_contact(), $this->config_model->title_forum());
					$mail->addReplyTo($this->config_model->admin_contact(), 'No-reply');
					$mail->Body = $htmlBody;
					$mail->AltBody = $content;
					$mail->SMTPKeepAlive = true;
					$destina = explode(',', $this->input->post('to'));
					$i = 0;
					foreach ($destina as $address) {
						$mail->addAddress($address);
						$mail->send();
						$mail->clearAddresses();
						$i++;
					}
					if ($i < sizeof($destina)) {
						$this->alert->set('alert-danger', 'Vos méssages ou certains de vos méssage n\'ont pas été envoyé correctement, il aurait d&ucirc; passé les problèmes suivants :: ' . br(2) .
							$mail->ErrorInfo . br(1) . '
					<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
					 <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$this->display($data);
					} else {
						$this->alert->set('alert-success', 'Vos méssages ont été envoyé correctement.' . br(2) .
							'<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
			   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
						$data['render'] = 'infos';
						$this->display($data);
					}
					$mail->smtpClose();
				}
			}
			else {
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['render'] = 'masse mail';
				$data['logo'] = $this->logo();
				$data['title'] = 'masse mail';
				$data['bread'] = 'Email en masse';
				$data['query'] = $this->member_model->get_all_users();
				$this->display($data);
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
			$data['logo'] = $this->logo();
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
			$data['logo'] = $this->logo();
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
	    public function delete_report(){
			$data['menu']=menu($this->_menu());
			$data['logo'] = $this->logo();
			$data['pic']=$this->top_pic();
			$data['render']='infos';
			$id_mess=$this->uri->segment(4);
	        if($this->uri->segment(5)==='msg'){
		    $this->alert->set('alert-warning','<p>Attention : Vous voulez vraiment supprimer ce méssage..!</p>'.br(2).'
		    <a class="btn btn-danger btn-sm" href="'.base_url('delete/abus/'.$this->idM.'/'.$id_mess.'/1').'">Supprimer</a> | 
			<a class="btn btn-success btn-sm" href="'.base_url('admin/index/'.$this->idM).'">Annuler</a> ',TRUE);
		    $this->display($data);
	        }
			elseif ($this->uri->segment(5)=='1')
		    {
			$id_mess=$this->uri->segment(4);
		    $this->load->model('contact_model');
		    $resp= $this->contact_model->del_report($id_mess);
			if($resp>0){
			$this->alert->set('alert-success','<p>Le message a été supprimé avec succes..!<br></p>
			<p><a class="btn btn-success btn-sm" href="'.base_url('admin/index/'.$this->idM).'">Retour</a></p>',TRUE);
            $this->display($data);
			}else {
			$this->alert->set('alert-danger','<p>le méssage n\'est pas supprimé correctement.<br><br>
			Si le problème perssite, veuillez contacter l\'équipe ::
			<a class="btn btn-success btn-sm" href="https://www.forum-fabb.com/forum/contact"> fabb</a></p>',TRUE);
            $this->display($data);
			}
	        }
        }

		/**
		 * page must be a valid selection
		 *
		 * @return void
		 */
		public function page()
		{
			if (!$this->input->post('page') || $this->input->post('page') == 'choisir') {
				$this->form_validation->set_message('page', '<span style=" font-size:11px;color:red;">Le champ %s est obligatoire
			 </span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}		
         /**
		 * pub add ads to forum
		 *
		 * @return void
		 */
		public function pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'pub';
			$data['title'] = 'ajouter une pub';
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: Monétisation </strong>';
			$this->form_validation->set_rules('title', 'Titre de Pub', 'required|trim|strtolower|max_length[64]');
			$this->form_validation->set_rules('format', 'Format de pub', 'required|trim|strtolower|callback_format');
			$this->form_validation->set_rules('position', 'Position', 'required|trim|strtolower|callback_position');
			$this->form_validation->set_rules('page', 'Page de destination', 'required|trim|strtolower|callback_page');
			$this->form_validation->set_rules('code', 'code Html', 'required|trim|strtolower');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				//$selectpage=array('index','forum','topic');
				$title = $this->input->post('title');
				$format = $this->input->post('format');
				$position = $this->input->post('position');
				$page = $this->input->post('page');
				$code = $this->input->post('code');
				$occ = 'frame';
				if (preg_match("#{$occ}#i", $code)) {
					$data['render'] = 'infos';
					$this->alert->set('alert-danger', '<p>votre publicité utilise les frame, ce type de publicité n\'est pas autorisé sur le forum. ' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/pub/' . $this->idM) . '">Ressayer autre code</a> </p>', TRUE);
					$this->display($data);
					return;
				}
				$posi = strpos($code, '>', 0);
				$pos2 = strpos($code, '>', $posi + 1);
				$code = strtolower(substr_replace($code, ' class="img-responsive center-block"', $pos2, 0));
				$array = array(
					'add_page' => $page,
					'add_position' => $position,
					'add_title' => $title,
					'add_code' => $code,
					'add_format' => $format,
					'add_date' => time(),
					'add_stat' => '1',
				);
				if ($this->admin_model->insert_adds($array) == true) {
					$data['render'] = 'infos';
					$this->alert->set('alert-success', '<p>votre publicité a été ajoué avec succès. ' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/pub/' . $this->idM) . '">Autre pub?</a> </p>', TRUE);
					$this->display($data);
					return;
				} else {
				}
			}
		}

		/**
		 * gerer_pub edit ads
		 *
		 * @return void
		 */
		public function gerer_pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['render'] = 'gerer pub';
			$data['title'] = 'gerer pub';
			$data['bread'] = ' <strong>:: Gerer la pub </strong>';
			$data['gererpub'] = $this->admin_model->gerer_adds();
			$this->display($data);
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
			$data['logo'] = $this->logo();
			$data['title'] = 'gerer robots';
			if ($this->admin_model->ip_admin($this->ip) == true) {
				$data['free'] = true;
			}
			$data['bread'] = ' <strong>:: Gerer les spiders </strong>';
			$data['bots'] = $this->admin_model->gerer_bots();
			$this->display($data);
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
			$data['logo'] = $this->logo();
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
				'blink' => 'admin',
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
			$this->load->view('admin/index', $data);
			$this->load->view('inc/footer', $data);
		}

		/**
		 * top_pic render forum image
		 *
		 * @return void
		 */
		public function top_pic()
		{
			$photo = $this->admin_model->get_pics();
			foreach ($photo->result() as $row) :
				$pic = $row->pic_file;
			endforeach;
			return $pic;
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
		 * update_member function to update data members
		 *
		 * @return void
		 */
		public function update_member()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
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
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
				 <a class="btn btn-success btn-sm" href="' . base_url('admin/select_member/' . $this->idM . '/profil') . '"> Autre Update </a>');
						$data['pic'] = $this->top_pic();
						$data['render'] = 'infos';
						$data['logo'] = $this->logo();
						$this->display($data);
						return;
					} else {
						$data['menu'] = menu($this->_menu());
						$this->alert->set('alert-danger', 'Les information du membre: ' . $pseudo . ' n\'ont pas été mis à jour. Si le problème persiste, veuillez contacter l\'équipe <a href="">forum fabb</a><br><br>
				<a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> | <a class="btn btn-success btn-sm" href="' . base_url('admin/select_read_member/' . $this->idM) . '"> Page Précédente </a>');
						$data['render'] = 'infos';
						$data['logo'] = $this->logo();
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
		 * debann re-activate member
		 *
		 * @return void
		 */
		public function debann()
		{
			$data['menu'] = menu($this->_menu());
			$data['logo'] = $this->logo();
			$data['render'] = 'debann';
           if ($this->input->post('membre_id')) {
				foreach ($this->input->post('membre_id') as $val) {
					$this->admin_model->debann_member($val);
				}
				$this->alert->set('alert-success', 'Les membres selesctionnés ont été debannis avec succès.<br><br>
		   <a class="btn btn-success btn-sm" href="' . base_url('admin/list_bann/' . $this->idM) . '"> Autre Bann </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
				$data['render'] = 'infos';
				$data['logo'] = $this->logo();
				$data['pic'] = $this->top_pic();
				$this->display($data);
			} else {

				$this->alert->set('alert-danger', 'Veuillez selectionner au moins un membre pour actionner le debanissement.<br><br>
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/list_bann/' . $this->idM) . '"> Autre Bann </a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '"> Retour Admin </a> |
		   <a class="btn btn-success btn-sm" href="' . base_url('forum') . '"> Forum </a>');
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'infos';
				$this->display($data);
			}
		}
		
		/**
		 * delete_smtp delete data smtp
		 *
		 * @return void
		 */
		public function delete_smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'infos';
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			if ($this->uri->segment(5) == 1) {
				$id = $this->uri->segment(4);
				if ($this->admin_model->delete_smtp($id)) {
					$this->alert->set('alert-success', '<p>La connexion smtp a été supprimé avec succes.</p>
		  <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>La connexion smtp n\'a pas été supprimé.</p>
		  <p>Veuillez ressayer ultérieurement. </p>
		  <p><a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$this->display($data);
				}
			} else {
				$del = $this->uri->segment(4);
				$name = rawurldecode($this->uri->segment(5));
				$this->alert->set('alert-warning', '<p>&Ecirc;tes vous certain de vouloir supprimer la connexion ' . rawurlencode($name) . '.</p>
		  <p><a class="btn btn-danger btn-sm" href="' . base_url('admin/delete_smtp/' . $this->idM . '/' . $del . '/1') . '">supprimer</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/select_smtp/' . $this->idM) . '">Annuler</a>', TRUE);
				$data['render'] = 'infos';
				$this->display($data);
			}
		}
		
		/**
		 * edited_smtp edit data smtp
		 *
		 * @return void
		 */
		public function edited_smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'edit smtp';
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			if ($this->input->post('smtp_id')) {
				$data['id'] = $this->input->post('smtp_id');
			} elseif ($this->uri->segment(4)) {
				$data['id'] = $this->uri->segment(4);
			}
			$data['query'] = $this->admin_model->get_smtp($data['id']);
			$this->form_validation->set_rules('host', 'Smtp Host', 'required');
			$this->form_validation->set_rules('port', 'Smtp Port', 'required');
			$this->form_validation->set_rules('user', 'Smtp User', 'required');
			$this->form_validation->set_rules('psw', 'Smtp Password', 'required');
			$this->form_validation->set_rules('crypt', 'Smtp Crypto', 'required');
			$this->form_validation->set_rules('mailtype', 'Smtp MailType', 'required');
			$this->form_validation->set_rules('charset', 'Smtp Charset', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['id'] = $this->input->post('smtp_id');
				$this->display($data);
			} else {
				$array = array(
					'smtp_name' => $this->input->post('name'),
					'smtp_host' => $this->input->post('host'),
					'smtp_psw' => $this->input->post('psw'),
					'smtp_port' => $this->input->post('port'),
					'smtp_user' => $this->input->post('user'),
					'smtp_crypt' => $this->input->post('crypt'),
					'smtp_charset' => $this->input->post('charset'),
					'smtp_mailtype' => $this->input->post('mailtype'),
				);
				$id = $this->input->post('smtp_id');
				if ($this->admin_model->update_smtp($id, $array) > 0) {
					$this->alert->set('alert-success', '<p>Vos information de connexion smtp se sont enregistrés avec succes.</p>
		  <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>Vos information de connexion smtp n\'ont pas pu &ecirc;tre enregistrés.</p>
		  <p>Veuillez ressayer ultérieurement.<br></p>
		  <p><a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
			}
		}
		
		/**
		 * smtp add data credentials smtp
		 *
		 * @return void
		 */
		public function smtp()
		{
			$data['menu'] = menu($this->_menu());
			$data['render'] = 'smtp';
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			if ($data['query'] = $this->admin_model->smtp()) {
				$this->display($data);
			}
			$this->form_validation->set_rules('name', 'Smtp Titre', 'required|is_unique[fabb_smtp.smtp_name]');
			$this->form_validation->set_rules('host', 'Smtp Host', 'required');
			$this->form_validation->set_rules('port', 'Smtp Port', 'required|max_length[5]');
			$this->form_validation->set_rules('user', 'Smtp User', 'required');
			$this->form_validation->set_rules('psw', 'Smtp Password', 'required');
			$this->form_validation->set_rules('crypt', 'Smtp Crypto', 'required');
			$this->form_validation->set_rules('mailtype', 'Smtp MailType', 'required');
			$this->form_validation->set_rules('charset', 'Smtp Charset', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->display($data);
			} else {
				$insert = array(
					'smtp_name' => $this->input->post('name'),
					'smtp_host' => $this->input->post('host'),
					'smtp_psw' => $this->input->post('psw'),
					'smtp_port' => $this->input->post('port'),
					'smtp_user' => $this->input->post('user'),
					'smtp_crypt' => $this->input->post('crypt'),
					'smtp_charset' => $this->input->post('charset'),
					'smtp_mailtype' => $this->input->post('mailtype'),
					'smtp_active' => 0
				);

				if ($this->admin_model->insert_smtp($insert) > 0) {
					$this->alert->set('alert-success', '<p>Vos information de connexion smtp se sont enregistrés avec succes.</p>
		  <p><a class="btn btn-success btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-success btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				} else {
					$this->alert->set('alert-danger', '<p>Vos information de connexion smtp n\ont pas pu &ecirc;tre enregistrés.</p>
		  <p>Veuillez ressayer ultérieurement. Si le problème persiste, veuillez contacter l\équipe fabb .</p>
		  <p><a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Aller au Forum</a> |
		  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Retour Admin</a>', TRUE);
					$data['render'] = 'infos';
					$this->display($data);
				}
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
			$data['logo'] = $this->logo();
			$data['pic'] = $this->top_pic();
			$data['render'] = 'mail member';
			$this->display($data);
		}

		/**
		 * check_choix select position of ads
		 *
		 * @return void
		 */
		public function check_choix()
		{
			if ($this->input->post('choix') == 'choisir') {
				$this->form_validation->set_message('check_choix', '<span style="color:red;font-size:11px;">Votre choix ne peut &ecirc;tre que Désactiver ou le nom de l\'une de vos connexions disponibles ...!</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}
		
		/**
		 * bulk_mail_check send bulk email
		 *
		 * @param  mixed $input
		 * @return void
		 */
		function bulk_mail_check($input)
		{
			$j = 0;
			$input = explode(';', $input);
			foreach ($input as $val) {
				if (filter_var(trim($val), FILTER_VALIDATE_EMAIL)) {
					$val . ' : email valide <br>';
				} else {
					$val . ' : email invalide <br>';
					$j++;
				}
			}
			if ($j > 0) {
				$this->form_validation->set_message('bulk_mail_check', '<span style="font-size:0.8em;color:red;">Le champ {field} contient des emails syntaxiquemt invalides</span>');
				return FALSE;
			} else {
				return TRUE;
			}
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
			$data['logo'] = $this->logo();
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
				'pmsg_read' => '0');
			$this->member_model->send_welcome_msg($array);
			$this->alert->set('alert-success', '<p>
			  Le message est envoyé avec succès à ' . $pseudo . ' l\'avisant sur l\'inactivité de son compte.' . br(2) . '
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/inactif/' . $this->idM) . '">Autre action?</a> |', TRUE);
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
			$data['logo'] = $this->logo();
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
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/inactif/' . $this->idM) . '">Autre action?</a> |', TRUE);
			$this->display($data);
		}
		
		/**
		 * format choose format ads
		 *
		 * @return void
		 */
		public function format()
		{
			if (!$this->input->post('format') || $this->input->post('format') == 'choisir') {
				$this->form_validation->set_message('format', '<span style=" font-size:11px;color:red;">Le champ %s est obligatoir</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}
		
		/**
		 * position choose position ads
		 *
		 * @return void
		 */
		public function position()
		{
			if (!$this->input->post('position') || $this->input->post('position') == 'choisir') {
				$this->form_validation->set_message('position', '<span style=" font-size:11px;color:red;">Le champ %s est obligatoir</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}
		
		/**
		 * delete_pub delete ads
		 *
		 * @return void
		 */
		public function delete_pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: Gerer la pub </strong>';
			$seg = $this->uri->segment_array();
			if ($seg[6] === 'confirm') {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Veuillez confirmer la suppression de la pub dont le titre:: ' . rawurldecode($seg[4]) . br(2) . '
			  <a class="btn btn-danger btn-xs" href="' . base_url('delete/pub/' . $this->idM . '/oui/' . rawurlencode($seg[5]) . '/check') . '">Supprimer</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_pub/' . $this->idM) . '">Annuler</a>  |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> </p>', TRUE);
				$this->display($data);
				return;
			} elseif ($seg[4] === 'oui') {
				$data['render'] = 'infos';
				echo $seg[5];
				if ($this->admin_model->del_add($seg[5]) > 0) {
					$data['render'] = 'infos';
					$this->alert->set('alert-success', '<p>Votre pub est supprimée avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_pub/' . $this->idM) . '">Autre suppression?</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
					$this->display($data);
					return;
				} else {
					$data['render'] = 'infos';
					$this->alert->set('alert-warning', '<p>Désolé, votre pub n\'a pas été supprimée.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si le problème persiste veuillez contacter l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
					$this->display($data);
					return;
				}
			}
			$this->display($data);
		}
		
		/**
		 * lock_pub give a lock to ads
		 *
		 * @return void
		 */
		public function lock_pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: Gerer la pub </strong>';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->lock_add($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Votre pub est passée au mode stand by (désactivée) avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_pub/' . $this->idM) . '">Gerer Pub</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, votre pub n\'a pas été désactivée.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);

				$this->display($data);
				return;
			}
		}
		
		/**
		 * unlock_pub unlock ads
		 *
		 * @return void
		 */
		public function unlock_pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: Gerer la pub </strong>';
			$seg = $this->uri->segment_array();
			if ($this->admin_model->unlock_add($seg[4]) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Votre pub est maintenant passée au mode activée avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_pub/' . $this->idM) . '">Gerer Pub</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, votre pub n\'a pas été activée.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			}
		}
		
		/**
		 * view_add view all ads in forum
		 *
		 * @return void
		 */
		public function view_add()
		{
			if ($this->uri->segment(4)) {
				$data['view_add'] = $this->admin_model->view_add($this->uri->segment(4));
				$this->load->view('admin/view-pub', $data);
			}
		}
		
		/**
		 * edit_pub edit ads
		 *
		 * @return void
		 */
		public function edit_pub()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'pub';
			$data['logo'] = $this->logo();
			$data['bread'] = ' <strong>:: &Eacute;diter Pub </strong>';
			if ($this->input->post('Envoyer')) {
				$this->form_validation->set_rules('title', 'Titre de Pub', 'required|trim|strtolower|max_length[64]');
				$this->form_validation->set_rules('format', 'Format de pub', 'required|trim|strtolower|callback_format');
				$this->form_validation->set_rules('position', 'Position', 'required|trim|strtolower|callback_position');
				$this->form_validation->set_rules('page', 'Page de destination', 'required|trim|strtolower|callback_page');
				$this->form_validation->set_rules('code', 'code Html', 'required|trim|strtolower');
				if ($this->form_validation->run() == FALSE) {
					$this->display($data);
				} else {
					$title = $this->input->post('title');
					$format = $this->input->post('format');
					$position = $this->input->post('position');
					$page = $this->input->post('page');
					$code = $this->input->post('code');
					$occ = 'frame';
					if (preg_match("#{$occ}#i", $code)) {
						$data['render'] = 'infos';
						$this->alert->set('alert-danger', '<p>votre publicité utilise les frame, ce type de publicité n\'est pas autorisé sur le forum. ' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/pub/' . $this->idM) . '">Ressayer autre code</a> </p>', TRUE);
						$this->display($data);
						return;
					}
					$code = str_replace(' class="img-responsive center-block"', ' class="img-responsive center-block"',$code);
					$array = array(
						'add_page' => $page,
						'add_format' => $format,
						'add_position' => $position,
						'add_title' => $title,
						'add_code' => $code,
						'add_id' => $this->input->post('add_id')
					);
					if ($this->admin_model->edit_adds($array) == true) {
						$data['render'] = 'infos';
						$this->alert->set('alert-success', '<p>Votre publicité a été éditée avec succès. ' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum') . '">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/pub/' . $this->idM) . '">Autre pub?</a> </p>', TRUE);
						$this->display($data);
						return;
					} else {
					}
				}
			} else {
				$data['menu'] = menu($this->_menu());
				$data['pic'] = $this->top_pic();
				$data['logo'] = $this->logo();
				$data['render'] = 'edit pub';
				$data['menuvertical'] = 'vrai';
				$data['bread'] = ' <strong>:: &Eacute;diter Pub </strong>';
				$data['editpub'] = $this->admin_model->grab_pub($this->uri->segment(4));
				$this->display($data);
			}
		}
		
		/**
		 * free_admin unlock admin after test bot
		 *
		 * @return void
		 */
		public function free_admin()
		{
			$data['menu'] = menu($this->_menu());
			$data['pic'] = $this->top_pic();
			$data['render'] = 'gerer robots';
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$data['bread'] = ' <strong>:: Gerer les spiders </strong>';
			if ($this->admin_model->freeadmin($this->ip) == true) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Félicitation à l\'administrateur, il est sorti saint et sauve du piège. ' . br(2) . '
			  <a class="btn btn-primary btn-sm" href="' . base_url('admin/index/'.$this->idM) . '">Admin</a> |
				  <a class="btn btn-primary btn-sm" href="' . base_url('forum').'">Forum</a>  |
				  <a class="btn btn-primary btn-sm" href="' . base_url('admin/gerer_robots/'.$this->idM) . '">gerer robots?</a> </p>', TRUE);
				$this->display($data);
				return;
			} else {
				echo 'manuellement';
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
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->lock_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' a été bloqué avec succès' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été bloqué.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('contact') . '">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
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
			$data['logo'] = $this->logo();
			$data['menuvertical'] = 'vrai';
			$seg = $this->uri->segment(4);
			if ($this->admin_model->delete_bot($seg) > 0) {
				$data['render'] = 'infos';
				$this->alert->set('alert-success', '<p>Le bot donc l\'adresse IP :: ' . rawurldecode($this->uri->segment(5)) . ' a été
			  supprimé avec succès de la base de donnée.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/gerer_robots/' . $this->idM) . '">Gerer robots</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			} else {
				$data['render'] = 'infos';
				$this->alert->set('alert-warning', '<p>Désolé, Le bot donc l\'adresse IP :: ' . $this->uri->segment(5) . ' n\'a pas été
			  supprimé.' . br(1) . '
			  Veuillez réssayer ultérieurement. Si cet état persiste veuillez signaler ce problème à l\'équipe du forum fabb.' . br(2) . '
			  <a class="btn btn-primary btn-xs" href="' . base_url('contact') . '">Contacter fabb</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('admin/index/' . $this->idM) . '">Admin</a> |
			  <a class="btn btn-primary btn-xs" href="' . base_url('forum') . '">Forum</a>
			   </p>', TRUE);
				$this->display($data);
				return;
			}
		}
		/**
		 * logo render logo forum 
		 *
		 * @return void
		 */
		public function logo()
		{
			$logo = $this->admin_model->get_logo();
			foreach ($logo->result() as $row) :
				$logo = $row->pic_file;
			endforeach;
			return $logo;
		}		
}// end class
