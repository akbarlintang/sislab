<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Agus Widjanarko
 * @version : 1.1
 * @since : 15 November 2016
 */
class Settinglhu extends BaseController
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
    function index()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Setting LHU';
            $datas['settinglhu'] = $this->db->query("SELECT * FROM setting_lhu ")->result_object();
            $this->loadViews("Settinglhu", $this->global, $datas, NULL);
        }
    }

    function update($no)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $datas['tr_petugas'] = $this->db2->query("SELECT * FROM tb_r_pegawai where status <> 0 ")->result_object();
            $datas['settinglhu'] = $this->db->query("SELECT * FROM setting_lhu where no=" . $no . " ")->result_object();
            $this->global['pageTitle'] = 'Sislab : Setting LHU';
            $this->loadViews("addNew_setting", $this->global, $datas, NULL);
        }
    }

    function update_setingan()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $no  = $this->input->post('frow_id');
            $nm_penandatangan     = $this->input->post('fnm');
            $pj_penandatangan = $this->input->post('fpj');
            $nip = $this->input->post('fnip');


            $result = $this->db->query("update Setting_lhu set nm_penandatangan='" . $nm_penandatangan . "', pj_penandatangan='" . $pj_penandatangan . "', nip='" . $nip . "'  where no=" . $no . " ");



            if ($result == true) {
                $this->session->set_flashdata('success', 'updated successfully');
            } else {
                $this->session->set_flashdata('error', ' updation failed');
            }

            redirect('Settinglhu');
        }
    }


    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Sislab : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
