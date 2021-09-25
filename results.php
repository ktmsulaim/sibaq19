<?php
		include 'db.php';
// group progrmmes
$pname = '';
if(isset($_GET['cat'])){
	$sql_grpprg = "SELECT g.ug, u.photo, u.place, p.p_name, g.p_code FROM group_points AS g INNER JOIN users AS u ON g.ug = u.username INNER JOIN programmes AS p ON g.p_code = p.p_code WHERE p.status = 'publish' AND g.status = 'Selected' AND p.p_category = '$_GET[cat]'";
	$run_grpprg = mysqli_query($connect, $sql_grpprg);
	while($row = mysqli_fetch_assoc($run_grpprg)){
		$pname = $row['p_name'].' '.$row['p_code'];
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq '19 - Intercollegiate fest | Results</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1.0, user-scalabe=no">
		<meta charset="utf-8">
		<meta name="author" content="Darul Huda Islamic University">
		<meta name="keywords" content="sibaq, sibaq'19, darul huda, dsu, arts fest, intercollegiate, dhiu, sbq, sibaq.in">
		<meta name="description" content="In Sibaq'19, more than 3000 candidates are expected to showcase their talents in a number of artistic, literary, cultural, sportive items.">
		
		<!--	og:tags	-->
		<meta property="og:url" content="<?php echo $_SERVER['PHP_SELF']; ?>"/>
		<meta name="twitter:url" content="<?php echo $_SERVER['PHP_SELF']; ?>" />
		<meta name="twitter:card" content="" />
		<link rel="stylesheet" media="all" href="style.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/secondary.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/bootstrap/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/fontawsome/css/fontawesome-all.css" type="text/css">
		<link rel="stylesheet" media="all" href="css/aos.css" type="text/css">
		<link rel="stylesheet" href="registration/candidate/css/jquery-ui.min.css" media="all">
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
			<div class="head-part wrapper1" id="result">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 text-center">
							<div class="head-main">
								<h1>Results</h1>
							</div>
							<div class="breadcrumb-modern">
								<ul class="breadcrumb-modern-list">
									<li><a href="index.php">Home</a></li>
									<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Results</a></li>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div id="introResult">
				<div class="wrapper1 bg-white">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<img src="img/imgforresult.png" alt="" class="img-fluid">
							</div>
							<div class="col-md-8">
								<div class="head">
									<h1>Most memorable moments are here!</h1>
								</div>
								<p>The outcomes of the consistent endeavors and tenacious strives are finally disclosed. The hearts beat faster than before and expectations are high, but only a high level of  magnificence can make the victory happen. By the way, best of luck!!!</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="groupprg">
				<div class="wrapper1 bg-light">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="subhead text-center">
									<h4>Find result</h4>
								</div>
								<div class="col-md-12">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-10 m-auto d-flex justify-content-center">
													<ul class="selection text-center">
														<li><a href="results.php?cat=bidaya">Bidaya</a></li>
														<li><a href="results.php?cat=uoola">Uoola</a></li>
														<li><a href="results.php?cat=thaniya">Thaniya</a></li>
														<li><a href="results.php?cat=thanawiya">Thanawiya</a></li>
														<li><a href="results.php?cat=aliya">Aliya</a></li>
														<li><a href="results.php?cat=kulliya">Kulliya</a></li>
														<li><a href="results.php?cat=bidaya niics">Bidaya Niics</a></li>
														<li><a href="results.php?cat=uoola niics">Uoola Niics</a></li>
														<li><a href="results.php?cat=thaniya niics">Thaniya Niics</a></li>
													</ul>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<form action="results.php" method="post" role="form">
													<?php
														$category = '';
														if(isset($_GET['cat'])){
															echo '<div class="inputHolder ptb-20">
															<select name="prog" id="prog">
																<option value="" selected>Select programme</option>';
															
															$sql_selprogs = "SELECT p_name, p_code, p_category FROM programmes WHERE p_category = '$_GET[cat]' AND status = 'publish'";
															$run_selprogs = mysqli_query($connect, $sql_selprogs);
															while($row1 = mysqli_fetch_assoc($run_selprogs)){
																$category = $row1['p_category'];
																echo '<option value="'.$row1['p_code'].'">'.$row1['p_name'].'</option>';
															}
															echo '</select>
														</div>';
															
															echo '<div class="head text-center"><h5>'.strtoupper($_GET['cat']).'</h5></div>';
														
															mysqli_close($connect);
														}
														
														?>
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 p-3">
													<div class="table-content">
														
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="ugwise">
				<div class="wrapper1 bg-white">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<?php
									if(isset($_GET['cat'])){
										
									}else{
										echo '<div class="head">
									<h1>UG wise final result</h1>
								</div>';
									}
								?>
								<div class="owl-carousel" id="ugwise">
									<?php
										if(isset($_GET['cat'])){
											
										}else{
											//select all ug name
											$sql_ugnames = "SELECT username, place, role, user_id FROM users WHERE role IN('ug','ugnat')";
											$i = 1;
											$run_ugnames = mysqli_query($connect, $sql_ugnames);
											while($row2 = mysqli_fetch_assoc($run_ugnames)){
												$ug = array();
												$ug[] = $row2['username'];
												$role = $row2['role'];
												
												if($role == 'ug'){
													$bidaya = 'Bidaya';
													$uoola = 'Uoola';
													$thaniya = 'Thaniya';
												}elseif($role == 'ugnat'){
													$bidaya = 'Bidaya niics';
													$uoola = 'Uoola niics';
													$thaniya = 'Thaniya niics';
												}
												foreach ($ug as $ugs => $ugname){
													$sql_sel_count = "SELECT COUNT(DISTINCT p.p_code) AS count FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE p.status = 'publish' AND c.status = 'Selected' AND c.author = '$ugname'";
													$run_sel_count = mysqli_query($connect, $sql_sel_count);
													
													// total marks
													// if niics change 
													
													if($role == 'ug'){
														$ind_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total, w.gpp, w.ntp FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code LEFT JOIN users u ON c.author = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE p.status = 'publish' AND c.author = '$ugname'");
													
														$grp_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes p ON g.p_code = p.p_code LEFT JOIN users u ON g.ug = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE  p.status = 'publish' AND g.ug = '$ugname'");
													
													}elseif($role == 'ugnat'){
														// select niics category
														$NNind_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total, w.gpp, w.ntp FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code LEFT JOIN users u ON c.author = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE p.status = 'publish' AND c.author = '$ugname' AND p.p_category_c IN('B', 'U', 'T')");
													
														$NNgrp_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes p ON g.p_code = p.p_code LEFT JOIN users u ON g.ug = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE  p.status = 'publish' AND g.ug = '$ugname' AND p.p_category_c IN('B', 'U', 'T')");
														
														// select niics general cat
														
														$NGind_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total, w.gpp, w.ntp FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code LEFT JOIN users u ON c.author = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE p.status = 'publish' AND c.author = '$ugname' AND p.p_category_c IN('W', 'A', 'K')");
													
														$NGgrp_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes p ON g.p_code = p.p_code LEFT JOIN users u ON g.ug = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE  p.status = 'publish' AND g.ug = '$ugname' AND p.p_category_c IN('W', 'A', 'K')");
													}
													
													
													$ind_mark = mysqli_fetch_array($ind_sql);
													$ind = $ind_mark['total'];
													$grp_mark = mysqli_fetch_array($grp_sql);
													$grp = $grp_mark['total'];
													
													///////////////
													/****---------  ----------*****/
														if($role == 'ug'){
															$total = ($ind + $grp);
															$tpmind = $ind_mark['gpp'];
															// get ind percentage of maximum pp
															$perc = ($total * 100) / $tpmind;
															
														}elseif($role == 'ugnat'){
															// niicscat perc
															$n_indr = mysqli_fetch_array($NNind_sql);
															$n_ind = $n_indr['total'];
															$n_pm = $n_indr['ntp'];
															$n_grpr = mysqli_fetch_array($NNgrp_sql);
															$n_grp = $n_grpr['total'];
															
															$ntotal = ($n_ind + $n_grp);
															$n_perc = ($ntotal * 100) / $n_pm;
															
															// general perc
															$ng_indr = mysqli_fetch_array($NGind_sql);
															$ng_ind = $ng_indr['total'];
															$ng_pm = $ng_indr['gpp'];
															$ng_grpr = mysqli_fetch_array($NGgrp_sql);
															$ng_grp = $ng_grpr['total'];
															
															$ngtotal = ($ng_ind + $ng_grp);
															
															if($ng_pm == 0){
																$ng_perc = 0;
															}else{
																$ng_perc = ($ngtotal * 100) / $ng_pm;
															}
															
														}	
													
													
													
													
													
													
													
													
													// get grp percentage of maximum pp
//													$grp_perc = ($grp * $tpmind) / 100;
													
//													$percentage = $perc;
													
													
													// category wise count
													///////////// BIDAYA ////////////////////
													$indD_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = '$bidaya'");
													$grpD_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = '$bidaya'");
													
													$indD_mark = mysqli_fetch_array($indD_sql);
													$grpD_mark = mysqli_fetch_array($grpD_sql);
													$indD = $indD_mark['total'];
													$grpD = $grpD_mark['total'];
													$markD = ($indD + $grpD);
													
													///////////// UOOLA ////////////////////
													$indL_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = '$uoola'");
													$grpL_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = '$uoola'");
													
													$indL_mark = mysqli_fetch_array($indL_sql);
													$grpL_mark = mysqli_fetch_array($grpL_sql);
													$indL = $indL_mark['total'];
													$grpL = $grpL_mark['total'];
													$markL = ($indL + $grpL);
													
													///////////// THANIYA ////////////////////
													$indN_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = '$thaniya'");
													$grpN_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = '$thaniya'");
													
													$indN_mark = mysqli_fetch_array($indN_sql);
													$grpN_mark = mysqli_fetch_array($grpN_sql);
													$indN = $indN_mark['total'];
													$grpN = $grpN_mark['total'];
													$markN = ($indN + $grpN);
													
													///////////// THANAWIYA ////////////////////
													$indW_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = 'thanawiya'");
													$grpW_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = 'thanawiya'");
													
													$indW_mark = mysqli_fetch_array($indW_sql);
													$grpW_mark = mysqli_fetch_array($grpW_sql);
													$indW = $indW_mark['total'];
													$grpW = $grpW_mark['total'];
													$markW = ($indW + $grpW);
													
													///////////// ALIYA ////////////////////
													$indA_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = 'aliya'");
													$grpA_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = 'aliya'");
													
													$indA_mark = mysqli_fetch_array($indA_sql);
													$grpA_mark = mysqli_fetch_array($grpA_sql);
													$indA = $indA_mark['total'];
													$grpA = $grpA_mark['total'];
													$markA = ($indA + $grpA);
													
													///////////// KULLIYA ////////////////////
													$indK_sql = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code WHERE p.status = 'publish' AND c.author = '$ugname' AND c.category = 'kulliya'");
													$grpK_sql = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total FROM final_group g LEFT JOIN programmes c ON g.p_code = c.p_code WHERE c.status = 'publish' AND g.ug = '$ugname' AND c.p_category = 'kulliya'");
													
													$indK_mark = mysqli_fetch_array($indK_sql);
													$grpK_mark = mysqli_fetch_array($grpK_sql);
													$indK = $indK_mark['total'];
													$grpK = $grpK_mark['total'];
													$markK = ($indK + $grpK);
													

													
													// retrieve count
													
													// $result array initilize
													
													while($row3 = mysqli_fetch_assoc($run_sel_count)){
														
														// push to array
														// arraypush(arrayname, array(k1=v1, ..))
														
														
														
														echo '<div class="item ugblock">
																<div class="photo" style="background:url(img/'.$row2['user_id'].'.jpg)center center;background-size:cover;">
																	<span class="rank">'.$i.'</span>
																</div>
																<div class="ugdetails text-center">
																	<section class="name">
																		<b>'.strtoupper(preg_replace('/@.*/', '', $row2['username'])) .', '.$row2['place'].'</b>
																	</section>
																	<div class="catwise">
																		<section class="cwcount">
																			Bidaya : <b>'.$markD.'</b>
																		</section>
																		<section class="cwcount">
																			Uoola : <b>'.$markL.'</b>
																		</section>
																		<section class="cwcount">
																			Thaniya : <b>'.$markN.'</b>
																		</section>
																		<section class="cwcount">
																			Thanawiya : <b>'.$markW.'</b>
																		</section>
																		<section class="cwcount">
																			Aliya : <b>'.$markA.'</b>
																		</section>
																		<section class="cwcount">
																			Kulliya : <b>'.$markK.'</b>
																		</section>
																	</div>';

																	
																		if($role == 'ug'){
																			echo '<section class="tcount">
																					<h2>'.$total.' <span class="small" style="font-size">Points</span></h2>
																					<span class="perc">'.number_format($perc,2).'%</span>
																				</section>';
																		}elseif($role == 'ugnat'){
																			echo '<section class="tcount">
																					<h4 class="text-left clearfix p-2">
																					
																					<span class="float-left">N: '.$ntotal.' </span>
																					
																					<span class="float-right">G: '.$ngtotal.' </span></h4>
																					<section class="clearfix perc">
																						<span class="float-left">'.number_format($n_perc,2).'%</span>

																						<span class="float-right">'.number_format($ng_perc,2).'%</span>
																					</section>
																				</section>';
																		}			
														
																echo '</div>
															</div>';
														
													}
													
													// array_multisort
													
													// another print loop using sorted array
												}
												$i++;
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				if(isset($_GET['cat'])){
					
				}else{
					echo '<div id="graph">
				<div class="wrapper1">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="head text-center">
									<h3>Points based graph</h3>
								</div>
								<canvas id="totalChart" width="400" height="400"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>';
				}
			?>
			
		</main>
		
		<?php include 'theme/footer.php'; ?>
		
		<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
		<script>
			$(function(){
				$('#prog').selectmenu().selectmenu( "menuWidget" )
        .addClass( "overflow" );
				$('#prog').on('selectmenuchange change', function(){
						var programmes = $(this).val();
						$('.table-content').empty();
						$.ajax({
							url : 'ajax/getcand.php',
							type : "GET",
							data : {programme:programmes},
							beforeSend : function(){
								$('.table-content').append('<div class="alert alert-warning w-25 text-center m-auto" id="loading">loading</div>');
							},
							complete : function(){
								$('#loading').remove();
							},
							success : function(data){
								$('.table-content').append(data);
							},
							fail : function(){
								$('.table-content').text('Failed to load');
							}
						});
					});
			});
		</script>
		<script>
			<?php
				$run_getug = mysqli_query($connect, "SELECT username, place FROM users WHERE role IN('ug','ugnat')");
			
			?>
		var ctx = document.getElementById("totalChart");
		var myChart = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: [ <?php while($row4 = mysqli_fetch_assoc($run_getug)){ $ug = strtoupper(preg_replace('/@.*/', '', $row4['username'])) .', '.$row4['place']; echo '"'.$ug.'"'.',';} ?>],
				datasets: [{
					label: 'Total percentage',
					
					data: [
						<?php
							//select all ug name
						$sql_ugnames2 = "SELECT username, place, role FROM users WHERE role IN('ug','ugnat')";
						$i = 1;
						$run_ugnames2 = mysqli_query($connect, $sql_ugnames2);
						while($row2 = mysqli_fetch_assoc($run_ugnames2)){
							$ug1 = array();
							$ug1[] = $row2['username'];
							$role = $row2['role'];
						
							if($role == 'ug'){
								$bidaya = 'Bidaya';
								$uoola = 'Uoola';
								$thaniya = 'Thaniya';
							}elseif($role == 'ugnat'){
								$bidaya = 'Bidaya niics';
								$uoola = 'Uoola niics';
								$thaniya = 'Thaniya niics';
							}
							foreach ($ug1 as $ugs1 => $ugname1){
								$sql_sel_count2 = "SELECT COUNT(DISTINCT p.p_code) AS count FROM programmes AS p INNER JOIN candidate_reg AS c ON p.p_code = c.prog_code WHERE p.status = 'publish' AND c.status = 'Selected' AND c.author = '$ugname1'";
								$run_sel_count2 = mysqli_query($connect, $sql_sel_count2);

								// total marks
								$ind_sql2 = mysqli_query($connect, "SELECT SUM(c.grade_point + c.position_point) as total, w.tpp, (SUM(c.grade_point + c.position_point) / w.tpp) * 100 AS possible FROM final_candidates c LEFT JOIN programmes p ON c.p_code = p.p_code LEFT JOIN users u ON c.author = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE p.status = 'publish' AND c.author = '$ugname1'");
								
								$grp_sql2 = mysqli_query($connect, "SELECT SUM(g.grade_point + g.position_point) as total, (SUM(g.grade_point + g.position_point) / w.tpp) * 100 AS possible FROM final_group g LEFT JOIN programmes p ON g.p_code = p.p_code LEFT JOIN users u ON g.ug = u.username LEFT JOIN ftotal_pp w ON u.sibaq_id = w.code WHERE  p.status = 'publish' AND g.ug = '$ugname1'");
								
								$ind_mark2 = mysqli_fetch_array($ind_sql2);
								$grp_mark2 = mysqli_fetch_array($grp_sql2);
								$ind2 = $ind_mark2['total'];
								$grp2 = $grp_mark2['total'];
								$totalwtgInd = $ind_mark2['possible'];
								$grpwtgInd = $grp_mark2['possible'];
								$totalwtg = $totalwtgInd + $grpwtgInd;
								$total2 = ($ind2 + $grp2);
								
								while($row5 = mysqli_fetch_assoc($run_sel_count2)){
									echo $totalwtg.',';
								}
							}
						}
						?>
					],
					backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 159, 64, 0.2)'            ],
					borderWidth: 1,
				borderColor: [
						'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
				'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
				'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
				'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
				'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
				'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)',
                'rgba(255, 159, 64, 0.9)'
					]
				}
				]
			},
			options: {
				scales: {
					xAxes: [{
						ticks: {
							beginAtZero:true,
							max: 100
						}
					}],
					yAxes: [{
						barPercentage: 1,
						categoryPercentage: 1
					}]
				},
				 layout: {
            padding: {
                left: 25,
                right: 10,
                top: 10,
                bottom: 20
            }
				
        },
				legend: {
					display: false
				}
			}
		});
			
		</script>
		<?php
			//select all ug name
			$sql_ugnames = "SELECT username, place FROM users WHERE role IN('ug', 'ugnat')";
			$run_ugnames = mysqli_query($connect, $sql_ugnames);
			while($row2 = mysqli_fetch_assoc($run_ugnames)){
				$ug = array();
				$ug[] = $row2['username'];

				foreach ($ug as $ugs => $ugname){
					$sql_chart = "SELECT COUNT(DISTINCT c.prog_code) AS count FROM candidate_reg c INNER JOIN programmes AS p ON p.p_code = c.prog_code WHERE p.status = 'publish' AND c.status = 'Selected' AND c.author = '$ugname' AND c.category = 'thaniya'";
					$run_chart = mysqli_query($connect, $sql_chart);
				}
			
		?>
	
		<?php
			}
				mysqli_close($connect);
				
			?>
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