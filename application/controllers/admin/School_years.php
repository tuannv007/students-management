<?php defined('BASEPATH') OR exit('No direct script access allowed');

class School_years extends MY_Controller
{
    public function index()
    {
        $page = trim($this->input->get('page'));
        $data['label'] = trim($this->input->get('label'));
        $data['name'] = trim($this->input->get('name'));
        $view['school_years'] = $this->school_year_model->get_list($page, $data);
        $view['subview'] = 'admin/school_years/index';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        if ($this->validate()) {
            $data['name'] = $this->input->post('name');
            $data['label'] = $this->input->post('label');
            $data['start_year'] = $this->input->post('start_year');
            $data['end_year'] = $this->input->post('end_year');
            $data['user_id'] = $this->session->userdata('user')['id'];
            if ($this->school_year_model->create($data)) {
                redirect('admin/school-years');
            } else {
                $view['subview'] = 'admin/school_years/create';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['subview'] = 'admin/school_years/create';
            $this->load->view('admin/layout', $view);
        }
    }

    public function edit($id)
    {
        if ($this->validate($id)) {
            $data['name'] = $this->input->post('name');
            $data['label'] = $this->input->post('label');
            $data['start_year'] = $this->input->post('start_year');
            $data['end_year'] = $this->input->post('end_year');

            if ($this->school_year_model->update($id, $data)) {
                redirect('admin/school-years');
            } else {
                $view['school_year'] = $this->school_year_model->find($id);
                $view['subview'] = 'admin/school_years/edit';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['school_year'] = $this->school_year_model->find($id);
            $view['subview'] = 'admin/school_years/edit';
            $this->load->view('admin/layout', $view);
        }
    }

    public function delete($id)
    {
        $this->school_year_model->delete($id);
        redirect('admin/school-years');
    }

    protected function validate($id = 0)
    {
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Ký hiệu', "required|unique[school_years.name.id.$id]");
            $this->form_validation->set_rules('label', 'Tên niên khóa', "required|unique[school_years.label.id.$id]");
            $this->form_validation->set_rules('start_year', 'Năm bắt đầu', "required|integer|greater_than_equal_to[".date('Y')."]");
            $this->form_validation->set_rules('end_year', 'Năm kết thúc', "required|integer|greater_than[".$this->input->post('start_year')."]");
            $this->form_validation->set_message('required', '{field} không được để trống.');
            $this->form_validation->set_message('unique', '{field} đã tồn tại. Vui lòng nhập lại.');
            $this->form_validation->set_message('integer', '{field} phải là số nguyên.');
            $this->form_validation->set_message('greater_than_equal_to', '{field} phải từ {param} trở đi.');
            $this->form_validation->set_message('greater_than', '{field} phải từ sau năm bắt đầu trở đi.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
