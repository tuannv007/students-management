<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function index()
    {
        $view['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/layout', $view);
    }
}
