<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Agus Widjanarko
 * @version : 1.1
 * @since : 15 November 2016
 */
class Parameteruji_model extends CI_Model
{
    
  
   
        
    function addNew_Parameteruji($paramater_uji)
    {
      
        $this->db->trans_start();
        $this->db->insert('tbl_parameter_uji', $paramater_uji);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

   
}

?>