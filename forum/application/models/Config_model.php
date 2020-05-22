<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Config_model extends CI_Model {
function __construct() {
parent::__construct();
}
public function get_forum_config(){
$this->db->select('config_name,config_value');
return $this->db->get('fabb_config');
}
//------------------------------------- admin topic par page -------------------------------------
public function acp_topic_page(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('acp_topic_page',$cat_config['admin_topic_par_page']);
return $this->config->item('acp_topic_page');
}
//------------------------------------- membres par page -------------------------------------
public function member_par_page(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('member_par_page',$cat_config['members_par_page']);
return $this->config->item('member_par_page');
}
//----------------------------------------- topic par page --------------------------
public function topic_par_page()
{
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('topic_par_page',$cat_config['topic_par_page']);
return $this->config->item('topic_par_page');
}
//----------------------------- time flood -----------------------------------
public function title_forum(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('title_forum',$cat_config['forum_titre']);
return $this->config->item('title_forum');
}
//-----------------------------------------------------------------------------------------------	
public function first_slogan(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('first_slogan',$cat_config['slogan_1']);
return $this->config->item('first_slogan');
}
//-------------------------------------------------------------------------------------------
public function second_slogan(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('second_slogan',$cat_config['slogan_2']);
return $this->config->item('second_slogan');
}
//-------------------------------------------------------------------------
public function avatar_size(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('avatar_size',$cat_config['avatar_maxsize']);
return $this->config->item('avatar_size');
}	
//------------------------------------------------------------
public function avatar_width(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('avatar_width',$cat_config['avatar_maxw']);
return $this->config->item('avatar_width');
}	
//----------------------------------------------------------------------------
public function avatar_height(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('avatar_height',$cat_config['avatar_maxh']);
return $this->config->item('avatar_height');
}	
//---------------------------------------------------------------------------------
public function signature(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('signature',$cat_config['signat_strlen']);
return $this->config->item('signature');
}
//------------------------------------------------------------------------------
public function bbcode(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('bbcode',$cat_config['auth_bbcode']);
return $this->config->item('bbcode');
}	
//-------------------------------- smiley ----------------------------------------------
public function smiley(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('smiley',$cat_config['auth_smiley']);
return $this->config->item('smiley');
}		
//-------------------------------------------------------------------
public function pseudo_max_size(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('pseudo_max_size',$cat_config['pseudo_maxsize']);
return $this->config->item('pseudo_max_size');
}	
//----------------------------------------------------------------------------
public function pseudo_min_size(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('pseudo_min_size',$cat_config['pseudo_minsize']);
return $this->config->item('pseudo_min_size');
}	
//---------------------------------------------------------------------------	
public function post_par_page(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('post_par_page',$cat_config['post_par_page']);
return $this->config->item('post_par_page');
}	
//------------------------------------------------------------------------
public function flood(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('flood',$cat_config['temps_flood']);
return $this->config->item('flood');
}		
//--------------------------------------------------------------------------------	
public function badword_par_page(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('badword_par_page',$cat_config['badword_par_page']);
return $this->config->item('badword_par_page');
}	
//------------------------------------- admin contact -------------------------------------
public function admin_contact(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('admin_contact',$cat_config['admin_email']);
return $this->config->item('admin_contact');
}	
//------------------------------------- search result -------------------------------------
public function search_result(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('search_per_page',$cat_config['search_par_page']);
return $this->config->item('search_per_page');
}	
//------------------------------------- link linkedin -------------------------------------
public function linkedin(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('linkedin',$cat_config['lien_linkedin']);
return $this->config->item('linkedin');
}	
//------------------------------------- link twitter -------------------------------------
public function twitter(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('twitter',$cat_config['lien_twitter']);
return $this->config->item('twitter');
}	
//------------------------------------- link facebook -------------------------------------
public function facebook(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('facebook',$cat_config['lien_facebook']);
return $this->config->item('facebook');
}	
//------------------------------------- link facebook -------------------------------------
public function raison(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('raison',$cat_config['raison_sociale']);
return $this->config->item('raison');
}	
//------------------------------------- website title -------------------------------------
public function website_title(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('website',$cat_config['website_title']);
return $this->config->item('website');
}	
//------------------------------------- inactif-------------------------------------
public function in_actif(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
$this->config->set_item('inactif',$cat_config['periode_inactif']);
return $this->config->item('inactif');
}	
//------------------------------------- config smtp -------------------------------------
public function active_smtp(){
foreach($this->get_forum_config()->result_array() as $val):
$cat_config[$val['config_name']] = $val['config_value']; 
endforeach;
if($cat_config['active_smtp']==1){
$this->config->set_item('active_smtp', true);
return $this->config->item('active_smtp');
}
}		
}//end class
