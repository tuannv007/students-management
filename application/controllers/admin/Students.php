<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends MY_Controller
{
    public function index()
    {
        $page = $this->input->get('page');
        $data['code'] = $this->input->get('code');
        $data['name'] = $this->input->get('name');
        $view['students'] = $this->student_model->get_list($page, $data);
        $view['subview'] = 'admin/students/index';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        if ($this->validate()) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['class_id'] = $this->input->post('class_id');
            $data['user_id'] = $this->session->userdata('user')['id'];

            if ($this->student_model->create($data)) {
                redirect('admin/students');
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
                $view['departments'] = $this->department_model->get_all();
                $view['school_years'] = $this->school_year_model->get_all();
                $department_id = isset($_GET['department_id']) ? $this->input->get('department_id') : $view['departments'][0]['id'];
                $school_year_id = isset($_GET['school_year_id']) ? $this->input->get('school_year_id') : $view['school_years'][0]['id'];
                $view['classes'] = $this->class_model->get_by_department_school_year($department_id, $school_year_id);
                $view['gender'] = $this->config->item('gender');
                $view['subview'] = 'admin/students/create';
                $view['scripts'][] = 'assets/admin/modules/students/create.js';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['departments'] = $this->department_model->get_all();
            $view['school_years'] = $this->school_year_model->get_all();
            $view['department_id'] = isset($_GET['department_id']) ? $this->input->get('department_id') : $view['departments'][0]['id'];
            $view['school_year_id'] = isset($_GET['school_year_id']) ? $this->input->get('school_year_id') : $view['school_years'][0]['id'];
            $view['classes'] = $this->class_model->get_by_department_school_year($view['department_id'], $view['school_year_id']);
            $view['gender'] = $this->config->item('gender');
            $view['subview'] = 'admin/students/create';
            $view['scripts'][] = 'assets/admin/modules/students/create.js';
            $this->load->view('admin/layout', $view);
        }
    }

    public function edit($id)
    {
        if ($this->validate($id)) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['birthday'] = $this->input->post('birthday');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['class_id'] = $this->input->post('class_id');

            if ($this->student_model->update($id, $data)) {
                redirect('admin/students');
            } else {
                $view['student'] = $this->student_model->find($id);
                $class = $this->class_model->find($view['student']['class_id']);
                $view['departments'] = $this->department_model->get_all();
                $view['school_years'] = $this->school_year_model->get_all();
                $view['department_id'] = isset($_GET['department_id']) ? $this->input->get('department_id') : $this->department_model->find($class['department_id'])['id'];
                $view['school_year_id'] = isset($_GET['school_year_id']) ? $this->input->get('school_year_id') : $this->school_year_model->find($class['school_year_id'])['id'];
                $view['classes'] = $this->class_model->get_by_department_school_year($view['department_id'], $view['school_year_id']);
                $view['gender'] = $this->config->item('gender');
                $view['subview'] = 'admin/students/edit';
                $view['php_scripts'][] = 'admin/students/edit_scripts';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['student'] = $this->student_model->find($id);
            $class = $this->class_model->find($view['student']['class_id']);
            $view['departments'] = $this->department_model->get_all();
            $view['school_years'] = $this->school_year_model->get_all();
            $view['department_id'] = isset($_GET['department_id']) ? $this->input->get('department_id') : $this->department_model->find($class['department_id'])['id'];
            $view['school_year_id'] = isset($_GET['school_year_id']) ? $this->input->get('school_year_id') : $this->school_year_model->find($class['school_year_id'])['id'];
            $view['classes'] = $this->class_model->get_by_department_school_year($view['department_id'], $view['school_year_id']);
            $view['gender'] = $this->config->item('gender');
            $view['subview'] = 'admin/students/edit';
            $view['php_scripts'][] = 'admin/students/edit_scripts';
            $this->load->view('admin/layout', $view);
        }
    }

    public function delete($id)
    {
        $this->student_model->delete($id);
        redirect('admin/students');
    }

    protected function validate($id = 0)
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('code', 'Mã ĐV', "required|unique[students.code.id.$id]");
            $this->form_validation->set_rules('name', 'Họ tên', 'required');
            $this->form_validation->set_rules('birthday', 'Ngày sinh', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('class_id', 'Lớp', 'required');
            // $this->form_validation
            $this->form_validation->set_message('required', '{field} không được để trống.');
            $this->form_validation->set_message('unique', '{field} đã tồn tại. Vui lòng nhập lại.');
            $this->form_validation->set_message('valid_email', '{field} không đúng định dạng.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
