<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Title_page_model extends CI_Model {
	
	
    function __construct() {
        parent::__construct();
    }

	public function config_title()
	{
	
	$this->db->select('title_page,title_value');
     return $this->db->get('fabb_title_page');
	 
 
    }

    public function title_forum_index()
    {
	
	foreach($this->config_title()->result_array() as $val):
	
    $title_config[$val['title_page']] = $val['title_value']; 
    
   $this->config->set_item('titleForumIndex', $title_config['forum/index']);
   endforeach;

    return $this->config->item('titleForumIndex');
   
   }

}  // end class
