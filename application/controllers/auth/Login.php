<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->has_userdata('user')) {
            redirect('admin/dashboard');
        }

        if (isset($_POST['submit'])) {
            if ($this->validate()) {
                $data['account'] = $this->input->post('account');
                $data['password'] = $this->input->post('password');
                $user = $this->user_model->verify($data);

                if ($user) {
                    $this->session->set_userdata('user', $user);
                    redirect('admin/dashboard');
                } else {
                    $viewData['error'] = 'Tài khoản hoặc mật khẩu không chính xác.';
                    $this->load->view('auth/login', $viewData);
                }
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    protected function validate()
    {
        $this->form_validation->set_rules('account', 'Tài khoản', 'required');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'required');
        $this->form_validation->set_message('required', '{field} không được để trống');
        return $this->form_validation->run();
    }
}
