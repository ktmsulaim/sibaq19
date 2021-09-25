<?php
		include 'db.php';
// send mail
if(isset($_POST['submit'])){
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d g:i:s");
	
	$name = strip_tags($_POST['name']);
	$email = strip_tags($_POST['email']);
	$number = strip_tags($_POST['number']);
	$msg = strip_tags($_POST['msg']);
	
	$run_sql_ins = mysqli_query($connect, "INSERT INTO comments (name, number, email, message, date) VALUES('$name', '$number', '$email', '$msg', '$date')");

	
	if($run_sql_ins){
		header('Location: contact.php?success');
	}else{
		header('Location: contact.php?failed');
	}
	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Contact Us</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:title" content="Contact US"/>
		<meta property="og:image" itemprop="image" content=""/>
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
			<div class="head-part wrapper1" id="contactus">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Contact Us</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Contact Us</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="contactForm">
				<div class="wrapper1">
					<div class="container">
						<div class="row">
							<div class="col-md-8 m-auto">
								<form action="contact.php" class="form-horizontal" method="post" role="form">
									<div class="form-group ptb-10">
										<img src="img/form.png" width="150" alt="" class="d-block m-auto">
									</div>
									<div class="form-group">
										<h2>Leave a message</h2>
									</div>
									<div class="form-group">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-6">
													<div class="labelHolder">
														<label for="name" class="label">Name</label>
														<input type="text" id="name" name="name" class="input input-form" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="labelHolder">
														<label for="number" class="label">Phone number</label>
														<input type="text" id="number" name="number" class="input input-form" required>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="labelHolder">
														<label for="email" class="label">Email</label>
														<input type="email" id="email" name="email" class="input input-form" required>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													<div class="labelHolder">
														<label for="msg" class="label">Message</label>
														<textarea name="msg" id="msg" cols="30" rows="5" class="input input-form" required></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12 d-flext justify-content-right">
													<input type="submit" name="submit" class="btn6 input2" value="Submit">
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		
		<?php include 'theme/footer.php'; ?>
		
		<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>		
		<script src="js/main.js" type="text/javascript"></script>
		<script>
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
				
				<?php
			if(isset($_GET['success'])){
				echo '
				swal("Success!", "Thank you for contacting us!", "success");';
			}
		?>
			});
		</script>
		
	</body>
</html>