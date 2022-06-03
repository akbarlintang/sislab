<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Pegawai extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai_model');
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
    function daftarPegawai()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->pegawai_model->daftarPegawaiCount($searchText);

            $returns = $this->paginationCompress("daftarPegawai/", $count, 10);

            $data['userRecords'] = $this->pegawai_model->daftarPegawai($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Data Pegawai';

            $this->loadViews("pegawai", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahPegawai()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('pegawai_model');
            //$data['roles'] = $this->pegawai_model->getUserRoles();

            $this->global['pageTitle'] = 'Sislab : Tambah Data Pegawai';

            $this->loadViews(
                "tambahPegawai",
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
            $result = $this->pegawai_model->checkEmailExists($email);
        } else {
            $result = $this->pegawai_model->checkEmailExists($email, $nip_baru);
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
    function tambahPegawaiBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nip_baru', 'NIP Baru', 'required|min_length[10]');
            $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[10]');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('id_jabatan', 'ID Jabatan', 'required|min_length[10]');
            $this->form_validation->set_rules('id_jenjang', 'ID Jenjang', 'required|min_length[10]');
            $this->form_validation->set_rules('kd_gol', 'Kd Gol', 'required|min_length[10]');
            $this->form_validation->set_rules('kd_upt', 'Kd UPT', 'required|min_length[10]');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[10]');
            $this->form_validation->set_rules('st_pegawai', 'St Pegawai', 'required|min_length[10]');
            $this->form_validation->set_rules('pangkat_tmt', 'Perangkat TMT', 'required|min_length[10]');
            $this->form_validation->set_rules('periode_ak_tmt', 'Periode', 'required|min_length[10]');
            $this->form_validation->set_rules('awal_ak', 'Awal', 'required|min_length[10]');
            $this->form_validation->set_rules('tplhr', 'TPL', 'required|min_length[10]');
            $this->form_validation->set_rules('tglhr', 'TGL', 'required|min_length[10]');
            $this->form_validation->set_rules('tgl_berlaku', 'Tanggal Berlaku', 'required|min_length[10]');
            $this->form_validation->set_rules('status', 'Status', 'required|min_length[10]');
            $this->form_validation->set_rules('sts_sync', 'STS Sync', 'required|min_length[10]');

            // $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahPegawai();
            } else {
                $nip_baru = $this->input->post('nip_baru');
                $nip = $this->input->post('nip');
                $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
                $alamat = $this->input->post('alamat');
                $id_jabatan = $this->input->post('id_jabatan');
                $id_jenjang = $this->input->post('id_jenjang');
                $kd_gol = $this->input->post('kd_gol');
                $kd_upt = $this->input->post('kd_upt');
                $keterangan = $this->input->post('keterangan');
                $st_pegawai = $this->input->post('st_pegawai');
                $pangkat_tmt = $this->input->post('pangkat_tmt');
                $periode_ak_tmt = $this->input->post('periode_ak_tmt');
                $awal_ak = $this->input->post('awal_ak');
                $tplhr = $this->input->post('tplhr');
                $tglhr = $this->input->post('tglhr');
                $tgl_berlaku = $this->input->post('tgl_berlaku');
                $status = $this->input->post('status');
                $sts_sync = $this->input->post('sts_sync');

                //$password = $this->input->post('password');
                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoPegawai = array(
                    'nip_baru' => $nip_baru,
                    'nip' => $nip,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'id_jabatan' => $id_jabatan,
                    'id_jenjang' => $id_jenjang,
                    'kd_gol' => $kd_gol,
                    'kd_upt' => $kd_upt,
                    'keterangan' => $keterangan,
                    'st_pegawai' => $st_pegawai,
                    'pangkat_tmt' => $pangkat_tmt,
                    'periode_ak_tmt' => $periode_ak_tmt,
                    'awal_ak' => $awal_ak,
                    'tplhr' => $tplhr,
                    'tglhr' => $tglhr,
                    'tgl_berlaku' => $tgl_berlaku,
                    'status' => $status,
                    'sts_sync' => $sts_sync
                    //'password' => getHashedPassword($password),
                    //'roleId' => $roleId, 
                    //'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s')
                );

                $this->load->model('pegawai_model');
                $result = $this->pegawai_model->tambahPegawaiBaru($infoPegawai);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Pegawai Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Pegawai Baru gagal Ditambahkan');
                }

                redirect('tambahPegawai');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editPegawaiLama($nip_baru = NULL)
    {
        if ($this->isAdmin() == TRUE || $nip_baru == 0) {
            $this->loadThis();
        } else {
            if ($nip_baru == null) {
                redirect('daftarPegawai');
            }

            //$data['roles'] = $this->pegawai_model->getUserRoles();
            $data['infoPegawai'] = $this->pegawai_model->getinfoPegawai($nip_baru);

            $this->global['pageTitle'] = 'Sislab : Edit Data Pegawai';

            $this->loadViews("editPegawaiLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editPegawai()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $nip_baru = $this->input->post('nip_baru');

            $this->form_validation->set_rules('nip_baru', 'NIP Baru', 'required');
            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('id_jabatan', 'ID Jabatan', 'required');
            $this->form_validation->set_rules('id_jenjang', 'ID Jenjang', 'required');
            $this->form_validation->set_rules('kd_gol', 'Kd Gol', 'required');
            $this->form_validation->set_rules('kd_upt', 'Kd UPT', 'required');
            $this->form_validation->set_rules('keterangan', 'Keterangan');
            $this->form_validation->set_rules('st_pegawai', 'St Pegawai', 'required');
            $this->form_validation->set_rules('pangkat_tmt', 'Perangkat TMT', 'required');
            $this->form_validation->set_rules('periode_ak_tmt', 'Periode', 'required');
            $this->form_validation->set_rules('awal_ak', 'Awal', 'required');
            $this->form_validation->set_rules('tplhr', 'TPL', 'required');
            $this->form_validation->set_rules('tglhr', 'TGL', 'required');
            $this->form_validation->set_rules('tgl_berlaku', 'Tanggal Berlaku', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('sts_sync', 'STS Sync', 'required');

            // $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->editPegawaiLama($nip_baru);
            } else {
                $nip_baru = $this->input->post('nip_baru');
                $nip = $this->input->post('nip');
                $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
                $alamat = $this->input->post('alamat');
                $id_jabatan = $this->input->post('id_jabatan');
                $id_jenjang = $this->input->post('id_jenjang');
                $kd_gol = $this->input->post('kd_gol');
                $kd_upt = $this->input->post('kd_upt');
                $keterangan = $this->input->post('keterangan');
                $st_pegawai = $this->input->post('st_pegawai');
                $pangkat_tmt = $this->input->post('pangkat_tmt');
                $periode_ak_tmt = $this->input->post('periode_ak_tmt');
                $awal_ak = $this->input->post('awal_ak');
                $tplhr = $this->input->post('tplhr');
                $tglhr = $this->input->post('tglhr');
                $tgl_berlaku = $this->input->post('tgl_berlaku');
                $status = $this->input->post('status');
                $sts_sync = $this->input->post('sts_sync');

                // $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoPegawai = array(
                    'nip_baru' => $nip_baru,
                    'nip' => $nip,
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'id_jabatan' => $id_jabatan,
                    'id_jenjang' => $id_jenjang,
                    'kd_gol' => $kd_gol,
                    'kd_upt' => $kd_upt,
                    'keterangan' => $keterangan,
                    'st_pegawai' => $st_pegawai,
                    'pangkat_tmt' => $pangkat_tmt,
                    'periode_ak_tmt' => $periode_ak_tmt,
                    'awal_ak' => $awal_ak,
                    'tplhr' => $tplhr,
                    'tglhr' => $tglhr,
                    'tgl_berlaku' => $tgl_berlaku,
                    'status' => $status,
                    'sts_sync' => $sts_sync
                );

                // if (empty($password)) {
                //     $infoPegawai = array(
                //         'email' => $email, 'roleId' => $roleId, 'name' => $name,
                //         'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // } else {
                //     $infoPegawai = array(
                //         'email' => $email, 'password' => getHashedPassword($password), 'roleId' => $roleId,
                //         'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                //         'updatedDtm' => date('Y-m-d H:i:s')
                //     );
                // }

                $result = $this->pegawai_model->editPegawai($infoPegawai, $nip_baru);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Pegawai Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Pegawai Gagal Diupdate');
                }

                redirect('daftarPegawai');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePegawai()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $nip_baru = $this->input->post('nip_baru');
            //$infoPegawai = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->pegawai_model->deletePegawai(
                $nip_baru
                //$infoPegawai
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Pegawai gagal Dihapus');
            }
            return redirect('daftarPegawai');

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

            $data["userInfo"] = $this->pegawai_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->pegawai_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->pegawai_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : User Login History';

            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->pegawai_model->getUserInfoWithRole($this->vendorId);
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

            $result = $this->pegawai_model->editPegawai($userInfo, $this->vendorId);

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

            $resultPas = $this->pegawai_model->matchOldPassword($this->vendorId, $oldPassword);

            if (empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/' . $active);
            } else {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );

                $result = $this->pegawai_model->changePassword($this->vendorId, $usersData);

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
            $result = $this->pegawai_model->checkEmailExists($email);
        } else {
            $result = $this->pegawai_model->checkEmailExists($email, $userId);
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
