<?php 
	if( !defined( 'BASEPATH' ) ) 
		exit( 'No direct script access allowed' );
	if( !function_exists( 'niceDate' ) ){
			
		function niceDate( $str ){
			$mjesecovi = array( 'siječanj', 'veljača', 'ožujak', 'travanj', 'svibanj', 'lipanj', 'srpanj', 'kolovoz', 'rujan', 'listopad', 'studeni', 'prosinac' );
			$y = substr( $str, 0, 4 );
			$m = substr( $str, 5, 2 );
			$d = substr( $str, 8, 2 );
			$H = substr( $str, 11, 2 );
			$M = substr( $str, 14, 2 );
			return $d . '. ' . $mjesecovi[ ( int ) $m - 1 ] . ' ' . $y . '.';
		}
		
	}
?>
