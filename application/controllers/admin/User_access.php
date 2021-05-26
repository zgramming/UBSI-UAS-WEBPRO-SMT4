<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_access extends CI_Controller
{

    protected $tablePetugas = 'petugas';

    public function __construct()
    {
        parent::__construct();
        checkSessionPetugas();
    }


    public function index()
    {

        $data['users'] = $this->db->get($this->tablePetugas)->result();
        $this->template->view('admin/user_access/useraccess', $data, "Akses User");
    }

    public function addForm()
    {
        $data['user'] = $this->db->get_where($this->tablePetugas, ['id_petugas' => $this->uri->segment(4)])->row();
        $this->template->view("admin/user_access/add_form", $data, "Tambah User");
    }

    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password User', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->addForm();
        }
        $data = $this->postData();

        $file  = uploadFile("image", uniqid() . time(), PATH_USER_ACCESS);

        if (!empty($file['error'])) {
            $this->session->set_flashdata('error_file', $file['error']);
            return $this->addForm();
        }

        $data += ["image" => $file];

        $insert = $this->db->insert($this->tablePetugas, $data);

        if (!$insert) {
            $this->session->set_flashdata('error_insert', 'Gagal menambahkan user');
            return $this->addForm();
        }

        return redirect(base_url("admin/user_access/"));
    }

    public function editForm()
    {
        $data['user'] = $this->db->get_where($this->tablePetugas, ['id_petugas' => $this->uri->segment(4)])->row();
        $this->template->view("admin/user_access/edit_form", $data, "Edit User");
    }

    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Email User', 'required');
        $this->form_validation->set_rules('password', 'Password User', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            return $this->editForm();
        }
        $data = $this->postData(true);

        $file = $this->input->post('old_image');

        if (!empty($_FILES['image']['name'])) {
            $file = uploadFile("image", $file, PATH_USER_ACCESS);

            if (!empty($file['error'])) {
                $this->session->set_flashdata('error_file', $file['error']);
                return $this->editForm();
            }
        }

        $data += ["image" => $file];

        $this->db->where('id_petugas', $this->uri->segment(4));
        $this->db->update($this->tablePetugas, $data);
        return redirect(base_url("admin/user_access"));
    }

    public function delete()
    {
        deleteImage($this->tablePetugas, ["id_petugas" => $this->uri->segment(4)], "image", PATH_USER_ACCESS);
        $this->db->where('id_petugas', $this->uri->segment(4));
        $this->db->delete($this->tablePetugas);
        return redirect(base_url("admin/user_access"));
    }

    private function postData($isForUpdate = false)
    {

        if ($isForUpdate) {
            $x = "update_date";
        } else {
            $x = "create_date";
        }


        $data = [
            "nama" => $this->input->post('nama'),
            "username" => $this->input->post('username'),
            "password" => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            "role" => $this->input->post('role'),
            $x => date('Y-m-d H:i:s'),
        ];
        return $data;
    }
}

/* End of file User_access.php */