<?php
	session_start();
	include '../../db.php'; 
	
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
		$sel_sql = "SELECT * FROM users WHERE username = '$_SESSION[user]' AND password = '$_SESSION[password]' AND role = '$_SESSION[role]'";
		if($run_sql = mysqli_query($connect, $sel_sql)){
			if(mysqli_num_rows($run_sql) == 1){
				if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'venue'){
                    
                }else{
                    header('Location: login.php?login=nopermission');
                }
			}else{
				header('Location: login.php');
			}
		}
		}else{
			header('Location: login.php');
		}
// get count of candidates in each venue
$run_countcad = mysqli_query($connect, "SELECT COUNT(DISTINCT c.chest) AS candidates, COUNT(DISTINCT c.p_code) AS progs, COUNT(DISTINCT c.category) AS cat FROM final_candidates c INNER JOIN final_schedule s ON c.p_code = s.p_code LEFT JOIN venues v ON v.id = s.venue WHERE v.user = '$_SESSION[user]'");
while($row = mysqli_fetch_assoc($run_countcad)){
	$candidates = $row['candidates'];
	$programmes = $row['progs'];
	$cat= $row['cat'];
}


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sibaq'19 | Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/fontawesome-all.css" media="all">
		<link rel="stylesheet" href="../../css/fontawsome/css/fontawesome.min.css" media="all">
		<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css" media="all">
		<link rel="stylesheet" href="../../registration/candidate/css/jquery-ui.min.css" media="all">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
		<link rel="icon" href="../../img/logo.ico">
	</head>
	<body>
		<main>
			<?php include 'theme/header.php'; ?>
			<div class="container-fluid">
				<div class="row">
					<?php include 'theme/side.php'; ?>
					<div class="col-lg-9" id="dashContent">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<h1 class="text-center pt-2"><?php echo strtoupper($_SESSION['user']); ?></h1>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="wrapper1">
										<div id="sumary">
											<div class="head1">
												<h4>Programmes summary</h4>
											</div>
											<div class="summaryContent">
												<div class="container-fluid">
													<div class="row">
														<div class="col-md-4">
															<div class="tile">
																<div class="boxRound text-center">
																	<section class="count display-2">
																		<span><?php echo $programmes; ?></span>
																	</section>
																	<section class="item">Programmes</section>
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="tile">
																<div class="boxRound text-center">
																	<section class="count display-2">
																		<span><?php echo $candidates; ?></span>
																	</section>
																	<section class="item">Candidates</section>
																</div>
															</div>
														</div>
														<div class="col-md-4">
															<div class="tile">
																<div class="boxRound text-center">
																	<section class="count display-2">
																		<span><?php echo $cat; ?></span>
																	</section>
																	<section class="item">Categories</section>
																</div>
															</div>
														</div>
														</div>
														<div class="clearfix"></div>
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
		</main>
		<script src="../../js/jquery-3.3.1.js"></script>
		<script src="../../js/popper.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/bootstrap.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>