<?php
		include 'db.php';
	if(isset($_GET['chest'])){
		
	}else{
		header('Location: index.php');
	}

// candidate details 
$name = '';
$chest = '';
$category = '';
$dob = '';
$photo = '';
$ug = '';
if(isset($_GET['chest'])){
	$sql_candinfo = "SELECT s.*, c.cat_name, u.* FROM student_reg AS s INNER JOIN category AS c ON s.std_cat = c.cat_code INNER JOIN users AS u ON s.std_ug = u.username WHERE std_chest = '$_GET[chest]'";
	$run_candinfo = mysqli_query($connect, $sql_candinfo);
	while($row = mysqli_fetch_assoc($run_candinfo)){
		$name = $row['std_name'];
		$chest = $row['std_chest'];
		$category = $row['cat_name'];
		$dob = $row['std_dob'];
		$photo = $row['photo_path'];
		$ug = $row['ug_name'].', '.$row['place'];
	}
}

$gtotal = '';
$pm = '';
$percentage = '';
if(isset($_GET['chest'])){
	$run_total = mysqli_query($connect, "SELECT SUM(c.position_point + c.grade_point) AS total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.chest = '$_GET[chest]'");
	while($row2 = mysqli_fetch_array($run_total)){
		$gtotal = $row2['total'];
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Candidates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:title" content=""/>
		<meta property="og:image" itemprop="image" content=""/>
		<meta property="og:url" content="<?php echo $_SERVER['PHP_SELF']; ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="Sibaq 2019 Arts festival"/>
		<meta property="og:description" content=""/>
		<meta name="twitter:title" content="" />
		<meta name="twitter:image" itemprop="image" content="" />
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
		<link rel="icon" href="img/logo.ico">
			<!--	external links go here	-->
		<link href="https://fonts.googleapis.com/css?family=Oswald|Poppins|Roboto|Open+Sans|Raleway:700|Arimo" rel="stylesheet"> 
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
			<div class="head-part wrapper1" id="candidates">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Candidates</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Candidates</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="candidates">
				<div class="wrapper1">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-3">
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="sidebar">
												<div class="image">
													<?php
														echo '<img src="registration/candidate/'.$photo.'" alt="" class="img-fluid">';
													?>
												</div>
											</div>
										</div>
									</div>
									<?php
										if(isset($_GET['chest'])){
											if($gtotal == 0 || $gtotal == ''){
												
											}else{
												
												echo '<div class="row">
														<div class="col-md-12">
															<div class="totalPoints">
																<div class="boxCircle text-center">
																	<span class="display-1">'.$gtotal.'</span>
																	<section>Points</section>
																</div>
															</div>
														</div>
													</div>';
												
											}
										}
									?>
									
								</div>
							</div>
							<div class="col-lg-9 col-md-9">
								<div class="row">
									<div class="col-md-12">
										<div class="headstyle1">
											<h5>Personal Details</h5>
										</div>
											<div class="stdinfo">
												<div class="innerContent">
													<section class="name">
														<div class="container-fluid">
															<div class="row">
																<div class="col-md-6">Name:</div>
																<div class="col-md-6"><b><?php echo $name; ?></b></div>
																<div class="clearfix"></div>
															</div>
														</div>
													</section>
													<section class="chest">
														<div class="container-fluid">
															<div class="row">
																<div class="col-md-6">Chest No:</div>
																<div class="col-md-6"><b><?php echo $chest; ?></b></div>
																<div class="clearfix"></div>
															</div>
														</div>
													</section>
													<section class="category">
														<div class="container-fluid">
															<div class="row">
																<div class="col-md-6">Category:</div>
																<div class="col-md-6"><b><?php echo ucfirst($category); ?></b></div>
																<div class="clearfix"></div>
															</div>
														</div>
													</section>
													<section class="category">
														<div class="container-fluid">
															<div class="row">
																<div class="col-md-6">Date of birth:</div>
																<div class="col-md-6"><b><?php echo $dob; ?></b></div>
																<div class="clearfix"></div>
															</div>
														</div>
													</section>
													<section class="category">
														<div class="container-fluid">
															<div class="row">
																<div class="col-md-6">Institution:</div>
																<div class="col-md-6"><b><?php echo $ug; ?></b></div>
																<div class="clearfix"></div>
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="headstyle1">
												<h5>Programmes Schedule</h5>
											</div>
											<div class="prginfo p-3">
												<table class="table table-responsive">
													<thead>
														<tr>
															<th></th>
															<th>Programme name</th>
															<th>Programme Code</th>
															<th>Type</th>
															<th>Date</th>
															<th>Time</th>
															<th>Code.Ltr</th>
															<th>Venue</th>
															<th>Status</th>
															<th>Presence</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(isset($_GET['chest'])){
																$sql_selprg = "SELECT c.p_code,c.code_letter,  c.status AS report, p.p_name, p.p_kind , p.p_st_nst, sd.status AS pstatus, sd.* FROM final_candidates AS c INNER JOIN programmes AS p ON c.p_code = p.p_code LEFT JOIN final_schedule AS sd ON c.p_code = sd.p_code WHERE c.chest = '$_GET[chest]'";
																$run_selprg = mysqli_query($connect, $sql_selprg);
																$i =1;
																$count = mysqli_num_rows($run_selprg);
																global $count;
																
																if($count == 0){
																	echo '<div class="alert alert-danger text-center">Not selected for final</div>';
																}else{
																	while($row1 = mysqli_fetch_assoc($run_selprg)){
																		$report = ucwords($row1['report']);
																		echo '<tr>
																		<td>'.$i.'</td>
																		<td>'.$row1['p_name'].'</td>
																		<td>'.$row1['p_code'].'</td>
																		<td>'.ucfirst($row1['p_kind']).'</td>
																		<td>'.$row1['sd_date'].'</td>
																		<td>'.$row1['sd_from'].'</td>
																		<td>'.$row1['code_letter'].'</td>
																		<td>'.$row1['venue'].'</td>
																		<td>'.ucwords($row1['pstatus']).'</td>
																		<td>'.($row1['p_st_nst'] == 'y' ? '' : $report).'</td>
																		</tr>';
																		
																		$i++;
																	}
																}
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="headstyle1">
												<h5>Results</h5>
											</div>
											<div class="resultinfo p-3">
												<table class="table table-hover table-responsive">
													<thead>
														<tr>
															<th>Programme</th>
															<th>P.Code</th>
															<th>Position</th>
															<th>Grade</th>
															<th>Points</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if(isset($_GET['chest'])){
															$get_marks = mysqli_query($connect, "SELECT (c.position_point + c.grade_point) AS total, c.position, c.grade, p.p_name, p.p_code FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.chest = '$_GET[chest]' AND p.p_kind = 'individual'");
														while($row4 = mysqli_fetch_assoc($get_marks)){
															echo '<tr>
															<td>'.$row4['p_name'].'</td>
															<td>'.$row4['p_code'].'</td>
															<td>'.$row4['position'].'</td>
															<td>'.$row4['grade'].'</td>
															<td>'.$row4['total'].'</td>
														</tr>';
														}
															mysqli_close($connect);
														}
														
														
															?>
													</tbody>
												</table>
											</div>
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
		<script src="js/main.js" type="text/javascript"></script>
		<script>
			$(function(){
					function showPage(){
					$('.loaderWrapper').fadeOut();
				}
				showPage();
				
				$('table tr:contains("Selected")').addClass('success');
			});
			
		</script>
	</body>
</html>