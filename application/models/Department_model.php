<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_model
{
    public function get_list($page = 1, $data = [])
    {
        $this->db->select('departments.id, departments.code, departments.name, users.name as user_name');
        $this->db->from('departments');
        $this->db->like('departments.code', $data['code']);
        $this->db->or_like('departments.name', $data['name']);
        $this->db->join('users', 'departments.user_id = users.id');
        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/departments');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function create(array $data)
    {
        return $this->db->insert('departments', $data);
    }

    public function update($id, array $data)
    {
        return $this->db->where('id', $id)->update('departments', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('departments');
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get('departments')->row_array();
    }
}
