<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    public function unique($value, $params)
    {
        list($table, $field, $key, $id) = explode('.', $params);
        $this->CI->db->from($table);
        $this->CI->db->where("$key !=", $id);
        $this->CI->db->where($field, $value);
        return $this->CI->db->get()->num_rows() == 0;
    }
}
