<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login($name,$pass)
    {
        if ($name != FALSE && $pass != FALSE) {
            $this->db->where('Username', $name);
            $this->db->where('Password', $pass);

            $query = $this->db->get('usuario');

            if ($query->num_rows() == 1) {
                return $query->result_array();
            }
            return 0;
        }
    }
    
}