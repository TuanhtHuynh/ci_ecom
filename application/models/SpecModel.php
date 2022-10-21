<?php
class SpecModel extends CI_Model
{
    public function getModel()
    {
        return $this->db->get_where( 'models', array( 'status' => '1' ) );
    }

    public function row_count()
    {
        return $this->db->get_where( 'specs', array( 'status' => 1 ) )->num_rows();
    }

    public function fetchSpec( $limit, $start )
    {
        $this->db->limit( $limit, $start );
        $this->db->order_by( 'specs.id', 'desc' );

        $query = $this->db->select( 'specs.*, models.model_name' )
            ->from( 'specs' )
            ->where( 'specs.status', '1' )
            ->join( 'models', 'specs.modelId=models.id' )
            ->get();
        $data = [];
        if ( $query->num_rows() > 0 ) {
            $data = $query->result();
        }
        return $data;
    }

    public function checkSpecs( $data )
    {
        return $this->db->get_where( 'specs', array(
            'spec_name' => $data['spec_name'],
        ) );
    }

    public function checkSpecById( $id )
    {
        return $this->db->get_where( 'specs', array(
            'id' => $id,
        ) )->result();
    }
    public function checkSpecValue( $specId, $value_name )
    {
        return $this->db->get_where( 'spec_values', array(
            'specId' => $specId, 'spec_value_name' => $value_name,
        ) )->result();
    }

    public function fetchSpecValues( $id )
    {
        $this->db->order_by( 'specs.id', 'desc' );

        $query = $this->db->select( 'specs.id, spec_values.spvid, specs.spec_name, spec_values.spec_value_name, models.model_name' )
            ->from( 'specs' )
            ->where( 'specs.status', '1' )
            ->where( 'spec_values.status', '1' )
            ->where( 'specs.id', $id )
            ->join( 'models', 'specs.modelId=models.id' )
            ->join( 'spec_values', 'spec_values.specId=specs.id' )
            ->get();
        if ( $query->num_rows() > 0 ) {
            $data = $query->result();
        }
        return $data;
    }

    public function insertSpec( $data )
    {
        $this->db->insert( 'specs', $data );
        return $this->db->insert_id();
    }

    public function insertSpecValue( $data )
    {
        return $this->db->insert_batch( 'spec_values', $data );
    }

    public function deleteSpec( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'specs' );
    }

    public function updateSpec( $data )
    {
        $this->db->where( 'id', $data['id'] );
        return $this->db->update( 'specs', $data );
    }

    public function updateSpecValue( $data )
    {
        $this->db->where( 'spvid', $data['spvid'] );
        $this->db->update( 'spec_values', $data );
    }
}