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
        }
        /* ==================== Start Menu Beranda ==================== */
        public function index()
        {
            $this->view = $this->session->userdata('level') .'/beranda';
            $this->render_pages();
        }
        /* ==================== End Menu Beranda ==================== */
    }
    