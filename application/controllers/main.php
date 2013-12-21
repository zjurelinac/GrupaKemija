<?php

class Main extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		require_once APPPATH . '/resources/password.php';
		$this->load->helper( 'url' );
	}
	
	//	display
	function index( $start = 0 ){
		$query = $this->article_model->get( $start );
		$res = $query->result();
		$data = array( 'articles' => $res );
		$this->load->view( 'main_view', $data );
	}

	//	processing asked questions
	function ask(){
		
		$name = $this->input->post( 'question-asker' );
		$email = $this->input->post( 'question-email' );
		$content = $this->input->post( 'question-content' );
		
		$id = $this->question_model->insert( array( 'asker_name' => $name, 'asker_email' => $email, 'content' => $content ) );
		$this->session->set_flashdata( 'system_msg', 'Pitanje uspješno poslano.' );
		header( 'Location: http://' . site_url() );
	}
	
	//	user sign in
	function login(){
		$username = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );
		$ret = $this->user_model->authenticate( $username, $password );
		if( $ret == -1 ){
			$this->session->set_flashdata( array( 'login_msg' => 'Kriva lozinka.', 'attempted_username' => $username ) );
			header( 'Location: http://' . site_url() );
		} else if( $ret == -2 ){
			$this->session->set_flashdata( array( 'login_msg' => 'Nepostojeće korisničko ime.', 'attempted_username' => $username ) );
			header( 'Location: http://' . site_url() );
		} else {			
			$data = array( 'user_id' => $ret, 'username' => $username );
			$this->session->set_userdata( $data );
			header( 'Location: http://' . site_url() );
		}
	}

	function logout(){
		$this->session->sess_destroy();
		header( 'Location: http://' . site_url() );
	}

};


?>
