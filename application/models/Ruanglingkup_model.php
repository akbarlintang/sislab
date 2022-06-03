<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Agus Widjanarko
 * @version : 1.1
 * @since : 15 November 2016
 */
class Ruanglingkup_model extends CI_Model
{
    
  
   
        
    function addNew_Ruanglingkup($tbl_ruanglingkup)
    {
      
        $this->db->trans_start();
        $this->db->insert('tb_r_ikan_lokal', $tbl_ruanglingkup);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

   
}

?>