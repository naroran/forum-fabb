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
class Forum extends CI_Controller {
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
	function __construct()
	{
	parent::__construct();
	$this->load->helper(array('url','func','file'));
	$this->load->model(array('forum_model','config_model'));
	$this->load->library(array('pagination','encryption','bbcode'));
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
 * index page index
 *
 * @return void
 */
public function index()
{
	  $data['render']='index';
      $data['start_time']=microtime(true);
	  $data['menu']=menu($this->_menu());
	  $data['query'] = $this->forum_model->get_all_forums(VISITOR);
	  $data['count_members']=$this->forum_model->members_online();
	  $data['count_visitors']=$this->forum_model->visitors_online();
	  $data['total_topic']=$this->forum_model->count_all_topic();
	  $data['totalMembres']=$this->forum_model->count_users();
	  $data['totalPost'] = $this->forum_model->totalPost();
	  $data['last_member'] = $this->forum_model->get_last_user();
      $data['categorie'] = NULL;
	  $data['totalcat']=$this->db->count_all_results();
	  $this->load->model('title_page_model');
	  $this->title_page_model->title_forum_index();
	  $data['pic']=$this->top_pic();
	  $data['bread']=' <strong>:: index </strong>';
	  $data['title']=$this->title_page_model->title_forum_index();
      $data['title']='forum fabb';
	  $data['description']='index forum';
	  $data['keyword']='index forum';
	  $query=$this->forum_model->forum_top_add();
	  if($query->num_rows()>0){
	  foreach($query->result_array() as $val):
	   $data['addt']=$val['add_code'];
	   endforeach;
	  }else{$data['addt']=false;}
	  $query=$this->forum_model->forum_bottom_add();
	  if($query->num_rows()>0){
	  foreach($query->result_array() as $val):
	   $data['addb']=$val['add_code'];
	   endforeach;
	  }else{$data['addb']=false;}
	$data['lastAnn']=$this->forum_model->lastannonce();
	$data['annonces']=$this->forum_model->all_annonces(VISITOR);
	  $this->display($data);
	}
	/**
	 * view_forum shows all forums
	 *
	 * @return void
	 */
	public function view_forum(){
	$data['start_time']=microtime(true);
$data['menu']=menu($this->_menu());
	if(!$this->uri->segment(3)){show_404();}else{$forum=(int)$this->uri->segment(3);
			}
	 $forum=$this->uri->segment(3);
		$query=$this->forum_model->get_nbr_topics($forum);
		foreach($query->result() as $row){
			$data['topicSort']=$row->topic_sort;
		   $data['bread']=' <strong>:: '.$row->forum_name.' </strong>';
		$total_topic= $row->forum_topic;
        }
			 $page=$this->uri->segment(4);
			 $topicParPage= $this->config_model->topic_par_page();
		$config['base_url'] = base_url('voir/forum/'.$forum);
        $config['total_rows'] = $total_topic;
        $config['per_page'] = $topicParPage;
        $config['num_links'] = 3;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<ul style="margin:0 0" class="pagination pagination-sm">';
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
        $data["link"] = $this->pagination->create_links();
		if ($this->status>PENDING)
		{
		$data['topic']=$this->forum_model->get_connected_topic($this->idM,$forum,$topicParPage,$page);
		}
		else{
				$data['topic']=$this->forum_model->get_all_topic($forum,$topicParPage,$page);
		}
		$data['query']=$query=$this->forum_model->get_nbr_topics($forum);
		$data['forum']=&$forum;
		$data['count_members']=$this->forum_model->members_online();
		$data['count_visitors']=$this->forum_model->visitors_online();
	    $data['total_topic']=$this->forum_model->count_all_topic();
		$data['totalMembres']=$this->forum_model->count_users();
		$data['totalPost'] = $this->forum_model->totalPost();
		$data['last_member'] = $this->forum_model->get_last_user();
        $data['categorie'] = NULL;
        $data['page']=$page;
        $data['render']='voir forum';
        $data['title']='voir forum';
	    $data['description']='voir forum';
	    $data['keyword']='voir forum';
	  	  $data['pic']=$this->top_pic();
		$this->display($data);
		}        
        /**
         * annonces views all annonces
         *
         * @return void
         */
        public function annonces(){
		$data['start_time']=microtime(true);
        $data['menu']=menu($this->_menu());
	    $forum=$this->uri->segment(3);
		$query=$this->forum_model->get_nbr_topics($forum);
		foreach($query->result() as $row){
			$data['topicSort']=$row->topic_sort;
		   $data['forumName']=$row->forum_name;
		   $data['topicTitle']=$row->topic_title;
		   $data['bread']=$row->topic_title;
		   $total_topic= $row->forum_topic;
		   $data['forumgroup']=$row->forum_group;
		   $data['tt_post']=$row->tt_post;
        }
		$topic_p_page= $this->config_model->topic_par_page();
			 $page=$this->uri->segment(4);
		$config['base_url'] = base_url('voir/forum/'.$forum);
        $config['total_rows'] = $total_topic;
        $config['per_page'] = $topic_p_page;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<ul style="margin:0 0" class="pagination pagination-sm">';
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
        $data["link"] = $this->pagination->create_links();
		if ($this->status>PENDING)
		{
        $data['annonces']=$this->forum_model->get_connected_annonces($this->idM,$forum);
		}
		else{
		$data['annonces']=$this->forum_model->get_annonces($forum);
		}
		$data['query']=$query=$this->forum_model->get_nbr_topics($forum);
		$data['forum']=&$forum;
		$data['count_members']=$this->forum_model->members_online();
		$data['count_visitors']=$this->forum_model->visitors_online();
	    $data['total_topic']=$this->forum_model->count_all_topic();
		$data['totalMembres']=$this->forum_model->count_users();
		$data['totalPost'] = $this->forum_model->totalPost();
		$data['last_member'] = $this->forum_model->get_last_user();
        $data['categorie'] = NULL;
	    $data['derniermembre'] = $this->forum_model->get_last_user();
        $data['page']=$page;
        $data['render']='forum annonces';
        $data['title']='voir forum';
	    $data['description']='voir forum';
	    $data['keyword']='voir forum';
	  	  $data['pic']=$this->top_pic();
		$this->display($data);
				}
/**
 * view_topic views all topic
 *
 * @return void
 */
public function view_topic(){
	$data['start_time']=microtime(true);
$data['menu']=menu($this->_menu());
	$topic=(int)$this->uri->segment(3);
		$query=$this->forum_model->this_topic($topic);
		foreach($query->result() as $row){
		$forum=$row->topic_forum_id;
		$topic_lastpost=$row->topic_lastpost;
		$topicTitle=$row->topic_title;
		}
		$page=$this->uri->segment(4);
		$tt_post = $this->forum_model->total_Post($topic);
		$post_p_page = $this->config_model->post_par_page();
		$config['base_url'] = base_url('voir/topic/'.$topic.'/');
        $config['total_rows'] = $tt_post;
        $config['per_page'] =$post_p_page;
		$config['num_links'] = 3;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<ul style="margin:0 0" class="pagination pagination-ms">';
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
        $data["link"] = $this->pagination->create_links();
		if ($this->status>PENDING)
		{
           $data['topic']=$this->forum_model->get_connected_topic($this->idM,$forum,$post_p_page,$page);
			$query3=$this->forum_model->viewed_topic($topic,$this->idM);
	            if($query3->num_rows()==0)
				  {
				    $this->forum_model->first_view_topic($this->idM,$topic,$forum,$topic_lastpost);
				  }
				  else
                  {
					 $this->forum_model->update_first_tv($topic_lastpost,$topic,$this->idM);
				  }
		}
		else{
		$data['topic']=$this->forum_model->get_all_topic($forum,$post_p_page,$page);
		}
        $data['post_createur']=$this->forum_model->get_post_owner($topic,$post_p_page,$page);
	    $data['move']=$this->forum_model->moved_forum($forum);
		$this->forum_model->add_one_view($topic);
		$data['lock']=$this->forum_model->data_lock($topic);
		$data['forum']=$forum;
		$data['query'] =$query;
		$data['topic_id']=$topic;
		$data['title']='voir topic';
	    $data['description']='voir topic';
	    $data['keyword']='voir topic';
		$data['pic']=$this->top_pic();
		$data['bread']=$topicTitle;
		$data['moveTopic']=$this->forum_model->selectForumTo($forum);
		$data['count_members']=$this->forum_model->members_online();
		$data['count_visitors']=$this->forum_model->visitors_online();
	    $data['total_topic']=$this->forum_model->count_all_topic();
		$data['totalMembres']=$this->forum_model->count_users();
		$data['totalPost'] = $this->forum_model->totalPost();
		$data['last_member'] = $this->forum_model->get_last_user();
		$data['render']='voir topic';
		$this->display($data);
        }       
       /**
        * move_topic move topic to an other forum
        *
        * @return void
        */
       public function move_topic(){
		 if($this->input->post('deplacer'))
		{
		$topic_id=$this->uri->segment(3);
		$newForumId = (int) $this->input->post('moveto');
		$dataTopic=$this->forum_model->check_moving_topic($topic_id);
		foreach($dataTopic->result() as $rows):
		$auths=$rows->forum_auth_modo;
		$oldForumId=$rows->forum_id;
		$nbrForumPost=$rows->forum_post;
		endforeach;
		$nbr_post=$this->forum_model->nbrPostopic($topic_id);
		if ($this->status<MODO)
        {
		exit(show_error(ERR_AUTH_MOVE, 403,$heading = 'Nous Avons Rencontré Une Exception'));
        }
		else
		{
		$oldlastpost=$this->forum_model->old_lastPost($oldForumId);
		foreach($oldlastpost->result() as $value):
		$oldLastPost=$value->post_id;
		endforeach;
		$movepost= $this->forum_model->movePost_newForum($newForumId,$topic_id);
		$movetopic= $this->forum_model->moveTopic_newForum($newForumId,$topic_id);
		$moveforum=$this->forum_model->moveToForum($oldLastPost,$nbr_post,$newForumId);
		 $newlastpost=$this->forum_model->new_last_post($oldForumId);
		 $oldforum=$this->forum_model->updateOldForum($nbr_post,$newlastpost,$oldForumId);
		$this->load->library('alert');
		 $this->alert->set('alert-success','Le topic a été déplacé avec succès.'.br(2).'
			  <a class="btn btn-success btn-sm" href="'.base_url('voir/forum/'.$newForumId).'">Forum</a> |
			  <a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic_id).'">Retour Topic</a> |
			  <a class="btn btn-success btn-sm" href="'.base_url('forum').'">Quitter</a>
			  ',TRUE);
	   $data['pic']=$this->top_pic();
       $data['menu']=menu($this->_menu());
       $data['title']='forum fabb';
	   $data['render']='infos';
	   $data['description']='index forum';
	   $data['keyword']='index forum';
	   $this->display($data);
			}
	    }
		 }        
        /**
         * lock_topic lock topic
         *
         * @return void
         */
        public function lock_topic(){
        $data['menu']=menu($this->_menu());
			 $data['microt1']=microtime();
			 $data['pic']=$this->top_pic();
	    $topic = (int) $this->uri->segment(3);
		$resp=$this->forum_model->data_lock_topic($topic);
		foreach($resp->result() as $val):
		$owner=$val->topic_owner;
		endforeach;
	 if($this->idM==$owner || $this->status>=MODO)
    {
     $this->forum_model->update_lock_topic($topic);
        $data['lock_t']= '<a href="'.base_url('voir/topic/'.$topic).'">Voir le topic</a> ';
				$data['render']='infos';
			    $this->load->library('alert');
		$this->alert->set('alert-success','<p>Le topic est maintenant vérouillé.
		'.br(2).'
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Forum</a> |
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">Retour Topic</a></p> ');
				  $this->load->view('inc/header',$data);
				  $this->load->view('inc/topPage',$data);
		         $this->load->view('inc/navBar',$data);
				 if($this->status==MODO){
					$data['render']='infos';
                   $this->load->view('modo/index',$data);
				 }
				elseif($this->status==ADMIN){
				$data['render']='infos';
                   $this->load->view('admin/index',$data);
				 }
				 else{
					$data['render']='infos';
					$this->load->view('member/index',$data);
					 }
		         $this->load->view('inc/footer',$data);
    }
	    else{
		show_error(ERR_AUTH_VERR, 403,$heading = 'Nous Avons Rencontré Une Exception');
    }
	}	
	/**
	 * unlock_topic unlock topic
	 *
	 * @return void
	 */
	public function unlock_topic(){
        $data['menu']=menu($this->_menu());
				 $data['microt1']=microtime();
			 $data['pic']=$this->top_pic();
						$this->load->library('alert');
	    $topic = (int) $this->uri->segment(3);
		$query= $this->forum_model->unlock_topic($topic);
		foreach($query->result() as $val):
		$owner=$val->topic_owner;
		endforeach;
    if($this->idM==$owner || $this->status>=MODO)
    {
		     $this->forum_model->update_unlock_topic($topic);
			 $data['render']='infos';
              $this->alert->set('alert-success','<p>Le topic est maintenant dévérouillé.
		'.br(2).'
		<a class="btn btn-success btn-sm" href="'.base_url('forum').'">Aller au Forum</a> |
		<a class="btn btn-success btn-sm" href="'.base_url('voir/topic/'.$topic).'">Retour topic</a> </p>');
				  $this->load->view('inc/header',$data);
		          $this->load->view('inc/topPage',$data);
		         $this->load->view('inc/navBar',$data);
				if($this->status==MODO){
                   $this->load->view('modo/index',$data);
				 }
				elseif($this->status==ADMIN){
                   $this->load->view('admin/index_admin',$data);
				 }
				 else{
					$this->load->view('member/index',$data);
					 }
		         $this->load->view('inc/footer',$data);
				 return;
          }
	     else
         {
		show_error(ERR_AUTH_VERR, 403,$heading = 'Nous Avons Rencontré Une Exception');
        }
	    }    
    /**
     * display fire data to view
     *
     * @param  mixed $data
     * @return void
     */
    public function display($data)
   {
	$this->load->view('inc/header',$data);
	$this->load->view('inc/topPage',$data);
	$this->load->view('inc/navBar',$data);
	$this->load->view('forum/index',$data);
	$this->load->view('inc/footer',$data);
   }
  /**
   * top_pic add an image to page header
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
	protected function _menu(){
		$this->load->config('glyph');
		$tpid=$this->member_model->total_post_idm($this->idM);
		$ttid=$this->member_model->total_topic_idm($this->idM);
			  $array=array(
		     'lvl'=> $this->lvl,
		     'blink'=> 'forum',
		     'msg'=> $this->msg,
		     'nbr_msg'=> $this->nbr_msg,
		     'avatar'=> $this->avatar,
		     'pseudo'=> $this->pseudo,
		     'email'=> $this->email,
			 'status'=> $this->status,
			 'idM'=>$this->idM,
			 'tpid'=>$tpid,
			 'ttid'=>$ttid,
			 'sign-in'=>$this->config->item('sign-in'),
			 'sign-white'=>$this->config->item('sign-white'),			 
			 'home'=>$this->config->item('home'),
			 'userplus-white'=>$this->config->item('userplus-white'),
			 'userplus-blue'=>$this->config->item('userplus-blue'),
		);
		return $array;
		}

    public function lastpost(){
	$topic=$this->uri->segment(3);
	$post=$this->uri->segment(4);
	$data['topic']=$this->forum_model->topic_lastpost($topic,$post);
    $data['menu']=menu($this->_menu());
    $this->load->view('forum/lastpost',$data);
	}
}
