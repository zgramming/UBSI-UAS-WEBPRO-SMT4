<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengambilan extends CI_Controller
{

    protected $tablePengambilan = "pengambilan";
    protected $tableWarga = "warga";
    protected $tablePetugas = "petugas";

    public function __construct()
    {
        parent::__construct();
        checkSessionPetugas();
    }

    public function index()
    {

        $data['pengambilan'] = $this->PengambilanModel->getDataActivation();
        $this->template->view('admin/pengambilan/index', $data, "Data Pengambilan");
    }

    public function formStatusPengambilan($idPengambilan, $idWarga)
    {
        $data['pengambilan'] = !empty($idPengambilan) ? $this->db->get_where($this->tablePengambilan, ['id_pengambilan' => $idPengambilan])->row() : null;
        $data['citizen'] = $this->db->get_where($this->tableWarga, ['id_warga' => $idWarga])->row();

        $this->load->view('admin/pengambilan/form_status_pengambilan', $data);
    }

    public function updateStatusPengambilan($idPengambilan, $idWarga)
    {
        $this->form_validation->set_rules('status_pengambilan', 'Status Pengambilan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header('400');
            $this->data['message'] = array_values($this->form_validation->error_array())[0];
            echo json_encode($this->data);
            return false;
        }

        $data = [
            "status_pengambilan" => $this->input->post('status_pengambilan')
        ];

        $isWargaExists = $this->db->select('id_pengambilan')->from($this->tablePengambilan)->where('id_warga', $idWarga)->get()->result_array();

        $petugas = $this->session->userdata('user');
        if (empty($isWargaExists)) {

            $data = [
                "id_warga" => $idWarga,
                "id_petugas" => $petugas->id_petugas,
                "status_pengambilan" => $this->input->post('status_pengambilan'),
                "jumlah" => 1,
                "tanggal_pengambilan" => date('Y-m-d H:i:s'),
                "create_date" => date('Y-m-d H:i:s'),
                "create_by" => $petugas->id_petugas
            ];

            $insert  = $this->db->insert($this->tablePengambilan, $data);

            if (!$insert) {
                $this->output->set_status_header('400');
                $this->data['message'] = "Gagal menambahkan data pengambilan";
                echo json_encode($this->data);
                return false;
            }

            $this->data['message'] = "Data pengambilan daging berhasil ditambahkan";
        } else {

            $this->db->where('id_pengambilan', $idPengambilan);
            $update = $this->db->update($this->tablePengambilan, [
                'status_pengambilan' => $this->input->post('status_pengambilan'),
                'update_date' => date('Y-m-d H:i:s'),
                'update_by' => $petugas->id_petugas,
            ]);

            if (!$update) {
                $this->output->set_status_header('400');
                $this->data['message'] = "Gagal memperbaharui data pengambilan";
                echo json_encode($this->data);
                return false;
            }
            $this->data['message'] = "Status Pengambilan berhasil diperbaharui";
        }

        echo json_encode($this->data);
        return true;
    }
}

/* End of file Pengambilan.php */