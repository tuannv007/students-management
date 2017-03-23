<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function index()
    {
        $page = trim($this->input->get('page'));
        $view['year'] = $data['year'] = isset($_GET['year']) ? $this->input->get('year') : date('Y');
        $view['departments'] = $this->department_model->simple_report($page, $data);
        $view['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/layout', $view);
    }
}
