<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    const TABLE = 'users';

    public function verify(array $data)
    {
        $data['password'] = sha1($data['password']);
        $this->db->from(static::TABLE);
        $this->db->where($data);
        return $this->db->get()->row_array();
    }

    public function find_by_id($id)
    {
        return $this->db->where('id', $id)->get(static::TABLE)->row_array();
    }
}
