<?php 
class M_hrd extends CI_Model{
    public $post = null;
    /* ==================== Start Menu Master Data: Divisi ==================== */
	public function show_divisi($id=NULL){
        if ( ! empty($id) ) {
            return $this->db->get_where('divisi',['id_divisi'=>$id])->row();
        } else {
            $this->db->order_by('nama_divisi', 'ASC');
            return $this->db->get('divisi')->result_object();
        }
	}
	public function store_divisi($id=NULL){
        if ( ! empty($id) ) {
            $table='divisi';
            $data=[
                'nama_divisi' => $this->post['nama_divisi'],
            ];  
            $where=[
                'id_divisi' => $id,
            ];  
            return $this->db->update($table,$data,$where);
        } else {
            $table='divisi';
            $data= [
                'nama_divisi' => $this->post['nama_divisi'],
            ];		
            return $this->db->insert($table,$data);
        }
        
	}	
    /* ==================== End Menu Master Data: Divisi ==================== */
}