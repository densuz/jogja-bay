<?php 
class M_manajer extends CI_Model{
    public $post = null;
    /* ==================== Start Informasi Profil ==================== */
    public function show_manajer($id=NULL)
    {
        $this->db->select("
            *,
            IF(biodata.jk='L', 'Laki-Laki' , 'Perempuan') AS jenis_kelamin                
        ");
        $this->db->from('user');
        $this->db->join('biodata', 'biodata.id_biodata = user.id_biodata');
        $this->db->where('user.level','manajer');
        $this->db->where('user.id_user',$id);
        $this->db->order_by('biodata.nama', 'ASC');
        return $this->db->get()->row();
    }
    public function store_manajer($id=NULL){
        if ( ! empty($id) ) {
            if ( $this->store_user($id) ) {
                return $this->store_biodata($id);
            } else {
                $this->session->set_flashdata('msg', 'Maaf username sudah digunakan' );
                return FALSE;
            }
            
        } else {
            if ( $this->cek_user() ) {
                $this->store_biodata();
                $this->store_user();
                return TRUE;
            } else {
                $this->session->set_flashdata('msg', 'Maaf username sudah digunakan' );
                return TRUE;
            }
        }
        
	}
    /* ==================== End Informasi Profil ==================== */

    /* ==================== Start Store Biodata ==================== */
    protected function store_biodata($id=NULL)
    {
        if ( ! empty($id) ) {
            $table='biodata';
            $data= [
                'nama' => $this->post['nama'],
                'tgl_lahir' => $this->post['tgl_lahir'],
                'jk' => $this->post['jk'],
                'alamat' => $this->post['alamat'],
            ];
            # jika divisi tidak kosong
            if ( ! empty($this->post['id_divisi']) )
                $data['id_divisi'] =  $this->post['id_divisi'];

            $where=[
                'id_biodata' => $this->post['id_biodata'],
            ];  
            return $this->db->update($table,$data,$where);
        } else {
            $table='biodata';
            $data= [
                'nama' => $this->post['nama'],
                'tgl_lahir' => $this->post['tgl_lahir'],
                'jk' => $this->post['jk'],
                'alamat' => $this->post['alamat'],
            ];
            # jika divisi tidak kosong
            if ( ! empty($this->post['id_divisi']) )
                $data['id_divisi'] =  $this->post['id_divisi'];

            return $this->db->insert($table,$data);
        }
    }
    /* ==================== End Store Biodata ==================== */

    /* ==================== Start Store User ==================== */
    protected function store_user($id=NULL)
    {

        if ( ! empty($id) ) {
            
            if ( $this->cek_user($id) ) {
                $table='user';
                $data=[
                    'user_name' => $this->post['user_name'],
                    'level' => $this->post['level'],
                ];
    
                # jika password tidak kosong
                if ( ! empty($this->post['password']) )
                    $data['password'] =  $this->post['password'];
    
                $where=[
                    'id_user' => $id,
                ];
                $this->db->update($table,$data,$where);
                return TRUE;
            } else {
                return FALSE;
            }
              
        } else {
            $table='user';
            $data=[
                'user_name' => $this->post['user_name'],
                'level' => $this->post['level'],
                'id_biodata' => $this->db->insert_id(),
            ];

            # jika password tidak kosong
            if ( ! empty($this->post['password']) )
                $data['password'] =  $this->post['password'];

            $this->db->insert($table,$data);
            return TRUE;
        }
        
    }
    protected function cek_user($id=NULL)
    {
        $where= [
            'user_name'=> $this->post['user_name']
        ];
        if ( ! empty($id) ) {
            $this->db->where('id_user !=',$id);
            $this->db->where($where);
            return ($this->db->get('user')->num_rows() > 0 )? FALSE : TRUE ;
        } else {
            $this->db->where($where);
            return ($this->db->get('user')->num_rows() > 0 )? FALSE : TRUE ;
        }
                
    }
    /* ==================== End Store User ==================== */
}