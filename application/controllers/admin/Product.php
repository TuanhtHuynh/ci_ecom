<?php
class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'form_validation' );
        $this->load->library( 'encryption' );
        $this->load->helper( 'tiengviet_helper' );
    }

    public function index()
    {
        $data = [];
        $data['title'] = 'Sản phẩm';
        $config['base_url'] = base_url() . 'admin/product';
        $config['use_page_numbers'] = true;
        $config['full_tag_open'] = '<ul class="pagination mx-auto">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $totalRows = $this->ProductModel->row_count();

        $config['total_rows'] = $totalRows;
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $this->load->library( 'pagination' );
        $this->pagination->initialize( $config );
        $page = $this->uri->segment( 3 ) ? $this->uri->segment( 3 ) : 0;
        $data['products'] = $this->ProductModel->fetchProducts( $config['per_page'], $page );
        $data['links'] = $this->pagination->create_links();
        $this->load->view( 'admin/product/index', $data );
    }

    public function addProduct()
    {
        $data = [];
        $data['title'] = 'Thêm sản phẩm';
        $data['categories'] = $this->ProductModel->getCategories();
        $this->load->view( 'admin/product/add_product', $data );
    }

    public function greater_vnd( $str, $value )
    {
        $digit = preg_replace( '/,/', '', $str );
        if ( $digit < $value ) {
            $this->form_validation->set_message( 'greater_vnd', '{field} không được < {param} đồng' );
            return false;
        }
        return true;
    }

    public function save()
    {
        $this->form_validation->set_rules( 'product_name', 'Name', 'required|is_unique[products.product_name]|min_length[4]' );

        $this->form_validation->set_rules( 'product_price', 'Price', 'required|callback_greater_vnd[2000]' );
        $this->form_validation->set_rules( 'product_quantity', 'Quantity', 'required|numeric|greater_than[1]' );

        if ( !$this->form_validation->run() ) {
            $this->addProduct();
        } else {
            $price = preg_replace( '/,/', '', $_POST['product_price'] );
            $slug = khongdau( $_POST['product_name'] );
            $data = array(
                'product_name' => $_POST['product_name'],
                'slug'         => $slug,
                'price'        => $price,
                'quantity'     => $_POST['product_quantity'],
            );
            if ( !empty( $_POST['product_desc'] ) ) {
                $data['product_desc'] = $_POST['product_desc'];
            }

            if ( isset( $_FILES ) ) {
                $config['upload_path'] = './assets/uploads';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library( 'upload', $config );
                if ( !$this->upload->do_upload( 'product_cover' ) ) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata( 'inserted', 'no' );
                    $this->session->set_flashdata( 'inserted_msg', $error );
                    redirect( 'admin/product/addproduct' );
                } else {
                    $file = $this->upload->data();
                    $data['product_cover'] = $file['file_name'];
                }
            }

            $id = $this->ProductModel->insert( $data );
            if ( $id > 0 ) {
                // $this->session->set_flashdata( 'inserted', 'yes' );
                // $this->session->set_flashdata( 'inserted_msg', 'đã thêm sản phẩm' );
                // redirect( 'admin/product/addproduct' );
            } else {
                $this->session->set_flashdata( 'inserted', 'no' );
                $this->session->set_flashdata( 'inserted_msg', 'lỗi thêm sản phẩm' );
                $this->addProduct();
            }
        }
    }

    public function edit( $id )
    {
        $data['title'] = 'Cập nhật thông tin';

        $query = $this->ProductModel->getProduct( $id );
        if ( $query->num_rows() > 0 ) {
            $data['product'] = $query->result();
        }
        $this->load->view( 'admin/product/edit_product', $data );
    }

    public function update()
    {
        $id = $this->input->post( 'product_id', true );
        $data['product_name'] = $this->input->post( 'product_name', true );
        $data['price'] = $this->input->post( 'product_rice', true );
        $data['quantity'] = $this->input->post( 'product_quantity', true );
        $oldcover = $this->input->post( 'oldcover' );
        if ( !empty( $data['product_name'] ) ) {
            if ( isset( $_FILES['product_cover'] ) && is_uploaded_file( $_FILES['product_cover']['tmp_name'] ) ) {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $this->load->library( 'upload', $config );
                if ( !$this->upload->do_upload( 'product_cover' ) ) {
                    $error = $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                    $data['product_cover'] = $file['file_name'];
                }
            }
            $query = $this->ProductModel->updateProduct( $id, $data );
            if ( $query ) {
                if ( !empty( $data['product_cover'] ) ) {
                    if ( file_exists( $config['upload_path'] . '/' . $oldcover ) ) {
                        unlink( $config['upload_path'] . '/' . $oldcover );
                    }
                }
                // $this->edit( $id );
                redirect( 'admin/product' );
            } else {
                $this->session->set_flashdata( 'inserted', 'no' );
                $this->session->set_flashdata( 'inserted_msg', 'lỗi câp nhật sản phẩm' );
                redirect( 'admin/product/update' );
            }
        }
    }

    public function delete()
    {
        if ( $this->input->is_ajax_request()
        ) {
            $id = $this->input->post( 'id', true );
            $text = $this->input->post( 'text', true );
            if ( !empty( $id ) ) {
                $oldcover = $this->ProductModel->getProductCover( $id );
                if ( !empty( $oldcover ) && count( $oldcover ) == 1 ) {
                    $cover = trim( $oldcover[0]->product_cover );
                    $path = realpath( APPPATH . '../assets/uploads/' );
                    if ( file_exists( $path . '/' . $cover ) ) {
                        unlink( $path . '/' . $cover );
                    }
                }
                echo $path . '/' . $cover;
            } else {
                echo 'failed';
            }

        }
    }
}