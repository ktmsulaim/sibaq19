<?php
		include '../db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Current programmes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:image" itemprop="image" content=""/>
		<meta property="og:url" content="<?php echo $_SERVER['PHP_SELF']; ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="Sibaq 2019 Arts festival"/>		
		<meta name="twitter:url" content="<?php echo $_SERVER['PHP_SELF']; ?>" />
		<meta name="twitter:card" content="" />
		<link rel="stylesheet" media="all" href="../style.css" type="text/css">
		<link rel="stylesheet" media="all" href="custom.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/secondary.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/fontawsome/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/fontawsome/css/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/aos.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/animate.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="../css/owl.theme.default.min.css" type="text/css">
		<link rel="stylesheet" media="screen and (max-width:568px)" href="css/media.css">
		<link type="text/css" rel="stylesheet" href="../css/jssocials.css" />
		<link type="text/css" rel="stylesheet" href="../css/jssocials-theme-flat.css" />
		<link rel="icon" href="../img/logo.ico">
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
	<body style="background-color:#fff !important;" class="live">
		
	
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
				
<!---------------------------------------- main content ---------------------------------------------------------->
			<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="headpart p-3">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-2">
										<div class="logo">
											<img src="../img/logo_low.png" width="200" alt="">
										</div>
									</div>
									<div class="col-md-10">
										<div class="text-center">
											<h4 class="text-upper">Darul Huda Islamic Unviersity</h4>
											<h2>Sibaq'19 | Intercollegiate National Arts Fest</h2>
											<i>"More than an arts fest!"</i>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</header>
			
				
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						
						<div class="table-content mt-5">
							
						</div>
						
					</div>
				</div>
			</div>
		</main>
		
		
		
		<script src="../js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="../js/aos.js" type="text/javascript"></script>
		<script src="../js/jquery.cycleText.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jssocials.min.js"></script>
		<script src="../js/main.js" type="text/javascript"></script>
		<script>
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
				
				// ajax auto laoad
				setInterval(function(){
					$('.table-content').empty();
					$.ajax({ url: "liveprg.php",
					context: document.body,
					success: function(data){
					   $('.table-content').append(data);
					}
					});
				
				}, 5000);
				
			});
		</script>
	</body>
</html>