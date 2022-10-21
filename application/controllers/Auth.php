<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'form_validation' );
        $this->load->library( 'encryption' );
    }

    public function register()
    {
        $this->load->view( 'register_view' );
    }

    public function register_post()
    {
        // form rules
        $this->form_validation->set_rules( 'user_email', 'Email', 'required|valid_email|is_unique[users.email]' );
        $this->form_validation->set_rules( 'user_name', 'Name', 'required|min_length[4]' );
        $this->form_validation->set_rules( 'user_password', 'Password', 'required|min_length[4]' );
        $this->form_validation->set_message( 'required', 'Vui lòng điền {field}.' );
        if ( $this->form_validation->run() == false
        ) {
            $this->register();
        } else {
            $encrypt_pass = $this->encryption->encrypt( $_POST['user_password'] );
            $data = array(
                'username' => $_POST['user_name'],
                'email'    => $_POST['user_email'],
                'password' => $encrypt_pass,
            );
            $id = $this->modelUser->insert( $data );
            if ( $id > 0 ) {
                $this->session->set_flashdata( 'user_inserted', 'yes' );
            } else {
                $this->session->set_flashdata( 'user_inserted', 'no' );
            }
            $this->register();
        }

    }

    public function adminLogin()
    {
        if ( isset( $_SESSION['id'] ) ) {
            redirect( 'admin/dashboard' );
        } else {
            $data['title'] = 'Please sign in';
            $this->load->view( 'admin/login', $data );
        }
    }

    public function adminLoginValidation()
    {
        $this->form_validation->set_rules( 'user_email', 'Email', 'trim|required|valid_email' );
        $this->form_validation->set_rules( 'user_password', 'Password', 'trim|required' );

        if ( $this->form_validation->run() ) {
            $email = $_POST['user_email'];
            $password = $_POST['user_password'];

            $query = $this->modelUser->getUser( $email, $password );
            if ( $query->num_rows() ) {
                $result = $query->result();
                $row_password = $this->encryption->decrypt( $result[0]->password );

                if ( $row_password == trim( $password ) ) {
                    $userdata = array(
                        'id'       => $result[0]->Id,
                        'username' => $result[0]->username,
                    );

                    $this->session->set_userdata( $userdata );

                    redirect( 'admin/dashboard' );
                }
            } else {
                $this->session->set_flashdata( 'error', 'email/mật khẩu không đúng' );
                redirect( 'admin/login' );
            }
        } else {
            // $this->session->set_flashdata( 'error', 'email/mật khẩu không đúng' );
            $this->adminLogin();
            // redirect( 'admin/login' );
        }
    }
}