<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    protected $tableWarga = 'warga';
    protected $tableDaging = 'daging';
    protected $tableAktifasi = 'aktifasi';
    protected $tablePengambilan = 'pengambilan';
    protected $sessionWarga = 'session_warga';

    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $data = [];
        $this->load->view('frontend/login', $data);
    }

    public function beranda()
    {

        $warga = $this->session->userdata($this->sessionWarga);
        if (empty($warga)) {
            return  redirect(base_url('home'));
        }

        $data['warga'] = $this->WargaModel->wargaWithDaging($warga->id_warga);
        $data['meats'] = $this->db->get($this->tableDaging)->result_array();
        $data['aktifasi'] = $this->db->where('id_warga', $warga->id_warga)->get($this->tableAktifasi)->row_array();
        $data['pengambilan'] = $this->db->where('id_warga', $warga->id_warga)->get($this->tablePengambilan)->row_array();
        $data['isYouAlreadyTake'] = $this->db->where('id_warga', $warga->id_warga)->from($this->tablePengambilan)->count_all_results();

        $data['daftarPengambilan'] = $this->PengambilanModel->getAlreadyTookMeatExceptYou($warga->id_warga);

        $this->load->view('frontend/beranda', $data);
    }

    public function login()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|min_length[16]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header('400');
            $this->data['message'] = array_values($this->form_validation->error_array())[0];
            echo json_encode($this->data);
            return false;
        }

        $nik = $this->input->post('nik');
        $password = $this->input->post('password');

        $warga = $this->db->get_where($this->tableWarga, ['nik' => $nik])->row();

        if (empty($warga)) {
            $this->output->set_status_header('404');
            $this->data['message'] = 'NIK tidak terdaftar dalam aplikasi,silahkan hubungi DKM setempat';
            echo json_encode($this->data);
            return false;
        }

        if (!password_verify($password, $warga->password)) {
            $this->output->set_status_header('404');
            $this->data['message'] = 'Password tidak valid';
            echo json_encode($this->data);
            return false;
        }
        $sessionUser = ['session_warga' => $warga];

        $this->session->set_userdata($sessionUser);

        $result['redirect_url'] = base_url('beranda');
        $result['status'] = 'success';
        $result['message']  = 'Berhasil login !';
        $this->output->set_output(json_encode($result));
        $string = $this->output->get_output();
        echo $string;
        exit();
    }

    public function form_upload_activation($idAktifasi)
    {
        $warga = $this->session->userdata($this->sessionWarga);
        $data['warga'] = $this->db->where('id_warga', $warga->id_warga)->get($this->tableWarga)->row();
        $data['activation'] = $this->db->get_where($this->tableAktifasi, ['id_aktifasi' => $idAktifasi])->row();

        $this->load->view('frontend/form_upload_activation', $data);
    }

    public function insertOrUpdateActivation()
    {
        $warga = $this->session->userdata($this->sessionWarga);
        // $isWargaAlreadyActivation = $this->db->where('id_warga', $warga->id_warga)->get($this->tableAktifasi)->row_array();
        $wargaWithActivation = $this->db->select('t2.foto_diri,t2.foto_ktp')
            ->from($this->tableWarga . " AS t1")
            ->join($this->tableAktifasi . " AS t2", "t2.id_warga = t1.id_warga", "INNER")
            ->where('t1.id_warga', $warga->id_warga)
            ->get()->result_array();

        if (empty($wargaWithActivation)) {
            /// Insert

            $ktp = $this->uploadFileActivation('file_ktp', 'fotoKTP-' . $warga->id_warga);
            if ($ktp['status'] == "error") {
                $this->output->set_status_header('400');
                $result['status'] = "error";
                $result['message'] = $ktp['message'];
                echo json_encode($result);
                return false;
            }

            $fotoProfile = $this->uploadFileActivation('file_profile', 'fotoProfile-' . $warga->id_warga);

            if ($fotoProfile['status'] == "error") {
                $this->output->set_status_header('400');
                $result['status'] = "error";
                $result['message'] = $fotoProfile['message'];
                echo json_encode($result);
                return false;
            }

            $data = [
                "id_warga" => $warga->id_warga,
                'status_aktifasi' => 'proses_aktifasi',
                'foto_ktp' => $ktp['filename'],
                'foto_diri' => $fotoProfile['filename'],
                'tanggal_aktifasi' => date('Y-m-d H:i:s'),
                'create_date' => date('Y-m-d H:i:s'),
                'create_by' => $warga->id_warga,
            ];

            $insert  = $this->db->insert($this->tableAktifasi, $data);

            if (!$insert) {
                $this->output->set_status_header('400');
                $result['status'] = "error";
                $result['message'] = "Gagal melakukan aktifasi, coba beberapa saat lagi";
                echo json_encode($result);
                return false;
            }

            $result['status'] = "success";
            $result['message'] = "Berhasil melakukan aktifasi, tunggu DKM untuk melakukan validasi data diri ya...";
            echo json_encode($result);
        } else {
            /// Update
            echo "ada";
        }
    }

    public function uploadFileActivation($inputFile)
    {

        $config['upload_path'] = PATH_AKTIFASI;
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']  = '1000';
        $config['overwrite'] = TRUE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($inputFile)) {
            $result['status'] = 'error';
            $result['message'] = $this->upload->display_errors();
            return $result;
        }

        $file = $this->upload->data('file_name');
        $result['status'] = "success";
        $result['message'] = "Berhasil Upload File";
        $result['filename'] = $file;

        return $result;
    }

    public function logout()
    {

        $this->session->unset_userdata($this->sessionWarga);

        return redirect(base_url("home"));
    }
}

/* End of file Home.php */
