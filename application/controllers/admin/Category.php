<?php
class Category extends CI_Controller
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
        $data['title'] = 'Danh mục';
        $query = $this->db->get( 'categories' );
        $data['categories'] = $query->result();

        $this->load->view( 'admin/category/index', $data );
    }

    public function new_category()
    {
        $data['title'] = 'Thêm danh mục';
        $this->load->view( 'admin/category/add_category_view', $data );
    }

    public function save_category()
    {
        $name = $_POST['category_name'];
        $query = $this->db->query( 'INSERT INTO categories
        (Name)
        VALUES ("' . $name . '")' );
        if ( $query ) {
            $this->session->set_flashdata( 'inserted', 'yes' );
            redirect( 'admin/category/new_category' );
        }
    }

    public function edit_category( $category_id )
    {
        $data['title'] = 'Cập nhật thông tin';
        $query = $this->db->get_where( 'categories', array( 'id' => $category_id ) );
        $result = $query->result();
        $data['category'] = $result;
        $this->load->view( 'admin/category/edit_category_view', $data );
    }

    public function update_category()
    {
        if ( $_POST['category_name'] ) {
            $id = $_POST['category_id'];
            $name = $_POST['category_name'];
            $status = $_POST['category_status'];
            $query = $this->db->query( 'UPDATE categories
            SET Name="' . $name . '", status="' . $status . '"
            WHERE Id="' . $id . '"' );
            if ( $query ) {
                $this->session->set_flashdata( 'updated', 'yes' );
                redirect( 'admin/category/index' );
            } else {
                $this->session->set_flashdata( 'updated', 'no' );
                redirect( 'admin/category/index' );
            }
        }
    }
    public function delete_category()
    {
        if ( $_POST['delete_id'] ) {
            $id = $_POST['delete_id'];
            $query = $this->db->query( 'DELETE FROM categories WHERE Id="' . $id . '"' );
            if ( $query ) {
                echo 'succeed';
            } else {
                echo 'failed';
            }
        }
    }
}