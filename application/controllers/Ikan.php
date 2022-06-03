<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Ikan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ikan_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Sislab : Dashboard';

        $this->loadViews("dashboard", $this->global, NULL, NULL);
    }

    /**
     * This function is used to load the user list
     */
    function daftarIkan()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->ikan_model->daftarIkanCount($searchText);

            $returns = $this->paginationCompress("daftarIkan/", $count, 10);

            $data['userRecords'] = $this->ikan_model->daftarIkan($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Ikan ';

            $this->loadViews("ikan", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahIkan()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('ikan_model');
            //$data['roles'] = $this->ikan_model->getUserRoles();

            $this->global['pageTitle'] = 'Sislab : Add Data Ikan';

            $this->loadViews(
                "tambahIkan",
                $this->global, //$data,
                NULL
            );
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $id_kd_lokal = $this->input->post("id_kd_lokal");
        $email = $this->input->post("email");

        if (empty($id_kd_lokal)) {
            $result = $this->ikan_model->checkEmailExists($email);
        } else {
            $result = $this->ikan_model->checkEmailExists($email, $id_kd_lokal);
        }

        if (empty($result)) {
            echo ("true");
        } else {
            echo ("false");
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function tambahIkanBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nm_lokal', 'Nama Lokal', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('nm_umum', 'Nama Umum', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('nm_latin', 'Nama Latin', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('kd_ikan', 'Kode Ikan', 'required');
            $this->form_validation->set_rules('id_ikan', 'ID Ikan', 'required');
            $this->form_validation->set_rules('id_kel_ikan', 'ID Kel Ikan', 'required');
            $this->form_validation->set_rules('kd_jenis_kel', 'Kode Jenis Kel', 'required');
            $this->form_validation->set_rules('kd_tarif', 'Kode Tarif');
            $this->form_validation->set_rules('kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('kelompok', 'Kelompok', 'required');
            $this->form_validation->set_rules('konsumsi', 'Konsumsi', 'required');
            $this->form_validation->set_rules('tawar', 'Tawar', 'required');
            $this->form_validation->set_rules('hidup', 'Hidup', 'required');
            $this->form_validation->set_rules('bentuk', 'Bentuk', 'required');
            $this->form_validation->set_rules('hias', 'Hias', 'required');
            $this->form_validation->set_rules('pelagis', 'Pelagis');
            $this->form_validation->set_rules('status', 'Status');
            $this->form_validation->set_rules('hscode', 'hscode', 'required');
            $this->form_validation->set_rules('no_urut_hs', 'no urut hs', 'required');
            $this->form_validation->set_rules('aktif', 'Aktif', 'required');
            $this->form_validation->set_rules('kd_ikan_lokal_ol', 'kd ikan lokal ol', 'required');
            $this->form_validation->set_rules('nilai', 'Nilai', 'required');
            $this->form_validation->set_rules('id_satuan', 'ID Satuan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahIkan();
            } else {
                $nm_lokal = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_lokal'))));
                $nm_umum = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_umum'))));
                $nm_latin = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_latin'))));
                $kd_ikan = $this->input->post('kd_ikan');
                $id_ikan = $this->input->post('id_ikan');
                $id_kel_ikan = $this->input->post('id_kel_ikan');
                $kd_jenis_kel = $this->input->post('kd_jenis_kel');
                $kd_tarif = $this->input->post('kd_tarif');
                $kelas = $this->input->post('kelas');
                $kelompok = $this->input->post('kelompok');
                $konsumsi = $this->input->post('konsumsi');
                $tawar = $this->input->post('tawar');
                $hidup = $this->input->post('hidup');
                $bentuk = $this->input->post('bentuk');
                $hias = $this->input->post('hias');
                $pelagis = $this->input->post('pelagis');
                $status = $this->input->post('status');
                $hscode = $this->input->post('hscode');
                $no_urut_hs = $this->input->post('no_urut_hs');
                $aktif = $this->input->post('aktif');
                $kd_ikan_lokal_ol = $this->input->post('kd_ikan_lokal_ol');
                $nilai = $this->input->post('nilai');
                $id_satuan = $this->input->post('id_satuan');

                $infoIkan = array(
                    'nm_lokal' => $nm_lokal,
                    'nm_umum' => $nm_umum,
                    'nm_latin' => $nm_latin,
                    'kd_ikan' => $kd_ikan,
                    'id_ikan' => $id_ikan,
                    'id_kel_ikan' => $id_kel_ikan,
                    'kd_jenis_kel' => $kd_jenis_kel,
                    'kd_tarif' => $kd_tarif,
                    'kelas' => $kelas,
                    'kelompok' => $kelompok,
                    'konsumsi' => $konsumsi,
                    'tawar' => $tawar,
                    'hidup' => $hidup,
                    'bentuk' => $bentuk,
                    'hias' => $hias,
                    'pelagis' => $pelagis,
                    'status' => $status,
                    'hscode' => $hscode,
                    'no_urut_hs' => $no_urut_hs,
                    'aktif' => $aktif,
                    'kd_ikan_lokal_ol' => $kd_ikan_lokal_ol,
                    'nilai' => $nilai,
                    'id_satuan' => $id_satuan

                );

                $this->load->model('ikan_model');
                $result = $this->ikan_model->tambahIkanBaru($infoIkan);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Ikan Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Ikan Baru gagal Ditambahkan');
                }

                redirect('tambahIkan');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editIkanLama($id_kd_lokal = NULL)
    {
        if ($this->isAdmin() == TRUE || $id_kd_lokal == 0) {
            $this->loadThis();
        } else {
            if ($id_kd_lokal == null) {
                redirect('daftarIkan');
            }

            //$data['roles'] = $this->ikan_model->getUserRoles();
            $data['infoIkan'] = $this->ikan_model->getinfoIkan($id_kd_lokal);

            $this->global['pageTitle'] = 'Sislab : Edit Data Ikan ';

            $this->loadViews("editIkanLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editIkan()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id_kd_lokal = $this->input->post('id_kd_lokal');

            $this->form_validation->set_rules('nm_lokal', 'Nama Lokal', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('nm_umum', 'Nama Umum', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('nm_latin', 'Nama Latin', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('kd_ikan', 'Kode Ikan', 'required');
            $this->form_validation->set_rules('id_ikan', 'ID Ikan', 'required');
            $this->form_validation->set_rules('id_kel_ikan', 'ID Kel Ikan', 'required');
            $this->form_validation->set_rules('kd_jenis_kel', 'Kode Jenis Kel', 'required');
            $this->form_validation->set_rules('kd_tarif', 'Kode Tarif');
            $this->form_validation->set_rules('kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('kelompok', 'Kelompok', 'required');
            $this->form_validation->set_rules('konsumsi', 'Konsumsi', 'required');
            $this->form_validation->set_rules('tawar', 'Tawar', 'required');
            $this->form_validation->set_rules('hidup', 'Hidup', 'required');
            $this->form_validation->set_rules('bentuk', 'Bentuk', 'required');
            $this->form_validation->set_rules('hias', 'Hias', 'required');
            $this->form_validation->set_rules('pelagis', 'Pelagis');
            $this->form_validation->set_rules('status', 'Status');
            $this->form_validation->set_rules('hscode', 'hscode', 'required');
            $this->form_validation->set_rules('no_urut_hs', 'no urut hs', 'required');
            $this->form_validation->set_rules('aktif', 'Aktif', 'required');
            $this->form_validation->set_rules('kd_ikan_lokal_ol', 'kd ikan lokal ol', 'required');
            $this->form_validation->set_rules('nilai', 'Nilai', 'required');
            $this->form_validation->set_rules('id_satuan', 'ID Satuan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editIkanLama($id_kd_lokal);
            } else {
                $nm_lokal = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_lokal'))));
                $nm_umum = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_umum'))));
                $nm_latin = ucwords(strtolower($this->security->xss_clean($this->input->post('nm_latin'))));
                $kd_ikan = $this->input->post('kd_ikan');
                $id_ikan = $this->input->post('id_ikan');
                $id_kel_ikan = $this->input->post('id_kel_ikan');
                $kd_jenis_kel = $this->input->post('kd_jenis_kel');
                $kd_tarif = $this->input->post('kd_tarif');
                $kelas = $this->input->post('kelas');
                $kelompok = $this->input->post('kelompok');
                $konsumsi = $this->input->post('konsumsi');
                $tawar = $this->input->post('tawar');
                $hidup = $this->input->post('hidup');
                $bentuk = $this->input->post('bentuk');
                $hias = $this->input->post('hias');
                $pelagis = $this->input->post('pelagis');
                $status = $this->input->post('status');
                $hscode = $this->input->post('hscode');
                $no_urut_hs = $this->input->post('no_urut_hs');
                $aktif = $this->input->post('aktif');
                $kd_ikan_lokal_ol = $this->input->post('kd_ikan_lokal_ol');
                $nilai = $this->input->post('nilai');
                $id_satuan = $this->input->post('id_satuan');

                $infoIkan = array(
                    'nm_lokal' => $nm_lokal,
                    'nm_umum' => $nm_umum,
                    'nm_latin' => $nm_latin,
                    'kd_ikan' => $kd_ikan,
                    'id_ikan' => $id_ikan,
                    'id_kel_ikan' => $id_kel_ikan,
                    'kd_jenis_kel' => $kd_jenis_kel,
                    'kd_tarif' => $kd_tarif,
                    'kelas' => $kelas,
                    'kelompok' => $kelompok,
                    'konsumsi' => $konsumsi,
                    'tawar' => $tawar,
                    'hidup' => $hidup,
                    'bentuk' => $bentuk,
                    'hias' => $hias,
                    'pelagis' => $pelagis,
                    'status' => $status,
                    'hscode' => $hscode,
                    'no_urut_hs' => $no_urut_hs,
                    'aktif' => $aktif,
                    'kd_ikan_lokal_ol' => $kd_ikan_lokal_ol,
                    'nilai' => $nilai,
                    'id_satuan' => $id_satuan,
                );

                // if (empty($password)) {
                //     $infoIkan = array(
                //         'email' => $email, 'roleId' => $roleId, 'name' => $name,
                //         'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // } else {
                //     $infoIkan = array(
                //         'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                //         'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                //         'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // }

                $result = $this->ikan_model->editIkan($infoIkan, $id_kd_lokal);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Ikan Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Ikan Gagal Diupdate');
                }

                redirect('daftarIkan');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteIkan()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id_kd_lokal = $this->input->post('id_kd_lokal');
            //$infoIkan = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->ikan_model->deleteIkan(
                $id_kd_lokal
                //$infoIkan
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Ikan Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Ikan gagal Dihapus');
            }
            return redirect('daftarIkan');

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
        $this->global['pageTitle'] = 'Sislab : 404 - Page Not Found';

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

            $data["userInfo"] = $this->ikan_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->ikan_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->ikan_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : User Login History';

            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->ikan_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;

        $this->global['pageTitle'] = $active == "details" ? 'Sislab : My Profile' : 'Sislab : Change Password';
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

            $result = $this->ikan_model->editIkan($userInfo, $this->vendorId);

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

            $resultPas = $this->ikan_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/' . $active);
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->ikan_model->changePassword($this->vendorId, $usersData);

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
            $result = $this->ikan_model->checkEmailExists($email);
        } else {
            $result = $this->ikan_model->checkEmailExists($email, $userId);
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
