<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Agus Widjanarko
 * @version : 1.1
 * @since : 15 November 2016
 */
class Skhs_model extends CI_Model
{
    
  
function addNew_skhs($tr_mst_skhs)
    {
      
        $this->db->trans_start();
        $this->db->insert('tbl_skhs', $tr_mst_skhs);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

function addNew_dtl_skhs($tr_dtl_skhs)
    {
      
        $this->db->trans_start();
        $this->db->insert('tbl_dtl_skhs', $tr_dtl_skhs);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }   
}

?>