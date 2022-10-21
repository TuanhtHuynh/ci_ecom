<?php
class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'form_validation' );
        $this->load->library( 'encryption' );
    }

    public function index()
    {
        $data = [];
        if ( isset( $_SESSION['user_inserted'] ) ) {
            $data['error'] = $_SESSION['user_inserted'];
        }
        $this->load->view( 'register_view', $data );
    }

    public function validation()
    {
        $this->form_validation->set_rules( 'user_email', 'name', 'required|valid_email|is_unique[users.email]' );
        $this->form_validation->set_rules( 'user_name', 'Username', 'required|min_length[5]' );
        $this->form_validation->set_rules( 'user_password', 'Password', 'required|min_length[5]' );

        if ( $this->form_validation->run() ) {
            $email = $this->input->post( 'user_email' );
            $password = $this->input->post( 'user_password' );
            $username = $this->input->post( 'user_name' );
            $encrypt_pass = $this->encryption->encrypt( $password );
            $data = array(
                'email'    => $email,
                'username' => $username,
                'password' => $encrypt_pass,
            );
            $id = $this->modelUser->insert( $data );
            if ( $id > 0 ) {
                redirect( 'admin/login' );
            } else {
                $this->session->set_flashdata( 'user_inserted', 'lỗi đăng kí user' );
                redirect( 'register' );
            }
        } else {
            $this->index();
        }

    }
}