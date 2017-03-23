<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends MY_Controller
{
    public function index()
    {
        $page = trim($this->input->get('page'));
        $data['code'] = trim($this->input->get('code'));
        $data['name'] = trim($this->input->get('name'));
        $view['departments'] = $this->department_model->get_list($page, $data);
        $view['subview'] = 'admin/departments/index';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        if ($this->validate()) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');
            $data['user_id'] = $this->session->userdata('user')['id'];

            if ($this->department_model->create($data)) {
                redirect('admin/departments');
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
                $view['subview'] = 'admin/departments/create';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['subview'] = 'admin/departments/create';
            $this->load->view('admin/layout', $view);
        }
    }

    public function edit($id)
    {
        if ($this->validate($id)) {
            $data['code'] = $this->input->post('code');
            $data['name'] = $this->input->post('name');

            if ($this->department_model->update($id, $data)) {
                redirect('admin/departments');
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
                $view['department'] = $this->department_model->find($id);
                $view['subview'] = 'admin/departments/edit';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['department'] = $this->department_model->find($id);
            $view['subview'] = 'admin/departments/edit';
            $this->load->view('admin/layout', $view);
        }
    }

    public function delete($id)
    {
        $this->department_model->delete($id);
        redirect('admin/departments');
    }

    protected function validate($id = 0)
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('code', 'Mã khoa', "required|unique[departments.code.id.$id]");
            $this->form_validation->set_rules('name', 'Tên khoa', 'required|unique[departments.name.id.$id]');
            $this->form_validation->set_message('required', '{field} không được để trống.');
            $this->form_validation->set_message('unique', '{field} đã tồn tại. Vui lòng chọn tên|mã khác.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
