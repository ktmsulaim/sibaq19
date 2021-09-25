<?php
		include '../db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Toppers</title>
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
		<style>
			.item{
				padding: 20px;
			}
		</style>
	</head>
	<body class="toppers">
		
	
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
			<h4 class="topperhead">SIBAQ    <span class="mt-4 d-block">TOPPERS</span></h4>
				
			<div class="container">
				<div class="owl-carousel" id="toppers">
				<div class="row item">
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Bidaya</h2>
						<div class="owl-carousel bidayatopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'bidaya' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'bidaya' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Uoola</h2>
						<div class="owl-carousel uoolatopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'uoola' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'uoola' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Thaniya</h2>
						<div class="owl-carousel thaniyatopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'thaniya' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'thaniya' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Thanawiya</h2>
						<div class="owl-carousel thanawiyatopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'thanawiya' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'thanawiya' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="row item">
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Aliya</h2>
						<div class="owl-carousel aliyatopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'Aliya' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'Aliya' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Bidaya niics</h2>
						<div class="owl-carousel bdtopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'bidaya niics' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'bidaya niics' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Uoola niics</h2>
						<div class="owl-carousel ultopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'uoola niics' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'uoola niics' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-6">
					<h2 class="text-center">Thaniya Niics</h2>
						<div class="owl-carousel thtopper">
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest LEFT JOIN programmes p ON p.p_code = c.p_code WHERE c.category = 'thaniya niics' AND c.grade_point IN (7,5,3,1) AND p.status = 'publish' OR c.category = 'thaniya niics' AND c.position_point IN (1,3,5) AND p.status = 'publish' GROUP BY c.chest ORDER BY point DESC LIMIT 3");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								$place = $row['place'];
	
										echo '<div class="item">
								<div class="contact-card">
									<div class="card-inner">
										<div class="card-photo float-left w-50">
											<img src="../registration/candidate/'.$row['photo_path'].'" alt="" class="img-fluid">
										</div>
										<div class="points-inner float-left w-50 p-4">
									<section class="name">
										<h5>'.$name.'</h5>
									</section>
									<section class="chestno">
										<b>'.$chest.'</b>
									</section>
									<section class="uginst">
										'.strtoupper(preg_replace('/@.*/', '', $author)).', '.$place.'
									</section>
									<section class="points text-center">
										<span class="display-4">
											'.$row['point'].'
										</span>
										<div><span>Points</span></div>
									</section>
								</div>
							</div>
							</div>
							</div>
							';
						}
						?>
						</div>
					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</main>
		
		
		
		<script src="../js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="../js/bootstrap.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js" type="text/javascript"></script>
		<script src="../js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="../js/aos.js" type="text/javascript"></script>
		<script src="../js/jquery.cycleText.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jssocials.min.js"></script>
		<script src="main.js" type="text/javascript"></script>
		<script>
			$(function(){
				function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
				$('.table').tablesorter();
				
			});
		</script>
	</body>
</html>