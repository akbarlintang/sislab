<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Permohonan_model extends CI_Model
{

  /**
   * This function used to check the login credentials of the user
   * @param string $email : This is email of the user
   * @param string $password : This is encrypted password of the user
   */

  function getPermohonanInfoByEmail($userId)
  {
    return $this->db->query("SELECT * FROM tbl_fppc Where userId =" . $userId);
  }

  function addNew_Fppc($tr_mst_fppc)
  {

    $this->db->trans_start();
    $this->db->insert('tbl_fppc', $tr_mst_fppc);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return $insert_id;
  }

  function addDetail_Fppc($tr_dtl_fppc)
  {

    $this->db->trans_start();
    $this->db->insert('dtl_fppc', $tr_dtl_fppc);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return $insert_id;
  }

  function  addDetail_uji($tr_dtl_uji)
  {

    $this->db->trans_start();
    $this->db->insert('dtl_hasil_uji', $tr_dtl_uji);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return $insert_id;
  }


  function getdetailfppc($row_id)
  {
    return $this->db->query("SELECT
            tb_r_ikan_lokal.nm_lokal as nm_lokal,
            dtl_fppc.row_id,
            dtl_fppc.kode_sampel,
            dtl_fppc.wadah,
            dtl_fppc.bentuk,
            dtl_fppc.jumlah_contoh,
            dtl_fppc.Deskripsi_contoh,
            dtl_fppc.id_kd_lokal
            FROM
            dtl_fppc
            left JOIN tb_r_ikan_lokal ON dtl_fppc.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal Where row_id =" .$row_id);
  }
  function getdetailuji($id_kd_ikan)
  {

    return $this->db->query("SELECT * FROM dtl_hasil_uji Where id_kd_ikan =" . $id_kd_ikan);
  }

  function add_fppc_detail($dtl_fppc, $id_kd_ikan, $row_id)
  {
    $this->db->where('row_id', $row_id and 'id_kd_ikan', $id_kd_ikan);
    $this->db->update('dtl_fppc', $dtl_fppc);

    return TRUE;
  }

  public function getFppc($row_id)
  {
    return $this->db->query("SELECT * FROM tbl_fppc Where row_id =" . $row_id);
  }

  function edit_Fppc($tr_mst_fppc, $row_id)
  {
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_fppc', $tr_mst_fppc);
    return TRUE;
  }
  // function edit_Fppc()
  // {
  //     $menu = $this->input->post('menu', true);
  //     $this->db->set('menu', $menu);
  //     $this->db->where('fno_ppc', $this->input->post('fno_ppc'));
  //     $this->db->update('tbl_fppc');
  // }

}
