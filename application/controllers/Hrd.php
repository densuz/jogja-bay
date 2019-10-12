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
            $this->content['count_karyawan']= count($this->M_hrd->show_karyawan());
            $this->content['count_kriteria']= count($this->M_hrd->show_kriteria());
            $this->content['count_total']= $this->M_hrd->count_penilaian();
            $this->content['count_bulan']= $this->M_hrd->count_penilaian( date('Y'),date('m') );
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
            $this->load->helper('periode');
            $this->content['start_end_penilaian']= $this->M_hrd->start_end_penilaian();
            $this->content['tahun_penilaian']= $this->M_hrd->tahun_penilaian();
            $this->content['bulan_penilaian']= $this->M_hrd->bulan_penilaian();
            $this->content['hasil_per_bulan']= $this->hasil_per_bulan();
            $this->content['karyawan']= $this->M_hrd->show_karyawan();
            $this->view = $this->session->userdata('level') .'/hasil_akhir';
            $this->render_pages();
        }
        public function detail_hasil_akhir()
        {
            $this->data->id_user= $this->uri->segment(3);
            $this->data->rows= $this->data_penilaian($this->data->id_user);
            $this->data->all= $this->data_penilaian();
            
            $this->data->html = '';
            foreach ($this->data->rows as $key => $value) {
                $this->data->html.= '<hr>';
                $this->data->html.= '<h2 class="text-bold text-center">'.$value['bulan'].'</h2>';
                $this->data->html.= '<hr>';
                $this->data->html.= '<label>Nilai rata-rata kriteria bulan ini :</label>';
                $this->data->html.= '<div class="table-responsive">';
                $this->data->html.= '    <table id="example1X" class="table table-bordered table-striped">';
                $this->data->html.= '        <thead>';
                $this->data->html.= '            <tr>';
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    $this->data->html.= '<th>'.$value_sub['nama_kriteria'].'</th>';
                }
                $this->data->html.= '            </tr>';
                $this->data->html.= '        </thead>';
                $this->data->html.= '        <tbody>';
                $this->data->html.= '            <tr>';
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    $this->data->html.= '<td>'.$value_sub['nilai_mean'].'</td>';
                }
                $this->data->html.= '            </tr>';
                $this->data->html.= '        </tbody>';
                $this->data->html.= '    </table>';
                $this->data->html.= '</div>';

                /* start normalisasi */
                $this->data->html.= '<label>Normalisasi :</label>';
                $this->data->html.= '<div class="table-responsive">';
                $this->data->html.= '    <table id="example1X" class="table table-bordered table-striped">';
                $this->data->html.= '        <thead>';
                $this->data->html.= '            <tr>';
                $this->data->html.= '<th>Keterangan</th>';
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    $this->data->html.= '<th>'.$value_sub['nama_kriteria'].'</th>';
                }
                $this->data->html.= '            </tr>';
                $this->data->html.= '        </thead>';
                $this->data->html.= '        <tbody>';
                
                /* start rumus */
                $this->data->html.= '            <tr>';
                $this->data->html.= '<td>Perhitungan</td>';
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    foreach ($this->data->all as $key_all => $value_all) {
                        if ( $value_all['bulan'] == $value['bulan'] ) {
                            $this->data->html.= "<td>{$value_sub['nilai_mean']}/MAX(".implode(', ',$value_all['penilaian'][$value_sub['id_kriteria']]).")</td>";
                        }
                    }
                }
                $this->data->html.= '            </tr>';
                /* end rumus */

                /* start hasil */
                $this->data->html.= '            <tr>';
                $this->data->html.= '<td>Hasil</td>';
                $hasil=[];
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    foreach ($this->data->all as $key_all => $value_all) {
                        if ( $value_all['bulan'] == $value['bulan'] ) {
                            $hasil_normalisasi= ($value_sub['nilai_mean'] / max($value_all['penilaian'][$value_sub['id_kriteria']]) );
                            $hasil[]= [
                                'hasil'=> $hasil_normalisasi,
                                'nilai_bobot'=> $value_sub['bobot'],
                            ];
                            $this->data->html.= "<td>{$hasil_normalisasi}</td>";
                        }
                    }
                }
                $this->data->html.= '            </tr>';
                /* end hasil */

                $this->data->html.= '        </tbody>';
                $this->data->html.= '    </table>';
                $this->data->html.= '</div>';
                /* end normalisasi */
                
                /* start perhitunngan menggunakan saw */
                $this->data->html.= '<label>Perhitungan Dengan Bobot SAW:</label>';
                $this->data->html.= '<div class="table-responsive">';
                $this->data->html.= '    <table id="example1X" class="table table-bordered table-striped">';
                $this->data->html.= '        <tbody>';
                $this->data->html.= '           <tr>';
                $this->data->html.= '               <td>Perhitungan</td>';
                    $hasil_saw= 0;
                    $rumus_saw= '';
                    foreach ($hasil as $key_hasil => $value_hasil) {
                        $rumus_saw.= "({$value_hasil['nilai_bobot']}*{$value_hasil['hasil']}) + ";
                        $hasil_saw+= ($value_hasil['nilai_bobot']*$value_hasil['hasil']);
                    }
                    $this->data->html.= '            <td>'.(rtrim($rumus_saw,"+ ")).'</td>';
                $this->data->html.= '            </tr>';
                $this->data->html.= '            <tr>';
                $this->data->html.= '               <td>Hasil</td>';
                $this->data->html.= '               <td>'.$hasil_saw.'</td>';
                $this->data->html.= '            </tr>';

                $this->data->html.= '        </tbody>';
                $this->data->html.= '    </table>';
                $this->data->html.= '</div>';
                /* start perhitunngan menggunakan saw */

            }
            echo json_encode($this->data);
            // echo '<pre>';
            // print_r($this->data);
            // echo '</pre>';
        }
        public function data_penilaian($id=NULL)
        {
            $rows= [] ;
            $bulan_penilaian= $this->M_hrd->bulan_penilaian();
            $kriteria= $this->M_hrd->show_kriteria();

            /* loop data berdasarkan penilaian  perbulan*/
            foreach ($bulan_penilaian as $key => $value) {
                /* loop data kriteria */
                $mod_rows= [];
                foreach ($this->M_hrd->nilai_mean($value->tahun_penilaian,$value->id_bulan) as $key_mean => $value_mean) {
                    foreach ($kriteria as $key_kriteria => $value_kriteria) {
                        if ( ! empty($id) ) {
                            if( ($value_mean->id_user==$id) && ($value_mean->id_kriteria==$value_kriteria->id_kriteria) )
                                $mod_rows[]= [
                                    'id_kriteria'=> $value_kriteria->id_kriteria,
                                    'nama_kriteria'=> $value_kriteria->nama_kriteria,
                                    'bobot'=> $value_kriteria->bobot,
                                    'nilai_mean'=> $value_mean->nilai_mean,
                                ];

                        }else {
                            if( $value_mean->id_kriteria==$value_kriteria->id_kriteria ){
                                if ( ! empty( $mod_rows[$value_kriteria->id_kriteria] ) ) {
                                    array_push($mod_rows[$value_kriteria->id_kriteria], $value_mean->nilai_mean);
                                } else {
                                    $mod_rows[$value_kriteria->id_kriteria]= [$value_mean->nilai_mean];
                                }
                                
                            }
                                

                        }
                    }
                }
                $rows[]= [
                    'bulan' => "{$value->bulan_penilaian} {$value->tahun_penilaian}",
                    'tahun' => $value->tahun_penilaian,
                    'id_bulan' => $value->id_bulan,
                    'penilaian' => $mod_rows
                ];
            }
            return $rows;
        }
        public function hasil_per_bulan()
        {
            $rows=[];
            foreach ($this->M_hrd->show_karyawan() as $key => $value) {
                $rows[$value->id_user]= [
                    'penilaian'=> $this->data_hasil_akhir($value->id_user)
                ];
            }
            return $rows;
        }
        public function data_hasil_akhir($id)
        {
            $id_user= $id;
            $rows= $this->data_penilaian($id_user);
            $all= $this->data_penilaian();
            
            $penilaian = [];
            foreach ($rows as $key => $value) {
                $hasil=[];
                foreach ($value['penilaian'] as $key_sub => $value_sub) {
                    foreach ($all as $key_all => $value_all) {
                        if ( $value_all['bulan'] == $value['bulan'] ) {
                            $hasil_normalisasi= ($value_sub['nilai_mean'] / max($value_all['penilaian'][$value_sub['id_kriteria']]) );
                            $hasil[]= [
                                'hasil'=> $hasil_normalisasi,
                                'nilai_bobot'=> $value_sub['bobot'],
                            ];
                        }
                    }
                }
                $hasil_saw= 0;
                foreach ($hasil as $key_hasil => $value_hasil) {
                    $hasil_saw+= ($value_hasil['nilai_bobot']*$value_hasil['hasil']);
                }
                $penilaian[]= [
                    'tahun'=> $value['tahun'],
                    'id_bulan'=> $value['id_bulan'],
                    'nilai'=> $hasil_saw,
                ];

            }
            return $penilaian;
        }
        public function karyawan_terbaik()
        {
            echo '<pre>';
            foreach ($this->get_karyawan_terbaik() as $key => $value) {
                echo json_encode($value).'<br>';
            }
            echo '</pre>';
        }
        public function get_karyawan_terbaik()
        {
            $this->content= [];
            $this->load->helper('periode');
            $this->content['start_end_penilaian']= $this->M_hrd->start_end_penilaian();
            $this->content['tahun_penilaian']= $this->M_hrd->tahun_penilaian();
            $this->content['bulan_penilaian']= $this->M_hrd->bulan_penilaian();
            $this->content['hasil_per_bulan']= $this->hasil_per_bulan();
            $this->content['karyawan']= $this->M_hrd->show_karyawan();

            $rows= [];

            $th_tahun= '';
            $tr_bulan= '';
            $th_bulan= '';
            if ( empty($_GET['start_date']) ) {
                foreach ($this->content['tahun_penilaian'] as $key => $value) {
                $col_tahun= 0;
                foreach ($this->content['bulan_penilaian'] as $key_bulan => $value_bulan) {
                    if ( $value_bulan->tahun_penilaian==$value->tahun_penilaian ) {
                    $col_tahun++;
                    }
                    $th_bulan .= "<th>{$value_bulan->bulan_penilaian}</th>";
                }
                $th_tahun .= "<th colspan='{$col_tahun}'>Tahun {$value->tahun_penilaian}</th>";
                }
                
            } else {

                $tahun_penilaian= hasil_akhir_mod($_GET['start_date'],$_GET['end_date'],'year');
                $bulan_penilaian= hasil_akhir_mod($_GET['start_date'],$_GET['end_date'],'month');

                foreach ($this->content['tahun_penilaian'] as $key => $value) {
                $col_tahun= 0;
                foreach ($this->content['bulan_penilaian'] as $key_bulan => $value_bulan) {
                    if ( $value_bulan->tahun_penilaian==$value->tahun_penilaian ) {
                    $col_tahun++;
                    }
                    $th_bulan .= "<th>{$value_bulan->bulan_penilaian}</th>";
                }
                $th_tahun .= "<th colspan='{$col_tahun}'>Tahun {$value->tahun_penilaian}</th>";
                }

            }
                        

            echo "
                <tr>
                <th rowspan='2'>No</th>
                <th rowspan='2'>Name</th>
                <th rowspan='2'>Divisi</th>
                {$th_tahun}
                <th colspan='2'>Nilai</th>
                <th rowspan='2'>&nbsp</th>
                </tr>
                <tr>
                {$th_bulan}
                <th>Total</th>
                <th>Mean(rata-rata)</th>
                </tr>
            ";

            $no = 1;
            $tbody= '';
            foreach ($this->content['karyawan'] as $key => $value) {
                if ( empty($_GET['start_date']) ) {
                    /* start generate nilai saw perbulan */
                    $tes='';
                    $nilai= $this->content['hasil_per_bulan'][$value->id_user]['penilaian'];
                    $nilai_total= 0;
                    $nilai_rows= count($nilai);
                    foreach ($nilai as $key_nilai => $value_nilai) {
                        $tes .= '<td>'.$value_nilai['nilai'].'</td>';
                        $nilai_total += $value_nilai['nilai'];
                    }
                    $nilai_mean= ($nilai_total/$nilai_rows);
                    /* end generate nilai saw perbulan */
                } else {
                    $bulan_penilaian= hasil_akhir_mod($_GET['start_date'],$_GET['end_date'],'month');

                    $tes='';
                    $nilai= $hasil_per_bulan[$value->id_user]['penilaian'];
                    $nilai_total= 0;
                    $nilai_rows= count($bulan_penilaian);

                    $data_mod=[];
                    foreach ($bulan_penilaian as $key_mod => $value_mod) {
                        $found=0; 
                        foreach ($nilai as $key_nilai => $value_nilai) {
                            if ( ($value_nilai['tahun']==$value_mod->tahun_penilaian) && ($value_nilai['id_bulan']==$value_mod->id_bulan) ) {
                                $found = $value_nilai['nilai'];
                            }
                        }
                        $data_mod[$key_mod]= $found;
                    }
                    foreach ($data_mod as $key_dm => $value_dm) {
                        $tes .= '<td>'.$value_dm.'</td>';
                        $nilai_total += $value_dm;
                    }
                    $nilai_mean= ($nilai_total/$nilai_rows);

                }

                $rows[]= [
                    "no" => $no,
                    "nama" => $value->nama,
                    "nama_divisi" => $value->nama_divisi,
                    "penilaian" => $tes,
                    "mean" => $nilai_mean,
                ];
                $no++;
            }
            return $rows;
        }
        /* ==================== End Laporan: Hasil Akhir ==================== */
        
    }
    