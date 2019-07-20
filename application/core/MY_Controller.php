<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class MY_Controller extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
        }
        public function render_pages()
        {
            switch ($this->session->userdata('level')) {
                case 'manajer':
                    $this->load->view('manajer/header');
                    $this->load->view('manajer/nav');
                    $this->load->view($this->view, (empty($this->content)? [] : $this->content ) );
                    $this->load->view('manajer/footer');
                    break;
                case 'hrd':
                    $this->load->view('hrd/header');
                    $this->load->view('hrd/nav');
                    $this->load->view($this->view, (empty($this->content)? [] : $this->content ) );
                    $this->load->view('hrd/footer');
                    break;
                    
                default:
                    # code...
                    break;
            }
        }
    }
    