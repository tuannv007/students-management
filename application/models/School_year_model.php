<?php defined('BASEPATH') OR exit('No direct script access allowed');

class School_year_model extends CI_Model
{
    public function get_list($page = 1, $data = [])
    {
        $this->db->select('*');
        $this->db->from('school_years');

        if (isset($data['name']) && $data['name']) {
            $this->db->like('name', $data['name']);
        }

        if (isset($data['label']) && $data['label']) {
            $this->db->or_like('label', $data['label']);
        }

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/school-years');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function create(array $data)
    {
        return $this->db->insert('school_years', $data);
    }

    public function update($id, array $data)
    {
        return $this->db->where('id', $id)->update('school_years', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('school_years');
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get('school_years')->row_array();
    }
}
