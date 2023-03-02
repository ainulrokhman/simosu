<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    protected $TABLE;
    public function __construct()
    {
        parent::__construct();
        $this->TABLE = 'user';
    }
    public function auth($data)
    {
        $user = $this->db->get_where($this->TABLE, ['email' => $data['email']])->row_array();
        if ($user === null) {
            echo "user tidak ada";
        } else {
            if (!password_verify($data['password'], $user['password'])) {
                echo 'salah';
            } else {
                $user_data = $this->db->get_where('v_user_role', ['email' => $user['email']])->row_array();
                $this->session->set_userdata('session', $user_data);
            }
        }
    }
}
