<?php 
class M_hrd extends CI_Model{
    public $post = null;	
    /* ==================== Start proses simpan divisi ==================== */
	public function store_divisi(){
        $data= [
            'nama_divisi' => $this->post['nama_divisi'],
        ];		
        return $this->db->insert('divisi',$data);
	}	
    /* ==================== End proses simpan divisi ==================== */
}