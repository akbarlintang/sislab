<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Rekapnilai_model extends CI_Model
{
    function getdetailfppc($row_id)
    {
        return $this->db->query("SELECT * FROM tbl_fppc Where row_id =" .$row_id);
    }
    
    function getPenilaian($row_id, $id_kd_lokal)
    {
        return $this->db->query("SELECT * FROM tbl_nilai LEFT JOIN tb_r_panelis ON tbl_nilai.panelis_id = tb_r_panelis.id WHERE permohonan_id =" .$row_id. " AND id_kd_lokal =" .$id_kd_lokal);
    }
    
    function tambahNilaiBaru($nilai)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_nilai', $nilai);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
}
