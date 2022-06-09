<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Penilaian extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penilaian_model');
        $this->db2 = $this->load->database('my_sqlsrv', TRUE);
        $this->load->database();
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Sislab : Penilaian';
        $var = $this->session->userdata;
        $userId = $var['userId'];
        $data['fppc'] = $this->db->query("SELECT * FROM tbl_fppc Where sts_print=0 ORDER BY row_id DESC")->result_object();

        $this->loadViews("penilaian", $this->global, $data, NULL);
    }

    function detail($row_id)
    {
        $data['Detail_Permohonan'] = $this->Penilaian_model->getdetailfppc($row_id)->result_object();
        $this->global['pageTitle'] = 'Sislab : Detail Penilaian';
        $this->loadViews("detail_Penilaian", $this->global, $data, NULL);
    }

    function addNew_Form_Nilai($row_id, $id_kd_lokal)
    {
        // Get panelis_id
        $var = $this->session->userdata;
        $this->db->where('user_id', $var['userId']);
        $q = $this->db->get('tb_r_panelis');
        $data = $q->result_array();
        $panelis_id = $data[0]['id'];

        $data['id_kd_lokal'] = $id_kd_lokal;
        $data['row_id'] = $row_id;
        $data['Detail_Permohonan'] = $this->Penilaian_model->getNilaifppc($row_id, $id_kd_lokal)->result_object();
        $data['organoleptik'] = $this->Penilaian_model->daftarOrganoleptik()->result_object();
        $data['penilaian'] = $this->Penilaian_model->getPenilaian($row_id, $id_kd_lokal, $panelis_id)->result_object();

        $this->global['pageTitle'] = 'Sislab : Tambah Nilai FPPC';
        $this->loadViews("addNew_Fppc_nilai", $this->global, $data, NULL);
    }

    function tambah_nilai($row_id, $id_kd_lokal)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('mata', 'Mata', 'required');
        $this->form_validation->set_rules('insang', 'Insang', 'required');
        $this->form_validation->set_rules('lendir', 'Lendir', 'required');
        $this->form_validation->set_rules('daging', 'Daging', 'required');
        $this->form_validation->set_rules('bau', 'Bau', 'required');
        $this->form_validation->set_rules('tekstur', 'Tekstur', 'required');

        // var_dump($this->input->post('tekstur'));

        // Get panelis_id
        $var = $this->session->userdata;
        $this->db->where('user_id', $var['userId']);
        $q = $this->db->get('tb_r_panelis');
        $data = $q->result_array();
        $panelis_id = $data[0]['id'];

        if ($this->form_validation->run() == FALSE) {
            $this->addNew_Form_Nilai($row_id, $id_kd_lokal);
        } else {
            $mata = $this->input->post('mata');
            $insang = $this->input->post('insang');
            $lendir = $this->input->post('lendir');
            $daging = $this->input->post('daging');
            $bau = $this->input->post('bau');
            $tekstur = $this->input->post('tekstur');

            $nilai = array(
                'permohonan_id' => $row_id,
                'id_kd_lokal' => $id_kd_lokal,
                'panelis_id' => $panelis_id,
                'mata' => $mata,
                'insang' => $insang,
                'lendir' => $lendir,
                'daging' => $daging,
                'bau' => $bau,
                'tekstur' => $tekstur,
            );

            $cek = $this->Penilaian_model->getPenilaian($row_id, $id_kd_lokal, $panelis_id)->result_object();

            if (count($cek) > 0) {
                $result = $this->Penilaian_model->updateNilai($row_id, $id_kd_lokal, $panelis_id, $nilai);
            }  else {
                $result = $this->Penilaian_model->tambahNilaiBaru($nilai);
            }

            // Update hasil akhir
            $data['penilaian'] = $this->Penilaian_model->getHasil($row_id, $id_kd_lokal)->result_object();
            $avg_val = [];
            foreach ($data['penilaian'] as $val) {
                $par = array($val->mata, $val->insang, $val->lendir, $val->daging, $val->bau, $val->tekstur);
                // Rata-rata per row
                $count = count($par);
                $avg = number_format((float)(array_sum($par) / $count), 2, '.', '');
                array_push($avg_val, $avg);
            }

            // Hitung hasil akhir (Total rata-rata dibagi jumlah penilaian)
            $hasil = array_sum($avg_val) / count($data['penilaian']);
            $hasil = number_format((float)($hasil), 2, '.', '');
            
            $hasil_uji = array(
                'hasil_uji' => $hasil,
            );

            // Insert hasil akhir ke tabel dtl_hasil_uji
            $cekHasil = $this->Penilaian_model->insertHasil($row_id, $id_kd_lokal, $hasil_uji);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Nilai Baru Berhasil Ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Nilai Baru gagal Ditambahkan');
            }

            redirect('Penilaian/addNew_Form_Nilai/'.$row_id.'/'.$id_kd_lokal);
        }
    }

    function printrekap($row_id, $id_kd_lokal)
    {

        $this->global['pageTitle'] = 'Sislab : Laporan Hasil Uji';
        $data['tr_setting'] = $this->db->query("SELECT * FROM setting_lhu")->result_array();
        $data['tr_mst_fppc']    = $this->db->query("SELECT * FROM tbl_fppc WHERE row_id=" . $row_id . "  ")->result_array();

        $id_ppk = $data['tr_mst_fppc'][0]['id_ppk'];
        $data['tr_pelanggan']    = $this->db->query("SELECT 
            tb_r_trader.kt_trader,
            tbl_fppc.id_trader,
            tb_propinsi.nm_propinsi,
            tb_r_trader.nm_trader,
            tb_r_trader.al_trader
            FROM
            tb_r_trader
            LEFT JOIN tb_propinsi ON tb_r_trader.kt_trader = tb_propinsi.kd_propinsi
            LEFT JOIN tbl_fppc ON tbl_fppc.id_trader = tb_r_trader.id_trader WHERE row_id=" . $row_id . "  ")->result_array();

        $data['hasil_uji'] = $this->db->query("SELECT
            dtl_hasil_uji.hasil_uji_keterangan,
            dtl_hasil_uji.hasil_uji,
            dtl_hasil_uji.row_id,
            dtl_hasil_uji.kode_sampel,
            dtl_hasil_uji.kode_uji,
            dtl_hasil_uji.id_kd_lokal,
            dtl_hasil_uji.kode_pelanggan,

            tb_r_ikan_lokal.nm_lokal,
            tb_r_ikan_lokal.nm_latin,
            tbl_parameter_uji.jenis_parameter,
            tbl_parameter_uji.no_ikm,
            tbl_parameter_uji.keterangan_uji,
            tbl_parameter_uji.standar_uji

            FROM
            dtl_hasil_uji
            LEFT JOIN tb_r_ikan_lokal ON dtl_hasil_uji.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal
            LEFT JOIN tbl_parameter_uji ON dtl_hasil_uji.kode_uji = tbl_parameter_uji.kode_uji WHERE row_id=" . $row_id . " ")->result_object();

        $data['tr_dtl_fppc']    =  $this->db->query("SELECT * FROM dtl_fppc WHERE row_id=" . $row_id . "  ")->result_object();
        $data['jenis_sampel']    =  $this->db->query("SELECT tb_r_ikan_lokal.nm_lokal,dtl_fppc.id_kd_lokal,dtl_fppc.row_id FROM tb_r_ikan_lokal RIGHT JOIN dtl_fppc ON dtl_fppc.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal WHERE row_id=" . $row_id . "  ")->result_object();
        //dumper($data['tr_dtl_fppc']);

        $data['penilaian'] = $this->db->query("SELECT * FROM tbl_nilai LEFT JOIN tb_r_panelis ON tbl_nilai.panelis_id = tb_r_panelis.id WHERE permohonan_id =" .$row_id. " AND id_kd_lokal =" .$id_kd_lokal . " ")->result_object();

        $total = 0;
        $rataAll = [];
        $sum_val = [];
        $avg_val = [];
        foreach ($data['penilaian'] as $val) {
            $par = array($val->mata, $val->insang, $val->lendir, $val->daging, $val->bau, $val->tekstur);

            // Jumlah per row
            $sum = array_sum($par);
            array_push($sum_val, $sum);

            // Rata-rata per row
            $count = count($par);
            $avg = number_format((float)($sum / $count), 2, '.', '');
            array_push($avg_val, $avg);

            // Total rata-rata
            $total = (array_sum($par) / count($par));
            $total = number_format((float)($total), 2, '.', '');
            $rata = $total / count($data['penilaian']);
            array_push($rataAll, $rata);
        }

        $data['sum_val'] = $sum_val;
        $data['avg_val'] = $avg_val;
        $data['total_rata'] = number_format((float)(array_sum($rataAll)), 2, '.', '');

        $this->loadViews("page_rekap", $this->global, $data, NULL);
    }
}
