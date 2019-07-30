<?php 
class M_hrd extends CI_Model{
    public $post = null;
    /* ==================== Start Informasi Profil ==================== */
    public function show_hrd($id=NULL)
    {
        $this->db->select("
            *,
            IF(biodata.jk='L', 'Laki-Laki' , 'Perempuan') AS jenis_kelamin                
        ");
        $this->db->from('user');
        $this->db->join('biodata', 'biodata.id_biodata = user.id_biodata');
        $this->db->where('user.level','hrd');
        $this->db->where('user.id_user',$id);
        $this->db->order_by('biodata.nama', 'ASC');
        return $this->db->get()->row();
    }
    public function store_hrd($id=NULL){
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

    /* ==================== Start Menu Master Data: Karyawan ==================== */
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
    public function store_karyawan($id=NULL){
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
    /* ==================== End Menu Master Data: Karyawan ==================== */

    /* ==================== Start Menu Master Data: Manajer ==================== */
    public function show_manajer($id=NULL)
    {
        if ( ! empty($id) ) {
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
        } else {
            $this->db->select("
                *,
                IF(biodata.jk='L', 'Laki-Laki' , 'Perempuan') AS jenis_kelamin                
            ");
            $this->db->from('user');
            $this->db->join('biodata', 'biodata.id_biodata = user.id_biodata');
            $this->db->where('user.level','manajer');
            $this->db->order_by('biodata.nama', 'ASC');
            return $this->db->get()->result_object();
        }
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
    /* ==================== End Menu Master Data: Manajer ==================== */

    /* ==================== Start Menu Master Data: Kategori ==================== */
	public function show_kategori($id=NULL){
        if ( ! empty($id) ) {
            return $this->db->get_where('kategori',['id_kategori'=>$id])->row();
        } else {
            $this->db->order_by('nama_kategori', 'ASC');
            return $this->db->get('kategori')->result_object();
        }
	}
	public function store_kategori($id=NULL){
        if ( ! empty($id) ) {
            $table='kategori';
            $data=[
                'nama_kategori' => $this->post['nama_kategori'],
            ];  
            $where=[
                'id_kategori' => $id,
            ];  
            return $this->db->update($table,$data,$where);
        } else {
            $table='kategori';
            $data= [
                'nama_kategori' => $this->post['nama_kategori'],
            ];		
            return $this->db->insert($table,$data);
        }
        
	}	
    /* ==================== End Menu Master Data: Kategori ==================== */

    /* ==================== Start Menu Master Data: Kriteria ==================== */
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
	public function store_kriteria($id=NULL){
        if ( ! empty($id) ) {
            $table='kriteria';
            $data=[
                'nama_kriteria' => $this->post['nama_kriteria'],
                'bobot' => $this->post['bobot'],
                'id_kategori' => $this->post['id_kategori'],
            ];  
            $where=[
                'id_kriteria' => $id,
            ];  
            return $this->db->update($table,$data,$where);
        } else {
            $table='kriteria';
            $data= [
                'nama_kriteria' => $this->post['nama_kriteria'],
                'bobot' => $this->post['bobot'],
                'id_kategori' => $this->post['id_kategori'],
            ];		
            return $this->db->insert($table,$data);
        }
        
	}	
    /* ==================== End Menu Master Data: Kriteria ==================== */

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

    /* ==================== Start Laporan: Penilaian ==================== */
    public function show_penilaian()
    {
        return $this->db->get('penilaian')->result_object();
    }
    public function show_penilaian_distinct_tanggal()
    {
        return $this->db->query('SELECT DISTINCT tanggal, DATE_FORMAT(tanggal, "%W,  %d %b %Y %T") AS tanggal_mod FROM penilaian ORDER BY tanggal ASC')->result_object();
    }
    /* ==================== End Laporan: Penilaian ==================== */

    /* ==================== Start Laporan: Hasil Akhir ==================== */
    public function start_end_penilaian()
    {
        return $this->db->query('
            SELECT
                (SELECT tanggal FROM penilaian ORDER BY tanggal ASC LIMIT 1 ) AS start_penilaian,
                (SELECT tanggal FROM penilaian ORDER BY tanggal DESC LIMIT 1 ) AS end_penilaian,
                (SELECT DATE_FORMAT(tanggal, "%Y") FROM penilaian ORDER BY tanggal ASC LIMIT 1 ) AS start_tahun,
                (SELECT DATE_FORMAT(tanggal, "%Y") FROM penilaian ORDER BY tanggal DESC LIMIT 1 ) AS end_tahun,
                (SELECT DATE_FORMAT(tanggal, "%M") FROM penilaian ORDER BY tanggal ASC LIMIT 1 ) AS start_bulan,
                (SELECT DATE_FORMAT(tanggal, "%M") FROM penilaian ORDER BY tanggal DESC LIMIT 1 ) AS end_bulan
            FROM penilaian WHERE 1 LIMIT 1
        ')->row();
    }
    public function tahun_penilaian()
    {
        return $this->db->query('
            SELECT DATE_FORMAT(tanggal,"%Y") AS tahun_penilaian FROM penilaian GROUP BY YEAR(tanggal) ORDER BY tanggal ASC
        ')->result_object();
    }
    public function bulan_penilaian()
    {
        return $this->db->query('
            SELECT
                tanggal,
                DATE_FORMAT(tanggal,"%Y") AS tahun_penilaian,
                DATE_FORMAT(tanggal,"%M") AS bulan_penilaian,
                DATE_FORMAT(tanggal,"%c") AS id_bulan
            FROM penilaian GROUP BY YEAR(tanggal),MONTH(tanggal) ORDER BY tanggal ASC
        ')->result_object();
    }
    public function nilai_mean($tahun,$bulan){
        return $this->db->query("
            SELECT *,
                id_user AS iduser,
                id_kriteria AS idkriteria,
                (SELECT
                    AVG(nilai)
                FROM penilaian
                WHERE id_user=iduser
                    AND id_kriteria=idkriteria
                    AND YEAR(tanggal)='{$tahun}'
                    AND MONTH(tanggal)='{$bulan}'
                ) AS nilai_mean
            FROM penilaian
            WHERE
                YEAR(tanggal)='{$tahun}'
                AND MONTH(tanggal)='{$bulan}'
                GROUP BY id_user,id_kriteria
        ")->result_object();
    }
    /* ==================== End Laporan: Hasil Akhir ==================== */
}