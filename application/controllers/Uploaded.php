<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Uploaded extends CI_Controller
{
    public function index()
    {
        $this->load->helper( array( 'url', 'form' ) );
        $this->load->view( 'upload_view' );
    }
    public function do_upload()
    {
        // echo '<pre>';
        // print_r( $_FILES );
        // echo '</pre>';
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        // $config['max_size'] = 2000000;

        $this->load->library( 'upload', $config );

        if ( !$this->upload->do_upload( 'imgFile' ) ) {
            $error = array( 'error' => $this->upload->display_errors() );
            // $this->load->view( 'upload_view', $error );
            print_r( $error );
        } else {
            $data = array( 'upload_data' => $this->upload->data() );
        }
    }
}