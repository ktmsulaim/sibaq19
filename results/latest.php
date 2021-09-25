<?php
		include '../db.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Latest results</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta http-equiv="refresh" content="365">
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
	<body style="background-color:#fff !important;" class="results">
		
	
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						
					<?php
						echo '<div class="owl-carousel latestresults1">';
						$sup = '';
						$sql_seleach = "SELECT p_name, p_code, p_category FROM programmes WHERE status = 'publish' AND p_kind = 'individual' ORDER BY pb_date DESC LIMIT 36";
						$run_seleach = mysqli_query($connect, $sql_seleach);
						while($row = mysqli_fetch_assoc($run_seleach)){
							
							$p = array();
							$p[] = $row['p_code'];
							echo '<div class="item">
									<div class="candidates">
									<div class="head pt-2 pb-2 text-center">
										<h5>'.$row['p_name'].' - '.ucwords($row['p_category']).'</h5>
									</div>
									<ul class="result row">
									';
									foreach($p as $ps => $pcode){
										$sel_cand = mysqli_query($connect, "SELECT DISTINCT c.name, c.chest, c.author, c.position, c.grade, s.photo_path, u.place FROM final_candidates AS c INNER JOIN student_reg AS s ON c.chest = s.std_chest INNER JOIN users AS u ON c.author = u.username INNER JOIN programmes p ON c.p_code = p.p_code WHERE c.p_code = '$pcode' AND p.status='publish' AND c.position IN(1,2,3) OR  c.p_code = '$pcode' AND p.status='publish' AND c.grade IN('A','B') ORDER BY c.position_point DESC");
										$item = 1;
										while($row1 = mysqli_fetch_assoc($sel_cand)){
											$position = $row1['position'];
											if($position == 1){
												$sup = 'st';
											}elseif($position == 2){
												$sup = 'nd';
											}elseif($position == 3){
												$sup = 'rd';
											}else{
												$sup = '';
											}
											echo '<li class="ritem'.$item.' col-lg-6 clearfix">
											
												<div class="part1 float-left">
													<div class="imgCircle">
														<img src="../registration/candidate/'.$row1['photo_path'].'">
													</div>
												</div>
												<div class="part2 float-left">
												  <p class="chest">'.$row1['chest'].'</p>
												  <p class="name">'.$row1['name'].'</p>
												  <p class="pos">'.$row1['position'].' <sup>'.$sup.'</sup><span class="grd">'.$row1['grade'].'</span></p>
												  <p class="ug">'.strtoupper(preg_replace('/@.*/', '', $row1['author'])).', '.$row1['place'].'</p>
												  </div>
											  </li>';
											$item++;
										}
									}
								 ?>

													<?php 
										echo '
											<div class="clearfix"></div>
											</ul>
										</div>
									</div>';
								}
							echo '</div>';
							
						mysqli_close($connect);
							?>
						
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
		<script src="main.js" type="text/javascript"></script>
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