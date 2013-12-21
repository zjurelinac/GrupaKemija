<?php

class Administrate extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		if( !$this->session->userdata( 'user_id' ) ){
			$this->load->helper( 'url' );
			header( 'Location: http://' . site_url() );
			return;
		}
	}
	
	//	front display
	function index(){
		$query = $this->question_model->get();
		$res = $query->result();
		$this->load->view( 'administrate_view', array( 'questions' => $res ) );
	}
	
	//	add article form processor
	function addArticle(){
		$title = $this->input->post( 'new-article-title' );
		$content = $this->input->post( 'new-article-content' );
		$type = $this->input->post( 'new-article-type' );
		$attach = $this->input->post( 'new-article-attachments' );
		$this->article_model->insert( array( 'title' => $title, 'content' => $content, 'type' => $type, 'attachments' => $attach ) );
		$this->load->helper( 'url' );
		header( 'Location: http://' . site_url( '/administrate' ) );
	}
	
	//	answer questions form processor
	function answer(){
		
	}
};

?>
