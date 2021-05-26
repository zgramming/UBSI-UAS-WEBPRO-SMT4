<?php


defined('BASEPATH') or exit('No direct script access allowed');

class PengambilanModel extends CI_Model
{
    protected $tablePengambilan = "pengambilan";
    protected $tableWarga = "warga";
    protected $tablePetugas = "petugas";
    protected $tableActivation = "aktifasi";
    protected $tableDaging = "daging";

    public function getDataActivation()
    {
        $this->db->select('t1.status_aktifasi,t2.id_warga,t2.nik,t2.nama as namaWarga');
        $this->db->from($this->tableActivation . " AS t1");
        $this->db->join($this->tableWarga . " AS t2", 't2.id_warga = t1.id_warga', 'INNER');
        // $this->db->where("t1.status_aktifasi", "sudah_aktifasi");
        return $this->db->get()->result();
    }

    public function pengambilanWithWargaAndPetugas($idWarga)
    {
        $this->db->select('t1.*,t2.nama as namaWarga,t3.nama as namaPetugas');
        $this->db->from($this->tablePengambilan . " AS t1");
        $this->db->join($this->tableWarga . " AS t2", 't2.id_warga = t1.id_warga', 'INNER');
        $this->db->join($this->tablePetugas . " AS t3", 't3.id_petugas = t1.id_petugas', 'INNER');
        $this->db->where('t2.id_warga', $idWarga);
        return $this->db->get()->row_array();
    }


    public function getAlreadyTookMeatExceptYou($idWarga)
    {
        $this->db->select(' t1.status_pengambilan, t1.tanggal_pengambilan, t1.jumlah,
                            t2.nama as namaWarga, t2.nik as nikWarga, t2.image as imageWarga,
                            t3.nama as namaPetugas, t3.image as imagePetugas,
                            t4.nama_hewan, t4.image as imageHewan
                            ');
        $this->db->from($this->tablePengambilan . " AS t1");
        $this->db->join($this->tableWarga . " AS t2", 't2.id_warga = t1.id_warga', 'INNER');
        $this->db->join($this->tablePetugas . " AS t3", 't3.id_petugas = t1.id_petugas', 'INNER');
        $this->db->join($this->tableDaging . " AS t4", 't4.id_daging = t2.id_daging', 'INNER');
        $this->db->where('t1.status_pengambilan', 'sudah_diterima');
        $this->db->where('t2.id_warga !=', $idWarga);
        return $this->db->get()->result_array();
    }
}

/* End of file PengambilanModel.php */
