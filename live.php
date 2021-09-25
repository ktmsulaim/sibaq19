<?php
		include 'db.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Live</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:url" content="<?php echo $_SERVER['PHP_SELF']; ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="Sibaq 2019 Arts festival"/>
		<meta name="twitter:url" content="<?php echo $_SERVER['PHP_SELF']; ?>" />
		<meta name="twitter:card" content="" />
		<link rel="stylesheet" media="all" href="style.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/secondary.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/css/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/aos.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/animate.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/owl.theme.default.min.css" type="text/css">
		<link rel="stylesheet" media="screen and (max-width:568px)" href="css/media.css">
		<link type="text/css" rel="stylesheet" href="css/jssocials.css" />
		<link type="text/css" rel="stylesheet" href="css/jssocials-theme-flat.css" />
		<link rel="icon" href="img/logo.ico">
			<!--	external links go here	-->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Oswald|Poppins|Roboto|Open+Sans|Raleway:700|Handlee" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="all">
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131139181-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-131139181-1');
		</script>
	</head>
	<body>
		
		<?php include 'theme/header.php'; ?>
	
		<main>
			<!--	preloader	-->
	
			<div class="loaderWrapper">
				<div class="intro-banner-vdo-play-btn pinkBg">
						<i class="glyphicon glyphicon-play whiteText" aria-hidden="true"></i>
						<span class="ripple pinkBg"></span>
						<span class="ripple pinkBg"></span>
						<span class="ripple pinkBg"></span>
				</div>
			</div>
			<!--	scroll top	-->
			<div id="scrollTop"></div>
				<a href="#scrollTop"><span class="fa fa-arrow-up" id="scrollTopBtn"></span></a>
				
<!---------------------------------------- main content ---------------------------------------------------------->
			<div class="head-part wrapper1" id="live">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Live</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Live</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="intro">
				<div class="wrapper1">
					<div class="container">
						<div class="row">
								<div class="col-md-4">
									<img src="img/live-streaming-logo.png" alt="" class="img-fluid">
								</div>
								<div class="col-md-8">
									<div class="head">
										<h1>Go with live!</h1>
									</div>
									<p class="text-center" id="introp">
									Bringing to you the best ones of the talent shows where the excellence meets perfection. The battles of talent is broadcast throughout the whole nation and is watched by many!!!.YouTube was purchased by Google in 2006, and the pair subsequently announced their live streaming app. Like Periscope, users can comment on the broadcast. Unlike Periscope, live streams on YouTube can be saved and any user can access them through the app. YouTube head of product for consumers Manuel Bronstein stated that live streaming gives creators the opportunity to "actually create a more intimate connection with their fans."
									</p>
								</div>
								<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="realtv">
				<?php
				$get_link = mysqli_query($connect, "SELECT live FROM live_link");
				$linkr = mysqli_fetch_assoc($get_link);
				$link = $linkr['live'];

			
					echo '<div class="wrapper1 bg-dark">
							<div class="container d-flex justify-content-center">
								<div class="col-md-8 m-auto">
									<div class="subhead1 text-center"><h2>Venue 1</h2></div>
									<iframe width="100%" height="315" src="https://www.youtube.com/embed/'.$link.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
							</div>
						</div>';
						
						mysqli_close($connect);
				?>
				
			</div>
		</main>
		
		<?php include 'theme/footer.php'; ?>
		
		<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/aos.js" type="text/javascript"></script>
		<script src="js/jquery.cycleText.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jssocials.min.js"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script>
			(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
		</script>
		<script>
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
			});
		</script>
	</body>
</html>