<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model
{
    public function get_list($page = 1, $data = [])
    {
        $fields = [
            'students.id',
            'students.code',
            'students.name',
            'departments.name as department_name',
            'school_years.label as school_year_label',
            'classes.name as class_name',
        ];
        $this->db->select($fields);
        $this->db->from('students');
        $this->db->join('classes', 'students.class_id = classes.id');
        $this->db->join('departments', 'classes.department_id = departments.id');
        $this->db->join('school_years', 'classes.school_year_id = school_years.id');
        $this->db->order_by('departments.id');
        $this->db->order_by('school_years.id');

        if (isset($data['code']) && $data['code']) {
            $this->db->or_like('students.code', $data['code']);
        }

        if (isset($data['name']) && $data['name']) {
            $this->db->or_like('students.name', $data['name']);
        }

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/classes');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function get_trade_in_class_by_fee($page, $class_id, $fee_id)
    {
        $fields = [
            'students.id',
            'students.code',
            'students.name',
            'classes.name as class_name',
        ];
        $this->db->select($fields);
        $this->db->from('students');
        $this->db->join('classes', 'students.class_id = classes.id');
        $this->db->where('classes.id', $class_id);
        $this->db->order_by('students.id', 'asc');

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/input');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $students = $query2->limit($limit, $offset)->get()->result_array();

        $student_fees = $this->db->select('student_id, date_fee')->from('student_fee')->where('fee_id', $fee_id)->get()->result_array();

        foreach ($student_fees as $key => $stf) {
            $has_fees[$stf['student_id']] = $stf['date_fee'];
        }

        $has_fees = isset($has_fees) ? $has_fees : [];

        foreach ($students as $key => $st) {
            if (array_key_exists($st['id'], $has_fees)) {
                $students[$key]['fee_paid'] = 1;
                $students[$key]['date_fee'] = $has_fees[$st['id']];
            } else {
                $students[$key]['fee_paid'] = 0;
            }
        }

        return $students;
    }

    public function create(array $data)
    {
        return $this->db->insert('students', $data);
    }

    public function update($id, array $data)
    {
        return $this->db->where('id', $id)->update('students', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('students');
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get('students')->row_array();
    }
}
