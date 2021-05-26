<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daging_qurban extends CI_Controller
{

    protected $tableDaging = "daging";

    public function __construct()
    {
        parent::__construct();
        checkSessionPetugas();
    }

    public function index()
    {
        $data['meats'] = $this->db->get($this->tableDaging)->result();
        $this->template->view('admin/daging_qurban/index', $data, "Daging Qurban");
    }

    public function addForm()
    {
        $this->template->view("admin/daging_qurban/add_form", [], "Tambah Persediaan");
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_hewan', 'Nama User', 'required');
        $this->form_validation->set_rules('sisa_stok', 'Username', 'required');
        $this->form_validation->set_rules('total_stok', 'Password User', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->addForm();
        }
        $data = $this->postData();

        $file  = uploadFile("image", uniqid() . time(), PATH_QURBAN);

        if (!empty($file['error'])) {
            $this->session->set_flashdata('error_file', $file['error']);
            return $this->addForm();
        }

        $data += ["image" => $file];

        $insert = $this->db->insert($this->tableDaging, $data);

        if (!$insert) {
            $this->session->set_flashdata('error_insert', 'Gagal menambahkan persediaan daging');
            return $this->addForm();
        }

        return redirect(base_url("admin/daging_qurban/"));
    }

    public function editForm()
    {
        $data['meat'] = $this->db->get_where($this->tableDaging, ['id_daging' => $this->uri->segment(4)])->row();
        $this->template->view("admin/daging_qurban/edit_form", $data, "Edit Persediaan");
    }

    public function update()
    {
        $this->form_validation->set_rules('nama_hewan', 'Nama User', 'required');
        $this->form_validation->set_rules('sisa_stok', 'Username', 'required');
        $this->form_validation->set_rules('total_stok', 'Password User', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->editForm();
        }
        $data = $this->postData(true);

        $file = $this->input->post('old_image');

        if (!empty($_FILES['image']['name'])) {
            $file = uploadFile("image", $file, PATH_QURBAN);

            if (!empty($file['error'])) {
                $this->session->set_flashdata('error_file', $file['error']);
                return $this->editForm();
            }
        }

        $data += ["image" => $file];

        $this->db->where('id_daging', $this->uri->segment(4));
        $this->db->update($this->tableDaging, $data);
        return redirect(base_url("admin/daging_qurban"));
    }

    public function delete()
    {
        deleteImage($this->tableDaging, ["id_daging" => $this->uri->segment(4)], "image", PATH_QURBAN);
        $this->db->where('id_daging', $this->uri->segment(4));
        $this->db->delete($this->tableDaging);
        return redirect(base_url("admin/daging_qurban"));
    }

    private function postData($isForUpdate = false)
    {

        if ($isForUpdate) {
            $x = "update_date";
        } else {
            $x = "create_date";
        }


        $data = [
            "nama_hewan" => $this->input->post('nama_hewan'),
            "total_stok" => setAngka($this->input->post('total_stok')),
            "sisa_stok" => setAngka($this->input->post('sisa_stok')),
            $x => date('Y-m-d H:i:s'),
        ];
        return $data;
    }
}

/* End of file Daging_qurban.php */
