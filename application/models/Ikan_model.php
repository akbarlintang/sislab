<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Ikan_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function daftarIkanCount($searchText = '')
    {
        $this->db->select('BaseTbl.id_kd_lokal, BaseTbl.nm_lokal, BaseTbl.nm_umum, BaseTbl.nm_latin, BaseTbl.kd_ikan, BaseTbl.id_ikan, BaseTbl.id_kel_ikan, BaseTbl.kd_jenis_kel, BaseTbl.kd_tarif, BaseTbl.kelas, BaseTbl.kelompok, BaseTbl.konsumsi, BaseTbl.tawar, BaseTbl.hidup, BaseTbl.bentuk, BaseTbl.hias, BaseTbl.pelagis, BaseTbl.status, BaseTbl.hscode, BaseTbl.no_urut_hs, BaseTbl.aktif, BaseTbl.kd_ikan_lokal_ol, BaseTbl.nilai, BaseTbl.id_satuan');
        $this->db->from('tb_r_ikan_lokal as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nm_lokal  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.nm_umum  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.nm_latin  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function daftarIkan($searchText = '', $page = '', $segment = '')
    {
        $this->db->select('BaseTbl.id_kd_lokal, BaseTbl.nm_lokal, BaseTbl.nm_umum, BaseTbl.nm_latin, BaseTbl.kd_ikan, BaseTbl.id_ikan, BaseTbl.id_kel_ikan, BaseTbl.kd_jenis_kel, BaseTbl.kd_tarif, BaseTbl.kelas, BaseTbl.kelompok, BaseTbl.konsumsi, BaseTbl.tawar, BaseTbl.hidup, BaseTbl.bentuk, BaseTbl.hias, BaseTbl.pelagis, BaseTbl.status, BaseTbl.hscode, BaseTbl.no_urut_hs, BaseTbl.aktif, BaseTbl.kd_ikan_lokal_ol, BaseTbl.nilai, BaseTbl.id_satuan');
        $this->db->from('tb_r_ikan_lokal as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nm_lokal  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.nm_umum  LIKE '%" . $searchText . "%'
                            OR  BaseTbl.nm_latin  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.id_kd_lokal', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tb_r_ikan_lokal");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if ($userId != 0) {
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function tambahIkanBaru($infoIkan)
    {
        $this->db->trans_start();
        $this->db->insert('tb_r_ikan_lokal', $infoIkan);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getinfoIkan($id_kd_lokal)
    {
        $this->db->select('id_kd_lokal, nm_lokal, nm_umum, nm_latin, kd_ikan, id_ikan, id_kel_ikan, kd_jenis_kel, kd_tarif, kelas, kelompok, konsumsi, tawar, hidup, bentuk, hias, pelagis, status, hscode, no_urut_hs, aktif, kd_ikan_lokal_ol, nilai, id_satuan');
        $this->db->from('tb_r_ikan_lokal');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('id_kd_lokal', $id_kd_lokal);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editIkan($infoIkan, $id_kd_lokal)
    {
        $this->db->where('id_kd_lokal', $id_kd_lokal);
        $this->db->update('tb_r_ikan_lokal', $infoIkan);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteIkan($id_kd_lokal)
    {
        // $this->db->delete('tb_r_ikan_lokal', array('id_kd_lokal' => $id_kd_lokal));
        $this->db->where('id_kd_lokal', $id_kd_lokal);
        $this->db->delete('tb_r_ikan_lokal');

        // return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tb_r_ikan_lokal');

        $user = $query->result();

        if (!empty($user)) {
            if (verifyHashedPassword($oldPassword, $user[0]->password)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tb_r_ikan_lokal', $userInfo);

        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        if (!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if (!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
            $this->db->where($likeCriteria);
        }
        if ($userId >= 1) {
            $this->db->where('BaseTbl.userId', $userId);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tb_r_ikan_lokal');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    function getUserInfoWithRole($userId)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
        $this->db->from('tb_r_ikan_lokal as BaseTbl');
        $this->db->join('tbl_roles as Roles', 'Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }
}
