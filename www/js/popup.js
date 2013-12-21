function createPopup( obj ){
	if( typeof obj.content === "undefined" ) return;
	obj.title = obj.title || "";
	obj.btnOK = obj.btnOK || "U redu";
	
	var popID = Math.floor( Math.random() * ( 1e9 ) ) + 1;
	$( 'body' ).append( "<div class = 'popup-wrap'><div id = '" + popID + "' class = 'popup'><h3>" + obj.title + "<span class = 'popup-close'>x</span></h3><div class = 'popup-content'>" + obj.content + 
		"</div><div class = 'popup-buttons'><button class = 'popup-ok'>" + obj.btnOK + "</button></div></div></div>" );
	$( '#' + popID ).fadeIn( 'fast' );
	
	var close = function(){
		$( '.popup-wrap' ).fadeOut( 'fast' );
		$( '.popup-wrap' ).remove();
	}
	
	$( '.popup-close' ).click( function(){
		close();
	});
	
	$( '.popup' ).click( function( e ){
		e.stopPropagation();
	});
	
	$( '.popup-ok' ).click( function(){
		if( typeof obj.success !== "undefined" )
			obj.success();
		close();
	});
	
	$( '.popup-wrap' ).click( function( e ){
		close();
	});
}
