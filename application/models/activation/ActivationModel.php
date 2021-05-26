<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ActivationModel extends CI_Model
{
    protected $tableActivation = 'aktifasi';
    protected $tableWarga = 'warga';

    public function activationWithWarga()
    {
        $this->db->select('t1.*, t2.nik,t2.nama');
        $this->db->from($this->tableActivation . " AS t1");
        $this->db->join($this->tableWarga . " AS t2", 't2.id_warga = t1.id_warga', 'INNER');
        return $this->db->get()->result();
    }
}

/* End of file ActivationModel.php */