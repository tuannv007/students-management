<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public function get_list_in_year($year, $page, array $data)
    {
        $fields = [
            'payments.id',
            'payments.title',
            'payments.amount',
            'payments.paid_date',
            'users.name as user_name',
        ];
        $this->db->select($fields);
        $this->db->from('payments');
        $this->db->join('users', 'payments.user_id = users.id');
        $this->db->where('year(paid_date)', $year);

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/output');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function get_list_by_department_year($department_id, $year, $page, array $data)
    {
        $fields = [
            'payments.id',
            'payments.title',
            'payments.amount',
            'payments.paid_date',
            'users.name as user_name',
        ];
        $this->db->select($fields);
        $this->db->from('payments');
        $this->db->join('users', 'payments.user_id = users.id');
        $this->db->where('department_id', $department_id);
        $this->db->where('year(paid_date)', $year);

        // echo $this->db->get_compiled_select(); die;

        $query2 = clone $query1 = $this->db;

        $page = $page > 0 ? $page : 1;
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $config['base_url'] = base_url('admin/output');
        $config['total_rows'] = $query1->count_all_results();
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        return $query2->limit($limit, $offset)->get()->result_array();
    }

    public function calculate_paid_in_year($year)
    {
        $this->db->select('sum(amount) as paid_total');
        $this->db->from('payments');
        $this->db->where('year(paid_date)', $year);

        return $this->db->get()->row_array()['paid_total'];
    }

    public function calculate_paid_by_department_year($department_id, $year)
    {
        $this->db->select('sum(amount) as paid_total');
        $this->db->from('payments');
        $this->db->where('department_id', $department_id);
        $this->db->where('year(paid_date)', $year);

        return $this->db->get()->row_array()['paid_total'];
    }

    public function create(array $data)
    {
        return $this->db->insert('payments', $data);
    }
}
