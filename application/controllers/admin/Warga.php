<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

    protected $tableWarga = "warga";
    protected $tableDaging = "daging";

    public function __construct()
    {
        parent::__construct();
        checkSessionPetugas();
    }

    public function index()
    {
        $data['citizens'] = $this->db->get($this->tableWarga)->result();
        $this->template->view('admin/warga/index', $data, "Data Warga");
    }

    public function addForm()
    {
        $data['meats'] = $this->db->get($this->tableDaging)->result();
        $this->template->view("admin/warga/add_form", $data, "Data Warga");
    }

    public function add()
    {
        $this->form_validation->set_rules('nama', 'Nama Warga', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[warga.nik]');
        $this->form_validation->set_rules('birth_place', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('birth_date', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('daging_qurban', 'Daging Qurban', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->addForm();
        }
        $data = $this->postData();

        $file  = uploadFile("image", uniqid() . time(), PATH_WARGA);

        if (!empty($file['error'])) {
            $this->session->set_flashdata('error_file', $file['error']);
            return $this->addForm();
        }

        $data += ["image" => $file];

        $insert = $this->db->insert($this->tableWarga, $data);

        if (!$insert) {
            $this->session->set_flashdata('error_insert', 'Gagal menambahkan data warga');
            return $this->addForm();
        }

        return redirect(base_url("admin/warga"));
    }

    public function editForm()
    {

        $data['citizen'] = $this->db->get_where($this->tableWarga, ['id_warga' => $this->uri->segment(4)])->row();
        $data['meats'] = $this->db->get($this->tableDaging)->result();
        $this->template->view("admin/warga/edit_form", $data, "Edit Data Warga");
    }

    public function update()
    {
        $oldWarga = $this->db->get_where($this->tableWarga, ['id_warga' => $this->uri->segment(4)])->row();

        if ($oldWarga->nik == $this->input->post('nik')) {
            $isUnique = "";
        } else {
            $isUnique = "|is_unique[warga.nik]";
        }

        $this->form_validation->set_rules('nama', 'Nama Warga', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required' . $isUnique);
        $this->form_validation->set_rules('birth_place', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('birth_date', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('daging_qurban', 'Daging Qurban', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->editForm();
        }

        $data = $this->postData(true);

        $file = $this->input->post('old_image');

        if (!empty($_FILES['image']['name'])) {
            $file = uploadFile("image", $file, PATH_WARGA);

            if (!empty($file['error'])) {
                $this->session->set_flashdata('error_file', $file['error']);
                return $this->editForm();
            }
        }

        $data += ["image" => $file];

        $this->db->where('id_warga', $this->uri->segment(4));
        $this->db->update($this->tableWarga, $data);

        return redirect(base_url("admin/warga"));
    }

    public function delete()
    {
        deleteImage($this->tableWarga, ["id_warga" => $this->uri->segment(4)], "image", PATH_WARGA);
        $this->db->delete($this->tableWarga, ['id_warga' => $this->uri->segment(4)]);
        return redirect(base_url("admin/warga"));
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
            "nik" => $this->input->post('nik'),
            "birth_place" => $this->input->post('birth_place'),
            "birth_date" => $this->input->post('birth_date'),
            "password" => password_hash($this->input->post('birth_date'), PASSWORD_BCRYPT),
            "id_daging" => $this->input->post('daging_qurban'),
            "gender" => $this->input->post('gender'),
            $x => date('Y-m-d H:i:s'),
        ];
        return $data;
    }
}

/* End of file Warga.php */