<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends MY_Controller
{
    public function index()
    {
        if (isset($_POST['submit'])) {
            $fee_id = $this->input->post('fee_id');
            $student_ids = $this->input->post('student_ids');
            $student_ids = is_array($student_ids) ? $student_ids : [];
            $this->fee_model->insert_student_fees($fee_id, $student_ids);
            redirect(current_url().'?'.$this->input->server('QUERY_STRING'));
        }
        $page = $this->input->get('page');
        $view['fee_id'] = $this->input->get('fee_id');
        $view['class_id'] = $this->input->get('class_id');
        $view['department_id'] = $this->input->get('department_id');
        $view['school_year_id'] = $this->input->get('school_year_id');
        $view['fee'] = $this->fee_model->find($view['fee_id']);
        $view['fees'] = $this->fee_model->get_all();
        $view['classes'] = $this->class_model->get_by_department_school_year($view['department_id'], $view['school_year_id']);
        $view['students'] = $this->student_model->get_trade_in_class_by_fee($page, $view['class_id'], $view['fee_id']);
        $view['departments'] = $this->department_model->get_all();
        $view['school_years'] = $this->school_year_model->get_all();
        $view['subview'] = 'admin/trade/input';
        $this->load->view('admin/layout', $view);
    }

    public function unset_fee($fee_id, $student_id)
    {
        $this->fee_model->unset_fee($fee_id, $student_id);
        redirect('admin/input?'.$this->input->server('QUERY_STRING'));
    }
}
