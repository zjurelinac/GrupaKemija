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
	<link rel = "stylesheet/less" type = "text/css" href = "../../css/default.less"/>
	<script src = "../../js/less.min.js"></script>
	<script src = "../../js/jquery.min.js"></script>
	<script src = "../../js/parser.js"></script>
	<link rel = "shortcut icon" href = "../../favicon.ico" />
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
		
			$( 'article.article' ).each( function(){
				$txt = $( this ).find( '.content-text' );
				//console.log( $txt.attr( 'data-content' ) );
				$txt.html( parseArticle( unescapeString( $txt.attr( 'data-content' ) ) ) );
				MathJax.Hub.Queue( [ "Typeset", MathJax.Hub ] );
			});
		});
	</script>
</head>
<body>
	<div class = "top-wrapper">
		<div class = "top">
			<div class = "left-header">
				<h4 id = "web-name">kemija.tk</h4>
			</div>
			<div id = "login-box">
				<?php if( !( $this->session->userdata( 'user_id' ) ) ): ?>
				<div class = "login-link visible">Prijava</div>
				<form method = "post" action = "/main/login" class = "hidden">
					<input type = "text" id = "username" name = "username" placeholder = "Korisničko ime" value = "<?php if( $this->session->flashdata( 'attempted_username' ) ) echo $this->session->flashdata( 'attempted_username' ); ?>"/>
					<input type = "password" id = "password" name = "password" placeholder = "Lozinka"/>
					<button type = "submit" value = "submit">Prijava</button>
				</form>
				<?php else: ?>
					<a href = "/administrate">
						<div id = "user-box">
							<span class = "user-name"><?= $this->session->userdata( 'username' ) ?></span>
							<img src = "./img/ui/administrate-24.png" alt = " a "/>
						</div>
					</a>
				<?php endif; ?>
				<div class = "login-msg-box"><?php if( $this->session->flashdata( 'login_msg' ) ) 
				echo $this->session->flashdata( 'login_msg' ); ?></div>
			</div>
		</div>
	</div>
	<div class = "header-wrapper">
		<header class = "main">
			<h1><a href = "/">Grupa iz kemije <span class = "small">za 3. razrede</span></a></h1>
			<h4>Predavanja, zadaci, materijali i korisni linkovi za pripremu za natjecanje iz kemije</h4>			
		</header>
	</div>
	<section class = "view-article">
		<article class = "article">
			<div class = "content">
				<h2><?= $title ?></h2>				
				<div class = "content-text" data-content = "<?= htmlspecialchars( $content, ENT_QUOTES ) ?>"><p class = "no-display"><?= $content ?></p></div>
				<div class = "attachments">
					<div class = "attachment-list">
						<?php 
							$attaches = explode( ";", $attachments );
						?>
						<?php foreach( $attaches as $attach ):?>
							<?php if( !empty( $attach ) ):?>
								<?php $lastpart = strrchr( $attach, "/" );?>
								<div class = "attachment-item <?= substr( strrchr( $lastpart, '.' ), 1 ) ?>"><?= substr( $lastpart, 1 ) ?></div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class = "side">
				<div class = "img <?= $type ?>">
				</div>
				<div class = "type"><h3><?= $types[ $type ] ?></h3></div>
				<div class = "date"><?= niceDate( $date_added )?></div>
				<div class = "options">
					<div class = "optgroup">
						<!--<a class = "opt view">Pregled</a>-->
						<a class = "opt download">Preuzimanje</a>
						<a class = "opt print">Ispis</a>
					</div>
					<?php if( $this->session->userdata( 'user_id' ) ):?>
						<div class = "optgroup">
							<a class = "opt edit admin">Uredi</a>
							<a class = "opt delete admin" href = "<?= 'http://' . site_url( '/main/delete/' . $article_id ) ?>">Obriši</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</article>
	</section>
</body>
</html>
