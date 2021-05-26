<?php



defined('BASEPATH') or exit('No direct script access allowed');

class WargaModel extends CI_Model
{
    protected $tableWarga = 'warga';
    protected $tableDaging = 'daging';

    public function wargaWithDaging($idWarga)
    {
        $this->db->select('t1.*,t2.nama_hewan');
        $this->db->from($this->tableWarga . " AS t1");
        $this->db->join($this->tableDaging . " AS t2", 't2.id_daging = t1.id_daging', 'INNER');
        $this->db->where('t1.id_warga', $idWarga);

        return $this->db->get()->row();
    }
}

/* End of file WargaModel.php */
