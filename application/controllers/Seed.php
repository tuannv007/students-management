<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller
{
    public function index()
    {
        $this->db->insert('users', [
            'name' => 'system',
            'account' => 'system',
            'email' => 'system@system.com',
            'password' => sha1('system'),
        ]);
    }
}
