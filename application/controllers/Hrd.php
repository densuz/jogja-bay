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
            $this->content['rows']= [];
            $this->view = $this->session->userdata('level') .'/manajer';
            $this->render_pages();
        }
        public function form_add_manajer()
        {

        }
        public function form_edit_manajer()
        {
            
        }
        public function store_manajer()
        {

        }
        public function update_manajer()
        {

        }
        /* ==================== End Menu Master Data: manajer ==================== */

        /* ==================== Start Menu Master Data: kategori ==================== */
        public function kategori()
        {
            $this->content['rows']= [];
            $this->view = $this->session->userdata('level') .'/kategori';
            $this->render_pages();
        }
        public function form_add_kategori()
        {

        }
        public function form_edit_kategori()
        {
            
        }
        public function store_kategori()
        {

        }
        public function update_kategori()
        {

        }
        /* ==================== End Menu Master Data: kategori ==================== */

        /* ==================== Start Menu Master Data: divisi ==================== */
        public function divisi()
        {
            $this->content['rows']= [];
            $this->view = $this->session->userdata('level') .'/divisi';
            $this->render_pages();
        }
        public function form_add_divisi()
        {
            $this->data->html= '
                <form action="'.base_url( $this->session->userdata('level') ).'/store-divisi">
                    <div class="form-group">
                        <label>Nama Divisi :</label>
                        <input type="text" class="form-control" required="" placeholder="Masukan nama divisi">
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            ';
            echo json_encode($this->data); 
        }
        public function form_edit_divisi()
        {
            
        }
        public function store_divisi()
        {
        }
        public function update_divisi()
        {

        }
        /* ==================== End Menu Master Data: divisi ==================== */
    }
    