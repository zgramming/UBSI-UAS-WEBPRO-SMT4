<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Activation extends CI_Controller
{

    protected $tableWarga = "warga";
    protected $tableActivation = "aktifasi";

    public function __construct()
    {
        parent::__construct();
        checkSessionPetugas();
    }

    public function index()
    {
        $data['activations'] = $this->ActivationModel->activationWithWarga();

        $this->template->view('admin/activation/index', $data, "Data Aktifasi Warga");
    }

    public function formActivation($idAktifasi, $idWarga)
    {

        $data['activation'] = $this->db->get_where($this->tableActivation, ['id_aktifasi' => $idAktifasi])->row();
        $data['citizen'] = $this->db->get_where($this->tableWarga, ['id_warga' => $idWarga])->row();
        $this->load->view('admin/activation/form_activation', $data);
    }

    public function updateStatus($idAktifasi)
    {

        $this->form_validation->set_rules('status_aktifasi', 'Status Aktifasi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header('400');
            $this->data['message'] = array_values($this->form_validation->error_array())[0];
            echo json_encode($this->data);
            return false;
        }

        $data = [
            "status_aktifasi" => $this->input->post('status_aktifasi')
        ];

        $this->db->where('id_aktifasi', $idAktifasi);
        $this->db->update($this->tableActivation, $data);

        $this->data['message'] = "Status Aktifasi warga berhasil diperbaharui";

        echo json_encode($this->data);
        return true;
    }
}

/* End of file Activation.php */
