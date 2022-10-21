<?php
class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ( !isset( $_SESSION['id'] ) ) {
            redirect( 'admin/login' );
        }
    }

    public function index()
    {
        $this->load->view( 'admin/home/index' );
        // $this->load->view( 'admin/header/footer' );
    }
}