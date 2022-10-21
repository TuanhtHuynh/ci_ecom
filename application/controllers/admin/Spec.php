<?php
class Spec extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'form_validation' );
        $this->load->helper( 'form' );
    }

    public function index()
    {
        $data['title'] = 'Thuộc tính sản phẩm';
        $data['modaltitle'] = 'Giá trị Spec';
        $config['base_url'] = base_url() . 'admin/spec';
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

        $totalRows = $this->SpecModel->row_count();

        $config['total_rows'] = $totalRows;
        $config['per_page'] = 2;
        $config['uri_segment'] = 3;
        $this->load->library( 'pagination' );
        $this->pagination->initialize( $config );
        $page = $this->uri->segment( 3 ) ? $this->uri->segment( 3 ) : 0;
        $data['specs'] = $this->SpecModel->fetchSpec( $config['per_page'], $page );
        $data['links'] = $this->pagination->create_links();
        $this->load->view( 'admin/spec/index', $data );
    }

    public function addSpec()
    {
        $data['title'] = 'Thêm Spec cho sản phẩm';
        $data['models'] = $this->SpecModel->getModel();
        $this->load->view( 'admin/spec/add_spec', $data );
    }

    public function save()
    {
        $data['spec_name'] = $this->input->post( 'spec_name', true );
        $data['modelId'] = $this->input->post( 'modelId', true );
        $specvalues = $this->input->post( 'spec_val', true );

        $this->form_validation->set_rules( 'spec_name', 'Name', 'required|min_length[3]' );

        if ( $this->form_validation->run() ) {
            $adddata = $this->SpecModel->checkSpecs( $data );
            if ( $adddata->num_rows() > 0 ) {
                $this->session->set_flashdata( 'inserted', 'no' );
                $this->session->set_flashdata( 'inserted_msg', 'spec đã có' );
                $this->addSpec();
            } else {
                $specId = $this->SpecModel->insertSpec( $data );
                if ( is_numeric( $specId ) ) {
                    $spec_value = [];
                    foreach ( $specvalues as $value ) {
                        $spec_value[] = array(
                            'specId'          => $specId,
                            'spec_value_name' => $value,
                        );
                    }
                    $secvaluestatus = $this->SpecModel->insertSpecValue( $spec_value );
                    if ( $secvaluestatus ) {
                        $this->session->set_flashdata( 'inserted', 'yes' );
                        $this->session->set_flashdata( 'inserted_msg', 'đã tạo spec' );
                        redirect( 'admin/spec/addspec' );
                    } else {
                        $this->session->set_flashdata( 'inserted', 'no' );
                        $this->session->set_flashdata( 'inserted_msg', 'lỗi tạo spec' );
                        redirect( 'admin/spec/addspec' );
                    }
                }
            }
        } else {
            $this->addSpec();
        }
    }

    public function delete_Spec( $id )
    {
        if ( $this->input->is_ajax_request()
        ) {
            $id = $this->input->post( 'delete_id', true );
            if ( !empty( $id ) ) {
                $query = $this->SpecModel->deleteSpec( $id );
                if ( $query ) {
                    echo 'succeed';
                } else {
                    echo 'failed';
                }
            } else {
                echo 'failed';
            }

        }
    }

    public function editSpec( $id )
    {
        if ( !empty( $id ) ) {
            $data['title'] = 'Cập nhật Spec';
            $data['spec'] = $this->SpecModel->checkSpecById( $id );
            if ( count( $data['spec'] ) == 1 ) {
                $data['models'] = $this->SpecModel->getModel();
                $this->load->view( 'admin/edit_spec', $data );
            } else {
                $this->session->set_flashdata( 'error', 'không tìm thấy spec' );
                redirect( 'admin/spec' );
            }
        } else {
            $this->session->set_flashdata( 'error', 'không tìm thấy spec' );
            redirect( 'admin/spec' );
        }
    }

    public function updateSpec()
    {
        $data['modelId'] = $this->input->post( 'modelId', true );
        $data['id'] = $this->input->post( 'id', true );
        $data['spec_name'] = $this->input->post( 'spec_name', true );

        $this->form_validation->set_rules( 'spec_name', 'Name', 'required' );
        if ( $this->form_validation->run() ) {
            $addData = $this->SpecModel->checkSpecs( $data );
            if ( $addData->num_rows() > 0 ) {
                $this->session->set_flashdata( 'updated', 'no' );
                $this->session->set_flashdata( 'updated_msg', 'spec đã có trong database' );
                redirect( 'admin/spec' );
            } else {
                $query = $this->SpecModel->updateSpec( $data );
                if ( $query ) {
                    $this->session->set_flashdata( 'updated', 'yes' );
                    $this->session->set_flashdata( 'updated_msg', 'đã cập nhật spec' );
                    redirect( 'admin/spec' );

                } else {
                    $this->session->set_flashdata( 'updated', 'no' );
                    $this->session->set_flashdata( 'updated_msg', 'lỗi cập nhật' );
                    redirect( 'admin/spec' );
                }

            }
        } else {
            $this->editSpec( $data['id'] );
        }
    }

    public function editSpecValue()
    {
        $data['modaltitle'] = 'Giá trị thuộc tính';
        if ( $this->input->is_ajax_request() ) {
            $spid = $this->input->post( 'id', true );
            $checkspec = $this->SpecModel->checkSpecById( $spid );
            if ( count( $checkspec ) == 0 ) {
                echo json_encode( 'false' );
            } else {
                $data['spec_values'] = $this->SpecModel->fetchSpecValues( $spid );
                echo json_encode( $data );
            }
        }
    }

    public function updatespecvalue()
    {
        if ( $this->input->is_ajax_request() ) {
            $specid = $this->input->post( 'spec_id', true );
            $data['spvid'] = $this->input->post( 'spvid', true );
            $data['spec_value_name'] = $this->input->post( 'spec_value_name', true );

            $checkspec = $this->SpecModel->checkSpecById( $specid );

            if ( count( $checkspec ) == 1 ) {
                $specvalue = $this->SpecModel->checkSpecValue( $specid, $data['spec_value_name'] );
                // spec_value_name exists
                if ( count( $specvalue ) == 0 ) {
                    $query = $this->SpecModel->updateSpecValue( $data );
                    if ( $query ) {
                        echo json_encode( 'null' );
                    }
                } else {
                    echo json_encode( 'lỗi cập nhật spec_values' );
                }
            }
        }
    }
}