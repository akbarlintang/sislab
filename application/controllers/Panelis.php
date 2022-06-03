<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Panelis extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('panelis_model');
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
    function daftarPanelis()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->panelis_model->daftarPanelisCount($searchText);

            $returns = $this->paginationCompress("daftarPanelis/", $count, 10);

            $data['userRecords'] = $this->panelis_model->daftarPanelis($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Data Panelis';

            $this->loadViews("panelis", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahPanelis()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('panelis_model');
            //$data['roles'] = $this->panelis_model->getUserRoles();

            $this->global['pageTitle'] = 'Sislab : Tambah Data Panelis';

            $this->loadViews(
                "tambahPanelis",
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
        $nip_baru = $this->input->post("nip_baru");
        $email = $this->input->post("email");

        if (empty($nip_baru)) {
            $result = $this->panelis_model->checkEmailExists($email);
        } else {
            $result = $this->panelis_model->checkEmailExists($email, $nip_baru);
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
    function tambahPanelisBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nip_baru', 'NIP Baru', 'trim|required|max_length[18]');
            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('panelis', 'Panelis', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('id_jabatan', 'ID Jabatan', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('id_jenjang', 'ID Jenjang', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('kd_gol', 'Kd Gol', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('kd_upt', 'Kd UPT', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('keterangan', 'Keterangan');
            $this->form_validation->set_rules('st_panelis', 'St Panelis', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('pangkat_tmt', 'Perangkat TMT');
            $this->form_validation->set_rules('periode_ak_tmt', 'Periode');
            $this->form_validation->set_rules('awal_ak', 'Awal', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('tplhr', 'TPL', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('tglhr', 'TGL');
            $this->form_validation->set_rules('tgl_berlaku', 'Tanggal Berlaku');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[10]');
            $this->form_validation->set_rules('sts_sync', 'STS Sync', 'trim|required|max_length[10]');

            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|min_length[10]');

            // $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahPanelis();
            } else {
                $nip_baru = $this->input->post('nip_baru');
                $nip = $this->input->post('nip');
                $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
                $panelis = $this->input->post('panelis');
                $alamat = $this->input->post('alamat');
                $id_jabatan = $this->input->post('id_jabatan');
                $id_jenjang = $this->input->post('id_jenjang');
                $kd_gol = $this->input->post('kd_gol');
                $kd_upt = $this->input->post('kd_upt');
                $keterangan = $this->input->post('keterangan');
                $st_panelis = $this->input->post('st_panelis');
                $pangkat_tmt = $this->input->post('pangkat_tmt');
                $periode_ak_tmt = $this->input->post('periode_ak_tmt');
                $awal_ak = $this->input->post('awal_ak');
                $tplhr = $this->input->post('tplhr');
                $tglhr = $this->input->post('tglhr');
                $tgl_berlaku = $this->input->post('tgl_berlaku');
                $status = $this->input->post('status');
                $sts_sync = $this->input->post('sts_sync');

                $email = $this->input->post('email');
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
                $mobile = $this->input->post('no_telp');
                $password = 'password';
                $roleId = 4;

                //$password = $this->input->post('password');
                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));

                // Buat user
                $userInfo = array(
                    'email'=> $email,
                    'password'=> getHashedPassword($password),
                    'roleId'=> $roleId,
                    'name'=> $name,
                    'mobile'=> $mobile,
                    'isDeleted' => 0,
                    'createdBy'=> 1,
                    'createdDtm'=>date('Y-m-d H:i:s'),
                    'updatedBy' => 1,
                    'updatedDtm' => date('Y-m-d H:i:s'),
                    'nip' => $nip,
                );

                $this->load->model('user_model');
                $user_id = $this->user_model->addNewUser($userInfo);

                // Buat panelis
                $infoPanelis = array(
                    'nip_baru' => $nip_baru,
                    'nip' => $nip,
                    'nama' => $nama,
                    'panelis' => $panelis,
                    'alamat' => $alamat,
                    'id_jabatan' => $id_jabatan,
                    'id_jenjang' => $id_jenjang,
                    'kd_gol' => $kd_gol,
                    'kd_upt' => $kd_upt,
                    'keterangan' => $keterangan,
                    'st_panelis' => $st_panelis,
                    'pangkat_tmt' => $pangkat_tmt,
                    'periode_ak_tmt' => $periode_ak_tmt,
                    'awal_ak' => $awal_ak,
                    'tplhr' => $tplhr,
                    'tglhr' => $tglhr,
                    'tgl_berlaku' => $tgl_berlaku,
                    'status' => $status,
                    'sts_sync' => $sts_sync,
                    'user_id' => $user_id,
                    //'password' => getHashedPassword($password),
                    //'roleId' => $roleId, 
                    //'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s')
                );

                $this->load->model('panelis_model');
                $result = $this->panelis_model->tambahPanelisBaru($infoPanelis);

                var_dump($result);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Panelis Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Panelis Baru gagal Ditambahkan');
                }

                redirect('tambahPanelis');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editPanelisLama($nip_baru = NULL)
    {
        if ($this->isAdmin() == TRUE || $nip_baru == 0) {
            $this->loadThis();
        } else {
            if ($nip_baru == null) {
                redirect('daftarPanelis');
            }

            //$data['roles'] = $this->panelis_model->getUserRoles();
            $data['infoPanelis'] = $this->panelis_model->getinfoPanelis($nip_baru);

            $this->global['pageTitle'] = 'Sislab : Edit Data Panelis';

            $this->loadViews("editPanelisLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editPanelis()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $nip_baru = $this->input->post('nip_baru');

            $this->form_validation->set_rules('nip_baru', 'NIP Baru', 'required');
            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('panelis', 'Panelis', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('id_jabatan', 'ID Jabatan', 'required');
            $this->form_validation->set_rules('id_jenjang', 'ID Jenjang', 'required');
            $this->form_validation->set_rules('kd_gol', 'Kd Gol', 'required');
            $this->form_validation->set_rules('kd_upt', 'Kd UPT', 'required');
            $this->form_validation->set_rules('keterangan', 'Keterangan');
            $this->form_validation->set_rules('st_panelis', 'St Panelis', 'required');
            $this->form_validation->set_rules('pangkat_tmt', 'Perangkat TMT', 'required');
            $this->form_validation->set_rules('periode_ak_tmt', 'Periode', 'required');
            $this->form_validation->set_rules('awal_ak', 'Awal', 'required');
            $this->form_validation->set_rules('tplhr', 'TPL', 'required');
            $this->form_validation->set_rules('tglhr', 'TGL', 'required');
            $this->form_validation->set_rules('tgl_berlaku', 'Tanggal Berlaku', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('sts_sync', 'STS Sync', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->editPanelisLama($nip_baru);
            } else {
                $nip_baru = $this->input->post('nip_baru');
                $nip = $this->input->post('nip');
                $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
                $panelis = $this->input->post('panelis');
                $alamat = $this->input->post('alamat');
                $id_jabatan = $this->input->post('id_jabatan');
                $id_jenjang = $this->input->post('id_jenjang');
                $kd_gol = $this->input->post('kd_gol');
                $kd_upt = $this->input->post('kd_upt');
                $keterangan = $this->input->post('keterangan');
                $st_panelis = $this->input->post('st_panelis');
                $pangkat_tmt = $this->input->post('pangkat_tmt');
                $periode_ak_tmt = $this->input->post('periode_ak_tmt');
                $awal_ak = $this->input->post('awal_ak');
                $tplhr = $this->input->post('tplhr');
                $tglhr = $this->input->post('tglhr');
                $tgl_berlaku = $this->input->post('tgl_berlaku');
                $status = $this->input->post('status');
                $sts_sync = $this->input->post('sts_sync');

                $infoPanelis = array(
                    'nip_baru' => $nip_baru,
                    'nip' => $nip,
                    'nama' => $nama,
                    'panelis' => $panelis,
                    'alamat' => $alamat,
                    'id_jabatan' => $id_jabatan,
                    'id_jenjang' => $id_jenjang,
                    'kd_gol' => $kd_gol,
                    'kd_upt' => $kd_upt,
                    'keterangan' => $keterangan,
                    'st_panelis' => $st_panelis,
                    'pangkat_tmt' => $pangkat_tmt,
                    'periode_ak_tmt' => $periode_ak_tmt,
                    'awal_ak' => $awal_ak,
                    'tplhr' => $tplhr,
                    'tglhr' => $tglhr,
                    'tgl_berlaku' => $tgl_berlaku,
                    'status' => $status,
                    'sts_sync' => $sts_sync
                );

                $result = $this->panelis_model->editPanelis($infoPanelis, $nip_baru);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Panelis Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Panelis Gagal Diupdate');
                }

                redirect('daftarPanelis');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePanelis()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $nip_baru = $this->input->post('nip_baru');
            //$infoPanelis = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->panelis_model->deletePanelis(
                $nip_baru
                //$infoPanelis
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Panelis Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Panelis gagal Dihapus');
            }
            return redirect('daftarPanelis');
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

            $data["userInfo"] = $this->panelis_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->panelis_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->panelis_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : User Login History';

            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->panelis_model->getUserInfoWithRole($this->vendorId);
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

            $result = $this->panelis_model->editPanelis($userInfo, $this->vendorId);

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

            $resultPas = $this->panelis_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/' . $active);
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->panelis_model->changePassword($this->vendorId, $usersData);

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
            $result = $this->panelis_model->checkEmailExists($email);
        } else {
            $result = $this->panelis_model->checkEmailExists($email, $userId);
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
