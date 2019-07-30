<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Hrd extends MY_Controller
    {
        public function __construct(){
            parent::__construct();

            /* jika level bukan manajer makan user tidak berhak mengakses halaman ini */
            if($this->session->userdata('status') !=1  && $this->session->userdata('level') != "hrd"){
                redirect(base_url("auth"));
            }
            $this->data = new stdClass();
            $this->load->model(['M_hrd']);
        }
        /* ==================== Start Menu Beranda ==================== */
        public function index()
        {
            $this->view = $this->session->userdata('level') .'/beranda';
            $this->render_pages();
        }
        /* ==================== End Menu Beranda ==================== */
        
        /* ==================== Start Informasi Profil ==================== */
        public function form_hrd()
        {
            $row= $this->M_hrd->show_hrd( $this->uri->segment(3) );
            $this->data->html= '
                <form action="'.base_url( $this->session->userdata('level') ).'/store-hrd" id="dataStore">
                    <div class="form-group">
                        <label>Nama :</label>
                        <input value="'.$row->nama.'" name="nama" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir :</label>
                        <input value="'.$row->tgl_lahir.'" name="tgl_lahir" type="date" class="form-control" required="" placeholder="Masukan nama divisi">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin :</label>
                        '.$this->jenis_kelamin($row->jk).'
                    </div>
                    <div class="form-group">
                        <label>Alamat :</label>
                        <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini" required="">'.$row->alamat.'</textarea>
                    </div>
                    <div class="form-group">
                        <label>Username :</label>
                        <input readonly value="'.$row->user_name.'" name="user_name" type="text" class="form-control" required="" placeholder="Masukan username">
                    </div>
                    <div class="form-group">
                        <label>Password :</label>
                        <input value="" name="password" type="password" class="form-control" placeholder="**********">
                    </div>
                    <input value="'.$row->id_biodata.'" name="id_biodata" type="hidden" >
                    <input value="'.$row->id_user.'" name="id" type="hidden" >
                    <input value="'.$row->level.'" name="level" type="hidden" >
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            ';
            
            echo json_encode($this->data);
        }
        public function store_hrd()
        {
            echo $this->store_data('hrd');
        } 
        /* ==================== End Informasi Profil ==================== */

        /* ==================== Start Menu Master Data: karyawan ==================== */
        public function karyawan()
        {
            $this->content['rows']= $this->M_hrd->show_karyawan();
            $this->view = $this->session->userdata('level') .'/karyawan';
            $this->render_pages();
        }
        public function form_karyawan()
        {
            if ( ! empty($this->uri->segment(3)) ) {
                $row= $this->M_hrd->show_karyawan( $this->uri->segment(3) );
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-karyawan" id="dataStore">
                        <div class="form-group">
                            <label>Nama Manajer :</label>
                            <input value="'.$row->nama.'" name="nama" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir :</label>
                            <input value="'.$row->tgl_lahir.'" name="tgl_lahir" type="date" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            '.$this->jenis_kelamin($row->jk).'
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini" required="">'.$row->alamat.'</textarea>
                        </div>
                        <div class="form-group">
                            <label>Pilih Divisi :</label>
                            <select name="id_divisi" class="form-control" required="">'.$this->option_divisi($row->id_divisi).'</select>
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input readonly value="'.$row->user_name.'" name="user_name" type="text" class="form-control" required="" placeholder="Masukan username">
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input value="" name="password" type="password" class="form-control" placeholder="**********">
                        </div>
                        <input value="'.$row->id_biodata.'" name="id_biodata" type="hidden" >
                        <input value="'.$row->id_user.'" name="id" type="hidden" >
                        <input value="'.$row->level.'" name="level" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            } else {
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-karyawan" id="dataStore">
                        <div class="form-group">
                            <label>Nama Karyawan :</label>
                            <input name="nama" type="text" class="form-control" required="" placeholder="Masukan nama karyawan">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir :</label>
                            <input name="tgl_lahir" type="date" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            '.$this->jenis_kelamin().'
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pilih Divisi :</label>
                            <select name="id_divisi" class="form-control" required="">'.$this->option_divisi().'</select>
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input name="user_name" type="text" class="form-control" required="" placeholder="Masukan username">
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input name="password" type="password" class="form-control" required="" placeholder="**********">
                        </div>
                        <input value="karyawan" name="level" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            }
            
            echo json_encode($this->data);
        }
        public function store_karyawan()
        {
            echo $this->store_data('karyawan');
        }
        /* ==================== End Menu Master Data: karyawan ==================== */

        /* ==================== Start Menu Master Data: manajer ==================== */
        public function manajer()
        {
            $this->content['rows']= $this->M_hrd->show_manajer();
            $this->view = $this->session->userdata('level') .'/manajer';
            $this->render_pages();
        }
        public function form_manajer()
        {
            if ( ! empty($this->uri->segment(3)) ) {
                $row= $this->M_hrd->show_manajer( $this->uri->segment(3) );
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-manajer" id="dataStore">
                        <div class="form-group">
                            <label>Nama Manajer :</label>
                            <input value="'.$row->nama.'" name="nama" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir :</label>
                            <input value="'.$row->tgl_lahir.'" name="tgl_lahir" type="date" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            '.$this->jenis_kelamin($row->jk).'
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini" required="">'.$row->alamat.'</textarea>
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input readonly value="'.$row->user_name.'" name="user_name" type="text" class="form-control" required="" placeholder="Masukan username">
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input value="" name="password" type="password" class="form-control" placeholder="**********">
                        </div>
                        <input value="'.$row->id_biodata.'" name="id_biodata" type="hidden" >
                        <input value="'.$row->id_user.'" name="id" type="hidden" >
                        <input value="'.$row->level.'" name="level" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            } else {
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-manajer" id="dataStore">
                        <div class="form-group">
                            <label>Nama Manajer :</label>
                            <input name="nama" type="text" class="form-control" required="" placeholder="Masukan nama manajer">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir :</label>
                            <input name="tgl_lahir" type="date" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            '.$this->jenis_kelamin().'
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            <input name="user_name" type="text" class="form-control" required="" placeholder="Masukan username">
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input name="password" type="password" class="form-control" required="" placeholder="**********">
                        </div>
                        <input value="manajer" name="level" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            }
            
            echo json_encode($this->data);
        }
        public function store_manajer()
        {
            echo $this->store_data('manajer');
        }
        /* ==================== End Menu Master Data: manajer ==================== */

        /* ==================== Start Menu Master Data: kategori ==================== */
        public function kategori()
        {
            $this->content['rows']= $this->M_hrd->show_kategori();
            $this->view = $this->session->userdata('level') .'/kategori';
            $this->render_pages();
        }
        public function form_kategori()
        {
            if ( ! empty($this->uri->segment(3)) ) {
                $row= $this->M_hrd->show_kategori( $this->uri->segment(3) );
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-kategori" id="dataStore">
                        <div class="form-group">
                            <label>Nama Divisi :</label>
                            <input value="'.$row->nama_kategori.'" name="nama_kategori" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <input value="'.$row->id_kategori.'" name="id" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            } else {
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-kategori" id="dataStore">
                        <div class="form-group">
                            <label>Nama Kategori :</label>
                            <input name="nama_kategori" type="text" class="form-control" required="" placeholder="Masukan nama kategori">
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            }
            
            echo json_encode($this->data);
        }
        public function store_kategori()
        {
            echo $this->store_data('kategori');
        }
        /* ==================== End Menu Master Data: kategori ==================== */

        /* ==================== Start Menu Master Data: Kriteria ==================== */
        public function kriteria()
        {
            $this->content['rows']= $this->M_hrd->show_kriteria();
            $this->view = $this->session->userdata('level') .'/kriteria';
            $this->render_pages();
        }
        public function form_kriteria()
        {
            if ( ! empty($this->uri->segment(3)) ) {
                $row= $this->M_hrd->show_kriteria( $this->uri->segment(3) );
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-kriteria" id="dataStore">
                        <div class="form-group">
                            <label>Nama Kriteria :</label>
                            <input value="'.$row->nama_kriteria.'" name="nama_kriteria" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <div class="form-group">
                            <label>Bobot :</label>
                            <input value="'.$row->bobot_kriteria.'" step="0.01" name="bobot" type="number" class="form-control" required="" placeholder="ex: 0,5">
                        </div>
                        <div class="form-group">
                            <label>Pilih Kategori Kriteria :</label>
                            <select name="id_kategori" class="form-control" required="">'.$this->option_kategori($row->id_kategori).'</select>
                        </div>
                        <input value="'.$row->id_kriteria.'" name="id" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            } else {
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-kriteria" id="dataStore">
                        <div class="form-group">
                            <label>Nama Kriteria :</label>
                            <input name="nama_kriteria" type="text" class="form-control" required="" placeholder="Masukan nama kriteria">
                        </div>
                        <div class="form-group">
                            <label>Bobot :</label>
                            <input step="0.01" name="bobot" type="number" class="form-control" required="" placeholder="ex: 0,5">
                        </div>
                        <div class="form-group">
                            <label>Pilih Kategori Kriteria :</label>
                            <select name="id_kategori" class="form-control" required="">'.$this->option_kategori().'</select>
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            }
            
            echo json_encode($this->data);
        }
        public function store_kriteria()
        {
            echo $this->store_data('kriteria');
        }
        /* ==================== End Menu Master Data: Kriteria ==================== */

        /* ==================== Start Menu Master Data: divisi ==================== */
        public function divisi()
        {
            $this->content['rows']= $this->M_hrd->show_divisi();
            $this->view = $this->session->userdata('level') .'/divisi';
            $this->render_pages();
        }
        public function form_divisi()
        {
            if ( ! empty($this->uri->segment(3)) ) {
                $row= $this->M_hrd->show_divisi( $this->uri->segment(3) );
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-divisi" id="dataStore">
                        <div class="form-group">
                            <label>Nama Divisi :</label>
                            <input value="'.$row->nama_divisi.'" name="nama_divisi" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <input value="'.$row->id_divisi.'" name="id" type="hidden" >
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            } else {
                $this->data->html= '
                    <form action="'.base_url( $this->session->userdata('level') ).'/store-divisi" id="dataStore">
                        <div class="form-group">
                            <label>Nama Divisi :</label>
                            <input name="nama_divisi" type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                ';
            }
            
            echo json_encode($this->data);
        }
        public function store_divisi()
        {
            echo $this->store_data('divisi');
        }
        /* ==================== End Menu Master Data: divisi ==================== */
        
        /* ==================== Start Data Store ==================== */
        public function store_data($sub_prefix)
        {
            $funct = 'store_'.$sub_prefix; 
            if ( ! empty($this->input->post('id')) ) {
                $this->M_hrd->post= $this->input->post();
                if ( $this->M_hrd->$funct($this->input->post('id')) ) {
                    if ( ! empty($this->session->flashdata('msg')) ) {
                        $this->data->stats  = FALSE;  
                        $this->data->msg    = $this->session->flashdata('msg');  
                    }
                    else {
                        $this->data->stats  = TRUE;  
                        $this->data->msg    = 'Data berhasil diubah';  
                    }
                } else {
                    $this->data->stats  = FALSE;  
                    $this->data->msg    = 'Data gagal diubah';
                }
            } else {
                $this->M_hrd->post= $this->input->post();
                if ( $this->M_hrd->$funct() ) {
                    if ( ! empty($this->session->flashdata('msg')) ) {
                        $this->data->stats  = FALSE;  
                        $this->data->msg    = $this->session->flashdata('msg');  
                    }
                    else {
                        $this->data->stats  = TRUE;  
                        $this->data->msg    = 'Data berhasil disimpan';  
                    } 
                } else {
                    $this->data->stats  = FALSE;  
                    $this->data->msg    = 'Data gagal disimpan';
                }
            }
            
            return json_encode($this->data);
        }
        /* ==================== End Data Store ==================== */
        
        /* ==================== Start Select Option Pilih Divisi ==================== */
        public function option_divisi($selected=NULL)
        {
            $this->data->html= '';
            $this->data->html.= '<option value="" '.(! empty($selected) ? 'selected' : 'selected disabled' ).'> -- Pilih Divisi -- </option>';            
            foreach ($this->M_hrd->show_divisi() as $key => $value) {
                $this->data->html .= '
                    <option '.( empty($id)? (($selected==$value->id_divisi)? 'selected' : NULL) : NULL ).' value="'.$value->id_divisi.'">'.$value->nama_divisi.'
                ';
            }

            return $this->data->html;
        }
        /* ==================== End Select Option Pilih Divisi ==================== */

        /* ==================== Start Select Option Pilih Kategori Kriteria ==================== */
        public function option_kategori($selected=NULL)
        {
            $this->data->html= '';
            $this->data->html.= '<option value="" '.(! empty($selected) ? 'selected' : 'selected disabled' ).'> -- Pilih Kategori Kriteria -- </option>';            
            foreach ($this->M_hrd->show_kategori() as $key => $value) {
                $this->data->html .= '
                    <option '.( empty($id)? (($selected==$value->id_kategori)? 'selected' : NULL) : NULL ).' value="'.$value->id_kategori.'">'.$value->nama_kategori.'
                ';
            }

            return $this->data->html;
        }
        /* ==================== End Select Option Pilih Kategori Kriteria ==================== */

        /* ==================== Start Jenis Kelamin ==================== */
        public function jenis_kelamin($selected=NULL)
        {
            $this->data->jk= [
                ['jk'=>'L','ket'=>'Laki-Laki'],
                ['jk'=>'P','ket'=>'Perempuan']
            ];
            $this->data->html= '';
            foreach ($this->data->jk as $key => $value) {
                $this->data->html .= '
                    <div class="form-check">
                        <label class="form-check-label">
                            <input '.( empty($id)? (($selected==$value['jk'])? 'checked' : NULL) : NULL ).' type="radio" class="form-check-input" value="'.$value['jk'].'" name="jk" required="">'.$value['ket'].'
                        </label>
                    </div>
                ';
            }
            return $this->data->html;
        }
        /* ==================== End Jenis Kelamin ==================== */

        /* ==================== Start Laporan: penilaian ==================== */
        public function penilaian()
        {
            $this->content['start_end_penilaian']= $this->M_hrd->start_end_penilaian();
            $this->content['karyawan']= $this->M_hrd->show_karyawan();
            $this->content['kriteria']= $this->M_hrd->show_kriteria();
            $this->content['penilaian']= $this->M_hrd->show_penilaian();
            $this->content['duplicate']= $this->M_hrd->show_penilaian_distinct_tanggal();
            $this->view = $this->session->userdata('level') .'/penilaian';
            $this->render_pages();
        }
        /* ==================== End Laporan: penilaian ==================== */
        
        /* ==================== Start Laporan: Hasil Akhir ==================== */
        public function hasil_akhir()
        {
            $this->content['start_end_penilaian']= $this->M_hrd->start_end_penilaian();
            $this->content['tahun_penilaian']= $this->M_hrd->tahun_penilaian();
            $this->content['bulan_penilaian']= $this->M_hrd->bulan_penilaian();
            $this->content['karyawan']= $this->M_hrd->show_karyawan();
            $this->view = $this->session->userdata('level') .'/hasil_akhir';
            $this->render_pages();
        }
        public function detail_hasil_akhir()
        {
            $this->data->rows= [] ;

            /* loop data berdasarkan penilaian  perbulan*/
            foreach ($this->M_hrd->bulan_penilaian() as $key => $value) {
                print_r($this->M_hrd->nilai_mean($value->tahun_penilaian,$value->bulan_penilaian));
                /* loop data kriteria */
                /* $mod_rows= [];
                foreach ($this->M_hrd->nilai_mean($value->tahun_penilaian,$value->bulan_penilaian) as $key_mean => $value_mean) {
                    // foreach ($this->M_hrd->show_kriteria() as $key_kriteria => $value_kriteria) {
                        // if( ($value_mean->id_user==$this->uri->segment(3)) && ($value_mean->id_kriteria==$value_kriteria->id_kriteria) ){
                            $mod_rows[]= [
                                // 'id_kriteria'=> $value_kriteria->id_kriteria,
                                // 'nama_kriteria'=> $value_kriteria->nama_kriteria,
                                'nilai_mean'=> $value_mean->nilai_mean
                            ];
                        // }
                    // }
                } */
                $this->data->rows[]= [
                    'bulan' => "{$value->bulan_penilaian} {$value->tahun_penilaian}",
                    'penilaian' => $this->M_hrd->nilai_mean($value->tahun_penilaian,$value->bulan_penilaian)
                ];
            }
            echo '<pre>';
            print_r($this->data->rows);
            echo '</pre>';

        }
        // public function mean_penilaian($tahun,)
        // {
        //     return $this->
        // }
        /* ==================== End Laporan: Hasil Akhir ==================== */
        
    }
    