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
</head>
<body>
	<div class = "top-wrapper">
		<div class = "top">
			<div class = "left-header">
				<h4 id = "web-name">kemija.tk</h4>
			</div>
			<a href = "/administrate">
				<div id = "user-box">
					<span class = "user-name"><?= $this->session->userdata( 'username' ) ?></span>
					<img src = "../../img/ui/administrate-24.png" alt = " a "/>
				</div>
			</a>
		</div>
	</div>
	<div class = "header-wrapper">
		<header class = "main">
			<h1><a href = "/">Grupa iz kemije <span class = "small">za 3. razrede</span></a></h1>
			<h4>Predavanja, zadaci, materijali i korisni linkovi za pripremu za natjecanje iz kemije</h4>			
		</header>
	</div>
	<div class = "main">
	
	</div>
</body>
</html>
