<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fees extends MY_Controller
{
    public function index()
    {
        $page = $this->input->get('page');
        $data['title'] = $this->input->get('title');
        $view['fees'] = $this->fee_model->get_list($page, $data);
        $view['subview'] = 'admin/fees/index';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        if ($this->validate()) {
            $data['title'] = $this->input->post('title');
            $data['year'] = $this->input->post('year');
            $data['amount'] = $this->input->post('amount');
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->session->userdata('user')['id'];

            if ($this->fee_model->create($data)) {
                redirect('admin/fees');
            } else {
                $view['error'] = 'Máy chủ đang xảy ra sự cố. Vui lòng thử lại sau.';
                $view['subview'] = 'admin/fees/create';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['subview'] = 'admin/fees/create';
            $this->load->view('admin/layout', $view);
        }
    }

    public function edit($id)
    {
        if ($this->validate($id)) {
            $data['title'] = $this->input->post('title');
            $data['year'] = $this->input->post('year');
            $data['amount'] = $this->input->post('amount');
            $data['description'] = $this->input->post('description');

            if ($this->fee_model->update($id, $data)) {
                redirect('admin/fees');
            } else {
                $view['error'] = 'Máy chủ đang xảy ra sự cố. Vui lòng thử lại sau.';
                $view['fee'] = $this->fee_model->find($id);
                $view['subview'] = 'admin/fees/edit';
                $this->load->view('admin/layout', $view);
            }
        } else {
            $view['fee'] = $this->fee_model->find($id);
            $view['subview'] = 'admin/fees/edit';
            $this->load->view('admin/layout', $view);
        }
    }

    public function delete($id)
    {
        $this->fee_model->delete($id);
        redirect('admin/fees');
    }

    protected function validate($id = 0)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('title', 'Tên khoản thu', 'required');
            $this->form_validation->set_rules('year', 'Năm thu', 'required');
            $this->form_validation->set_rules('amount', 'Khoản tiền', 'required');
            $this->form_validation->set_message('required', '{field} không được để trống.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
