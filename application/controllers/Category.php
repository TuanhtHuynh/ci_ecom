<?php
// defined( 'BASEPATH' ) or exit( 'No dicrect script access allowed' );

class Category extends CI_Controller
{
    public function index( $param = '' )
    {
        $data['categories'] = 'danh sách categories';
        echo $param;
        // $data['param'] = $param;
        $this->load->view( 'category_view', $data );

    }
}