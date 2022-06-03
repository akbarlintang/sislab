<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Trader extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trader_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';

        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function daftarTrader()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->trader_model->daftarTraderCount($searchText);

            $returns = $this->paginationCompress("daftarTrader/", $count, 10);

            $data['userRecords'] = $this->trader_model->daftarTrader($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab  :  Daftar Trader';

            $this->loadViews("trader", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahTrader()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('trader_model');
            //$data['roles'] = $this->wadah_model->getUserRoles();

            $this->global['pageTitle'] = 'CodeInsect : Add New User';

            $this->loadViews(
                "tambahTrader",
                $this->global, //$data,
                NULL
            );
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    // function checkEmailExists()
    // {
    //     $id_pelanggan = $this->input->post("id_pelanggan");
    //     $email = $this->input->post("email");

    //     if (empty($id_pelanggan)) {
    //         $result = $this->pelanggan_model->checkEmailExists($email);
    //     } else {
    //         $result = $this->pelanggan_model->checkEmailExists($email, $id_pelanggan);
    //     }

    //     if (empty($result)) {
    //         echo ("true");
    //     } else {
    //         echo ("false");
    //     }
    // }

    /**
     * This function is used to add new user to the system
     */
    function tambahTraderBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nm_trader', 'Nama Trader', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('al_trader', 'Alamat Trader', 'trim|required|max_length[400]');
            $this->form_validation->set_rules('kt_trader', 'Kota Trader', 'trim|required|max_length[4]');
            $this->form_validation->set_rules('kd_negara', 'Kode Negara', 'trim|required|max_length[3]');
            $this->form_validation->set_rules('npwp', 'NPWP', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('no_ktp', 'NO KTP', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('ph_trader', 'PH Trader', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('fx_trader', 'FX Trader', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('im_trader', 'IM Trader', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('no_izin', 'Nomor Izin', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[70]');
            $this->form_validation->set_rules('homepage', 'Home Page', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('id_kel_trader', 'Id Kel Trader', 'trim|required|numeric');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('ili', 'Ili', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('kd_trader_ol', 'Kd Trader Ol', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('jns_id', 'Jenis ID', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('kodepos', 'Kode POS', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('email_pjb', 'Email PJB', 'trim|required|valid_email|max_length[100]');
            $this->form_validation->set_rules('kd_niki', 'Kode NIKI', 'trim|required|numeric');
            $this->form_validation->set_rules('niki', 'NIKI', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('pth', 'PTH', 'required|max_length[1]');
            $this->form_validation->set_rules('date_pth', 'Date PTH', 'required');
            $this->form_validation->set_rules('bdn_usaha', 'Badan USAHA', 'trim|required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahTrader();
            } else {

                $nm_trader = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_trader'))));
                $al_trader = $this->input->post('al_trader');
                $kt_trader = $this->input->post('kt_trader');
                $kd_negara = $this->input->post('kd_negara');
                $npwp = $this->input->post('npwp');
                $no_ktp = $this->input->post('no_ktp');
                $ph_trader = $this->input->post('ph_trader');
                $fx_trader = $this->input->post('fx_trader');
                $im_trader = $this->input->post('im_trader');
                $no_izin = $this->input->post('no_izin');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $homepage = $this->input->post('homepage');
                $id_kel_trader = $this->input->post('id_kel_trader');
                $keterangan = $this->input->post('keterangan');
                $status = $this->input->post('status');
                $ili = $this->input->post('ili');
                $aktif = $this->input->post('aktif');
                $kd_trader_ol = $this->input->post('kd_trader_ol');
                $jns_id = $this->input->post('jns_id');
                $kodepos = $this->input->post('kodepos');
                $email_pjb = strtolower($this->security->xss_clean($this->input->post('email_pjb')));
                $kd_niki = $this->input->post('kd_niki');
                $niki = $this->input->post('niki');
                $pth = $this->input->post('pth');
                $date_pth = $this->input->post('date_pth');
                $bdn_usaha = $this->input->post('bdn_usaha');
            
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $telepon = $this->security->xss_clean($this->input->post('telepon'));
                // $alamat = $this->input->post('alamat');
                // $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoTrader = array(
                    'nm_trader' => $nm_trader,
                    'al_trader' => $al_trader,
                    'kt_trader' => $kt_trader,
                    'kd_negara' => $kd_negara,
                    'npwp' => $npwp,
                    'no_ktp' => $no_ktp,
                    'al_trader' => $al_trader,
                    'ph_trader' => $ph_trader,
                    'fx_trader' => $fx_trader,
                    'im_trader' => $im_trader,
                    'no_izin' => $no_izin,
                    'email' => $email,
                    'homepage' => $homepage,
                    'id_kel_trader' => $id_kel_trader,
                    'keterangan' => $keterangan,
                    'status' => $status,
                    'ili' => $ili,
                    'aktif' => $aktif,
                    'kd_trader_ol' => $kd_trader_ol,
                    'jns_id' => $jns_id,
                    'kodepos' => $kodepos,
                    'email_pjb' => $email_pjb,
                    'kd_niki' => $kd_niki,
                    'niki' => $niki,
                    'pth' => $al_trader,
                    'date_pth' => date('Y-m-d H:i:s'),
                    'bdn_usaha' => $bdn_usaha
                     // 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s')
                );

                $this->load->model('trader_model');
                $result = $this->trader_model->tambahTraderBaru($infoTrader);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Trader Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Trader Baru gagal Ditambahkan');
                }

                redirect('tambahTrader');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editTraderLama($id_trader = NULL)
    {
        if ($this->isAdmin() == TRUE || $id_trader == 0) {
            $this->loadThis();
        } else {
            if ($id_trader == null) {
                redirect('daftarTrader');
            }

            //$data['roles'] = $this->pelanggan_model->getUserRoles();
            $data['infoTrader'] = $this->trader_model->getinfoTrader($id_trader);

            $this->global['pageTitle'] = 'Sislab : Edit Trader';

            $this->loadViews("editTraderLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editTrader()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id_trader = $this->input->post('id_trader');

            $this->form_validation->set_rules('nm_trader', 'Nama Trader', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('al_trader', 'Alamat Trader', 'trim|required|max_length[400]');
            $this->form_validation->set_rules('kt_trader', 'Kota Trader', 'trim|required|max_length[4]');
            $this->form_validation->set_rules('kd_negara', 'Kode Negara', 'trim|required|max_length[3]');
            $this->form_validation->set_rules('npwp', 'NPWP', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('no_ktp', 'NO KTP', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('ph_trader', 'PH Trader', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('fx_trader', 'FX Trader', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('im_trader', 'IM Trader', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('no_izin', 'Nomor Izin', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[70]');
            $this->form_validation->set_rules('homepage', 'Home Page', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('id_kel_trader', 'Id Kel Trader', 'trim|required|numeric');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('ili', 'Ili', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|max_length[1]');
            $this->form_validation->set_rules('kd_trader_ol', 'Kd Trader Ol', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('jns_id', 'Jenis ID', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('kodepos', 'Kode POS', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('email_pjb', 'Email PJB', 'trim|required|valid_email|max_length[100]');
            $this->form_validation->set_rules('kd_niki', 'Kode NIKI', 'trim|required|numeric');
            $this->form_validation->set_rules('niki', 'NIKI', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('pth', 'PTH', 'required|max_length[1]');
            $this->form_validation->set_rules('date_pth', 'Date PTH', 'required');
            $this->form_validation->set_rules('bdn_usaha', 'Badan USAHA', 'trim|required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->editTraderLama($id_trader);
            } else {
                $nm_trader = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_trader'))));
                $al_trader = $this->input->post('al_trader');
                $kt_trader = $this->input->post('kt_trader');
                $kd_negara = $this->input->post('kd_negara');
                $npwp = $this->input->post('npwp');
                $no_ktp = $this->input->post('no_ktp');
                $ph_trader = $this->input->post('ph_trader');
                $fx_trader = $this->input->post('fx_trader');
                $im_trader = $this->input->post('im_trader');
                $no_izin = $this->input->post('no_izin');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $homepage = $this->input->post('homepage');
                $id_kel_trader = $this->input->post('id_kel_trader');
                $keterangan = $this->input->post('keterangan');
                $status = $this->input->post('status');
                $ili = $this->input->post('ili');
                $aktif = $this->input->post('aktif');
                $kd_trader_ol = $this->input->post('kd_trader_ol');
                $jns_id = $this->input->post('jns_id');
                $kodepos = $this->input->post('kodepos');
                $email_pjb = strtolower($this->security->xss_clean($this->input->post('email_pjb')));
                $kd_niki = $this->input->post('kd_niki');
                $niki = $this->input->post('niki');
                $pth = $this->input->post('pth');
                $date_pth = $this->input->post('date_pth');
                $bdn_usaha = $this->input->post('bdn_usaha');

                $infoTrader = array(
                    'nm_trader' => $nm_trader,
                    'al_trader' => $al_trader,
                    'kt_trader' => $kt_trader,
                    'kd_negara' => $kd_negara,
                    'npwp' => $npwp,
                    'no_ktp' => $no_ktp,
                    'al_trader' => $al_trader,
                    'ph_trader' => $ph_trader,
                    'fx_trader' => $fx_trader,
                    'im_trader' => $im_trader,
                    'no_izin' => $no_izin,
                    'email' => $email,
                    'homepage' => $homepage,
                    'id_kel_trader' => $id_kel_trader,
                    'keterangan' => $keterangan,
                    'status' => $status,
                    'ili' => $ili,
                    'aktif' => $aktif,
                    'kd_trader_ol' => $kd_trader_ol,
                    'jns_id' => $jns_id,
                    'kodepos' => $kodepos,
                    'email_pjb' => $email_pjb,
                    'kd_niki' => $kd_niki,
                    'niki' => $niki,
                    'pth' => $al_trader,
                    'date_pth' => date('Y-m-d H:i:s'),
                    'bdn_usaha' => $bdn_usaha
                );

                // if (empty($password)) {
                //     $infoPelanggan = array(
                //         'email' => $email, 'roleId' => $roleId, 'name' => $name,
                //         'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // } else {
                //     $infoPelanggan = array(
                //         'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                //         'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                //         'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // }

                $result = $this->trader_model->editTrader($infoTrader, $id_trader);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Trader Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Trader Gagal Diupdate');
                }

                redirect('daftarTrader');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTrader()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id_trader = $this->input->post('id_trader');
            //$infoPelanggan = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->trader_model->deleteTrader(
                $id_trader
                //$infoPelanggan
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Trader Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Trader gagal Dihapus');
            }
            return redirect('daftarTrader');

            // if ($result > 0) {
            //     echo (json_encode(array('status' => TRUE)));
            // } else {
            //     echo (json_encode(array('status' => FALSE)));
            // }
        }
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->pelanggan_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->pelanggan_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->pelanggan_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : User Login History';

            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->pelanggan_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;

        $this->global['pageTitle'] = $active == "details" ? 'CodeInsect : My Profile' : 'CodeInsect : Change Password';
        $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_emailExists');

        if ($this->form_validation->run() == FALSE) {
            $this->profile($active);
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));

            $userInfo = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $result = $this->pelanggan_model->editPelanggan($userInfo, $this->vendorId);

            if ($result == true) {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/' . $active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword', 'Old password', 'required|max_length[20]');
        $this->form_validation->set_rules('newPassword', 'New password', 'required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword', 'Confirm new password', 'required|matches[newPassword]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->profile($active);
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->pelanggan_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/' . $active);
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->pelanggan_model->changePassword($this->vendorId, $usersData);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Password updation successful');
                } else {
                    $this->session->set_flashdata('error', 'Password updation failed');
                }

                redirect('profile/' . $active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if (empty($userId)) {
            $result = $this->pelanggan_model->checkEmailExists($email);
        } else {
            $result = $this->pelanggan_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            $return = true;
        } else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}
