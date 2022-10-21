<?php
class Categories extends CI_Model
{
    public function name()
    {
        return 'đồ uống';
    }

    public function getCategories()
    {
        $this->db->like( 'name', 'Đồ' );
        $query = $this->db->get( 'categories' );
        return $query->result();
        // print_r( $query );
    }
    /**
     * @param mixed $name
     * @return Categories
     */
}