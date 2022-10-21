<?php
class ProductModel extends CI_Model
{
    public function row_count()
    {
        return $this->db->get_where( 'products', array( 'status' => 1 ) )->num_rows();
    }

    public function fetchProducts( $limit, $start )
    {
        $this->db->limit( $limit, $start );
        $query = $this->db->get_where( 'products', array( 'status' => '1' ) );
        $data = [];
        if ( $query->num_rows() > 0 ) {
            $data = $query->result();
        }
        return $data;
    }

    public function insert( $data )
    {
        $this->db->insert( 'products', $data );
        return $this->db->insert_id();
    }

    public function getProduct( $id )
    {
        return $this->db->get_where( 'products', array( 'id' => $id ) );
    }

    public function updateProduct( $id, $data )
    {
        $this->db->where( 'id', $id );
        return $this->db->update( 'products', $data );

    }

    public function getProductCover( $id )
    {
        return $this->db->select( 'product_cover' )
            ->from( 'products' )
            ->where( 'id', $id )
            ->get()->result();
    }

    public function getCategories()
    {
        return $this->db->get_where( 'categories', array( 'status' => '1' ) );
    }
}