<?php 
class Test extends CI_Controller{

	function __construct(){
		parent::__construct();
	}
	
	function index(){
		if( $this->session->userdata( 'user_id' ) )
			print( 'User ' . $this->session->userdata( 'username' ) . ' logged in.' );
		else
			print( 'Log in required.' );
	}
	
	function insert_user(){
		print( 'Inserting user<br/>' );
		$data = array( 'username' => 'admin', 'email' => 'imejl@server2.dom', 'name' => 'Pero Perić', 
			'password' => password_hash( 'UltraStrongLozinka326', PASSWORD_DEFAULT ) );
		print( $this->user_model->create( $data ) );
	}

	function auth_user(){
		print( 'Authenticating user<br/>' );
		
		$username = 'admin';
		$password = 'UltraStrongLozinka326';
		
		$ret = $this->user_model->authenticate( $username, $password );
		print( $ret );
		if( $ret == -1 ) print( '<br/><b>Wrong password. Try again.</b>' );
		else if( $ret == -2 ) print( '<br/><b>No such user.</b>' );
		else {
			print( '<br/><b>Great success.</b>' );
			$data = array( 'user_id' => $ret, 'username' => $username );
			$this->session->set_userdata( $data );
		}
	}
	
	function insert_article(){
		$data = array( 'title' => 'Probni članak ni o čemu',
			'type' => 'Beta Test', 'image' => 'none', 'content' => 'Aliquam faucibus blandit enim, nec accumsan diam faucibus eget. Pellentesque lobortis, elit in tristique aliquam, arcu lectus lobortis massa, ac semper nibh erat vitae felis. Vivamus eget erat lacus. Mauris imperdiet felis magna, eget rhoncus magna feugiat vel. Sed eget mi nisi. Nam eleifend, lectus quis laoreet fermentum, mauris ipsum facilisis turpis, vel sagittis risus nulla vitae nisi. ' );
		$this->article_model->insert( $data );
	}

}
?>
