<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smtp_model extends CI_Model {
	
    function __construct() {
        parent::__construct();
    }

public function dataSmtp(){
	$this->db->select('*');
	$this->db->where('smtp_active',1);
     return $this->db->get('fabb_smtp');
	 
 
}
//----------------------------------------- smtp host -------------------------------------------------------
public function hostsmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_host;
endforeach;
	}
//----------------------------------------- smtp host -------------------------------------------------------
public function namesmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_name;
endforeach;
	}	

//----------------------------- smtp port -----------------------------------
	
	public function portsmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_port;
endforeach;
	}
	
	
//----------------------------------------- smtp user ------------------------------------------------------	
public function usersmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_user;
endforeach;
	}
//--------------------------------------- psw ----------------------------------------------------
public function pswsmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_psw;
endforeach;
	}
	//--------------------------- crypt----------------------------------------------
	public function cryptsmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_crypt;
endforeach;
	}
	//-------------------------- charset ----------------------------------
public function charsetsmtp()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_charset;
endforeach;
	}
	//----------------------------------- mailtype-----------------------------------------
public function mailtype()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_mailtype;
endforeach;
	}
	//----------------------------------- active -----------------------------------------
public function active()
    
	{
foreach($this->dataSmtp()->result() as $row):
return $row->smtp_active;
endforeach;
	}	
	//----------------------------------- update state-----------------------------------------
public function update_state($choix,$id)
    
	{
$this->db->set('smtp_active',$choix);
$this->db->where('smtp_id',$id);
$this->db->update('fabb_smtp');
return $this->db->affected_rows();
	}		
	
}//end class
