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
    
    /* ==================== Start Penilaian ==================== */
    public function show_last_penilaian()
    {
        return $this->db->query('
            SELECT
                DISTINCT tanggal,
                DATE_FORMAT(tanggal, "%W,  %d %b %Y %T") AS mod_tanggal
            FROM penilaian
                ORDER BY tanggal DESC LIMIT 1
        ')->row();
    }
    public function show_karyawan($id=NULL)
    {
        if ( ! empty($id) ) {
            $this->db->select("
                *,
                IF(biodata.jk='L', 'Laki-Laki' , 'Perempuan') AS jenis_kelamin                
            ");
            $this->db->from('user');
            $this->db->join('biodata', 'biodata.id_biodata = user.id_biodata');
            $this->db->join('divisi', 'divisi.id_divisi = biodata.id_divisi');
            $this->db->where('user.level','karyawan');
            $this->db->where('user.id_user',$id);
            $this->db->order_by('biodata.nama', 'ASC');
            return $this->db->get()->row();
        } else {
            $this->db->select("
                *,
                IF(biodata.jk='L', 'Laki-Laki' , 'Perempuan') AS jenis_kelamin                
            ");
            $this->db->from('user');
            $this->db->join('biodata', 'biodata.id_biodata = user.id_biodata');
            $this->db->join('divisi', 'divisi.id_divisi = biodata.id_divisi');
            $this->db->where('user.level','karyawan');
            $this->db->order_by('biodata.nama', 'ASC');
            return $this->db->get()->result_object();
        }
    }
    public function show_kriteria($id=NULL){
        if ( ! empty($id) ) {
            $this->db->select("
                *,
                kriteria.bobot AS bobot_kriteria                
            ");
            $this->db->from('kriteria');
            $this->db->join('kategori', 'kategori.id_kategori = kriteria.id_kategori');
            $this->db->where('id_kriteria',$id);
            return $this->db->get_where()->row();
        } else {
            $this->db->select("
                *,
                kriteria.bobot AS bobot_kriteria                
            ");
            $this->db->from('kriteria');
            $this->db->join('kategori', 'kategori.id_kategori = kriteria.id_kategori');
            $this->db->order_by('kriteria.nama_kriteria', 'ASC');
            return $this->db->get()->result_object();
        }
    }
    public function store_penilaian(){
        $table='penilaian';
        $data=[];
        foreach ($this->post['id_user'] as $key => $value) {
            foreach ($this->post['id_kriteria_' .$value] as $key_sub => $value_sub) {
                $data[]= [
                    'id_user'=> $value,
                    'id_kriteria'=> $key_sub,
                    'nilai'=> $value_sub,
                    'tanggal'=> $this->post['tanggal'].' '.date('h:i:s'),
                ]; 
            }
        }
        $this->db->insert_batch($table,$data);
        return TRUE;
        // $this->session->set_flashdata('msg', $data );
        // return TRUE;
	}
    /* ==================== End Penilaian ==================== */

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