<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Penilaian_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function daftarPenilaianCount($searchText = '')
    {
        $this->db->select('BaseTbl.id_wadah, BaseTbl.nama_wadah');
        $this->db->from('tbl_wadah as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama_wadah  LIKE '%" . $searchText . "%'
                            )";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function getFppc($row_id)
    {
        return $this->db->query("SELECT * FROM tbl_fppc Where row_id =" . $row_id);
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
    
    function getnilaifppc($row_id, $id_kd_lokal)
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
                left JOIN tb_r_ikan_lokal ON dtl_fppc.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal Where row_id =" .$row_id. " AND tb_r_ikan_lokal.id_kd_lokal =" .$id_kd_lokal);
    }

    function getPenilaian($row_id, $id_kd_lokal, $panelis_id)
    {
        return $this->db->query("SELECT * FROM tbl_nilai LEFT JOIN tb_r_panelis ON tbl_nilai.panelis_id = tb_r_panelis.id WHERE permohonan_id =" .$row_id. " AND id_kd_lokal =" .$id_kd_lokal. " AND panelis_id = ". $panelis_id);
    }
    
    function getdetailuji($id_kd_ikan)
    {
        return $this->db->query("SELECT * FROM dtl_hasil_uji Where id_kd_ikan =" . $id_kd_ikan);
    }

    function daftarOrganoleptik()
    {
        return $this->db->query("SELECT * FROM tb_r_organoleptik");
    }

    function cekRecord($row_id, $id_kd_lokal, $panelis_id)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_nilai', $nilai);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function tambahNilaiBaru($nilai)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_nilai', $nilai);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function updateNilai($row_id, $id_kd_lokal, $panelis_id, $nilai)
    {
        $this->db->trans_start();
        $this->db->where('permohonan_id', $row_id);
        $this->db->where('id_kd_lokal', $id_kd_lokal);
        $this->db->where('panelis_id', $panelis_id);
        $this->db->update('tbl_nilai', $nilai);

        $updated_row = $this->db->affected_rows();

        $this->db->trans_complete();
        
        if($updated_row > 0){
            return $row_id;
        } else {
            return false;
        }
    }

    function getHasil($row_id, $id_kd_lokal)
    {
        return $this->db->query("SELECT * FROM tbl_nilai LEFT JOIN tb_r_panelis ON tbl_nilai.panelis_id = tb_r_panelis.id WHERE permohonan_id =" .$row_id. " AND id_kd_lokal =" .$id_kd_lokal);
    }

    function insertHasil($row_id, $id_kd_lokal, $hasil_uji)
    {
        $this->db->trans_start();
        $this->db->where('row_id', $row_id);
        $this->db->where('id_kd_lokal', $id_kd_lokal);
        $this->db->update('dtl_hasil_uji', $hasil_uji);

        $updated_row = $this->db->affected_rows();

        $this->db->trans_complete();
        
        if($updated_row > 0){
            return $row_id;
        } else {
            return false;
        }
    }
}
