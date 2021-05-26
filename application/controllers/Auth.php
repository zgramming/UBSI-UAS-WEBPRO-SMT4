<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    protected $tabelPetugas = 'petugas';
    protected $sessionPetugas = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('auth/login', []);
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password User', 'required|min_length[5]|max_length[8]');

        if ($this->form_validation->run() ==  FALSE) {
            return $this->index();
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where($this->tabelPetugas, ['username' => $username])->row();
        if (empty($user)) {
            $this->session->set_flashdata('error_login', 'Username salah');
            return $this->index();
        }

        if (!password_verify($password, $user->password)) {
            $this->session->set_flashdata('error_login', 'Password salah');
            return $this->index();
        }

        $sessionUser = array($this->sessionPetugas => $user);

        $this->session->set_userdata($sessionUser);

        return redirect(base_url("admin/pengambilan"));
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_PETUGAS);


        return redirect(base_url("auth"));
    }
}

/* End of file Auth.php */
