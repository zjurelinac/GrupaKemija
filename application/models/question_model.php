<?php

class Question_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function insert( $data ){
		$this->db->set( $data )->set( 'date_asked', 'NOW()', FALSE )->insert( 'questions' );
		return $this->db->insert_id();
	}
	
	function markAnswered( $id ){
		$this->db->where( 'id', $id )->update( 'questions', array( 'status' => 1 ) );
	}
	
	function get( $offset = 0, $items = 10 ){
		return $this->db->from( 'questions' )->order_by( 'status asc, date_asked desc' )->limit( $items, $offset )->get();
	}
	
	function delete( $id ){
		$this->db->where( 'id', $id )->delete( 'questions' );
	}
	
}

?>
