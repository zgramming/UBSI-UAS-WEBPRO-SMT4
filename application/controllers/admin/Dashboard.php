<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        checkSessionPetugas();
    }

    public function index()
    {
        $this->template->view('admin/dashboard');
    }
}

/* End of file Dashboard.php */
