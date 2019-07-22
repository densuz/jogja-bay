<?php
class Auth extends CI_Controller{
 
    public function __construct(){
        parent::__construct();		
        $this->load->model('M_auth');
    }
    public function index(){
        $this->load->view('auth');
    }
    public function auth_process()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'user_name' => $username,
            'password' => $password
        );
        
        if ( $this->M_auth->auth_check("user",$where)->num_rows() > 0 ) {
            # code...
            $row  = $this->M_auth->auth_check("user",$where)->row();
            $data_session = array(
                'id' => $row->id_user,
                'nama' => $username,
                'status' => TRUE,
                'level' => $row->level,
            );
            
            $this->session->set_userdata($data_session);
            
            redirect(base_url($this->session->userdata('level')));
        }
        else {
            # jika user tidak ditemukan
            $this->session->set_flashdata('msg', 'Maaf! Username atau Password anda salah!');
            redirect(base_url('auth'));
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}