<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_model
{
    public function get_list($page = 1, $data = [])
    {
        $this->db->select('departments.id, departments.code, departments.name, users.name as user_name');
        $this->db->from('departments');
        $this->db->join('users', 'departments.user_id = users.id');

        if (isset($data['code'])) {
            $this->db->like('departments.code', $data['code']);
        }

        if (isset($data['name'])) {
            $this->db->like('departments.code', $data['name']);
        }

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

    public function simple_report($page, $data = [])
    {
        $fields = [
            'departments.code',
            'departments.name',
            'count(distinct school_years.id) as school_years_count',
            'count(distinct classes.id) as classes_count',
            'count(students.id) as students_count'
        ];
        $this->db->select($fields);
        $this->db->from('departments');
        $this->db->join('classes', 'departments.id = classes.department_id', 'left');
        $this->db->join('school_years', 'classes.school_year_id = school_years.id', 'left');
        $this->db->join('students', 'classes.id = students.class_id', 'left');
        $this->db->group_by('departments.id');

        if (isset($data['year'])) {
            $this->db->where('school_years.id', NULL);
            $this->db->or_where('school_years.end_year >=', intval($data['year']));
        }

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/dashboard');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function get_all()
    {
        return $this->db->get('departments')->result_array();
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
