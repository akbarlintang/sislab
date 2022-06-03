<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : User_model (User Model)
 * User model class to get to handle user related data 
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Trader_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function daftarTraderCount($searchText = '')
    {
        $this->db->select('BaseTbl.id_trader, BaseTbl.nm_trader, BaseTbl.al_trader, BaseTbl.kt_trader, BaseTbl.kd_negara, BaseTbl.npwp, BaseTbl.no_ktp, BaseTbl.ph_trader, BaseTbl.fx_trader, BaseTbl.im_trader, BaseTbl.no_izin, BaseTbl.email, BaseTbl.homepage, BaseTbl.id_kel_trader, BaseTbl.keterangan, BaseTbl.status, BaseTbl.ili, aktif, BaseTbl.kd_trader_ol, BaseTbl.jns_id, kodepos, BaseTbl.email_pjb, BaseTbl.kd_niki, BaseTbl.niki, BaseTbl.pth, BaseTbl.date_pth, BaseTbl.bdn_usaha');
        $this->db->from('tb_r_trader as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nm_trader  LIKE '%" . $searchText . "%'
                            )";
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
    function daftarTrader($searchText = '', $page = '', $segment = '')
    {
        $this->db->select('BaseTbl.id_trader, BaseTbl.nm_trader, BaseTbl.al_trader, BaseTbl.kt_trader, BaseTbl.kd_negara, BaseTbl.npwp, BaseTbl.no_ktp, BaseTbl.ph_trader, BaseTbl.fx_trader, BaseTbl.im_trader, BaseTbl.no_izin, BaseTbl.email, BaseTbl.homepage, BaseTbl.id_kel_trader, BaseTbl.keterangan, BaseTbl.status, BaseTbl.ili, aktif, BaseTbl.kd_trader_ol, BaseTbl.jns_id, kodepos, BaseTbl.email_pjb, BaseTbl.kd_niki, BaseTbl.niki, BaseTbl.pth, BaseTbl.date_pth, BaseTbl.bdn_usaha');
        $this->db->from('tb_r_trader as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nm_trader  LIKE '%" . $searchText . "%'
                            )";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('BaseTbl.id_trader', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    // function getUserRoles()
    // {
    //     $this->db->select('roleId, role');
    //     $this->db->from('tbl_roles');
    //     $this->db->where('roleId !=', 1);
    //     $query = $this->db->get();

    //     return $query->result();
    // }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    // function checkEmailExists($email, $userId = 0)
    // {
    //     $this->db->select("email");
    //     $this->db->from("tbl_wadah");
    //     $this->db->where("email", $email);
    //     $this->db->where("isDeleted", 0);
    //     if ($userId != 0) {
    //         $this->db->where("userId !=", $userId);
    //     }
    //     $query = $this->db->get();

    //     return $query->result();
    // }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function tambahTraderBaru($infoTrader)
    {
        $this->db->trans_start();
        $this->db->insert('tb_r_trader', $infoTrader);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getinfoTrader($id_trader)
    {
        $this->db->select('id_trader,nm_trader, al_trader, kt_trader, kd_negara, npwp, no_ktp, ph_trader, fx_trader, im_trader, no_izin, email, homepage, id_kel_trader, keterangan, status, ili, aktif, kd_trader_ol, jns_id, kodepos, email_pjb, kd_niki, niki, pth, date_pth, bdn_usaha');
        $this->db->from('tb_r_trader');
        // $this->db->where('isDeleted', 0);
        // $this->db->where('roleId !=', 1);
        $this->db->where('id_trader', $id_trader);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editTrader($infoTrader, $id_trader)
    {
        $this->db->where('id_trader', $id_trader);
        $this->db->update('tb_r_trader', $infoTrader);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteTrader($id_trader)
    {

        $this->db->where('id_trader', $id_trader);
        $this->db->delete('tb_r_trader');

        // return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    // function matchOldPassword($userId, $oldPassword)
    // {
    //     $this->db->select('userId, password');
    //     $this->db->where('userId', $userId);
    //     $this->db->where('isDeleted', 0);
    //     $query = $this->db->get('tbl_wadah');

    //     $user = $query->result();

    //     if (!empty($user)) {
    //         if (verifyHashedPassword($oldPassword, $user[0]->password)) {
    //             return $user;
    //         } else {
    //             return array();
    //         }
    //     } else {
    //         return array();
    //     }
    // }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    // function changePassword($userId, $userInfo)
    // {
    //     $this->db->where('userId', $userId);
    //     $this->db->where('isDeleted', 0);
    //     $this->db->update('tbl_wadah', $userInfo);

    //     return $this->db->affected_rows();
    // }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    // function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    // {
    //     $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(BaseTbl.sessionData LIKE '%" . $searchText . "%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if (!empty($fromDate)) {
    //         $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
    //         $this->db->where($likeCriteria);
    //     }
    //     if (!empty($toDate)) {
    //         $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
    //         $this->db->where($likeCriteria);
    //     }
    //     if ($userId >= 1) {
    //         $this->db->where('BaseTbl.userId', $userId);
    //     }
    //     $this->db->from('tbl_last_login as BaseTbl');
    //     $query = $this->db->get();

    //     return $query->num_rows();
    // }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    // function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    // {
    //     $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
    //     $this->db->from('tbl_last_login as BaseTbl');
    //     if (!empty($searchText)) {
    //         $likeCriteria = "(BaseTbl.sessionData  LIKE '%" . $searchText . "%')";
    //         $this->db->where($likeCriteria);
    //     }
    //     if (!empty($fromDate)) {
    //         $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '" . date('Y-m-d', strtotime($fromDate)) . "'";
    //         $this->db->where($likeCriteria);
    //     }
    //     if (!empty($toDate)) {
    //         $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '" . date('Y-m-d', strtotime($toDate)) . "'";
    //         $this->db->where($likeCriteria);
    //     }
    //     if ($userId >= 1) {
    //         $this->db->where('BaseTbl.userId', $userId);
    //     }
    //     $this->db->order_by('BaseTbl.id', 'DESC');
    //     $this->db->limit($page, $segment);
    //     $query = $this->db->get();

    //     $result = $query->result();
    //     return $result;
    // }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    // function getUserInfoById($userId)
    // {
    //     $this->db->select('userId, name, email, mobile, roleId');
    //     $this->db->from('tbl_wadah');
    //     $this->db->where('isDeleted', 0);
    //     $this->db->where('userId', $userId);
    //     $query = $this->db->get();

    //     return $query->row();
    // }

    /**
     * This function used to get user information by id with role
     * @param number $userId : This is user id
     * @return aray $result : This is user information
     */
    // function getUserInfoWithRole($userId)
    // {
    //     $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.roleId, Roles.role');
    //     $this->db->from('tbl_wadah as BaseTbl');
    //     $this->db->join('tbl_roles as Roles', 'Roles.roleId = BaseTbl.roleId');
    //     $this->db->where('BaseTbl.userId', $userId);
    //     $this->db->where('BaseTbl.isDeleted', 0);
    //     $query = $this->db->get();

    //     return $query->row();
    // }
}
