<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Permintaan_uji extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('permintaan_uji_model');
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
    function daftarPermintaan_uji()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->permintaan_uji_model->daftarPermintaan_ujiCount($searchText);

            $returns = $this->paginationCompress("daftarPermintaan_uji/", $count, 10);

            $data['userRecords'] = $this->permintaan_uji_model->daftarPermintaan_uji($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Permintaan_uji';

            $this->loadViews("permintaan_uji", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahPermintaan_uji()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('permintaan_uji_model');
            //$data['roles'] = $this->permintaan_uji_model->getUserRoles();

            $this->global['pageTitle'] = 'Sislab : Tambah Data Permintaan_uji';

            $this->loadViews(
                "tambahPermintaan_uji",
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
    function tambahPermintaan_ujiBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('kode_uji', 'Kode Uji', 'trim|required|numeric');
            $this->form_validation->set_rules('jenis_parameter', 'Jenis Parameter', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('no_ikm', 'No IKM', 'required');
            $this->form_validation->set_rules('keterangan_uji', 'Keterangan Uji', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('standar_uji', 'Standar Uji', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('telepon', 'No Telepon', 'required|min_length[10]');
            // $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahPermintaan_uji();
            } else {
                $kode_uji = $this->security->xss_clean($this->input->post('kode_uji'));
                $jenis_parameter = ucwords(strtolower($this->security->xss_clean($this->input->post('jenis_parameter'))));
                $no_ikm = $this->input->post('no_ikm');
                $keterangan_uji = $this->input->post('keterangan_uji');
                $standar_uji = $this->input->post('standar_uji');
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $telepon = $this->security->xss_clean($this->input->post('telepon'));
                // $alamat = $this->input->post('alamat');
                //$password = $this->input->post('password');
                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoPermintaan_uji = array(
                    'kode_uji' => $kode_uji,
                    'jenis_parameter' => $jenis_parameter,
                    'no_ikm' => $no_ikm,
                    'keterangan_uji' => $keterangan_uji,
                    'standar_uji' => $standar_uji,
                    // 'email' => $email,
                    // 'telepon' => $telepon,
                    // 'alamat' => $alamat,
                    //'password' => getHashedPassword($password),
                    //'roleId' => $roleId, 
                    //'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s')
                );

                $this->load->model('permintaan_uji_model');
                $result = $this->permintaan_uji_model->tambahPermintaan_ujiBaru($infoPermintaan_uji);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Permintaan uji Baru Berhasil Ditambahkan');
                } else {
                    // $this->session->set_flashdata('error', 'Permintaan uji Baru gagal Ditambahkan');
                    $this->session->set_flashdata('success', 'Permintaan uji Baru Berhasil Ditambahkan');
                }

                redirect('tambahPermintaan_uji');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editPermintaan_ujiLama($kode_uji = NULL)
    {
        if ($this->isAdmin() == TRUE || $kode_uji == 0) {
            $this->loadThis();
        } else {
            if ($kode_uji == null) {
                redirect('daftarPermintaan_uji');
            }

            //$data['roles'] = $this->pelanggan_model->getUserRoles();
            $data['infoPermintaan_uji'] = $this->permintaan_uji_model->getinfoPermintaan_uji($kode_uji);

            $this->global['pageTitle'] = 'Sislab : Edit Data Permintaan_uji';

            $this->loadViews("editPermintaan_ujiLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editPermintaan_uji()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $kode_uji = $this->input->post('kode_uji');
            $this->form_validation->set_rules('jenis_parameter', 'Jenis Parameter', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('no_ikm', 'No IKM', 'required');
            $this->form_validation->set_rules('keterangan_uji', 'Keterangan Uji', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('standar_uji', 'Standar Uji', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('telepon', 'No Telepon', 'required|min_length[10]');
            // $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->editPermintaan_ujiLama($kode_uji);
            } else {
                $kode_uji = $this->security->xss_clean($this->input->post('kode_uji'));
                $jenis_parameter = ucwords(strtolower($this->security->xss_clean($this->input->post('jenis_parameter'))));
                $no_ikm = $this->input->post('no_ikm');
                $keterangan_uji = $this->input->post('keterangan_uji');
                $standar_uji = $this->input->post('standar_uji');
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $telepon = $this->security->xss_clean($this->input->post('telepon'));
                // $alamat = $this->input->post('alamat');
                // $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoPermintaan_uji = array(
                    'kode_uji' => $kode_uji,
                    'jenis_parameter' => $jenis_parameter,
                    'no_ikm' => $no_ikm,
                    'keterangan_uji' => $keterangan_uji,
                    'standar_uji' => $standar_uji
                    // 'email' => $email,
                    // 'telepon' => $telepon,
                    // 'alamat' => $alamat,
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

                $result = $this->permintaan_uji_model->editPermintaan_uji($infoPermintaan_uji, $kode_uji);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Permintaan_uji Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Permintaan_uji Gagal Diupdate');
                }

                redirect('daftarPermintaan_uji');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePermintaan_uji()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $kode_uji = $this->input->post('kode_uji');
            //$infoPelanggan = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->permintaan_uji_model->deletePermintaan_uji(
                $kode_uji
                //$infoPelanggan
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Permintaan_uji Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Permintaan_uji gagal Dihapus');
            }
            return redirect('daftarPermintaan_uji');

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

            $data["userInfo"] = $this->pelanggan_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;

            $this->load->library('pagination');

            $count = $this->pelanggan_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress("login-history/" . $userId . "/", $count, 10, 3);

            $data['userRecords'] = $this->pelanggan_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : User Login History';

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
