<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (! $this->input->is_cli_request()) {
            show_404();
        }
    }

    public function index()
    {
        //
    }
}
