<?php
class Login extends CI_Controller
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
        if ( isset( $_SESSION['id'] ) ) {
            redirect( 'admin/dashboard' );
        }
        if ( isset( $_SESSION['error'] ) ) {
            $data['error'] = $_SESSION['error'];
        } else {
            $data['error'] = 'NO_ERROR';
        }
        $data['title'] = 'Please sign in';
        $this->load->view( 'admin/login', $data );
    }

    public function validation()
    {
        $this->form_validation->set_rules( 'user_email', 'Email', 'required|trim|valid_email' );
        $this->form_validation->set_rules( 'user_password', 'Email', 'required|trim' );
        if ( $this->form_validation->run() ) {
            $email = $this->input->post( 'user_email' );
            $password = $this->input->post( 'user_password' );
            $query = $this->modelUser->getUser( $email );
            if ( $query->num_rows() ) {
                $result = $query->result_array();
                $row_password = $this->encryption->decrypt( $result[0]['password'] );
                if ( $row_password == $password ) {
                    $userdata = array(
                        'id'       => $result[0]['Id'],
                        'username' => $result[0]['username'],
                    );
                    $this->session->set_userdata( $userdata );
                    redirect( 'admin/dashboard' );
                } else {
                    $this->session->set_flashdata( 'error', 'email/mật khẩu không đúng' );
                    redirect( 'admin/login' );
                }

            } else {
                $this->session->set_flashdata( 'error', 'email/mật khẩu không đúng' );
                redirect( 'admin/login' );

            }
        } else {
            $this->index();
        }
    }

    public function logout()
    {
        session_destroy();
        redirect( 'admin/login' );
    }
}