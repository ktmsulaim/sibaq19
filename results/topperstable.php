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
	</head>
	<body style="background-color:#fff !important;" class="toppers">
		
	
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
					<div class="col-lg-4 col-md-4">
					<h2 class="text-center">Bidaya</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'bidaya' AND c.grade_point IN (7,5,3,1) OR c.category = 'bidaya' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Uoola</h2>
							<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'uoola' AND c.grade_point IN (7,5,3,1) OR c.category = 'uoola' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
							
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Thaniya</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'thaniya' AND c.grade_point IN (7,5,3,1) OR c.category = 'thaniya' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Thanawiya</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'thanawiya' AND c.grade_point IN (7,5,3,1) OR c.category = 'thanawiya' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Aliya</h2>
						
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'aliya' AND c.grade_point IN (7,5,3,1) OR c.category = 'aliya' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
							echo '<tr>
								<td>'.$name.'</td>
								<td>'.$chest.'</td>
								<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
								<td>'.$row['point'].'</td>
								</tr>';
						}
						?>
							</tbody>
						</table>
					
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Bidaya Niics</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'bidaya niics' AND c.grade_point IN (7,5,3,1) OR c.category = 'bidaya niics' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Uoola Niics</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'uoola niics' AND c.grade_point IN (7,5,3,1) OR c.category = 'uoola niics' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="col-lg-4 col-md-4">
						<h2 class="text-center">Thaniya Niics</h2>
						<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Chest</th>
								<th>Ug</th>
								<th>Points</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, u.place, s.photo_path, SUM(position_point + grade_point) AS point FROM final_candidates c LEFT JOIN users u ON c.author = u.username LEFT JOIN student_reg s ON c.chest = s.std_chest WHERE c.category = 'thaniya niics' AND c.grade_point IN (7,5,3,1) OR c.category = 'thaniya niics' AND c.position_point IN (1,3,5) GROUP BY c.chest ORDER BY point DESC LIMIT 10");
							while($row = mysqli_fetch_assoc($sel_cand)){
								$cand = array();
								$cand[] = $row['chest'];
								$name = $row['name'];
								$chest = $row['chest'];
								$author = $row['author'];
								
								echo '<tr>
									<td>'.$name.'</td>
									<td>'.$chest.'</td>
									<td>'.strtoupper(preg_replace('/@.*/', '', $author)).'</td>
									<td>'.$row['point'].'</td>
									</tr>';
							}
						?>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
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