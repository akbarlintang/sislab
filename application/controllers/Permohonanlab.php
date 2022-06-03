<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';
include "vendor/mpdf/mpdf/mpdf.php";
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Agus WIdjaanrko
 * @version : 1.1
 * @since : 15 November 2016
 */
class PermohonanLab extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_model');
        $this->load->model('user_model');
        $this->db2 = $this->load->database('my_sqlsrv', TRUE);
        // $this->db2 = $this->load->database ();
        $this->load->database();
        $this->isLoggedIn();
        $this->load->library('form_validation');
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {

        $var = $this->session->userdata;
        $userId = $var['userId'];
        $this->global['pageTitle'] = 'Sigapkarin';
        $data['fppc'] = $this->db->query("SELECT * FROM tbl_fppc Where userId =" . $userId . " AND sts_print=0 ORDER BY row_id DESC")->result_object();
        $this->loadViews("permohonan", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function addNew()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            // $tahun     = date("Y");
            $tahun     = 2020;
            $data['jenis_sampel']   = $this->db->query("SELECT id_kd_lokal,nm_umum,nm_latin FROM tb_r_ikan_lokal ")->result_object();
            $data['mst_pelaporan']  = $this->db2->query("SELECT no_ppk,tgl_ppk,kd_kegiatan,id_ppk FROM tr_mst_pelaporan WHERE  YEAR(tgl_ppk)=" . $tahun . " and kd_kegiatan IN ('E','I')  ")->result_object();
            $data['tb_r_trader']  = $this->db2->query("SELECT * FROM tb_r_trader")->result_object();
            $this->global['pageTitle'] = 'Sigapkarin : Add New FPPC';
            $this->loadViews("addNew_Fppc", $this->global, $data, NULL);
        }
    }
    function addNew_Form_Detail($row_id, $id_kd_lokal)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $data['id_kd_lokal'] = $id_kd_lokal;
            $data['row_id'] = $row_id;
            $data['parameter_uji']   = $this->db->query("SELECT * FROM tbl_parameter_uji")->result_object();
            $data['tbl_kode_asal'] =  $this->db->query("SELECT * FROM tbl_kode_asal")->result_object();
            $data['tbl_wadah'] =  $this->db->query("SELECT * FROM tbl_wadah")->result_object();
            $data['tbl_bentuk'] =  $this->db->query("SELECT * FROM tbl_bentuk")->result_object();
            $this->global['pageTitle'] = 'Sislab : Add New FPPC';
            $this->loadViews("addNew_Fppc_detail", $this->global, $data, NULL);
        }
    }
    function addNew_detail()
    {
        if ($this->isAdmin() == FALSE) {
            $this->loadThis();
        } else {
            $data['Detail_Permohonan']   = $this->db2->query("SELECT id_kd_lokal FROM tb_dtl_permohonan ")->result_object();
            $this->global['pageTitle'] = 'Sigapkarin : Add New FPPC';
            $this->loadViews("detail_permohonan", $this->global, $data, NULL);
        }
    }



    function addNew_Fppc()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fno_ppc', 'no_fppc', 'trim|max_length[128]');
            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                /*                $data_nofppc = $this->db->query("SELECT no_fppc FROM tbl_fppc WHERE date(tgl_fppc)=CURDATE()")->result_array();
                if (empty($data_nofppc)){
                            $nosuratlast = $this->db->query("SELECT no_fppc FROM tbl_fppc WHERE date(tgl_fppc)=CURDATE() ORDER BY no_fppc DESC LIMIT 1")->result_array();
                            $nobaru= date('d').'.'.'1';
                            $bulan  = $this->getrovbulan(date('m'));
                            $tahun  = date('Y');
                            $vno_fppc = strval($nobaru).'/FPPC/BALAI KIPM-SMG/'.$bulan.'/'.$tahun;
                } else {
                            $nosuratlast = $this->db->query("SELECT no_fppc FROM tbl_fppc WHERE date(tgl_fppc)=CURDATE() ORDER BY no_fppc DESC LIMIT 1 ")->result_array();
                            $nobaru= strval(substr($nosuratlast[0]['no_fppc'],3,1));
                            $nobaru = $nobaru+1;
                            $nobarux = date('d').'.'.$nobaru;
                            $bulan  = $this->getrovbulan(date('m'));
                            $tahun  = date('Y');
                            $vno_fppc = strval($nobarux).'/FPPC/BALAI KIPM-SMG/'.$bulan.'/'.$tahun;
                }
            */
                $data = $this->db->query("select isnull(max(row_id),0)+1 as jml from tbl_fppc")->result_array();
                $this->row_id = $data[0]['jml'];

                $id_ppk = $this->input->post('ppk');
                $id_ppk = ($id_ppk[0]);
                if (empty($id_ppk)) {
                    $id_ppk     = $this->input->post('pelanggan');
                    $agusta = 'admin';
                    $username = mysqli_real_escape_string($agusta);

                    $id_ppk = ($id_ppk[0]);
                    $no_ppk  = '-';
                    $tgl_ppk = date('Y-m-d', strtotime($this->input->post('tgl_sampel')));
                } else {
                    $ppk     =  $this->db2->query("select no_ppk,tgl_ppk from tr_mst_pelaporan WHERE id_ppk=" . $id_ppk . "")->result_array();
                    $no_ppk  = ($ppk[0]['no_ppk']);
                    $tgl_ppk = ($ppk[0]['tgl_ppk']);
                }


                $fno_ppc     = $this->input->post('fno_ppc');
                $tgl_sampel  = date('Y-m-d', strtotime($this->input->post('tgl_sampel')));
                $bulan       = $this->getrovbulan(date("n", strtotime($tgl_sampel)));
                $tahun       = date("Y", strtotime($tgl_sampel));
                $fno_ppc    = $fno_ppc . '/FPPC/ BKIPM-JKT I/' . $bulan . '/' . $tahun;
                $id_trader   = $this->input->post('pelanggan');
                $id_trader   = ($id_trader[0]);

                /* Reguler
                $tr_mst_fppc = array('no_fppc'=>$vno_fppc, 'tgl_fppc'=>date('Y-m-d H:i:s'), 
                    'no_ppk'=>$no_ppk, 'id_ppk'=>$id_ppk,'tgl_ppk'=>$tgl_ppk,'userid'=>$this->session->userdata['userId'],'row_id'=>$this->row_id);
                */

                $tr_mst_fppc = array(
                    'no_fppc' => $fno_ppc, 'tgl_fppc' => $tgl_sampel,
                    'no_ppk' => $no_ppk, 'id_ppk' => $id_ppk, 'tgl_ppk' => $tgl_ppk, 'id_trader' => $id_trader,  'userid' => $this->session->userdata['userId'], 'row_id' => $this->row_id, 'sts_print' => '0'
                );



                $jenissampel = $this->input->post('jenissampel');

                foreach ($jenissampel as $id_kd_lokal) {
                    $tr_dtl_fppc = array('row_id' => $this->row_id, 'id_kd_lokal' => $id_kd_lokal);

                    $this->Permohonan_model->addDetail_Fppc($tr_dtl_fppc);
                }

                $result = $this->Permohonan_model->addNew_Fppc($tr_mst_fppc);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New FPPC created successfully');
                } else {
                    $this->session->set_flashdata('error', 'FPPC creation failed');
                }

                redirect('Permohonanlab');
            }
        }
    }
    function addNew_Fppc_detail_uji()
    {
        if ($this->isAdmin() == FALSE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fno_ppk', 'no_ppk', 'trim|required|max_length[128]');
            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                $result = $this->Permohonan_model->add_fppc_detail($dtl_fppc);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New FPPC created successfully');
                } else {
                    $this->session->set_flashdata('error', 'FPPC creation failed');
                }

                redirect('Permohonanlab');
            }
        }
    }

    function editOld($row_id)
    {

        // if($this->isAdmin() == FALSE || $userId == 3)
        // {
        //    $this->loadThis();
        // }
        // else
        // {
        //    if($userId == null)
        //    {
        //       redirect('userListing');
        //    }
        //  $data['row_id'] = $row_id;
        // $this->session->unset_userdata('persen');
        // $this->session->set_userdata('vrow_id',$row_id);

        $data['Detail_Permohonan'] = $this->Permohonan_model->getdetailfppc($row_id)->result_object();
        $this->global['pageTitle'] = 'Sigapkarin : Detail Sampel';
        $this->loadViews("detail_Permohonan", $this->global, $data, NULL);
        // }
    }


    /**
     * This function is used to edit the user information
     */
    function update_detail_fppc()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $fbentuk  = $this->input->post('fbentuk');
            $fpacking = $this->input->post('fpacking');
            $this->form_validation->set_rules('fdeskripsicth', 'Deskripsi Contoh', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('fjumlahcth', 'Jumlah Contoh', 'trim|required|max_length[128]');
            if ($this->form_validation->run() == FALSE) {
                $this->editOld($row_id);
            } else {
                $data_ikan          = $this->input->post('fdata_ikan');
                $row_id             = $this->input->post('frow_id');
                $fdeskripsicth = ucwords(strtolower($this->security->xss_clean($this->input->post('fdeskripsicth'))));
                $fjumlahcth = ucwords(strtolower($this->security->xss_clean($this->input->post('fjumlahcth'))));
                $fpacking = $this->input->post('fpacking');
                $fbentuk  = $this->input->post('fbentuk');
                $fkode_sampel = 'S' . '.' . date("d") . '.' . date("n") . '.' . $this->input->post('fkodesampel') . '.' . $this->input->post('fkode_asal');
                $jenisuji = $this->input->post('parameteruji');

                foreach ($jenisuji as $kode_uji) {
                    $tr_dtl_uji = array(
                        'row_id'       => $row_id,
                        'id_kd_lokal'   => $data_ikan,
                        'kode_sampel'  => $fkode_sampel,
                        'kode_uji'     => $kode_uji
                    );

                    $this->Permohonan_model->addDetail_uji($tr_dtl_uji);
                }
                $result = $this->db->query("update dtl_fppc set Deskripsi_contoh='" . $fdeskripsicth . "', jumlah_contoh='" . $fjumlahcth . "', wadah= '" . $fpacking . "',bentuk='" . $fbentuk . "',kode_sampel='" . $fkode_sampel . "'   where row_id=" . $row_id . " and id_kd_lokal=" . $data_ikan . " ");



                if ($result == true) {
                    $this->session->set_flashdata('success', 'updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                $this->editOld($row_id);
            }
        }
    }


    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Sigapkarin : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    public  function Tglindo($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = $this->getBulan(substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

    public function getBulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
    public function getrovbulan($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    public  function filter($word)
    {
        $word = stripslashes(trim($word));
        $word = nl2br($word);
        $word = htmlentities($word, ENT_QUOTES);
        return $word;
    }
}
