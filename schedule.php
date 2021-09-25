<?php
		include 'db.php';
	// select time schedule
	if(isset($_GET['cat'])){
		$sql_seltimesd = "SELECT * FROM final_schedule WHERE category='$_GET[cat]'";
		$run_seltimesd = mysqli_query($connect, $sql_seltimesd);
		while($row = mysqli_fetch_assoc($run_seltimesd)){
			$category = strtoupper($row['category']);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Schedule</title>
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
			<div class="head-part wrapper1" id="schedule">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Schedule</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Schedule</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div id="intro">
				<div class="wrapper1 bg-white">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-md-8">
								<div class="head">
									<h1>Track your programmes online!</h1>
								</div>
								<p>Now you can track your programmes with a single finger touch! Enjoy this feature to be on time! </p>
								<div class="selection">
									<h4>Select category to explore time shedule</h4>
									<ul class="selection">
										<li><a href="schedule.php?cat=bidaya">Bidaya</a></li>
										<li><a href="schedule.php?cat=uoola">Uoola</a></li>
										<li><a href="schedule.php?cat=thaniya">Thaniya</a></li>
										<li><a href="schedule.php?cat=thanawiya">Thanawiya</a></li>
										<li><a href="schedule.php?cat=aliya">Aliya</a></li>
										<li><a href="schedule.php?cat=bidaya niics">Bidaya Niics</a></li>
										<li><a href="schedule.php?cat=uoola niics">Uoola Niics</a></li>
										<li><a href="schedule.php?cat=thaniya niics">Thaniya Niics</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-4 col-md-4">
								<img src="img/shedule.png" alt="" class="img-fluid">
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="times">
				<?php
					if(isset($_GET['cat'])){
							echo '<div class="wrapper1">
						<div class="container">
							<div class="row">	
								<div class="col-md-12">
									<div class="head1 text-center">
										<h3>'.$category.' <span class="badge badge-secondary">26 - 01 - 2019</span></h3>
									</div>
									<div class="table-data">
										<table class="table table-modern table-style2 table-responsive">
											<thead>
												<tr>
													<th></th>
													<th>From</th>
													<th>To</th>
													<th>Programme name</th>
													<th>Programme code</th>
													<th>Venue</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>'; ?>
											<?php
										// fetching day one
											$sql_seltimesd = "SELECT * FROM final_schedule WHERE category='$_GET[cat]' AND sd_date = '2019-01-26' ORDER BY venue";
											$run_seltimesd = mysqli_query($connect, $sql_seltimesd);
											$i = 1;
											while($row = mysqli_fetch_assoc($run_seltimesd)){
												echo '<tr>
												<td></td>
												<td>'.$row['sd_from'].'</td>
												<td>'.$row['sd_to'].'</td>
												<td>'.$row['programme'].'</td>
												<td>'.$row['p_code'].'</td>
												<td>'.$row['venue'].'</td>
												<td>'.ucwords($row['status']).'</td>
											</tr>';
											}	
										?>
										
										<?php echo '</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">	
							<div class="col-md-12">
								<div class="head1 text-center">
									<h3>'.$category.' <span class="badge badge-secondary">27 - 01 - 2019</span></h3>
								</div>
								<div class="table-data">
									<table class="table table-modern table-style2 table-responsive">
										<thead>
											<tr>
												<th></th>
												<th>From</th>
												<th>To</th>
												<th>Programme name</th>
												<th>Programme code</th>
												<th>Venue</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>'; ?>
										<?php
										// fetching day one
											$sql_seltimesd = "SELECT * FROM final_schedule WHERE category='$_GET[cat]' AND sd_date = '2019-01-27' ORDER BY venue";
											$run_seltimesd = mysqli_query($connect, $sql_seltimesd);
											$i = 1;
											while($row = mysqli_fetch_assoc($run_seltimesd)){
												echo '<tr>
												<td></td>
												<td>'.$row['sd_from'].'</td>
												<td>'.$row['sd_to'].'</td>
												<td>'.$row['programme'].'</td>
												<td>'.$row['p_code'].'</td>
												<td>'.$row['venue'].'</td>
												<td>'.ucwords($row['status']).'</td>
											</tr>';
											}	
												?>
												<?php echo '</tbody>
											</table>
										</div>
									</div>
								</div>
						<div class="row">	
							<div class="col-md-12">
								<div class="head1 text-center">
									<h3>'.$category.' <span class="badge badge-secondary">28 - 01 - 2019</span></h3>
								</div>
								<div class="table-data">
									<table class="table table-modern table-style2 table-responsive">
										<thead>
											<tr>
												<th></th>
												<th>From</th>
												<th>To</th>
												<th>Programme name</th>
												<th>Programme code</th>
												<th>Venue</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>'; ?>
										<?php
										// fetching day one
											$sql_seltimesd = "SELECT * FROM final_schedule WHERE category='$_GET[cat]' AND sd_date = '2019-01-28' ORDER BY venue";
											$run_seltimesd = mysqli_query($connect, $sql_seltimesd);
											$i = 1;
											while($row = mysqli_fetch_assoc($run_seltimesd)){
												echo '<tr>
												<td></td>
												<td>'.$row['sd_from'].'</td>
												<td>'.$row['sd_to'].'</td>
												<td>'.$row['programme'].'</td>
												<td>'.$row['p_code'].'</td>
												<td>'.$row['venue'].'</td>
												<td>'.ucwords($row['status']).'</td>
											</tr>';
											}	
											mysqli_close($connect);
												?>
												<?php echo '</tbody>
											</table>
										</div>
									</div>
								</div>
						</div>';
						}				
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
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
			});
		</script>
	</body>
</html>