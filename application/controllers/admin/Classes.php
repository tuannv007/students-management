<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends MY_Controller
{
    public function index()
    {
        $page = trim($this->input->get('page'));
        $data['code'] = trim($this->input->get('code'));
        $data['name'] = trim($this->input->get('name'));
        $view['classes'] = $this->class_model->get_list($page, $data);
        $view['subview'] = 'admin/classes/index';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        if ($this->validate()) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['department_id'] = $this->input->post('department_id');
            $data['school_year_id'] = $this->input->post('school_year_id');
            $data['user_id'] = $this->session->userdata('user')['id'];
            if ($this->class_model->create($data)) {
                redirect('admin/classes');
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
                $view['departments'] = $this->department_model->get_all();
                $view['school_years'] = $this->school_year_model->get_all();
                $view['subview'] = 'admin/classes/create';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['departments'] = $this->department_model->get_all();
            $view['school_years'] = $this->school_year_model->get_all();
            $view['subview'] = 'admin/classes/create';
            $this->load->view('admin/layout', $view);
        }
    }

    public function edit($id)
    {
        if ($this->validate($id)) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['department_id'] = $this->input->post('department_id');
            $data['school_year_id'] = $this->input->post('school_year_id');
            if ($this->class_model->update($id, $data)) {
                redirect('admin/classes');
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
                $view['class'] = $this->class_model->find($id);
                $view['departments'] = $this->department_model->get_all();
                $view['school_years'] = $this->school_year_model->get_all();
                $view['subview'] = 'admin/classes/edit';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['class'] = $this->class_model->find($id);
            $view['departments'] = $this->department_model->get_all();
            $view['school_years'] = $this->school_year_model->get_all();
            $view['subview'] = 'admin/classes/edit';
            $this->load->view('admin/layout', $view);
        }
    }

    public function delete($id)
    {
        $this->class_model->delete($id);
        redirect('admin/classes');
    }

    protected function validate($id = 0)
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('code', 'Mã lớp', "required|unique[classes.code.id.$id]");
            $this->form_validation->set_rules('name', 'Tên lớp', "required|unique[classes.name.id.$id]");
            $this->form_validation->set_message('required', '{field} không được để trống.');
            $this->form_validation->set_message('unique', '{field} đã tồn tại.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
