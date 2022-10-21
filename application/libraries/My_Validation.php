<?php
class My_Validation extends CI_Form_validation
{
    public function is_money( $str )
    {
        $decimal_places = ',';
        preg_match( '/^[0-9]+(\.[0-9]{0,' . $decimal_places . '})?$/', $str );
    }
}