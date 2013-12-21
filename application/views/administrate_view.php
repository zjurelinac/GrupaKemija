<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8"/>
	<title>Grupa iz kemije</title>
	<link rel = "stylesheet/less" type = "text/css" href = "./css/default.less"/>
	<script src = "./js/less.min.js"></script>
	<script src = "./js/jquery.min.js"></script>
	<script src = "./js/jquery.autosize.min.js"></script>
	<script src = "./js/parser.js"></script>
	<script src = "./js/popup.js"></script>
	<link rel = "shortcut icon" href = "./favicon.ico" />
	<!--<script type = "text/x-mathjax-config">
		MathJax.Hub.Config({
			showMathMenu : false,
			jsMath2jax: {
				preview: "none"
			},
			"HTML-CSS": {
			    preferredFont: "STIX",
			    scale: 100
			},
			TeX: {
  				extensions: [ "mhchem.js" ]
			}
		});
	</script>
	<script type = "text/javascript" src = "http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>-->
	<script>
		$( function(){
			$( '#new-article-content' ).autosize();
			$( '#questions' ).hide();
			$( '#users' ).hide();
			$( '#new-article-select' ).click( function( e ){
				e.preventDefault();
				$( '#questions' ).hide();
				$( '#users' ).hide();
				$( '.active-select' ).removeClass( 'active-select' );
				$( this ).addClass( 'active-select' );
				$( '#new-article' ).show();
			});
			$( '#questions-select' ).click( function( e ){
				e.preventDefault();	
				$( '#new-article' ).hide();
				$( '#users' ).hide();
				$( '.active-select' ).removeClass( 'active-select' );
				$( this ).addClass( 'active-select' );
				$( '#questions' ).show();				
			});
			$( '#users-select' ).click( function( e ){
				e.preventDefault();
				$( '#questions' ).hide();
				$( '#new-article' ).hide();
				$( '.active-select' ).removeClass( 'active-select' );
				$( this ).addClass( 'active-select' );
				$( '#users' ).show();				
			});
			$( '.type-select' ).change( function( e ){
				$( '#new-article .side .img' ).removeClass().addClass( 'img ' + $( '.type-select option:selected' ).val() );
			});
			
			function addAttachment(){
				var attachLink = $( '#add-attach-link' ).val();
				$( "#new-article-attachments" ).val( $( "#new-article-attachments" ).val() + ";" + attachLink );
				var fileName = attachLink.slice( attachLink.lastIndexOf( "/" ) + 1 );
				var fileExt = fileName.slice( fileName.lastIndexOf( "." ) + 1 );
				$( '.attachment-list' ).append( "<div class = 'attachment-item " + fileExt + "'>" + fileName + "</div>" );
			}
			
			$( '#add-attachment' ).click( function(){
				createPopup( { content: "<p>Unesite poveznicu na privitak (privitak mora biti pohranjen negdje na internetu)</p><input type = 'text' id = 'add-attach-link' name = 'add-attach-link'/>", title: "Dodaj privitak", btnOK: "Dodaj", success: addAttachment } );
			});
			
			function hideInfo(){
				$( '.front-wrapper' ).fadeOut();
			}
			
			var x = setTimeout( hideInfo, 2000 );
			$( '#new-article form' ).submit( function(){
				//$( '#new-article-content' ).val( parseArticle( $( '#new-article-content' ).val() ) );
			});
		});
	</script>
</head>
<body>
	<div class = "header-wrapper">
		<header class = "main">
			<h1><a href = "/">Grupa iz kemije <span class = "small">za 3. razrede</span></a></h1>
			<h4>Predavanja, zadaci, materijali i korisni linkovi za pripremu za natjecanje iz kemije</h4>
			<div id = "login-box">
				<div id = "user-box">
					<a href = "/administrate"><span class = "user-name"><?= $this->session->userdata( 'username' ) ?></span>
					<img src = "./img/administrate-24.png"/></a>
					<!--<a class = "logout-link" href = "/main/logout"><img src = "./img/logout-24.png" alt = "&rarr;"/></a>-->
				</div>
			</div>
		</header>
	</div>
	<div class = "front-wrapper <? if( $this->session->flashdata( 'system_msg' ) ) echo 'show'; ?>">
		<section class = "front">
			<div class = "system-msg"><b>Obavijest:</b> <?php if( $this->session->flashdata( 'system_msg' ) ) echo $this->session->flashdata( 'system_msg' ); ?></div>
		</section>
	</div>
	</div>
	<section class = "administrate">
		<div class = "section-select">
			<h3>
				<a id = "new-article-select" class =  "active-select" href = "#new-article">Novi članak</a> 
				<a id = "questions-select" href = "#questions">Pitanja</a> 
				<a id = "users-select" href = "#users">Korisnici</a>
				<a id = "logout" href = "/main/logout">Odjava</a></h3>
		</div>
		<article class = "new-article" id = "new-article">
			<form method = "post" action = "/administrate/addArticle">		
			<div class = "content">
				<input type = "text" id = "new-article-title" name = "new-article-title" placeholder = "Naslov novog članka"/>
				<textarea id = "new-article-content" name = "new-article-content" placeholder = "Ovdje unesite sadržaj novog članka ili bilješke. Pri tome se možete koristiti i osnovnim oblikovanjem teksta, to jest podebljavanjem teksta: *podebljano*, umetanjem podnaslova: # podnaslov (znak # mora biti na početku retka da bi bio prepoznat kao naslov), odvajanjem sadržaja u odlomke - dvostrukim unošenjem znaka za novi red, ubacivanjem formula, bilo unutar teksta preko \( formula \), ili u zasebnom odlomku: \[ formula \], umetanjem slika: {{ link_na_sliku }} ili linkova: [[ URL adresa ]], kreiranjem popisa: __- stavka"></textarea>
				<div class = "attachments">
					<h4>Privitci:</h4>
					<input type = "hidden" id = "new-article-attachments" name = "new-article-attachments" value = ""/>
					<div class = "attachment-list">
						<div class = "attachment-item pdf attach01">PrepProblems13.pdf<a class = "attach-remove">x</a></div>
						<div class = "attachment-item doc attach02">minerali.doc<a class = "attach-remove">x</a></div>
						<div class = "attachment-item xls attach03">kinetikaRezultati.xls<a class = "attach-remove">x</a></div>
					</div>
					<div class = "add-attachment" id = "add-attachment"><img src = "./img/ui/plus2-26.png" alt = "Dodaj"/></div>
					<!--<a class = "opt" id = "add-attachment">Dodaj privitak</a>-->
				</div>
				<div class = "new-article-actions">
					<button class = "new-article-submit-btn" type = "submit" value = "submit">Dodaj članak</button>
				</div>
			</div>
			<div class = "side">
				<div class = "img lecture"></div>
				<select class = "type-select" id = "new-article-type" name = "new-article-type">
					<option value = "lecture" selected = "selected">Predavanje</option>
					<option value = "problems">Zadaci</option>
					<option value = "materials">Materijali</option>
					<option value = "links">Poveznice</option>
					<option value = "group">Grupa</option>
					<option value = "other">Ostalo</option>
				</select>
				<div class = "date">09. prosinac 2013.</div>
			</div>
			</form>
		</article>
		<section class = "questions" id = "questions">
			<? foreach( $questions as $row ):?>
			<article class = "question">
				<div class = "content">
					<h2><?= $row->asker_name . ', <span class = "email>">&lt;' . $row->asker_email . '&gt;</span>'?></h2>
					<p><?= $row->content ?></p>
					<div class = "question-actions">
						<button class = "question-answer">Odgovori</button>
					</div>
				</div>
				<div class = "side">
					<div class = "img"></div>
					<div class = "date"><?= $row->date_asked?></div>
					<div class = "status"><?= $row->status ?></div>
				</div>
			</article>
			<? endforeach; ?>
			<!--<article class = "question">
				<div class = "content">
					<h2>Ivan Horvat, &lt;ihorvat@email.com&gt;</h2>
					<p>Suspendisse nec sem at diam eleifend sodales ac sed leo. Etiam in varius libero. Nullam vehicula purus at erat euismod lacinia. Cras eleifend volutpat neque vitae malesuada. Suspendisse condimentum facilisis adipiscing. Aenean rutrum enim vel magna elementum volutpat nec non sapien. Pellentesque auctor laoreet leo. Cras eleifend gravida velit ac interdum. Etiam rutrum iaculis leo at vestibulum.</p>
					<div class = "question-actions">
						<button class = "question-answer">Odgovori</button>
					</div>
				</div>
				<div class = "side">
					<div class = "img"></div>
					<div class = "date">12. prosinac 2013.</div>
					<div class = "status">Neodgovoreno</div>
				</div>
			</article>-->
		</section>
		<section class = "users" id = "users">
		
		</section>
	</section>
	<div class = "footer-wrapper">
		<footer class = "main">
			<div class = "left col">
				<h3>Grupa iz kemije</h3>
				<h4 class = "sub">za 3. razrede</h4>
				<p class = "school">XV. gimnazija Zagreb</p>
				<p class = "descr">Predavanja, zadaci, materijali i korisni linkovi za pripremu za natjecanja iz kemije.</p>
				<div class = "contact-info">
					<h4>Kontakt:</h4>
					<p class = "author">Zvonimir Jurelinac</p>
					<p class = "email">zjurelinac@gmail.com</p>
				</div>
			</div>
			
			<form>
				<div class = "center col">					
						<h4>Postavi pitanje:</h4>
						<label for = "question-asker">Ime i prezime:</label>
						<input type = "text" id = "question-asker" name = "question-asker"/>
						<label for = "question-email">Email adresa:</label>
						<input type = "text" id = "question-email" name = "question-email"/>
				</div>
				<div class = "right col">
						<label for = "question-content">Pitanje:</label>					
						<textarea id = "question-content" name = "question-content"></textarea>
						<button type = "submit" value = "submit">Pošalji</button>
				</div>
			</form>
		</footer>
	</div>
	<div class = "subfoot-wrapper">
		<footer class = "sub">
			Copyright &copy; 2013.&ndash; 2014. Sva prava pridržana.
		</footer>
	</div>
</body>
</html>
