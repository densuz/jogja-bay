<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Manajer extends MY_Controller
    {
        public function __construct(){
            parent::__construct();

            /* jika level bukan manajer makan user tidak berhak mengakses halaman ini */
            if($this->session->userdata('status') !=1  && $this->session->userdata('level') != "manajer"){
                redirect(base_url("auth"));
            }
            $this->data = new stdClass();
            $this->load->model(['M_manajer']);		
        }
        /* ==================== Start Menu Beranda ==================== */
        public function index()
        {
            $this->view = $this->session->userdata('level') .'/beranda';
            $this->render_pages();
        }
        /* ==================== End Menu Beranda ==================== */

        /* ==================== Start Informasi Profil ==================== */
        public function form_manajer()
        {
            $row= $this->M_manajer->show_manajer( $this->uri->segment(3) );
            $this->data->html= '
                <form action="'.base_url( $this->session->userdata('level') ).'/store-manajer" class="data-store">
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
        public function store_manajer()
        {
            echo $this->store_data('manajer');
        } 
        /* ==================== End Informasi Profil ==================== */

        /* ==================== Start Data Store ==================== */
        public function store_data($sub_prefix)
        {
            $funct = 'store_'.$sub_prefix; 
            if ( ! empty($this->input->post('id')) ) {
                $this->M_manajer->post= $this->input->post();
                if ( $this->M_manajer->$funct($this->input->post('id')) ) {
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
                $this->M_manajer->post= $this->input->post();
                if ( $this->M_manajer->$funct() ) {
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

        /* ==================== Start Menu Penilaian ==================== */
        public function penilaian()
        {
            $this->content['karyawan']= $this->M_manajer->show_karyawan();
            $this->content['kriteria']= $this->M_manajer->show_kriteria();
            $this->view = $this->session->userdata('level') .'/penilaian';
            $this->render_pages();
        }
        public function store_penilaian()
        {
            echo $this->store_data('penilaian');
        }
        /* ==================== End Menu Penilaian ==================== */


    }
    