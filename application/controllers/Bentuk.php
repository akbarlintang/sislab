<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Bentuk extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bentuk_model');
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
    function daftarBentuk()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bentuk_model->daftarBentukCount($searchText);

            $returns = $this->paginationCompress("daftarBentuk/", $count, 10);

            $data['userRecords'] = $this->bentuk_model->daftarBentuk($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Data Bentuk';

            $this->loadViews("bentuk", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahBentuk()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('bentuk_model');
            //$data['roles'] = $this->wadah_model->getUserRoles();

            $this->global['pageTitle'] = 'Sislab : Tambah Data Bentuk';

            $this->loadViews(
                "tambahBentuk",
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
    function tambahBentukBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nama_bentuk', 'Nama Bentuk', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
            // $this->form_validation->set_rules('telepon', 'No Telepon', 'required|min_length[10]');
            // $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required|max_length[128]');
            // $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            // $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            // $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            // $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

            if ($this->form_validation->run() == FALSE) {
                $this->tambahBentuk();
            } else {
                $nama_bentuk = ucwords(strtolower($this->security->xss_clean($this->input->post('nama_bentuk'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $telepon = $this->security->xss_clean($this->input->post('telepon'));
                // $alamat = $this->input->post('alamat');
                //$password = $this->input->post('password');
                //$roleId = $this->input->post('role');
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoBentuk = array(
                    'nama_bentuk' => $nama_bentuk,
                    // 'email' => $email,
                    // 'telepon' => $telepon,
                    // 'alamat' => $alamat,
                    //'password' => getHashedPassword($password),
                    //'roleId' => $roleId, 
                    //'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s')
                );

                $this->load->model('bentuk_model');
                $result = $this->bentuk_model->tambahBentukBaru($infoBentuk);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Bentuk Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Bentuk Baru gagal Ditambahkan');
                }

                redirect('tambahBentuk');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editBentukLama($id_bentuk = NULL)
    {
        if ($this->isAdmin() == TRUE || $id_bentuk == 0) {
            $this->loadThis();
        } else {
            if ($id_bentuk == null) {
                redirect('daftarBentuk');
            }

            //$data['roles'] = $this->pelanggan_model->getUserRoles();
            $data['infoBentuk'] = $this->bentuk_model->getinfoBentuk($id_bentuk);

            $this->global['pageTitle'] = 'Sislab : Edit Data Bentuk';

            $this->loadViews("editBentukLama", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the user information
     */
    function editBentuk()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id_bentuk = $this->input->post('id_bentuk');

            $this->form_validation->set_rules('nama_bentuk', 'Nama Bentuk', 'trim|required|max_length[128]');
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
                $this->editBentukLama($id_bentuk);
            } else {
                $nama_bentuk = ucwords(strtolower($this->security->xss_clean($this->input->post('nama_bentuk'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $telepon = $this->security->xss_clean($this->input->post('telepon'));
                // $alamat = $this->input->post('alamat');

                // $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoBentuk = array(
                    'nama_bentuk' => $nama_bentuk,
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

                $result = $this->bentuk_model->editBentuk($infoBentuk, $id_bentuk);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Bentuk Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Bentuk Gagal Diupdate');
                }

                redirect('daftarBentuk');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBentuk()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id_bentuk = $this->input->post('id_bentuk');
            //$infoPelanggan = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

            $this->bentuk_model->deleteBentuk(
                $id_bentuk
                //$infoPelanggan
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Bentuk Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Bentuk gagal Dihapus');
            }
            return redirect('daftarBentuk');

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
