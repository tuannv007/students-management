<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->redirect_if_guest();

        $this->update_current_user();
    }

    public function update_current_user()
    {
        $user = $this->session->userdata('user');
        $user = $this->user_model->find_by_id($user['id']);
        $this->session->set_userdata('user', $user);
    }

    public function redirect_if_guest()
    {
        if (! $this->session->has_userdata('user')) {
            redirect('auth/login');
        }
    }
}
