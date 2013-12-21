<?php 
	$types = array( 'lecture' => 'Predavanje', 	
					'problems' => 'Zadaci', 
					'group' => 'Grupa',
					'materials' => 'Materijali', 
					'other' => 'Ostalo',
					'links' => 'Poveznice' );
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8"/>
	<title>Grupa iz kemije</title>
	<link rel = "stylesheet/less" type = "text/css" href = "./css/default.less"/>
	<script src = "./js/less.min.js"></script>
	<script src = "./js/jquery.min.js"></script>
	<script src = "./js/parser.js"></script>
	<link rel = "shortcut icon" href = "./favicon.ico" />
	<script type = "text/x-mathjax-config">
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
	<script type = "text/javascript" src = "http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
	<script>
		$( function(){
			$( '.login-link' ).click( function( e ){
				$( this ).hide();
				$( '.login-msg-box' ).hide();
				$( '#login-box form' ).slideDown( 'fast' );
			});
			
			function hideInfo(){
				$( '.front-wrapper' ).fadeOut();
			}
			
			$( '.articles article' ).each( function(){
				$txt = $( this ).find( '.content-text' );
				//console.log( $txt.attr( 'data-content' ) );
				$txt.html( parseArticle( unescapeString( $txt.attr( 'data-content' ) ) ) );
				MathJax.Hub.Queue( [ "Typeset", MathJax.Hub ] );
			});
			
			var x = setTimeout( hideInfo, 2000 );
		});
	</script>
</head>
<body>
	<div class = "header-wrapper">
		<header class = "main">
			<h1>Grupa iz kemije <span class = "small">za 3. razrede</span></h1>
			<h4>Predavanja, zadaci, materijali i korisni linkovi za pripremu za natjecanje iz kemije</h4>
			<div id = "login-box">
				<?php if( !( $this->session->userdata( 'user_id' ) ) ): ?>
				<div class = "login-link visible">Prijava</div>
				<form method = "post" action = "/main/login" class = "hidden">
					<input type = "text" id = "username" name = "username" placeholder = "Korisničko ime" value = "<?php if( $this->session->flashdata( 'attempted_username' ) ) echo $this->session->flashdata( 'attempted_username' ); ?>"/>
					<input type = "password" id = "password" name = "password" placeholder = "Lozinka"/>
					<button type = "submit" value = "submit">Prijava</button>
				</form>
				<?php else: ?>
					<div id = "user-box">
						<a href = "/administrate"><span class = "user-name"><?= $this->session->userdata( 'username' ) ?></span>
						<img src = "./img/administrate-24.png" alt = " a "/></a>
						<!--<a class = "logout-link" href = "/main/logout"><img src = "./img/logout-24.png" alt = "&rarr;"/></a>-->
					</div>
				<?php endif; ?>
				<div class = "login-msg-box"><?php if( $this->session->flashdata( 'login_msg' ) ) 
				echo $this->session->flashdata( 'login_msg' ); ?></div>
			</div>
		</header>
	</div>
	<div class = "front-wrapper <? if( $this->session->flashdata( 'system_msg' ) ) echo 'show'; ?>">
		<section class = "front">
			<div class = "system-msg"><b>Obavijest:</b><?php if( $this->session->flashdata( 'system_msg' ) ) echo $this->session->flashdata( 'system_msg' ); ?></div>
		</section>
	</div>
	<section class = "articles">
		<?php foreach( $articles as $row ): ?>
		<article class = "article-<?= $row->type ?>">
			<div class = "content">
				<h2><?= $row->title ?></h2>				
				<div class = "content-text" data-content = "<?= htmlspecialchars( $row->content, ENT_QUOTES ) ?>"><p class = "no-display"><?= $row->content ?></p></div>
			</div>
			<div class = "side">
				<div class = "img <?= $row->type ?>">
				</div>
				<div class = "type"><h3><?= $types[ $row->type ] ?></h3></div>
				<div class = "date"><?= $row->date_added ?></div>
				<div class = "options">
					<a class = "opt view">Pregled</a>
					<a class = "opt comment">Komentari</a>
					<a class = "opt print">Ispis</a>
					<a class = "opt edit admin">Uredi</a>
					<a class = "opt delete admin">Obriši</a>
				</div>
			</div>
		</article>
		<?php endforeach; ?>
		<!--<article>
			<div class = "content">
			<h2>Zadaci iz termodinamike, 1. dio</h2>
				<h4>Zadatak 1.</h4>
				<p>U zatvorenu posudu volumena \( 1\mathrm{L} \) stavljen je \( 1\ \mathrm{mol}\ \ce{ PCl3(g) } \) i \( 3\ \mathrm{mol}\ \ce{Cl2(g)} \) koji međusobno 
				reagiraju te se uspostavlja ravnoteža. <b>Napišite jednadžbu reakcije koja se odvija u posudi.</b> Ako je pri temperaturi \( T_1 = 30^{\circ}\mathrm{C} \) u posudi izmjeren tlak od \(7.3\ \mathrm{bar}\), koliki je <b>doseg</b> a kolika <b>konstanta</b> ove reakcije?</p>
				<p>Ako je pri temperaturi \( T_2 = 90^{\circ}C \) konstanta reakcije dvostruko veća, kolike su vrijednosti \(\Delta_rH^{\circ}\) te \(\Delta_rS^{\circ}\) za navedenu reakciju?</p>
				<h4>* Zadatak 2.</h4>
				<p>Služeći se prvim zakonom termodinamike, \( \mathrm{d}U = \mathrm{d}q + \mathrm{d}w \), te termodinamičkom definicijom entropije, \(\mathrm{d}S = \frac{\mathrm{d}q}{T}\) nađite izraz za promjenu entropije plina prilikom njegove izotermne ekspanzije s \(V_1\) na \(V_2\).</p>
				
				<p class = "note">Rješenja će biti stavljena na stranicu otprilike tjedan dana nakon objavljivanja zadataka, no bilo bi dobro da ove zadatke probate rješavati i prije toga.</p>
			</div>
			<div class = "side">
				<div class = "img problems"></div>
				<div class = "type"><h3>Zadaci</h3></div>
				<div class = "date">05. prosinac 2013.</div>
				<div class = "options">
					<a class = "opt view">Pregled</a>
					<a class = "opt comment">Komentari</a>
					<a class = "opt print">Ispis</a>
					<a class = "opt edit admin">Uredi</a>
					<a class = "opt delete admin">Obriši</a>
				</div>
			</div>
		</article>-->
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
			
			<form method = 'post' action = '/main/ask'>
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
