<?php

class Article_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	//	array : title, content, type, image, attachments
	function insert( $data ){
		$this->db->set( $data )->set( 'date_added', 'NOW()', FALSE )->insert( 'articles' );
	}
	
	//	displaying multiple articles
	function get( $offset = 0, $items = 10 ){
		return $this->db->from( 'articles' )->order_by( 'date_added', 'desc' )->limit( $items, $offset )->get();
	}
	
	//	for displaying and/or editing individual articles
	function getById( $id ){
		return $this->db->from( 'articles' )->where( 'article_id', $id )->get();
	}
	
	//	update existing article
	function update( $id, $data ){
		$this->db->from( 'articles' )->where( 'article_id', $id )->update( $data );
	}
	
	function delete( $id ){
		$this->db->from( 'articles' )->where( 'article_id', $id )->delete();
	}
	
}

?>
