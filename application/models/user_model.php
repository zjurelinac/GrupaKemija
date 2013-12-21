<?php

class User_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		require_once APPPATH . '/resources/password.php';
	}
	
	function authenticate( $username, $pass ){
		$query = $this->db->select( 'user_id, password' )->from( 'users' )->where( 'username', $username )->get();
		
		if( $query->num_rows < 1 )
			return -2;
		
		$hash = $query->row()->password;
		
		if( password_verify( $pass, $hash ) ){			
			if( password_needs_rehash( $hash, PASSWORD_DEFAULT ) )
		   		$hash = password_hash( $pass, PASSWORD_DEFAULT );
		} else {
			return -1;
		}
		
		return $query->row()->user_id;
	}
	
	//	username, email, passwordHash, name
	function create( $data ){
		$this->db->insert( 'users', $data );
		return $this->db->insert_id();
	}
	
	function delete( $username, $id ){
		$this->db->from( 'users' )->where( 'id', $id )->where( 'username', $username )->delete;
	}
	
}

?>
