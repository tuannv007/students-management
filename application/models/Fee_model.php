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
        $sql = "SELECT sum(`fees`.`amount`) as input_total
                FROM `fees`
                INNER JOIN `student_fee` ON `fees`.`id` = `student_fee`.`fee_id`
                WHERE year(`student_fee`.`date_fee`) = ?";

        return $this->db->query($sql, [$year])->row_array()['input_total'];
    }

    public function calculate_total_by_department_year($department_id, $year)
    {
         $sql = "SELECT sum(`fees`.`amount`) as input_total
                 FROM `fees`
                 INNER JOIN `student_fee` ON `fees`.`id` = `student_fee`.`fee_id`
                 INNER JOIN `students` ON `student_fee`.`student_id` = `students`.`id`
                 INNER JOIN `classes` ON `students`.`class_id` = `classes`.`id`
                 INNER JOIN `departments` ON `classes`.`department_id` = `departments`.`id`
                 WHERE `departments`.`id` = ? AND year(`student_fee`.`date_fee`) = ?";

        return $this->db->query($sql, [$department_id, $year])->row_array()['input_total'];
    }
}
