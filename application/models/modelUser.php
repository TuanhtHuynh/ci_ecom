<?php
class ModelUser extends CI_Model
{
    public function getUser( $email )
    {
        $query = $this->db->get_where( 'users', array( 'email' => $email ) );
        return $query;
    }

    public function insert( $data )
    {
        $this->db->insert( 'users', $data );
        return $this->db->insert_id();

    }
}