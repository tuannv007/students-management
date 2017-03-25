<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fee_model extends CI_Model
{
    public function get_list($page, array $data)
    {
        $this->db->select('fees.*, users.name as user_name');
        $this->db->from('fees');
        $this->db->join('users', 'fees.user_id = users.id');

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

    public function get_all()
    {
        return $this->db->get('fees')->result_array();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get('fees')->row_array();
    }

    public function create(array $data)
    {
        return $this->db->insert('fees', $data);
    }

    public function update($id, array $data)
    {
        return $this->db->where('id', $id)->update('fees', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('fees');
    }

    public function insert_student_fees($fee_id, array $student_ids)
    {
        foreach ($student_ids as $key => $student_id) {
            $data[$key]['fee_id'] = $fee_id;
            $data[$key]['student_id'] = $student_id;
            $data[$key]['date_fee'] = date('Y-m-d');
        }

        if (isset($data)) {
            return $this->db->insert_batch('student_fee', $data);
        }

        return null;
    }

    public function unset_fee($fee_id, $student_id)
    {
        return $this->db
            ->where('fee_id', $fee_id)
            ->where('student_id', $student_id)
            ->delete('student_fee');
    }

    public function calculate_total_in_year($year)
    {
        $this->db->select('count(student_fee.fee_id) * fees.amount as fee_subtotal');
        $this->db->from('fees');
        $this->db->join('student_fee', 'fees.id = student_fee.fee_id');
        $this->db->where('year', $year);
        $this->db->group_by('fees.id');

        $fees = $this->db->get()->result_array();

        $total = 0;

        foreach ($fees as $key => $fee) {
            $total = $total + $fee['fee_subtotal'];
        }

        return $total;
    }
}
