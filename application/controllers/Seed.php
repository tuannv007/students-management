<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller
{
    public function index()
    {
        $this->users_seeder();

        $this->school_years_seeder();

        $this->departments_seeder();

        $this->classes_seeder();

        $this->students_seeder();

        $this->fees_seeder();
    }

    public function users_seeder()
    {
        $count = $this->db
            ->where('account', 'system')
            ->count_all_results('users');

        if ($count == 0) {
            $this->db->insert('users', [
                'name' => 'system',
                'account' => 'system',
                'email' => 'system@system.com',
                'password' => sha1('system'),
            ]);
        }
    }

    public function school_years_seeder()
    {
        $user_id = $this->db->where('account', 'system')->get('users')->row_array()['id'];
        $this->db->insert_batch('school_years', [
            ['name' => 'DHK8', 'label' => 'ĐH Khóa 8 (2013-2017)', 'start_year' => 2013, 'end_year' => 2017, 'user_id' => $user_id],
            ['name' => 'DHK9', 'label' => 'ĐH Khóa 9 (2014-2018)', 'start_year' => 2014, 'end_year' => 2018, 'user_id' => $user_id],
            ['name' => 'DHK10', 'label' => 'ĐH Khóa 10 (2015-2019)', 'start_year' => 2015, 'end_year' => 2019, 'user_id' => $user_id],
        ]);
    }

    public function departments_seeder()
    {
        $user_id = $this->db->where('account', 'system')->get('users')->row_array()['id'];
        $this->db->insert_batch('departments', [
            ['code' => 'CNTT', 'name' => 'Công nghệ thông tin', 'user_id' => $user_id],
            ['code' => 'KT', 'name' => 'Kế toán', 'user_id' => $user_id],
            ['code' => 'NN', 'name' => 'Ngoại ngữ', 'user_id' => $user_id],
        ]);
    }

    public function classes_seeder()
    {
        $user_id = $this->db->where('account', 'system')->get('users')->row_array()['id'];
        $department_id = $this->db->where('code', 'CNTT')->get('departments')->row_array()['id'];
        $school_year_id = $this->db->where('name', 'DHK8')->get('school_years')->row_array()['id'];
        $this->db->insert_batch('classes', [
            ['code' => 'DH-KHMT1-K8', 'name' => 'Khoa học máy tính 1 - ĐH khóa 8', 'user_id' => $user_id, 'department_id' => $department_id, 'school_year_id' => $school_year_id],
            ['code' => 'DH-KHMT2-K8', 'name' => 'Khoa học máy tính 2 - ĐH khóa 8', 'user_id' => $user_id, 'department_id' => $department_id, 'school_year_id' => $school_year_id],
            ['code' => 'DH-KHMT3-K8', 'name' => 'Khoa học máy tính 3 - ĐH khóa 8', 'user_id' => $user_id, 'department_id' => $department_id, 'school_year_id' => $school_year_id],
        ]);
    }

    public function students_seeder()
    {
        $user_id = $this->db->where('account', 'system')->get('users')->row_array()['id'];
        $class_id = $this->db->get('classes')->row_array()['id'];

        $this->db->insert_batch('students', [
            ['name' => 'Nguyen Van A', 'code' => 'SV001', 'user_id' => $user_id, 'class_id' => $class_id],
            ['name' => 'Nguyen Van B', 'code' => 'SV002', 'user_id' => $user_id, 'class_id' => $class_id],
            ['name' => 'Nguyen Van C', 'code' => 'SV003', 'user_id' => $user_id, 'class_id' => $class_id],
            ['name' => 'Nguyen Van D', 'code' => 'SV004', 'user_id' => $user_id, 'class_id' => $class_id],
            ['name' => 'Nguyen Van E', 'code' => 'SV005', 'user_id' => $user_id, 'class_id' => $class_id],
        ]);
    }

    public function fees_seeder()
    {
        $user_id = $this->db->where('account', 'system')->get('users')->row_array()['id'];

        $this->db->insert_batch('fees', [
            ['title' => 'Đoàn phí 2013', 'amount' => '15000', 'year' => 2013, 'user_id' => $user_id],
            ['title' => 'Đoàn phí 2014', 'amount' => '20000', 'year' => 2014, 'user_id' => $user_id],
            ['title' => 'Đoàn phí 2015', 'amount' => '25000', 'year' => 2015, 'user_id' => $user_id],
            ['title' => 'Đoàn phí 2016', 'amount' => '25000', 'year' => 2016, 'user_id' => $user_id],
            ['title' => 'Đoàn phí 2017', 'amount' => '30000', 'year' => 2017, 'user_id' => $user_id],
        ]);
    }
}
