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
class RekapNilai extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekapnilai_model');
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
        $this->global['pageTitle'] = 'Rekap Penilaian';
        $data['data_lhu'] = $this->db->query("SELECT * FROM tbl_fppc")->result_object();
        $this->loadViews("rekapnilai", $this->global, $data, NULL);
    }
    function detail_rekap_penilaian($row_id)
    {
        $data['tbl_fppc'] = $this->db->query("SELECT no_fppc, tgl_fppc FROM tbl_fppc WHERE row_id =" . $row_id . "")->result_array();
        $data['detail_uji'] = $this->db->query("SELECT distinct dtl_hasil_uji.id_kd_lokal,tb_r_ikan_lokal.nm_lokal, dtl_hasil_uji.kode_uji, dtl_hasil_uji.kode_sampel, dtl_hasil_uji.row_id,dtl_hasil_uji.hasil_uji,dtl_hasil_uji.kode_pelanggan,
                dtl_hasil_uji.hasil_uji_keterangan,tbl_parameter_uji.keterangan_uji,tbl_parameter_uji.no_ikm FROM dtl_hasil_uji
            LEFT JOIN tbl_parameter_uji ON dtl_hasil_uji.kode_uji    = tbl_parameter_uji.kode_uji
            left JOIN tb_r_ikan_lokal   ON dtl_hasil_uji.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal

            WHERE row_id =" . $row_id . "")->result_object();
        $data['detail'] = $this->Rekapnilai_model->getdetailfppc($row_id)->result_object();

        $this->global['pageTitle'] = 'Sislab : Detail Pengujian';
        $this->loadViews("detail_rekap_penilaian", $this->global, $data, NULL);
    }

    function rekap_nilai_uji($row_id, $id_kd_lokal)
    {
        $data['id_kd_lokal'] = $id_kd_lokal;
        $data['row_id'] = $row_id;
        $data['penilaian'] = $this->Rekapnilai_model->getPenilaian($row_id, $id_kd_lokal)->result_object();
        $data['detail'] = $this->Rekapnilai_model->getdetailfppc($row_id)->result_object();

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
        // var_dump(array_sum($rataAll));

        $this->global['pageTitle'] = 'Sislab : Rekap Penilaian Hasil Uji';
        $this->loadViews("rekap_nilai_uji", $this->global, $data, NULL);
    }

    function update_hasil_uji()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fhasiluji', 'Hasil Uji', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('fketeranganuji', 'Keterangan Uji', 'trim|required|max_length[128]');
            if ($this->form_validation->run() == TRUE) {
                // dumper('Salalll');
            } else {
                $data_ikan  = $this->input->post('fdata_ikan');
                $row_id     = $this->input->post('frow_id');
                $kode_uji   = $this->input->post('fdata_uji');
                $kode_pelanggan = $this->input->post('fkodepelanggan');

                $fhasil_uji = ucwords(strtolower($this->security->xss_clean($this->input->post('fhasil_uji'))));

                $fketeranganuji = $this->input->post('fketeranganuji');


                $result = $this->db->query("update dtl_hasil_uji set hasil_uji='" . $fhasil_uji . "', hasil_uji_keterangan='" . $fketeranganuji . "', kode_pelanggan = '" . $kode_pelanggan . "'  where row_id=" . $row_id . " and id_kd_lokal=" . $data_ikan . " and  kode_uji=" . $kode_uji . " ");

                if ($result == true) {
                    $this->session->set_flashdata('success', 'updated successfully');
                } else {
                    $this->session->set_flashdata('error', ' updation failed');
                }

                $this->edit_hasil_uji($row_id);
            }
        }
    }

    function printlhu($row_id)
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

        $this->loadViews("page_lhu", $this->global, $data, NULL);
    }


    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Sislab : 404 - Page Not Found';
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
}
