<?php
function parseArticle( $content ){
		$x = "\n" . $content . "\n";
		$len = strlen( $x );
		$S = array();
		$i = 0;
		$parsed = "";
		
		while( $i < $len ){
			$stackSize = count( $S );
			$tch = $this->escapeChar( $x[ $i ] );
			switch( $tch ){
				case '#':	
					while( count( $S ) > 0 ) 
						$parsed .= array_pop( $S );					
					$parsed .= "<h3>";
					array_push( $S, "</h3>" );
					break;
					
				case '*':					
					if( $S[ $stackSize - 1 ] !== "</b>" ){
						array_push( $S, "</b>" );
						$parsed .= "<b>";
					} else
						$parsed .= array_pop( $S );
					break;
				
				case '[':
					if( i < strlen( $x )-1  && $x[ $i+1 ] == '[' ){ // here we have a link
						$endPos = strpos( $x, ']]', $i );
						if( $endPos != FALSE ) $endPos += 2;
						$temp = substr( $x, $i, $endPos-$i+1 );
						if( strpos( $temp, '|' ) != FALSE ){						
							$temp = substr( $temp, 2, strlen( $temp ) - 4 );
							$loc = strpos( $temp, "|" );
							$t1 = substr( $temp, 0, $loc );
							$t2 = substr( $temp, $loc+1 );
							$parsed .= "<a href = '" + ( strpos( $t1, "://" ) == FALSE ? "http://" : "" ) . $t1 . "'>" . $t2 . "</a>";
							$i += strlen( $temp ) + 3;
						} else {
							$temp = substr( $temp, 2, strlen( $temp ) - 4 );												
							$parsed .= "<a href = '" . ( strpos( $temp, "://" ) == FALSE ? "http://" : "" ) . $temp . "'>" . $temp . "</a>";							
							$i += strlen( $temp ) + 3;
						}
					} else 
						$parsed .= $tChar;								
					break;
					
				case "\n":						
					if( $i == strlen( $x ) - 1 ){
						$parsed .= "\n";
						break;
					}		
					if( $x[ $i+1 ] == "\n" ){					
						while( count( $S ) )
							$parsed .= array_pop( $S );				
					} else if( $x[ $i+1 ] == ' ' ){
						if( $i < strlen( $x ) - 2 && $x[ $i+2 ] == ' ' ){
							if( $i < strlen( $x ) - 3 && $x[ $i+3 ] == '-' && $i < strlen( $x ) - 4 && $x[ $i+4 ] == ' ' ){
								if( count( $S ) > 0 && $S[ $stackSize-1 ] != "</ul>" ){
									while( count( $S ) )
										$parsed .= array_pop( $S );
									array_push( $S, "</ul>" );
									$parsed .= "<ul>";
								} 
							
								$temp = substr( $x, $i+5, strpos( $x, "\n", $i+1 ) - $i - 4 );
								$len = strlen( $temp );
								$parsed .= "<li>" + $this->escapeString( $temp ) + "</li>";
								$i += $len + 4;			
							}
						}
					} else if( count( $S ) > 0 && $S[ $stackSize - 1 ] == "</h3>" ){			
						while( count( $S ) )
							$parsed .= array_pop( $S );				
					} else if( count( $S ) > 0 && $S[ $stackSize - 1 ] == "</ul>" ){
						while( count( $S ) )
							$parsed .= array_pop( $S );
					}					
					$parsed .= "\n";
					break;
				
				default:	//	if ordinary character	
					
					if( $stackSize == 0 ){			
						array_push( $S, "</p>" );
						$parsed .= "<p>" . $tch;
				
					} else
						$parsed .= $tch;
					break;
			}
			$i++;
		}
		$parsed = substr( $parsed, 0, strlen( $parsed ) );
		while( count( $S ) )
			$parsed .= array_pop( $S );
		return $parsed;
	}
	
	private function escapeChar( $x ) {
		if( $x === "&" ) return "&amp;";
		if( $x === '<' ) return "&lt;";
		if( $x === '>' ) return "&gt;";
		if( $x === "\"" ) return "&quot;";
		if( $x === "\'" ) return "&#039;";
		return $x;
	}
	
	private function escapeString( $x ){
	$escaped = "";
	for( $i = 0; $i < strlen( $x ); ++$i )
		$escaped .= $this->escapeChar( $x[ $i ] );
	echo "<br/>escaping: [$x] => [$escaped]<br/>";
	return $escaped;	
}
?>
