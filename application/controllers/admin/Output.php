<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends MY_Controller
{
    public function index()
    {
        $page = $this->input->get('page');
        $view['year'] = $year = $this->input->get('year');
        $view['input_total'] = $this->fee_model->calculate_total_in_year($view['year']);
        $view['output_total'] = $this->payment_model->calculate_paid_in_year($view['year']);
        $view['payments'] = $this->payment_model->get_list_in_year($year, $page, []);
        $view['subview'] = 'admin/trade/output';
        $this->load->view('admin/layout', $view);
    }

    public function create()
    {
        $view['year'] = date('Y');
        $view['input_total'] = $this->fee_model->calculate_total_in_year($view['year']);
        $view['output_total'] = $this->payment_model->calculate_paid_in_year($view['year']);
        $view['remain_total'] = $view['input_total'] - $view['output_total'];
        $view['subview'] = 'admin/trade/create';

        if ($this->validate()) {
            $data['title'] = $this->input->post('title');
            $data['amount'] = $this->input->post('amount');
            $data['description'] = $this->input->post('description');
            $data['paid_date'] = date('Y-m-d');
            $data['user_id'] = $this->session->userdata('user')['id'];

            if ($data['amount'] > $view['remain_total']) {
                $view['error'] = 'Khoản chi vượt quá khả năng chi trả.';
            } elseif ($this->payment_model->create($data)) {
                redirect('admin/output?year='.$view['year']);
            } else {
                $view['error'] = 'Máy chủ đang gặp sự cố. Vui lòng thử lại sau.';
            }
        }

        $this->load->view('admin/layout', $view);
    }

    protected function validate($id = 0)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('title', 'Tên khoản thu', 'required');
            $this->form_validation->set_rules('description', 'Ghi chú', 'required');
            $this->form_validation->set_rules('amount', 'Khoản tiền', 'required');
            $this->form_validation->set_message('required', '{field} không được để trống.');
            return $this->form_validation->run();
        }
        return FALSE;
    }
}
