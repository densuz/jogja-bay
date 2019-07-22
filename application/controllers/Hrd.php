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
        
        /* ==================== Start Menu Master Data: karyawan ==================== */
        public function karyawan()
        {
            $this->content['rows']= [];
            $this->view = $this->session->userdata('level') .'/karyawan';
            $this->render_pages();
        }
        public function form_add_karyawan()
        {

        }
        public function form_edit_karyawan()
        {

        }
        public function store_karyawan()
        {

        }
        public function update_karyawan()
        {

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
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini">'.$row->alamat.'</textarea>
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
                            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan alamat disini"></textarea>
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
                    $this->data->stats  = TRUE;  
                    $this->data->msg    = 'Data berhasil disimpan';  
                } else {
                    $this->data->stats  = FALSE;  
                    $this->data->msg    = 'Data gagal disimpan';
                }
            }
            
            return json_encode($this->data);
        }
        /* ==================== End Data Store ==================== */
        
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
                            <input '.( empty($id)? (($selected==$value['jk'])? 'checked' : NULL) : NULL ).' type="radio" class="form-check-input" value="'.$value['jk'].'" name="jk">'.$value['ket'].'
                        </label>
                    </div>
                ';
            }
            return $this->data->html;
        }
        /* ==================== End Jenis Kelamin ==================== */
        
    }
    