<?php
	include 'db.php';

	$category = array('Bidaya', 'Uoola', 'Thaniya', 'Thanawiya', 'Aliya', 'Kulliya', 'Bidaya niics', 'Uoola niics', 'Thaniya niics');
	$active = '';
	$current = '';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Programmes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:title" content="Sibaq '19 - Intercollegiate fest | programmes"/>
		<meta property="og:image" content="img/logo_low.png"/>
		<meta property="og:url" content="http://www.sibaq.in/programmes.php"/>
		<meta property="og:type" content="article"/>
		<meta property="og:site_name" content="Sibaq 2019 Arts festival"/>
		<meta property="og:description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items."/>
		<meta name="twitter:title" content="Sibaq '19 - Intercollegiate fest" />
		<meta name="twitter:image" content="img/logo_low.png" />
		<meta name="twitter:url" content="" />
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
		
		<link rel="icon" href="img/logo.ico">
			<!--	external links go here	-->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Oswald|Poppins|Roboto|Open+Sans|Raleway:700|Handlee" rel="stylesheet"> 
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
			<div class="head-part wrapper1" id="programmes">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Programmes</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Programmes</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="programme-part1" class="wrapper1">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4">
							<?php
								if(isset($_GET['cat'])){
									
								}else{
									echo '<img src="img/bg14.png" alt="" class="img-fluid d-block m-auto">';
								}
							?>
							
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="boxContent">
									<?php
										if(isset($_GET['cat'])){
											
										}else{
											echo '<div class="about-programmes">
												<span id="typewrite" class="subhead"></span>
											<p class="text-justify pt-4">At the fest of Sibaq 19, we aim to sharpen the immature skills by several means and through a number of competitions. The various skills of writing, oratory, aptitude, versatility and virtuosity are improved to equip the students with best in class expertise and professionalism. Engagement of 32 UG colleges and more than 2600 candidates leaves nothing more to tell!!!.</p>
											<div class="qoute">
											<section class="float-left part-one"><i class="fa fa-quote-right fa-2x"></i></section>
											<section class="float-left part-two"><quote class="blockquote">“Every child is an artist. The problem is how to remain an artist once we grow up.”
											<span class="float-right small pr-3"> - Pablo Picasso</span>
											</quote>
											</section>
											<div class="clearfix"></div>
											</div>
											</div>';
										}
									
									?>
								
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="wrapper1">
						<div class="head text-center">
							<?php 
								if(isset($_GET['cat'])){
									echo '<h3>'.$_GET['cat'].'</h3>';
								}else{}
							?>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="sidebar">
									<div class="head1">
										<h4>Category <?php echo $current; ?></h4>
									</div>
									<div class="catlist ptb-15">
										<ol id="categoryList" class="rectangle-list">
											<?php
												for($i=0;$i <= 8; $i++){
													if(isset($_GET['cat'])){
													if($_GET['cat'] == $category[$i]){
														$active = 'active';
													}else{
														$active = '';
													}
												}
													echo '<li><a href="programmes.php?cat='.$category[$i].'" class="'.$active.'">'.$category[$i].'</a></li>';
												}
											?>
										</ol>
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<div class="type-wise">
										<div class="row">
											<div class="col-lg-6 col-md-6">
												<?php
												if(isset($_GET['cat'])){
													echo '<div class="subhead ptb-10">
													<h5>Stage</h5>
												</div>
												<div class="stageItems">
													<table class="table table-modern table-style1">
														<thead>
															<tr>
																<th>Sl.no</th>
																<th>Programme name</th>
																<th>Programme Code</th>
															</tr>
														</thead>
														<tbody>';
												}else{}

														?>
															<?php
																if(isset($_GET['cat'])){
																	$sql_progsel = "SELECT p_name, p_code FROM programmes WHERE p_category = '$_GET[cat]' AND p_type = 'stage'";
																	$run_progsel = mysqli_query($connect, $sql_progsel);
																	$i = 1;
																	while($row = mysqli_fetch_assoc($run_progsel)){
																		echo '<tr>
																				<td>'.$i.'</td>
																				<td>'.$row['p_name'].'</td>
																				<td>'.$row['p_code'].'</td>
																			</tr>';		
																		$i++;
																	}
																	echo '</tbody>
																				</table></div>';
																}else{}
															?>
											</div>
											<div class="col-lg-6 col-md-6">
												<?php
												if(isset($_GET['cat'])){
													echo '<div class="subhead ptb-10">
													<h5>Non Stage</h5>
												</div>
												<div class="stageItems">
													<table class="table table-modern table-style1">
														<thead>
															<tr>
																<th>Sl.no</th>
																<th>Programme name</th>
																<th>Programme Code</th>
															</tr>
														</thead>
														<tbody>';
												}else{}

														?>
															<?php
																if(isset($_GET['cat'])){
																	$sql_progsel = "SELECT p_name, p_code FROM programmes WHERE p_category = '$_GET[cat]' AND p_type = 'non_stage'";
																	$run_progsel = mysqli_query($connect, $sql_progsel);
																	$i = 1;
																	while($row = mysqli_fetch_assoc($run_progsel)){
																		echo '<tr>
																				<td>'.$i.'</td>
																				<td>'.$row['p_name'].'</td>
																				<td>'.$row['p_code'].'</td>
																			</tr>';		
																		$i++;
																	}
																	echo '</tbody>
																				</table></div>';
																}else{}
															mysqli_close($connect);
															?>
											</div>
											<div class="clearfix"></div>
											<?php
												if(isset($_GET['cat'])){
													
												}else{
													print '<img src="img/bg15.png" alt="" class="img-fluid d-block m-auto">';
												}
											?>
										</div>
									</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					
				</div>
			</div>
		</main>
		
		<?php include 'theme/footer.php'; ?>
		
		<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/aos.js" type="text/javascript"></script>
		<script src="js/jquery.cycleText.min.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script>
			// jquery typewriter run
			var typed = new Typed('#typewrite', {
			  	strings: ["New programmes are here!", "Don't miss it, make it soon!"],
				typeSpeed: 30,  
				loop: true,
				loopCount: Infinity,
				backSpeed: 50,
				backDelay: 1000
			});
			typed();
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