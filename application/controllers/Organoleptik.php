<?php

use Symfony\Component\Yaml\Dumper;

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Organoleptik extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('organoleptik_model');
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
    function daftarOrganoleptik()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->organoleptik_model->daftarOrganoleptikCount($searchText);

            $returns = $this->paginationCompress("daftarOrganoleptik/", $count, 10);

            $data['userRecords'] = $this->organoleptik_model->daftarOrganoleptik($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Sislab : Daftar Data Organoleptik';

            $this->loadViews("organoleptik", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function tambahOrganoleptik()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('organoleptik_model');

            $this->global['pageTitle'] = 'Sislab : Tambah Data Organoleptik';

            $this->loadViews(
                "tambahOrganoleptik",
                $this->global, //$data,
                NULL
            );
        }
    }


    /**
     * This function is used to add new user to the system
     */
    function tambahOrganoleptikBaru()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            //$this->form_validation->set_rules('id', 'id', 'required|min_length[10]');
            $this->form_validation->set_rules('kode', 'Kode Pemeriksaan', 'trim|required|max_length[5]');
            $this->form_validation->set_rules('jenis_pemeriksaan', 'Jenis Pemeriksaan', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('organ_diperiksa', 'Organ Diperiksa', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('gejala_klinis', 'Gejala Klinis', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|max_length[10]');


            if ($this->form_validation->run() == FALSE) {
                $this->tambahOrganoleptik();
            } else {
                //$id = $this->input->post('id');
                $kode = $this->input->post('kode');
                $jenis_pemeriksaan = $this->input->post('jenis_pemeriksaan');
                $organ_diperiksa = $this->input->post('organ_diperiksa');
                $gejala_klinis = $this->input->post('gejala_klinis');
                $nilai = $this->input->post('nilai');

                $infoOrganoleptik = array(
                    //'id' => $id,
                    'kode' => $kode,
                    'jenis_pemeriksaan' => $jenis_pemeriksaan,
                    'organ_diperiksa' => $organ_diperiksa,
                    'gejala_klinis' => $gejala_klinis,
                    'nilai' => $nilai
                );

                $this->load->model('organoleptik_model');

                $result = $this->organoleptik_model->tambahOrganoleptikBaru($infoOrganoleptik);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Organoleptik Baru Berhasil Ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Organoleptik Baru gagal Ditambahkan');
                }

                redirect('tambahOrganoleptik');
            }
        }
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */

    function editOrganoleptikLama($id)
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            $data['infoOrganoleptik'] = $this->organoleptik_model->getinfoOrganoleptik($id);

            $this->global['pageTitle'] = 'Sislab : Edit Data Organoleptik';

            $this->loadViews("editOrganoleptikLama", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the user information
     */
    function editOrganoleptik()
    {
        if ($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('id', 'ID');
            $this->form_validation->set_rules('kode', 'Kode Pemeriksaan', 'trim|required|max_length[5]');
            $this->form_validation->set_rules('jenis_pemeriksaan', 'Jenis Pemeriksaan', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('organ_diperiksa', 'Organ Diperiksa', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('gejala_klinis', 'Gejala Klinis', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('nilai', 'Nilai');


            if ($this->form_validation->run() == FALSE) {
                $this->editOrganoleptikLama($id);
            } else {
                //$id = $this->input->post('id');
                $kode = $this->input->post('kode');
                $jenis_pemeriksaan = $this->input->post('jenis_pemeriksaan');
                $organ_diperiksa = $this->input->post('organ_diperiksa');
                $gejala_klinis = $this->input->post('gejala_klinis');
                $nilai = $this->input->post('nilai');

                // $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                // $email = strtolower($this->security->xss_clean($this->input->post('email')));
                // $password = $this->input->post('password');
                // $roleId = $this->input->post('role');
                // $mobile = $this->security->xss_clean($this->input->post('mobile'));

                $infoOrganoleptik = array(
                    //'id' => $id,
                    'kode' => $kode,
                    'jenis_pemeriksaan' => $jenis_pemeriksaan,
                    'organ_diperiksa' => $organ_diperiksa,
                    'gejala_klinis' => $gejala_klinis,
                    'nilai' => $nilai
                );

                $result = $this->organoleptik_model->editOrganoleptik($infoOrganoleptik, $id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Organoleptik Berhasil Diupdate');
                } else {
                    $this->session->set_flashdata('error', 'Data Organoleptik Gagal Diupdate');
                }

                redirect('daftarOrganoleptik');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteOrganoleptik()
    {
        if ($this->isAdmin() == TRUE) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $id = $this->input->post('id');

            $this->organoleptik_model->deleteOrganoleptik(
                $id
            );

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Organoleptik Berhasil Dihapus');
            } else {
                $this->session->set_flashdata('error', 'Data Organoleptik gagal Dihapus');
            }
            return redirect('daftarOrganoleptik');
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
